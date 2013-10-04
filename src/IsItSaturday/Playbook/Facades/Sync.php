<?php

namespace IsItSaturday\Playbook\Facades;

class Sync extends Facade
{
	private static $pdo = null;

	/**
	 * Setup the PDO instance that powers all sync operations.
	 *
	 * @param  mixed  $dsn            The DSN string or a PDO instance
	 * @param  string $username
	 * @param  string $password
	 * @param  array  $driver_options
	 */
	public static function setup($dsn, $username = '', $password = '', $driver_options = array())
	{
		if ($dsn instanceof \PDO)
		{
			self::$pdo = $dsn;
		}
		else
		{
			self::$pdo = new \PDO($dsn, $username, $password, $driver_options);
		}
	}

	public static function getInstance()
	{
		if (self::$pdo === null)
		{
			throw new \LogicException('Please run Sync::setup');
		}

		return self::$pdo;
	}

}
