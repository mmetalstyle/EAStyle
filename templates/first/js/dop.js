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

window.pageOnLoad = function(href){
	$("#big_loader").css("display", "none");
	$("#mainblock").css("display", "block");
}

$(document).ready(function(){
        /* ������� ��������� �������� */
        setTimeout(function() {
        	$("#big_loader").css("display", "none");
			$("#mainblock").css("display", "block");
		}, 10 );
		 window.sendPost = function(href){
        	$.post(href, $("#iditTarget").serialize(), function(data) {
        	$('#content').html(data);
			});
        }
        window.closeEditor = function(href){
  				$.post(href+"&editor=close", $("#iditTarget").serialize(), function(data) {
  				$('#content').html(data);
			});
        }

		window.onBodyResize = function(){
			var left = ($(window).width()/2)-475;
			$("#mainblock").css('margin-left',left + 'px');
		}

		$('#header-images').cycle({
    		fx:      'fade',
   		    speed:    3000,
    		timeout:  10
		});
		onBodyResize();
});

$(document).ready(function () {

	$.fn.infiniteCarousel = function () {

    function repeat(str, num) {
        return new Array( num + 1 ).join( str );
    }

        var index = 0;
        var maximges = 8;
        var showed = 6;
        var nextshag = true;
    return this.each(function () {
        var $wrapper = $('.wrapper', this).css('overflow', 'hidden'),
            $slider = $wrapper.find('> ul'),
            $items = $slider.find('> li'),
            $single = $items.filter(':first'),
            maximges = $items.length;
            singleWidth = 106,
            //visible = Math.ceil($wrapper.innerWidth() / singleWidth), // note: doesn't include padding or border
            visible = 6;
            currentPage = 1,
            pages = Math.ceil($items.length / visible);
        // 1. Pad so that 'visible' number will always be seen, otherwise create empty items
        if (($items.length % visible) != 0) {
            $slider.append(repeat('<li class="empty" />', visible - ($items.length % visible)));
            $items = $slider.find('> li');
        }

        // 2. Top and tail the list with 'visible' number of items, top has the last section, and tail has the first
        $items.filter(':first').before($items.slice(- visible).clone().addClass('cloned'));
        $items.filter(':last').after($items.slice(0, visible).clone().addClass('cloned'));
        $items = $slider.find('> li'); // reselect

        // 3. Set the left position to the first 'real' item
        //$wrapper.scrollLeft(200);
        $wrapper.filter(':not(:animated)').animate({
                scrollLeft : '+=' + 625
        });
        // 4. paging function
        function gotoPage(page) {
        	nextshag = false;
            var left = singleWidth * page * 2;

            $wrapper.filter(':not(:animated)').animate({
                scrollLeft : '+=' + left
            }, 500, function () {
                if (page == 0) {
                    $wrapper.scrollLeft(singleWidth * visible * pages);
                    page = pages;
                } else if (page > pages) {
                    $wrapper.scrollLeft(singleWidth * visible);
                    // reset back to start position
                    page = 1;
                }
                nextshag = true;
                currentPage = page;
            });

            return false;
        }

        $wrapper.after('<a class="arrow back">&lt;</a><a class="arrow forward">&gt;</a>');

        // 5. Bind to the forward and back buttons
        $('a.back', this).click(function () {
        if(nextshag){
        	index -= 2;
        	if(index < (maximges - showed)){ $('a.forward').show(); }
        	if(index == 0){ $('a.back').hide(); }
            return gotoPage(-1);
            }
        });
        $('a.back').hide();
        $('a.forward', this).click(function () {
        if(nextshag){
        	index += 2;
        	if(index >= 2){ $('a.back').show(); }
        	if(index >= (maximges - showed)){ $('a.forward').hide(); }
            return gotoPage(1);
            }
        });

        // create a public interface to move to a specific page
        $(this).bind('goto', function (event, page) {
            gotoPage(page);
        });
    });

};

  $('.infiniteCarousel').infiniteCarousel();
   var iii = 0;
   var jjj = 0;
   var images = 10;
   var naprav = true;
   var nextImgRaz = true;
   window.panoramPos = function(image){
		   if(image.attr('s') == 'h'){
		       setTimeout(function() {
		       iii++;
		       $('#gallery-image').css('background-position','-'+(jjj)+'px -'+(iii + 50)+'px');
		       //if((iii % 6) == 0){ jjj++; }
		       if(nextImgRaz){
		       	if(iii < 215){
		       			panoramPos(image);
		       	}else{
		       			galleryNextImage(image);
		       	}
		       }
			   }, 22);
			}else{
			   setTimeout(function() {
		       iii++;
		       $('#gallery-image').css('background-position','-'+iii+'px -'+(iii + 50)+'px');
		       if(nextImgRaz){
		       	if(iii < 100){
		       			panoramPos(image);
		       	}else{
		       			galleryNextImage(image);
		       	}
		       }
			   }, 32);
			}
   }

   window.galleryNextImage = function(image){
		   if(nextImgRaz){
				   	//$('#gallery-image').css('background-position','0px 0px');
				   	//iii = 0;
				   	var next_image;
				   	if(naprav){
				   		next_image = image.parent().next().find('img');
				   		if(next_image.attr('class') != 'gallery-item-image' ){
				   			next_image = image.parent().prev().find('img');
				   			naprav = false;
				   		}
				   	}else
				   	{
				   	 	next_image = image.parent().prev().find('img');
				   		if(next_image.attr('class') != 'gallery-item-image' ){
				   			next_image = image.parent().next().find('img');
				   			naprav = true;
				   		}
				   	}/*
				    $('#gallery-image').css('background-image','url('+next_image.attr('src')+')');
				    panoramPos(next_image); */
				    galleryImageHide(next_image);
		    }
   }

   $('.gallery-item-image').click(function () {
   if(nextImgRaz){
   		nextImgRaz = false;
   		//iii = 999;
   		galleryImageHide($(this));
   	}
   });

   window.galleryImageHide = function(image){
			$('#gallery-image').animate({
		    	opacity: 0.25
		  	}, 500, function() {
		  		iii=0;
		  		$('#gallery-image').css('background-position','0px -50px');
		    	$('#gallery-image').css('background-image','url('+image.attr('src')+')');
		    	nextImgRaz = true;
		    	panoramPos(image);
                $('#gallery-image').animate({
				    	opacity: 1
				  	}, 500, function() {
				});
		  	});
  	}

  	/* highlight location button */
});