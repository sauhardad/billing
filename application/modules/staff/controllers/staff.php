<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   session_start(); 
    //check login
   if(!$this->session->userdata('logged_in'))
       redirect('user/login', 'refresh');
   $this->load->model('staff_model');
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
    $data['staffs']=$this->staff_model->retrieveStaff();
    $this->template->load('default', 'staff/staff_main_view',$data);
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
        $data['staff']=$this->staff_model->retrieveStaff($id);
        $data['salaries']=$this->staff_model->retrieveStaffMetadata($id);
        $this->template->load('default', 'staff/staff_specific_view',$data);
     }
 }
 
 function add()
 {
     $data=array();
     if(($data['name']=$this->input->post('add_staff_name')) && ($data['contact']=$this->input->post('add_staff_contact_no')) && ($data['address']=$this->input->post('add_staff_address')) && ($data['post']=$this->input->post('add_staff_post')))
     {
         if($this->staff_model->insertStaff($data))
             echo json_encode(array('status'=>TRUE,'message'=>'Staff Saved'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }
 
 function edit()
 {
     $data=array();
     if(($id=$this->input->post('edit_staff_id')) && ($data['name']=$this->input->post('edit_staff_name')) && ($data['contact']=$this->input->post('edit_staff_contact_no')) && ($data['address']=$this->input->post('edit_staff_address')) && ($data['post']=$this->input->post('edit_staff_post')))
     {
        if($this->staff_model->updateStaff($id,$data))
            echo json_encode(array('status'=>TRUE,'message'=>'Staff Updated'));
        else
            echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
         
     }
 }
 
 function delete()
 {
     if(($id=$this->input->post('id')))
     {
         if($this->staff_model->deleteStaff($id))
             echo json_encode(array('status'=>TRUE,'message'=>'Staff Deleted'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }
 
  function add_staff_salary()
 {
     $data=array();
     if(($data['staff_id']=$this->input->post('staff_id')) && ($data['month']=$this->input->post('add_month_dropdown')) && ($data['e_salary']=$this->input->post('add_entitled_salary')) && ($data['fine']=$this->input->post('add_fine_amount')))
     {
         $data['net_salary']=$data['e_salary']-$data['fine'];
         $data['remark']=$this->input->post('add_remark');
         if($this->staff_model->insertStaffSalary($data))
             echo json_encode(array('status'=>TRUE,'message'=>'Salary Detail Saved'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }
 
 function edit_staff_salary()
 {
     $data=array();
     if(($id=$this->input->post('staff_id')) && ($entitled_id=$this->input->post('edit_staff_salary_id')) && ($data['month']=$this->input->post('edit_month_dropdown')) && ($data['e_salary']=$this->input->post('edit_entitled_salary')) && ($data['fine']=$this->input->post('edit_fine_amount')))
     {
         $data['net_salary']=$data['e_salary']-$data['fine'];
         $data['remark']=$this->input->post('edit_remark');
         
         if($this->staff_model->updateStaffSalary($id,$entitled_id,$data))
             echo json_encode(array('status'=>TRUE,'message'=>'Salary Detail Updated'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }

}

?>