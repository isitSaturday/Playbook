<?php

namespace IsItSaturday\Playbook;

class Collection implements \Countable, \IteratorAggreate
{
	public $model = '\\IsItSaturday\\Playbook\\Model';
	public $table = '';

	protected $models = array();

	public function toJSON(){}
	public function jsonSerialize(){}

	public function toArray(){}
	public function toClass(){}

	public function add(){}
	public function remove(){}
	public function reset(){}

	public function get(){}
	public function at(){}

	public function length(){}
	public function count(){}

	public function fetch(){}
	public function create(){}
	public function pluck(){}
	public function where(){}
	public function findWhere(){}
}
