$(function () { 
    //display the menu dropdown on click
    $('.navbar-toggler').on('click', function(event) {
		event.preventDefault();
		$(this).closest('.navbar-minimal').toggleClass('open');
	});
    // validate signup form on keyup and submit
    $("#add_teacher_form").validate({
        rules: {
                teacher_name: "required",
                contact_no: {
                        required: true,
                        minlength: 6
                },
                address: {
                        required: true,
                }
        },
        messages: {
                teacher_name: "Please enter name of the Teacher",
                contact_no: {
                        required: "Please enter contact number",
                        minlength: "Invalid contact Number"
                },
                address: {
                        required: "Please provide an address"
                }
        },
        errorClass: "invalid",
        submitHandler: function(form) {
            $(form).ajaxSubmit({
                clearForm:true,
                dataType:'json',
                success: function(data) {
                    alert(data.message);
                    if(data.status==true)
                        window.location=window.location.href;
                }
            });
            return false;
        }
    });
    
    //validate and submit section form
     $("#add_section_form").validate({
        rules: {
                name: "required",
                
                code: {
                        required: true,
                        rangelength: [2,2]
                }
        },
        messages: {
                name: "Please enter name of the Section",
                code: {
                        required: "Please provide the code",
                        rangelength: "Enter a two digit number"
                }
        },
        errorClass: "invalid",
        submitHandler: function(form) {
            $(form).ajaxSubmit({
                clearForm:true,
                dataType:'json',
                success: function(data) {
                    alert(data.message);
                    //if(data.status==true)
                        //window.location=window.location.href;
                }
            });
            return false;
        }
    });
    
    
    //validate and verify password    
    // validate signup form on keyup and submit
    $("#frm_change_password").validate({
        rules: {
                current_password: "required",
                new_password: {
                        required: true,
                        minlength: 6
                },
                confirm_password: {
                        required: true,
                        minlength: 6,
                        equalTo: "#new_password"
                }
        },
        messages: {
                current_password: "Please enter your password to continue",
                new_password: {
                        required: "Please enter a new password",
                        minlength: "Your password must be at least 6 characters long"
                },
                confirm_password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long",
                        equalTo: "Please enter the same password as above"
                }
        },
        errorClass: "invalid",
        submitHandler: function(form) {
            $(form).ajaxSubmit({
                clearForm:true,
                dataType:'json',
                success: function(data) {
                    alert(data.message);
                    if(data.status==true)
                        window.location=window.location.href;
                }
            });
            return false;
        }
    });
    
    //validate the add new user form with custom and built in validation
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return value != arg;
    }, "Please select a value");
        
    $("#frm_add_user").validate({
        rules: {
                adduser_username: "required",
                adduser_password1: {
                        required: true,
                        minlength: 6
                },
                adduser_password2: {
                        required: true,
                        minlength: 6,
                        equalTo: "#adduser_password1"
                },
                adduser_type: { valueNotEquals: "0" }
        },
        messages: {
                adduser_password1: {
                        required: "Please provide password",
                        minlength: "The password must be at least 6 characters long"
                },
                adduser_password2: {
                        required: "Please provide a password",
                        minlength: "The password must be at least 6 characters long",
                        equalTo: "Please enter the same password as above"
                },
                adduser_type:{
                        valueNotEquals:"Please select a user type"
                }
        },
        errorClass: "invalid",
        submitHandler: function(form) {
            $(form).ajaxSubmit({
                clearForm:true,
                dataType:'json',
                success: function(data) {
                    alert(data.message);
                    if(data.status==true)
                        window.location=window.location.href;
                }
            });
            return false;
        }
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