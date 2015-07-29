<div class="col-md-12" >
            <div style="min-height: 70px;">
              <div class="page-header" id="fix-page-header">
                <div> 
                  <h2 style="display:inline-block;">Staff</h2>
                  <button style="margin:1.5%;vertical-align: top;" class="btn" data-toggle="modal" data-target="#add_staff_modal" type="button"> <span class="glyphicon glyphicon-plus"></span></button>
                </div>
              </div>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Post</th>
                        <th>Salary</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php if(isset($staffs)){ ?>
                        <?php $sn=1; ?>
                        <?php foreach($staffs as $staff){ ?>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                 <td> <a href="<?php echo base_url('staff/view/'.$staff['id']); ?>"> <?php echo $staff['name']; ?></a></td>
                                <td><?php echo $staff['address']; ?></td>
                                <td><?php echo $staff['contact']; ?></td>
                                <td><?php echo $staff['post']; ?></td>
                                <td><?php echo $staff['salary']; ?></td>
                                <td>
                                    <button class="btn btn-primary edit_staff_btn" data-id="<?php echo $staff['id']; ?>" data-name="<?php echo $staff['name']; ?>" data-address="<?php echo $staff['address']; ?>" data-contact="<?php echo $staff['contact']; ?>" data-post="<?php echo $staff['post']; ?>" data-salary="<?php echo $staff['salary']; ?>" data-toggle="modal" data-target="#edit_staff_modal"><span class="glyphicon glyphicon-edit glyphicon-margin-right-5"></span>Edit</button>
                                    <!--<button class="btn btn-danger" onclick="return deleteData('<?php echo $teacher['id']; ?>','teacher/delete',this)"><span class="glyphicon glyphicon-trash glyphicon-margin-right-5"></span>Delete</button>-->
                                </td>
                            </tr> 
                            <?php $sn++; ?>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- modal for adding staffs -->
        <div class="modal fade" tabindex="-1" role="dialog" id="add_staff_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Add Staff</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('staff/add',array('id' => 'add_staff_form')); ?>
                        <table class="table-padding-10">
                            <tr>
                                <td>
                                    <label for="add_staff_name">Staff Name</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_staff_name" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_staff_contact_no">Contact Number</label>
                                </td>
                                <td>
                                    <input type="text" name="add_staff_contact_no" class="form-control input-sm nepali-date">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_staff_address">Address</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_staff_address" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_staff_post">Post</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_staff_post" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_staff_salary">Salary</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_staff_salary" class="form-control input-sm">
                                </td>
                            </tr>
                        </table>    
                        
                        <input class="btn btn-primary" type="submit" value="Save" id="submit">
                        <?php echo form_close(); ?>
                        
                    </div>
                </div>
            </div>    
        </div>
        
        <!-- modal for editing staffs -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_staff_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Edit Staff</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('staff/edit',array('id' => 'edit_staff_form'),array('edit_staff_id' => '')); ?>
                        <table class="table-padding-10">
                            <tr>
                                <td>
                                    <label for="edit_staff_name">Staff Name</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_staff_name" id="edit_staff_name" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_staff_contact_no">Contact Number</label>
                                </td>
                                <td>
                                    <input type="text" name="edit_staff_contact_no" id="edit_staff_contact_no" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_staff_address">Address</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_staff_address" id="edit_staff_address" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_staff_post">Post</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_staff_post" id="edit_staff_post" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_staff_salary">Salary</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_staff_salary" id="edit_staff_salary" class="form-control input-sm">
                                </td>
                            </tr>
                        </table>    
                        <input class="btn btn-primary" type="submit" value="Save">
                        <?php echo form_close(); ?>
                        
                    </div>
                </div>
            </div>    
        </div>

</div>
