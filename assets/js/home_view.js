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
    
    //fill in form values in the edit student form
    $(document).on( "click", '.edit_student_btn',function(e) {
        var name = $(this).data('name');
        var id = $(this).data('id');
        var section=$(this).data('section');
        var address = $(this).data('address');
        var teacher =$(this).data('teacher');
        var contact = $(this).data('contact');
        var dob=$(this).data('dob');
        var amount=$(this).data('amount');
        

        $("input:hidden[name=edit_student_id]").val(id);
        $("#edit_student_name").val(name);
        $('#edit_section_dropdown').val(section);
        $("#edit_teacher_dropdown").val(teacher);
        $("#edit_address").val(address);
        $("#edit_contact_no").val(contact);
        $('#edit_student_dob').val(dob);
        $('#edit_course_amount').val(amount);
        
        //trigger the onchange event of section to retrieve subsections
        $( "#edit_section_dropdown" ).trigger( "change" );
        
    });
    
    //fill in form values in the edit teacher form
    $(document).on( "click", '.edit_teacher_btn',function(e) {

        var name = $(this).data('name');
        var id = $(this).data('id');
        var address = $(this).data('address');
        var contact = $(this).data('contact');

        $("input:hidden[name=edit_teacher_id]").val(id);
        $("#edit_teacher_name").val(name);
        $("#edit_address").val(address);
        $("#edit_contact_no").val(contact);
        
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
        var share_percent = $(this).data('share_percent');
        var date = $(this).data('date');
        var payment = $(this).data('payment');
        var remark = $(this).data('remark');
        var due= $(this).data('edit_due');
        
        
        

        $("input:hidden[name=edit_income_id]").val(id);
        $("#edit_teacher_dropdown").val(teacher_id);
        $("#edit_group_dropdown").val(group_id);
        $("#edit_total").val(total);
        $("#edit_share_percent").val(share_percent);
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