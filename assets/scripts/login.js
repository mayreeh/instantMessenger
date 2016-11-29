$('#login-form').submit(function (event) {
event.preventDefault();
var button = "#login-submit";
form_wait(button);
$.ajax({
       url: base_url +'login/login_ajax',
       type: "POST",
       data: $('#login-form :input'),
       dataType: 'json',
     success: function (data) {
         form_complete(button);
         alert(data);
        // window.location.href = base_url + "login/login/";
         },
       error: function (data) {
          console.log('error');
                 }
           });
       });
