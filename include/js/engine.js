$(document).ready(function(){
	/* плавное появление контента */
	/*setTimeout(function() {
		$("#big_loader").css("display", "none");
		$("#mainblock").css("display", "block");
	}, 10 );  */

	/**********************************************************
	**     send as Post and load in #content
	***********************************************************/
	window.sendPost = function(href){
		$.post(href, $("#iditTarget").serialize(), function(data) {
			$('#content').html(data);
		});
	}

	/**********************************************************
	**		close Content Editor after click CloseButton
	**		and load old content
	***********************************************************/
	window.closeEditor = function(href){
		$.post(href+"&editor=close", $("#iditTarget").serialize(), function(data) {
			$('#content').html(data);
		});
	}

	/**********************************************************
	**     positioning #mainblock in center on Body resize
	***********************************************************/
	window.onBodyResize = function(){
		var mainBlockWidth = $("#mainblock").width();
		var left = ($(window).width()/2 - mainBlockWidth / 2);
		$("#mainblock").css('margin-left',left + 'px');
	}

	document.body.onresize = onBodyResize();
	onBodyResize();
});