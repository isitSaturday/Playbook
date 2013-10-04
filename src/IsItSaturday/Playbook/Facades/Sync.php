<?php

namespace IsItSaturday\Playbook\Facades;

class Sync extends Facade
{
	private static $sync = null;

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
		$pdo = ($dsn instanceof \PDO) ?
			$dsn :
			new \PDO($dsn, $username, $password, $driver_options);

		self::$sync = new \IsItSaturday\Playbook\Sync($pdo);
	}

	public static function getInstance()
	{
		if (self::$sync === null)
		{
			throw new \LogicException('Please run \\IsItSaturday\\Playbook\\Facades\\Sync::setup');
		}

		return self::$sync;
	}

}
