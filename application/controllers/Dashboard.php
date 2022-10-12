<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->template->set('menu', 'Dashboard');
		$this->template->set_default_layout('layouts/default');
		$validated = $this->verifyToken();
        if(!$validated) {
            redirect($_ENV['LOGIN_URL']);
        }
	}

	public function index()
	{   
		$this->template->set('page', 'Dashboard');
		$this->template->render('dashboard');
	}
}
