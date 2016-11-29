  function form_wait(button)
    {
      var wait = "<i class=\"fa fa-spinner fa-spin\"></i>&nbsp;Please wait................";
      button_content = $(button).html();
      $(button).html(wait);
      $('#wait').html(wait);
    }
  function form_complete(button)
      {
        $(button).html(button_content);
        $('#wait').html("");
      }
function confirm_delete(urls)
{
    var chk = confirm("Are You Sure To Delete ?");
    if(chk)
    {
        $.ajax({
           url: urls,
           method: 'GET',
           dataType: 'html',
         }) .success(function(response) {
            window.location.href = urls;
        });
    }
    else{
        return false;
    }
}
