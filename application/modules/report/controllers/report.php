<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   session_start(); 
    //check login
   if(!$this->session->userdata('logged_in'))
       redirect('user/login', 'refresh');
   
   $this->load->model('section/section_model');
   $this->load->model('subsection/subsection_model');
   $this->load->model('user/user_model');
   $this->load->model('teacher/teacher_model');
   $this->load->model('report_model');
   $this->load->helper(array('form'));
 }
 
 function index()
 {
     if(($type=$this->input->get('type')))
     {
        $filter1=$this->input->get('filter1');
        $filter2=$this->input->get('filter2');
         
        //in case of all group report
        if(($type==='group-summary') && ($filter1==='true'))
        {
            $this->load->library('cezpdf',array('a4','landscape')); 
            $db_data=$this->report_model->retrieveAllGroupReport($filter2);
            $col_names = array(
                'sn'=>'S.N.',
                'name' => 'Group Name',
                'amount' => 'Amount(Rs)',
                'paid' => 'Paid Amount(Rs)',
                'due'=>'Due Amount(Rs)',
                'teacher_share'=>'Teacher Share(Rs)',
                'office_share'=>'Office Share(Rs)'
            );

            $this->cezpdf->ezTable($db_data, $col_names, 'Group Summary', array('width'=>550));
            $this->cezpdf->ezStream();
        }
        //in case of individual group report
        else if(($type==='group-summary') && ($filter1==='false') && ($filter2))
        {
            $this->load->library('cezpdf',array('a4','landscape'));
            $db_data=$this->report_model->retrieveSpGroupReport($filter2);
            $col_names = array(
                'sn'=>'S.N.',
                'student_name' => 'Name',
                'contact_no' => 'Contact',
                'subject_1'=> 'Subject 1',
                'subject_2'=> 'Subject 2',
                'subject_3'=> 'Subject 3',
                'subject_4'=> 'Subject 4',
                'amount'=>'Amount (Rs)',
                'paid'=>'Paid (Rs)',
                'due'=>'Due (Rs)'
               
            );
            
            $this->cezpdf->ezTable($db_data, $col_names, 'Group Report', array('width'=>750));
            $this->cezpdf->ezStream();
        }
        //income summary for all sections
        else if(($type==='income') && ($filter1==='true') && (!$filter2))
        {
            $this->load->library('cezpdf',array('a4','portrait')); 
            $db_data=$this->report_model->retrieveAllSectionReport();
            $col_names = array(
                'sn'=>'S.N.',
                'name' => 'Section',
                'amount' => 'Amount (Rs)',
                'paid' => 'Paid Amount (Rs)',
                'due'=>'Due Amount (Rs)'
            );

            $this->cezpdf->ezTable($db_data, $col_names, 'Sections Summary', array('width'=>550));
            $this->cezpdf->ezStream();
        }
        //checking ledger summary
        
        else if(($type==='group-checking') && ($filter2))
        {
            $this->load->library('cezpdf',array('a4','landscape'));
            $db_data=$this->report_model->retrieveCheckingLedger($filter2);
            $col_names = array(
                'sn'=>'S.N.',
                'student_name' => 'Name',
                'contact_no' => 'Contact',
                'subject_1'=> 'Subject 1',
                'subject_2'=> 'Subject 2',
                'subject_3'=> 'Subject 3',
                'subject_4'=> 'Subject 4',
                'remark'=>'Remark'
                
            );
            
            $this->cezpdf->ezTable($db_data, $col_names, 'Checking Ledger', array('width'=>550));
            $this->cezpdf->ezStream();
        }
        
        //contact ledger summary
         else if(($type==='group-contact') && ($filter2))
        {
            $this->load->library('cezpdf',array('a4','landscape'));
            $db_data=$this->report_model->retrieveContactLedger($filter2);
            $col_names = array(
                'sn'=>'S.N.',
                'student_name' => 'Name',
                'contact_no' => 'Contact No',
                'subject_1'=> 'Subject 1',
                'subject_2'=> 'Subject 2',
                'subject_3'=> 'Subject 3',
                'subject_4'=> 'Subject 4',
                'remarks'=>'Remarks'
            );
            
            $this->cezpdf->ezTable($db_data, $col_names, 'Contact Ledger', array('width'=>550));
            $this->cezpdf->ezStream();
        }
        
        //contact ledger summary
         else if(($type==='group-account') && ($filter2))
        {
            $this->load->library('cezpdf',array('a4','landscape'));
            $db_header=$this->report_model->retrieveAccountLedgerHeader($filter2);
            $db_data=$this->report_model->retrieveAccountLedger($filter2);
            $col_names = array(
                'sn'=>'S.N.',
                'student_name' => 'Name',
                'subject_1'=> 'Sub',
                'subject_2'=> 'Sub',
                'subject_3'=> 'Sub',
                'subject_4'=> 'Sub',
                'bill_date1'=> 'Date',
                'bill_no1'=> 'Bill',
                'bill_amount1'=> 'Amt',
                'bill_date2'=> 'Date',
                'bill_no2'=> 'Bill',
                'bill_amount2'=> 'Amt',
                'bill_date3'=> 'Date',
                'bill_no3'=> 'Bill',
                'bill_amount3'=> 'Amt',
                'remark'=>'Rmks'
            );
            
            $this->cezpdf->ezText("Account Ledger",12,array('justification'=>'center'));
            $this->cezpdf->ezText("");
            $this->cezpdf->ezText("Subsection : ".$db_header['subsection_name']."                           ".
                                  "Group : ".$db_header['group_name']."                    "."Time : ".
                                    $db_header['time_slot'],12,array('justification'=>'left','left'=>'110'));
            $this->cezpdf->ezText("");
            $this->cezpdf->ezText("Teachers :",12,array('justification'=>'left','left'=>'110'));
            $this->cezpdf->ezText("");
            $this->cezpdf->ezTable($db_data, $col_names, '', array('width'=>750));
            $this->cezpdf->ezStream();
        }
        
        
        //transaction report
        else if(($type==='transaction') && ($filter1))
        {
            $this->load->library('cezpdf',array('a4','portrait')); 
            $db_data=$this->report_model->retrieveTransactionReport($filter2,$filter1);
            //noneed to display name for individual user report
            if($filter2)
            {
                $col_names = array(
                    'sn'=>'S.N.',
                    'bill_no' => 'Bill No',
                    'section_name' => 'Section',
                    'received_on'=>"Received On",
                    'received' => 'Received Amount (Rs)'
                );  
            }
            else
            {
                $col_names = array(
                    'sn'=>'S.N.',
                    'bill_no' => 'Bill No',
                    'username'=>'Received By',
                    'section_name' => 'Section',
                    'received_on'=>"Received On",
                    'received' => 'Received Amount (Rs)'
                );  
            }
            
            
            //determine what the heading for the report should be
            $header="Transaction Report";
            if($filter2)
                $header.=" ( ".$this->user_model->getUserName($filter2). " ) ";
            $header.=" - ".date("F j, Y");
            

            $this->cezpdf->ezTable($db_data, $col_names, $header, array('width'=>550));
            $this->cezpdf->ezStream();
        }
        else if(($type==='expense') && ($filter1))
        {
            if($filter1=='teacher')
            {
                $this->load->library('cezpdf',array('a4','portrait')); 
                $db_data=$this->report_model->retrieveTeacherReport($filter2);
                $col_names1 = array(
                    'sn'=>'S.N.',
                    'date'=>'Date',
                    'document_id' => 'Voucher No',
                    'amount'=>'Amount',
                    'remark' => 'Remarks'
                );  
                $col_names2 = array(
                    'sn'=>'S.N.',
                    'group'=>'Group',
                    'amount' => 'Amount',
                    'remark' => 'Remarks'
                );  
                
                $this->cezpdf->ezText("Teacher Profile",12,array('justification'=>'center'));
                $this->cezpdf->ezText("");
                $this->cezpdf->ezText("Name : ".$db_data['personal']['name']."                     ".
                                      "Address : ".$db_data['personal']['address']."               "."Contact : ".
                                        $db_data['personal']['contact_no'],12,array('justification'=>'left'));
                $this->cezpdf->ezText("Subjects : ".$db_data['personal']['subjects'],12,array('justification'=>'left'));
                $this->cezpdf->ezText("");
                $this->cezpdf->ezTable($db_data['income'], $col_names2, "Income", array('width'=>550));
                $this->cezpdf->ezText("");
                $this->cezpdf->ezTable($db_data['payments'], $col_names1, "Expenditure", array('width'=>550));
                $this->cezpdf->ezText("");
                $this->cezpdf->ezText("Balance = ".$db_data['total_income']." - ".$db_data['total_payment']." = ".($db_data['total_income']-$db_data['total_payment']),12,array('justification'=>'left'));
                $this->cezpdf->ezStream();
            }
            elseif($filter1=='payable')
            {
                $this->load->library('cezpdf',array('a4','portrait')); 
                $db_data=$this->report_model->retrievePayableReport($filter1);
                $col_names = array(
                    'sn'=>'S.N.',
                    'month'=>'Month'
                )+$this->config->item('payables');
                
                $this->cezpdf->ezTable($db_data, $col_names, "Payables", array('width'=>550));
                $this->cezpdf->ezStream();
            }
            elseif($filter1=='stationary')
            {
                $this->load->library('cezpdf',array('a4','portrait')); 
                $db_data=$this->report_model->retrieveStationaryReport();
                $col_names = array(
                    'sn'=>'S.N.',
                    'particulars'=>'Particular',
                    'date'=>'Date',
                    'document_id' => 'Bill No',
                    'amount'=>'Amount',
                );
                
                $this->cezpdf->ezText("Expense Report(Stationary)",12,array('justification'=>'center'));
                $this->cezpdf->ezText("");
                $this->cezpdf->ezTable($db_data, $col_names, $header, array('width'=>550));
                $this->cezpdf->ezStream();
            }
            elseif($filter1=='purchase')
            {
                $this->load->library('cezpdf',array('a4','portrait')); 
                $db_data=$this->report_model->retrievePurchaseReport();
                $col_names = array(
                    'sn'=>'S.N.',
                    'particulars'=>'Particular',
                    'date'=>'Date',
                    'document_id' => 'Bill No',
                    'amount'=>'Amount',
                );
                
                $this->cezpdf->ezText("Expense Report(Purchase)",12,array('justification'=>'center'));
                $this->cezpdf->ezText("");
                $this->cezpdf->ezTable($db_data, $col_names, $header, array('width'=>550));
                $this->cezpdf->ezStream();
            }
            
            elseif($filter1=='loan')
            {
                $this->load->library('cezpdf',array('a4','portrait')); 
                $db_data=$this->report_model->retrieveLoanReport();
                $col_names = array(
                    'sn'=>'S.N.',
                    'particulars'=>'Paid To',
                    'document_id' => 'Voucher No',
                    'amount'=>'Amount',
                    'remark'=>'Remarks'
                );
                
                $this->cezpdf->ezText("Expense Report(Loan)",12,array('justification'=>'center'));
                $this->cezpdf->ezText("");
                $this->cezpdf->ezTable($db_data, $col_names, $header, array('width'=>550));
                $this->cezpdf->ezStream();
            }
        }
     }
 }
 
 function getSections()
 {
     echo json_encode($this->section_model->retrieveSection());
 }
 
 function getSubsections()
 {
     if(($section_id=$this->input->post('id')))
        echo json_encode($this->subsection_model->retrieveSubsection(NULL,$section_id));
 }
 
 function getUsers()
 {
     echo json_encode($this->user_model->retrieveAccountants());
 }
 
 function getTeachers()
 {
     echo json_encode($this->teacher_model->retrieveTeacher());
 }
 
}

?>