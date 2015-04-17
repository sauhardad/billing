<div class="col-md-12" >
            <div style="min-height: 70px;">
              <div class="page-header" id="fix-page-header">
                <div> 
                  <h2 style="display:inline-block;">Teachers</h2>
                  <button style="margin:1.5%;vertical-align: top;" class="btn" data-toggle="modal" data-target="#add_teacher_modal" type="button"> <span class="glyphicon glyphicon-plus"></span></button>
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
                        <th></th>
                    </thead>
                    <tbody>
                        <?php if(isset($teachers)){ ?>
                        <?php $sn=1; ?>
                        <?php foreach($teachers as $teacher){ ?>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $teacher['teacher_name']; ?></td>
                                <td><?php echo $teacher['address']; ?></td>
                                <td><?php echo $teacher['contact_no']; ?></td>
                                <td>
                                    <button class="btn btn-primary edit_teacher_btn" data-id="<?php echo $teacher['id']; ?>" data-name="<?php echo $teacher['teacher_name']; ?>" data-address="<?php echo $teacher['address']; ?>" data-contact="<?php echo $teacher['contact_no']; ?>" data-toggle="modal" data-target="#edit_teacher_modal"><span class="glyphicon glyphicon-edit glyphicon-margin-right-5"></span>Edit</button>
                                    <button class="btn btn-danger" onclick="return deleteData('<?php echo $teacher['id']; ?>','teacher/delete',this)"><span class="glyphicon glyphicon-trash glyphicon-margin-right-5"></span>Delete</button>
                                </td>
                            </tr> 
                            <?php $sn++; ?>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- modal for adding teachers -->
        <div class="modal fade" tabindex="-1" role="dialog" id="add_teacher_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Add Teacher</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('teacher/add',array('id' => 'add_teacher_form')); ?>
                        <table class="table-padding-10">
                            <tr>
                                <td>
                                    <label for="add_teacher_name">Teacher Name</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_teacher_name" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_contact_no">Contact Number</label>
                                </td>
                                <td>
                                    <input type="text" name="add_contact_no" class="form-control input-sm nepali-date">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_address">Address</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_address" class="form-control input-sm">
                                </td>
                            </tr>
                        </table>    
                        
                        <input class="btn btn-primary" type="submit" value="Save" id="submit">
                        <?php echo form_close(); ?>
                        
                    </div>
                </div>
            </div>    
        </div>
        
        <!-- modal for editing teachers -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_teacher_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Edit Teacher</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('teacher/edit',array('id' => 'edit_teacher_form'),array('edit_teacher_id' => '')); ?>
                        <table class="table-padding-10">
                            <tr>
                                <td>
                                    <label for="edit_teacher_name">Teacher Name</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_teacher_name" id="edit_teacher_name" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_contact_no">Contact Number</label>
                                </td>
                                <td>
                                    <input type="text" name="edit_contact_no" id="edit_contact_no" class="form-control input-sm nepali-date">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_address">Address</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_address" id="edit_address" class="form-control input-sm">
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
