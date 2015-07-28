<div class="container">
        <section style="padding-bottom: 50px; padding-top: 50px;">
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" id="staff_id" value="<?php echo $id; ?>"/>
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
                    </thead>
                    <tbody>
                        <?php if(isset($salaries)){ ?>
                        <?php $sn=1; ?>
                        <?php foreach($salaries as $salary){ ?>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $salary['month']; ?></td>
                                <td><?php echo $salary['e_salary']; ?></td>
                                <td><?php echo $salary['fine']; ?></td>
                                <td><?php echo $salary['net_salary']; ?></td>
                                </tr> 
                            <?php $sn++; ?>
                        <?php } ?>
                        <?php } ?>
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
                        <?php echo form_open('student/add_payment',array('id' => 'add_payment_form')); ?>
                        <table class="table-padding-10">
                            <tr>
                                <td>
                                    <label for="add_bill_no">Bill Number</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_bill_no" class="form-control input-sm" value="<?php if(isset($bill_no)){ echo $bill_no;}?>" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_paid_amount">Paid Amount</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_paid_amount" id="add_paid_amount" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_due_amount">Due Amount</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_due_amount" id="add_due_amount" class="form-control input-sm">
                                </td>
                            </tr>
                        </table>    
                        
                        <input class="btn btn-primary" type="submit" value="Save">
                        <?php echo form_close(); ?>
                        
                    </div>
                </div>
            </div>    
        </div>
        
        <!-- modal for adding Courses -->
        <div class="modal fade" tabindex="-1" role="dialog" id="add_course_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Add Course</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('student/add_course',array('id' => 'add_course_form')); ?>
                        <table class="table-padding-10">
                            <tr>
                                <td>
                                    <label for="add_course_subject">Subject</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_course_subject" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_course_teacher">Teacher</label>
                                </td>
                                <td colspan="3"  aria-invalid="true">
                                    <?php echo form_dropdown('add_course_teacher',array("0"=>"Select Teacher") + convert_to_keyvalue($teachers),"0",'class="form-control" id="add_course_teacher"') ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_course_amount">Amount</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_course_amount" id="add_course_amount" class="form-control input-sm">
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
