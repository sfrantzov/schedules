<?php
use Assert\Assert;
use App\Traits\MagicTrait;
/**
 * Class Artist
 * Params (alphabetically):
 *
 * @property string $name
*/
class Artist {
    use MagicTrait;
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
        Assert::that($name)->notEmpty(self::INVALID_NAME);
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
