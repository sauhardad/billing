<!-- modal for generating reports -->
<div class="modal fade" tabindex="-1" role="dialog" id="report_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Generate Report</h3>
            </div>
            <div class="modal-body">
                <table class="table-padding-10">
                    <tr class="show">
                        <td>
                            <label for="generate_report_type">Report Type</label>
                        </td>
                        <td colspan="3">
                            <?php echo form_dropdown('generate_report_type', array("0"=>"Select Report Type")+$this->config->item('report_types'), "0",'class="form-control" id="generate_report_type" onchange="return reportModalAction(this);"'); ?>
                        </td>
                    </tr>
                    <tr class="hide" id="select_section_tr">
                        <td>
                            <label for="select_section">Select Section</label>
                        </td>
                        <td colspan="3">
                            <?php echo form_dropdown('select_section', array("0"=>"Select Section"), "0",'class="form-control" id="select_section" onchange="return reportModalAction(this);"'); ?>
                        </td>
                    </tr>
                    <tr class="hide" id="select_expense_type_tr">
                        <td>
                            <label for="select_expense_type">Select Expense Type</label>
                        </td>
                        <td colspan="3">
                            <?php echo form_dropdown('select_expense_type', array("0"=>"Select Expense Type")+$this->config->item('expense_types'), "0",'class="form-control" id="select_expense_type" onchange="return reportModalAction(this);"'); ?>
                        </td>
                    </tr>
                    <tr class="hide" id="select_subsection_tr">
                        <td>
                            <label for="select_subsection">Select Subsection</label>
                        </td>
                        <td colspan="3">
                            <?php echo form_dropdown('select_subsection', array("0"=>"Select Subection"), "0",'class="form-control" id="select_subsection" onchange="return reportModalAction(this);"'); ?>
                        </td>
                    </tr>
                    <tr class="hide" id="select_group_tr">
                        <td>
                            <label for="select_group">Select Group</label>
                        </td>
                        <td colspan="3">
                            <?php echo form_dropdown('select_group', array("all"=>"All","specific"=>"Specific"), "0",'class="form-control" id="select_group" onchange="return reportModalAction(this);"'); ?>
                        </td>
                    </tr>
                    <tr class="hide" id="search_group_tr">
                        <td>
                            <label for="search_group">Group Name</label>
                        </td>
                        <td colspan="3">
                            <input type="text" id="search_group" class="form-control"/>
                        </td>
                    </tr>
                    <tr class="hide" id="select_user_tr">
                        <td>
                            <label for="select_user">Select User</label>
                        </td>
                        <td colspan="3">
                            <?php echo form_dropdown('select_user',array("0"=>"ALL"), "0",'class="form-control" id="select_user"'); ?>
                        </td>
                    </tr>
                    <tr class="hide" id="select_duration_tr">
                        <td>
                            <label for="select_duration">Select Duration</label>
                        </td>
                        <td colspan="3">
                            <?php echo form_dropdown('select_duration',array("1"=>"Today","2"=>"Week","3"=>"Month"), "1",'class="form-control" id="select_duration"'); ?>
                        </td>
                    </tr>
                </table>    

                <input class="btn btn-primary" type="button" id="generate_report" value="Generate" onclick="return reportModalAction(this);">
            </div>
        </div>
    </div>    
</div>
<!--end of modal for generating reports -->


<div class="modal fade" id="password_modal" tabindex="-1" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content" style="height:300px;">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <div>
                <form id="frm_change_password" method="post" action="<?=base_url('user/change_password')?>">
                    <h4>Change Password</h4>
                    <input type="password" id="current_password" name="current_password" class="form-control input-sm chat-input" placeholder="Old Password" />
                    </br>
                    <input type="password" id="new_password" name="new_password" class="form-control input-sm chat-input" placeholder="New Password" />
                    </br>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control input-sm chat-input" placeholder="Confirm Password" />
                    </br>
                    <div class="wrapper">
                        <span class="group-btn">     
                            <input type="submit" id="change_password" class="btn btn-primary btn-md" value="Change"/>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if ($session_data['role']=$this->config->item('role_admin')){ ?>
<div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Users</h4>
                <a data-toggle="modal" data-target="#add_user_modal" class="btn btn-success"><span class="glyphicon glyphicon-user glyphicon-margin-right-5"></span> Add User</a>
            </div>
            <div class="modal-body">
                <table class="table toggle-circle-filled footable table-striped table-hover table-responsive" data-filter="#search" data-page-size="10" style="width: 100%;">
                    <thead>
                        <tr>
                            <th data-toggle="true">Username
                            </th>
                            <th data-hide="phone">Role
                            </th>
                            <th>Last Login
                            </th>
                            <th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($users)){ ?>
                            <?php foreach($users as $user){ ?>
                                <tr>
                                    <td><span><?php echo $user->username; ?></span></td>
                                    <td><span class="editusr-btn-<?php echo $user->role; ?>" title="Role"><?php echo $this->config->item($user->role,'role_value'); ?></span></td>
                                    <td><span><?php echo (strtotime($user->last_login) == 0)? "Not Logged in Yet": $user->last_login; ?></span></td>
                                    <td><a href="javascript:void(0);" onclick="return deleteUser(this,'<?php echo $user->id; ?>')"><span class="btn btn-danger" title="Delete">Delete</span></a></td>
                                  </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                <div class="pagination pagination-centered">
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="add_user_modal" tabindex="-1" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            
             <div class="row">
                        <form id="frm_add_user" method="post" action="<?=base_url('user/add_user')?>">
                            <h4>Add User</h4>
                            <select id="adduser_type" name="adduser_type" class="form-control">
                                <option value="0" selected>Select User Type</option>
                                <?php foreach($roles as $key=>$value) { ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                <?php } ?>
                                
                            </select>  
                            </br>
                            <input type="text" id="adduser_username" name="adduser_username" class="form-control input-sm chat-input" placeholder="Username"/>
                            </br>
                            <input type="password" id="adduser_password1" name="adduser_password1" class="form-control input-sm chat-input" placeholder="Password" />
                            </br>
                            <input type="password" id="adduser_password2" name="adduser_password2" class="form-control input-sm chat-input" placeholder="Confirm Password" />
                            </br>
                            <div class="wrapper">
                                <span class="group-btn">     
                                    <input type="submit" id="add_user" class="btn btn-primary btn-md" value="Add"/>
                                </span>
                            </div>
                        </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>