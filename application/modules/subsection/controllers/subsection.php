<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subsection extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   session_start(); 
    //check login
   if(!$this->session->userdata('logged_in'))
       redirect('user/login', 'refresh');
   $this->load->model('subsection_model');
   $this->load->model('section/section_model');
   $this->load->helper(array('form'));
 }

 function index()
 {
    $session_data = $this->session->userdata('logged_in');
    $data['session_data']=$session_data;
    //check if the user has permission to add/edit users
    if ($session_data['role']=$this->config->item('role_admin'))
        $data['users']=$this->user_model->get_users_except($session_data['id']);
    $data['roles']=$this->config->item('role_value');
    $data['sections']=$this->section_model->retrieveSection();
    $data['subsections']=$this->subsection_model->retrieveSubsection();
    $this->template->load('default', 'subsection/subsection_main_view',$data);
  
 }
 
 function add()
 {
     $data=array();
     if(($data['name']=$this->input->post('name')) && ($data['code']=$this->input->post('code')) && ($data['time_slot']=$this->input->post('time_slot')))
     {
         if($this->subsection_model->insertSubsection($data))
             echo json_encode(array('status'=>TRUE,'message'=>'Subsection Saved'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }
 
 function delete()
 {
     if(($id=$this->input->post('id')))
     {
         if($this->subsection_model->deleteSubsection($id))
             echo json_encode(array('status'=>TRUE,'message'=>'Subsection Deleted'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }

}

?>