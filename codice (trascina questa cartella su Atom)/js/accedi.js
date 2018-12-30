$(document).ready(function(){
	$("form button").click(function(){


		$(".alert-php").hide();
		event.preventDefault();
		errors = "";

		var email = $("input#email").val();
    var password = $("input#password").val();

		if(email == null || !validateEmail(email)){
			errors += "Email è obbligatoria e deve essere valida<br/>";
		}
    if(password == null){
			errors += "Password obbligatoria<br/>";
		}

		if(errors.length > 0)
		{
			var nome = $("div.alert-js p").html(errors);
			$("div.alert-js").show();
		}
		else
		{
			console.log("Sottomissione...");
			$(this).parent().submit();
			console.log("Sottomesso");
		}

	});
});
