<?php
if (!function_exists('get_status_text')) {
    function get_status_text($reimbursement_id)
    {   
        $ci = &get_instance();
        $status = $ci->db->select('supervisor_status as s, budget_reviewer_status as br, finance_status as f')
        ->from('m_reimbursement_status')
        ->where('reimbursement_id', $reimbursement_id)
        ->get()->row_array();
        $color = 'dark';
        if($status['s'] == 3 || $status['br'] == 3) {
            $status_text = 'Rejected';
            $color = 'danger';
        } else if($status['s'] == 1 && $status['br'] == 1 && $status['f'] == 1) {
            $status_text = 'Sent to supervisor';
        }  else if($status['s'] == 2 && $status['br'] == 1 && $status['f'] == 1) {
            $status_text = 'Approved by supervisor';
        } else if($status['s'] == 2 && $status['br'] == 2 && $status['f'] == 1) {
            $status_text = 'Approved by budget reviewer';
        } else if($status['s'] == 2 && $status['br'] == 2 && $status['f'] == 2) {
            $status_text = 'Done';
            $color = 'success';
        }
        return "<span class='badge bg-$color'>$status_text</span>" ;
    }
}

if (!function_exists('is_expired_request')) {
    function is_expired_request($reimbursement_id, $level)
    {   
        $ci = &get_instance();
        $status = $ci->db->select('supervisor_status as s, budget_reviewer_status as br, finance_status as f')
        ->from('m_reimbursement_status')
        ->where('reimbursement_id', $reimbursement_id)
        ->get()->row_array();
        $expired = false;
        if($level == 'supervisor' ) {
            if($status['s'] != 1) {
                $expired = true;
            }
        } 
        if($level == 'budget_reviewer' ) {
            if($status['br'] != 1) {
                $expired = true;
            }
        }
        return $expired;
    }
}

if (!function_exists('is_rejected')) {
    function is_rejected($reimbursement_id)
    {   
        $ci = &get_instance();
        $request = $ci->db->select('supervisor_status, budget_reviewer_status')
        ->from('m_reimbursement_status')
        ->where('reimbursement_id', $reimbursement_id)
        ->get()->row_array();
        $rejected = false;
        if($request['budget_reviewer_status'] == 3 || $request['supervisor_status'] == 3) {
            $rejected = true;
        }
        return $rejected;
    }
}