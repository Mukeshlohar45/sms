$(document).ready(function () {
  $("#loginvalidate").validate({
      rules:
      {
        username: {
          required: true 
        },
        password: {
          required: true,
        }
      },
      messages:
      {
        username:{
            required: "Please enter username or email."
        },
        password: {
          required: "Password must be required.",
        }
       
      },
    })
    $("#forgotpass").validate({
        rules:
        {
            email: {
                required: true
            }
        },
        messages:
        {
            email: {
                required: "Please enter email."
            }
        }
    })
  });
  
  
  
  