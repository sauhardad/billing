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
   $this->load->model('teacher/teacher_model');
   $this->load->model('staff/staff_model');
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
    
    $data['staff']=$this->staff_model->retrieveStaff();
    $data['teachers']=$this->teacher_model->retrieveTeacher();
    
    
    //now the pagnation configuration
    $config = array();
    $config["base_url"] = base_url() . "expense/page";
    $config["total_rows"] =  $data['students']=$this->expense_model->retrieveExpenseNumber();
    $config["per_page"] = 100;
    $config["uri_segment"] = 3;
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
    $data['expenses']=$this->expense_model->retrieveExpense(NULL,$config["per_page"],$page);
    $data['links'] = $this->pagination->create_links();
    $data['sn']=1;
    
    $this->template->load('default', 'expense/expense_main_view',$data);
 }
 
 function add()
 {
     $expense_map=$this->config->item('expense_type_key');
     $data=array();
     if(($data['type']=$expense_map[$this->input->post('type')]) && ($data['amount']=$this->input->post('amount')) && ($data['date']=$this->input->post('date')) )
     {
         $data['particulars']=$this->input->post('particular');
         $data['emp_id']=$this->input->post('emp_id');
         $data['document_id']=$this->input->post('doc_no');
         $data['month']=$this->input->post('month');
         $data['payable_id']=$this->input->post('payable_id');
         $data['saving_id']=$this->input->post('saving_id');
         $data['remark']=$this->input->post('remark');
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
 
 function getTeachers()
 {
     echo json_encode($this->teacher_model->retrieveTeacher());
 }
 
 function getStaff()
 {
     echo json_encode($this->staff_model->retrieveStaff());
 }
 
 function _remap($method, $params=array())
 {
    $methodToCall = method_exists($this, $method) ? $method : 'index';
    return call_user_func_array(array($this, $methodToCall), $params);
}
}

?>