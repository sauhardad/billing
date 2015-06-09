<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//custom config file created to add customized settings and variables
$config['role_value'] = array('1'=>'Admin','2'=>'Accountant');
$config['role_admin'] = 1;
$config['role_accountant']=2;
$config['report_types']=array('group-summary'=>'Group(Summary)',
                              'group-checking'=>'Group(Checking)',
                              'group-contact'=>'Group(Contact)',
                              'transaction'=>'Transaction',  
                              'income'=>'Income'
                             );