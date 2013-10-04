<?php

require_once 'classes/Nametastic.php';

use IsItSaturday\Playbook\Collection,
	IsItSaturday\Playbook\Model;

class CollectionTest extends PHPUnit_Framework_TestCase
{
	public $model;
	public $collection;

	public function setUp()
	{
		$this->model = new Model(array('name' => "Dave"));

		$this->collection = new Collection;
		$this->collection->add($this->model);
	}

	public function testModelHasLength()
	{
		$this->assertSame(1, $this->collection->length());
	}

	public function testNoModelsOnInit()
	{
		$collection = new Collection;
		$this->assertSame(0, $collection->count());
	}

	public function testJSON()
	{
		$json = '[{"name":"Dave"}]';
		$this->assertSame($json, $this->collection->toJSON());
		$this->assertSame($json, $this->collection->jsonSerialize());
	}

	public function testAt()
	{
		$model = $this->collection->at(0);
		$this->assertSame($model, $this->model);
	}

	public function testToArray()
	{
		$this->assertSame(array(array('name' => "Dave")), $this->collection->toArray());
	}

	public function testToClass()
	{
		$list = $this->collection->toClass('Nametastic');
		$this->assertInstanceOf('Nametastic', $list[0]);
	}

	public function testIteratorAggregate()
	{
		$this->assertInstanceOf('ArrayIterator', $this->collection->getIterator());
	}

}
