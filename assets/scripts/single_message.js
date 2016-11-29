//send single message
$('#singleMessage-form').submit(function (event) {
event.preventDefault();
var button = "#singleMessage-submit";
form_wait(button);
$.ajax({
       url: base_url +'home/single_message/send_sms',
       type: "POST",
       data: $('#singleMessage-form :input'),
       dataType: 'html',
     success: function (data) {
         form_complete(button);
         window.location.href = base_url + "home/single_message/";
       },
       error: function (data) {
          console.log('error');
                 }
           });
       });
