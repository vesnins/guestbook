<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
	<title>GuestBook</title>
	<link rel="stylesheet" type="text/css" href="/guestbook.ru/application/views/guestbook/css/main.css">
	
	<script type="text/javascript" src="/guestbook.ru/application/views/guestbook/js/jquery-3.0.0.min.js"></script>
	<script type="text/javascript" src="/guestbook.ru/application/views/guestbook/js/changeCommentsFormHandler.js"></script>
	<script type="text/javascript" src="/guestbook.ru/application/views/guestbook/js/commentsStyle.js"></script>
</head>
<body>
	
	<div class="pageHeader">
		<a href="#"><img src="/guestbook.ru/images/GuestBook-Header.png"></a>
		<h1>Оцените наш сервис!</h1>
	</div>
	<div class="separator"></div>
	<div class="pageContent">
		<div class="comments">
			<?php foreach ($comments as $dataItem) {
				// Небольшой костыль для решения бага с сохранением переменной в view
				// Смысл заключается в том, что если эелемент массива с ответами на комментарии не существует, он создается и ему присваевается значение False. Проверка на view осуществляется именно на True или False. Можно было, конечно, во view обычным isset сделать, но view почему-то сохранял переменную при повторном вызове отображения, хотя в массиве этого переданно не было. В общем подругому решить не удалось, да и это было "нагугленно" в интернете.  
				if (!isset($dataItem['answerComments'])) {
					$dataItem['answerComments'] = FALSE;
				}
				$this->load->view('guestbook/comment', $dataItem);
			} ?>
		</div>	
		<div class="separator"></div>
		<div class="newComment">
			<?php $this->load->view('guestbook/newCommentForm'); ?>
		</div>
	</div>
</body>
</html>