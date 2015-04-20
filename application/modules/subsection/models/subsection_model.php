<?php

Class Subsection_model extends CI_Model
{
    /** function that inserts new subsection into the database
     * 
     * @param type $data
     */
    function insertSubsection($data)
    {
        $data['user_id']= $this->session->userdata('logged_in')['id'];
        $data['active']= TRUE;
        return $this->db->insert('tbl_subsection', $data);
        
    }
    
    /** function that retrieves specific subsection if the subsection_id is provided
     * from the subsection table or all subsections of a given section if section_id
     * is given
     * 
     * @param type $subsection_id
     * @param type $section_id
     * @return type
     */
    function retrieveSubsection($subsection_id=NULL,$section_id=NULL)
    {
        if(!is_null($subsection_id) AND !empty($subsection_id))
            $this->db->where('id', $subsection_id);
        if(!is_null($subsection_id) AND !empty($section_id))
            $this->db->where('section_id', $section_id);
        $this->db->where('active', 1);
        $query = $this->db->get('tbl_subsection');
        $result=$query->result_array();
        return $result;
    }
    
    /** function that deletes subsection when subsection_id is passed
     * 
     * @param type $subsection_id
     * @return type
     */
    function deleteSubsection($subsection_id)
    {
        $this->db->where('id', $subsection_id);
        return $this->db->delete('tbl_subsection'); 
    }
    
    /** function that updates subsection row depending on id passed
     * 
     * @param type $id
     * @param type $data
     */
    function updateSubsection($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tbl_subsection', $data); 
    }
}
?>