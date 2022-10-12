<?php
class Absences_Model extends CI_Model
{   
    protected $fillable_columns = [
        "activity_code",
        "unit_id",
        "source_fund_id",
        "location_id",
        "month",
        "year",
        "total_amount",
        "created_by",
    ];

    function get_absences_by_activity_code($activity_code) {
        return $this->db->select('b.activity, a.*')->from('absences');
    }

    function insert_absences($payload) {
        $r_data = array_intersect_key($payload, array_flip($this->fillable_columns));
        $this->db->trans_start();
        $this->db->insert('m_reimbursement', $r_data);
        $reimbursement_id =  $this->db->insert_id();

        $item_id = $payload['item_id'];
        for($x=0;$x < count($item_id);$x++) {
            $this->db->insert('m_reimbursement_items', [
                'reimbursement_id' => $reimbursement_id,
                'item_id' => $payload['item_id'][$x],
                'amount' => $payload['amount'][$x],
                'file' => $payload['file'][$x],
            ]);
        }

        $this->db->insert('m_reimbursement_status', [
            'reimbursement_id' => $reimbursement_id,
            'supervisor_id' => $payload['supervisor_id'],
            'budget_reviewer_id' => $payload['budget_reviewer_id'],
        ]);

        $this->db->trans_complete();
        if($this->db->trans_status()) {
            return $reimbursement_id;
        }
        return false;

    }
}
