<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Section extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   session_start(); 
    //check login
   if(!$this->session->userdata('logged_in'))
       redirect('user/login', 'refresh');
   $this->load->model('section_model');
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
    $this->template->load('default', 'section/section_main_view',$data);
 }
 
 function add()
 {
     $data=array();
     if(($data['code']=$this->input->post('add_section_code')) && ($data['name']=$this->input->post('add_section_name')))
     {
        
         if($this->section_model->insertSection($data))
             echo json_encode(array('status'=>TRUE,'message'=>'Section Saved'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }
 
 function edit()
 {
     $data=array();
     if(($id=$this->input->post('edit_section_id')) && ($data['code']=$this->input->post('edit_section_code')) && ($data['name']=$this->input->post('edit_section_name')))
     {
        
         if($this->section_model->updateSection($id,$data))
             echo json_encode(array('status'=>TRUE,'message'=>'Section Saved'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }
 
 function delete()
 {
     if(($id=$this->input->post('id')))
     {
         if($this->section_model->deleteSection($id))
             echo json_encode(array('status'=>TRUE,'message'=>'Section Deleted'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }

}

?>