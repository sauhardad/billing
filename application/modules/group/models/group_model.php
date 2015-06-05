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
    
    /** function that retrieves the list of groups being taught by a given teacher
     * @param int $teacher_id 
     * @return array $groups 
     */
    function retrieveGroupsByTeacher($teacher_id)
    {
        $this->db->select('id,name');
        $this->db->where('teacher_id',$teacher_id);
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
    
    /** function that computes the total,paid,due and teacher share of income
     * depending on the group specified
     * 
     * @param int $group_id
     * @return array
     */
    function retrieveTeacherIncomeByGroup($group_id)
    {
        $temp=array();
        
        //get total course amount
        $this->db->select('SUM(tbl_student_course.amount) as total');
        $this->db->from('tbl_group');
        $this->db->where('tbl_group.id',$group_id);
        $this->db->join('tbl_students','tbl_students.group_id=tbl_group.id','left');
        $this->db->join('tbl_student_course','tbl_student_course.student_id=tbl_students.id','left');
        $this->db->group_by("tbl_group.id");
        $query = $this->db->get();
        $result=$query->result_array();
        $temp['total']=$result[0]['total'];
        
        
        //get total paid amount
        $this->db->select('SUM(tbl_bill_payment.paid_amount) as paid');
        $this->db->from('tbl_group');
        $this->db->where('tbl_group.id',$group_id);
        $this->db->join('tbl_students','tbl_students.group_id=tbl_group.id','left');
        $this->db->join('tbl_bill_payment','tbl_bill_payment.student_id=tbl_students.id','left');
        $this->db->group_by("tbl_group.id");
        $query = $this->db->get();
        $result=$query->result_array();
        $temp['paid']=$result[0]['paid'];
        //calculate the due remaining
        $temp['due']=$temp['total']-$temp['paid'];
        
        //now calculate the teacher share
        //need to retieve from teachers table
        $this->db->select('share_percent');
        $this->db->from('tbl_group');
        $this->db->where('tbl_group.id',$group_id);
        $this->db->join('tbl_teacher','tbl_teacher.id=tbl_group.teacher_id','left');
        $this->db->group_by("tbl_group.id");
        $query = $this->db->get();
        $result=$query->result_array();
        $temp['share']=($result[0]['share_percent']/100)*$temp['total'];
        
        return $temp;
        
    }
    
     /** function that returns groups if the group name consists of the string 
     * provided which belongs to a given subsection
     * @param string $string
     * @param int $subsection_id
     * @return array list of group
     */
    function searchGroups($string,$subsection_id)
    {
        $this->db->select('id,name');
        $this->db->like('name',$string);
        $this->db->where('subsection_id',$subsection_id);
        $query = $this->db->get('tbl_group');
        $result=$query->result_array();
        return $result;
    }
 
}
?>