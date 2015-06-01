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
    if(($data['student_name']=$this->input->post('add_student_name')) && ($data['section_id']=$this->input->post('add_section_dropdown')) && ($data['subsection_id']=$this->input->post('add_subsection_dropdown')) && ($data['group_id']=$this->input->post('add_group_dropdown')))
    {
       //upload the image if it exists
       $error=FALSE; 
       if (!empty($_FILES['add_student_photo']['name'])) 
       {
            $config['upload_path'] = 'assets/img/user_uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['overwrite'] = false;

            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('add_student_photo'))
            {
                echo $this->upload->display_errors();
                $error =TRUE;
            }
            else
            {
                $data['photo']=$this->upload->data()['file_name'];
                $error=FALSE;
            }
        }
        
        $data['contact_no']=$this->input->post('add_contact_no'); 
        $data['address']=$this->input->post('add_address'); 
        $data['dob']=$this->input->post('add_student_dob');
        if(($student_id=$this->student_model->insertStudent($data)) OR $error==FALSE)
            echo json_encode(array('status'=>TRUE,'message'=>'Student Saved','student_id'=>$student_id));
        else
            echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
    }
}
 
 function edit()
 {
     $data=array();
     if(($id=$this->input->post('edit_student_id')) && ($data['student_name']=$this->input->post('edit_student_name')) &&  ($data['section_id']=$this->input->post('edit_section_dropdown')) && ($data['subsection_id']=$this->input->post('edit_subsection_dropdown')) && ($data['group_id']=$this->input->post('edit_group_dropdown')))
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
 
 function search()
 {
     if(($term=$this->input->get('term')))
     {
         $data = $this->student_model->searchStudents($term);
         echo json_encode($data);
     }
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
        $data['students']=$this->student_model->retrieveStudent($id)[0];
        $data['payments']=$this->student_model->retrievePayment(NULL,$id);
        $data['teachers']=$this->teacher_model->retrieveTeacher();
        $data['courses']=$this->student_model->retrieveCourse(NULL,$id);
        $this->template->load('default', 'student/student_specific_view',$data);
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
 
 function add_payment()
 {
    $data=array();
    if(($data['student_id']=$this->input->post('student_id')) && ($data['bill_no']=$this->input->post('add_bill_no')) && ($data['paid_amount']=$this->input->post('add_paid_amount')))
    { 
        $data['date']=  date('d/m/Y');
        if(($this->student_model->insertPayment($data)))
            echo json_encode(array('status'=>TRUE,'message'=>'Payment Saved'));
        else
            echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
    }
 }
 
 
 function add_course()
 {
    $data=array();
    if(($data['student_id']=$this->input->post('student_id')) && ($data['subject']=$this->input->post('add_course_subject')) && ($data['amount']=$this->input->post('add_course_amount')))
    { 
        //$data['date']=  date('d/m/Y');
        $data['teacher_id']=$this->common_model->getStudentTeacher($data['student_id']); 
        if(($this->student_model->insertCourse($data)))
            echo json_encode(array('status'=>TRUE,'message'=>'Course Saved ','course'=>array('subject'=>$data['subject'],'teacher'=>$this->teacher_model->retrieveTeacher($data['teacher_id'])[0]['name'],'amount'=>$data['amount'])));
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
 
 function ajax_get_total_amount()
 {
     if(($id=$this->input->post('id')))
     {
         $total=$this->student_model->calcTotalByStudent($id);
         echo $total;
     }
 }
}

?>