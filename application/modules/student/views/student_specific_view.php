<div class="container">
        <section style="padding-bottom: 50px; padding-top: 50px;">
            <div class="row">
                <div class="col-md-4">
                    <img src="http://localhost/billing/assets/img/user_uploads"<?php echo $student['photo']; ?>>
                    <br />
                    <br />
                    
                    <label>Name :<?php echo $student['student_name']; ?></label><br>
                    <label>Address :<?php echo $student['address']; ?></label><br>
                    <label>Contact No :<?php echo $student['contact_no']; ?></label><br>
                    <label>Date of Birth :<?php echo $student['dob']; ?></label><br>
                    <label>Total Amount:<?php echo $student['total_amount']; ?></label><br>
                    <br>
                    
                    <br /><br/>
                </div>
               <div class="col-md-8">
                   <h2 style="display:inline-block;">Add Payment</h2>
                   <button style="margin:1.5%;vertical-align: top;" class="btn" data-toggle="modal" data-target="#add_payment_modal" type="button"> <span class="glyphicon glyphicon-plus"></span></button>
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>S.N.</th>
                        <th>Bill Number</th>
                        <th>Paid</th>
                        <th>Due</th>
                        <th>Date</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php if(isset($payments)){ ?>
                        <?php $sn=1; ?>
                        <?php foreach($payments as $payment){ ?>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $payment['bill_no']; ?></td>
                                <td><?php echo $payment['paid_amount']; ?></td>
                                <td><?php echo $payment['due_amount']; ?></td>
                                <td><?php echo $payment['is_running']? "Yes":"No"  ?></td>
                                <td>
                                    <button class="btn btn-primary edit_group_btn" data_bill_no="<?php echo $payment['bill_no']; ?>" data-paid="<?php echo $payment['paid_amount']; ?>" data-due="<?php echo $payment['due_amount']; ?>" data-slot="<?php echo $group['time_slot']; ?>" data-running="<?php echo $group['is_running']; ?>" data-toggle="modal" data-target="#edit__modal"><span class="glyphicon glyphicon-edit glyphicon-margin-right-5"></span>Edit</button>
                                    <button class="btn btn-danger" onclick="return deleteData('<?php echo $payment['id']; ?>','payment/delete',this)"><span class="glyphicon glyphicon-trash glyphicon-margin-right-5"></span>Delete</button>
                                </td>
                            </tr> 
                            <?php $sn++; ?>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
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
                        <?php echo form_open('payment/add',array('id' => 'add_payment_form')); ?>
                        <table class="table-padding-10">
                            <tr>
                                <td>
                                    <label for="add_bill_no">Bill Number</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_bill_no" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_paid_amount">Paid Amount</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_paid_amount" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_due_amount">Due Amount</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_due_amount" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_bill_date">Date</label>
                                </td>
                                <td>
                                    <input type="text" name="add_bill_date" class="form-control input-sm datepicker">
                                </td>
                        </table>    
                        
                        <input class="btn btn-primary" type="submit" value="Save" id="submit">
                        <?php echo form_close(); ?>
                        
                    </div>
                </div>
            </div>    
        </div>


        </section>
        <!-- SECTION END -->
    </div>
    <!-- CONATINER END -->

    <!-- REQUIRED SCRIPTS FILES -->
    <!-- CORE JQUERY FILE -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- REQUIRED BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
</body>
