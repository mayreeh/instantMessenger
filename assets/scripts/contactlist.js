function get_group_contacts(group_id) {

    $.ajax({
          url: base_url + 'home/get_group_contacts/' + group_id ,
          success: function(response)
          {
              jQuery('#contactlist_holder').html(response);
          }
      });

  }
function deleteRow(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('POITable').deleteRow(i);
}


function insRow()
{
    console.log( 'hi');
    var x=document.getElementById('POITable');
    var new_row = x.rows[1].cloneNode(true);
    var len = x.rows.length;
    new_row.cells[0].innerHTML = len;

    var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
    inp1.id += len;
    inp1.value = '';
    var inp2 = new_row.cells[2].getElementsByTagName('input')[0];
    inp2.id += len;
    inp2.value = '';
    x.appendChild( new_row );
}
//Add Groups
$('#newGroup-form').submit(function (event) {
event.preventDefault();
var button = "#newGroup-submit";
form_wait(button);
$.ajax({
       url: base_url +'home/contact_groups/create',
       type: "POST",
       data: $('#newGroup-form :input'),
       dataType: 'html',
     success: function (data) {
         form_complete(button);
         window.location.href = base_url + "home/contactlist/";
         },
       error: function (data) {
          console.log('error');
                 }
           });
       });

//new contact
//Add Groups
$('#newContactList-form').submit(function (event) {
event.preventDefault();
var button = "#newContactList-submit";
form_wait(button);
$.ajax({
       url: base_url +'home/contactlist/create',
       type: "POST",
       data: $('#newContactList-form :input'),
       dataType: 'html',
     success: function (data) {
         form_complete(button);
         window.location.href = base_url + "home/contactlist/";
         },
       error: function (data) {
          console.log('error');
                 }
           });
       });
