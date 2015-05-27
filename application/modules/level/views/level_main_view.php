<div class="col-md-12" >
            <div style="min-height: 70px;">
              <div class="page-header" id="fix-page-header">
                <div> 
                  <h2 style="display:inline-block;">Levels</h2>
                  <button style="margin:1.5%;vertical-align: top;" class="btn" data-toggle="modal" data-target="#add_level_modal" type="button"> <span class="glyphicon glyphicon-plus"></span></button>
                </div>
              </div>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>S.N</th>
                        <th>Subsection</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php if(isset($levels)){ ?>
                        <?php $sn=1; ?>
                        <?php $subsection_map=convert_to_keyvalue($subsections); ?>
                        <?php foreach($levels as $level){ ?>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $subsection_map[$level['subsection_id']]; ?></td>
                                <td><?php echo $level['code']; ?></td>
                                <td><?php echo $level['name']; ?></td>
                                <td>
                                    <button class="btn btn-primary edit_level_btn" data-id="<?php echo $level['id']; ?>" data-subsection="<?php echo $level['subsection_id']; ?>" data-code="<?php echo $level['code']; ?>" data-name="<?php echo $level['name']; ?>" data-toggle="modal" data-target="#edit_level_modal"><span class="glyphicon glyphicon-edit">Edit</span></button>
                                    <!--<button class="btn btn-danger" onclick="return deleteData('<?php echo $level['id']; ?>','level/delete',this)"><span class="glyphicon glyphicon-trash">Delete</span></button>-->
                                </td>
                            </tr> 
                            <?php $sn++; ?>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
       
        <!-- modal for adding level -->
        <div class="modal fade" tabindex="-1" role="dialog" id="add_level_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Add Level</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('level/add',array('id' => 'add_level_form')); ?>
                        <table class="table-padding-10">
                            <tr>
                                <td>
                                    <label for="add_level_code">Level Code</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_level_code" id="add_level_code" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_level_name">Level Name</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_level_name" id="add_level_name" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_subsection_dropdown">Subsection</label>
                                </td>
                                <td colspan="3"  aria-invalid="true">
                                    <?php echo form_dropdown('add_subsection_dropdown',convert_to_keyvalue($subsections),TRUE,'class="form-control" id="add_subsection_dropdown"'); ?>
                                </td>
                            </tr>
                        </table>    
                        
                        <input class="btn btn-primary" type="submit" value="Save">
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>    
        </div>
        
        <!-- modal for editing level -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_level_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Edit Level</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('level/edit',array('id' => 'edit_level_form'),array('edit_level_id' => '')); ?>
                        <table class="table-padding-10">
                            <tr>
                                <td>
                                    <label for="edit_level_code">Level Code</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_level_code" id="edit_level_code" class="form-control input-sm" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_level_name">Level Name</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_level_name" id="edit_level_name" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_subsection_dropdown">Subsection</label>
                                </td>
                                <td colspan="3"  aria-invalid="true">
                                    <?php echo form_dropdown('edit_subsection_dropdown', convert_to_keyvalue($subsections),TRUE,'class="form-control" id="edit_subsection_dropdown"'); ?>
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
