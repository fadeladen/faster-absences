<?php


class Base_Model extends CI_Model
{

    function get_projects() {
        return $this->db->select('*')
        ->from('tb_project')
        ->get()->result_array();
    }

    function get_units() {
        return $this->db->select('*')
        ->from('tb_units')
        ->get()->result_array();
    }

    function get_head_of_unit($user_id) {
        return $this->db->select('u.id, u.username, u.email, u.purpose, u.avatar')
        ->from('tb_pr_approver pr')
        ->join('tb_userapp u', 'u.id = pr.kepala_unit_id')
        ->join('tb_pr_approver_members pm', 'pm.pr_approver_id = pr.id')
        ->where('pm.member_id', $user_id)
        ->get()->result_array();
    }

    function get_line_supervisor($user_id) {
        return $this->db->select('u.id, u.username, u.email, u.purpose, u.avatar')
        ->from('tb_pr_approver pr')
        ->join('tb_pr_approver_supervisor prs', 'pr.id = prs.pr_approver_id')
        ->join('tb_userapp u', 'u.id = prs.supervisor_id')
        ->where('pr.kepala_unit_id', $user_id)
        ->get()->result_array();
    }

    function get_country_director() {
        return $this->db->select('id, username, email, signature')
        ->from('tb_userapp')
        ->where('is_country_director', 1)
        ->get()->row_array();
    }

    function get_fco_monitor() {
        return $this->db->select('id, username, email')
        ->from('tb_userapp')
        ->where('is_budget_reviewer', 1)
        ->get()->row_array();
    }

    function get_tor_approver() {
        return $this->db->select('id, username, email')
        ->from('tb_userapp')
        ->where('is_tor_approver', 1)
        ->get()->row_array();
    }

    function get_procurement_officer() {
        return $this->db->select('id, username, email')
        ->from('tb_userapp')
        ->where('is_procurement_officer', 1)
        ->get()->result_array();
    }

    function get_hrd() {
        return $this->db->select('id, username, email')
        ->from('tb_userapp')
        ->where('role', 'HRD')
        ->get()->result_array();
    }

    function get_finance_teams() {
        return $this->db->select('id, username, email')
        ->from('tb_userapp')
        ->where('unit_id', 3)
        ->get()->result_array();
    }

    function get_cities() {
        return $this->db->select('*')
        ->from('tb_wilayah_kabupaten')
        ->order_by('nama', 'asc')
        ->get()->result_array();
    }

    function get_tor_number() {
        $data = $this->db->select('m.tor_number, d.activity')
		->from('tb_mini_proposal_new m')
		->join('tb_detail_monthly d', 'm.code_activity = d.kode_kegiatan')
		->group_by('m.tor_number')
		->get()->result_array();
        return $data;
    }

    function get_locations() {
        return $this->db->select('*')->get('tb_project_location')->result_array();
    }

    function get_current_user_location($user_id) {
        return $this->db->select('u.loca_id, l.loca_province, l.loca_district')->from('tb_userapp u')
        ->join('tb_project_location l', 'u.loca_id = l.loca_id')
        ->where('id', $user_id)->get()->row_array();
    }
}
