<?php
namespace eskymo;

class ObjectTest extends \eskymo\tests\TestCase
{

	public function testEquals() {
		$first	= new Object();
		$second = new Object();
		$firstClone = $first;
		$this->assertFalse($first->equals($second));
		$this->assertFalse($second->equals($first));
		$this->assertTrue($first->equals($firstClone));
		$this->assertTrue($firstClone->equals($first));
	}

}