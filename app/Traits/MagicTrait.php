<?php
namespace App\Traits;

trait MagicTrait
{
    public function __get($propertyName)
    {
        $property = 'get' . ucfirst($propertyName);
        if (property_exists(get_class(), $propertyName)) {
            return $this->{$property}();
        } elseif (method_exists(get_class(), $property)) {
            return $this->{$property}();
        }
    }
}
