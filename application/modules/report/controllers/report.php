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
            $db_data=$this->report_model->retrieveSpStudentReport($filter2);
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
            
            $this->cezpdf->ezTable($db_data, $col_names, 'Group Report', array('width'=>550));
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
            $db_data=$this->report_model->retrieveAllCheckLedgerReport($filter2);
            $col_names = array(
                'student_name' => 'Name',
                'contact_no' => 'Contact',
                'subject_1'=> 'Subject 1',
                'subject_2'=> 'Subject 2',
                'subject_3'=> 'Subject 3',
                'subject_4'=> 'Subject 4'
                
            );
            
            $this->cezpdf->ezTable($db_data, $col_names, 'Checking Ledger Report', array('width'=>550));
            $this->cezpdf->ezStream();
        }
        
        //contact ledger summary
         else if(($type==='group-contact') && ($filter2))
        {
            $this->load->library('cezpdf',array('a4','landscape'));
            $db_data=$this->report_model->retrieveAllContactLedgerReport($filter2);
            $col_names = array(
                'student_name' => 'Name',
                'contact_no' => 'Contact',
                'subject_1'=> 'Subject 1',
                'subject_2'=> 'Subject 2',
                'subject_3'=> 'Subject 3',
                'subject_4'=> 'Subject 4'
                
            );
            
            $this->cezpdf->ezTable($db_data, $col_names, 'Checking Contact Report', array('width'=>550));
            $this->cezpdf->ezStream();
        }
        //transaction report
        if(($type='transaction') && ($filter1))
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
                    'received' => 'Received Amount (Rs)',
                    'remarks'=>'Remarks'
                );  
            }
            else
            {
                $col_names = array(
                    'sn'=>'S.N.',
                    'bill_no' => 'Bill No',
                    'username'=>'Received By',
                    'section_name' => 'Section',
                    'received' => 'Received Amount (Rs)',
                    'remarks'=>'Remarks'
                );  
            }
            
            
            //determine what the heading for the report should be
            $header="Transaction Report";
            if($filter2)
                $header.=" of ".$this->user_model->getUserName($filter2);
            

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