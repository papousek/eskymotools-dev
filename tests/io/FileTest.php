<?php
class FileTest extends \eskymo\tests\TestCase
{

	public function testCanRead() {
		$file = new \eskymo\io\File(__DIR__ . '/test-environment/file');
		$this->assertTrue($file->canRead());
	}

	public function testCanWrite() {
		$file = new \eskymo\io\File(__DIR__ . '/test-environment/file');
		$this->assertTrue($file->canWrite());
	}

	public function testExceptions() {
		try {
			new \eskymo\io\File(null);
			fail("Exception expected.");
		}
		catch(\InvalidArgumentException $e) {}
		try {
			new \eskymo\io\File("");
			fail("Exception expected.");
		}
		catch(\InvalidArgumentException $e) {}
		
		// Not existing file
		$notExisting = new \eskymo\io\File(__DIR__ . '/test-environment/not-existing');
		try {
			$notExisting->canExecute();
			fail("Exception expected.");
		}
		catch(\Nette\FileNotFoundException $e) {}
		try {
			$notExisting->canRead();
			fail("Exception expected.");
		}
		catch(\Nette\FileNotFoundException $e) {}
		try {
			$notExisting->canWrite();
			fail("Exception expected.");
		}
		catch(\Nette\FileNotFoundException $e) {}
		try {
			$notExisting->copy(__DIR__ . '/destination');
			fail("Exception expected.");
		}
		catch(\Nette\FileNotFoundException $e) {}
		try {
			$notExisting->delete();
			fail("Exception expected.");
		}
		catch(\Nette\FileNotFoundException $e) {}
		try {
			$notExisting->getAbsolutePath();
			fail("Exception expected.");
		}
		catch(\Nette\FileNotFoundException $e) {}
		try {
			$notExisting->getLastModified();
			fail("Exception expected.");
		}
		catch(\Nette\FileNotFoundException $e) {}
		try {
			$notExisting->getSize();
			fail("Exception expected.");
		}
		catch(\Nette\FileNotFoundException $e) {}
		try {
			$notExisting->isDirectory();
			fail("Exception expected.");
		}
		catch(\Nette\FileNotFoundException $e) {}
		try {
			$notExisting->isFile();
			fail("Exception expected.");
		}
		catch(\Nette\FileNotFoundException $e) {}
		try {
			$notExisting->listFiles();
			fail("Exception expected.");
		}
		catch(\Nette\FileNotFoundException $e) {}
		try {
			$notExisting->listPaths();
			fail("Exception expected.");
		}
		catch(\Nette\FileNotFoundException $e) {}
		
		// existing file/dir
		$existing = new \eskymo\io\File(__DIR__ . '/test-environment/file');
		try {
			$existing->copy("");
		}
		catch(\InvalidArgumentException $e) {}
	}

}
