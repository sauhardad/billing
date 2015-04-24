<div class="col-md-12" >
            <div style="min-height: 70px;">
              <div class="page-header" id="fix-page-header">
                <div> 
                  <h2 style="display:inline-block;">Expenses</h2>
                  <button style="margin:1.5%;vertical-align: top;" class="btn" data-toggle="modal" data-target="#add_expense_modal" type="button"> <span class="glyphicon glyphicon-plus"></span></button>
                </div>
              </div>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>S.N.</th>
                        <th>Particular</th>
                        <th>Amount</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php if(isset($expenses)){ ?>
                        <?php $sn=1; ?>
                        <?php foreach($expenses as $expense){ ?>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $expense['particulars']; ?></td>
                                <td><?php echo $expense['amount']; ?></td>
                                <td><?php echo $expense['date']; ?></td>
                                <td>
                                    <button class="btn btn-primary edit_expense_btn" data-id="<?php echo $expense['id']; ?>" data-particulars="<?php echo $expense['particulars']; ?>" data-amount="<?php echo $expense['amount']; ?>" data-date="<?php echo $expense['date']; ?>" data-toggle="modal" data-target="#edit_expense_modal"><span class="glyphicon glyphicon-edit glyphicon-margin-right-5"></span>Edit</button>
                                    <button class="btn btn-danger" onclick="return deleteData('<?php echo $expense['id']; ?>','expense/delete',this)"><span class="glyphicon glyphicon-trash glyphicon-margin-right-5"></span>Delete</button>
                                </td>
                            </tr> 
                            <?php $sn++; ?>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- modal for adding expense -->
        <div class="modal fade" tabindex="-1" role="dialog" id="add_expense_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Add Expense</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('expense/add',array('id' => 'add_expense_form')); ?>
                        <table class="table-padding-10">
                            <tr>
                                <td>
                                    <label for="add_expense_particular">Particular</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_expense_particular" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_expense_amount">Amount</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_expense_amount" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="add_expense_date">Date</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_expense_date" class="form-control input-sm nepali_datepicker">
                                </td>
                            </tr>
                            
                            
                           
                        </table>    
                        
                        <input class="btn btn-primary" type="submit" value="Save">
                        <?php echo form_close(); ?>
                        
                    </div>
                </div>
            </div>    
        </div>
        
        
        <!-- modal for editing expense -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_expense_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Edit Expense</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('expense/edit',array('id' => 'edit_expense_form'),array('edit_expense_id' => '')); ?>
                        <table class="table-padding-10">
                            <tr>
                                <td>
                                    <label for="edit_expense_particular">Particular</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_expense_particular" id="edit_expense_particular" class="form-control input-sm" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_expense_amount">Amount</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_expense_amount" id="edit_expense_amount" class="form-control input-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="edit_expense_date">Date</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="edit_expense_date" id="edit_expense_date" class="form-control input-sm nepali_datepicker"  >
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
