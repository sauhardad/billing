<div class="col-md-12" >
            <div style="min-height: 70px;">
              <div class="page-header" id="fix-page-header">
                <div> 
                  <h2 style="display:inline-block;"><?php echo $this_subsection['name']; ?></h2>
                  <button style="margin:1.5%;vertical-align: top;" class="btn" data-toggle="modal" data-target="#add_group_modal" type="button"> <span class="glyphicon glyphicon-plus"></span></button>
                  <input type="hidden" name="subsection_id" id="subsection_id" value="<?php echo $this_subsection['id']; ?>"/>
                </div>
              </div>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>S.N.</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Time Slot</th>
                        <th>Running</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php if(isset($groups)){ ?>
                        <?php $sn=1; ?>
                        <?php foreach($groups as $group){ ?>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $group['code']; ?></td>
                                <td><?php echo $group['name']; ?></td>
                                <td><?php echo $group['time_slot']; ?></td>
                                <td><?php echo $group['is_running']? "Yes":"No"  ?></td>
                                <td>
									<a class="btn btn-success" href="<?php echo base_url('group/view/'.$group['id']); ?>"><span class="glyphicon glyphicon-list glyphicon-margin-right-5"></span>View</a>
                                    <button class="btn btn-primary edit_group_btn" data-id="<?php echo $group['id']; ?>" data-code="<?php echo $group['code']; ?>" data-name="<?php echo $group['name']; ?>" data-slot="<?php echo $group['time_slot']; ?>" data-running="<?php echo $group['is_running']; ?>" data-toggle="modal" data-target="#edit_group_modal"><span class="glyphicon glyphicon-edit glyphicon-margin-right-5"></span>Edit</button>
                                    <!--<button class="btn btn-danger" onclick="return deleteData('<?php echo $group['id']; ?>','group/delete',this)"><span class="glyphicon glyphicon-trash glyphicon-margin-right-5"></span>Delete</button>-->
                                </td>
                            </tr> 
                            <?php $sn++; ?>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- modal for adding group -->
        <div class="modal fade" tabindex="-1" role="dialog" id="add_group_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Add Group</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('group/add',array('id' => 'add_group_form')); ?>
                        <table class="table-padding-10">
                            <tr>
                                <td>
                                    <label for="add_group_code">Group Code</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_group_code" id="add_group_code" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_group_name">Group Name</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_group_name" id="add_group_name" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_group_time_slot">Time Slot</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_group_time_slot" id="add_group_time_slot" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_group_is_running">Is Running</label>
                                </td>
                                <td colspan="3"  aria-invalid="true">
                                    <?php echo form_dropdown('add_group_is_running', array(TRUE=>'Yes',FALSE=>'No'), TRUE,'class="form-control" id="add_group_is_running"'); ?>
                                </td>
                            </tr>
                        </table>    
                        
                        <input class="btn btn-primary" type="submit" value="Save">
                        <?php echo form_close(); ?>
                        
                    </div>
                </div>
            </div>    
        </div>
        
        <!-- modal for editing group -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_group_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Edit Group</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('group/edit',array('id' => 'edit_group_form'),array('edit_group_id' => '')); ?>
                        <table class="table-padding-10">
                            <tr>
                                <td>
                                    <label for="edit_group_code">Group Code</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_group_code" id="edit_group_code" class="form-control input-sm" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_group_name">Group Name</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_group_name" id="edit_group_name" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_group_time_slot">Time Slot</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_group_time_slot" id="edit_group_time_slot" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_group_is_running">Is Running</label>
                                </td>
                                <td colspan="3"  aria-invalid="true">
                                    <?php echo form_dropdown('edit_group_is_running', array(TRUE=>'Yes',FALSE=>'No'), TRUE,'class="form-control" id="edit_group_is_running"'); ?>
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
