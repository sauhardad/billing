<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teacher extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   session_start(); 
    //check login
   if(!$this->session->userdata('logged_in'))
       redirect('user/login', 'refresh');
   $this->load->model('teacher_model');
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
    
    $data['teachers']=$this->teacher_model->retrieveTeacher();
    $this->template->load('default', 'teacher/teacher_main_view',$data);
 }
 
 function view()
 {
     $data=array();
     if(($id=$this->uri->segment(3)))
     {
        $session_data = $this->session->userdata('logged_in');
        $data['session_data']=$session_data;
        //check if the user has permission to add/edit users
        if ($session_data['role']=$this->config->item('role_admin'))
            $data['users']=$this->user_model->get_users_except($session_data['id']);
        $data['roles']=$this->config->item('role_value');
        $data['id']=$id;
        $data['teacher']=$this->teacher_model->retrieveTeacher($id);
        $this->template->load('default', 'teacher/teacher_specific_view',$data);
     }
 }
 
 function add()
 {
     $data=array();
     if(($data['name']=$this->input->post('add_teacher_name')) && ($data['contact_no']=$this->input->post('add_contact_no')) && ($data['address']=$this->input->post('add_address')) && ($data['share_percent']=$this->input->post('add_share_percent')))
     {
         if($this->teacher_model->insertTeacher($data))
             echo json_encode(array('status'=>TRUE,'message'=>'Teacher Saved'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }
 
 function edit()
 {
     $data=array();
     if(($id=$this->input->post('edit_teacher_id')) && ($data['name']=$this->input->post('edit_teacher_name')) && ($data['contact_no']=$this->input->post('edit_contact_no')) && ($data['address']=$this->input->post('edit_address')) && ($data['share_percent']=$this->input->post('edit_share_percent')))
     {
        if($this->teacher_model->updateTeacher($id,$data))
            echo json_encode(array('status'=>TRUE,'message'=>'Teacher Updated'));
        else
            echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
         
     }
 }
 
 function delete()
 {
     if(($id=$this->input->post('id')))
     {
         if($this->teacher_model->deleteTeacher($id))
             echo json_encode(array('status'=>TRUE,'message'=>'Teacher Deleted'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }

}

?>