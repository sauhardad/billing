<?php

Class Report_model extends CI_Model
{
    /** function that retieves array to generate report for all groups in a given 
     * subsection defined by $id
     * @param int $id
     * 
     */
    function retrieveAllGroupReport($subsection_id)
    {
        $temp=array();
        
        //get total amount
        $this->db->select('tbl_group.id,tbl_group.name,SUM(tbl_student_course.amount) as amount,t.paid as paid,v.teacher_share');
        $this->db->from('tbl_group');
        $this->db->where('tbl_group.subsection_id',$subsection_id);
        $this->db->join('tbl_students','tbl_students.group_id=tbl_group.id','left');
        $this->db->join('tbl_student_course','tbl_student_course.student_id=tbl_students.id','left');
        $this->db->join('(SELECT `tbl_group`.`id`, `tbl_group`.`name`, SUM(tbl_bill_payment.paid_amount) as paid FROM (`tbl_group`) LEFT JOIN `tbl_students` ON `tbl_students`.`group_id`=`tbl_group`.`id` LEFT JOIN `tbl_bill_payment` ON `tbl_bill_payment`.`student_id`=`tbl_students`.`id` WHERE `tbl_group`.`subsection_id` = '.$subsection_id.' GROUP BY `tbl_group`.`id`) as t','t.id=tbl_group.id','left');
        $this->db->join('(SELECT `u`.`group_id` as group_id, SUM(ROUND((tbl_teacher.share_percent/100)*u.amount)) as teacher_share FROM ((SELECT `tbl_group`.`id` as group_id, `tbl_student_course`.`teacher_id`, `tbl_student_course`.`amount` FROM (`tbl_group`) LEFT JOIN `tbl_students` ON `tbl_students`.`group_id`=`tbl_group`.`id` LEFT JOIN `tbl_student_course` ON `tbl_student_course`.`student_id`=`tbl_students`.`id` WHERE `tbl_group`.`subsection_id` = '.$subsection_id.') as u) LEFT JOIN `tbl_teacher` ON `tbl_teacher`.`id`=`u`.`teacher_id` GROUP BY `u`.`group_id` ORDER BY `u`.`group_id`) as v','v.group_id=tbl_group.id','left');
        $this->db->group_by("tbl_group.id");
        $this->db->order_by("tbl_group.id");
        $query=$this->db->get();
        $temp=$query->result_array();     
        
        
        $t_amount=0;
        $t_paid=0;
        $t_due=0;
        $t_teacher_share=0;
        $t_office_share=0;
        foreach($temp as $key=>$value)
        {
           if(!$temp[$key]['amount']) $temp[$key]['amount']=0; 
           else $t_amount+=$temp[$key]['amount'];
           
           if(!$temp[$key]['paid']) $temp[$key]['paid']=0; 
           else $t_paid+=$temp[$key]['paid'];
           
           
           if(!($temp[$key]['due']=($temp[$key]['amount']-$temp[$key]['paid'])))   $temp[$key]['due']=0; 
           else $t_due+=$temp[$key]['due'];
           
           if(!$temp[$key]['teacher_share']) $temp[$key]['teacher_share']=0; 
           else $t_teacher_share+=$temp[$key]['teacher_share'];
           
           if(!($temp[$key]['office_share']=($temp[$key]['amount']-$temp[$key]['teacher_share'])))    $temp[$key]['office_share']=0;
           else $t_office_share+=$temp[$key]['office_share'];
           
        }
        $temp[]=array('name'=>'Total','amount'=>$t_amount,'paid'=>$t_paid,'due'=>$t_due,'teacher_share'=>$t_teacher_share,'office_share'=>$t_office_share);
        return $temp;
        
        
        
        
        
        //get total course amount
        /*$this->db->select('SUM(tbl_student_course.amount) as total');
        $this->db->from('tbl_group');
        $this->db->where('tbl_group.id',$group_id);
        $this->db->join('tbl_students','tbl_students.group_id=tbl_group.id','left');
        $this->db->join('tbl_student_course','tbl_student_course.student_id=tbl_students.id','left');
        $this->db->group_by("tbl_group.id");
        $query = $this->db->get();
        $result=$query->result_array();
        $temp['total']=$result[0]['total'];*/
    }
}
?>