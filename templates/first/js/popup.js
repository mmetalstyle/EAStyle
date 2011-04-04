/*****************************
**     Popup message
******************************/

//close pop-up box
function closePopup()
 {
   $('#opaco').toggleClass('hidden').removeAttr('style');
   $('#popup').toggleClass('hidden');
   return false;
 }

//open pop-up
function showPopup(popup_type)
 {
   //when IE - fade immediately
   if($.browser.msie)
   {
     //$('#opaco').height($(document).height()).toggleClass('hidden');
   }
   else
   //in all the rest browsers - fade slowly
   {
     $('#opaco').height($(document).height()).toggleClass('hidden').fadeTo('slow', 0.7);
   }

   $('#popup')
     .html($('#popup_' + popup_type).html())
     //.setWidth()
     .alignCenter()
     .toggleClass('hidden');

   return false;
 }

//additional properties for jQuery object
$(document).ready(function(){

	$.fn.setWidth = function() {
		var width = Math.max(40, parseInt(($(window).width()/100)*70)) + 'px';
		return $('#popup').css({'min-width':width});
	};


   //align element in the middle of the screen
   $.fn.alignCenter = function() {
      var marginLeft = Math.max(40, parseInt($(window).width()/2 - $(this).width()/2)) + 'px';
      var marginTop = Math.max(40, parseInt($(window).height()/2 - $(this).height()/2)) + 'px';
      //return updated element
      return $(this).css({'margin-left':marginLeft, 'margin-top':marginTop});
   };

});