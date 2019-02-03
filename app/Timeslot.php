<?php
use  Assert\Assert;

/**
 * Class Timeslot
 */
abstract class Timeslot
{
    /**
     * @var Artist
     */
    private $artist;

    /**
     * @var string
     */
    private $description;

    /**
     * @var DateTime
     */
    private $startsAt;

    /**
     * @var DateTime
     */
    private $endsAt;

    const INVALID_DESCRIPTION = 'Description is mandatory';
    const INVALID_TIME_INTERVAL = 'Invalid time interval';

    /**
     * @param Artist $artist
     * @param string $description
     * @param DateTime $startsAt
     * @param DateTime $endsAt
     * @throws InvalidArgumentException
     */
    public function __construct(Artist $artist, string $description, DateTime $startsAt, DateTime $endsAt)
    {
        Assert::that($description)->notEmpty(self::INVALID_DESCRIPTION);
        Assert::that($endsAt)->greaterThan($startsAt, self::INVALID_TIME_INTERVAL);

        $this->artist = $artist;
        $this->description = $description;
        $this->startsAt = $startsAt;
        $this->endsAt = $endsAt;
    }

    /**
     * @return Artist
     */
    public function getArtist()
    {
        return $this->artist;
    }


    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return DateTime
     */
    public function getStartsAt()
    {
        return $this->startsAt;
    }

    /**
     * @return DateTime
     */
    public function getEndsAt()
    {
        return $this->endsAt;
    }

    /**
     * @param Timeslot $timeslot
     * @return bool
     */
    public function overlaps(Timeslot $timeslot)
    {
        if ($this->getStartsAt() === $timeslot->getStartsAt()) {
            return true;
        }

        if ($this->getStartsAt() < $timeslot->getStartsAt()
           && $timeslot->getStartsAt() < $this->getEndsAt()
        ) {
            return true;
        }

        if ($this->getStartsAt() > $timeslot->getStartsAt()
            && $this->getStartsAt() < $timeslot->getEndsAt()
        ) {
            return true;
        }

        return false;
    }
}
