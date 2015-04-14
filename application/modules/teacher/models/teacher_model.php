<?php

Class Teacher_model extends CI_Model
{
    /** function that inserts new teacher into the database
     * 
     * @param type $data
     */
    function insertTeacher($data)
    {
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
 
}
?>