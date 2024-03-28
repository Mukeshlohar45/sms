$(document).ready(function () {
  $("#validate").validate({
    rules:
    {
      'hobby[]': {
        required: true,
        minlength: 1
      },
      email: {
        required: true 
      },
      firstname: {
        required: true,
        minlength: 3
      },
      lastname: {
        required: true,
        minlength: 3
      },
      password: {
        required: true,
        minlength: 8
      },
      cpassword: {
        required: true,
        equalTo: "#inpcpassword"
      },
      phonenumber: {
        required: true,
        minlength: 10,
        maxlength: 10
      },
      gender: { 
        required: true 
      },
      message: {
        required: true,
        minlength: 8
      },
      profile:{
        required: true 
      }
      
    },
    messages:
    {
      'hobby[]': {
        required: "must check at least one box.",
        minlength: "one check box is reqiured."
      },
      firstname: {
        required: "First Name must be required.",
        minlength: jQuery.validator.format("At least three characters required!")
      },
      lastname: {
        required: "Last Name must be required.",
        minlength: jQuery.validator.format("At least three characters required!")
      },
      password: {
        required: "Password must be required.",
        minlength: jQuery.validator.format("Must Be eight characters required!")
      },
      cpassword: {
        required: 'Confirm Password is required.',
        equalTo: 'Password is not matched.'
      },
      phonenumber: {
        required: "number must be required.",
        minlength: jQuery.validator.format("Must Be ten digit required!"),
        maxlength: jQuery.validator.format("only ten digit required!")
      },
      gender: {
        required: "Please select a gender"
      },
      message: {
        required: "messages must be required",
        minlength: jQuery.validator.format("At least eight characters required!")
      },
      email: {
        required: "Email must be required."
      },
      profile:{
        required: " File must be required."
      },

    },

    errorPlacement: function (error, element) {
      if (element.is(":radio")) {
        error.appendTo(element.parents('.pqr'));
      }
      else {
        error.insertAfter(element);
      }
    },
    errorPlacement: function (error, element) {
      if (element.is(":checkbox")) {
        error.appendTo(element.parents('.xyz'));
      }
      else { 
        error.insertAfter(element);
      }
    }
  })
  
});



