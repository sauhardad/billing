<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//custom config file created to add customized settings and variables
$config['role_value'] = array('1'=>'Admin','2'=>'Accountant');
$config['role_admin'] = 1;
$config['role_accountant']=2;
$config['report_types']=array('group-summary'=>'Group(Summary)',
                              'group-checking'=>'Group(Checking)',
                              'group-contact'=>'Group(Contact)',
                              'group-account'=>'Group(Account Ledger)',
                              'transaction'=>'Transaction',  
                              'income'=>'Income',
                              'expense'=>'Expense'  
                             );
$config['expense_types']=array('teacher'=>'Teacher',
                               'staff'=>'Staff',
                               'stationary'=>'Stationary',
                               'payable'=>'Payables',
                               'loan'=>'Loan',
                               'saving'=>'Saving'
                             );
$config['expense_type_key']=array('teacher'=>1,
                               'staff'=>2,
                               'stationary'=>3,
                               'payable'=>4,
                               'loan'=>5,
                               'saving'=>6
                            );