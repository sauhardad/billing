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
                        <th>Code</th>
                        <th>Name</th>
                        <th>Section Type</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php if(isset($subsection)){ ?>
                        <?php $sn=1; ?>
                        <?php foreach($subsections as $subsection){ ?>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $subsection['code']; ?></td>
                                <td><?php echo $subsection['name']; ?></td>
                                <td><?php echo $subsection['section']; ?></td>
                                <td>
                                    <button class="btn btn-danger" onclick="return deleteData('<?php echo $subsection['id']; ?>','subsection/delete',this)"><span class="glyphicon glyphicon-edit">Delete</span></button>
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
                                    <label for="add_section_type">Add Section Type</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_section_type" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_section_type">Select Section Type</label>
                                </td>
                                <td colspan="3"  aria-invalid="true">
                                    <?php debug_array($sections); ?>
                                    <?php echo form_dropdown('add_section_type',$sections,TRUE,'class="form-control"'); ?>
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
