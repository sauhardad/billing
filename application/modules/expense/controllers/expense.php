<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expense extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   session_start(); 
    //check login
   if(!$this->session->userdata('logged_in'))
       redirect('user/login', 'refresh');
   $this->load->model('expense_model');
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
    
    $data['expenses']=$this->expense_model->retrieveExpense();
    $this->template->load('default', 'expense/expense_main_view',$data);
 }
 
 function add()
 {
     $data=array();
     if(($data['particulars']=$this->input->post('add_expense_particular')) && ($data['amount']=$this->input->post('add_expense_amount')) && ($data['date']=$this->input->post('add_expense_date')) )
     {
        
         if($this->expense_model->insertExpense($data))
             echo json_encode(array('status'=>TRUE,'message'=>'Expense Saved'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }
 
 function edit()
 {
     $data=array();
     if(($id=$this->input->post('edit_expense_id')) && ($data['particulars']=$this->input->post('edit_expense_particular')) && ($data['amount']=$this->input->post('edit_expense_amount')) && ($data['date']=$this->input->post('edit_expense_date')))
     {
         
         if($this->expense_model->updateExpense($id,$data))
             echo json_encode(array('status'=>TRUE,'message'=>'Expense Saved'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }
 
 function delete()
 {
     if(($id=$this->input->post('id')))
     {
         if($this->expense_model->deleteExpense($id))
             echo json_encode(array('status'=>TRUE,'message'=>'Expense Deleted'));
         else
             echo json_encode(array('status'=>FALSE,'message'=>'Oops,try again later'));
     }
 }
 
}

?>