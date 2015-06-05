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
   $this->load->helper(array('form'));
 }
 
 function index()
 {
     if(($type=$this->input->get('type')))
     {
         $all_flag=$this->input->get('all_flag');
         $id=$this->input->get('id');
         
       
        $this->load->library('cezpdf'); 
       
        //for report
        $db_data[] = array('name' => 'Jon Doe', 'phone' => '111-222-3333', 'email' => 'jdoe@someplace.com','contact'=>'kalanki');
        $db_data[] = array('name' => 'Jane Doe', 'phone' => '222-333-4444', 'email' => 'jane.doe@something.com','contact'=>'bhaktapur');
        $db_data[] = array('name' => 'Jon Smith', 'phone' => '333-444-5555', 'email' => 'jsmith@someplacepsecial.com','contact'=>'Lalitpur');

        $col_names = array(
            'name' => 'Name',
            'phone' => 'Phone Number',
            'email' => 'E-mail Address',
            'contact'=>'Contact Address'
        );

        $this->cezpdf->ezTable($db_data, $col_names, 'Contact List', array('width'=>550));
        $this->cezpdf->ezStream();
         
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