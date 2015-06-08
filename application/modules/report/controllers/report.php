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
                'name' => 'Group Name',
                'amount' => 'Amount(Rs)',
                'paid' => 'Paid Amount(Rs)',
                'due'=>'Due Amount(Rs)',
                'teacher_share'=>'Teacher Share(Rs)',
                'office_share'=>'Office Share(Rs)'
            );

            $this->cezpdf->ezTable($db_data, $col_names, 'Group Report', array('width'=>550));
            $this->cezpdf->ezStream();
        }
        //in case of individual group report
        else if(($type==='group') && ($all_flag==='false') && ($id))
        {
            
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