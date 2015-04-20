<?php

Class Student_model extends CI_Model
{
    /** function that inserts new student into the database
     * 
     * @param type $data
     */
    function insertStudent($data)
    {
        $data['user_id']= $this->session->userdata('logged_in')['id'];
        $data['active']= TRUE;
        return $this->db->insert('tbl_students', $data);
        
    }
    
    /** function that retrieves specific students if the student_id is provided
     * from the student table else all the students
     * 
     * @param type $student_id
     * @return type
     */
    function retrieveStudent($student_id=NULL)
    {
        if(!is_null($student_id))
            $this->db->where('id', $student_id);
        $this->db->where('active', 1);
        $query = $this->db->get('tbl_students');
        $result=$query->result_array();
        return $result;
    }
    
    /** function that deletes students when students_id is passed
     * 
     * @param type $student_id
     * @return type
     */
    function deleteStudent($student_id)
    {
        $this->db->where('id', $student_id);
        return $this->db->delete('tbl_students');  
    }
    
    /** function that updates students row depending on id passed
     * 
     * @param type $id
     * @param type $data
     */
    function updateStudent($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tbl_students', $data); 
    }
 
}
?>