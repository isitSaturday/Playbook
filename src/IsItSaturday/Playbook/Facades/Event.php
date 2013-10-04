<?php

namespace IsItSaturday\Playbook\Facades;

class Event extends Facade
{
	private static $dispatcher = null;

	public static function getInstance()
	{
		if (self::$dispatcher === null)
		{
			self::$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher;
		}

		return self::$dispatcher;
	}

	/**
	 * Since the Symfony EventDispatcher doesn't have the api we want, we need some conversion.
	 */
	public static function __callStatic($method, $args)
	{
		$method_map = array(
			'on' => 'addListener',
			'off' => 'removeListener',
			'trigger' => 'dispatch'
		);

		if (isset($method_map[$method]))
		{
			$method = $method_map[$method];
		}

		return parent::__callStatic($method, $args);
	}

}
