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
   $this->load->model('report_model');
   $this->load->helper(array('form'));
 }
 
 function index()
 {
     if(($type=$this->input->get('type')))
     {
        $all_flag=$this->input->get('all_flag');
        $id=$this->input->get('id');
         
        //in case of all group report
        if(($type==='group') && ($all_flag==='true'))
        {
            $this->load->library('cezpdf',array('a4','landscape')); 
            $db_data=$this->report_model->retrieveAllGroupReport($id);
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
        else if(($type==='group') && ($all_flag==='false') && ($id))
        {
            $this->load->library('cezpdf',array('a4','landscape'));
            $db_data=$this->report_model->retrieveSpStudentReport($id);
            $col_names = array(
                'sn'=>'S.N.',
                'student_name' => 'Name',
                'contact_no' => 'Contact',
                'subject_1'=> 'Subject 1',
                'subject_2'=> 'Subject 2',
                'subject_3'=> 'Subject 3',
                'subject_4'=> 'Subject 4',
                'amount'=>'Amount(Rs)',
                'paid'=>'Paid(Rs)',
                'due'=>'Due(Rs)'
               
                
            );
            
            $this->cezpdf->ezTable($db_data, $col_names, 'Group Report', array('width'=>550));
            $this->cezpdf->ezStream();
        }
        //income summary for all sections
        else if(($type==='income') && ($all_flag==='true') && (!$id))
        {
            $this->load->library('cezpdf',array('a4','portrait')); 
            $db_data=$this->report_model->retrieveAllSectionReport();
            $col_names = array(
                'sn'=>'S.N.',
                'name' => 'Section',
                'amount' => 'Total Amount(Rs)',
                'paid' => 'Paid Amount(Rs)',
                'due'=>'Due Amount(Rs)'
            );

            $this->cezpdf->ezTable($db_data, $col_names, 'Sections Summary', array('width'=>550));
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
 
 
}

?>