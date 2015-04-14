<div class="col-md-12" >
            <div style="min-height: 70px;">
              <div class="page-header" id="fix-page-header">
                <div> 
                  <h2 style="display:inline-block;">Groups</h2>
                  <button style="margin:1.5%;vertical-align: top;" class="btn" data-toggle="modal" data-target="#add_group_modal" type="button"> <span class="glyphicon glyphicon-plus"></span></button>
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
                                <td><?php echo $group['is_running']; ?></td>
                                <td>
                                    <button class="btn btn-danger" onclick="return deleteData('<?php echo $group['id']; ?>','group/delete',this)"><span class="glyphicon glyphicon-edit">Delete</span></button>
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
                                    <label for="group_code">Group Code</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="group_code" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="group_name">Group Name</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="group_name" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="time_slot">Time Slot</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="time_slot" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="is_running">Is Running</label>
                                </td>
                                <td colspan="3">
                                    <?php echo form_dropdown('is_running', array(TRUE=>'Yes',FALSE=>'No'), TRUE); ?>
                                </td>
                            </tr>
                        </table>    
                        
                        <input class="btn btn-primary" type="submit" value="Save" id="submit">
                        <?php echo form_close(); ?>
                        
                    </div>
                </div>
            </div>    
        </div>

</div>
