<?php

Class Staff_model extends CI_Model
{
    /** function that inserts new staff into the database
     * 
     * @param type $data
     */
    function insertStaff($data)
    {
        $data['user_id']= $this->session->userdata('logged_in')['id'];
        $data['active']= TRUE;
        return $this->db->insert('tbl_staff', $data);
        
    }
    
    /** function that retrieves specific staff if the staff_id is provided
     * from the staff table else all the staff
     * 
     * @param type $staff_id
     * @return type
     */
    function retrieveStaff($staff_id=NULL)
    {
        if(!is_null($staff_id))
            $this->db->where('id', $staff_id);
        $this->db->where('active', 1);
        $query = $this->db->get('tbl_staff');
        if(!is_null($staff_id))
            return $query->result_array()[0];
        return $query->result_array();
    }
    
    function retrieveStaffMetadata($staff_id)
    {
        $this->db->where('staff_id', $staff_id);
        $this->db->where('active', 1);
        $query = $this->db->get('tbl_staff_entitled');
        $result=$query->result_array();
        return $result;
    }
    
    /** function that deletes staff when staff_id is passed
     * 
     * @param type $staff_id
     * @return type
     */
    function deleteStaff($staff_id)
    {
        $this->db->where('id', $staff_id);
        return $this->db->delete('tbl_staff');  
    }
    
    /** function that updates staff row depending on id passed
     * 
     * @param type $id
     * @param type $data
     */
    function updateStaff($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tbl_staff', $data); 
    }
 
}
?>