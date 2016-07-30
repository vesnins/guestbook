<div class="form">
	<form method="POST" action="/guestbook.ru/index.php/Guestbook/addComments">
		<div class="header">
			<h3>Оценить сервис на</h3> 
			<input type="radio" name="rating" value=1>
			<div id="radioRating1Checked"><img src="/guestbook.ru/images/commentsImage/Star Filled-20.png"></div>
			<input type="radio" name="rating" value=2>
			<div id="radioRating2Checked"><img src="/guestbook.ru/images/commentsImage/Star Filled-20.png"></div>
			<input type="radio" name="rating" value=3>
			<div id="radioRating3Checked"><img src="/guestbook.ru/images/commentsImage/Star Filled-20.png"></div>
			<input type="radio" name="rating" value=4>
			<div id="radioRating4Checked"><img src="/guestbook.ru/images/commentsImage/Star Filled-20.png"></div>
			<input type="radio" name="rating" value=5>
			<div id="radioRating5Checked"><img src="/guestbook.ru/images/commentsImage/Star Filled-20.png"></div>
		</div>
		<input name="firstname" type="text" size="101" />
		<textarea name="text" cols="100" rows="10" ></textarea>
		<div class="separator"></div>
		<ul class="fieldsForm">
			<li><select>
				<option>Sans</option>
				<option>Sans-Sherif</option>
				<option>Fantasy</option>
				<option>Monospace</option>
			</select></li>
			<li><button type="button" name="fontSize" value="+"><img src="/guestbook.ru/images/commentsEditImage/Increase Font-35.png"></button></li>
			<li><button type="button" name="fontSize" value="-"><img src="/guestbook.ru/images/commentsEditImage/Decrease Font-35.png"></button></li>
			<li><button type="button" name="fontDecoration" value="bold"><img src="/guestbook.ru/images/commentsEditImage/Bold Filled-35png"></button></li>
			<li><button type="button" name="fontDecoration" value="italic"><img src="/guestbook.ru/images/commentsEditImage/Italic Filled-35.png"></button></li>
			<li><button type="button" name="fontDecoration" value="underline"><img src="/guestbook.ru/images/commentsEditImage/Underline-35.png"></button></li>
		</ul>
		<ul class="submit">
			<li><button type="submit"><img src="/guestbook.ru/images/commentsEditImage/Paper Plane-35.png"></button></li>
		</ul>
	</form>
</div>