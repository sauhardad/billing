<div class="col-md-12" >
            <div style="min-height: 70px;">
              <div class="page-header" id="fix-page-header">
                <div> 
                  <h2 style="display:inline-block;">Subsections</h2>
                  <button style="margin:1.5%;vertical-align: top;" class="btn" data-toggle="modal" data-target="#add_subsection_modal" type="button"> <span class="glyphicon glyphicon-plus"></span></button>
                </div>
              </div>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>S.N.</th>
                        <th>Section</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php if(isset($subsections)){ ?>
                        <?php $sn=1; ?>
                        <?php $section_map=convert_to_keyvalue($sections); ?>
                        <?php foreach($subsections as $subsection){ ?>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $section_map[$subsection['section_id']]; ?></td>
                                <td><?php echo $subsection['code']; ?></td>
                                <td><?php echo $subsection['name']; ?></td>
                                <td>
                                    <button class="btn btn-primary edit_subsection_btn" data-id="<?php echo $subsection['id']; ?>" data-section="<?php echo $subsection['section_id']; ?>" data-code="<?php echo $subsection['code']; ?>" data-name="<?php echo $subsection['name']; ?>" data-toggle="modal" data-target="#edit_subsection_modal"><span class="glyphicon glyphicon-edit">Edit</span></button>
                                    <button class="btn btn-danger" onclick="return deleteData('<?php echo $subsection['id']; ?>','subsection/delete',this)"><span class="glyphicon glyphicon-remove">Delete</span></button>
                                </td>
                            </tr> 
                            <?php $sn++; ?>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
       
        <!-- modal for adding subsection -->
        <div class="modal fade" tabindex="-1" role="dialog" id="add_subsection_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Add Subsection</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('subsection/add',array('id' => 'add_subsection_form')); ?>
                        <table class="table-padding-10">
                            <tr>
                                <td>
                                    <label for="add_subsection_code">Subsection Code</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_subsection_code" id="add_subsection_code" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_subsection_name">Subsection Name</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_subsection_name" id="add_subsection_name" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_section_dropdown">Section</label>
                                </td>
                                <td colspan="3"  aria-invalid="true">
                                    <?php echo form_dropdown('add_section_dropdown',convert_to_keyvalue($sections),TRUE,'class="form-control" id="add_section_dropdown"'); ?>
                                </td>
                            </tr>
                        </table>    
                        
                        <input class="btn btn-primary" type="submit" value="Save">
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>    
        </div>
        
        <!-- modal for editing subsection -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_subsection_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Edit Subsection</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('subsection/edit',array('id' => 'edit_subsection_form'),array('edit_subsection_id' => '')); ?>
                        <table class="table-padding-10">
                            <tr>
                                <td>
                                    <label for="edit_subsection_code">Subsection Code</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_subsection_code" id="edit_subsection_code" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_subsection_name">Subsection Name</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_subsection_name" id="edit_subsection_name" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_section_dropdown">Section</label>
                                </td>
                                <td colspan="3"  aria-invalid="true">
                                    <?php echo form_dropdown('edit_section_dropdown', convert_to_keyvalue($sections),TRUE,'class="form-control" id="edit_section_dropdown"'); ?>
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
