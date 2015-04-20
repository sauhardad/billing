<?php

Class Teacher_model extends CI_Model
{
    /** function that inserts new teacher into the database
     * 
     * @param type $data
     */
    function insertTeacher($data)
    {
        $data['user_id']= $this->session->userdata('logged_in')['id'];
        $data['active']= TRUE;
        return $this->db->insert('tbl_teacher', $data);
        
    }
    
    /** function that retrieves specific teacher if the teacher_id is provided
     * from the teachers table else all the teachers
     * 
     * @param type $teacher_id
     * @return type
     */
    function retrieveTeacher($teacher_id=NULL)
    {
        if(!is_null($teacher_id))
            $this->db->where('id', $teacher_id);
        $this->db->where('active', 1);
        $query = $this->db->get('tbl_teacher');
        $result=$query->result_array();
        return $result;
    }
    
    /** function that deletes teacher when teacher_id is passed
     * 
     * @param type $teacher_id
     * @return type
     */
    function deleteTeacher($teacher_id)
    {
        $this->db->where('id', $teacher_id);
        return $this->db->delete('tbl_teacher');  
    }
    
    /** function that updates teacher row depending on id passed
     * 
     * @param type $id
     * @param type $data
     */
    function updateTeacher($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tbl_teacher', $data); 
    }
 
}
?>