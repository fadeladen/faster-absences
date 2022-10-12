<?php
class Absences_Model extends CI_Model
{   
    protected $fillable_columns = [
        "code_activity",
        "kind_of_meeting",
        "start_date",
        "end_date",
        "meeting_link",
        "valid_until",
        "created_by",
    ];

    function get_absences_by_activity_code($activity_code) {
        return $this->db->select('b.activity, a.*')->from('absences');
    }

    function insert_absences($payload) {
        $abs_data = array_intersect_key($payload, array_flip($this->fillable_columns));
        $this->db->trans_start();
        $valid_date = $payload['valid_date'];
        $valid_time = $payload['valid_time'];
        $abs_data['valid_until'] = date("$valid_date $valid_time");
        $this->db->insert('absences', $abs_data);
        $absence_id =  $this->db->insert_id();
        $this->db->trans_complete();
        if($this->db->trans_status()) {
            return $absence_id;
        }
        return false;

    }
}
