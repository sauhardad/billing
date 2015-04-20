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
    
    /** function that retrieves specific group if the group_id is provided
     * else if subsection_id is passed then it retrieves all the groups within a subsection
     * else retrieves all the groups in the database
     * 
     * @param type $group_id
     * @param type $subsection_id
     * @return array
     */
    function retrieveGroup($group_id=NULL,$subsection_id=NULL)
    {
        if(!is_null($group_id) AND !empty($group_id))
            $this->db->where('id', $group_id);
        if(!is_null($subsection_id) AND !empty($subsection_id))
            $this->db->where('subsection_id', $subsection_id);
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
        return $this->db->delete('tbl_group'); 
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