<?php
/**
 * This source file is subject to the "New BSD License".
 *
 * For more information please see http://eskymo.zimodej.cz
 *
 * @copyright	Copyright (c) 2009	Jan Papoušek (jan.papousek@gmail.com),
 *									Jan Drábek (repli2dev@gmail.com)
 * @license		http://www.opensource.org/licenses/bsd-license.php
 * @link		http://eskymo.zimodej.cz
 */

namespace eskymo\model;

/**
 * @author Jan Papousek
 */
class EntityTest extends \eskymo\tests\TestCase
{

	public function testAccess() {
		$entity = new EntityTest_Entity(
			new EntityTest_MockInserter(),
			new EntityTest_MockUpdater(),
			new EntityTest_MockDeleter()
		);
		try {
			$entity->aaaa;
			$this->fail("Access to a not defined property should be forbidden.");
		}
		catch(\Nette\MemberAccessException $e) {}
		try {
			$entity->aaaa = 1;
			$this->fail("Access to a not defined property should be forbidden.");
		}
		catch(\Nette\MemberAccessException $e) {}
		try {
			$entity->readAttribute = 1;
			$this->fail("Write access to an only-read property should be forbidden.");
		}
		catch(\Nette\MemberAccessException $e) {}
		try {
			$entity->readAttribute;
		}
		catch(\Exception $e) {
			echo $e->getTraceAsString();
			$this->fail("Read access to an only-read property shouldn't be forbidden.");
		}
		try {
			$entity->writeAttribute;
		}
		catch(\Exception $e) {
			echo $e->getTraceAsString();
			$this->fail("Read access to a writable property shouldn't be forbidden.");
		}
		try {
			$entity->writeAttribute = 1;
		}
		catch(\Exception $e) {
			echo $e->getTraceAsString();
			$this->fail("Write access to a writable property shouldn't be forbidden.");
		}
	}

	public function testLifeCycle() {
		$entity = new EntityTest_Entity(
			new EntityTest_MockInserter(),
			new EntityTest_MockUpdater(),
			new EntityTest_MockDeleter()
		);
		$this->assertEquals(IEntity::STATE_NEW, $entity->getState());
		$entity->loadDataFromArray(array('id_entity_test' => 0));
		$this->assertEquals(IEntity::STATE_PERSISTED, $entity->getState());
		$entity->attribute = 0;
		$this->assertEquals(IEntity::STATE_MODIFIED, $entity->getState());
		$entity->persist();
		$this->assertEquals(IEntity::STATE_PERSISTED, $entity->getState());
		$entity->attribute = 0;
		$this->assertEquals(IEntity::STATE_PERSISTED, $entity->getState());
		$entity->attribute = 1;
		$this->assertEquals(IEntity::STATE_MODIFIED, $entity->getState());
		$entity->delete();
		$this->assertEquals(IEntity::STATE_DELETED, $entity->getState());
	}

	public function testPersistId() {
		$entity = new EntityTest_Entity(
			new EntityTest_MockInserter(),
			new EntityTest_MockUpdater(),
			new EntityTest_MockDeleter()
		);
		$entity->persist();
		$this->assertEquals(1, $entity->getId());
	}

}

/**
 * @property mixed $attribute
 * @property-read mixed $readAttribute
 * @property-write mixed $writeAttribute
 */
class EntityTest_Entity extends Entity {
	
}

class EntityTest_MockInserter implements IInserter {
	public function insert(IEntity &$entity) {return 1;}
}

class EntityTest_MockUpdater implements IUpdater {
	public function update(IEntity &$entity) {}
}

class EntityTest_MockDeleter implements IDeleter {
	public function delete(IEntity &$entity) {}
}