<div class="col-md-12" >
            <div style="min-height: 70px;">
              <div class="page-header" id="fix-page-header">
                <div> 
                  <h2 style="display:inline-block;">Sections</h2>
                  <button style="margin:1.5%;vertical-align: top;" class="btn" data-toggle="modal" data-target="#add_section_modal" type="button"> <span class="glyphicon glyphicon-plus"></span></button>
                </div>
              </div>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>S.N.</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php if(isset($sections)){ ?>
                        <?php $sn=1; ?>
                        <?php foreach($sections as $section){ ?>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $section['code']; ?></td>
                                <td><?php echo $section['name']; ?></td>
                                <td>
                                    <a class="btn btn-success" href="<?php echo base_url('section/view/'.$section['id']); ?>"><span class="glyphicon glyphicon-list glyphicon-margin-right-5"></span>View</a>
                                    <button class="btn btn-primary edit_section_btn" data-id="<?php echo $section['id']; ?>" data-code="<?php echo $section['code']; ?>" data-name="<?php echo $section['name']; ?>" data-toggle="modal" data-target="#edit_section_modal"><span class="glyphicon glyphicon-edit glyphicon-margin-right-5"></span>Edit</button>
                                    <!--<button class="btn btn-danger" onclick="return deleteData('<?php echo $section['id']; ?>','section/delete',this)"><span class="glyphicon glyphicon-trash glyphicon-margin-right-5"></span>Delete</button>-->
                                </td>
                            </tr> 
                            <?php $sn++; ?>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- modal for adding section -->
        <div class="modal fade" tabindex="-1" role="dialog" id="add_section_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Add Section</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('section/add',array('id' => 'add_section_form')); ?>
                        <table class="table-padding-10">
                            <tr>
                                <td>
                                    <label for="add_section_code">Section Code</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_section_code" class="form-control input-sm" value="<?php echo $new_section_code; ?>" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_section_name">Section Name</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_section_name" class="form-control input-sm">
                                </td>
                            </tr>
                            
                            
                           
                        </table>    
                        
                        <input class="btn btn-primary" type="submit" value="Save">
                        <?php echo form_close(); ?>
                        
                    </div>
                </div>
            </div>    
        </div>
        
        
        <!-- modal for editing section -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_section_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Edit Section</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('section/edit',array('id' => 'edit_section_form'),array('edit_section_id' => '')); ?>
                        <table class="table-padding-10">
                            <tr>
                                <td>
                                    <label for="edit_section_code">Section Code</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_section_code" id="edit_section_code" class="form-control input-sm" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_section_name">Section Name</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_section_name" id="edit_section_name" class="form-control input-sm">
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
