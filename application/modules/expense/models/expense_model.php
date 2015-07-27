<?php

Class Expense_model extends CI_Model
{
    /** function that inserts new teacher into the database
     * 
     * @param type $data
     */
    function insertExpense($data)
    {
        $data['user_id']= $this->session->userdata('logged_in')['id'];
        $data['active']= TRUE;
        return $this->db->insert('tbl_expense', $data);
        
    }
    
    /** function that retrieves specific expense if the expense is provided
     * from the expense else all the expense
     * 
     * @param type $expense_id
     * @return type
     */
    function retrieveExpense($expense_id=NULL,$limit=NULL,$start=NULL)
    {
        if(!is_null($expense_id))
            $this->db->where('id', $expense_id);
        else
            $this->db->limit($limit, $start);
        $this->db->where('active', 1);
        $query = $this->db->get('tbl_expense');
        $result=$query->result_array();
        if(!is_null($expense_id))
            return $result[0];
        return $result;
    }
    
    /** function that retrieves total no of expenses
     * 
     * @return int no of expenses
     */
    function retrieveExpenseNumber()
    {
        $this->db->where('active', 1);
        $query = $this->db->get('tbl_expense');
        return  $query->num_rows();
    }
    
    /** function that deletes expense when expense is passed
     * 
     * @param type $expense_id
     * @return type
     */
    function deleteExpense($expense_id)
    {
        $this->db->where('id', $expense_id);
        return $this->db->delete('tbl_expense'); 
    }
 
    /** function that updates expense row depending on id passed
     * 
     * @param type $id
     * @param type $data
     */
    function updateExpense($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tbl_expense', $data); 
    }
 
}
?>