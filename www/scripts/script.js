$(document).ready(function(){
	$("#menu").on("click","a", function (event) {
		//отменяем стандартную обработку нажатия по ссылке
		event.preventDefault();

		//забираем идентификатор бока с атрибута href
		var id  = $(this).attr('href');
		
		switch(id){
			case "#post":
				$(id).fadeIn(1000);
				$("#comment").fadeOut();
				$("#poll").fadeOut();
			break;
			case "#comment":
				$(id).fadeIn(1000);
				$("#post").fadeOut();
				$("#poll").fadeOut();
			break;
			case "#poll":
				$(id).fadeIn(1000);
				$("#comment").fadeOut();
				$("#post").fadeOut();
			break;			
		}
		
	});
});


function AFR(result_id,form_id,url) {								
                jQuery.ajax({
                    url:     url, //Адрес подгружаемой страницы
                    type:     "POST", //Тип запроса
                    dataType: "html", //Тип данных
                    data: jQuery("#"+form_id).serialize(), 
                    success: function(response) { //Если все нормально
						response = $.trim(response);
						$(".results").css({
							"color": (response == "Отправлено") ? "#2A5A45" : "red"
						});
						document.getElementById(result_id).innerHTML = response;
						document.getElementById(form_id).reset();
						document.getElementById('btn_anon').innerHTML = 'Открытый';
                },
                error: function(response) { //Если ошибка
					document.getElementById(result_id).innerHTML = "Ошибка при отправке формы";
                }
             });
			 
			$(".results").css({
					"top": $("#"+form_id).offset().top + $("#"+form_id).height()/4,
				});
				
			$(".results").fadeIn("slow");
	}
	
function accept(){
	$(".results").fadeOut("slow");
}
