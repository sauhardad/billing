<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   session_start(); 
    //check login
   if(!$this->session->userdata('logged_in'))
       redirect('user/login', 'refresh');
   
   $this->load->helper(array('form'));
 }
 
 function index()
 {
     if(($type=$this->input->get('type')))
     {
         $all_flag=$this->input->get('all_flag');
         $id=$this->input->get('id'); 
        
     }
 }
 
 
}

?>