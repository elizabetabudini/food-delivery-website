$(document).ready(function(){

	setInterval(function() {
		$.post("unread.php")
		.done(function(data) {
			var data=$(data);
			if(data>0){
				$('#msg').html(data);

			} else {
				$('#msg').html(data);
			}
		})
	}, 1000);

})
