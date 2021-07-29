$(document).ready(function()
{
	/* Começo do slide */

	var timeout = null;

	function begin()
	{
		console.log('vai');
		end();
		timeout = setInterval(function(){ selectNext() },5000);
	}

	function end()
	{
		console.log('para');
		clearTimeout(timeout);
	}

	function selectNext(next)
	{
		prev = $('.section.slide li.selected');
		prev.removeClass('selected');
		if (next == undefined) { next = (prev.next().length? prev.next() : $('.section.slide li:first')); }
		next.addClass('selected');
		$('.section.slide .img.wrapper').html('').append(next.find('img').clone());
	}

	selectNext();
	begin();

	$('.section.slide').hover(function(){ end(); }, function() { begin(); });
	$('.section.slide li').hover(function()
	{
		selectNext($(this));
		end();
	}, function() { begin(); });

	/* Fim do slide */

});