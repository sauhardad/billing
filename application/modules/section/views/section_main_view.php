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
                        <?php debug_array($sections); ?>
                        <?php foreach($sections as $section){ ?>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $section['code']; ?></td>
                                <td><?php echo $section['name']; ?></td>
                                <td>
                                    <button class="btn btn-danger" onclick="return deleteData('<?php echo $section['id']; ?>','section/delete',this)"><span class="glyphicon glyphicon-edit">Delete</span></button>
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
                                    <label for="code">Section Code</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="code" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="name">Section Name</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="name" class="form-control input-sm">
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
