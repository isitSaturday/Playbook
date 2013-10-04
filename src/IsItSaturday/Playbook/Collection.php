<?php

namespace IsItSaturday\Playbook;

class Collection implements \Countable, \IteratorAggregate
{
	/**
	 * @var string  The name of the model class
	 */
	public $model = '\\IsItSaturday\\Playbook\\Model';

	/**
	 * @var string  The name of the table to sync to
	 */
	public $table = '';

	protected $models = array();

	/**
	 * @param array $models  An array of models to add to the collection
	 */
	public function __construct(array $models = array())
	{
		foreach ($models as $model)
		{
			$this->add($model);
		}
	}

	/**
	 * @see toJSON()
	 */
	public function jsonSerialize()
	{
		return $this->toJSON();
	}

	/**
	 * @return string
	 */
	public function toJSON()
	{
		return json_encode($this->toArray());
	}

	/**
	 * @return array
	 */
	public function toArray()
	{
		$list = array();
		foreach ($this->models as $model)
		{
			$list[] = $model->toArray();
		}

		return $list;
	}

	/**
	 * @param  string $name
	 * @return [type] [description]
	 */
	public function toClass($name)
	{
		$list = array();
		foreach ($this->models as $model)
		{
			$list[] = $model->toClass($name);
		}

		return $list;
	}

	/**
	 * @param Model $model
	 */
	public function add($model)
	{
		$this->models[] = $model;
	}

	/**
	 * @return int  $index
	 */
	public function at($index)
	{
		return $this->models[$index];
	}

	/**
	 * @see count()
	 */
	public function length()
	{
		return $this->count();
	}

	/**
	 * @return int
	 */
	public function count()
	{
		return \count($this->models);
	}

	public function fetch(){}
	public function create(){}
	public function pluck(){}
	public function where(){}
	public function findWhere(){}

	/**
	 * @return ArrayIterator
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->models);
	}

}
