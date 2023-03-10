$(document).ready(function () {

    jQuery.validator.addMethod("noSpace",
      function (value, element) {
        return value == "" || value.trim().length != 0;
      },
      "**No space please fill the Character"
    );


  /*****************************Password Method ********************************/
    jQuery.validator.addMethod("Uppercase",
    function (value) {
      return /[A-Z]/.test(value);
    },
    "**Your Password must contain at least one UpperCase Character"
   );

    jQuery.validator.addMethod("lowercase",
    function (value) {
      return /[a-z]/.test(value);
    },
    "**Your Password must contain at least one Lower Character"
    );

    jQuery.validator.addMethod("specialChar",
    function (value) {
      return /[!@#$%&*_-]/.test(value);
    },
    "**Your Password must contain at least one Special Character"
    );

    jQuery.validator.addMethod("Numberic",
    function (value) {
      return /[0-9]/.test(value);
    },
    "**Your Password must contain at least one Numeric Value"
    );


   /********************************************************************************/  
    jQuery.validator.addMethod("lettersonly", 
    function(value, element) {
      return this.optional(element) || /^[a-z]/i.test(value);
    }, "**Please Letters only Not fill Space"); 


    //register form validation
  
    $("#form").validate({
        rules: {
                
          project_name:"required",
          "user_profile[first_name]":"required",
          state:"required",
          city:"required",
          peoject_address1:"required",
          pincode:"required",
      },
      

        messages: {
          project_name:{
              required:"Please enter the project name",
          },
          "user_profile[first_name]":{
              required:"Please enter the owner name",
          },
          state:{
              required:"Please enter the state of project",
          },
          city:{
              required:"Please enter the city of project",
          },
          peoject_address1:{
              required:"Please enter the address of project",
          },
          pincode:{
              required:"Please enter the pincode of project area",
          },
          

        },

    

        errorPlacement: function (error, element) {
          if (element.is(":radio")) {
            error.appendTo(".pr");
          } else {
            error.insertAfter(element);
          }
        },
    });
    $("#admin-form").validate({
        rules: {
                
          email:{
            required:true,
            email:true,
          },
          "user_profile[first_name]":"required",
          "user_profile[last_name]":"required",
          "user_profile[phone]":"required",
          "user_profile[state]":"required",
          "user_profile[city]":"required",
          "user_profile[pincode]":{
             required:true,
             maxlength:6,
             minlength:6,
           },
          "user_profile[company_name]":"required",
      },
      

        messages: {
          email:{
              required:"Please enter the project name",
              email:"Please enter a valid email",
          },
          "user_profile[first_name]":"Please enter contarctor first name",
          "user_profile[last_name]":"Please enter contarctor last name",
          "user_profile[phone]":"Please enter contarctor contact number",
          "user_profile[state]":"Please enter contarctor state",
          "user_profile[city]":"Please enter contarctor city",
          "user_profile[pincode]":{
            required:"Please enter contarctor pincode",
            minlength:"Pincode Must be 6 digit",
            maxlength:"Pincode Must be 6 digit"
          },
          "user_profile[company_name]":"Please enter contarctor's company name",
          

        },

    

        errorPlacement: function (error, element) {
          if (element.is(":radio")) {
            error.appendTo(".pr");
          } else {
            error.insertAfter(element);
          }
        },
    });
});