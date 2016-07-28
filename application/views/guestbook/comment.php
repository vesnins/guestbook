<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
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
							echo '<img src="/images/commentsImage/Star Filled-20.png">';
						else:
							echo '<img src="/images/commentsImage/Star Filled-20-hover.png">';
						endif;
					}
				?>
				</li>
				<li><button class="responded"><img src="/images/commentsImage/Response-20.png"></button></li>
				<!-- После завершения дебага вернуть проверку на "==" -->
				<?php if($sessionId != session_id()):?>
					<li><button class="edit"><img src="/images/commentsImage/Pencil-20.png"></button></li>
					<li><button class="delete"><img src="/images/commentsImage/Delete-Filled-20.png"></button></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
	<div class="separator"></div>
	<? if($answerComments != ''): ?>
		<?php foreach($answerComments as $answerComment) {
			echo "<br/>";
			print_r($answerComment);
			echo "<br/>";
			$answerComment['preCommentFirstName'] = $firstname;
			echo "<br/>";
			print_r($answerComments);
			echo "<br/>";
			$this->load->view('guestbook/answerComment', $answerComment);
		}?>
	<? endif; ?>
</body>
</html>