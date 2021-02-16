<?php
use PHPUnit\Framework\TestCase;

class ParsingFunctionTest extends TestCase {
    public function testItParsesAnInteger(): void {
        $this->assertEquals(4, parse_int("4"));
        $this->assertNull(parse_int("not a number"));
    }

    public function testItParsesAJSONArray(): void {
        $this->assertEquals([1, 2, 3], parse_array("[1,2,3]"));
    }

    public function testItParsesACSVArray(): void {
        $this->assertEquals([1, 2, 3], parse_array("1,2,3"));
    }
}
