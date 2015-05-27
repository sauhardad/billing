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
    
    /** function that inserts new payment into the database
     * 
     * @param type $data
     */
    function insertPayment($data)
    {
        $data['user_id']= $this->session->userdata('logged_in')['id'];
        return $this->db->insert('tbl_bill_payment', $data);
        
    }
    
    /** function that inserts new payment into the database
     * 
     * @param type $data
     */
    function insertAmount($data)
    {
        $data['user_id']= $this->session->userdata('logged_in')['id'];
        return $this->db->insert('tbl_student_amount', $data);
        
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
    
      /** function that retrieves specific payments if the payment_id is provided
     * from the bill_payment table else all the payments
     * 
     * @param type $payment_id
     * @return type
     */
    function retrievePayment($payment_id=NULL)
    {
        if(!is_null($payment_id))
            $this->db->where('id', $payment_id);
        $query = $this->db->get('tbl_bill_payment');
        $result=$query->result_array();
        return $result;
    }
    
    /** function that returns students if the student name consists of the string 
     * provided
     * @param string $string
     * @return array list of students
     */
    function searchStudents($string)
    {
        $this->db->like('student_name',$string);
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
    
    /** function that updates payment row depending on id passed
     * 
     * @param type $id
     * @param type $data
     */
    function updatePayment($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tbl_bill_payment', $data); 
    }
 
    /** function that calculates total amount that needs to be paod by a student
     * 
     * @param type $student_id
     */
    function calcTotalByStudent($student_id)
    {
        $this->db->select('SUM(amount) as amount');
        $this->db->where('student_id',$student_id);
        $query = $this->db->get('tbl_student_amount');
        $result=$query->result_array();
        if($result)
            return $result[0];
    }
}
?>