<?php

namespace IsItSaturday\Playbook;

class Model implements \ArrayAccess
{
	public $idAttribute = 'id';

	protected $data = array();
	protected $changed = array();
	protected $default = array();
	protected $errors = array();

	public function __construct(array $data = array());

	public function get($name, $default = null);
	public function set($name, $value);
	public function has($name);
	public function unset($name);
	public function clear();

	public function id();
	public function isNew();

	public function table()
	{
		return '';
	}

	public function save();
	public function destroy();

	public function jsonSerialize();
	public function toJson();

	public function toArray();
	public function toClass($name);

	public function validate();
	public function errors();
	public function isValid();

	public function hasChanged();
	public function changedAttributes();

	public function offsetExists($name);
	public function offsetGet($name);
	public function offsetSet($name, $value);
	public function offsetUnset($name);
}
