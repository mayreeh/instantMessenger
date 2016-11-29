//MANAGE ADMIN USERS
$('#newAdminUser-form').submit(function (event) {
event.preventDefault();
var button = "#newAdminUser-submit";
form_wait(button);
$.ajax({
       url: base_url +'admin/users/create',
       type: "POST",
       data: $('#newAdminUser-form :input'),
       dataType: 'html',
     success: function (data) {
         form_complete(button);
         window.location.href = base_url + "admin/users/";
         },
       error: function (data) {
          console.log('error');
                 }
           });
       });
//edit user
$('.editAdminUser').on('click', function () {
var id = $(this).attr('data-id');
  $.ajax({
   url:  base_url+'admin/getUserById/' + id,
   method: 'GET',
   dataType: 'json',
  }) .success(function(response) {
    $('#newAdminUser-form')
        .find('[name="user_id"]').val(response.user_id).end()
        .find('[name="username"]').val(response.username).end()
        .find('[name="fullname"]').val(response.fullname).end()
        .find('[name="password"]').val(response.password).end()
        .find('[name="email"]').val(response.email).end()
    $('#myModal').modal({show:true});
  });
});


//MANAGE USERS ACCOUNTS
$('#newAccountUser-form').submit(function (event) {
event.preventDefault();
var button = "#newAccountUser-submit";
form_wait(button);
$.ajax({
       url: base_url +'users/users_accounts/create',
       type: "POST",
       data: $('#newAccountUser-form :input'),
       dataType: 'html',
     success: function (data) {
         form_complete(button);
         window.location.href = base_url + "users/users_accounts/";
         },
       error: function (data) {
          console.log('error');
                 }
           });
       });
//edit user
$('.editAccountUser').on('click', function () {
var id = $(this).attr('data-id');
  $.ajax({
   url:  base_url+'users/getAccountUserById/' + id,
   method: 'GET',
   dataType: 'json',
  }) .success(function(response) {
    $('#newAccountUser-form')
        .find('[name="account_id"]').val(response.account_id).end()
        .find('[name="mini_account_id"]').val(response.mini_account_id).end()
        .find('[name="username"]').val(response.username).end()
        .find('[name="fullname"]').val(response.fullname).end()
        .find('[name="password"]').val(response.password).end()
        .find('[name="email"]').val(response.email).end()
    $('#myModal').modal({show:true});
  });
});

//MANAGE AT SMS GATEWAY
$('#smsATGateway-form').submit(function (event) {
event.preventDefault();
var button = "#smsATGateway-submit";
form_wait(button);
$.ajax({
       url: base_url +'sms/sms_AT_gateway/',
       type: "POST",
       data: $('#smsATGateway-form :input'),
       dataType: 'html',
     success: function (data) {
         form_complete(button);
         window.location.href = base_url + "sms/sms_AT_gateway/";
         },
       error: function (data) {
          console.log('error');
                 }
           });
       });
