<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class MY_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    function verifyToken() {
        $this->load->helper('cookie');
        $token = get_cookie('fast_token');
        if (!$token) {
            return false;
        } else {
            $key = $_ENV['SECRET_KEY'];
            $user_data = JWT::decode($token, new Key($key, 'HS256'));
            $this->user_data = $user_data;
            return true;
        }
    }

    function send_json($data, $status_code = 200)
    {
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code)
            ->set_output(json_encode(array_merge($data, ['code' => $status_code])));
    }

    
    function generate_link() {
        $id = $this->db->select('id')->from('absences')->order_by('id', 'desc')->get()->row()->id;
        $id += 1;
        $link = encrypt($id);
        $link = substr($link,0,5) . now();
        return $link;
    }

    function send_reimbursement_email($reimbursement_id, $target, $level, $email_text, $need_confirm = true) {
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
        $detail = $this->reimbursement->get_reimbursment_by_id($reimbursement_id);
		$data = [
			'level' => $level,
			'need_confirm' => $need_confirm,
			'reimbursement_id' => $reimbursement_id,
			'email_text' => $email_text, 
			'target' => $target, 
            'detail' => $detail,
			'items' => $this->reimbursement->get_reimbursment_items($reimbursement_id),
		];
        $text = $this->load->view('template/email/reimbursement', $data, true);
        $mail->setFrom('no-reply@faster.bantuanteknis.id', 'FASTER-FHI360');
        $mail->addAddress($target['email']);
        $mail->Subject = "Monthly Reimbursement Request";
        $mail->isHTML(true);
        $mail->Body = $text;
        $sent=$mail->send();

		if ($sent) {
			return true;
		} else {
			return false;
		}
    }

    function reimbursement_items_modal() {
		if ($this->input->is_ajax_request()) {
			$reimbursement_id = $this->input->get('reimbursement_id');
			$data['items'] = $this->reimbursement->get_reimbursment_items($reimbursement_id);
			$this->load->view('monthly_reimbursement/v_modal/item_details', $data);
		} else {
			show_404();
		}
	}
}