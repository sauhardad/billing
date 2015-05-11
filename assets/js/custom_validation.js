$(function () { 
    
    // validate signup form on keyup and submit
    $("#add_teacher_form").validate({
        rules: {
                add_name: "required",
                add_contact_no: {
                        required: true,
                        minlength: 6
                },
                add_address: {
                        required: true,
                }
        },
        messages: {
                add_name: "Please enter name of the Teacher",
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
                edit_name: "required",
                edit_contact_no: {
                        required: true,
                        minlength: 6
                },
                edit_address: {
                        required: true,
                }
        },
        messages: {
                edit_name: "Please enter name of the Teacher",
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
    //validate and submit add expense form
    $("#add_expense_form").validate({
        rules: {
                add_expense_particular: "required",
                add_expense_amount: "required",
                add_expense_date: {
                        required: true,
                }
        },
        messages: {
                add_expense_particular: "Please enter the particular",
                add_expense_amount: "Please enter the amount",
                add_expense_date: {
                        required: "Please enter the date"
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
    
    //validate and submit edit expense form
    $("#edit_expense_form").validate({
        rules: {
                edit_expense_particular: "required",
                edit_expense_amount: "required",
                edit_expense_date: {
                        required: true,
                }
        },
        messages: {
                edit_expense_particular: "Please enter the particular",
                edit_expense_amount: "Please enter the amount",
                edit_expense_date:{
                    required:true,
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
    
    //validate and submit add income form
    $("#add_income_form").validate({
        rules: {
                add_teacher_dropdown: { valueNotEquals: "0" },
                add_group_dropdown: { valueNotEquals: "0" },
                add_payment: "required",
                add_due: "required",
                add_total: "required",
                add_share_percent: "required",
                add_remark: "required",
                add_date: "required",
                
        },
        messages: {
                add_teacher_dropdown: "Please enter Teachers name",
                add_group_dropdown: "Please enter Group",
                add_payment: "Please enter Payment amount",
                add_due: "Please enter due amount",
                add_total: "Please enter total",
                add_share_percent: "Please enter share percentage",
                add_remark: "Please add remark",
                add_date: "Please enter date",
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
    //validate and submit edit income form
    $("#edit_income_form").validate({
        rules: {
                edit_teacher_dropdown: { valueNotEquals: "0" },
                edit_group_dropdown: { valueNotEquals: "0" },
                edit_payment: "required",
                edit_due: "required",
                edit_total: "required",
                edit_share_percent: "required",
                edit_remark: "required",
                edit_date: "required",
                
        },
        messages: {
                edit_teacher_dropdown: "Please enter Teachers name",
                edit_group_dropdown: "Please enter Group",
                edit_payment: "Please enter Payment amount",
                edit_due: "Please enter due amount",
                edit_total: "Please enter total",
                edit_share_percent: "Please enter share percentage",
                edit_remark: "Please add remark",
                edit_date: "Please enter date",
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
    
    
    //add custom validation for student section dropdown
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return value != arg;
    }, "Please select a value");
    
    // validate add student form on keyup and submit
    $("#add_student_form").validate({
        rules: {
                add_student_name: "required",
                add_section_dropdown: { valueNotEquals: "0" },
                add_subsection_dropdown: { valueNotEquals: "0" },
                add_group_dropdown: { valueNotEquals: "0" },
                add_teacher_dropdown:{ valueNotEquals: "0" },
                add_course_amount: "required",
                
        },
        messages: {
                add_student_name: "Please enter name of the Student",
                add_section_dropdown:"Please select a Section",
                add_subsection_dropdown:"Please select a Subsection",
                add_group_dropdown: "Please select a Group",
                add_teacher_dropdown:"Enter teachers name",
                add_course_amount: "Enter course amount",
                
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
    
    // validate edit student form on keyup and submit
    $("#edit_student_form").validate({
        rules: {
                edit_student_name: "required",
                edit_section_dropdown: { valueNotEquals: "0" },
                edit_subsection_dropdown: { valueNotEquals: "0" },
                edit_group_dropdown: { valueNotEquals: "0" },
                edit_teacher_dropdown:{ valueNotEquals: "0" },
                edit_course_amount: "required"
        },
        messages: {
                edit_student_name: "Please enter name of the Student",
                edit_section_dropdown:"Please select a Section",
                edit_subsection_dropdown:"Please select a Subsection",
                edit_group_dropdown: "Please select a Group",
                edit_teacher_dropdown:"Enter teachers name",
                edit_course_amount: "Edit course amount"
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
    
    //validate and submit group form
     $("#add_group_form").validate({
        rules: {
                add_group_code: {
                        required: true,
                        rangelength: [2,2],
                        remote: {
                          url: base_url+"group/check_code",
                          type: "post",
                          data: {
                            code: function() {
                                return $('input[name="add_group_code"]').val();
                            },
                            subsection_id: function() {
                                return $('#subsection_id').val();
                            }
                          }
                      }  
                },
                add_group_name: "required",
                add_group_time_slot:"required"
        },
        messages: {
                add_group_name: "Please enter name of the Group",
                add_group_time_slot: "Please enter a time slot",
                add_group_code: {
                        required: "Please provide the code",
                        rangelength: "Enter a two digit number",
                        remote: "That code has already been assigned,please choose a new code"
                }
        },
        errorClass: "invalid",
        submitHandler: function(form) {
            $(form).ajaxSubmit({
                clearForm:true,
                dataType:'json',
                data:{subsection_id: $('#subsection_id').val()},
                success: function(data) {
                    alert(data.message);
                    if(data.status==true)
                        window.location=window.location.href;
                }
            });
            return false;
        }
    });
    
    //validate and edit group form
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
                        rangelength: [2,2],
                        remote: {
                          url: base_url+"section/check_code",
                          type: "post",
                          data: {
                            code: function() {
                                return $('input[name="add_section_code"]').val();
                            }
                          }
                      } 
                }
        },
        messages: {
                add_section_name: "Please enter name of the Section",
                add_section_code: {
                        required: "Please provide the code",
                        rangelength: "Enter a two digit number",
                        remote: "That code has already been assigned,please choose a new code"
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
    
    //validate and submit the add subsection form
     $("#add_subsection_form").validate({
        rules: {
                add_subsection_name: "required",
                
                add_subsection_code: {
                        required: true,
                        rangelength: [2,2],
                        remote: {
                          url: base_url+"subsection/check_code",
                          type: "post",
                          data: {
                            code: function() {
                                return $('input[name="add_subsection_code"]').val();
                            },
                            section_id: function() {
                                return $('#section_id').val();
                            }
                          }
                      }
                }
        },
        messages: {
                add_subsection_name: "Please enter name of the Subsection",
                add_subsection_code: {
                        required: "Please provide the code",
                        rangelength: "Enter a two digit number",
                        remote: "That code has already been assigned,please choose a new code"
                }
        },
        errorClass: "invalid",
        submitHandler: function(form) {
            $(form).ajaxSubmit({
                clearForm:true,
                dataType:'json',
                data:{section_id: $('#section_id').val()},
                success: function(data) {
                    alert(data.message);
                    if(data.status==true)
                        window.location=window.location.href;
                }
            });
            return false;
        }
    });
    
    //validate and submit the edit subsection form
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
    //validate and submit the add level form
     $("#add_level_form").validate({
        rules: {
                add_level_name: "required",
                
                add_level_code: {
                        required: true,
                        rangelength: [2,2],
                        remote: {
                          url: base_url+"level/check_code",
                          type: "post",
                          data: {
                            code: function() {
                                return $('input[name="add_level_code"]').val();
                            }
                          }
                      }
                }
        },
        messages: {
                add_level_name: "Please enter name of the Section",
                add_level_code: {
                        required: "Please provide the code",
                        rangelength: "Enter a two digit number",
                        remote: "That code has already been assigned,please choose a new code"
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
    //validate and submit the edit level form
     $("#edit_level_form").validate({
        rules: {
                edit_level_name: "required",
                
                edit_level_code: {
                        required: true,
                        rangelength: [2,2],
                }
        },
        messages: {
                edit_level_name: "Please enter name of the Section",
                edit_level_code: {
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

