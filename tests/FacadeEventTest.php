<?php

use IsItSaturday\Playbook\Facades\Event;

class FacadeEventTest extends PHPUnit_Framework_TestCase
{
	public $output = null;
	public $callable;

	public function setUp()
	{
		parent::setUp();

		$self = $this;
		$this->callable = function() use ($self){
			$self->output = true;
		};

		Event::on('test', $this->callable);
	}

	public function testEventOn()
	{
		Event::trigger('test');
		$this->assertTrue($this->output);
	}

	public function testEventOff()
	{
		Event::off('test', $this->callable);
		Event::trigger('test');

		$this->assertNull($this->output);
	}
}
