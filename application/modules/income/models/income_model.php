<?php

Class Income_model extends CI_Model
{
    /** function that inserts new Income into the database
     * 
     * @param type $data
     */
    function insertIncome($data)
    {
        $data['user_id']= $this->session->userdata('logged_in')['id'];
        $data['active']= TRUE;
        return $this->db->insert('tbl_income', $data);
        
    }
    
    /** function that retrieves specific income if the income is provided
     * from the income else all the expense
     * 
     * @param type $income_id
     * @return type
     */
    function retrieveIncome($income_id=NULL)
    {
        if(!is_null($income_id))
            $this->db->where('id', $income_id);
        $this->db->where('active', 1);
        $query = $this->db->get('tbl_income');
        $result=$query->result_array();
        return $result;
    }
    
    /** function that deletes income when income is passed
     * 
     * @param type $income_id
     * @return type
     */
    function deleteIncome($income_id)
    {
        $this->db->where('id', $income_id);
        return $this->db->delete('tbl_income'); 
    }
 
    /** function that updates incomes row depending on id passed
     * 
     * @param type $id
     * @param type $data
     */
    function updateIncome($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tbl_income', $data); 
    }
 
}
?>