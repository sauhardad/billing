<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Level extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   session_start(); 
    //check login
   if(!$this->session->userdata('logged_in'))
       redirect('user/login', 'refresh');
   $this->load->model('level_model');
   $this->load->model('section/section_model');
   $this->load->helper(array('form'));
   $this->load->model('subsection/subsection_model');
 }

 function index()
 {
    $session_data = $this->session->userdata('logged_in');
    $data['session_data']=$session_data;
    //check if the user has permission to add/edit users
    if ($session_data['role']=$this->config->item('role_admin'))
        $data['users']=$this->user_model->get_users_except($session_data['id']);
    $data['roles']=$this->config->item('role_value');
    $data['subsections']=$this->subsection_model->retrieveSubsection();
    $data['levels']=$this->level_model->retrieveLevel();
    $this->template->load('default', 'level/level_main_view',$data);
  
 }
 
 function add()
 {
    $data=array();
    if(($data['subsection_id']=$this->input->post('add_subsection_dropdown')) && ($data['code']=$this->input->post('add_level_code')) && ($data['name']=$this->input->post('add_level_name')))
    {
     if($this->level_model->insertLevel($data))
         echo json_encode(array('status'=>TRUE,'message'=>'Level Saved'));
     else
         echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
    }
 }
 
 function edit()
 {
    $data=array();
    if(($id=$this->input->post('edit_level_id')) && ($data['name']=$this->input->post('edit_level_name')) && ($data['subsection_id']=$this->input->post('edit_subsection_dropdown')))
    {
     if($this->level_model->updateLevel($id,$data))
         echo json_encode(array('status'=>TRUE,'message'=>'Level Updated'));
     else
         echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
    }
 }
 
 function delete()
 {
     if(($id=$this->input->post('id')))
     {
         if($this->level_model->deleteLevel($id))
             echo json_encode(array('status'=>TRUE,'message'=>'Level Deleted'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }
function check_code()
 {
    if(($code=$this->input->post('code')))
    {
     if($this->common_model->check_if_code_exists('tbl_level',$code))
        echo "false";
     else
        echo "true";
    }
 }
}

?>