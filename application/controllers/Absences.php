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
        $this->datatable->edit_column('local_transport', '$1', '-');
        $this->datatable->edit_column('internet', '$1', '-');
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
        $this->datatable->select('id, nama_peserta, (
            CASE 
                WHEN jenis_kelamin = "1" THEN "Male"
                WHEN jenis_kelamin = "2" THEN "Female"
                ELSE "Transgender"
            END) AS jenis_kelamin, asal_layanan,email_peserta,
        payment_method, format(jumlah_konsumsi, 0, "de_DE") as jumlah_konsumsi, format(jumlah_internet, 0, "de_DE") as internet_fee,
        format(jumlah_other, 0, "de_DE") as other_fee, format(jumlah_konsumsi+jumlah_internet+jumlah_other, 0, "de_DE")  as total, 
        resi_konsumsi, ovo_number, gopay_number, bank_name, bank_number, transfer_receipt, phone_number, nama_lembaga, id as input, is_email_send');
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
                $response['success'] = true;
                $response['message'] = 'Data updated!';
                $status_code = 200;
            } else {
                $response['success'] = false;
                $response['message'] = 'Failed to update participant data!';
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

    public function get_total_participants_reimbursement($code_activity) {
        if ($this->input->is_ajax_request()) {
            $data = $this->db->select('format(sum(jumlah_konsumsi), 0, "de_DE") as total_konsumsi,
            format(sum(jumlah_internet), 0, "de_DE") as total_internet, format(sum(jumlah_other), 0, "de_DE") as total_other,
            format(sum(jumlah_other+jumlah_internet+jumlah_konsumsi), 0, "de_DE") as total')
            ->get_where('tb_event_absence', [
                'code_activity' => $code_activity
            ])->row_array();
            if ($data) {
                $response['data'] = $data;
                $response['success'] = true;
                $status_code = 200;
            } else {
                $response['message'] = 'Invalid code activity!';
                $response['success'] = false;
                $status_code = 400;
            }
            $this->send_json($response, $status_code);
        } else {
            show_404();
        }
    }

    public function submit_participant_reimbursement($participant_id) {
        if ($this->input->is_ajax_request()) {
            $updated = $this->db->where('id', $participant_id)->update('tb_event_absence', ['is_email_send' => 1]);
            if($updated) {
                $sent = $this->send_email_to_participant($participant_id);
                if($sent) {
                    $response['message'] = 'Email has been sent to participant!';
                    $status_code = 200;
                } else {
                    $this->db->where('id', $participant_id)->update('tb_event_absence', ['is_email_send' => 0]);
                    $response['message'] = 'Failed to sending email, please check your connection and try again!';
                    $status_code = 400;
                }
            } else {
                $this->db->where('id', $participant_id)->update('tb_event_absence', ['is_email_send' => 0]);
                $response['message'] = 'Something went wrong, please try again later!';
                $status_code = 400;
            }
            $this->send_json($response, $status_code);
        } else {
            show_404();
        }
    }

    private function send_email_to_participant($participant_id) {
        $this->load->library('Phpmailer_library');
        $mail = $this->phpmailer_library->load();
        $mail->isSMTP();
        $mail->SMTPSecure = 'ssl';
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->Port = 465;
        $mail->SMTPDebug = 0; 
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['EMAIL_USERNAME'];
        $mail->Password = $_ENV['EMAIL_PASSWORD'];
       
        $detail = $this->db->select('e.code_activity, dm.activity, e.nama_peserta, e.email_peserta,
        format(e.jumlah_konsumsi+e.jumlah_internet+e.jumlah_other, 0, "de_DE")  as total, (
            CASE 
                WHEN e.payment_method = "1" THEN "OVO"
                WHEN e.payment_method = "2" THEN "GOPAY"
                ELSE "Bank"
            END) AS payment_method, e.bank_name, e.transfer_receipt, e.resi_konsumsi')
        ->from('tb_event_absence e')
        ->join('absences a', 'a.code_activity = e.code_activity')
        ->join('tb_detail_monthly dm', 'dm.kode_kegiatan = e.code_activity')
        ->where('e.id', $participant_id)
        ->get()->row_array();
        $data['detail'] = $detail;
        $text = $this->load->view('template/email/participant_reimbursement', $data, true);
        $mail->setFrom('no-reply@faster.bantuanteknis.id', 'FASTER-FHI360');
        $mail->addAddress($detail['email_peserta']);
        $mail->Subject = "Reimbursement Payment";
        $mail->isHTML(true);
        $mail->Body = $text;
        $sent=$mail->send();

		if ($sent) {
			return true;
		} else {
			return false;
		}
    }

    

}
