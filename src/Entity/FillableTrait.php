<?php
namespace App\Entity;
trait FillableTrait
{
    public function fill(array $data, bool $unstrict = false): void
    {
        foreach ($data as $property => $value) {
            if (property_exists($this, $property)) {
                //call_user_func([$this, "set" . ucfirst($property)], $value);
                $reflectionProp = new \ReflectionProperty($this, $property);
                
                $reflectionProp->setValue($this, $value);
            }
        }
    }
}