<?php

namespace IsItSaturday\Playbook\Facades;

abstract class Facade
{
	/**
	 * @return mixed
	 */
	abstract public static function getInstance();

	/**
	 * Handles all of the "static" method calls for the facades.
	 *
	 * @param  string $method
	 * @param  array  $args
	 * @return mixed
	 */
	public static function __callStatic($method, $args)
	{
		$instance = static::getInstance();
		return \call_user_func_array(array($instance, $method), $args);
	}
}
