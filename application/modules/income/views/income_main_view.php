<div class="col-md-12" >
            <div style="min-height: 70px;">
              <div class="page-header" id="fix-page-header">
                <div> 
                  <h2 style="display:inline-block;">Incomes</h2>
                  <button style="margin:1.5%;vertical-align: top;" class="btn" data-toggle="modal" data-target="#add_income_modal" type="button"> <span class="glyphicon glyphicon-plus"></span></button>
                </div>
              </div>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>S.N.</th>
                        <th>Teacher</th>
                        <th>Group</th>
                        <th>Payment</th>
                        <th>Due</th>
                        <th>Total</th>
                        <th>Share-Percent</th>
                        <th>Remark</th>
                        <th>Date</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php if(isset($incomes)){ ?>
                        <?php $sn=1; ?>
                        <?php $teacher_map=convert_to_keyvalue($teachers); ?>
                        <?php $group_map=convert_to_keyvalue($groups); ?>
                        <?php foreach($incomes as $income){ ?>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $teacher_map[$income['teacher_id']]; ?></td>
                                <td><?php echo $group_map[$income['group_id']]; ?></td>
                                <td><?php echo $income['payment']; ?></td>
                                <td><?php echo $income['dues']; ?></td>
                                <td><?php echo $income['total']; ?></td>
                                <td><?php echo $income['share_percent']; ?></td>
                                <td><?php echo $income['remarks']; ?></td>
                                <td><?php echo $income['date']; ?></td>
                                <td>
                                    <button class="btn btn-primary edit_income_btn" data-id="<?php echo $income['id']; ?>" data-teacher_id="<?php echo $income['teacher_id']; ?>" data-group_id="<?php echo $income['group_id']; ?>" data-date="<?php echo $income['date']; ?>" data-edit_due="<?php echo $income['dues']; ?>" data-remark="<?php echo $income['remarks']; ?> "data-share_percent="<?php echo $income['share_percent']; ?>  "data-total="<?php echo $income['total']; ?> "data-payment="<?php echo $income['payment']; ?>" data-toggle="modal" data-target="#edit_income_modal"><span class="glyphicon glyphicon-edit glyphicon-margin-right-5"></span>Edit</button>
                                    <!--<button class="btn btn-danger" onclick="return deleteData('<?php echo $income['id']; ?>','income/delete',this)"><span class="glyphicon glyphicon-trash glyphicon-margin-right-5"></span>Delete</button>-->
                                </td>
                            </tr> 
                            <?php $sn++; ?>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- modal for adding income -->
        <div class="modal fade" tabindex="-1" role="dialog" id="add_income_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Add Income</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('income/add',array('id' => 'add_income_form')); ?>
                        <table class="table-padding-10">
                             <tr>
                                <td>
                                    <label for="add_teacher_dropdown">Teachers</label>
                                </td>
                                <td colspan="3"  aria-invalid="true">
                                    <?php echo form_dropdown('add_teacher_dropdown',array("0"=>"Select Teacher") + convert_to_keyvalue($teachers),"0",'class="form-control" id="add_teacher_dropdown"') ?>
                                </td>
                                <td>
                                    <label for="add_group_dropdown">Groups</label>
                                </td>
                                <td colspan="3"  aria-invalid="true">
                                    <?php echo form_dropdown('add_group_dropdown',array("0"=>"Select Group") + convert_to_keyvalue($groups),"0",'class="form-control" id="add_group_dropdown"') ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_payment">Payment</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_payment" class="form-control input-sm">
                                </td>
                                <td>
                                    <label for="add_due">Due</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_due" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_total">Total</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_total" class="form-control input-sm">
                                </td>
                                <td>
                                    <label for="add_share_percent">Share-Percent</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_share_percent" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_remark">Remark</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_remark" class="form-control input-sm">
                                </td>
                                <td>
                                    <label for="add_date">Date</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_date" class="form-control input-sm datepicker">
                                </td>
                            </tr>
                            
                            
                           
                        </table>    
                        
                        <input class="btn btn-primary" style="margin-left:44%" type="submit" value="Save">
                        <?php echo form_close(); ?>
                        
                    </div>
                </div>
            </div>    
        </div>
        
        
        <!-- modal for editing expense -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_income_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Edit Income</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('income/edit',array('id' => 'edit_income_form'),array('edit_income_id' => '')); ?>
                        <table class="table-padding-10">
                             <tr>
                                <td>
                                    <label for="edit_teacher_dropdown">Teachers</label>
                                </td>
                                <td colspan="3"  aria-invalid="true">
                                    <?php echo form_dropdown('edit_teacher_dropdown',array("0"=>"Select Teacher") + convert_to_keyvalue($teachers),"0",'class="form-control" id="edit_teacher_dropdown"') ?>
                                </td>
                                <td>
                                    <label for="edit_group_dropdown">Groups</label>
                                </td>
                                <td colspan="3"  aria-invalid="true">
                                    <?php echo form_dropdown('edit_group_dropdown',array("0"=>"Select Group") + convert_to_keyvalue($groups),"0",'class="form-control" id="edit_group_dropdown"') ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_payment">Payment</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_payment" class="form-control input-sm" id="edit_payment">
                                </td>
                                <td>
                                    <label for="edit_due">Due</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_due" class="form-control input-sm" id="edit_due">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_total">Total</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_total" class="form-control input-sm" id="edit_total">
                                </td>
                                <td>
                                    <label for="edit_share_percent">Share-Percent</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_share_percent" class="form-control input-sm" id="edit_share_percent">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_remark">Remark</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_remark" class="form-control input-sm" id="edit_remark">
                                </td>
                                <td>
                                    <label for="edit_date">Date</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_date" class="form-control input-sm datepicker" id="edit_date">
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
