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
    function retrieveSpGroupReport($group_id)
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
            for($i=0;$i<4;$i++)
            {
                if(array_key_exists($i, $result))
                    $temp[$key]['subject_'.($i+1)]=$result[$i]['subject'];
                else
                    $temp[$key]['subject_'.($i+1)]=" ";
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
            $temp[]=array('student_name'=>'Total','contact_no'=>' ','subject_1'=>' ','subject_2'=>' ','subject_3'=>' ','subject_4'=>' ','amount'=>$t_amount,'paid'=>$t_paid,'due'=>$t_due);
        
        return $temp;
        
    }
    
    function retrieveCheckingLedger($group_id)
    {
        $temp=array();
                
        $this->db->select('tbl_students.id,tbl_students.contact_no,tbl_students.student_name,tbl_student_course.subject,COUNT(tbl_student_course.subject) as subject_count,t.paid,if((SUM(tbl_student_course.amount)-t.paid),"Due","Full") as remark',FALSE);
        $this->db->from('tbl_students');
        $this->db->where('tbl_students.group_id',$group_id);
        $this->db->join('tbl_student_course','tbl_student_course.student_id=tbl_students.id','left');
        $this->db->join('(SELECT `tbl_students`.`id`, SUM(tbl_bill_payment.paid_amount) as paid FROM (`tbl_students`) LEFT JOIN `tbl_bill_payment` ON `tbl_bill_payment`.`student_id`=`tbl_students`.`id` WHERE `tbl_students`.`group_id` = '.$group_id.' GROUP BY `tbl_students`.`id`) as t','t.id=tbl_students.id','left');
        $this->db->group_by('tbl_students.id');
        $query=$this->db->get();
        $temp=$query->result_array();  
        
        $sn=1;
        foreach($temp as $key=>$value)
        {
            $id=$value['id'];
            $this->db->select('subject');
            $this->db->from('tbl_student_course');
            $this->db->where('student_id',$id);
            $query=$this->db->get();
            $result=$query->result_array();  
            
            for($i=0;$i<4;$i++)
            {
                if(array_key_exists($i, $result))
                    $temp[$key]['subject_'.($i+1)]=$result[$i]['subject'];
                else
                    $temp[$key]['subject_'.($i+1)]=" ";
            }
            
            $temp[$key]['sn']=$sn;
            $sn++;
        }
        return $temp;
    }
    
    function retrieveContactLedger($group_id)
    {
        $temp=array();
                
        $this->db->select('tbl_students.id,tbl_students.contact_no,tbl_students.student_name,COUNT(tbl_student_course.subject) as subject_count');
        $this->db->from('tbl_students');
        $this->db->where('tbl_students.group_id',$group_id);
        $this->db->join('tbl_student_course','tbl_student_course.student_id=tbl_students.id','left');
        $this->db->group_by('tbl_students.id');
        $query=$this->db->get();
        $temp=$query->result_array();
        
         $sn=1;
        foreach($temp as $key=>$value)
        {
            $id=$value['id'];
            $this->db->select('subject');
            $this->db->from('tbl_student_course');
            $this->db->where('student_id',$id);
            $query=$this->db->get();
            $result=$query->result_array();  
           
            for($i=0;$i<4;$i++)
            {
                if(array_key_exists($i, $result))
                    $temp[$key]['subject_'.($i+1)]=$result[$i]['subject'];
                else
                    $temp[$key]['subject_'.($i+1)]=" ";
            }
            
           
            
            $temp[$key]['sn']=$sn;
            $sn++;
        }
        return $temp;
    }
    
    /** function that retrieves acount ledger as an array when the group_id id passed
     * 
     * @param type $group_id
     * @return array
     */
    function retrieveAccountLedger($group_id)
    {
        $temp=array();
                
        $this->db->select('tbl_students.id,tbl_students.student_name,if((SUM(tbl_student_course.amount)-t.paid)>0,"Due","Full") as remark',FALSE);
        $this->db->from('tbl_students');
        $this->db->where('tbl_students.group_id',$group_id);
        $this->db->join('tbl_student_course','tbl_student_course.student_id=tbl_students.id','left');
        $this->db->join('(SELECT `tbl_students`.`id`, SUM(tbl_bill_payment.paid_amount) as paid FROM (`tbl_students`) LEFT JOIN `tbl_bill_payment` ON `tbl_bill_payment`.`student_id`=`tbl_students`.`id` WHERE `tbl_students`.`group_id` = '.$group_id.' GROUP BY `tbl_students`.`id`) as t','t.id=tbl_students.id','left');
        $this->db->group_by('tbl_students.id');
        $query=$this->db->get();
        $temp=$query->result_array();
        
         $sn=1;
        foreach($temp as $key=>$value)
        {
            $id=$value['id'];
            
            //for adding the subjects
            $this->db->select('subject');
            $this->db->from('tbl_student_course');
            $this->db->where('student_id',$id);
            $query=$this->db->get();
            $result1=$query->result_array();  
           
            //for adding the payments
            $this->db->select('bill_no,paid_amount,date');
            $this->db->from('tbl_bill_payment');
            $this->db->where('student_id',$id);
            $query=$this->db->get();
            $result2=$query->result_array();  
            
            for($i=0;$i<4;$i++)
            {
                if(array_key_exists($i, $result1))
                    $temp[$key]['subject_'.($i+1)]=$result1[$i]['subject'];
                else
                    $temp[$key]['subject_'.($i+1)]=" ";
                
                if(array_key_exists($i, $result2))
                {
                    $temp[$key]['bill_date'.($i+1)]=$result2[$i]['date'];
                    $temp[$key]['bill_no'.($i+1)]=$result2[$i]['bill_no'];
                    $temp[$key]['bill_amount'.($i+1)]=$result2[$i]['paid_amount'];
                }
                else
                {
                    $temp[$key]['bill_date'.($i+1)]=" ";
                    $temp[$key]['bill_no'.($i+1)]=" ";
                    $temp[$key]['bill_amount'.($i+1)]=" ";
                }
            }
            
           
            
            $temp[$key]['sn']=$sn;
            $sn++;
        }
        return $temp;
    }
    
    /** function that retrieves header for account ledger report when group_id is 
     * passed
     * @param int $group_id
     * @return array $header
     */
    function retrieveAccountLedgerHeader($group_id)
    {
        $temp=array();
                
        $this->db->select('tbl_subsection.name as subsection_name,tbl_group.name as group_name,tbl_group.time_slot as time_slot',FALSE);
        $this->db->from('tbl_group');
        $this->db->where('tbl_group.id',$group_id);
        $this->db->join('tbl_subsection','tbl_subsection.id=tbl_group.subsection_id','left');
      
        $query=$this->db->get();
        $temp=$query->row_array();
        //debug_array($temp);die;
        return $temp;
    }
    
    
    /** function that returns data for rendering transaction report depening on 
     * user selected and duration to cover
     * @param int $user_id
     * @param int $duration i.e. 1=>Today,2=>Week,3=>Month
     */
    function retrieveTransactionReport($user_id,$duration)
    {
        //variable to display the type of total
        $total_type=" ";
        
        $this->db->select('users.username,tbl_bill_payment.bill_no,t.name as section_name,DATE(tbl_bill_payment.entry_timestamp) as received_on,tbl_bill_payment.paid_amount as received');
        $this->db->from('tbl_bill_payment');
        $this->db->join('users','users.id=tbl_bill_payment.user_id','inner');
        $this->db->join('(SELECT `tbl_students`.`id`, `tbl_section`.`name` FROM (`tbl_students`) LEFT JOIN `tbl_section` ON `tbl_section`.`id`=`tbl_students`.`section_id`) as t','t.id=tbl_bill_payment.student_id','left');
        if($user_id)
            $this->db->where('users.id',$user_id);
        //apply the date filter
        if($duration==1) //get payments received today
        {
           $this->db->where('DATE(tbl_bill_payment.entry_timestamp)','CURDATE()',FALSE);
           $total_type="Total(Today)";
        }
        elseif($duration==2) //get payments received this week
        {
            $this->db->where('WEEK(DATE(tbl_bill_payment.entry_timestamp))','WEEK(CURDATE())',FALSE);
            $total_type="Total(This Week)";
        }
        elseif($duration==3)
        {
            $this->db->where('MONTH(DATE(tbl_bill_payment.entry_timestamp))','MONTH(CURDATE())',FALSE);
            $total_type="Total(This Month)";
        }    
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
            $temp[]=array('section_name'=>' ','username'=>' ','bill_no'=>' ','received_on'=>$total_type,'received'=>$t_received,'remarks'=>' ');
        return $temp;
    }
}
?>