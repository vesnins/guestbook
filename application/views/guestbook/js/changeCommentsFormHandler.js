$(document).ready(function(){

	// функция "включающая" radio кнопку в соответствии с кликнутым div'ом

	function radioRatingChecked(event)
	{
		$('input[value='+event.data.value+']').attr('checked', 'checked');
	}

	// функция стилизирующая картинки в соответствии с включенными радио кнопками
	function ratioCheckedImage(event)
	{
		for (var i = 1; i < 6; i++) {
			if(event.data.value < i){
				//console.log("Сработал if. $value = "+event.data.value+". i = "+i);
				$('#radioRating'+i+'Checked img').attr("src", "/guest-book.ru/images/commentsImage/Star Filled-20.png");
			} else {
				//console.log("Сработал else. $value = "+event.data.value+". i = "+i);
				$('#radioRating'+i+'Checked img').attr("src", "/guest-book.ru/images/commentsImage/Star Filled-20-hover.png");
			}
		}
	}

	// функция редактирования отзыва

	// function onAjaxSuccess(data)
	// {
	// 	console.log("POST-запрос с помощью Ajax`а выполнен");
	// 	console.log("Вот данные полученные от сервера:");
	// 	alert(data);

	// }

	// function inisializeAjax()
	// {
	// 	console.log('Мы попали в функцию');
	// 	$.post('/guest-book.ru/index.php/Guestbook/testAjax',
	// 		{
	// 			p1: "Параметр 1",
	// 			p2: 2
	// 		},
	// 		onAjaxSuccess
	// 	);
	// 	console.log('Мы свалили из Ajax`a');
	// }

	function getIdWhichResponded()
	{
		var IdResponded = $('#сommentsWhichAreResponsible span.commentNumber').text();
		IdResponded = IdResponded.substr(1);
		console.log(IdResponded);
		return IdResponded;
	}

	function getFormEditComment(event)
	{
		console.log('Мы попали в функцию "getFormEditComment"');
		$('#RespondedForm').remove();
		if (!event.data.isCommentResponded)
		{
			$(this).closest('.comment').attr('id', 'сommentsWhichAreResponsible');
			console.log('Это отзыв. Продолжаем обработку...');
			$('#сommentsWhichAreResponsible').after('<div class="form" id="RespondedForm"><form method="POST" action="/guest-book.ru/index.php/Guestbook/index/add"><div class="header"><h3>Вы хотите ответить на отзыв? Заполните форму:</h3></div><input type="hidden" name="idWhichResponded" value="'+getIdWhichResponded()+'"/><input name="firstname" type="text" size="101" /><textarea name="text" cols="100" rows="10" ></textarea><div class="separator"></div><ul class="fieldsForm"><li><select><option>Sans</option><option>Sans-Sherif</option><option>Fantasy</option><option>Monospace</option></select></li><li><button type="button" name="fontSize" value="+"><img src="/guest-book.ru/images/commentsEditImage/Increase Font-35.png"></button></li><li><button type="button" name="fontSize" value="-"><img src="/guest-book.ru/images/commentsEditImage/Decrease Font-35.png"></button></li><li><button type="button" name="fontDecoration" value="bold"><img src="/guest-book.ru/images/commentsEditImage/Bold Filled-35png"></button></li><li><button type="button" name="fontDecoration" value="italic"><img src="/guest-book.ru/images/commentsEditImage/Italic Filled-35.png"></button></li><li><button type="button" name="fontDecoration" value="underline"><img src="/guest-book.ru/images/commentsEditImage/Underline-35.png"></button></li></ul><ul class="submit"><li><button type="submit"><img src="/guest-book.ru/images/commentsEditImage/Paper Plane-35.png"></button></li></ul></form></div>');
			$(this).closest('.comment').removeAttr('id', 'сommentsWhichAreResponsible');
		} else {
			$(this).closest('.commentResponded').attr('id', 'сommentsWhichAreResponsible');
			console.log('Это ответ на отзыв. Продолжаем обработку...');
			$('#сommentsWhichAreResponsible').after('<div class="form" id="RespondedForm"><form method="POST" action="/guest-book.ru/index.php/Guestbook/index/add"><div class="header"><h3>Вы хотите ответить на отзыв? Заполните форму:</h3></div><input type="hidden" name="idWhichResponded" value="'+getIdWhichResponded()+'"/><input name="firstname" type="text" size="101" /><textarea name="text" cols="100" rows="10" ></textarea><div class="separator"></div><ul class="fieldsForm"><li><select><option>Sans</option><option>Sans-Sherif</option><option>Fantasy</option><option>Monospace</option></select></li><li><button type="button" name="fontSize" value="+"><img src="/guest-book.ru/images/commentsEditImage/Increase Font-35.png"></button></li><li><button type="button" name="fontSize" value="-"><img src="/guest-book.ru/images/commentsEditImage/Decrease Font-35.png"></button></li><li><button type="button" name="fontDecoration" value="bold"><img src="/guest-book.ru/images/commentsEditImage/Bold Filled-35png"></button></li><li><button type="button" name="fontDecoration" value="italic"><img src="/guest-book.ru/images/commentsEditImage/Italic Filled-35.png"></button></li><li><button type="button" name="fontDecoration" value="underline"><img src="/guest-book.ru/images/commentsEditImage/Underline-35.png"></button></li></ul><ul class="submit"><li><button type="submit"><img src="/guest-book.ru/images/commentsEditImage/Paper Plane-35.png"></button></li></ul></form></div>');
			$(this).closest('.commentResponded').removeAttr('id', 'сommentsWhichAreResponsible');
		}
	}

	// Обработка Radio кнопок

	$('#radioRating1Checked').bind("click", { value: "1"}, radioRatingChecked);
	$('#radioRating1Checked').bind("click", { value: "1"}, ratioCheckedImage);
	$('#radioRating2Checked').bind("click", { value: "2"}, radioRatingChecked);
	$('#radioRating2Checked').bind("click", { value: "2"}, ratioCheckedImage);
	$('#radioRating3Checked').bind("click", { value: "3"}, radioRatingChecked);
	$('#radioRating3Checked').bind("click", { value: "3"}, ratioCheckedImage);
	$('#radioRating4Checked').bind("click", { value: "4"}, radioRatingChecked);
	$('#radioRating4Checked').bind("click", { value: "4"}, ratioCheckedImage);
	$('#radioRating5Checked').bind("click", { value: "5"}, radioRatingChecked);
	$('#radioRating5Checked').bind("click", { value: "5"}, ratioCheckedImage);

	// Обработка редактирование отзыва

	$('.commentResponded .footer button.responded img').on('click', {isCommentResponded: true}, getFormEditComment);
	$('.comment .footer button.responded img').on('click', {isCommentResponded: false}, getFormEditComment);

});