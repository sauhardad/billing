<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Income extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   session_start(); 
    //check login
   if(!$this->session->userdata('logged_in'))
       redirect('user/login', 'refresh');
   $this->load->model('income_model');
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
    
    $data['incomes']=$this->income_model->retrieveIncome();
    $data['groups']=$this->group_model->retrieveGroup();
    $data['teachers']=$this->teacher_model->retrieveTeacher();
  
    $this->template->load('default', 'income/income_main_view',$data);
 }
 
 function add()
 {
     $data=array();
     if(($data['teacher_id']=$this->input->post('add_teacher_dropdown')) && ($data['group_id']=$this->input->post('add_group_dropdown')) && ($data['total']=$this->input->post('add_total')) && ($data['share']=$this->input->post('add_share')) && ($data['date']=$this->input->post('add_date')) && ($data['payment']=$this->input->post('add_payment')) && ($data['dues']=$this->input->post('add_due')) && ($data['remarks']=$this->input->post('add_remark')) )
     {
        
         if($this->income_model->insertIncome($data))
             echo json_encode(array('status'=>TRUE,'message'=>'Income Saved'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }
 
 function edit()
 {
     $data=array();
     if(($id=$this->input->post('edit_income_id')) && ($data['teacher_id']=$this->input->post('edit_teacher_dropdown')) && ($data['group_id']=$this->input->post('edit_group_dropdown')) && ($data['total']=$this->input->post('edit_total')) && ($data['share']=$this->input->post('edit_share')) && ($data['date']=$this->input->post('edit_date')) && ($data['payment']=$this->input->post('edit_payment')) && ($data['dues']=$this->input->post('edit_due')) && ($data['remarks']=$this->input->post('edit_remark')))
     {
        
         if($this->income_model->updateIncome($id,$data))
             echo json_encode(array('status'=>TRUE,'message'=>'Income Saved'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }
 
 function delete()
 {
     if(($id=$this->input->post('id')))
     {
         if($this->income_model->deleteIncome($id))
             echo json_encode(array('status'=>TRUE,'message'=>'Income Deleted'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }
}

?>