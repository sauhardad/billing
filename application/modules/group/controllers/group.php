<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   session_start(); 
    //check login
   if(!$this->session->userdata('logged_in'))
       redirect('user/login', 'refresh');
   $this->load->model('group_model');
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
    
    $data['groups']=$this->group_model->retrieveGroup();
    $this->template->load('default', 'group/group_main_view',$data);
 }
 
 function add()
 {
     $data=array();
     if(($data['teacher_name']=$this->input->post('teacher_name')) && ($data['contact_no']=$this->input->post('contact_no')) && ($data['address']=$this->input->post('address')))
     {
         if($this->group_model->insertGroup($data))
             echo json_encode(array('status'=>TRUE,'message'=>'Group Saved'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }
 
 function delete()
 {
     if(($id=$this->input->post('id')))
     {
         if($this->group_model->deleteGroup($id))
             echo json_encode(array('status'=>TRUE,'message'=>'Group Deleted'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }

}

?>