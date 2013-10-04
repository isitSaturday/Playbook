<?php

class Nametastic
{
	public $data;

	public function __construct(array $data)
	{
		$this->data = $data;
	}

	public function reverseName()
	{
		return strrev($this->data['name']);
	}
}