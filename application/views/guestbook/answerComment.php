<div class="commentResponded">
	<div class="header">
		<span class="firstname"><?= $firstname;?></span> <?= $date; ?> 
			ответил на отзыв #<?= $idComment; ?> от <?= $parentCommentFirstName; ?>
	</div>
	<div class="content">
		<?= $text;?>
	</div>
	<div class="footer">
		<ul>
			<li><span class="commentNumber">#<?= $id; ?></span></li>
			<li><button class="responded"><img src="/images/commentsImage/Response-20.png"></button></li>
			<?php if($sessionId == session_id()):?>
				<li><button class="edit"><img src="/images/commentsImage/Pencil-20.png"></button></li>
				<li><button class="delete"><img src="/images/commentsImage/Delete-Filled-20.png"></button></li>
			<?php endif; ?>
		</ul>
	</div>
</div>
<div class="separator"></div>