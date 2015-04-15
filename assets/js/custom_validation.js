$(function () { 
    
    // validate signup form on keyup and submit
    $("#add_teacher_form").validate({
        rules: {
                add_teacher_name: "required",
                add_contact_no: {
                        required: true,
                        minlength: 6
                },
                add_address: {
                        required: true,
                }
        },
        messages: {
                add_teacher_name: "Please enter name of the Teacher",
                add_contact_no: {
                        required: "Please enter contact number",
                        minlength: "Invalid contact Number"
                },
                add_address: {
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
    
    //validate and submit edit teacher form
    // validate signup form on keyup and submit
    $("#edit_teacher_form").validate({
        rules: {
                edit_teacher_name: "required",
                edit_contact_no: {
                        required: true,
                        minlength: 6
                },
                edit_address: {
                        required: true,
                }
        },
        messages: {
                edit_teacher_name: "Please enter name of the Teacher",
                edit_contact_no: {
                        required: "Please enter contact number",
                        minlength: "Invalid contact Number"
                },
                edit_address: {
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
     $("#add_group_form").validate({
        rules: {
                add_group_code: {
                        required: true,
                        rangelength: [2,2]
                },
                add_group_name: "required",
                add_group_time_slot:"required"
        },
        messages: {
                add_group_name: "Please enter name of the Group",
                add_group_time_slot: "Please enter a time slot",
                add_group_code: {
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
                    if(data.status==true)
                        window.location=window.location.href;
                }
            });
            return false;
        }
    });
    
    //validate and submit section form
     $("#edit_group_form").validate({
        rules: {
                edit_group_code: {
                        required: true,
                        rangelength: [2,2]
                },
                edit_group_name: "required",
                edit_group_time_slot:"required"
        },
        messages: {
                edit_group_name: "Please enter name of the Group",
                edit_group_time_slot: "Please enter a time slot",
                edit_group_code: {
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
                    if(data.status==true)
                        window.location=window.location.href;
                }
            });
            return false;
        }
    });
    
    
    //validate and submit the add section form
     $("#add_section_form").validate({
        rules: {
                add_section_name: "required",
                
                add_section_code: {
                        required: true,
                        rangelength: [2,2]
                }
        },
        messages: {
                add_section_name: "Please enter name of the Section",
                add_section_code: {
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
                    if(data.status==true)
                        window.location=window.location.href;
                }
            });
            return false;
        }
    });
    
    //validate and submit the add section form
     $("#add_subsection_form").validate({
        rules: {
                add_subsection_name: "required",
                
                add_subsection_code: {
                        required: true,
                        rangelength: [2,2]
                }
        },
        messages: {
                add_subsection_name: "Please enter name of the Section",
                add_subsection_code: {
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
                    if(data.status==true)
                        window.location=window.location.href;
                }
            });
            return false;
        }
    });
    
    //validate and submit the add section form
     $("#edit_subsection_form").validate({
        rules: {
                edit_subsection_name: "required",
                
                edit_subsection_code: {
                        required: true,
                        rangelength: [2,2]
                }
        },
        messages: {
                edit_subsection_name: "Please enter name of the Section",
                edit_subsection_code: {
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
                    if(data.status==true)
                        window.location=window.location.href;
                }
            });
            return false;
        }
    });
    
    //validate and submit the edit section form
     $("#edit_section_form").validate({
        rules: {
                edit_section_name: "required",
                
                edit_section_code: {
                        required: true,
                        rangelength: [2,2]
                }
        },
        messages: {
                edit_section_name: "Please enter name of the Section",
                edit_section_code: {
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
                    if(data.status==true)
                        window.location=window.location.href;
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

