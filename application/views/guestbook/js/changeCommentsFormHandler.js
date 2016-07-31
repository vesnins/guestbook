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
				$('#radioRating'+i+'Checked img').attr("src", "/guestbook.ru/images/commentsImage/Star Filled-20.png");
			} else {
				//console.log("Сработал else. $value = "+event.data.value+". i = "+i);
				$('#radioRating'+i+'Checked img').attr("src", "/guestbook.ru/images/commentsImage/Star Filled-20-hover.png");
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
	// 	$.post('/guestbook.ru/index.php/Guestbook/testAjax',
	// 		{
	// 			p1: "Параметр 1",
	// 			p2: 2
	// 		},
	// 		onAjaxSuccess
	// 	);
	// 	console.log('Мы свалили из Ajax`a');
	// }

	// Данная функция получает ID комментария с помощью JQuery (обращаясь по созданному вызывающей функцией селектору)
	function getIdComment()
	{
		var idComment = $('#сommentsWhichAreResponsible span.commentNumber').text();
		idComment = idComment.substr(1);
		return idComment;
	}

	// Данная функция получает дату комментария с помощью JQuery (обращаясь по созданному вызывающей функцией селектору)
	function getDateComment()
	{
		var dateComment = $('#сommentsWhichAreResponsible span.date').text();
		console.log(dateComment);
		return dateComment;
	}

	// Глобальная переменная используемая для определения вывода формы ответа на комментарий (выведенна или нет)
	var FormAddAnswerCommentIsShow;

	// Данная функция выводит (и скрывает) форму ответа на комментарий на основании данных обработчика и значения переменной FormAddAnswerCommentIsShow
	function getFormAddAnswerComment(event)
	{
		// Данный if проверяет есть ли форма ответа на комментарий на странице. Если нет, то он создает её и
		// присваевает переменной FormAddAnswerCommentIsShow значение true, говорящее о том, что форма создана.
		// Если форма есть, то он удаляет её и присваевает переменной значение false
		if (!window.FormAddAnswerCommentIsShow)
		{
			if (!event.data.isCommentResponded)
			{
				$(this).closest('.comment').attr('id', 'сommentsWhichAreResponsible');
				// Добавить action="/guestbook.ru/index.php/Guestbook/addAnswerComment"
				$('#сommentsWhichAreResponsible').after('<div class="form" id="RespondedForm"><form method="POST" ><div class="header"><h3>Вы хотите ответить на отзыв? Заполните форму:</h3></div><input type="hidden" name="idComment" value="'+getIdComment()+'"/><input name="firstname" type="text" size="101" /><textarea name="text" cols="100" rows="10" ></textarea><div class="separator"></div><ul class="fieldsForm"><li><select><option>Sans</option><option>Sans-Sherif</option><option>Fantasy</option><option>Monospace</option></select></li><li><button type="button" name="fontSize" value="+"><img src="/guestbook.ru/images/commentsEditImage/Increase Font-35.png"></button></li><li><button type="button" name="fontSize" value="-"><img src="/guestbook.ru/images/commentsEditImage/Decrease Font-35.png"></button></li><li><button type="button" name="fontDecoration" value="bold"><img src="/guestbook.ru/images/commentsEditImage/Bold Filled-35png"></button></li><li><button type="button" name="fontDecoration" value="italic"><img src="/guestbook.ru/images/commentsEditImage/Italic Filled-35.png"></button></li><li><button type="button" name="fontDecoration" value="underline"><img src="/guestbook.ru/images/commentsEditImage/Underline-35.png"></button></li></ul><ul class="submit"><li><button id="sendData" type="button"><img src="/guestbook.ru/images/commentsEditImage/Paper Plane-35.png"></button></li></ul></form></div>');
				$('#sendData').on('click', {isCommentResponded: false}, sendAnswerComment);
				$(this).closest('.comment').removeAttr('id', 'сommentsWhichAreResponsible');
			} else {
				$(this).closest('.commentResponded').attr('id', 'сommentsWhichAreResponsible');
				$('#сommentsWhichAreResponsible').after('<div class="form" id="RespondedForm"><form method="POST" ><div class="header"><h3>Вы хотите ответить на отзыв? Заполните форму:</h3></div><input type="hidden" name="idComment" value="'+getIdComment()+'"/><input name="firstname" type="text" size="101" /><textarea name="text" cols="100" rows="10" ></textarea><div class="separator"></div><ul class="fieldsForm"><li><select><option>Sans</option><option>Sans-Sherif</option><option>Fantasy</option><option>Monospace</option></select></li><li><button type="button" name="fontSize" value="+"><img src="/guestbook.ru/images/commentsEditImage/Increase Font-35.png"></button></li><li><button type="button" name="fontSize" value="-"><img src="/guestbook.ru/images/commentsEditImage/Decrease Font-35.png"></button></li><li><button type="button" name="fontDecoration" value="bold"><img src="/guestbook.ru/images/commentsEditImage/Bold Filled-35png"></button></li><li><button type="button" name="fontDecoration" value="italic"><img src="/guestbook.ru/images/commentsEditImage/Italic Filled-35.png"></button></li><li><button type="button" name="fontDecoration" value="underline"><img src="/guestbook.ru/images/commentsEditImage/Underline-35.png"></button></li></ul><ul class="submit"><li><button id="sendData" type="button"><img src="/guestbook.ru/images/commentsEditImage/Paper Plane-35.png"></button></li></ul></form></div>');
				$('#sendData').on('click', {isCommentResponded: true}, sendAnswerComment);
				$(this).closest('.commentResponded').removeAttr('id', 'сommentsWhichAreResponsible');
			}
			// Форма создана и показана, давайте присвоем глобальной переменной FormAddAnswerCommentIsShow значение TRUE;
			window.FormAddAnswerCommentIsShow = true;
		} else {
			$('#RespondedForm').remove();
			window.FormAddAnswerCommentIsShow = false;
		}
	}

	// Глобальная переменная используемая для определения вывода формы редактирования комментария (выведенна или нет)
	var FormEditCommentIsShow;
 
 	// Данная функция выводит (и скрывает) форму редактирования комментария на основании данных обработчика и значения переменной FormEditCommentIsShow
	function getFormEditComment(event)
	{
		// Данный if проверяет есть ли форма ответа на комментарий на странице. Если нет, то он создает её и
		// присваевает переменной FormEditCommentIsShow значение true, говорящее о том, что форма создана.
		// Если форма есть, то он удаляет её и присваевает переменной значение false
		if (!window.FormEditCommentIsShow) 
		{
			if (!event.data.isCommentResponded)
			{
				$(this).closest('.comment').attr('id', 'сommentsWhichAreResponsible');
				$('#сommentsWhichAreResponsible').after('<div class="form" id="EditCommentForm"><form method="POST" action="/guestbook.ru/index.php/Guestbook/editComment"><div class="header"><h3>Вы хотите отредактировать свой отзыв? Заполните форму:</h3></div><input name="date" type="hidden" value="'+getDateComment()+'" /><input name="firstname" type="text" size="101" /><textarea name="text" cols="100" rows="10" ></textarea><div class="separator"></div><ul class="fieldsForm"><li><select><option>Sans</option><option>Sans-Sherif</option><option>Fantasy</option><option>Monospace</option></select></li><li><button type="button" name="fontSize" value="+"><img src="/guestbook.ru/images/commentsEditImage/Increase Font-35.png"></button></li><li><button type="button" name="fontSize" value="-"><img src="/guestbook.ru/images/commentsEditImage/Decrease Font-35.png"></button></li><li><button type="button" name="fontDecoration" value="bold"><img src="/guestbook.ru/images/commentsEditImage/Bold Filled-35png"></button></li><li><button type="button" name="fontDecoration" value="italic"><img src="/guestbook.ru/images/commentsEditImage/Italic Filled-35.png"></button></li><li><button type="button" name="fontDecoration" value="underline"><img src="/guestbook.ru/images/commentsEditImage/Underline-35.png"></button></li></ul><ul class="submit"><li><button id="sendData" type="button"><img src="/guestbook.ru/images/commentsEditImage/Paper Plane-35.png"></button></li></ul></form></div>');
				$('#sendData').on('click', {isCommentResponded: false}, sendEditComment);
				$(this).closest('.comment').removeAttr('id', 'сommentsWhichAreResponsible');
			} else {
				$(this).closest('.commentResponded').attr('id', 'сommentsWhichAreResponsible');
				$('#сommentsWhichAreResponsible').after('<div class="form" id="EditCommentForm"><form method="POST" action="/guestbook.ru/index.php/Guestbook/editAnswerComment"><div class="header"><h3>Вы хотите отредактировать свой отзыв? Заполните форму:</h3></div><input name="date" type="hidden" value="'+getDateComment()+'" /><input name="firstname" type="text" size="101" /><textarea name="text" cols="100" rows="10" ></textarea><div class="separator"></div><ul class="fieldsForm"><li><select><option>Sans</option><option>Sans-Sherif</option><option>Fantasy</option><option>Monospace</option></select></li><li><button type="button" name="fontSize" value="+"><img src="/guestbook.ru/images/commentsEditImage/Increase Font-35.png"></button></li><li><button type="button" name="fontSize" value="-"><img src="/guestbook.ru/images/commentsEditImage/Decrease Font-35.png"></button></li><li><button type="button" name="fontDecoration" value="bold"><img src="/guestbook.ru/images/commentsEditImage/Bold Filled-35png"></button></li><li><button type="button" name="fontDecoration" value="italic"><img src="/guestbook.ru/images/commentsEditImage/Italic Filled-35.png"></button></li><li><button type="button" name="fontDecoration" value="underline"><img src="/guestbook.ru/images/commentsEditImage/Underline-35.png"></button></li></ul><ul class="submit"><li><button id="sendData" type="button"><img src="/guestbook.ru/images/commentsEditImage/Paper Plane-35.png"></button></li></ul></form></div>');
				$('#sendData').on('click', {isCommentResponded: true}, sendEditAnswerComment);
				$(this).closest('.commentResponded').removeAttr('id', 'сommentsWhichAreResponsible');
			}
			// Форма создана и показана, давайте присвоем глобальной переменной FormAddAnswerCommentIsShow значение TRUE;
			window.FormEditCommentIsShow = true;
		} else {
			$('#EditCommentForm').remove();
			window.FormEditCommentIsShow = false;
		}
	}

// Данная функция отправляет PHP запрос на удаление комментариев передавая ему через Ajax id удаляемого комментария
	function deleteComment(event) 
	{
		if(!event.data.isCommentResponded)
		{
			$(this).closest('.comment').attr('id', 'сommentsWhichAreResponsible');
			var idComment = getIdComment();
			$.post('/guestbook.ru/index.php/Guestbook/deleteComment',
		 		{
		 			id: idComment
		 		},
		 		console.log('Передан ID: '+idComment+'. Запрос обработан. Это конечная функция')
	 		);
			$(this).closest('.comment').removeAttr('id', 'сommentsWhichAreResponsible');
		} else {
			$(this).closest('.commentResponded').attr('id', 'сommentsWhichAreResponsible');
			var idComment = getIdComment();
			$.post('/guestbook.ru/index.php/Guestbook/deleteAnswerComment',
		 		{
		 			id: idComment
		 		},
		 		console.log('Передан ID: '+getIdComment+'. Запрос обработан. Это конечная функция')
	 		);
			$(this).closest('.commentResponded').removeAttr('id', 'сommentsWhichAreResponsible');	
		}
	}

//
	function sendAnswerComment(event)
	{
		console.log('Обработчик сработал');
		if(!event.data.isCommentResponded)
		{
			var dataForm;
			dataForm = jQuery.param($('#RespondedForm form').serializeArray());
			console.log(dataForm);
			$.ajax({
			  type: "POST",
			  url: "/guestbook.ru/index.php/Guestbook/addAnswerComment",
			  data: dataForm,
			  success: function(msg){
			  	$('#RespondedForm').before(msg);
			  	$('#RespondedForm').remove();
			  }
			});
		} else {
			var dataForm;
			dataForm = $('#RespondedForm form').val();
			console.log(dataForm);
		}
	}

// Данная функция производит отправку данных черех Ajax на сервер и получает "обновленную" страницу.
// Вызываетяс обработчиком формы отправки комментария
	function addComment()
	{
		console.log('Обработчик сработал');
		var dataForm;
		dataForm = jQuery.param($('.newComment form').serializeArray());
		console.log(dataForm);
		$.ajax({
		  type: "POST",
		  url: "/guestbook.ru/index.php/Guestbook/addComments",
		  data: dataForm,
		  success: function(msg){
		   $('.comments').append(msg);
		  }
		});
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

	// Обработчики вызова формы при клике на кнопку ответа на комментарий

	$('.commentResponded .footer button.responded img').on('click', {isCommentResponded: true}, getFormAddAnswerComment);
	$('.comment .footer button.responded img').on('click', {isCommentResponded: false}, getFormAddAnswerComment);

	// Обработчики вызова формы при клике на кнопку редоктирования комментария

	$('.commentResponded .footer button.edit img').on('click', {isCommentResponded: true}, getFormEditComment);
	$('.comment .footer button.edit img').on('click', {isCommentResponded: false}, getFormEditComment);

	// Обработчики удаления комментария при клике на соответствующую кнопку

	$('.commentResponded .footer button.delete img').on('click', {isCommentResponded: true}, deleteComment);
	$('.comment .footer button.delete img').on('click', {isCommentResponded: false}, deleteComment);	

	// Обработчики отправки данных submit'ом через форму добавления комментариев

	$('.submit button img').on('click', addComment);


});