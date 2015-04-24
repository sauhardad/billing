<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   session_start(); 
    //check login
   if(!$this->session->userdata('logged_in'))
       redirect('user/login', 'refresh');
   $this->load->model('student_model');
   $this->load->model('subsection/subsection_model');
   $this->load->model('section/section_model');
   $this->load->model('group/group_model');
      $this->load->model('teacher/teacher_model');
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
    
    $data['students']=$this->student_model->retrieveStudent();
    $data['sections']=$this->section_model->retrieveSection();
    $data['subsections']=$this->subsection_model->retrieveSubsection();
    $data['groups']=$this->group_model->retrieveGroup();
    $data['teachers']=$this->teacher_model->retrieveTeacher();
    $this->template->load('default', 'student/student_main_view',$data);
 }
 
 function add()
 {
     $data=array();
     if(($data['student_name']=$this->input->post('add_student_name')) && ($data['teacher_id']=$this->input->post('add_teacher_dropdown')) && ($data['section_id']=$this->input->post('add_section_dropdown')) && ($data['subsection_id']=$this->input->post('add_subsection_dropdown')) && ($data['group_id']=$this->input->post('add_group_dropdown')))
     {
         $data['contact_no']=$this->input->post('edit_contact_no'); 
         $data['address']=$this->input->post('add_address'); 
         $data['dob']=$this->input->post('add_student_dob');
         if($this->student_model->insertStudent($data))
             echo json_encode(array('status'=>TRUE,'message'=>'Student Saved'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }
 
 function edit()
 {
     $data=array();
     if(($id=$this->input->post('edit_student_id')) && ($data['teacher_id']=$this->input->post('edit_teacher_dropdown')) && ($data['student_name']=$this->input->post('edit_student_name')) &&  ($data['section_id']=$this->input->post('edit_section_dropdown')) && ($data['subsection_id']=$this->input->post('edit_subsection_dropdown')) && ($data['group_id']=$this->input->post('edit_group_dropdown')))
     {
        $data['contact_no']=$this->input->post('edit_contact_no'); 
        $data['address']=$this->input->post('edit_address'); 
        $data['dob']=$this->input->post('edit_student_dob'); 
        if($this->student_model->updateStudent($id,$data))
            echo json_encode(array('status'=>TRUE,'message'=>'Student Updated'));
        else
            echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
         
     }
 }
 
 function delete()
 {
     if(($id=$this->input->post('id')))
     {
         if($this->student_model->deleteStudent($id))
             echo json_encode(array('status'=>TRUE,'message'=>'Student Deleted'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }
 
 function load_subsection()
 {
     if(($id=$this->input->post('id')) && ($type=$this->input->post('type')))
     {
        $data=array(); 
        $data['subsections']=$this->subsection_model->retrieveSubsection(NULL,$id);
        echo $this->load->view($type.'_subsection_dropdown_view',$data);
     }
 }
 
 function load_group()
 {
     if(($id=$this->input->post('id')) && ($type=$this->input->post('type')))
     {
        $data=array(); 
        $data['groups']=$this->group_model->retrieveGroup(NULL,$id);
        echo $this->load->view($type.'_group_dropdown_view',$data);
        
     }
 }

}

?>