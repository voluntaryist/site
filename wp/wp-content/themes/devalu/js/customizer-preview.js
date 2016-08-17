/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Logo
	wp.customize( 'impronta_logo', function( value ) {
		value.bind( function( to ) {
			if ( to != "" ) {
				var logo = '<img src="' + to + '" />';
				$( '.logo_container .ql_logo' ).html( logo );		
			}else{
				$( '.logo_container .ql_logo' ).text( wp_customizer.site_name );
			}
		} );
	} );
	
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description, #jqueryslidemenu a' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );


	

	/*
    Colors
    =====================================================
    */
		//Featured Color
		wp.customize( 'impronta_hero_color', function( value ) {
			value.bind( function( to ) {
				$( '.btn-ql, .pagination li.active a, .pagination li.active a:hover, .wpb_wrapper .products .product-category h3, .btn-ql:active, .btn-ql.alternative:hover, .btn-ql.alternative-white:hover, .btn-ql.alternative-gray:hover, .hero_bck, .ql_nav_btn:hover, .ql_nav_btn:active, .cd-popular .cd-select, .no-touch .cd-popular .cd-select:hover, .pace .pace-progress' ).css( {
						'background-color': to
				} );
				$( '.btn-ql, .pagination li.active a, .pagination li.active a:hover, .btn-ql:active, .btn-ql.alternative, .btn-ql.alternative:hover, .btn-ql.alternative-white:hover, .btn-ql.alternative-gray:hover, .hero_border, .pace .pace-activity' ).css( {
						'border-color': to 
				} );
				$( '.pagination .current, .pagination a:hover, .widget_recent_posts ul li h6 a, .widget_popular_posts ul li h6 a, .read-more, .read-more i, .btn-ql.alternative, .hero_color, .cd-popular .cd-pricing-header, .cd-popular .cd-currency, .cd-popular .cd-duration, #sidebar .widget ul li > a:hover, #sidebar .widget_recent_comments ul li a:hover' ).css( {
						'color': to
				} );
			} );
		} );

		//Text Color
		wp.customize( 'impronta_text_color', function( value ) {
			value.bind( function( to ) {
				$( 'body' ).css( {
						'color': to
				} );
			} );
		} );
		//Link Color
		wp.customize( 'impronta_link_color', function( value ) {
			value.bind( function( to ) {
				$( '#main a' ).css( {
						'color': to
				} );
			} );
		} );
		//Headings Color
		wp.customize( 'impronta_headings_color', function( value ) {
			value.bind( function( to ) {
				$( 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6' ).css( {
						'color': to
				} );
			} );
		} );


	/*
    Front Page Sections
    =====================================================
    */

    	/*
    	Welcome
    	------------------------------ */
    	//Welcome Message
		wp.customize( 'impronta_welcome_title', function( value ) {
			value.bind( function( to ) {
				$( '.welcome-intro .intro-line' ).text( to );
			} );
		} );
		//Link Title
		wp.customize( 'impronta_welcome_link_title', function( value ) {
			value.bind( function( to ) {
				$( '.welcome-section .btn-ql' ).text( to );
			} );
		} );
		//Link URL
		wp.customize( 'impronta_welcome_link_url', function( value ) {
			value.bind( function( to ) {
				$( '.welcome-section .btn-ql' ).attr( 'href', to );
			} );
		} );
		//Background Image
		wp.customize( 'impronta_welcome_image', function( value ) {
			value.bind( function( to ) {
				if ( to != "" ) {
					$( '.welcome-section img' ).attr( 'src',  to );		
				}else{
					$( '.welcome-section img' ).attr( 'src', wp_customizer.theme_url + "/images/peaks.jpg)" );
				}
			} );
		} );
		//Enable/Disable Section
		wp.customize( 'impronta_welcome_enable', function( value ) {
			value.bind( function( to ) {
				if ( to == true ) {
					$( '.welcome-section' ).show();	
				}else{
					$( '.welcome-section' ).hide();
				}
			} );
		} );

		/*
    	Services
    	------------------------------ */
    	//Enable/Disable Section
		wp.customize( 'impronta_services_enable', function( value ) {
			value.bind( function( to ) {
				if ( to == true ) {
					$( '.services-section' ).show();	
				}else{
					$( '.services-section' ).hide();
				}
			} );
		} );

    	/*
    	Quote
    	------------------------------ */
    	//Quote
		wp.customize( 'impronta_quote', function( value ) {
			value.bind( function( to ) {
				$( '.quote-section .quote-wrap blockquote' ).text( to );
			} );
		} );
		//Quote Author
		wp.customize( 'impronta_quote_cite', function( value ) {
			value.bind( function( to ) {
				$( '.quote-section .quote-cite' ).html( to );
			} );
		} );
		//Quote Image
		wp.customize( 'impronta_quote_image', function( value ) {
			value.bind( function( to ) {
				if ( to != "") {
					$.ajax({
						url: wp_customizer.ajax_url,
						type : 'post',
						data : {
							action : 'impronta_get_image_src',
							image_id : to
						},
						success: function( data ) {
							$( '.quote-section .quote-screen' ).attr( 'src', data );
						}
					});//ajax		
				}else{
					$( '.quote-section .quote-screen' ).attr( 'src', wp_customizer.theme_url + "/images/screen.jpg" );
				}
						
			} );
		} );
		//Background Color
		wp.customize( 'impronta_quote_bck_color', function( value ) {
			value.bind( function( to ) {
				$( '.quote-background' ).css( 'background-color', to );
			} );
		} );
		//Enable/Disable Section
		wp.customize( 'impronta_quote_enable', function( value ) {
			value.bind( function( to ) {
				if ( to == true ) {
					$( '.quote-section' ).show();	
				}else{
					$( '.quote-section' ).hide();
				}
			} );
		} );

		/*
    	Video
    	------------------------------ */
    	//Title
		wp.customize( 'impronta_video_title', function( value ) {
			value.bind( function( to ) {
				$( '.video-section .video-text-wrap .video-text-title' ).text( to );
			} );
		} );
		//Text
		wp.customize( 'impronta_video_text', function( value ) {
			value.bind( function( to ) {
				$( '.video-section .video-text-wrap p' ).html( to );
			} );
		} );
		//Link Title
		wp.customize( 'impronta_video_link_title', function( value ) {
			value.bind( function( to ) {
				$( '.video-section .btn-ql' ).text( to );
			} );
		} );
		//Link URL
		wp.customize( 'impronta_video_link_url', function( value ) {
			value.bind( function( to ) {
				$( '.video-section .btn-ql' ).attr( 'href', to );
			} );
		} );
		//Enable/Disable Section
		wp.customize( 'impronta_video_enable', function( value ) {
			value.bind( function( to ) {
				if ( to == true ) {
					$( '.video-section' ).show();	
				}else{
					$( '.video-section' ).hide();
				}
			} );
		} );

		/*
    	Testimonials
    	------------------------------ */
    	//Background Image
		wp.customize( 'impronta_testimonial_image', function( value ) {
			value.bind( function( to ) {
				if ( to != "" ) {
					$( '.testimonials-section' ).css( 'background-image', 'url(' + to + ')' );		
				}else{
					$( '.testimonials-section' ).css( 'background-image', 'url(' + wp_customizer.theme_url + "/images/img.jpg)" );
				}
			} );
		} );
		//Enable/Disable Section
		wp.customize( 'impronta_testimonial_enable', function( value ) {
			value.bind( function( to ) {
				if ( to == true ) {
					$( '.testimonials-section' ).show();	
				}else{
					$( '.testimonials-section' ).hide();
				}
			} );
		} );

		/*
    	Image
    	------------------------------ */
    	//Featured Image
		wp.customize( 'impronta_image_image', function( value ) {
			value.bind( function( to ) {
				if ( to != "" ) {
					$( '.image-section .image-wrap' ).css( 'background-image', 'url(' + to + ')' );		
				}else{
					$( '.image-section .image-wrap' ).css( 'background-image', 'url(' + wp_customizer.theme_url + "/images/img2.jpg)" );
				}
			} );
		} );
    	//Title
		wp.customize( 'impronta_image_title', function( value ) {
			value.bind( function( to ) {
				$( '.image-section .image-text .image-text-title' ).text( to );
			} );
		} );
		//Text
		wp.customize( 'impronta_image_text', function( value ) {
			value.bind( function( to ) {
				$( '.image-section .image-text p' ).html( to.replace(/\n\r?/g, '<br />') );
			} );
		} );
		//Link Title
		wp.customize( 'impronta_image_link_title', function( value ) {
			value.bind( function( to ) {
				$( '.image-section .btn-ql' ).text( to );
			} );
		} );
		//Link URL
		wp.customize( 'impronta_image_link_url', function( value ) {
			value.bind( function( to ) {
				$( '.image-section .btn-ql' ).attr( 'href', to );
			} );
		} );
		//Enable/Disable Section
		wp.customize( 'impronta_image_enable', function( value ) {
			value.bind( function( to ) {
				if ( to == true ) {
					$( '.image-section' ).show();	
				}else{
					$( '.image-section' ).hide();
				}
			} );
		} );

		/*
    	Team
    	------------------------------ */
    	//Title
		wp.customize( 'impronta_team_title', function( value ) {
			value.bind( function( to ) {
				$( '.team-section .section-title' ).text( to );
			} );
		} );
		//Enable/Disable Section
		wp.customize( 'impronta_team_enable', function( value ) {
			value.bind( function( to ) {
				if ( to == true ) {
					$( '.team-section' ).show();	
				}else{
					$( '.team-section' ).hide();
				}
			} );
		} );

		/*
    	Phone
    	------------------------------ */
    	//Phone Image
		wp.customize( 'impronta_phone_image', function( value ) {
			value.bind( function( to ) {
				if ( to != "" ) {
					$.ajax({
						url: wp_customizer.ajax_url,
						type : 'post',
						data : {
							action : 'impronta_get_image_src',
							image_id : to
						},
						success: function( data ) {
							$( '.phone-section .phone-screen' ).attr( 'src', data );
						}
					});//ajax		
				}else{
					$( '.phone-section .phone-screen' ).attr( 'src', wp_customizer.theme_url + "/images/phone-screen.jpg" );
				}
						
			} );
		} );
		//Link Title
		wp.customize( 'impronta_phone_link_title', function( value ) {
			value.bind( function( to ) {
				$( '.phone-section .btn-ql' ).text( to );
			} );
		} );
		//Link URL
		wp.customize( 'impronta_phone_link_url', function( value ) {
			value.bind( function( to ) {
				$( '.phone-section .btn-ql' ).attr( 'href', to );
			} );
		} );
		//Background Color
		wp.customize( 'impronta_phone_bck_color', function( value ) {
			value.bind( function( to ) {
				$( '.phone-section' ).css( 'background-color', to );
			} );
		} );
		//Phone Color
		wp.customize( 'impronta_phone_color', function( value ) {
			value.bind( function( to ) {
				if ( to == "gray" ) {
					$( '.phone-section .phone-mockup' ).attr( 'src', wp_customizer.theme_url + "/images/iphone-gray.png" );
				}else if ( to == "gold" ) {
					$( '.phone-section .phone-mockup' ).attr( 'src', wp_customizer.theme_url + "/images/iphone-gold.png" );
				}else{
					$( '.phone-section .phone-mockup' ).attr( 'src', wp_customizer.theme_url + "/images/iphone-black.png" );
				}
			} );
		} );
		//Enable/Disable Section
		wp.customize( 'impronta_phone_enable', function( value ) {
			value.bind( function( to ) {
				if ( to == true ) {
					$( '.phone-section' ).show();	
				}else{
					$( '.phone-section' ).hide();
				}
			} );
		} );

		/*
    	Tagline
    	------------------------------ */
    	//Title
		wp.customize( 'impronta_tagline_text', function( value ) {
			value.bind( function( to ) {
				$( '.tagline-section .tagline' ).text( to );
			} );
		} );
		//Sub-text
		wp.customize( 'impronta_tagline_sub_text', function( value ) {
			value.bind( function( to ) {
				$( '.tagline-section span' ).text( to );
			} );
		} );
		//Link URL
		wp.customize( 'impronta_tagline_link_url', function( value ) {
			value.bind( function( to ) {
				$( '.tagline-section a' ).attr( 'href', to );
			} );
		} );
		//Background Color
		wp.customize( 'impronta_tagline_bck_color', function( value ) {
			value.bind( function( to ) {
				$( '.tagline-section' ).css( 'background-color', to );
			} );
		} );
		//Enable/Disable Section
		wp.customize( 'impronta_tagline_enable', function( value ) {
			value.bind( function( to ) {
				if ( to == true ) {
					$( '.tagline-section' ).show();	
				}else{
					$( '.tagline-section' ).hide();
				}
			} );
		} );

		/*
    	Clients
    	------------------------------ */
    	//Title
		wp.customize( 'impronta_clients_title', function( value ) {
			value.bind( function( to ) {
				$( '.clients-section .section-title' ).text( to );
			} );
		} );
		//Enable/Disable Section
		wp.customize( 'impronta_clients_enable', function( value ) {
			value.bind( function( to ) {
				if ( to == true ) {
					$( '.clients-section' ).show();	
				}else{
					$( '.clients-section' ).hide();
				}
			} );
		} );

		/*
    	Map
    	------------------------------ */
    	//Title
		wp.customize( 'impronta_map_title', function( value ) {
			value.bind( function( to ) {
				$( '.map-section .section-title' ).text( to );
			} );
		} );
		//Text
		wp.customize( 'impronta_map_text', function( value ) {
			value.bind( function( to ) {
				$( '.map-section .map-text' ).html( to.replace(/\n\r?/g, '<br />') );
			} );
		} );
		//Enable/Disable Section
		wp.customize( 'impronta_map_enable', function( value ) {
			value.bind( function( to ) {
				if ( to == true ) {
					$( '.map-section' ).show();	
				}else{
					$( '.map-section' ).hide();
				}
			} );
		} );

		/*
    	Pricing
    	------------------------------ */
    	//Title
		wp.customize( 'impronta_pricing_title', function( value ) {
			value.bind( function( to ) {
				$( '.pricing-section .section-title' ).text( to );
			} );
		} );
		//Enable/Disable Section
		wp.customize( 'impronta_pricing_enable', function( value ) {
			value.bind( function( to ) {
				if ( to == true ) {
					$( '.pricing-section' ).show();	
				}else{
					$( '.pricing-section' ).hide();
				}
			} );
		} );

		/*
    	Portfolio
    	------------------------------ */
    	//Title
		wp.customize( 'impronta_portfolio_title', function( value ) {
			value.bind( function( to ) {
				$( '.portfolio-section .section-title' ).text( to );
			} );
		} );
		//Enable/Disable Section
		wp.customize( 'impronta_portfolio_enable', function( value ) {
			value.bind( function( to ) {
				if ( to == true ) {
					$( '.portfolio-section' ).show();	
				}else{
					$( '.portfolio-section' ).hide();
				}
			} );
		} );

		/*
    	Blog
    	------------------------------ */
    	//Title
		wp.customize( 'impronta_blog_title', function( value ) {
			value.bind( function( to ) {
				$( '.blog-section .section-title' ).text( to );
			} );
		} );
		//Enable/Disable Section
		wp.customize( 'impronta_blog_enable', function( value ) {
			value.bind( function( to ) {
				if ( to == true ) {
					$( '.blog-section' ).show();	
				}else{
					$( '.blog-section' ).hide();
				}
			} );
		} );



} )( jQuery );
