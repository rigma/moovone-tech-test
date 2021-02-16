<?php
use PHPUnit\Framework\TestCase;
use ExcitedCells\World;

class WorldTest extends TestCase {
    public function testAWorldCanBeInstanciated(): void {
        $world = new World([1, 0, 1, 0, 1, 0]);
        $this->assertEquals('1,0,1,0,1,0', $world);

        $world = new World([true, false, true, false, true, false]);
        $this->assertEquals('1,0,1,0,1,0', $world);

        $world = new World(['1', '0', '1', '0', '1', '0']);
        $this->assertEquals('1,0,1,0,1,0', $world);
    }

    public function testAWorldIsComputingAStep(): void {
        $world = new World([1, 0, 1, 0, 1, 0]);
        $world->step();
        $this->assertEquals('0,0,0,0,0,0', $world);

        $world = new World([1, 1, 1, 0, 0, 0]);
        $world->step();
        $this->assertEquals('1,0,1,1,0,1', $world);
        $world->step();
        $this->assertEquals('1,0,1,1,0,1', $world);

        $world = new World([1, 1, 0, 0, 0, 0]);
        $world->step(4);
        $this->assertEquals('0,0,1,1,1,1', $world);
    }
}
