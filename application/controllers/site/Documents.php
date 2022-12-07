<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
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
        // $absence_id = decrypt($absence_id);

        $detail = $this->absences->get_absences_by_id($absence_id);
        $participants = $this->absences->get_participants_by_id($absence_id);
        $data = [
            'detail' => $detail,
            'participants' => $participants,
        ];
        // echo json_encode($data);
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $html2pdf = new \Spipu\Html2Pdf\Html2Pdf('L', 'A4', 'en', true, 'UTF-8', array(5, 5, 5, 5));
		$html = $this->load->view('template/participant_lists', $data, TRUE);
		$html2pdf->setTestTdInOnePage(false);
        $html2pdf->setDefaultFont('arial');
		$html2pdf->writeHTML($html);
        $html2pdf->pdf->SetDisplayMode('fullpage');
		$file_name = 'Attendance_List_' . now() .'.pdf';
        $html2pdf->output($file_name, 'I');
    }

    public function qrcode($absence_id)
    {
        $absence_id = decrypt($absence_id);
        $data['detail'] = $this->absences->get_absences_by_id($absence_id);
        $html2pdf = new \Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en', true, 'UTF-8', array(5, 5, 5, 5));
		$html = $this->load->view('template/qrcode', $data, TRUE);
		$html2pdf->setTestTdInOnePage(false);
		$html2pdf->writeHTML($html);
        $html2pdf->pdf->SetDisplayMode('fullpage');
		$file_name = 'QRCODE_' . now() .'.pdf';
        $html2pdf->output($file_name, 'I');
    }

    public function blank_absence($absence_id) {
        $absence_id = decrypt($absence_id);
        $detail = $this->absences->get_absences_by_id($absence_id);
		$inputFileName = FCPATH.'assets/docs_template/blank_absence.xlsx';
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet = $reader->load($inputFileName);
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('C2', $detail['activity']);
		$sheet->setCellValue('C3', $detail['activity_date']);
		$sheet->setCellValue('C5', $detail['requestor_name']);
		$sheet->setCellValue('C6', $detail['pa_name']);
		$writer = new Xlsx($spreadsheet);
        $current_time = date('d-m-Y h:i:s');
        $filename = "Daftar Kehadiran/$current_time";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=$filename.xlsx");
        $writer->save('php://output');
    }
}
