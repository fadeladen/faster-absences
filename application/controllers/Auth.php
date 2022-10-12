<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->template->set_default_layout('layouts/blank');
	}

	public function logout()
	{   
        delete_cookie('fast_token');
		session_destroy();
		redirect($_ENV['LOGIN_URL']);
	}
}
