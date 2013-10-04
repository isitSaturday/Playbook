<?php

namespace IsItSaturday\Playbook;

class Model implements \ArrayAccess
{
	/**
	 * @var string
	 */
	public $idAttribute = 'id';

	protected $data = array();
	protected $changed = array();
	protected $errors = array();

	/**
	 * @param array $data
	 */
	public function __construct(array $data = array())
	{
		$this->reset();

		if ( ! empty($data))
		{
			$this->set($data);
		}
	}

	/**
	 * @param  string  $name
	 * @return boolean
	 */
	public function has($name)
	{
		return \array_key_exists($name, $this->data);
	}

	/**
	 * Same as __get() only allowing for a default value if the property isn't found
	 *
	 * @see __get()
	 *
	 * @param  string $name
	 * @param  mixed  $default
	 * @return mixed
	 */
	public function get($name, $default = null)
	{
		if ( ! $this->has($name))
		{
			return $default;
		}

		return $this->data[$name];
	}

	/**
	 * @param  mixed $name   The name of the property or key => value pairs
	 * @param  mixed $value  If setting a single property, the value of said property
	 * @return Model
	 */
	public function set($name, $value = null)
	{
		if ( ! is_array($name))
		{
			$name = array($name => $value);
		}

		foreach ($name as $key => $value)
		{
			if ( ! $this->has($key) OR $this->get($key) !== $value)
			{
				$this->changed[] = $key;
			}

			$this->data[$key] = $value;
		}

		return $this;
	}

	/**
	 * @param  string $name
	 * @return mixed  The value of the property before it is removed
	 */
	public function remove($name)
	{
		$value = $this->get($name);
		unset($this->data[$name]);

		return $value;
	}

	/**
	 * @return Model
	 */
	public function reset()
	{
		$this->changed = array();
		$this->errors = array();

		return $this;
	}

	/**
	 * @return mixed  The id of the model (or false)
	 */
	public function id()
	{
		return $this->get($this->idAttribute, false);
	}

	/**
	 * @return boolean
	 */
	public function isNew()
	{
		return $this->id() === false;
	}

	/**
	 * @return string  The name of the table the model is associated with
	 */
	public function table()
	{
		return '';
	}

	public function fetch($id){}
	public function save(){}
	public function destroy(){}

	/**
	 * Converts the data to json.
	 *
	 * @return string
	 */
	public function toJSON()
	{
		return json_encode($this->data);
	}

	/**
	 * @see toJSON()
	 */
	public function jsonSerialize()
	{
		return $this->toJSON();
	}

	/**
	 * @return array
	 */
	public function toArray()
	{
		return $this->data;
	}

	/**
	 * @param  string $name
	 * @return mixed
	 */
	public function toClass($name)
	{
		return new $name($this->data);
	}

	/**
	 * @return array
	 */
	public function validate()
	{
		$this->errors = array();
		return $this->errors;
	}

	/**
	 * @return array
	 */
	public function errors()
	{
		return $this->errors;
	}

	/**
	 * @uses   validate()
	 * @return boolean
	 */
	public function isValid()
	{
		$errors = $this->validate();
		return empty($errors);
	}

	/**
	 * @return boolean
	 */
	public function hasChanged()
	{
		return ! empty($this->changed);
	}

	/**
	 * @return array
	 */
	public function changedAttributes()
	{
		return $this->changed;
	}

	/**
	 * @see has()
	 */
	public function offsetExists($name)
	{
		return $this->has($name);
	}

	/**
	 * @see get()
	 */
	public function offsetGet($name)
	{
		return $this->get($name);
	}

	/**
	 * @see set()
	 */
	public function offsetSet($name, $value)
	{
		$this->set($name, $value);
	}

	/**
	 * @see remove()
	 */
	public function offsetUnset($name)
	{
		$this->remove($name);
	}

	/**
	 * @see has()
	 */
	public function __isset($name)
	{
		return $this->has($name);
	}

	/**
	 * @see get()
	 */
	public function __get($name)
	{
		return $this->get($name);
	}

	/**
	 * @see set()
	 */
	public function __set($name, $value)
	{
		$this->set($name, $value);
	}

	/**
	 * @see remove()
	 */
	public function __unset($name)
	{
		$this->remove($name);
	}

}
