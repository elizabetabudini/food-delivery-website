function manage_pages(current_page, num_pages){

	$("nav ul li").removeClass("disabled");
	$("nav ul li").removeClass("active");

	if(current_page ==0){
		$("nav ul li:first-child").addClass("disabled");
	}

	if(current_page == num_pages - 1){
		$("nav ul li:last-child").addClass("disabled");
	}

	$("nav ul li:nth-child("+(current_page + 2)+")").addClass("active");
}

$(document).ready(function(){
	var page = 0;
	var num_pages = 0;

	$.getJSON("./../php/utentiperadmin.php?request=users&page="+page, function(data) {
		var html_code = "";
		for(var i = 0; i < data.length; i++){
			html_code += '<tr><th scope="row">'+data[i]["email"]+'</th><td>'+data[i]["nome"]+'</td><td>'+data[i]["cognome"]+'</td></td>'+data[i]["privilegi"]+'</td></tr>';
		}

		$("table tbody").html(html_code);
	});

	$.getJSON("./../php/utentiperadmin.php?request=num_pages_users", function(data) {
		var num_pages = data["num_pages_users"];

		html_code = '<li class="page-item disabled"><a class="page-link" href="#">Prev</a></li>';
		for(let i = 0; i < num_pages; i++){
			html_code += '<li class="page-item"><a class="page-link" href="#">'+(i+1)+'</a></li>';
		}
		html_code += '<li class="page-item"><a class="page-link" href="#">Next</a></li>';

		$("nav ul").html(html_code);

		manage_pages(page, num_pages);

		$("nav ul li").click(function(){
			//controllo se ha classe active o disabled
			if(!$(this).hasClass("disabled") && !$(this).hasClass("active")){
				var contenuto = $(this).find("a").text();
				switch(contenuto) {
					case "Prev":
						page -= 1;
						break;
					case "Next":
						page += 1;
						break;
					default:
						page = contenuto - 1;
				}

				$.getJSON("./../php/utentiperadmin.php?request=users&page="+page, function(data) {
					var html_code = "";
					for(var i = 0; i < data.length; i++){
						html_code += '<tr><th scope="row">'+data[i]["id"]+'</th><td>'+data[i]["nome"]+'</td><td>'+data[i]["cognome"]+'</td><td>'+data[i]["email"]+'</td></tr>';
					}

					$("table tbody").html(html_code);
				});
				manage_pages(page, num_pages);
				console.log(page);
			}

		});

	});
});
