jQuery(document).ready(function($) {

			/*
			Equal Height columns
			----------------------------------*/
			equalHeight = function(){
				if ( $(window).width() > 1330) {
					$("#sidebar, #main").css( 'height', 'auto' );
					var container_height = $("#container").innerHeight();
					$("#sidebar, #main").outerHeight( container_height );
				}else{
					$("#sidebar, #main").css( 'height', 'auto' );
				}
			}

			
			//Anomation at load -----------------
			Pace.on('done', function(event) {
				
				$( window ).resize(function() {
					equalHeight();
				});
				equalHeight();
				
			});//Pace



			/*
			Infinite Scroll
			----------------------------------*/
			$( document.body ).on( 'post-load', function () {
		    	equalHeight();
		    } );





			



			$(".ql_scroll_top").click(function() {
			  $("html, body").animate({ scrollTop: 0 }, "slow");
			  return false;
			});

			$("#primary-menu > li > ul > li.dropdown").each(function(index, el) {
				$(el).removeClass('dropdown').addClass('dropdown-submenu');
			});


			
			$('.dropdown-toggle').dropdown();
			$('*[data-toggle="tooltip"]').tooltip();
			

			//Sidebar Menu Function
			$('#sidebar .widget ul:not(.product-categories) li ul').parent().addClass('hasChildren').append("<i class='fa fa-angle-down'></i>");
			var children;
			$("#sidebar .widget ul:not(.product-categories) li").hoverIntent(
				function () {
					children = $(this).children("ul");
					if($(children).length > 0){ $(children).stop(true, true).slideDown('fast'); }
				}, 
				function () {
				  $(this).children('ul').stop(true, true).slideUp(500);
				}
			);
			//Footer Menu Function
			$('footer .widget ul:not(.product-categories) li ul').parent().addClass('hasChildren').append("<i class='fa fa-angle-down'></i>");
			var children;
			$("footer .widget ul:not(.product-categories) li").hoverIntent(
				function () {
					children = $(this).children("ul");
					if($(children).length > 0){ $(children).stop(true, true).slideDown('fast'); }
				}, 
				function () {
				  $(this).children('ul').stop(true, true).slideUp(500);
				}
			);	

});