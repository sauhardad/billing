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
        $this->db->select('tbl_group.id,tbl_group.name,SUM(tbl_student_course.amount) as amount,t.paid as paid,(SUM(tbl_student_course.amount)-t.paid) as due,v.teacher_share,(SUM(tbl_student_course.amount)-v.teacher_share) as office_share');
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
        $sn=1;
        foreach($temp as $key=>$value)
        {
           //initialize sn
            $temp[$key]['sn']=$sn;
            
           if(!$temp[$key]['amount']) $temp[$key]['amount']=0; 
           else $t_amount+=$temp[$key]['amount'];
           
           if(!$temp[$key]['paid']) $temp[$key]['paid']=0; 
           else $t_paid+=$temp[$key]['paid'];
           
           
           if(!$temp[$key]['due']) $temp[$key]['due']=0; 
           else $t_due+=$temp[$key]['due'];
           
           if(!$temp[$key]['teacher_share']) $temp[$key]['teacher_share']=0; 
           else $t_teacher_share+=$temp[$key]['teacher_share'];
           
           if(!$temp[$key]['office_share']) $temp[$key]['office_share']=0;
           else $t_office_share+=$temp[$key]['office_share'];
           
           
           $sn++;
        }
        if(!empty($temp))
            $temp[]=array('name'=>'Total','amount'=>$t_amount,'paid'=>$t_paid,'due'=>$t_due,'teacher_share'=>$t_teacher_share,'office_share'=>$t_office_share);
        return $temp;
    }
    
    /** function that retrieves report summary of all the sections 
     * 
     * @return array() $temp
     */
    function retrieveAllSectionReport()
    {
        $this->db->select('tbl_section.name,SUM(tbl_student_course.amount) as amount,t.paid,(SUM(tbl_student_course.amount)-t.paid) as due');
        $this->db->from('tbl_section');
        $this->db->join('tbl_students','tbl_students.section_id=tbl_section.id','left');
        $this->db->join('tbl_student_course','tbl_student_course.student_id=tbl_students.id','left');
        $this->db->join('(SELECT `tbl_section`.`id` as section_id, SUM(tbl_bill_payment.paid_amount) as paid FROM (`tbl_section`) LEFT JOIN `tbl_students` ON `tbl_students`.`section_id`=`tbl_section`.`id` LEFT JOIN `tbl_bill_payment` ON `tbl_bill_payment`.`student_id`=`tbl_students`.`id` GROUP BY `tbl_section`.`id` ORDER BY `tbl_section`.`id`) as t','t.section_id=tbl_section.id','left');
        $this->db->group_by('tbl_section.id');
        $this->db->order_by('tbl_section.id');
        $query=$this->db->get();
        $temp=$query->result_array();     
        
        $t_amount=0;
        $t_paid=0;
        $t_due=0;
        $sn=1;
        foreach($temp as $key=>$value)
        {
           //initialize sn
            $temp[$key]['sn']=$sn;
            
           if(!$temp[$key]['amount']) $temp[$key]['amount']=0; 
           else $t_amount+=$temp[$key]['amount'];
           
           if(!$temp[$key]['paid']) $temp[$key]['paid']=0; 
           else $t_paid+=$temp[$key]['paid'];
           
           
           if(!$temp[$key]['due']) $temp[$key]['due']=0; 
           else $t_due+=$temp[$key]['due'];
           
           
           
           $sn++;
        }
        if(!empty($temp))
            $temp[]=array('name'=>'Total','amount'=>$t_amount,'paid'=>$t_paid,'due'=>$t_due);
        return $temp;
    }
    function retrieveSpStudentReport($group_id)
    {
        $temp=array();
        
        $this->db->select('tbl_students.id,tbl_students.student_name,tbl_students.contact_no,COUNT(tbl_student_course.subject) as subject_count,SUM(tbl_student_course.amount) as amount,t.paid,(SUM(tbl_student_course.amount)-t.paid) as due');                
        $this->db->from('tbl_students');
        $this->db->where('tbl_students.group_id',$group_id);
        $this->db->join('tbl_student_course','tbl_student_course.student_id=tbl_students.id','left');
        $this->db->join('(SELECT `tbl_students`.`id`, SUM(tbl_bill_payment.paid_amount) as paid FROM (`tbl_students`) LEFT JOIN `tbl_bill_payment` ON `tbl_bill_payment`.`student_id`=`tbl_students`.`id` WHERE `tbl_students`.`group_id` = '.$group_id.' GROUP BY `tbl_students`.`id`) as t','t.id=tbl_students.id','left');
        $this->db->group_by('tbl_students.id');
        $query=$this->db->get();
        $temp=$query->result_array();  
        
        $t_amount=0;
        $t_paid=0;
        $t_due=0;
        $sn=1;
        foreach($temp as $key=>$value)
        {
            $id=$value['id'];
            $this->db->select('subject');
            $this->db->from('tbl_student_course');
            $this->db->where('student_id',$id);
            $query=$this->db->get();
            $result=$query->result_array();  
            
            $count=1;
            foreach($result as $key2=>$value2)
            {
                $temp[$key]['subject_'.$count]=$value2['subject'];    
                $count++;
                
            }
            
            $temp[$key]['sn']=$sn;
            
            if(!$temp[$key]['amount']) $temp[$key]['amount']=0; 
            else $t_amount+=$temp[$key]['amount'];
           
            if(!$temp[$key]['paid']) $temp[$key]['paid']=0; 
            else $t_paid+=$temp[$key]['paid'];


            if(!$temp[$key]['due']) $temp[$key]['due']=0; 
            else $t_due+=$temp[$key]['due'];
            
            $sn++;
        }
        if(!empty($temp))
            $temp[]=array('student_name'=>'Total','amount'=>$t_amount,'paid'=>$t_paid,'due'=>$t_due);
        
        return $temp;
        
    }
    
    /** function that returns data for rendering transaction report depening on 
     * user selected and duration to cover
     * @param int $user_id
     * @param int $duration i.e. 1=>Today,2=>Week,3=>Month
     */
    function retrieveTransactionReport($user_id,$duration)
    {
        $this->db->select('users.username,tbl_bill_payment.bill_no,t.name as section_name,tbl_bill_payment.paid_amount as received');
        $this->db->from('tbl_bill_payment');
        $this->db->join('users','users.id=tbl_bill_payment.user_id','inner');
        $this->db->join('(SELECT `tbl_students`.`id`, `tbl_section`.`name` FROM (`tbl_students`) LEFT JOIN `tbl_section` ON `tbl_section`.`id`=`tbl_students`.`section_id`) as t','t.id=tbl_bill_payment.student_id','left');
        if($user_id)
            $this->db->where('users.id',$user_id);
        $this->db->order_by('users.id');
        $query=$this->db->get();
        $temp=$query->result_array();     
                
        
        $t_received=0;
        $sn=1;
        foreach($temp as $key=>$value)
        {
           //initialize sn
            $temp[$key]['sn']=$sn;
            
           if(!$temp[$key]['received']) $temp[$key]['received']=0; 
           else $t_received+=$temp[$key]['received'];
           
           
           $sn++;
        }
        if(!empty($temp))
            $temp[]=array('section_name'=>'Total','received'=>$t_received);
        return $temp;
    }
}
?>