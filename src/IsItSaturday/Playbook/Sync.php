<?php

namespace IsItSaturday\Playbook;

class Sync
{
	protected $pdo;

	public function __construct(\PDO $pdo)
	{
		$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

		$this->pdo = $pdo;
	}

	/**
	 * Run a query.
	 *
	 * @param  string $query   The query to run
	 * @param  array  $params  Any query params to add
	 * @return \PDOStatement
	 */
	public function run($query, array $params = array())
	{
		$statement = $this->pdo->prepare($query);
		$statement->execute($params);

		return $statement;
	}

}
