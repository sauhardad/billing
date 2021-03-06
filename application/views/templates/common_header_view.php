<!DOCTYPE html>
<html lang="en">
 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
  
   <title>Valley Billing System - Private Area</title>
   
   <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
   <link href="<?=base_url()?>assets/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
   <link href="<?=base_url()?>assets/css/fileinput.min.css" rel="stylesheet" type="text/css">
   <link href="<?=base_url()?>assets/css/jquery.calendars.picker.css" rel="stylesheet" type="text/css">
   <link href="<?=base_url()?>assets/css/jquery-ui.min.css" rel="stylesheet" type="text/css"> 
   <link href="<?=base_url()?>assets/css/picedit.min.css" rel="stylesheet" type="text/css"> 
   <link href="<?=base_url()?>assets/css/token-input.css" rel="stylesheet" type="text/css"> 
   <link href="<?=base_url()?>assets/css/token-input-facebook.css" rel="stylesheet" type="text/css"> 
   <link href="<?=base_url()?>assets/css/home_view.css" rel="stylesheet" type="text/css"> 
       
   <script src="<?=base_url()?>assets/js/jquery.min.js"></script>    
   <script src="<?=base_url()?>assets/js/jquery-ui.min.js"></script>    
   <script src="<?=base_url()?>assets/js/jquery.validate.min.js"></script>    
   <script src="<?=base_url()?>assets/js/jquery.form.min.js"></script>    
   <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script> 
   <script src="<?=base_url()?>assets/js/fileinput.min.js"></script> 
   <script src="<?=base_url()?>assets/js/bootstrap-select.min.js"></script> 
   <script src="<?=base_url()?>assets/js/custom_validation.js"></script>
   <script src="<?=base_url()?>assets/js/custom_autocomplete.js"></script>
   
   <!-- fo the picture edit tool -->
   <script src="<?=base_url()?>assets/js/picedit.min.js"></script>
   
   <!-- for the tokenizer autocomplete plugin -->
   <script src="<?=base_url()?>assets/js/jquery.tokeninput.js"></script>
   
   <!-- for the jquery plugin calender -->
   <script src="<?=base_url()?>assets/js/jquery.plugin.min.js"></script>
   <script src="<?=base_url()?>assets/js/jquery.calendars.all.min.js"></script>
   <script src="<?=base_url()?>assets/js/jquery.calendars.nepali.js"></script>
   
   <!-- now custom javascript -->
   <script src="<?=base_url()?>assets/js/home_view.js"></script>   
   
   <script>var base_url='<?php echo base_url(); ?>';</script>
   <script>var user_id='<?php echo $session_data['id']; ?>';</script>
   
   <!-- [if lt IE 9] -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <!-- [endif]-->

 </head>
 <body>
     <div>
       <nav class="navbar navbar-fixed-right navbar-minimal animate" role="navigation">
		<div class="navbar-toggler animate">
			<span class="menu-icon"></span>
		</div>
		<ul class="navbar-menu animate">
                        <!--<?php if(!($this->router->fetch_class() === 'home' && $this->router->fetch_method() === 'index')){ ?>
                        <li>
				<a href="<?php echo base_url('home');?>" class="animate">
					<span class="desc animate"> Home </span>
					<span class="glyphicon glyphicon-home"></span>
				</a>
			</li>
                        <?php } ?>-->
                        <?php if(!($this->router->fetch_class() === 'student' && $this->router->fetch_method() === 'index')){ ?>
                        <li>
				<a href="<?php echo base_url('student');?>" class="animate">
					<span class="desc animate">Students </span>
					<span class="glyphicon glyphicon-home"></span>
				</a>
			</li>
                        <?php } ?>
                        <li>
				<a href="#report_modal" data-toggle="modal" class="animate">
					<span class="desc animate">Report </span>
					<span class="glyphicon glyphicon-list-alt"></span>
				</a>
			</li>
                        <li>
				<a href="<?php echo base_url('teacher');?>" class="animate">
					<span class="desc animate"> Teachers </span>
					<span class="glyphicon glyphicon-pencil"></span>
				</a>
			</li>
                        <li>
				<a href="<?php echo base_url('section');?>" class="animate">
					<span class="desc animate">Sections </span>
					<span class="glyphicon glyphicon-th-large"></span>
				</a>
			</li>
                        <li>
				<a href="<?php echo base_url('staff');?>" class="animate">
					<span class="desc animate">Staff </span>
					<span class="glyphicon glyphicon-tower"></span>
				</a>
			</li>
                        <li>
				<a href="<?php echo base_url('expense');?>" class="animate">
					<span class="desc animate">Expenses </span>
					<span class="glyphicon glyphicon-usd"></span>
				</a>
			</li>

                        <?php if ($session_data['role']==$this->config->item('role_admin')){ ?>
                        <li>
                                    <a href="#add_user" class="animate" data-toggle="modal">
                                            <span class="desc animate"> Users </span>
                                            <span class="glyphicon glyphicon-user"></span>
                                    </a>
                        </li>
                        <?php } ?>
			<li>
				<a href="#password_modal" data-toggle="modal" class="animate">
					<span class="desc animate"> Change Password </span>
					<span class="glyphicon glyphicon-cog"></span>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url('user/logout');?>" class="animate">
					<span class="desc animate"> Logout </span>
					<span class="glyphicon glyphicon-log-out"></span>
				</a>
			</li>
		</ul>
	</nav>
         
    </div>