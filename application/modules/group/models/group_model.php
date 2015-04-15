<?php

Class Group_model extends CI_Model
{
    /** function that inserts new group into the database
     * 
     * @param type $data
     */
    function insertGroup($data)
    {
        $data['user_id']= $this->session->userdata('logged_in')['id'];
        $data['active']= TRUE;
        return $this->db->insert('tbl_group', $data);
        
    }
    
    /** function that retrieves specific group if the teacher_id is provided
     * from the teachers table else all the teachers
     * 
     * @param type $group_id
     * @return type
     */
    function retrieveGroup($group_id=NULL)
    {
        if(!is_null($group_id))
            $this->db->where('id', $teacher_id);
        $this->db->where('active', 1);
        $query = $this->db->get('tbl_group');
        $result=$query->result_array();
        return $result;
    }
    
    /** function that deletes group when group_id is passed
     * 
     * @param type $group_id
     * @return type
     */
    function deleteGroup($group_id)
    {
        $this->db->where('id', $group_id);
        return $this->db->update('tbl_group', array('active'=>FALSE)); 
    }
    
    /** function that updates group row depending on id passed
     * 
     * @param type $id
     * @param type $data
     */
    function updateGroup($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tbl_group', $data); 
    }
 
}
?>