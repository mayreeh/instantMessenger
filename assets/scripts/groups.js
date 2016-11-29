//Add Groups
$('#newGroups-form').submit(function (event) {
event.preventDefault();
var button = "#newGroups-submit";
form_wait(button);
$.ajax({
       url: base_url +'home/groups/create',
       type: "POST",
       data: $('#newGroups-form :input'),
       dataType: 'html',
     success: function (data) {
         form_complete(button);
         window.location.href = base_url + "home/groups/";
         },
       error: function (data) {
          console.log('error');
                 }
           });
       });

$('.editGroup').on('click', function () {
var id = $(this).attr('data-id');
 $.ajax({
  url:  base_url+'home/getGroupById/' + id,
  method: 'GET',
  dataType: 'json',
 }) .success(function(response) {
   $('#newGroups-form')
       .find('[name="group_id"]').val(response.group_id).end()
       .find('[name="groupname"]').val(response.groupname).end()
   $('#groupsModal').modal({show:true});
 });
});

//MANAGE SMS GROUPING
$('#smsGroup-form').submit(function (event) {
event.preventDefault();
var button = "#smsGroup-submit";
form_wait(button);
$.ajax({
       url: base_url +'groups/sms_group/send_sms',
       type: "POST",
       data: $('#smsGroup-form :input'),
       dataType: 'html',
     success: function (data) {
         form_complete(button);
         window.location.href = base_url + "groups/sms_group/";
       },
       error: function (data) {
          console.log('error');
                 }
           });
       });
