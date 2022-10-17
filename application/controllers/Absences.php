<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Absences extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->template->set('menu', 'Absences');
		$this->load->model('Base_Model');
		$this->load->model('Absences_Model', 'absences');
		$this->template->set_default_layout('layouts/default');
        $validated = $this->verifyToken();
        if(!$validated) {
            redirect($_ENV['LOGIN_URL']);
        }
	}

	public function index() {
		$this->template->set('page', 'Create Absences');
        $this->template->render('absences/index');
	}

    public function data() {
		$this->template->set('page', 'Internet, local transport & fee');
        $this->template->render('absences/data');
	}

    public function create() {
        if ($this->input->is_ajax_request()) {
			$data['activity_code'] = $this->input->get('activity_code');
			$this->load->view('absences/create_modal', $data);
		} else {
			show_404();
		}
    }

    public function absences_datatable()
    {	
        $this->datatable->select('pn.advance_number, dm.activity,dm.kode_kegiatan as participant_receipt, dm.kode_kegiatan as local_transport,
        dm.kode_kegiatan as internet, dm.kode_kegiatan as download, dm.kode_kegiatan as action');
        $this->datatable->from('tb_mini_proposal_new pn');
        $this->datatable->join('absences abs', 'abs.code_activity = pn.code_activity');
        $this->datatable->join('tb_userapp u', 'u.id = pn.create_by');
        $this->datatable->join('tb_units un', 'u.unit_id = un.id');
        $this->datatable->join('tb_detail_monthly dm', 'dm.kode_kegiatan = pn.code_activity');
        $this->datatable->where('pn.status_finance', '1');
        // $this->datatable->where_in('pn.direct_fund_code', $program_assistance_df_number);
        // $this->datatable->where("dm.year = '".date('Y')."' and (dm.month IN('" . date('n') . "','" . (date('n') + 1) . "') OR dm.month_postponse IN('" . date('n') . "','" . (date('n') + 1) . "') )");

        echo $this->datatable->generate();
    }

	public function datatable()
    {	
        $this->datatable->select('pn.advance_number, u.username, DATE_FORMAT(pn.tor_approve_date, "%d %M %Y"), dm.activity, dm.kode_kegiatan as action, pn.tor_number,
        dm.kode_kegiatan, u.avatar, u.purpose, un.unit_name');
        $this->datatable->from('tb_mini_proposal_new pn');
        $this->datatable->join('tb_userapp u', 'u.id = pn.create_by');
        $this->datatable->join('tb_units un', 'u.unit_id = un.id');
        $this->datatable->join('tb_detail_monthly dm', 'dm.kode_kegiatan = pn.code_activity');
        $this->datatable->where('pn.status_finance', '1');
        $this->datatable->edit_column('action', '$1', 'absence_action_btn(action)');
        // $this->datatable->where_in('pn.direct_fund_code', $program_assistance_df_number);
        // $this->datatable->where("dm.year = '".date('Y')."' and (dm.month IN('" . date('n') . "','" . (date('n') + 1) . "') OR dm.month_postponse IN('" . date('n') . "','" . (date('n') + 1) . "') )");

        echo $this->datatable->generate();
    }

    public function participants_datatable($code_activity)
    {
        $this->datatable->select('nama_peserta, (
            CASE 
                WHEN jenis_kelamin = "1" THEN "Male"
                WHEN jenis_kelamin = "2" THEN "Female"
                ELSE "Transgender"
            END) AS jenis_kelamin, asal_layanan,email_peserta,
        reimbursement_type, format(jumlah_konsumsi, 0, "de_DE") as jumlah_konsumsi, format(jumlah_internet, 0, "de_DE") as internet_fee,
        format(jumlah_other, 0, "de_DE") as other_fee, format(jumlah_konsumsi+jumlah_internet+jumlah_other, 0, "de_DE")  as total, 
        resi_konsumsi, ovo_number, gopay_number, bank_name, bank_number, transfer_receipt, phone_number, nama_lembaga, id');
        $this->datatable->from('tb_event_absence');
        $this->datatable->where('code_activity', $code_activity);
        echo $this->datatable->generate();
    }

    public function store() {
		$this->form_validation->set_rules('start_date', 'Start date', 'required');
		$this->form_validation->set_rules('end_date', 'End date', 'required');
		$this->form_validation->set_rules('kind_of_meeting', 'Kind of meeting', 'required');
		$kind_of_meeting = $this->input->post('kind_of_meeting');
		if($kind_of_meeting == '1' || $kind_of_meeting == '3') {
			$this->form_validation->set_rules('meeting_link', 'Meeting link', 'required');
			$this->form_validation->set_rules('valid_date', 'Valid date', 'required');
			$this->form_validation->set_rules('valid_time', 'Valid time', 'required');
		}

		if ($this->form_validation->run()) {
			$payload = $this->input->post();
            $payload['created_by'] = $this->user_data->userId;
            $saved = $this->absences->insert_absences($payload);
            if($saved) {
                $response['payload'] = $payload;
                $response['message'] = 'Absence has been created!';
                $status_code = 200;
            } else {
                $response['errors'] = $this->form_validation->error_array();
			    $response['message'] = 'Something wrong, please try again later!';
			    $status_code = 400;
            }
		} else {
			$response['errors'] = $this->form_validation->error_array();
			$response['message'] = 'Please fill all required fields';
			$status_code = 422;
		}
		$this->send_json($response, $status_code);
	}

    public function update_participant($id) {

        if ($this->input->is_ajax_request()) {
            $payload = $this->input->post();
            $data = $this->absences->update_participant_data($id, $payload);
            if($data) {
                $response['data'] = $data;
                $response['message'] = 'Absence has been created!';
                $status_code = 200;
            } else {
                $response['errors'] = $this->form_validation->error_array();
                $response['message'] = 'Something wrong, please try again later!';
                $status_code = 400;
            }
            $this->send_json($response, $status_code);
        } else {
            show_404();
        }
		
	}

    public function participants($code_activity) {
        $this->template->set('page', 'Participants list');
            $data['detail'] = $this->absences->get_absences_by_activity_code($code_activity);
            $this->template->render('absences/participants', $data);
    }

    public function participants_modal() {
        if ($this->input->is_ajax_request()) {
            $data['code_activity'] = $this->input->get('code_activity');
            $this->load->view('absences/participants_modal', $data);
        } else {
            show_404();
        }
    }

}
