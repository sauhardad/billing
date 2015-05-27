<div class="col-md-12" >
            <div style="min-height: 70px;">
              <div class="page-header" id="fix-page-header">
                <div> 
                  <h2 style="display:inline-block;">Students</h2>
                  <button style="margin:1.5%;" class="btn" data-toggle="modal" data-target="#add_student_modal" type="button"> <span class="glyphicon glyphicon-plus"></span></button>
                   <div class="searchfield">
                    <form><input type="text" id="search_student" name="search_student" class="form-control input-sm" style="display: inline-block;" placeholder="Search"/></form>
                  </div>
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
                        <th>Section</th>
                        <th>Subsection</th>
                        <th>Group</th>
                        <th>Date of Birth</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php if(isset($students)){ ?>
                        <?php $sn=1; ?>
                        <?php $section_map=convert_to_keyvalue($sections); ?>
                        <?php $subsection_map=convert_to_keyvalue($subsections); ?>
                        <?php $group_map=convert_to_keyvalue($groups); ?>
                        
                        
                        <?php foreach($students as $student){ ?>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $student['student_name']; ?></td>
                                <td><?php echo $student['address']; ?></td>
                                <td><?php echo $student['contact_no']; ?></td>
                                <td><?php echo $section_map[$student['section_id']]; ?></td>
                                <td><?php echo $subsection_map[$student['subsection_id']]; ?></td>
                                <td><?php echo $group_map[$student['group_id']]; ?></td>
                                <td><?php echo $student['dob']; ?></td>
                                <td>
                                    <button class="btn btn-primary edit_student_btn" data-id="<?php echo $student['id']; ?>" data-dob="<?php echo $student['dob']; ?>" data-section="<?php echo $student['section_id']; ?>" data-subsection="<?php echo $student['subsection_id']; ?>" data-group="<?php echo $student['group_id']; ?>" data-name="<?php echo $student['student_name']; ?>" data-address="<?php echo $student['address']; ?>" data-contact="<?php echo $student['contact_no']; ?>" data-toggle="modal" data-target="#edit_student_modal"><span class="glyphicon glyphicon-edit glyphicon-margin-right-5"></span>Edit</button>
                                    <!--<button class="btn btn-danger" onclick="return deleteData('<?php echo $student['id']; ?>','student/delete',this)"><span class="glyphicon glyphicon-trash glyphicon-margin-right-5"></span>Delete</button>-->
                                </td>
                            </tr> 
                            <?php $sn++; ?>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- modal for adding Student -->
        <div class="modal fade" tabindex="-1" role="dialog" id="add_student_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Add Student</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('student/add',array('id' => 'add_student_form')); ?>
                        <table class="table-padding-10">
                            <tr>
                                <td>
                                    <label for="add_student_name">Student Name</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_student_name" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_student_photo">Picture</label>
                                </td>
                                <td colspan="3">
                                    <input type="file" name="add_student_photo" class="image">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_section_dropdown">Section</label>
                                </td>
                                <td colspan="3"  aria-invalid="true">
                                    <?php echo form_dropdown('add_section_dropdown',array("0"=>"Select Section") + convert_to_keyvalue($sections),"0",'class="form-control" id="add_section_dropdown" target="tr_add_subsection_dropdown" url-target="student/load_subsection" target-type="add" onchange="return loadDropdown(this);"') ?>
                                </td>
                            </tr>
                            <tr id="tr_add_subsection_dropdown"></tr>
                            <tr id="tr_add_group_dropdown"></tr>
                            <tr>
                                <td>
                                    <label for="add_address">Address</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_address" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_student_dob">Date of Birth</label>
                                </td>
                                <td>
                                    <input type="text" name="add_student_dob" class="form-control input-sm datepicker">
                                </td>
                                <td>
                                    <label for="add_contact_no">Contact Number</label>
                                </td>
                                <td>
                                    <input type="text" name="add_contact_no" class="form-control input-sm nepali-date">
                                </td>
                                
                            </tr>
                        </table>    
                        
                        <input class="btn btn-primary" type="submit" value="Save" id="submit">
                        <?php echo form_close(); ?>
                        
                    </div>
                </div>
            </div>    
        </div>
        
        <!-- modal for editing students -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_student_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Edit Student</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('student/edit',array('id' => 'edit_student_form'),array('edit_student_id' => '')); ?>
                        <table class="table-padding-10">
                            <tr>
                                <td>
                                    <label for="edit_student_name">Student Name</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_student_name" id="edit_student_name" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_section_dropdown">Section</label>
                                </td>
                                <td colspan="3"  aria-invalid="true">
                                    <?php echo form_dropdown('edit_section_dropdown',array("0"=>"Select Section") + convert_to_keyvalue($sections),"0",'class="form-control" id="edit_section_dropdown" target="tr_edit_subsection_dropdown" url-target="student/load_subsection" target-type="edit" onchange="return loadDropdown(this);"'); ?>
                                </td>
                            </tr>
                            <tr id="tr_edit_subsection_dropdown">
                                <td>
                                    <label for="edit_subsection_dropdown">Subsection</label>
                                </td>
                                <td colspan="3"  aria-invalid="true">
                                    <?php echo form_dropdown('edit_subsection_dropdown',array("0"=>"Select Subsection") + convert_to_keyvalue($subsections),"0",'class="form-control" id="edit_subsection_dropdown"'); ?>
                                </td>
                            </tr>
                            <tr id="tr_edit_group_dropdown">
                                <td>
                                    <label for="edit_group_dropdown">Group</label>
                                </td>
                                <td colspan="3"  aria-invalid="true">
                                    <?php echo form_dropdown('edit_group_dropdown',array("0"=>"Select Group") + convert_to_keyvalue($groups),"0",'class="form-control" id="edit_group_dropdown"'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_address">Address</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_address" id="edit_address" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_student_dob">Date of Birth</label>
                                </td>
                                <td>
                                    <input type="text" name="edit_student_dob" id="edit_student_dob" class="form-control input-sm datepicker">
                                </td>
                                <td>
                                    <label for="edit_contact_no">Contact Number</label>
                                </td>
                                <td>
                                    <input type="text" name="edit_contact_no" id="edit_contact_no" class="form-control input-sm nepali-date">
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
