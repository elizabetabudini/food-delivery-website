$(document).ready(function(){

	$.getJSON("apimessaggi.php?request=messages", function(data) {
		      var html_code = "";
					if(data.length>0){
								$('#overlay').fadeIn(300);
					}

					$('#close').click(function() {
							$('#overlay').fadeOut(300);
					});
				});
	}
