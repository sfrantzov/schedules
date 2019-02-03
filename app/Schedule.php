<?php

/**
 * Class Schedule
 */
class Schedule implements Iterator, Countable {
    /**
     * @var int
     */
    private $position;

    /**
     * @var array
     */
    private $timeslots;
    /**
     *
     */
    public function __construct()
    {
        $this->timeslots = array();
        $this->position = 0;
    }

    /**
     * @param Timeslot $timeslot
     * @return $this
     */
    public function addTimeslot(Timeslot $timeslot)
    {
        if (!$this->overlaps($timeslot)) {
            $this->timeslots[] = $timeslot;
        }

        $this->sortByStartTime();
    }

    /**
     * Sort slots by starting time
     */
    private function sortByStartTime()
    {
        usort($this->timeslots, function ($a, $b) {
            if ($a->getStartsAt() === $b->getStartsAt()) {
                return 0;
            }
            return ($a->getStartsAt() < $b->getStartsAt()) ? -1 : 1;
        });
    }

    /**
     * @param Timeslot $timeslot
     * @return bool
     */
    public function overlaps(Timeslot $timeslot)
    {
        foreach ($this->timeslots as $existingSlot) {
            if ($timeslot->overlaps($existingSlot)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->timeslots);
    }

    /**
     * @return void
     */
    function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return mixed
     */
    function current()
    {
        return $this->timeslots[$this->position];
    }

    /**
     * @return mixed
     */
    function key()
    {
        return $this->position;
    }

    /**
     * @return void
     */
    function next()
    {
        ++$this->position;
    }

    /**
     * @return bool
     */
    function valid() {
        return isset($this->timeslots[$this->position]);
    }
}
