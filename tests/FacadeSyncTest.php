<?php

use IsItSaturday\Playbook\Facades\Sync;

class FacadeSyncTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @expectedException \LogicException
	 */
	public function testNoSetupThrowsException()
	{
		Sync::willThrowAnException();
	}

}
