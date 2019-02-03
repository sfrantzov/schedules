<?php

/**
 * Class ArtistView
 */
class ArtistView {
    /**
     * @var Artist
     */
    private $artist;

    /**
     * @param Artist $artist
     */
    public function __construct(Artist $artist)
    {
        $this->artist = $artist;
    }

    /**
     * @return string
     */
    public function getInitials()
    {
        return mb_substr($this->artist->getName(), 0, 1);
    }

    /**
     * @return string
     */
    public function getLowerCase()
    {
        return mb_strtolower($this->artist->getName());
    }
}
