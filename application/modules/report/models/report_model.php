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
    
    /** function that retrieves report summary of all the sections when the duration
     * is passed
     * @param int $duration
     * @return array() $temp
     */
    function retrieveAllSectionReport($duration)
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
            $this->db->select('bill_no,paid_amount,date',FALSE);
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
    function retrieveTransactionReport($user_id,$duration,$from,$to)
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
        elseif($duration==2) //get payments received this month
        {
            $this->db->where('MONTH(DATE(tbl_bill_payment.entry_timestamp))','MONTH(CURDATE())',FALSE);
            $total_type="Total(This Month)";
        }
        elseif($duration==3)
        {
            $this->db->where('DATE(tbl_bill_payment.entry_timestamp) BETWEEN STR_TO_DATE(\''.$from.'\',\'%m/%d/%Y\') AND STR_TO_DATE(\''.$to.'\',\'%m/%d/%Y\')');
            $total_type="Total(Custom)";
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
    
    /** function that generates teacher expense report when teacher_id is passed
     * @param int $teacher_id
     */
    function retrieveTeacherReport($teacher_id,$duration,$from,$to)
    {
        //get teacher personal info
        $this->db->select('t1.name,t1.address,t1.contact_no');
        $this->db->from('tbl_teacher as t1');
        $this->db->where('t1.id',$teacher_id);
        $query=$this->db->get();
        $temp['personal']=$query->row_array();      
        
        //get payment info
        $this->db->select('t2.date,t2.document_id,t2.amount,t2.remark');
        $this->db->from('tbl_expense as t2');
        $this->db->where('t2.emp_id',$teacher_id);
        if($duration==1) //get payments received today
        {
           $this->db->where('STR_TO_DATE(t2.date,\'%m/%d/%Y\')','CURDATE()',FALSE);
           $total_type="Total(Today)";
        }
        elseif($duration==2) //get payments received this month
        {
            $this->db->where('MONTH(STR_TO_DATE(t2.date,\'%m/%d/%Y\'))','MONTH(CURDATE())',FALSE);
            $total_type="Total(This Month)";
        }
        elseif($duration==3)
        {
            $this->db->where('STR_TO_DATE(t2.date,\'%m/%d/%Y\') BETWEEN STR_TO_DATE(\''.$from.'\',\'%m/%d/%Y\') AND STR_TO_DATE(\''.$to.'\',\'%m/%d/%Y\')');
            $total_type="Total(Custom)";
        }    
        $query=$this->db->get();
        $temp['payments']=$query->result_array();    
        
        //get income information
       /* $this->db->select('t3.name as "group",SUM(t1.amount) as "amount"');
        $this->db->from('tbl_student_course as t1');
        $this->db->join('tbl_students as t2','t2.id=t1.student_id');
        $this->db->join('tbl_group as t3','t3.id=t2.group_id');
        $this->db->where('t1.teacher_id',$teacher_id);
        $this->db->group_by('t1.teacher_id,t2.group_id');
        $query=$this->db->get();
        $temp['income']=$query->result_array(); */
        
        $this->db->select('t4.name,t1.name as "group",SUM(t5.paid_amount) as "amount"');
        $this->db->from('tbl_group as t1');
        $this->db->join('tbl_students as t2','t2.group_id=t1.id','left');
        $this->db->join('tbl_student_course as t3','t3.student_id=t2.id','left');
        $this->db->join('tbl_teacher as t4','t4.id=t3.teacher_id','left');
        $this->db->join('tbl_bill_payment as t5','t5.student_id=t2.id','left');
        $this->db->where('t4.id',$teacher_id);
        $this->db->group_by("t1.id");
        $query = $this->db->get();
        $temp['income']=$query->result_array();
       
        
        //get subjects
        $this->db->select('subject');
        $this->db->from('tbl_student_course');
        $this->db->where('teacher_id',$teacher_id);
        $query=$this->db->get();
        $buffer=$query->result_array();    
        
        //format subject list
        $temp['personal']['subjects']="";
        foreach($buffer as $key=>$value)
        {
            if(!$temp['personal']['subjects']=="")
                $temp['personal']['subjects'].=" , ";
            $temp['personal']['subjects'].=$value['subject'];
        }
        
        
        
        $sn=1;
        $total_payments=0;
        foreach($temp['payments'] as $key=>$value)
        {
           //initialize sn
           $temp['payments'][$key]['sn']=$sn;
           $total_payments+=$temp['payments'][$key]['amount'];
           $sn++;
        }
        $temp['total_payment']=$total_payments;
        
        
        $sn=1;
        $total_income=0;
        foreach($temp['income'] as $key=>$value)
        {
           //initialize sn
           $temp['income'][$key]['sn']=$sn;
           $total_income+=$temp['income'][$key]['amount'];
           $sn++;
        }
        $temp['total_income']=$total_income;
        
        if(!empty($temp['payments']))
            $temp['payments'][]=array('sn'=>' ','document_id'=>$total_type,'amount'=>$total_payments,'remark'=>' ');
        
        if(!empty($temp['income']))
            $temp['income'][]=array('sn'=>' ','group'=>'Total','amount'=>$total_income,'remark'=>' ');
        
        
        return $temp;
    }
    
    /** function that retrieves data for the Payable report
     * @param type
     * 
     * @return array
     */
    function retrievePayableReport($type)
    {
        $expense_type=$this->config->item('expense_type');
        $expense_type_key=$this->config->item('expense_type_key');
        $monthlist=$this->config->item('monthlist');
        $payables=$this->config->item('payables');    
        
        $query="SELECT t1.month";
        $first_subquery=TRUE;
        $total=array();
        foreach($payables as $key=>$value)
        {
            $query.=",t".$key.".".$key;
            $total[$key]=0;
        }
        $query.=" FROM ";
        foreach($payables as $key=>$value)
        {
            if(!$first_subquery)
                $query.='LEFT JOIN ';
            $query.='(SELECT month,SUM(amount) as "'.$key.'"
                            FROM (`tbl_expense`) WHERE `type` = 4 and payable_id='.$key.' group by month) as t'.$key.' ';
            if(!$first_subquery)
                $query.=' on t'.$key.'.month=t1.month ';
            $first_subquery=FALSE;
        }
        
        /*$query=$this->db->query('SELECT t1.month,t1.1,t2.2,t3.3 FROM 
                        (SELECT month,SUM(amount) as "1"
                        FROM (`tbl_expense`) WHERE `type` = 4 and payable_id=1 group by month) as t1
                        LEFT JOIN
                        (SELECT month,SUM(amount) as "2"
                        FROM (`tbl_expense`) WHERE `type` = 4 and payable_id=2 group by month) as t2 on t2.month=t1.month
                        LEFT JOIN
                        (SELECT month,SUM(amount) as "3"
                        FROM (`tbl_expense`) WHERE `type` = 4 and payable_id=3 group by month) as t3 on t3.month=t1.month');
         */
        $query=$this->db->query($query);
        $temp=$query->result_array();    
        
        
        $sn=1;
        foreach($temp as $key1=>$value1)
        {
            $temp[$key1]['sn']=$sn;
            $temp[$key1]['month']=$monthlist[$temp[$key1]['month']];
            
            //now sum up the total for each type of payable
            foreach($payables as $key2=>$value2)
            {
                $total[$key2]=$total[$key2]+$temp[$key1][$key2];
            }
            
            $sn++;
        }
        
        if(!empty($temp))
        {
            $temp[$sn]=array('sn'=>' ','month'=>'Total');
            foreach($payables as $key=>$value)
            {
                $temp[$sn][$key]=$total[$key];
            }
        }
            
        debug_array($temp);
        return $temp;
    }
    
    /* function that retrieves data for stationary report when the duration is provided
     * @param int $duration
     * @return array
     */
    function retrieveStationaryReport($duration,$from,$to)
    {
        $this->db->select('t1.particulars,t1.date,t1.amount,t1.document_id');
        $this->db->from('tbl_expense as t1');
        $this->db->where('type',3);
        //apply the date filter
        if($duration==1) //get payments received today
        {
           $this->db->where('STR_TO_DATE(t1.date,\'%m/%d/%Y\')','CURDATE()',FALSE);
           $total_type="Total(Today)";
        }
        elseif($duration==2) //get payments received this month
        {
            $this->db->where('MONTH(STR_TO_DATE(t1.date,\'%m/%d/%Y\'))','MONTH(CURDATE())',FALSE);
            $total_type="Total(This Month)";
        }
        elseif($duration==3)
        {
            $this->db->where('STR_TO_DATE(t1.date,\'%m/%d/%Y\') BETWEEN STR_TO_DATE(\''.$from.'\',\'%m/%d/%Y\') AND STR_TO_DATE(\''.$to.'\',\'%m/%d/%Y\')');
            $total_type="Total(Custom)";
        }    
        $query=$this->db->get();
        $temp=$query->result_array();
        
        $sn=1;
        $total=0;
        foreach($temp as $key=>$value)
        {
           //initialize sn
            $temp[$key]['sn']=$sn;
            $total+=$temp[$key]['amount'];
            $sn++;
        }
        if(!empty($temp))
            $temp[]=array('sn'=>' ','particulars'=>' ','date'=>'','document_id'=>$total_type,'amount'=>$total);
        return $temp;
    }
    
    // function that retrieves data for stationary report
    function retrievePurchaseReport($duration,$from,$to)
    {
        $this->db->select('t1.particulars,t1.date,t1.amount,t1.document_id');
        $this->db->from('tbl_expense as t1');
        $this->db->where('type',5);
        //apply the date filter
        if($duration==1) //get payments received today
        {
           $this->db->where('STR_TO_DATE(t1.date,\'%m/%d/%Y\')','CURDATE()',FALSE);
           $total_type="Total(Today)";
        }
        elseif($duration==2) //get payments received this month
        {
            $this->db->where('MONTH(STR_TO_DATE(t1.date,\'%m/%d/%Y\'))','MONTH(CURDATE())',FALSE);
            $total_type="Total(This Month)";
        }
        elseif($duration==3)
        {
            $this->db->where('STR_TO_DATE(t1.date,\'%m/%d/%Y\') BETWEEN STR_TO_DATE(\''.$from.'\',\'%m/%d/%Y\') AND STR_TO_DATE(\''.$to.'\',\'%m/%d/%Y\')');
            $total_type="Total(Custom)";
        }    
        $query=$this->db->get();
        $temp=$query->result_array();
        $sn=1;
        $total=0;
        foreach($temp as $key=>$value)
        {
           //initialize sn
            $temp[$key]['sn']=$sn;
            $total+=$temp[$key]['amount'];
            $sn++;
        }
       if(!empty($temp))
            $temp[]=array('sn'=>' ','particulars'=>' ','date'=>'','document_id'=>$total_type,'amount'=>$total);
        return $temp;
    }
    
    function retrieveStaffReport($staff_id,$duration,$from,$to)
    {
        //get Staff personal info
        $this->db->select('t1.name,t1.address,t1.contact,t1.post');
        $this->db->from('tbl_staff as t1');
        $this->db->where('t1.id',$staff_id);
        $query=$this->db->get();
        $temp['personal']=$query->row_array();
        
        //get staff expected salary
        $this->db->select('t1.month,t1.e_salary,t1.fine,t1.net_salary');
        $this->db->from('tbl_staff_entitled as t1');
        $this->db->where('t1.staff_id',$staff_id);
        $query=$this->db->get();
        $temp['entitled']=$query->result_array();
        
        //get staff expenses
        $this->db->select('t1.date,t1.document_id,t1.amount,t1.remark');
        $this->db->from('tbl_expense as t1');
        $this->db->where('t1.type',2);
        $this->db->where('t1.emp_id',$staff_id);
        //apply the date filter
        if($duration==1) //get payments received today
        {
           $this->db->where('STR_TO_DATE(t1.date,\'%m/%d/%Y\')','CURDATE()',FALSE);
           $total_type="Total(Today)";
        }
        elseif($duration==2) //get payments received this month
        {
            $this->db->where('MONTH(STR_TO_DATE(t1.date,\'%m/%d/%Y\'))','MONTH(CURDATE())',FALSE);
            $total_type="Total(This Month)";
        }
        elseif($duration==3)
        {
            $this->db->where('STR_TO_DATE(t1.date,\'%m/%d/%Y\') BETWEEN STR_TO_DATE(\''.$from.'\',\'%m/%d/%Y\') AND STR_TO_DATE(\''.$to.'\',\'%m/%d/%Y\')');
            $total_type="Total(Custom)";
        }
        $query=$this->db->get();
        $temp['expense']=$query->result_array();
        
        $sn=1;
        $total_entitled_exp=0;
        $total_entitled_fine=0;
        $total_entitled_net=0;
        foreach($temp['entitled'] as $key=>$value)
        {
           //initialize sn
           $temp['entitled'][$key]['sn']=$sn;
           $total_entitled_exp+=$temp['entitled'][$key]['e_salary'];
           $total_entitled_fine+=$temp['entitled'][$key]['fine'];
           $total_entitled_net+=$temp['entitled'][$key]['net_salary'];
           $sn++;
        }
        $temp['total_net_salary']=$total_entitled_net;
        
        
        $sn=1;
        $total_expense=0;
        foreach($temp['expense'] as $key=>$value)
        {
           //initialize sn
           $temp['expense'][$key]['sn']=$sn;
           $total_expense+=$temp['expense'][$key]['amount'];
           $sn++;
        }
        $temp['total_expense']=$total_expense;   
        
        if(!empty($temp['entitled']))
            $temp['entitled'][]=array('sn'=>' ','month'=>'Total','e_salary'=>$total_entitled_exp,'fine'=>$total_entitled_fine,'net_salary'=>$total_entitled_net);
        if(!empty($temp['expense']))
            $temp['expense'][]=array('sn'=>' ','date'=>'','document_id'=>$total_type,'amount'=>$total_expense,'remark'=>' ');
        
        return $temp;
    }
    
    
    function retrieveLoanReport($duration,$from,$to)
    {
        $this->db->select('t1.particulars,t1.date,t1.amount,t1.document_id,t1.remark');
        $this->db->from('tbl_expense as t1');
        $this->db->where('type',6);
        //apply the date filter
        if($duration==1) //get payments received today
        {
           $this->db->where('STR_TO_DATE(t1.date,\'%m/%d/%Y\')','CURDATE()',FALSE);
           $total_type="Total(Today)";
        }
        elseif($duration==2) //get payments received this month
        {
            $this->db->where('MONTH(STR_TO_DATE(t1.date,\'%m/%d/%Y\'))','MONTH(CURDATE())',FALSE);
            $total_type="Total(This Month)";
        }
        elseif($duration==3)
        {
            $this->db->where('STR_TO_DATE(t1.date,\'%m/%d/%Y\') BETWEEN STR_TO_DATE(\''.$from.'\',\'%m/%d/%Y\') AND STR_TO_DATE(\''.$to.'\',\'%m/%d/%Y\')');
            $total_type="Total(Custom)";
        }    
        $query=$this->db->get();
        $temp=$query->result_array();
        $sn=1;
        $total=0;
        foreach($temp as $key=>$value)
        {
           //initialize sn
            $temp[$key]['sn']=$sn;
            $total+=$temp[$key]['amount'];
            $sn++;
        }
       if(!empty($temp))
            $temp[]=array('sn'=>' ','particulars'=>' ','date'=>'','document_id'=>$total_type,'amount'=>$total,'remark'=>'');
        return $temp;
    }
    
    /** function that generates data for the saving reportand returns an array when a
     * saving id is passed to it
     * @param int $saving_id
     * @return array
     */
    function retrieveSavingReport($saving_id,$duration,$from,$to)
    {
        $this->db->select('date,amount,remark');
        $this->db->from('tbl_expense as t1');
        $this->db->where('type',7);
        $this->db->where('saving_id',$saving_id);
        //apply the date filter
        if($duration==1) //get payments received today
        {
           $this->db->where('STR_TO_DATE(t1.date,\'%m/%d/%Y\')','CURDATE()',FALSE);
           $total_type="Total(Today)";
        }
        elseif($duration==2) //get payments received this month
        {
            $this->db->where('MONTH(STR_TO_DATE(t1.date,\'%m/%d/%Y\'))','MONTH(CURDATE())',FALSE);
            $total_type="Total(This Month)";
        }
        elseif($duration==3)
        {
            $this->db->where('STR_TO_DATE(t1.date,\'%m/%d/%Y\') BETWEEN STR_TO_DATE(\''.$from.'\',\'%m/%d/%Y\') AND STR_TO_DATE(\''.$to.'\',\'%m/%d/%Y\')');
            $total_type="Total(Custom)";
        }    
        $query=$this->db->get();
        $temp=$query->result_array();
        
        $sn=1;
        $total=0;
        foreach($temp as $key=>$value)
        {
           //initialize sn
            $temp[$key]['sn']=$sn;
            $total+=$temp[$key]['amount'];
            $sn++;
        }
        
        if(!empty($temp))
            $temp[]=array('sn'=>' ','date'=>$total_type,'amount'=>$total,'remark'=>'');
        
        return $temp;
        
        
    }
}
?>