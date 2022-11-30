<?php 


class Payment extends MY_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->model('Absences_Model', 'absences');
	}

	public function callback() {
		$data = isset($_POST['data']) ? $_POST['data'] : null;
		$token = isset($_POST['token']) ? $_POST['token'] : null;
		if($token === $_ENV['FLIP_TOKEN']) {
			$decoded_data = json_decode($data);
			$flip_id = $decoded_data['id'];
			unset($decoded_data['id']);
			$updated = $this->db->where('id', $flip_id)->update('absences_flip_payment', $decoded_data);
			if($updated) {
				$response['payload'] = $decoded_data;
				$response['success'] = true;
				$response['message'] = 'Payment process updated!';
				$status_code = 200;
			} else {
				$response['message'] = 'Something wrong, please try again later!';
				$status_code = 400;
			}
		} else {
			$response['message'] = 'Invalid token';
			$status_code = 400;
		}
		$this->send_json($response, $status_code);
	}
}