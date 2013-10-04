<?php

require_once 'classes/Nametastic.php';

use IsItSaturday\Playbook\Model;

class ModelTest extends PHPUnit_Framework_TestCase
{
	public $model;

	public function setUp()
	{
		\IsItSaturday\Playbook\Facades\Sync::setup('sqlite::memory:');
		$this->model = new Model(array('name' => "Dave"));
	}

	public function testNewModelTracksChanges()
	{
		$this->assertSame(array('name'), $this->model->changedAttributes());
		$this->assertTrue($this->model->hasChanged());
	}

	public function testMethodLoop()
	{
		$this->model->set('job', 'programmer');
		$this->assertTrue($this->model->has('job'));
		$this->assertSame('programmer', $this->model->get('job'));

		$this->model->remove('job');
		$this->assertNull($this->model->get('job'));
	}

	public function testArrayLoop()
	{
		$this->model['job'] = 'programmer';
		$this->assertTrue($this->model->offsetExists('job'));
		$this->assertSame('programmer', $this->model['job']);

		$this->model->offsetUnset('job');
		$this->assertNull($this->model['job']);
	}

	public function testPropertyLoop()
	{
		$this->model->job = 'programmer';
		$this->assertTrue(isset($this->model->job));
		$this->assertSame('programmer', $this->model->job);

		unset($this->model->job);
		$this->assertNull($this->model->job);
	}

	public function testReset()
	{
		$this->model->reset();
		$this->assertFalse($this->model->hasChanged());
	}

	public function testNoIdIsFalse()
	{
		$this->assertFalse($this->model->id());
	}

	public function testHasId()
	{
		$this->model->set('id', 1);
		$this->assertSame(1, $this->model->id());
	}

	public function testDefaultTableIsEmptyString()
	{
		$this->assertSame('', $this->model->table());
	}

	public function testToJSON()
	{
		$json = '{"name":"Dave"}';
		$this->assertSame($json, $this->model->toJSON());
		$this->assertSame($json, $this->model->jsonSerialize());
	}

	public function testToArray()
	{
		$this->assertSame(array('name' => "Dave"), $this->model->toArray());
	}

	public function testToClass()
	{
		$object = $this->model->toClass("Nametastic");
		$this->assertSame('evaD', $object->reverseName());
	}

	public function testValidation()
	{
		$this->assertTrue($this->model->isValid());
		$this->assertEmpty($this->model->errors());
	}

}
