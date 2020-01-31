<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends GS_Controller {

	public function users()
	{
		$Event = $GLOBALS['CMDEvent'];
		switch ($Event) {
			case 'register':
				# code...
				break;

			case 'update':
				# code...
				break;

			case 'login':
				# code...
				break;

			case 'profile':
				# code...
				break;
			
			default:
				# code...
				break;
		}
	}
}
