<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends GS_Controller {

	public function index()
	{
		$Event = $GLOBALS['CMDEvent'];
		print_r($Event);
	}
}
