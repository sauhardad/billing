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
                        <th>Teacher/Staff</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </thead>
                    <tbody>
                        <?php if(isset($expenses)){ ?>
                        <?php $sn=1; ?>
                        <?php $teacher_map=convert_to_keyvalue($teachers); ?>
                        <?php $staff_map=convert_to_keyvalue($staff); ?>
                        <?php foreach($expenses as $expense){ ?>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $expense['particulars']; ?></td>
                                <td>
                                    <?php 
                                        if($expense['type']==1)
                                            echo $teacher_map[$expense['emp_id']]; 
                                        elseif($expense['type']==2)
                                            echo $staff_map[$expense['emp_id']]; 
                                    ?>
                                </td>
                                <td><?php echo $expense['amount']; ?></td>
                                <td><?php echo $expense['date']; ?></td>
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
                        <table class="table-padding-10">
                            <tr class="show">
                                <td>
                                    <label for="add_expense_date">Date</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_expense_date" class="form-control input-sm datepicker" id="add_expense_date">
                                </td>
                            </tr>
                            <tr class="show">
                                <td>
                                    <label for="add_expense_type">Expense Type</label>
                                </td>
                                <td colspan="3">
                                    <?php echo form_dropdown('add_expense_type', array("0"=>"Select Expense Type")+$this->config->item('expense_types'), "0",'class="form-control" id="add_expense_type" onchange="return reportExpenseModalAction(this);"'); ?>
                                </td>
                            </tr>
                            <tr id="select_teacher_tr" class="hide">
                                <td>
                                    <label for="select_teacher">Select Teacher</label>
                                </td>
                                <td colspan="3">
                                    <?php echo form_dropdown('select_teacher', array("0"=>"Select Teacher"), "0",'class="form-control" id="select_teacher" onchange="return reportExpenseModalAction(this);"'); ?>
                                </td>
                            </tr>
                            <tr id="select_staff_tr" class="hide">
                                <td>
                                    <label for="select_staff">Select Staff</label>
                                </td>
                                <td colspan="3">
                                    <?php echo form_dropdown('select_staff', array("0"=>"Select Staff"), "0",'class="form-control" id="select_staff" onchange="return reportExpenseModalAction(this);"'); ?>
                                </td>
                            </tr>
                            <tr id="input_particular_tr" class="hide">
                                <td>
                                    <label for="add_expense_particular">Particular</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_expense_particular" class="form-control input-sm" id="add_expense_particular">
                                </td>
                            </tr>
                            \<tr class="hide" id="expense_payables_tr">
                                <td>
                                    <label for="add_expense_payables">Payables</label>
                                </td>
                                <td colspan="3">
                                    <?php echo form_dropdown('add_expense_payables', array_merge(array("0"=>"Select a Payable"),$this->config->item('payables')), "0",'class="form-control" id="add_expense_payables" onchange="return reportExpenseModalAction(this);"'); ?>
                                </td>
                            </tr>
                            <tr class="hide" id="expense_month_tr">
                                <td>
                                    <label for="add_expense_month">Month</label>
                                </td>
                                <td colspan="3">
                                    <?php echo form_dropdown('add_expense_month', array_merge(array("0"=>"Select Month"),$this->config->item('monthlist')), "0",'class="form-control" id="add_expense_month" onchange="return reportExpenseModalAction(this);"'); ?>
                                </td>
                            </tr>
                            <tr class="hide" id="expense_voucher_tr">
                                <td>
                                    <label for="add_expense_voucher_bill">Voucher/Bill No</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_expense_voucher_bill" class="form-control input-sm" id="add_expense_voucher_bill">
                                </td>
                            </tr>
                            <tr class="hide" id="add_expense_amount_tr">
                                <td>
                                    <label for="add_expense_amount">Amount</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_expense_amount" class="form-control input-sm" id="add_expense_amount">
                                </td>
                            </tr>
                            <tr class="hide" id="expense_remarks_tr">
                                <td>
                                    <label for="add_expense_remarks">Remarks</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="add_expense_remarks" id="add_expense_remarks" class="form-control input-sm">
                                </td>
                            </tr>
                        </table>    
                        <input class="btn btn-primary" id="save_expense" type="button" value="Save" onclick="return reportExpenseModalAction(this);"> 
                    </div>
                </div>
            </div>    
        </div>

</div>
