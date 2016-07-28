$(document).ready(function(){

	function animationButtonMouseEnter(event)
	{
		$(this).attr('src', event.data.imagelink);
	}

	function animationButtonMouseLeave(event)
	{
		$(this).attr('src', event.data.imagelink);
	}

	$('.footer button.responded img').on('mouseenter', {imagelink: "/guest-book.ru/images/commentsImage/Response-20-hover.png"}, animationButtonMouseEnter);
	$('.footer button.responded img').on('mouseleave', {imagelink: "/guest-book.ru/images/commentsImage/Response-20.png"}, animationButtonMouseLeave);
	$('.footer button.edit img').on('mouseenter', {imagelink: "/guest-book.ru/images/commentsImage/Pencil-20-hover.png"}, animationButtonMouseEnter);
	$('.footer button.edit img').on('mouseleave', {imagelink: "/guest-book.ru/images/commentsImage/Pencil-20.png"}, animationButtonMouseLeave);
	$('.footer button.delete img').on('mouseenter', {imagelink: "/guest-book.ru/images/commentsImage/Delete-Filled-20-hover.png"}, animationButtonMouseEnter);
	$('.footer button.delete img').on('mouseleave', {imagelink: "/guest-book.ru/images/commentsImage/Delete-Filled-20.png"}, animationButtonMouseLeave);

});