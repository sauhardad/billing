$(function () { 
    
    //display the menu dropdown on click
    $('.navbar-toggler').on('click', function(event) {
		event.preventDefault();
		$(this).closest('.navbar-minimal').toggleClass('open');
	});
        
    //date picker on student add form
    //var calendar = $.calendars.instance('nepali');
    var calendar = $.calendars.instance();
    $('.datepicker').calendarsPicker({calendar: calendar});
    
    //initialize the picture editor
    $('.image').picEdit({
        formSubmitted: function(){
        },
        maxHeight:300,
        maxWidth:200
    });
    
    //focus on the report type select box when report modal is loaded
    $('#report_modal').on('shown.bs.modal', function () {
        $('#generate_report_type').focus();
    });
    
    //calculate due amount on add
    $( "#add_paid_amount" ).keyup(function() {
        if($(this).val() && $.isNumeric( $(this).val()))
        {
            $.ajax({
                type: "POST",
                url: base_url+'student/ajax_get_total_amount',
                data: {id : $('#student_id').val()},
                success:function(data) {
                    $('#add_due_amount').val((parseInt(data,10)- parseInt($('#add_paid_amount').val(),10)));
                }       
            }); 
        }
        else
        {
            $('#add_due_amount').val("");
        }
    });
    
    //fill in form values in the edit student form
    $(document).on( "click", '.edit_student_btn',function(e) {
        var name = $(this).data('name');
        var id = $(this).data('id');
        var section=$(this).data('section');
        var address = $(this).data('address');
        var contact = $(this).data('contact');
        var dob=$(this).data('dob');
        

        $("input:hidden[name=edit_student_id]").val(id);
        $("#edit_student_name").val(name);
        $('#edit_section_dropdown').val(section);
        $("#edit_address").val(address);
        $("#edit_contact_no").val(contact);
        $('#edit_student_dob').val(dob);
        
        //trigger the onchange event of section to retrieve subsections
        $( "#edit_section_dropdown" ).trigger( "change" );
        
    });
    
    //fill in form values in the edit teacher form
    $(document).on( "click", '.edit_teacher_btn',function(e) {

        var name = $(this).data('name');
        var id = $(this).data('id');
        var address = $(this).data('address');
        var contact = $(this).data('contact');
        var share_percent=$(this).data('share_percent');

        $("input:hidden[name=edit_teacher_id]").val(id);
        $("#edit_teacher_name").val(name);
        $("#edit_address").val(address);
        $("#edit_contact_no").val(contact);
        $("#edit_share_percent").val(share_percent);
        
    });
  
        //fill in form values in the edit staff form
    $(document).on( "click", '.edit_staff_btn',function(e) {

        var name = $(this).data('name');
        var id = $(this).data('id');
        var address = $(this).data('address');
        var contact = $(this).data('contact');
        var post=$(this).data('post');
        var salary=$(this).data('salary');

        $("input:hidden[name=edit_staff_id]").val(id);
        $("#edit_staff_name").val(name);
        $("#edit_staff_address").val(address);
        $("#edit_staff_contact_no").val(contact);
        $("#edit_staff_post").val(post);
        $("#edit_staff_salary").val(salary);

    });

    
    //fill in form values in the edit level form
    $(document).on( "click", '.edit_subsection_btn',function(e) {
        var id=$(this).data('id');
        var name = $(this).data('name');
        var code = $(this).data('code');
        
        $("input:hidden[name=edit_subsection_id]").val(id);
        $("#edit_subsection_code").val(code);
        $("#edit_subsection_name").val(name);
        
    });
    
    //fill in form values in the edit group form
    $(document).on( "click", '.edit_group_btn',function(e) {

        var id = $(this).data('id');
        var code = $(this).data('code');
        var name = $(this).data('name');
        var slot = $(this).data('slot');
        var running = $(this).data('running');

        $("input:hidden[name=edit_group_id]").val(id);
        $("#edit_group_code").val(code);
        $("#edit_group_name").val(name);
        $("#edit_group_time_slot").val(slot);
        $("#edit_group_is_running").val(running);
        
    });
    
    //fill in form values in the edit section form
    $(document).on( "click", '.edit_section_btn',function(e) {

        var id = $(this).data('id');
        var code = $(this).data('code');
        var name = $(this).data('name');

        $("input:hidden[name=edit_section_id]").val(id);
        $("#edit_section_code").val(code);
        $("#edit_section_name").val(name);
        
    });
     //fill in form values in the edit income form
    $(document).on( "click", '.edit_income_btn',function(e) {

        var id = $(this).data('id');
        var teacher_id = $(this).data('teacher_id');
        var group_id = $(this).data('group_id');
        var total = $(this).data('total');
        var share = $(this).data('share');
        var date = $(this).data('date');
        var payment = $(this).data('payment');
        var remark = $(this).data('remark');
        var due= $(this).data('edit_due');
        
        
        

        $("input:hidden[name=edit_income_id]").val(id);
        $("#edit_teacher_dropdown").val(teacher_id);
        $("#edit_group_dropdown").val(group_id);
        $("#edit_total").val(total);
        $("#edit_share").val(share);
        $("#edit_date").val(date);
        $("#edit_payment").val(payment);
        $("#edit_remark").val(remark);
        $("#edit_due").val(due);
        
        
    });
    
     //fill in form values in the edit expense form
    $(document).on( "click", '.edit_expense_btn',function(e) {

        var id = $(this).data('id');
        var particulars = $(this).data('particulars');
        var amount = $(this).data('amount');
        var date = $(this).data('date');

        $("input:hidden[name=edit_expense_id]").val(id);
        $("#edit_expense_particular").val(particulars);
        $("#edit_expense_amount").val(amount);
        $("#edit_expense_date").val(date);
    });
});

/** function that deletes user 
 * @param int user_id
 */
function deleteUser(anchor,user_id)
{
    $.ajax({
        type: "POST",
        url: base_url+'user/delete_user',
        data: {id : user_id},
        dataType: 'json',
        success:function(data) {
            if(data.status==true)
                $(anchor).parent().parent().remove();
        }       
      });
}

/** function that deletes content depending on the second parameter
 * @param int id
 * @param string url
 * @param object element
 * 
 */
function deleteData(id,url,element)
{
    $.ajax({
        type: "POST",
        url: base_url+url,
        data: {id : id},
        dataType: 'json',
        success:function(data) {
            if(data.status==true)
                $(element).parent().parent().remove();
        }       
      });
}

/** function that loads subsection or group dropdown when particular section
 * or subsection is selected
 * @param object element
 */
function loadDropdown(element)
{
    var url=$(element).attr("url-target");
    var type=$(element).attr("target-type");
    var id=$(element).val();
    var target=$(element).attr("target");
    $.ajax({
        type: "POST",
        url: base_url+url,
        data: {id : id , type : type},
        dataType: 'html',
        success:function(html) {
            $('#'+target).html(html);
            if(type=='edit') 
            {    
                if(target=='tr_edit_subsection_dropdown')
                {
                    $('#edit_subsection_dropdown').val($('.edit_student_btn').data('subsection'));
                    $('#edit_subsection_dropdown').trigger( "change" );
                }else if(target=='tr_edit_group_dropdown'){
                    $('#edit_group_dropdown').val($('.edit_student_btn').data('group'));
                }
            
            }
                
        }       
      });
}

/** function that loads the list of groups that a teacher teaches 
 * 
 */
function loadTeacherGroups(element)
{
    if(element.value)
    {
        $.ajax({
        type: "POST",
        url: base_url+'group/get_teacher_groups',
        data: {id : element.value},
        dataType: 'json',
        success:function(data) {
             $('#add_group_dropdown').empty();
             $.each(data, function(i, value) {
                $('#add_group_dropdown').append($('<option>').text(value).attr('value', i));
            });
        }       
      });
    } 
}

/** function that loads income details of teacher when a group is selected 
 * 
 * @param int group_id
 * @returns {undefined}
 */
function loadTeacherIncomeByGroup(group_id)
{
    if(parseInt(group_id)!==0)
    {
        $.ajax({
        type: "POST",
        url: base_url+'group/ajax_load_teacher_income_by_group',
        data: {id : parseInt(group_id)},
        dataType: 'json',
        success:function(data) { 
            $('#add_payment').val(data.paid);
            $('#add_total').val(data.total);
            $('#add_due').val(data.due);
            $('#add_share').val(data.share);
        }       
      });
    }
}

/** function that is invoked when certain action is performed on the report modal
 * source is the element that triggered the action
 * @param object source 
 */
function reportModalAction(source)
{
    if($(source).attr('id')==="generate_report_type")
    {
        $('#select_section_tr').removeClass('show').addClass('hide');
        $('#select_subsection_tr').removeClass('show').addClass('hide');
        $('#select_group_tr').removeClass('show').addClass('hide');
        $('#select_user_tr').removeClass('show').addClass('hide');
        $('#select_group').val("all");
        $('#search_group_tr').removeClass('show').addClass('hide');
        $(".token-input-list-facebook").remove();
        $('#select_user_tr').removeClass('show').addClass('hide');
        $('#select_duration_tr').removeClass('show').addClass('hide');
        $('#select_expense_type_tr').removeClass('show').addClass('hide');
        
        if($(source).val()==="group-summary" || $(source).val()==="group-checking" || $(source).val()==="group-contact" || $(source).val()==="group-account")
        {
            $.ajax({
                type: "POST",
                url: base_url+'report/getSections',
                dataType: 'json',
                success:function(data) { 
                    $('#select_section').empty().append($("<option></option>").attr("value","0").text("Select Section")); 
                    $.each(data, function(key, value) {   
                        $('#select_section')
                            .append($("<option></option>")
                            .attr("value",value.id)
                            .text(value.name)); 
                   });
                   $('#select_section_tr').removeClass('hide').addClass('show');
                }       
              });
            
        }
        else if($(source).val()==="transaction")
        {
            $.ajax({
                type: "POST",
                url: base_url+'report/getUsers',
                dataType: 'json',
                success:function(data) { 
                    $('#select_user').empty().append($("<option></option>").attr("value","0").text("All")); 
                    $.each(data, function(key, value) {   
                        $('#select_user')
                            .append($("<option></option>")
                            .attr("value",value.id)
                            .text(value.username));     
                   });
                   $('#select_user_tr').removeClass('hide').addClass('show');
                   $('#select_duration_tr').removeClass('hide').addClass('show');
                }       
              });
        }
        else if($(source).val()==="expense")
        {
            $('#select_expense_type_tr').removeClass('hide').addClass('show');
        }
    }
    else if($(source).attr('id')==="select_section")
    {
        $('#select_subsection_tr').removeClass('show').addClass('hide');
        $('#select_group_tr').removeClass('show').addClass('hide');
        $('#select_group').val("all");
        $('#search_group_tr').removeClass('show').addClass('hide');
        $(".token-input-list-facebook").remove();
        if($(source).val()!=='0')
        {
            $.ajax({
                type: "POST",
                url: base_url+'report/getSubsections',
                dataType: 'json',
                data: {id : parseInt($(source).val())},
                success:function(data) { 
                    $('#select_subsection').empty().append($("<option></option>").attr("value","0").text("Select Subsection")); 
                    $.each(data, function(key, value) {   
                        $('#select_subsection')
                            .append($("<option></option>")
                            .attr("value",value.id)
                            .text(value.name)); 
                   });
                   $('#select_subsection_tr').removeClass('hide').addClass('show');
                }       
              });
        }
    }
    else if($(source).attr('id')==="select_subsection")
    {
        $('#select_group_tr').removeClass('show').addClass('hide');
        $('#select_group').val("all");
        $('#search_group_tr').removeClass('show').addClass('hide');
        $(".token-input-list-facebook").remove();
        if($(source).val()!=='0')
        {
            $('#select_group_tr').removeClass('hide').addClass('show');
        }
        
        //check if select group report type needs to be displayed
        if($('#generate_report_type').val()==='group-contact' || $('#generate_report_type').val()==='group-checking' || $('#generate_report_type').val()==="group-account")
        {
            $('#select_group_tr').removeClass('show').addClass('hide');
            //initialise token input
            $("#search_group").tokenInput(base_url+'group/search?subsection_id='+$('#select_subsection').val(),{tokenLimit: 1,theme: "facebook"});
            $('#search_group_tr').removeClass('hide').addClass('show');
        }
        else if($('#generate_report_type').val()==='group-summary')
        {
            $('#select_group_tr').removeClass('hide').addClass('show');
        }
    }
    else if($(source).attr('id')==="select_group")
    {
        $(".token-input-list-facebook").remove();
        $('#search_group_tr').removeClass('show').addClass('hide');
        if($(source).val()==="specific")
        {
            //initialise token input
            $("#search_group").tokenInput(base_url+'group/search?subsection_id='+$('#select_subsection').val(),{tokenLimit: 1,theme: "facebook"});
            $('#search_group_tr').removeClass('hide').addClass('show');
        }
    }
    else if($(source).attr('id')==="select_expense_type")
    {
        if($(source).val()==="teacher")
        {
            $.ajax({
                type: "POST",
                url: base_url+'report/getTeachers',
                dataType: 'json',
                success:function(data) { 
                    $('#select_teacher').empty().append($("<option></option>").attr("value","0").text("Select Teacher")); 
                    $.each(data, function(key, value) {   
                        $('#select_teacher')
                            .append($("<option></option>")
                            .attr("value",value.id)
                            .text(value.name)); 
                   });
                   $('#select_teacher_tr').removeClass('hide').addClass('show');
                }       
              });
        }
    }
    else if($(source).attr('id')==="generate_report")
    {
        //validation before generating report
        if($('#generate_report_type').val()==='group-summary' || $('#generate_report_type').val()==='group-checking' || $('#generate_report_type').val()==='group-contact' || $('#generate_report_type').val()==="group-account")
        {
            var type=$('#generate_report_type').val();
            var filter1;
            var tokenInput;
            var filter2;
            if($('#select_section').val()==='0')
            {
                alert("Please choose a Section");
                return false;
            }
            if($('#select_subsection').val()==='0')
            {
                alert("Please choose a Subection");
                return false;
            }
                
            if($('#generate_report_type').val()==='group-summary')
            {
                if($('#select_group').val()==='all')
                {
                    filter1=true;
                    filter2=$('#select_subsection').val();
                    generateReport(type,filter1,filter2);
                }
                else if($('#select_group').val()==='specific')
                {
                    filter1=false;
                    if($('#search_group').tokenInput("get").length)
                    {
                        tokenInput=$('#search_group').tokenInput("get")[0];
                        filter2=tokenInput.id;
                        generateReport(type,filter1,filter2);
                    }
                    else
                    {
                        alert("Please select a group to generate report");
                    }
                }
            }
            else if($('#generate_report_type').val()==='group-contact' || $('#generate_report_type').val()==='group-checking' || $('#generate_report_type').val()==="group-account")
            {
                if($('#search_group').tokenInput("get").length)
                {
                    tokenInput=$('#search_group').tokenInput("get")[0];
                    filter2=tokenInput.id;
                    generateReport($('#generate_report_type').val(),false,filter2);
                }
                else
                {
                    alert("Please select a group to generate report");
                }
            }
        }
        else if($('#generate_report_type').val()==="income")
        {
            generateReport('income','true',0);
        }
        else if($('#generate_report_type').val()==="transaction")
        {
            generateReport('transaction',$('#select_duration').val(),$('#select_user').val())
        }
        else if($('#generate_report_type').val()==="expense")
        {
            if($('#select_expense_type').val()=='teacher')
            {
                if($('#select_teacher').val()==='0')
                    alert("Please choose a Teacher");
                else
                    generateReport('expense',$('#select_expense_type').val(),$('#select_teacher').val());
            }
            else if($('#select_expense_type').val()=='payable')
                generateReport('expense',$('#select_expense_type').val(),false);
            else if($('#select_expense_type').val()=='stationary')
                generateReport('expense',$('#select_expense_type').val(),false);
            
        }
        else 
        {
            alert("Please Choose A Report Type");
        }
    }
}

/** function that prints a receipt
 * 
 */
function printReceipt(data)
{
    var mywindow = window.open('', 'printarea', 'height=400,width=600');
    mywindow.document.write('<html><head><title>Valley Institute</title>');
    mywindow.document.write('<link rel="stylesheet" href="'+base_url+'/assets/css/print.css" type="text/css" />');
    mywindow.document.write('</head><body >');
    mywindow.document.write(data);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10

    mywindow.print();
    
    var afterPrint = function() {
        mywindow.close();
        mywindow.focus(); // necessary for IE >= 10
    };

    if (window.matchMedia) {
        var mediaQueryList = window.matchMedia('print');
        mediaQueryList.addListener(function(mql) {
            if (mql.matches) {
                beforePrint();
            } else {
                afterPrint();
            }
        });
    }

    return true;
}

/** function that generates a given type of report 
 * 
 */
function generateReport(type,filter1,filter2)
{
    window.open(base_url+"report?type="+type+"&filter1="+filter1+"&filter2="+filter2,'_blank');
    location.reload();
}

/** function that is invoked when certain action is performed on the add expense modal
 * source is the element that triggered the action
 * @param object source 
 */
function reportExpenseModalAction(source)
{
    if($(source).attr('id')==="add_expense_type")
    {
        $('#select_teacher_tr').removeClass('show').addClass('hide');
        $('#input_particular_tr').removeClass('show').addClass('hide');
        $('#add_expense_amount_tr').removeClass('show').addClass('hide');
        $('#expense_voucher_tr').removeClass('show').addClass('hide');
        $('#expense_remarks_tr').removeClass('show').addClass('hide');
        $('#expense_month_tr').removeClass('show').addClass('hide');
        $('#select_staff_tr').removeClass('show').addClass('hide');
        $('#expense_payables_tr').removeClass('show').addClass('hide');
        $('#expense_loan_tr').removeClass('show').addClass('hide');
        
        if($(source).val()==="teacher")
        {
            $.ajax({
                type: "POST",
                url: base_url+'expense/getTeachers',
                dataType: 'json',
                success:function(data) { 
                    $('#select_teacher').empty().append($("<option></option>").attr("value","0").text("Select Teacher")); 
                    $.each(data, function(key, value) {   
                        $('#select_teacher')
                            .append($("<option></option>")
                            .attr("value",value.id)
                            .text(value.name)); 
                    $('#select_teacher_tr').removeClass('hide').addClass('show');
                    $('#add_expense_amount_tr').removeClass('hide').addClass('show');
                    $('#expense_voucher_tr').removeClass('hide').addClass('show');
                    $('#expense_remarks_tr').removeClass('hide').addClass('show');
                   });
                }       
              });
        }
        else if($(source).val()==="staff")
        {
            $.ajax({
                type: "POST",
                url: base_url+'expense/getStaff',
                dataType: 'json',
                success:function(data) { 
                    $('#select_staff').empty().append($("<option></option>").attr("value","0").text("Select Staff")); 
                    $.each(data, function(key, value) {   
                        $('#select_staff')
                            .append($("<option></option>")
                            .attr("value",value.id)
                            .text(value.name)); 
                        $('#add_expense_amount_tr').removeClass('hide').addClass('show');    
                        $('#expense_month_tr').removeClass('hide').addClass('show');
                        $('#select_staff_tr').removeClass('hide').addClass('show');
                    });
                }       
              });
        }
        
        else if($(source).val()==="stationary")
        {
            $('#input_particular_tr').removeClass('hide').addClass('show');    
            $('#add_expense_amount_tr').removeClass('hide').addClass('show');
            $('#expense_voucher_tr').removeClass('hide').addClass('show');
        }
        
        else if($(source).val()==="purchase")
        {
            $('#input_particular_tr').removeClass('hide').addClass('show');    
            $('#add_expense_amount_tr').removeClass('hide').addClass('show');
            $('#expense_voucher_tr').removeClass('hide').addClass('show');
        }
        
        else if($(source).val()==="payable")
        {
            $('#expense_payables_tr').removeClass('hide').addClass('show');    
            $('#expense_voucher_tr').removeClass('hide').addClass('show');
            $('#add_expense_amount_tr').removeClass('hide').addClass('show');
            $('#expense_month_tr').removeClass('hide').addClass('show');
        }
        else if($(source).val()==="saving")
        {
            $('#expense_saving_tr').removeClass('hide').addClass('show');    
            $('#add_expense_amount_tr').removeClass('hide').addClass('show');
        }
        else if($(source).val()==="loan")
        {
            $('#input_particular_tr').removeClass('hide').addClass('show');    
            $('#add_expense_amount_tr').removeClass('hide').addClass('show');
            $('#expense_voucher_tr').removeClass('hide').addClass('show');
            $('#expense_remarks_tr').removeClass('hide').addClass('show');
        }

    }
    //validate and save the expense
    else if($(source).attr('id')==="save_expense")
    {
        if($('#add_expense_date').val()=='')
        {
            alert("Please Choose a Date");
            return false;
        }
        if($('#add_expense_amount').val()=='')
        {
            alert("Please Enter Amount");
            return false;
        }
        
        //validate for teacher
        if($('#add_expense_type').val()==='teacher')
        {
            if($('#select_teacher').val()==='0')
            {
                alert("Please Choose a Teacher");
                return false;
            }
            if($('#add_expense_voucher_bill').val()=='')
            {
                alert("Please Enter Voucher No");
                return false;
            }
            addExpense($('#add_expense_date').val(),$('#add_expense_type').val(),$('#add_expense_particular').val(),$('#select_teacher').val(),$('#add_expense_voucher_bill').val(),$('#add_expense_month').val(),$('#add_expense_amount').val(),$('#add_expense_remarks').val());
        }
        //validate for staffs
        else if($('#add_expense_type').val()==='staff')
        {
            if($('#select_staff').val()==='0')
            {
                alert("Please Choose a Staff");
                return false;
            }
            if($('#add_expense_month').val()==='0')
            {
                alert("Please Choose a Month");
                return false;
            }
            addExpense($('#add_expense_date').val(),$('#add_expense_type').val(),$('#add_expense_particular').val(),$('#select_staff').val(),$('#add_expense_voucher_bill').val(),$('#add_expense_month').val(),$('#add_expense_amount').val(),$('#add_expense_remarks').val());
        }
        //validate for stationary
        else if($('#add_expense_type').val()==='stationary')
        {
            if($('#add_expense_particular').val()=='')
            {
                alert("Please Enter a Particular");
                return false;
            }
            if($('#add_expense_voucher_bill').val()=='')
            {
                alert("Please Enter Voucher No");
                return false;
            }
            addExpense($('#add_expense_date').val(),$('#add_expense_type').val(),$('#add_expense_particular').val(),$('#select_staff').val(),$('#add_expense_voucher_bill').val(),$('#add_expense_month').val(),$('#add_expense_amount').val(),$('#add_expense_remarks').val());
        }
        
        //validate for purchase
        else if($('#add_expense_type').val()==='purchase')
        {
            if($('#add_expense_particular').val()=='')
            {
                alert("Please Enter a Particular");
                return false;
            }
            if($('#add_expense_voucher_bill').val()=='')
            {
                alert("Please Enter Voucher No");
                return false;
            }
            addExpense($('#add_expense_date').val(),$('#add_expense_type').val(),$('#add_expense_particular').val(),$('#select_staff').val(),$('#add_expense_voucher_bill').val(),$('#add_expense_month').val(),$('#add_expense_amount').val(),$('#add_expense_remarks').val());
        }
        //validate for payables
        else if($('#add_expense_type').val()==='payable')
        {
            if($('#add_expense_payables').val()==='0')
            {
                alert("Please Choose A Payable");
                return false;
            }
            if($('#add_expense_month').val()==='0')
            {
                alert("Please Choose a Month");
                return false;
            }
            if($('#add_expense_voucher_bill').val()=='')
            {
                alert("Please Enter Voucher No");
                return false;
            }
            addExpense($('#add_expense_date').val(),$('#add_expense_type').val(),$('#add_expense_particular').val(),$('#select_staff').val(),$('#add_expense_voucher_bill').val(),$('#add_expense_month').val(),$('#add_expense_amount').val(),$('#add_expense_remarks').val(),$('#add_expense_payables').val());
        }
         //validate for savings
        else if($('#add_expense_type').val()==='saving')
        {
            if($('#add_expense_saving').val()==='0')
            {
                alert("Please Choose A Saving");
                return false;
            }
            addExpense($('#add_expense_date').val(),$('#add_expense_type').val(),$('#add_expense_particular').val(),$('#select_staff').val(),$('#add_expense_voucher_bill').val(),$('#add_expense_month').val(),$('#add_expense_amount').val(),$('#add_expense_remarks').val(),$('#add_expense_payables').val(),$('#add_expense_saving').val());
        }
         //validate for loan
         else if($('#add_expense_type').val()==='loan')
        {
            if($('#add_expense_particular').val()==='')
            {
                alert("Please Enter a loan particular");
                return false;
            }
            if($('#add_expense_voucher_bill').val()==='')
            {
                alert("Please Enter a voucher bill number");
                return false;
            }
            addExpense($('#add_expense_date').val(),$('#add_expense_type').val(),$('#add_expense_particular').val(),$('#select_staff').val(),$('#add_expense_voucher_bill').val(),$('#add_expense_month').val(),$('#add_expense_amount').val(),$('#add_expense_remarks').val(),$('#add_expense_payables').val(),$('#add_expense_payables').val());
        }
    }   
}

/** function that ajaxifies the adding of an expense
 * 
 */
function addExpense(date,type,particular,emp_id,doc_no,month,amount,remark,payable_id,saving_id)
{
    $.ajax({
        type: "POST",
        url: base_url+'expense/add',
        data:{date: date, type: type, particular: particular,emp_id: emp_id,doc_no: doc_no,month: month,amount: amount,remark: remark, payable_id: payable_id, saving_id: saving_id},
        dataType: 'json',
        success:function(data) { 
            alert(data.message);
            if(data.status==true)
                window.location=window.location.href;
        }       
      });
}