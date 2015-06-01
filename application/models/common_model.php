<?php

Class Common_model extends CI_Model
{
    
    /** function that checks if a specified code exists in the table given
     * depending on the condition specified
     * 
     * @param type $table
     * @param array $condition_array
     * @param type $code
     * @return boolean
     */
    function check_if_code_exists($table,$condition_array,$code)
    {
        $this->db->where('code',$code);
        if(!empty($condition_array))
            $this->db->where($condition_array);
        $this->db->from($table);
        if($this->db->count_all_results()) return TRUE;
        return FALSE;
    }
    
    /** function that returns teacher_id of teacher currently teaching student 
     * when student_id is passed
     * 
     * @param $student_id int
     * @return $teacher_id int
     * 
     */
    function getStudentTeacher($student_id)
    {
        $this->db->select('teacher_id');
        $this->db->from('tbl_students');
        $this->db->where('tbl_students.id',$student_id);
        $this->db->join('tbl_group','tbl_group.id=tbl_students.group_id','inner');
        $query = $this->db->get();
        $result=$query->result_array();
        return $result[0]['teacher_id'];
    }
}
?>