<div class="container">
        <section style="padding-bottom: 50px; padding-top: 50px;">
            <div class="row">
                <div class="col-md-4">
                    <div class="student-img-container">
                        <img src="
                            <?php if($students['photo']) { echo 'http://localhost/billing/assets/img/user_uploads/'.$students['photo'];}
                                  else{ echo 'http://localhost/billing/assets/img/empty.jpg'; }
                            ?>
                        ">
                    </div>    
                    <br />
                    <br />
                    <input type="hidden" id="student_id" value="<?php echo $id; ?>"/>
                    <label>Name :<?php echo $students['student_name']; ?></label><br>
                    <label>Address :<?php echo $students['address']; ?></label><br>
                    <label>Contact No :<?php echo $students['contact_no']; ?></label><br>
                    <label>Date of Birth :<?php echo $students['dob']; ?></label><br>
                    <br>
                    
                    <br /><br/>
                </div>
                <!-- table for adding and editing students courses -->
                <div class="col-md-8">
                   <h2 style="display:inline-block;">Courses</h2>
                   <button style="margin:1.5%;vertical-align: top;" class="btn" data-toggle="modal" data-target="#add_course_modal" type="button"> <span class="glyphicon glyphicon-plus"></span></button>
                <table class="table table-bordered table-striped" id="student_courses">
                    <thead>
                        <th>S.N.</th>
                        <th>Course</th>
                        <th>Teacher</th>
                        <th>Amount</th>
                    </thead>
                    <tbody>
                        <?php if(isset($courses)){ ?>
                        <?php $sn=1; ?>
                        <?php $total_sum=0; ?>
                        <?php $teacher_map=convert_to_keyvalue($teachers); ?>
                            <?php foreach($courses as $course){ ?>
                            <tr>
                                <td><span class="courses_sn"><?php echo $sn; ?></span></td>
                                <td><?php echo $course['subject']; ?></td>
                                <td><?php echo $teacher_map[$course['teacher_id']]; ?></td>
                                <td><?php echo $course['amount']; ?></td>
                            </tr> 
                            <?php $total_sum+=$course['amount']; ?>
                            <?php $sn++; ?>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                    <?php if ($total_sum!=0) { ?>
                        <tfoot>
                            <th></th>
                            <th></th>
                            <th>Total</th>
                            <th><span id="course_total_amt"><?php echo $total_sum;?></span></th>
                        </tfoot>
                    <?php } ?>
               </table>
            </div>
                
            <div class="col-md-8">
                   <h2 style="display:inline-block;">Payment</h2>
                   <button style="margin:1.5%;vertical-align: top;" class="btn" data-toggle="modal" data-target="#add_payment_modal" type="button"> <span class="glyphicon glyphicon-plus"></span></button>
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>S.N.</th>
                        <th>Bill Number</th>
                        <th>Date</th>
                        <th>Paid</th>
                        <th>Due</th>
                    </thead>
                    <tbody>
                        <?php if(isset($payments)){ ?>
                        <?php $sn=1; ?>
                        <?php $total_paid_sum=0; ?>
                        <?php foreach($payments as $payment){ ?>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $payment['bill_no']; ?></td>
                                <td><?php echo $payment['date'];  ?></td>
                                <td><?php echo $payment['paid_amount']; ?></td>
                            </tr> 
                            <?php $total_paid_sum+=$payment['paid_amount']; ?>
                            <?php $sn++; ?>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                    <?php if ($total_sum!=0) { ?>
                        <tfoot>
                            <th></th>
                            <th></th>
                            <th>Total</th>
                            <th><?php echo $total_paid_sum;?></th>
                            <th><span id="payment_due_amt"><?php echo ($total_sum-$total_paid_sum); ?></span></th>
                        </tfoot>
                    <?php } ?>
                </table>
            </div>    
        </div>
            </div>
        <!-- modal for adding Payments -->
        <div class="modal fade" tabindex="-1" role="dialog" id="add_payment_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Add Payment</h3>
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
