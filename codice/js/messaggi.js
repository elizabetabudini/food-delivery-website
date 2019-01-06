$(document).ready(function(){

	setInterval(function() {
		$.post("unread.php")
		.done(function(data) {
			var data=$(data);
			$('.msg').html(data);
		})
	}, 1000);

	$('.hover_bkgr_fricc').click(function(){
		$('.hover_bkgr_fricc').hide();
	});

	$('.popupCloseButton').click(function(){
		$('.hover_bkgr_fricc').hide();
	});

})
