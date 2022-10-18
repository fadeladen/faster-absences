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

    function get_absences_by_activity_code($code_activity) {
        return $this->db->select('dm.activity, mp.advance_number, a.id as absence_id, a.*')->from('absences a')
        ->join('tb_detail_monthly dm', 'dm.kode_kegiatan = a.code_activity')
        ->join('tb_mini_proposal_new mp', 'a.code_activity = mp.code_activity')
        ->where('a.code_activity', $code_activity)->get()->row_array();
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

    function insert_attendance($payload) {
        $this->db->insert('tb_event_absence', $payload);
        $attendance_id =  $this->db->insert_id();
        return $attendance_id;
    }

    function update_participant_data($id, $payload) {
        $this->db->where('id', $id);
        $updated = $this->db->update('tb_event_absence', [
            $payload['field'] => $payload['value']
        ]);
        if($updated) {
            return $this->get_participant_data_by_id($id);
        }
        return false;
    }

    function get_participant_data_by_id($id) {
        return $this->db->select('format(jumlah_konsumsi, 0, "de_DE") as jumlah_konsumsi, format(jumlah_internet, 0, "de_DE") as jumlah_internet,
        format(jumlah_other, 0, "de_DE") as jumlah_other, format(jumlah_konsumsi+jumlah_internet+jumlah_other, 0, "de_DE")  as total, resi_konsumsi, transfer_receipt')
        ->from('tb_event_absence')
        ->where('id', $id)->get()->row_array();
    }
}
