$('.viewFileContacts').on('click', function () {
var id = $(this).attr('data-id');
 $.ajax({
  url:  base_url+'home/get_file_contacts/' + id,
  method: 'GET',
  dataType: 'html',
 }) .success(function(response) {
   $('#contactFileList').html(response);
   $('#dataModal').modal({show:true});
 });
});

$('.fileSendSms').on('click', function () {
var id = $(this).attr('data-id');
  $('#file_id').val(id);
  $('#fileSendSmsModal').modal({show:true});
});

//send message
$('#fileSendSms-form').submit(function (event) {
event.preventDefault();
var button = "#fileSendSms-submit";
form_wait(button);
$.ajax({
       url: base_url +'home/sms_file/send_sms',
       type: "POST",
       data: $('#fileSendSms-form :input'),
       dataType: 'html',
     success: function (data) {
         form_complete(button);
         window.location.href = base_url + "home/sms_file/";
       },
       error: function (data) {
          console.log('error');
                 }
           });
       });
