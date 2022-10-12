<?php 


class Base_data extends MY_Controller {

    function get_projects () {

        $this->db
        ->from('tb_project')
        ->where('trash', 0);
        

        if ($this->input->get('select2')) {
            $this->db->select('project_id as id, project_name as text');
        }
        if ($this->input->get('q')) {
            $this->db->like('project_name', $this->input->get('q'));
        }

        $response['result'] = $this->db->get()->result();
        $this->send_json($response);
    }

    function get_users () {

        $this->db
        ->from('tb_userapp');

        if ($this->input->get('select2')) {
            $this->db->select('id as id, username as text');
        }
        if ($this->input->get('q')) {
            $this->db->like('username', $this->input->get('q'));
        }

        $response['result'] = $this->db->get()->result();
        $this->send_json($response);
    }

    function get_source_fund_by_project_id ($project_id) {

        $this->db
        ->from('tb_source_fund')
        ->where('project_id', $project_id);

        if ($this->input->get('select2')) {
            $this->db->select('fund_id as id, source_fund as text');
        }
        if ($this->input->get('q')) {
            $this->db->like('source_fund', $this->input->get('q'));
        }

        $response['result'] = $this->db->get()->result();
        $this->send_json($response);
    }

    function get_units_by_project_id ($project_id) {

        $this->db
        ->from('tb_units')
        ->where('project_id', $project_id);

        if ($this->input->get('select2')) {
            $this->db->select('id as id, unit_name as text');
        }

        if ($this->input->get('q')) {
            $this->db->like('unit_name', $this->input->get('q'));
        }

        $response['result'] = $this->db->get()->result();
        $this->send_json($response);
    }
}