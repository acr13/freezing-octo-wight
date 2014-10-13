$(function()
{
	$(".image-wrapper").on("click", function(e)
	{
		e.preventDefault();

		// pop open about page
	});

	$("#sign-up-form").submit(function(e)
	{
		e.preventDefault();

		$(".first-name-group").removeClass("has-error");
		$(".last-name-group").removeClass("has-error");
		$(".phone-group").removeClass("has-error");
		$(".email-group").removeClass("has-error");

		var error = false;

		// pull text
		if ($("#firstName").val() === "")
		{
			$(".first-name-group").toggleClass("has-error");
			error = true;
		}

		if ($("#lastName").val() === "")
		{
			$(".last-name-group").toggleClass("has-error");
			error = true;
		}

		if ($("#phoneNumber").val() === "")
		{
			$(".phone-group").toggleClass("has-error");
			error = true;
		}

		if ($("#emailAddress").val() === "")
		{
			$(".email-group").toggleClass("has-error");
			error = true;
		}

		if (error)
		{
			return;
		}

		var params = {
			firstName: $("#firstName").val(),
			lastName: $("#lastName").val(),
			phoneNumber: $("#phoneNumber").val(),
			emailAddress: $("#emailAddress").val()
		};

		// send a post to our server....
		$.post("process/register.php", params, function(resp)
		{
			if (resp.status)
			{
				window.location.href = "thanks.html";
			}
			else
			{
				console.log(resp.reason);
				alert("An error has occured during your registration. Please try again later.");
			}
		}, "json");

	});
});