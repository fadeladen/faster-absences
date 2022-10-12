<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Documents extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('Base_Model');
		$this->load->model('M_reimbursement_Model', 'reimbursement');
		$this->template->set_default_layout('layouts/blank');
	}

	public function payment_request_reimbursement($reimbursement_id) {
		$reimbursement_id = decrypt($reimbursement_id);
		$detail = $this->reimbursement->get_reimbursment_by_id($reimbursement_id);
		if($detail) {
			$data['detail'] = $detail;
			$data['items'] = $this->reimbursement->get_reimbursment_items($reimbursement_id);
			$requestor_signature = extractImageFromAPI($detail['requestor_signature']);
			$image_name =  $requestor_signature['image_name'];
			if($image_name == 'signature_not_found.jpg') {
				$requestor_signature['signature_path'] = "assets/images/$image_name";
			} else {
				$requestor_signature['signature_path'] = $requestor_signature['image_path'];
			}	
			$data['requestor_signature'] = $requestor_signature;
			// If budget reviewer approve
			$budget_reviewer_signature = extractImageFromAPI($detail['budget_reviewer_signature']);
			if($detail['budget_reviewer_status'] == 2) {
				$image_name =  $budget_reviewer_signature['image_name'];
				if($image_name == 'signature_not_found.jpg') {
					$budget_reviewer_signature['signature_path'] = "assets/images/$image_name";
				} else {
					$budget_reviewer_signature['signature_path'] = $budget_reviewer_signature['image_path'];
				}
			} else {
				$budget_reviewer_signature['signature_path'] = "assets/images/white-blank.jpg";
			}
			$data['budget_reviewer_signature'] = $budget_reviewer_signature;
			$html2pdf = new \Spipu\Html2Pdf\Html2Pdf('P', [210, 330], 'en', true, 'UTF-8', array(15, 10, 15, 10));
			$html = $this->load->view('template/payment_request', $data, TRUE);
			$html2pdf->setTestTdInOnePage(false);
			$html2pdf->writeHTML($html);
			$file_name = 'Reimbursement_Payment_Request_'.$detail['requestor_name']. '_' . now() .'.pdf';
			$html2pdf->output($file_name);	
			delete_signature();
		} else {
			show_404();
		}
	}
}
