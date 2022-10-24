<?php

if (!function_exists('absence_action_btn')) {
    function absence_action_btn($code_activity)
    {   
        $ci = &get_instance();
        $absences = $ci->db->select('*')
        ->from('absences')
        ->where('code_activity', $code_activity)
        ->get()->row_array();
        $disabled = '';
        $link = '';
        if($absences) {
            $disabled = 'disabled';
            $link =         '<button data-id="'.$code_activity.'" class="btn btn-sm mt-2 btn-outline-dark btn-copy-link">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-paperclip" viewBox="0 0 16 16">
										<path
											d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z" />
									</svg>
									Copy link
							</button>';
        }
        return '<div class="d-flex flex-column"> 
                        <button '.$disabled.' data-id="'.$code_activity.'" class="btn btn-sm btn-primary btn-create">Attendant List</button>
                        '.$link.'
                </div>';
    }
}

if (!function_exists('absence_session_badge')) {
    function absence_session_badge($id)
    {   
        $ci = &get_instance();
        $absences = $ci->db->select('valid_when, valid_until')
        ->from('absences')
        ->where('id', $id)
        ->get()->row_array();
        $now = date('Y-m-d H:i:s');   
        if($now > $absences['valid_when'] && $now < $absences['valid_until']) {
            $status = 'Active';
            $color = 'cb-success';
        } else if ($now > $absences['valid_until'])  {
            $status = 'Expired'; 
            $color = 'cb-danger';
        } else if($now < $absences['valid_when']) {
            $status = 'Coming';
            $color = 'cb-warning';
        }
        return "<div class='mt-3'><span class='custom-badge $color'>$status</span></div>";
    }
}

if (!function_exists('absence_session_status')) {
    function absence_session_status($id)
    {   
        $ci = &get_instance();
        $absences = $ci->db->select('valid_when, valid_until')
        ->from('absences')
        ->where('id', $id)
        ->get()->row_array();
        $now = date('Y-m-d H:i:s');   
        if($now > $absences['valid_when'] && $now < $absences['valid_until']) {
            $status = 'Active';
        } else if ($now > $absences['valid_until'])  {
            $status = 'Expired'; 
        } else if($now < $absences['valid_when']) {
            $status = 'Coming';
        }
        return $status;
    }
}

if (!function_exists('total_expired_absences')) {
    function total_expired_absences($code_activity)
    {   
        $ci = &get_instance();
        $absences = $ci->db->select('valid_when, valid_until, kind_of_meeting')
        ->from('absences a')
        ->where('code_activity', $code_activity)
        ->get()->result_array();
        $now = date('Y-m-d H:i:s');
        $total = 0;   
        foreach($absences as $abs) {
            if($now > $abs['valid_until'] && $abs['kind_of_meeting'] != 2) {
                $total += 1;
            }
        }
        return $total;
    }
}

if (!function_exists('count_absences')) {
    function count_absences($code_activity)
    {   
        $ci = &get_instance();
        $total_absence = $ci->db->select('count(id) as total')->from('absences')->where('code_activity', $code_activity)->get()->row()->total;
        return $total_absence;
    }
}