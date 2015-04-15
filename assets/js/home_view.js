$(function () { 
    //display the menu dropdown on click
    $('.navbar-toggler').on('click', function(event) {
		event.preventDefault();
		$(this).closest('.navbar-minimal').toggleClass('open');
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