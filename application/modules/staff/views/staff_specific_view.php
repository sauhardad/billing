<div class="container">
        <section style="padding-bottom: 50px; padding-top: 50px;">
            <div class="row">
                <div class="col-md-12">
                    <label>Name :<?php echo $staff['name']; ?></label><br>
                    <label>Address :<?php echo $staff['address']; ?></label><br>
                    <label>Contact No :<?php echo $staff['contact']; ?></label><br>
                    <label>Post :<?php echo $staff['post']; ?></label><br>
                    <br>
                    
                    <br /><br/>
                </div>
                <!-- table for adding and editing salary -->
                <div class="col-md-8">
                   <h2 style="display:inline-block;">Salary</h2>
                   <button style="margin:1.5%;vertical-align: top;" class="btn" data-toggle="modal" data-target="#add_salary_modal" type="button"> <span class="glyphicon glyphicon-plus"></span></button>
                <table class="table table-bordered table-striped" id="student_courses">
                    <thead>
                        <th>S.N.</th>
                        <th>Month</th>
                        <th>Entitled Salary</th>
                        <th>Fine</th>
                        <th>Net Salary</th>
                        <th>Remark</th>
                        <td></td>
                    </thead>
                    <tbody>
                        <?php if(isset($salaries)){ ?>
                        <?php $sn=1; ?>
                        <?php $month_map=$this->config->item('monthlist'); ?>
                        <?php foreach($salaries as $salary){ ?>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $month_map[$salary['month']]; ?></td>
                                <td><?php echo $salary['e_salary']; ?></td>
                                <td><?php echo $salary['fine']; ?></td>
                                <td><?php echo $salary['net_salary'];?></td>
                                <td><?php echo $salary['remark'];?></td>
                                <td><button class="btn btn-primary edit_staff_salary_btn" data-entitled_id="<?php echo $salary['id']; ?>" data-month="<?php echo $salary['month']; ?>" data-e_salary="<?php echo $salary['e_salary']; ?>" data-fine="<?php echo $salary['fine']; ?>" data-net_salary="<?php echo $salary['net_salary']; ?>" data-remark="<?php echo $salary['remark']; ?>" data-toggle="modal" data-target="#edit_salary_modal"><span class="glyphicon glyphicon-edit glyphicon-margin-right-5"></span>Edit</button></td>
                                </tr> 
                            <?php $sn++; ?>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                    </tbody>
               </table>
            </div>
        <!-- modal for adding Salary -->
        <div class="modal fade" tabindex="-1" role="dialog" id="add_salary_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Add Salary</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('staff/add_staff_salary',array('id' => 'add_staff_salary_form')); ?>
                        <input type="hidden" name="staff_id" id="staff_id" value="<?php echo $id; ?>"/>
                        <table class="table-padding-10">
                               <tr>
                                <td>
                                    <label for="add_month_dropdown">Month</label>
                                </td>
                                <td colspan="3">
                                    <?php echo form_dropdown('add_month_dropdown', array_merge(array("0"=>"Select Month"),$this->config->item('monthlist')), "0",'class="form-control" id="add_month_dropdown";"'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_entitled_salary">Entitled Salary</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_entitled_salary" id="add_entitled_salary" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_fine_amount">Fine Amount</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_fine_amount" id="add_fine_amount" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_remark">Remark</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_remark" id="add_remark" class="form-control input-sm">
                                </td>
                            </tr>
                        </table>    
                        
                        <input class="btn btn-primary" type="submit" value="Save">
                        <?php echo form_close(); ?>
                        
                    </div>
                </div>
            </div>    
        </div>
        
        <!-- modal for editing Salary -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_salary_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Edit Salary</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('staff/edit_staff_salary',array('id' => 'edit_staff_salary_form'),array('edit_staff_salary_id' => '')); ?>
                        <input type="hidden" name="staff_id" id="staff_id" value="<?php echo $id; ?>"/>
                        <table class="table-padding-10">
                               <tr>
                                <td>
                                    <label for="edit_month_dropdown">Month</label>
                                </td>
                                <td colspan="3">
                                    <?php echo form_dropdown('edit_month_dropdown', array_merge(array("0"=>"Select Month"),$this->config->item('monthlist')), "0",'class="form-control" id="edit_month_dropdown";"'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_entitled_salary">Entitled Salary</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_entitled_salary" id="edit_entitled_salary" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_fine_amount">Fine Amount</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_fine_amount" id="edit_fine_amount" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_remark">Remark</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_remark" id="edit_remark" class="form-control input-sm">
                                </td>
                            </tr>
                        </table>    
                        
                        <input class="btn btn-primary" type="submit" value="Save">
                        <?php echo form_close(); ?>
                        
                    </div>
                </div>
            </div>    
        </div>
        </section>
        <!-- SECTION END -->
    </div>
    <!-- CONATINER END -->
</body>
