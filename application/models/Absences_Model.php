<?php
class Absences_Model extends CI_Model
{   
    protected $fillable_columns = [
        "code_activity",
        "session_title",
        "kind_of_meeting",
        "meeting_link",
        "valid_when",
        "valid_until",
        "created_by",
        "attendance_link",
        "qr_file",
    ];

    function get_activity_detail($code_activity) {
        return $this->db->select('pn.advance_number, u.username as requestor_name, DATE_FORMAT(pn.tor_approve_date, "%d %M %Y") as tor_approve_date, dm.activity, pn.tor_number,
        dm.kode_kegiatan, u.avatar, u.purpose, un.unit_name')
        ->from('tb_mini_proposal_new pn')
        ->join('tb_userapp u', 'u.id = pn.create_by')
        ->join('tb_units un', 'u.unit_id = un.id')
        ->join('tb_detail_monthly dm', 'dm.kode_kegiatan = pn.code_activity')
        ->where('pn.code_activity', $code_activity)
        ->get()->row_array();
    }

    function get_absences_by_activity_code($code_activity) {
        return $this->db->select('dm.activity, mp.advance_number, a.id as absence_id, a.*')
        ->from('absences a')
        ->join('tb_detail_monthly dm', 'dm.kode_kegiatan = a.code_activity')
        ->join('tb_mini_proposal_new mp', 'a.code_activity = mp.code_activity')
        ->where('a.code_activity', $code_activity)->get()->row_array();
    }

    function get_absences_by_id($id) {
        return $this->db->select('dm.activity, u.username as pa_name, u.purpose as pa_purpose, mp.advance_number, a.id as absence_id, a.*')
        ->from('absences a')
        ->join('tb_detail_monthly dm', 'dm.kode_kegiatan = a.code_activity')
        ->join('tb_mini_proposal_new mp', 'a.code_activity = mp.code_activity')
        ->join('tb_userapp u', 'a.created_by = u.id')
        ->where('a.id', $id)->get()->row_array();
    }

    function get_absences_by_link($link) {
        return $this->db->select('dm.activity, mp.advance_number, a.id as absence_id, a.*, DATE_FORMAT(a.valid_when, "%H:%i, %d %M %Y") as valid_when')
        ->from('absences a')
        ->join('tb_detail_monthly dm', 'dm.kode_kegiatan = a.code_activity')
        ->join('tb_mini_proposal_new mp', 'a.code_activity = mp.code_activity')
        ->where('a.attendance_link', $link)->get()->row_array();
    }

    function get_participants_by_id($absence_id) {
        return $this->db->select('id, nama_peserta, (
            CASE 
                WHEN jenis_kelamin = "1" THEN "Male"
                WHEN jenis_kelamin = "2" THEN "Female"
                ELSE "Transgender"
            END) AS jenis_kelamin, asal_layanan,email_peserta,
        payment_method, format(jumlah_konsumsi, 0, "de_DE") as jumlah_konsumsi, format(jumlah_internet, 0, "de_DE") as internet_fee,
        format(jumlah_other, 0, "de_DE") as other_fee, format(jumlah_konsumsi+jumlah_internet+jumlah_other, 0, "de_DE")  as total, 
        resi_konsumsi, ovo_number, gopay_number, bank_name, bank_number, transfer_receipt, phone_number, nama_lembaga, id as input, is_email_send')
        ->from('absence_participants')
        ->where('absence_id', $absence_id)
        ->get()->result();
    }

    function insert_absences($payload) {
        $abs_data = array_intersect_key($payload, array_flip($this->fillable_columns));
        $this->db->trans_start();
        $valid_when_date = $payload['valid_when_date'];
        $valid_when_time = $payload['valid_when_time'];
        $abs_data['valid_when'] = date("$valid_when_date $valid_when_time");
        $valid_until_date = $payload['valid_until_date'];
        $valid_until_time = $payload['valid_until_time'];
        $abs_data['valid_until'] = date("$valid_until_date $valid_until_time");
        $this->db->insert('absences', $abs_data);
        $absence_id =  $this->db->insert_id();
        $this->db->trans_complete();
        if($this->db->trans_status()) {
            return $absence_id;
        }
        return false;
    }

    function insert_attendance($payload) {
        $this->db->insert('absence_participants', $payload);
        $attendance_id =  $this->db->insert_id();
        return $attendance_id;
    }

    function update_participant_data($id, $payload) {
        $this->db->where('id', $id);
        $updated = $this->db->update('absence_participants', [
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
        ->from('absence_participants')
        ->where('id', $id)->get()->row_array();
    }

    function get_total_advance($code_activity) {
        $advances = $this->db->select('(jumlah_konsumsi+jumlah_internet+jumlah_other) as total')
        ->from('absence_participants ap')
        ->join('absences a', 'a.id = ap.absence_id')
        ->where('a.code_activity', $code_activity)->get()->result_array();
        $total = 0;
        foreach($advances as $adv) {
            $total += $adv['total'];
        }
        return $total;
    }

    function submit_payment($absence_id) {
        $total_advance = $this->db->select('sum(jumlah_other+jumlah_internet+jumlah_konsumsi) as total')
            ->get_where('absence_participants', [
                'absence_id' => $absence_id
            ])->row()->total;
        $updated = $this->db->where('id', $absence_id)
            ->update('absences', [
                'is_submitted' => 1,
                'submitted_at' => date('Y-m-d H:i:s'),
                'total_advance' => $total_advance
            ]);
        if($updated) {
            return true;
        }
        return false;
    }
}
