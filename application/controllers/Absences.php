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

    public function create() {
        if ($this->input->is_ajax_request()) {
			$data['activity_code'] = $this->input->get('activity_code');
			$this->load->view('absences/create_modal', $data);
		} else {
			show_404();
		}
    }

	public function datatable()
    {	
        $this->datatable->select('pn.advance_number, u.username, DATE_FORMAT(pn.tor_approve_date, "%d %M %Y"), dm.activity, dm.kode_kegiatan as id, pn.tor_number,
        dm.kode_kegiatan, u.avatar, u.purpose, un.unit_name');
        $this->datatable->from('tb_mini_proposal_new pn');
        $this->datatable->join('tb_userapp u', 'u.id = pn.create_by');
        $this->datatable->join('tb_units un', 'u.unit_id = un.id');
        $this->datatable->join('tb_detail_monthly dm', 'dm.kode_kegiatan = pn.code_activity');
        $this->datatable->where('pn.status_finance', '1');
        // $this->datatable->where_in('pn.direct_fund_code', $program_assistance_df_number);
        // $this->datatable->where("dm.year = '".date('Y')."' and (dm.month IN('" . date('n') . "','" . (date('n') + 1) . "') OR dm.month_postponse IN('" . date('n') . "','" . (date('n') + 1) . "') )");

        echo $this->datatable->generate();
    }

}
