<?php

class TimeslotView {
    /**
     * @var Timeslot
     */
    private $timeslot;

    /**
     * @param Timeslot $timeslot
     */
    public function __construct(Timeslot $timeslot)
    {
        $this->timeslot = $timeslot;
    }

    /**
     * @return int
     */
    public function getDurationInMinutes()
    {
        $dateStart = $this->timeslot->getStartsAt();
        $dateEnd = $this->timeslot->getEndsAt();

        return ceil(abs($dateEnd->getTimestamp() - $dateStart->getTimestamp()) / 60);
    }

    /**
     * @param int $length
     * @return string
     */
    public function getDescriptionExcerpt(int $length = 10)
    {
        return mb_substr($this->timeslot->getDescription(), 0, $length);
    }
}
