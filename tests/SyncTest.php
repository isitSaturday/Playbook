<?php

class PDOTest extends PHPUnit_Framework_TestCase
{
	public $sync;

	public function setUp()
	{
		$pdo = new \PDO('sqlite::memory:');
		$this->sync = new \IsItSaturday\Playbook\Sync($pdo);
	}

	public function testQueryReturnsPDOStatement()
	{
		$statement = $this->sync->run('CREATE table test (name varchar(50))');
		$this->assertInstanceOf('\\PDOStatement', $statement);
	}

}
