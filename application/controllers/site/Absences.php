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

	public function store() {
		if ($this->input->is_ajax_request() and $this->input->server('REQUEST_METHOD') === 'POST') {
			$this->form_validation->set_rules('nama_peserta', 'Nama peserta', 'required');
        	$this->form_validation->set_rules('jenis_kelamin', 'Jenis kelamin', 'required');
            $this->form_validation->set_rules('asal_layanan', 'Instansi/organisasi', 'required');
            $this->form_validation->set_rules('nama_lembaga', 'Nama lembaga', 'required');
            $this->form_validation->set_rules('phone_number', 'No HP/WhatsApp', 'required');
            $this->form_validation->set_rules('email_peserta', 'Email peserta', 'required');
            $this->form_validation->set_rules('jumlah_konsumsi', 'Jumlah konsumsi', 'required');
            $this->form_validation->set_rules('jumlah_internet', 'Jumlah internet', 'required');
            $this->form_validation->set_rules('resi_konsumsi', 'Resi konsumsi', 'required');
            $this->form_validation->set_rules('reimbursement_type', 'Proses reimbursement', 'required');
			$this->form_validation->set_message('required', '{field} harus diisi.');
			$type = $this->input->post('reimbursement_type');
			if($type == '1') {
				$this->form_validation->set_rules('ovo_number', 'Nomor OVO', 'required');
			} else if($type == '2') {
				$this->form_validation->set_rules('gopay_number', 'Nomor GOPAY', 'required');
			} else if($type == '3') {
				$this->form_validation->set_rules('bank_name', 'Nama BANK', 'required');
				$this->form_validation->set_rules('bank_number', 'Nomor rekening', 'required');
			}
			if ($this->form_validation->run()) {
				$payload = $this->input->post();
				$saved = $this->absences->insert_attendance($payload);
				if($saved) {
					$response['payload'] = $payload;
					$response['message'] = 'Data berhasil disimpan!';
					$response['html'] = '<div class="text-center my-5 py-3 border-bottom">
											<h1 class="mb-3">Terimakasih sudah mengisi form!</h1>
											<img src="'.base_url('assets/images/svg/thanks.svg').'" style="height: 15rem; width: auto;" alt="">
										</div>';
					$status_code = 200;
				} else {
					$response['errors'] = $this->form_validation->error_array();
					$response['message'] = 'Maaf ada gangguan, silahkan coba kembali!';
					$status_code = 400;
				}
			} else {
				$response['errors'] = $this->form_validation->error_array();
				$response['message'] = 'Mohon isi semua data wajib!';
				$status_code = 422;
			}
			$this->send_json($response, $status_code);
		} else {
			show_404();
		}
	}
}
