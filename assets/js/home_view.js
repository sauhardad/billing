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
    
    //initialise token input
    $("#search_group").tokenInput(base_url+'group/search',{tokenLimit: 1,theme: "facebook"});
    
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
        if($(source).val()==="group")
        {
            $('#select_group_tr').removeClass('hide').addClass('show');
        }
        else{
            $('#select_group_tr').removeClass('show').addClass('hide');
        }
    }
    else if($(source).attr('id')==="select_group")
    {
        if($(source).val()==="specific")
        {
            $('#search_group_tr').removeClass('hide').addClass('show');
        }
        else{
            $('#search_group_tr').removeClass('show').addClass('hide');
        }
    }
    else if($(source).attr('id')==="generate_report")
    {
        //validation before generating report
        if($('#generate_report_type').val()==='group')
        {
            var type='group';
            var all_flag;
            var tokenInput;
            var id;
            if($('#select_group').val()==='all')
            {
                all_flag=true;
                id=0;
                generateReport(type,all_flag,id);
            }
            else if($('#select_group').val()==='specific')
            {
                all_flag=false;
                if($('#search_group').tokenInput("get").length)
                {
                    tokenInput=$('#search_group').tokenInput("get")[0];
                    id=tokenInput.id;
                    generateReport(type,all_flag,id);
                }
                else
                {
                    alert("Please select a "+$('#generate_report_type').val()+" to generate report");
                }
            }
        }
        else 
        {
            alert("Please Choose a report type");
        }
    }
}


/** function that generates a given type of report 
 * 
 */
function generateReport(type,all_flag,id)
{
    window.location.replace(base_url+"report?type="+type);
}