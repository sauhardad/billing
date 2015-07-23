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
                'subject_1'=> 'Subject 1',
                'subject_2'=> 'Subject 2',
                'subject_3'=> 'Subject 3',
                'subject_4'=> 'Subject 4',
                'bill_date1'=> '1st Bill Date',
                'bill_no1'=> '1st Bill No',
                'bill_amount1'=> '1st Bill Amount',
                'bill_date2'=> '2nd Bill Date',
                'bill_no2'=> '2nd Bill No',
                'bill_amount2'=> '2nd Bill Amount',
                'bill_date3'=> '3rd Bill Date',
                'bill_no3'=> '3rd Bill No',
                'bill_amount3'=> '3rd Bill Amount',
                'remark'=>'Remarks'
            );
            
            $this->cezpdf->ezText("Account Ledger",12,array('justification'=>'center'));
            $this->cezpdf->ezText("");
            $this->cezpdf->ezText("Subsection : ".$db_header['subsection_name']."                           ".
                                  "Group : ".$db_header['group_name']."                    "."Time : ".
                                    $db_header['time_slot'],12,array('justification'=>'left','left'=>'110'));
            $this->cezpdf->ezText("");
            $this->cezpdf->ezText("Teachers :",12,array('justification'=>'left','left'=>'110'));
            $this->cezpdf->ezText("");
            $this->cezpdf->ezTable($db_data, $col_names, '', array('width'=>850));
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
 
}

?>