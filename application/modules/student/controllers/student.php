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
   $this->load->model('user/user_model');
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
    
    $data['sections']=$this->section_model->retrieveSection();
    $data['subsections']=$this->subsection_model->retrieveSubsection();
    $data['groups']=$this->group_model->retrieveGroup();
    $data['teachers']=$this->teacher_model->retrieveTeacher();
    
    
    //now the pagnation configuration
    $config = array();
    $config["base_url"] = base_url() . "student/page";
    $config["total_rows"] =  $data['students']=$this->student_model->retrieveStudentNumber();
    $config["per_page"] = 100;
    $config["uri_segment"] = 3;
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
    $data['students']=$this->student_model->retrieveStudent(NULL,$config["per_page"],$page);
    $data['links'] = $this->pagination->create_links();
    $data['sn']=1;
    
    
    
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
        $data['students']=$this->student_model->retrieveStudent($id);
        $data['payments']=$this->student_model->retrievePayment(NULL,$id);
        $data['bill_no']=$this->student_model->getBillNo();
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
 
 function get_receipt()
 {
    if(($student_id=$this->input->post('student_id')) && ($payment_id=$this->input->post('payment_id')))
    {
        $session_data = $this->session->userdata('logged_in');
        $data['student']=$this->student_model->retrieveStudent($student_id);
        $data['payments']=$this->student_model->retrievePayment(NULL,$student_id);
        $data['current_pay']=$this->student_model->retrievePayment($payment_id)[0];
        $data['courses']=$this->student_model->retrieveCourse(NULL,$student_id);
        $data['subsection']=$this->subsection_model->retrieveSubsection($data['student']['subsection_id'])[0];
        $data['group']=$this->group_model->retrieveGroup($data['student']['group_id'])[0];
        $data['username']=$this->user_model->getUserName($session_data['id']);
        echo $this->load->view('receipt',$data);
    } 
 }
 
 function add_payment()
 {
    $data=array();
    if(($data['student_id']=$this->input->post('student_id')) && ($data['bill_no']=$this->input->post('add_bill_no')) && ($data['paid_amount']=$this->input->post('add_paid_amount')))
    { 
        $data['date']=  date('d/m/Y');
        if(($id=$this->student_model->insertPayment($data)))
            echo json_encode(array('status'=>TRUE,'message'=>'Payment Saved','student_id'=>$data['student_id'],'payment_id'=>$id));
        else
            echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
    }
 }
 
 
 function add_course()
 {
    $data=array();
    if(($data['student_id']=$this->input->post('student_id')) && ($data['subject']=$this->input->post('add_course_subject')) && ($data['teacher_id']=$this->input->post('add_course_teacher')) && ($data['amount']=$this->input->post('add_course_amount')))
    { 
        //$data['date']=  date('d/m/Y');
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
 
function _remap($method, $params=array())
 {
    $methodToCall = method_exists($this, $method) ? $method : 'index';
    return call_user_func_array(array($this, $methodToCall), $params);
}
 }

?>