<?php
require 'EnumFixtures.php';
use App\Entity\FillableTrait;
use PHPUnit\Framework\TestCase;

class FillableTraitTest extends TestCase
{
    public $entity;
    public function setUp(): void
    {
        $this->entity = new stdClass;
    }

    public function testFillEnum()
    {
        $obj = new (new class {
            use FillableTrait;
            public StringEnum $enum;
        });
        $arr = [
            'enum' => 'one'
        ];
        try {
            $obj->fill($arr);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }
}