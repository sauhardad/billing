<?php

Class Section_model extends CI_Model
{
    /** function that inserts new teacher into the database
     * 
     * @param type $data
     */
    function insertSection($data)
    {
        $data['user_id']= $this->session->userdata('logged_in')['id'];
        $data['active']= TRUE;
        return $this->db->insert('tbl_section', $data);
        
    }
    
    /** function that retrieves specific section if the section_id is provided
     * from the sectiontable else all the sections
     * 
     * @param type $section_id
     * @return type
     */
    function retrieveSection($section_id=NULL)
    {
        if(!is_null($section_id))
            $this->db->where('id', $section_id);
        $this->db->where('active', 1);
        $query = $this->db->get('tbl_section');
        $result=$query->result_array();
        return $result;
    }
    
    /** function that deletes section when section_id is passed
     * 
     * @param type $section_id
     * @return type
     */
    function deleteSection($section_id)
    {
        $this->db->where('id', $section_id);
        return $this->db->delete('tbl_section'); 
    }
 
    /** function that updates section row depending on id passed
     * 
     * @param type $id
     * @param type $data
     */
    function updateSection($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tbl_section', $data); 
    }
 
}
?>