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
        $detail = $this->absences->get_absences_by_activity_code($activity_code);
		if($detail) {
			$data['detail'] = $detail;
			$this->template->render('absences/absence_form', $data);
		} else {
			show_404();
		}
	}

	public function save_absence() {
		if ($this->input->is_ajax_request() and $this->input->server('REQUEST_METHOD') === 'POST') {
			$this->form_validation->set_rules('nama_peserta', 'Nama Peserta', 'required');
        	$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
            $this->form_validation->set_rules('asal_layanan', 'Instansi/organisasi', 'required');
            $this->form_validation->set_rules('nama_lembaga', 'Nama lembaga', 'required');
            $this->form_validation->set_rules('phone_number', 'No HP/WA', 'required');
            $this->form_validation->set_rules('email_peserta', 'Email Peserta', 'required');
            $this->form_validation->set_rules('proses_reimbursement', 'Proses Reimburesement', 'callback_validate_proses_reimbursement');
            $this->form_validation->set_rules('jumlah_reimburesment', 'Jumlah Reimburesment', 'required');
		} else {
			show_404();
		}
	}
}
