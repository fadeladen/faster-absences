<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Documents extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('Base_Model');
		$this->load->model('Base_Model');
		$this->load->model('Absences_Model', 'absences');
		$this->template->set_default_layout('layouts/blank');
	}

	public function participants_list_by_session($absence_id)
    {
        $absence_id = decrypt($absence_id);

        $detail = $this->absences->get_absences_by_id($absence_id);
        $participants = $this->absences->get_participants_by_id($absence_id);
        $data = [
            'detail' => $detail,
            'participants' => $participants,
        ];
        // $this->load->view('template/participant_lists', $data);
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $html2pdf = new \Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en', true, 'UTF-8', array(5, 5, 5, 5));
		$html = $this->load->view('template/participant_lists', $data, TRUE);
		$html2pdf->setTestTdInOnePage(false);
        $html2pdf->setDefaultFont('arial');
		$html2pdf->writeHTML($html);
        $html2pdf->pdf->SetDisplayMode('fullpage');
		$file_name = 'Attendance_List_' . now() .'.pdf';
        $html2pdf->output($file_name, 'I');
    }
}
