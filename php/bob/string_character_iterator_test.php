<?php
require_once "bob.php";

class StringCharacterIteratorTest extends PHPUnit\Framework\TestCase
{
    public function test_iteration()
    {
        $string = 'Hi';
        $iterator = new StringCharacterIterator($string);

        $this->assertTrue($iterator->valid());
        $this->assertEquals(0, $iterator->key());
        $this->assertEquals('H', $iterator->current());

        $iterator->next();
        $this->assertTrue($iterator->valid());
        $this->assertEquals(1, $iterator->key());
        $this->assertEquals('i', $iterator->current());

        $iterator->next();
        $this->assertFalse($iterator->valid());

        $iterator->rewind();
        $this->assertTrue($iterator->valid());
        $this->assertEquals(0, $iterator->key());
        $this->assertEquals('H', $iterator->current());
    }
}
