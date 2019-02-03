<?php

/**
 * Class ScheduleView
 */
class ScheduleView {
    /**
     * @var Schedule
     */
    private $schedule;

    /**
     * @param Schedule $schedule
     */
    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * @return int
     */
    public function getNumberOfTimeslots()
    {
        return $this->schedule->count();
    }

    /**
     * @return int
     */
    public function getDurationInMinutes()
    {
        $oldTimeslot = null;
        $minutes = 0;

        foreach ($this->schedule as $timeslot) {
            $view = new TimeslotView($timeslot);
            $minutes += $view->getDurationInMinutes();
            if ($oldTimeslot !== null) {
                $minutes += $this->getBreaksInMinutes($oldTimeslot, $timeslot);
            }
            $oldTimeslot = $timeslot;
        }

        return $minutes;
    }

    /**
     * @param Timeslot $prev
     * @param Timeslot $next
     * @return int
     */
    private function getBreaksInMinutes(Timeslot $prev, Timeslot $next)
    {
        $dateStart = $prev->getEndsAt();
        $dateEnd = $next->getStartsAt();

        return abs($dateEnd->getTimestamp() - $dateStart->getTimestamp()) / 60;
    }
}
