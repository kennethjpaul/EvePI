			var baseURL ="http://127.0.0.1/EvePI/"
		$(function()
		{
			$("#navIcon").click(function()
			{
				$(".navAnimation_1").toggleClass("navAnimation_2");

			});
			$("#content").click(function()
			{
				$("#navElems").removeClass("navAnimation_2");
			});
			$("#addIDNav").click(function()
			{
				window.location.replace(baseURL+"clients/checkID");
			});
			$("#addCharNav").click(function()
			{
				window.location.replace(baseURL+"characters/checkChar.php");
			});
			$("#PINav").click(function()
			{
				window.location.replace(baseURL);
			});

		})
	
