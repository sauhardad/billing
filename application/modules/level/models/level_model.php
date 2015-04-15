<?php

Class Level_model extends CI_Model
{
    /** function that inserts new Level into the database
     * 
     * @param type $data
     */
    function insertLevel($data)
    {
        $data['user_id']= $this->session->userdata('logged_in')['id'];
        $data['active']= TRUE;
        return $this->db->insert('tbl_level', $data);
        
    }
    
    /** function that retrieves specific function if the level_id is provided
     * from the sectiontable else all the levels
     * 
     * @param type $section_id
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
     * @param type $section_id
     * @return type
     */
    function deleteLevel($level_id)
    {
        $this->db->where('id', $level_id);
        return $this->db->update('tbl_level', array('active'=>FALSE)); 
    }
 
}
?>