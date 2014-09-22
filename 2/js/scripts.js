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

		// send a post to our server....

	});
});