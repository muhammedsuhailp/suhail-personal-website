$(document).ready(function () {
    $("#form-register").validate({
      rules: {
        'name': {
          minlength: 3,
          required:true,
          maxlength:6
        },
        'email':{
            required:true,
            email:true
        },
        'phone':{
            required:true
        },
        'password':{
            required:true,
            minlength:6
        },
        'day':{
            required:true
        }

      },
      messages:{
          name:{
              required:"Enter first name",
              minlength:"minimu 3 charcter"
          }
      }
    });
  });

