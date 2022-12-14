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

    public function detail($code_activity) {

        $detail = $this->absences->get_activity_detail($code_activity);
        $total_absence = $this->db->select('count(id) as total')->from('absences')->where('code_activity', $code_activity)->get()->row()->total;
        $detail['total_absences'] = $total_absence;
        $total_advance = $this->absences->get_total_advance($code_activity);
        $detail['total_advance'] = number_format($total_advance,0,'','.');
        $total_submitted = $this->absences->get_total_submitted_advance($code_activity);
        $detail['total_submitted'] = number_format($total_submitted,0,'','.');
        $data['detail'] = $detail;
		$this->template->set('page', 'Absences detail');
        $this->template->render('absences/detail', $data);
	}

    public function create() {
        if ($this->input->is_ajax_request()) {
			$data['activity_code'] = $this->input->get('activity_code');
            $link = $this->generate_link();
            $data['attendance_link'] = $link;
            $data['qr_file'] = $link . '.png';
			$this->load->view('absences/create_modal', $data);
		} else {
			show_404();
		}
    }

    public function session_datatable($code_activity)
    {	
        $this->datatable->select('abs.id, abs.session_title, DATE_FORMAT(abs.valid_when, "%d-%m-%Y %H:%i") as valid_when,
        abs.id as status, abs.is_submitted as payment_status, abs.attendance_link, abs.id as absence_id, DATE_FORMAT(abs.valid_until, "%d-%m-%Y %H:%i"),
        abs.id as enc_id, abs.kind_of_meeting');
        $this->datatable->from('absences abs');
        $this->datatable->where('code_activity', $code_activity);
        $this->datatable->edit_column('status', '$1', 'absence_session_badge(status)');
        $this->datatable->edit_column('enc_id', '$1', 'encrypt(enc_id)');
        echo $this->datatable->generate();
    }

	public function datatable()
    {	
        $program_assistance_df_number = ["1"];

		if ($this->user_data->roles === 'OPERATION') {
			$program_assistance = $this->db->get_where('tb_program_assistance', [
				'user_id' => $this->user_data->userId
			])->result();

			foreach($program_assistance as $pa) {
				$program_assistance_df_number[] = $pa->direct_fund_code;
			}

		}
        $this->datatable->select('pn.advance_number, u.username, DATE_FORMAT(pn.tor_approve_date, "%d %M %Y") as approve_date, dm.activity, dm.kode_kegiatan as action, pn.tor_number,
        dm.kode_kegiatan, u.avatar, u.purpose, un.unit_name');
        $this->datatable->from('tb_mini_proposal_new pn');
        $this->datatable->join('tb_userapp u', 'u.id = pn.create_by');
        $this->datatable->join('tb_units un', 'u.unit_id = un.id');
        $this->datatable->join('tb_detail_monthly dm', 'dm.kode_kegiatan = pn.code_activity');
        $this->datatable->join('absences abs', 'dm.kode_kegiatan = abs.code_activity');
        $this->datatable->where('pn.status_finance', '1');
        // $this->datatable->where_in('pn.direct_fund_code', $program_assistance_df_number);
        // $this->datatable->where("dm.year = '".date('Y')."' and (dm.month IN('" . date('n') . "','" . (date('n') + 1) . "') OR dm.month_postponse IN('" . date('n') . "','" . (date('n') + 1) . "') )");

        echo $this->datatable->generate();
    }

    public function participants_datatable($absence_id)
    {
        $this->datatable->select('ap.id, ap.nama_peserta, (
            CASE 
                WHEN ap.jenis_kelamin = "1" THEN "Male"
                WHEN ap.jenis_kelamin = "2" THEN "Female"
                ELSE "Transgender"
            END) AS jenis_kelamin, ap.asal_layanan, ap.email_peserta,
        ap.payment_method, format(ap.jumlah_konsumsi, 0, "de_DE") as jumlah_konsumsi, format(ap.jumlah_internet, 0, "de_DE") as internet_fee,
        format(ap.jumlah_other, 0, "de_DE") as other_fee, format(ap.jumlah_konsumsi+ap.jumlah_internet+ap.jumlah_other, 0, "de_DE")  as total, 
        ap.resi_konsumsi, ap.ovo_number, ap.gopay_number, ap.bank_name, ap.bank_number, ap.transfer_receipt, ap.phone_number, ap.nama_lembaga, ap.id as input, ap.is_email_send, ap.absence_id, fp.status as flip_status');
        $this->datatable->from('absence_participants ap');
        $this->datatable->join('absences_flip_payment fp', 'fp.id = ap.flip_id', 'LEFT');
        $this->datatable->where('absence_id', $absence_id);
        echo $this->datatable->generate();
    }

    public function store() {
		$this->form_validation->set_rules('kind_of_meeting', 'Kind of meeting', 'required');
        $this->form_validation->set_rules('session_title', 'Meeting link', 'required');
        $this->form_validation->set_rules('valid_until_date', 'When date', 'required');
        $this->form_validation->set_rules('valid_until_time', 'When time', 'required');
        $this->form_validation->set_rules('valid_when_date', 'Until date', 'required');
        $this->form_validation->set_rules('valid_when_time', 'Until time', 'required');
		$this->form_validation->set_rules('qr_file', 'QR File', 'required');
		$kind_of_meeting = $this->input->post('kind_of_meeting');
		if($kind_of_meeting == '1' || $kind_of_meeting == '3') {
			$this->form_validation->set_rules('meeting_link', 'Meeting link', 'required');
		}

		if ($this->form_validation->run()) {
			$payload = $this->input->post();
            $payload['created_by'] = $this->user_data->userId;
            $saved = $this->absences->insert_absences($payload);
            if($saved) {
                $response['payload'] = $payload;
                $response['success'] = true;
                $response['message'] = 'Session has been created!';
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
            $absence_id = $this->input->get('absence_id');
            $data['detail'] = $this->absences->get_absences_by_id($absence_id);
            $data['total'] = $this->db->select('format(sum(jumlah_konsumsi), 0, "de_DE") as total_konsumsi,
            format(sum(jumlah_internet), 0, "de_DE") as total_internet, format(sum(jumlah_other), 0, "de_DE") as total_other,
            format(sum(jumlah_other+jumlah_internet+jumlah_konsumsi), 0, "de_DE") as total')
            ->get_where('absence_participants', [
                'absence_id' => $absence_id
            ])->row_array();
            $this->load->view('absences/participants_modal', $data);
        } else {
            show_404();
        }
    }

    public function get_total_participants_reimbursement($absence_id) {
        if ($this->input->is_ajax_request()) {
            $data = $this->db->select('format(sum(jumlah_konsumsi), 0, "de_DE") as total_konsumsi,
            format(sum(jumlah_internet), 0, "de_DE") as total_internet, format(sum(jumlah_other), 0, "de_DE") as total_other,
            format(sum(jumlah_other+jumlah_internet+jumlah_konsumsi), 0, "de_DE") as total')
            ->get_where('absence_participants', [
                'absence_id' => $absence_id
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
            $updated = $this->db->where('id', $participant_id)->update('absence_participants', ['is_email_send' => 1]);
            if($updated) {
                $sent = $this->send_email_to_participant($participant_id);
                if($sent) {
                    $response['message'] = 'Email has been sent to participant!';
                    $status_code = 200;
                } else {
                    $this->db->where('id', $participant_id)->update('absence_participants', ['is_email_send' => 0]);
                    $response['message'] = 'Failed to sending email, please check your connection and try again!';
                    $status_code = 400;
                }
            } else {
                $this->db->where('id', $participant_id)->update('absence_participants', ['is_email_send' => 0]);
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
       
        $detail = $this->db->select('a.code_activity, dm.activity, e.nama_peserta, e.email_peserta,
        format(e.jumlah_konsumsi+e.jumlah_internet+e.jumlah_other, 0, "de_DE")  as total, (
            CASE 
                WHEN e.payment_method = "1" THEN "OVO"
                WHEN e.payment_method = "2" THEN "GOPAY"
                ELSE "Bank"
            END) AS payment_method, e.bank_name, e.transfer_receipt, e.resi_konsumsi')
        ->from('absence_participants e')
        ->join('absences a', 'a.id = e.absence_id')
        ->join('tb_detail_monthly dm', 'dm.kode_kegiatan = a.code_activity')
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

    public function submit_payment($absence_id) {
        if ($this->input->is_ajax_request()) {
            $updated = $this->absences->submit_payment($absence_id);
            if($updated) {
                $response['message'] = 'Data anda sudah terkirim, system sedang melakukan proses generate laporan pdf rekapitulasi, maksimal butuh waktu 2 jam untuk menyelesaikannya!';
                $status_code = 200;
            } else {
                $response['message'] = 'Something went wrong, please try again later!';
                $status_code = 400;
            }
            $this->send_json($response, $status_code);
        } else {
            show_404();
        }
    }

    public function qrcode($attendance_link) {
        $size = $this->input->get('size');
        if(!$size || $size == '') {
            $size = 7;
        }
        $code = base_url('site/absences/form/' . $attendance_link);
        $this->load->library('ciqrcode');
        QrCode::png(
            $code,
            false,
            QR_ECLEVEL_H,
            $size,
            2
        );
    }

    public function save_qrcode($attendance_link) {
        if ($this->input->is_ajax_request()) {
            $code = base_url('site/absences/form/' . $attendance_link);
            $this->load->library('ciqrcode');
            if (!is_dir('assets/images/qrcode')) {
                mkdir('./assets/images/qrcode', 0777, TRUE);
            }
            $path = FCPATH . 'assets/images/qrcode/' . $attendance_link . '.png';
            QrCode::png(
                $code,
                $path,
                QR_ECLEVEL_H,
                7,
                2
            );
        } else {
            show_404();
        }
    }

    public function get_current_advance_and_absences($code_activity) {
        if ($this->input->is_ajax_request()) {
            $total_advance = $this->absences->get_total_advance($code_activity);
            $total_absence = $this->db->select('count(id) as total')->from('absences')->where('code_activity', $code_activity)->get()->row()->total;
            $response['data'] = [
                'total_advance' => number_format($total_advance,0,'.','.'),
                'total_absence' => $total_absence,
            ];
            $response['success'] = true;
            $status_code = 200;
            $this->send_json($response, $status_code);
        } else {
            show_404();
        }
    }

    public function flip_payment($participant_id) {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $ch = curl_init();
            $secret_key = $_ENV['FLIP_SECRET'];
            $timestamp = date('c', time());
            $detail = $this->db->select('nama_peserta, email_peserta, bank_code, bank_number, (jumlah_konsumsi+jumlah_internet+jumlah_other) as amount, idempotency_key')
            ->from('absence_participants')->where('id', $participant_id)->get()->row_array();
            $idom = $detail['idempotency_key'];
            curl_setopt($ch, CURLOPT_URL, "https://bigflip.id/big_sandbox_api/v2/disbursement");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);

            $payloads = [
                "account_number" => $detail['bank_number'],
                "bank_code" => $detail['bank_code'],
                "amount" => $detail['amount'] + 0,
                "remark" => "Absensi",
                "beneficiary_email" => $detail['email_peserta'],
            ];

            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payloads));

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/x-www-form-urlencoded",
            "idempotency-key: $idom",
            "X-TIMESTAMP: $timestamp"
            ));

            curl_setopt($ch, CURLOPT_USERPWD, $secret_key.":");
            $res = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if($httpcode == 200) {
                $payload = json_decode($res);
                $saved = $this->absences->save_flip_payment($participant_id, $payload);
                if($saved) {
                    $response['payload'] = $payload;
                    $response['success'] = true;
                    $response['message'] = 'Payment in process!';
                    $status_code = 200;
                } else {
                    $response['message'] = 'Something wrong, please try again later!';
                    $status_code = 400;
                }
            } else {
                $response['message'] = 'Something wrong, please try again later!';
                $status_code = 400;
            }
            $this->send_json($response, $status_code);
         } else {
            show_404();
         }
    }

    // public function insert_old_data() {
    //     $data = $this->db->select('a.*, d.create_date as created_at')->from('tb_event_absence a')
    //     ->join('tb_detail_monthly d', 'd.kode_kegiatan = a.code_activity', 'LEFT')
    //     ->group_by('code_activity')
    //     ->get()->result_array();
    //     foreach($data as $event) {
    //         $this->db->insert('absences',[
    //             'code_activity' => $event['code_activity'],
    //             'session_title' => 'Sesi 1',
    //             'kind_of_meeting' => 1,
    //             'valid_when' => $event['created_at'],
    //             'valid_until' => $event['created_at'],
    //             'created_at' => $event['created_at'],
    //             'kind_of_meeting' => 1,
    //             'attendance_link' =>  $this->generate_link()
    //         ]);
    //         $absence_id =  $this->db->insert_id();
    //         $participants = $this->db->select('a.*, d.create_date as created_at')->from('tb_event_absence a')
    //         ->join('tb_detail_monthly d', 'd.kode_kegiatan = a.code_activity', 'LEFT')
    //         ->where('code_activity', $event['code_activity'])
    //         ->get()->result_array();
    //         foreach($participants as $participant) {
    //             $bank_number = $participant['bank_number'];
    //             $bank_name = $participant['bank_name'];
    //             $payment_method = 3;
    //             $bank_code = '';
    //             if($participant['ovo_number'] != '') {
    //                 $bank_number = $participant['ovo_number'];
    //                 $bank_name = 'OVO';
    //                 $bank_code= 'ovo';
    //                 $payment_method = 1;
    //             } else if($participant['gopay_number'] != '') {
    //                 $bank_number = $participant['gopay_number'];
    //                 $bank_name = 'GoPay';
    //                 $payment_method = 2;
    //                 $bank_code= 'gopay';
    //             }
    //             $saved = $this->db->insert('absence_participants',[
    //                 'absence_id' => $absence_id,
    //                 'tujuan_pengisian' => 2,
    //                 'nama_peserta' => $participant['nama_peserta'],
    //                 'jenis_kelamin' => $participant['jenis_kelamin'],
    //                 'asal_layanan' => $participant['asal_layanan'],
    //                 'email_peserta' => $participant['email_peserta'],
    //                 'nama_lembaga' => $participant['nama_lembaga'],
    //                 'resi_konsumsi' => $participant['resi_konsumsi'],
    //                 'phone_number' => $participant['phone_number'],
    //                 'is_email_send' => $participant['is_email_send'],
    //                 'jumlah_konsumsi' => $participant['jumlah_reimburesment'],
    //                 'jumlah_internet' => $participant['jumlah_internet'],
    //                 'jumlah_other' => $participant['jumlah_other'],
    //                 'payment_method' => $payment_method,
    //                 'bank_name' => $bank_name,
    //                 'bank_number' => $bank_number,
    //                 'bank_code' => $bank_code,
    //                 'is_old_data' => 1,
    //             ]);
    //         }
    //     }
    //     if($saved) {
    //         echo 'saved';
    //     } else {
    //         echo "fail";
    //     }
    // }

}
