<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
	<title>GuestBook</title>
	<link rel="stylesheet" type="text/css" href="/application/views/guestbook/css/main.css">
	
	<script type="text/javascript" src="/application/views/guestbook/js/jquery-3.0.0.min.js"></script>
	<script type="text/javascript" src="/application/views/guestbook/js/changeCommentsFormHandler.js"></script>
	<script type="text/javascript" src="/application/views/guestbook/js/commentsStyle.js"></script>
</head>
<body>
	
	<div class="pageHeader">
		<a href="#"><img src="/images/GuestBook-Header.png"></a>
		<h1>Оцените наш сервис!</h1>
	</div>
	<div class="separator"></div>
	<div class="pageContent">
		<div class="comments">
			<?php foreach ($comments as $dataItem) {
				$this->load->view('guestbook/comment', $dataItem);
			} ?>
		</div>	
		<div class="separator"></div>
		<div class="newComment">
			<?php /*$this->load->view('guestbook/newCommentForm');*/ ?>
		</div>
	</div>
</body>
</html>