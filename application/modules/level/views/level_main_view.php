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
                        <th>S.N.</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Type</th>
                        
                        <th>Subsection</th><th></th>
                    </thead>
                    <tbody>
                        <?php if(isset($levels)){ ?>
                        <?php $sn=1; ?>
                        <?php foreach($levels as $level){ ?>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $level['code']; ?></td>
                                <td><?php echo $level['name']; ?></td>
                                <td><?php echo $level['type']; ?></td>
                                <td>
                                    <button class="btn btn-danger" onclick="return deleteData('<?php echo $level['id']; ?>','level/delete',this)"><span class="glyphicon glyphicon-tasks">Delete</span></button>
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
                                    <label for="code">Level Code</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="code" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="name">Level Name</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="name" class="form-control input-sm">
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <label for="type">Level Type</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="type" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="subsection">Subsection</label>
                                </td>
                                <td colspan="3"  aria-invalid="true">
                                    <?php echo form_dropdown('subsection', array(), TRUE,'class="form-control"'); ?>
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
