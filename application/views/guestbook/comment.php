<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<br/>
<?php //if(isset($answerComments)): echo 'Переменная $answerComments жива...'; else: 'Переменной $answerComments НЕТ!!!'; endif; ?>
<br/>
	<div class="comment">
		<div class="header">
			<span class="firstname"><?= $firstname;?></span> <?= $date; ?> 
				оставил отзыв:				
		</div>
		<div class="content">
			<?= $text;?>
		</div>
		<div class="footer">
			<ul>
				<li><span class="commentNumber">#<?= $id; ?></span></li>
				<li>Оценка:
				<?php
					for ($i=0; $i < 5; $i++) { 
						if($rating <= $i):
							echo '<img src="/guestbook.ru/images/commentsImage/Star Filled-20.png">';
						else:
							echo '<img src="/guestbook.ru/images/commentsImage/Star Filled-20-hover.png">';
						endif;
					}
				?>
				</li>
				<li><button class="responded"><img src="/guestbook.ru/images/commentsImage/Response-20.png"></button></li>
				<!-- После завершения дебага вернуть проверку на "==" -->
				<?php if($sessionId != session_id()):?>
					<li><button class="edit"><img src="/guestbook.ru/images/commentsImage/Pencil-20.png"></button></li>
					<li><button class="delete"><img src="/guestbook.ru/images/commentsImage/Delete-Filled-20.png"></button></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
	<div class="separator"></div>
	<?php 
// Данный if проверяет на существование массив с ответами на комментарии, и, если они существуют, то вызовет view ответов на комментарии. (В связи с использованием костыля, в условии if используется "@" подавляющаяя notice при отсутствие переменной) 
		if(@$answerComments)
		{
			$answerComments['preCommentFirstName'] = $firstname;
			$this->load->view('guestbook/answerComment', $answerComments);
		}
	?>
</body>
</html>