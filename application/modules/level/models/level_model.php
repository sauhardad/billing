<?php

Class Level_model extends CI_Model
{
    /** function that inserts new level into the database
     * 
     * @param type $data
     */
    function insertLevel($data)
    {
        $data['user_id']= $this->session->userdata('logged_in')['id'];
        $data['active']= TRUE;
        return $this->db->insert('tbl_level', $data);
        
    }
    
    /** function that retrieves specific level if the teacher_id is provided
     * from the teachers table else all the teachers
     * 
     * @param type $level_id
     * @return type
     */
    function retrieveLevel($level_id=NULL)
    {
        if(!is_null($level_id))
            $this->db->where('id', $level_id);
        $this->db->where('active', 1);
        $query = $this->db->get('tbl_level');
        $result=$query->result_array();
        return $result;
    }
    
    /** function that deletes level when level_id is passed
     * 
     * @param type $level_id
     * @return type
     */
    function deleteLevel($level_id)
    {
        $this->db->where('id', $level_id);
        return $this->db->delete('tbl_level'); 
    }
    
    /** function that updates level row depending on id passed
     * 
     * @param type $id
     * @param type $data
     */
    function updateLevel($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tbl_level', $data); 
    }
}
?>