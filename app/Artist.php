<?php

/**
 * Class Artist
 */
class Artist {
    /**
     * @var string
     */
    private $name;

    const INVALID_NAME = "Name is mandatory";

    /**
     * @param $name string
     * @throws InvalidArgumentException
     */
    public function __construct(string $name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException(self::INVALID_NAME);
        }
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
