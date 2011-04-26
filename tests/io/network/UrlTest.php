<?php
class UrlTest extends eskymo\tests\TestCase
{

	public function testSave() {
		$url = new \eskymo\io\network\Url('http://google.com');
		$file = new eskymo\io\File(__DIR__ . '/../test-environment/google');
		// Linux
		$url->save($file);
		$this->assertTrue($file->exists());
		$file->delete();
		// Windows
		$url->setEnvironment(new UrlTest_Environment());
		$url->save($file);
		$this->assertTrue($file->exists());
		$file->delete();
	}

}


class UrlTest_Environment implements eskymo\IEnvironment
{

	public function isLinux() {
		return false;
	}

}