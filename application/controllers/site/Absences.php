<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Absences extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('Base_Model');
		$this->load->model('Absences_Model', 'absences');
		$this->template->set_default_layout('layouts/blank');
	}

	public function form($activity_code) {
        $detail = $this->absence->get_absences_by_activity_code($activity_code);
		if($detail) {
			
		} else {
			show_404();
		}
	}
}
