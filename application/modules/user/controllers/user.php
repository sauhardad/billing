<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   session_start(); 
   $this->load->model('user_model');
   $this->load->helper(array('form'));
 }

 function index()
 {
     redirect('user/login','refresh');
 }
 
 function login()
 {
   if($this->session->userdata('logged_in'))
       redirect('home', 'refresh');
   else
       $this->load->view('login_view');
 }
 
 function verifylogin()
 {
   $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

   if($this->form_validation->run() == FALSE)
   {
     //Field validation failed.  User redirected to login page
     $this->load->view('login_view');
   }
   else
   {
     //redirect to the home page
     redirect('home', 'refresh');
   }

 }

 function check_database($password)
 {
   //Field validation succeeded.  Validate against database
   $username = $this->input->post('username');
   //query the database
   $result = $this->user_model->verify($username, $password);

   if($result)
   {
     $sess_array = array();
     $sess_array = array(
        'id' => $result->id,
        'username' => $result->username,
        'role' => $result->role
      );       
      $this->session->set_userdata('logged_in', $sess_array);
      return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Invalid username or password');
     return false;
   }
 }
 
 function add_user()
 {
    if($this->session->userdata('logged_in'))
    {
        if ($this->input->post('adduser_username', TRUE) && $type=$this->input->post('adduser_type', TRUE) && $this->input->post('adduser_password2', TRUE))
        {
            $username=$this->input->post('adduser_username', TRUE);
            $type=$this->input->post('adduser_type', TRUE);
            $password=$this->input->post('adduser_password2', TRUE);
           
            if(!$this->user_model->check_if_username_exists($username))
            {
               $result=$this->user_model->add($username,$password,$type);
               if($result)
                  echo json_encode(array('message'=>'User successfully created!','status'=>TRUE));
               else
                  echo json_encode(array('message'=>'Oops something is not right, Please try again!','status'=>FALSE)); 
            }
            else {
                echo json_encode(array('message'=>'The Username already exists, try another one!','status'=>FALSE)); 
            }

        }
    }
 }
 
 
 function change_password()
 {
    if($this->session->userdata('logged_in')) 
    {
        if ($this->input->post('current_password', TRUE) && $this->input->post('new_password', TRUE) && $this->input->post('confirm_password', TRUE))
         {
             //verify the old password 
             $result = $this->user_model->verify($this->session->userdata('logged_in')['username'], $this->input->post('current_password', TRUE));
             //change the password
             if($result)
             {
                 if($this->user_model->change_password($this->session->userdata('logged_in')['username'],$this->input->post('new_password', TRUE)))
                 {
                     $this->session->unset_userdata('logged_in');
                     session_destroy();
                     echo json_encode (array('message'=>'Password Changed Successfully! Please login to Continue','status'=>TRUE));
                 }   
                 else
                     echo json_encode (array('message'=>'Oops! Try again Later','status'=>FALSE));
             } else {
                 echo json_encode(array('message'=>'Invalid Password','status'=>FALSE));
             }
         }
    }
 }
 
 
 function logout()
 {
   $this->session->unset_userdata('logged_in');
   session_destroy();
   redirect('home', 'refresh');
 }
 
 /** function that deletes user from the current database
  * 
  */
    function delete_user()
    {
        if($this->session->userdata('logged_in'))
        {
            if($this->input->post('id'))
            {
                $id=$this->input->post('id');
                if ($this->user_model->delete($id) === TRUE)
                    $data=array('status'=>TRUE,'message'=>'User deleted!');
                else
                    $data=array('status'=>FALSE,'message'=>'Error deleting user, please contact Administrator!');
                echo json_encode($data);
            }
        }
    }

}

?>