$(function()
{
  $("#sign-up-btn").on("click", function(e)
  {
    e.preventDefault();

    var params = {
      firstName: $("#firstName").val(),
      lastName: $("#lastName").val(),
      emailAddress: $("#emailAddress").val()
    };

    console.log(params);

    $.post("process/register.php", params, function(resp)
    {
      console.log(resp);
    }, function(err)
    {
      console.log(err);
    });


  });

});