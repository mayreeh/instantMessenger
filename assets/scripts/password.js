//Change password
$('#changePassword-form').submit(function (event) {
 event.preventDefault();
 //check matching password
 var password = document.getElementById("password")
       , confirm_password = document.getElementById("confirm_password");

 function validatePassword(){
       if(password.value != confirm_password.value) {
         confirm_password.setCustomValidity("Passwords Don't Match");
       } else {
         confirm_password.setCustomValidity('');
       }
     }
 password.onchange = validatePassword;
 confirm_password.onkeyup = validatePassword;

 var button = "#changePassword-submit";
 form_wait(button);
 $.ajax({
         url: base_url+'login/changePassword',
         type: "POST",
         data: $('#changePassword-form :input'),
         dataType: 'html',
       success: function (data) {
           form_complete(button);
           alert(data);
           },
         error: function (data) {
           location.reload();
              console.log('error');
                   }
             });
         });
