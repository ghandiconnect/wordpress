'use strict';
(function (api, $) {
	api.bind('preview-ready', function () {
		var d = document;
		var w = window;
		var gid = document.getElementById.bind(document);

		function affix(el) {
			var affix = el.offsetTop + 200;
			w.onscroll = function (e) {
				if (w.pageYOffset >= affix) {
					el.classList.add('affix');
				} else {
					el.classList.remove('affix');
				}
				if (w.pageYOffset == 0) {
					el.classList.remove('affix');
				}
				if (this.oldScroll > this.scrollY) {
					el.classList.add('scrolling-up');
					el.classList.remove('scrolling-down');
				} else {
					el.classList.remove('scrolling-up');
					el.classList.add('scrolling-down');
				}
				this.oldScroll = this.scrollY;
			}
		}

		api.selectiveRefresh.bind('partial-content-rendered', function (placement) {
			switch (placement.partial.params.selector) {
				//totop
				case '#to-top-wrap':
					var toTop = gid('to-top');
					if (toTop) {
						toTop.addEventListener('click', function (e) {
							e.preventDefault();
							w.scroll({ top: 0, left: 0, behavior: 'smooth' });
						});
						w.addEventListener('scroll', function (e) {
							if (w.pageYOffset > 60) {
								toTop.classList.add('visible');
							} else {
								toTop.classList.remove('visible');
							}
						});
						w.dispatchEvent(new Event('scroll'));
					}
					break;

				//header
				case '#top-wrap':
					var headerWrap = gid('header-affix-wrap');
					if (headerWrap) {
						var header = gid('header');
						affix(header);
					}
					w.dispatchEvent(new Event('scroll'));

					if ($().superfish) {
						$('ul.sf-menu-side').superfish({
							popUpSelector: 'ul:not(.mega-menu ul), .mega-menu ',
							delay: 500,
							animation: { opacity: 'show', height: 100 + '%' },
							animationOut: { opacity: 'hide', height: 0 },
							speed: 400,
							speedOut: 300,
							disableHI: false,
							cssArrows: true,
							autoArrows: true
						});
					}

					//////////////
					//flexslider//
					//////////////
					if ($().flexslider) {
						var $introSlider = $(".page_slider .flexslider");
						$introSlider.each(function (index) {
							var $currentSlider = $(this);
							var data = $currentSlider.data();
							var nav = (data.nav !== 'undefined') ? data.nav : true;
							var dots = (data.dots !== 'undefined') ? data.dots : true;
							var slideshow = (data.slideshow !== 'undefined') ? data.slideshow : true;
							var speed = (data.speed !== 'undefined') ? data.speed : 5000;
							var animation = (data.animation !== 'undefined') ? data.animation : 'slide';

							$currentSlider.flexslider({
								animation: animation,
								pauseOnHover: true,
								useCSS: true,
								controlNav: dots,
								directionNav: nav,
								prevText: "",
								nextText: "",
								smoothHeight: false,
								slideshow: slideshow,
								slideshowSpeed: speed,
								animationSpeed: 600,
							})
							//wrapping nav with container - uncomment if need

						}); //.page_slider flex slider

						$(".flexslider").each(function (index) {
							var $currentSlider = $(this);
							//exit if intro slider already activated
							if ($currentSlider.find('.flex-active-slide').length) {
								return;
							}
							$currentSlider.flexslider({
								animation: "slide",
								useCSS: true,
								controlNav: true,
								directionNav: true,
								prevText: "<",
								nextText: ">",
								smoothHeight: false,
								slideshow: true,
								slideshowSpeed: 5000,
								animationSpeed: 800,
							})
						});

						// tiny helper function to add breakpoints
						function getGridSize() {
							return (window.innerWidth < 600) ? 1 :
								(window.innerWidth < 900) ? 2 : 2;
						}

						$(".flexslider-products").each(function (index) {
							var $currentSlider = $(this);
							//exit if intro slider already activated
							if ($currentSlider.find('.flex-active-slide').length) {
								return;
							}
							$currentSlider.flexslider({
								animation: "slide",
								useCSS: true,
								controlNav: true,
								directionNav: false,
								prevText: "<",
								nextText: ">",
								smoothHeight: false,
								slideshow: true,
								slideshowSpeed: 5000,
								animationSpeed: 800,
								animationLoop: true,
								itemWidth: 370,
								itemMargin: 30,
								minItems: getGridSize(),
								maxItems: getGridSize()
							})
						});
					}

					//side header processing
					var $sideHeader = $('.page_header_side');

					if ($sideHeader.length) {
						var $body = $('#body');
						$('.toggle_menu_side').on('click', function () {
							var $thisToggler = $(this);
							if ($thisToggler.hasClass('header-slide')) {
								$sideHeader.toggleClass('active-slide-side-header');
							} else {
								if ($thisToggler.parent().hasClass('header_side_right')) {
									$body.toggleClass('active-side-header slide-right');
								} else {
									$body.toggleClass('active-side-header');
								}
							}
						});

						//hidding side header on click outside header
						$body.on('mousedown touchstart', function (e) {
							if (!($(e.target).closest('.page_header_side').length)) {
								$sideHeader.removeClass('active-slide-side-header');
								$body.removeClass('active-side-header slide-right');
								var $toggler = $('.toggle_menu_side');
								if (($toggler).hasClass('active')) {
									$toggler.removeClass('active');
								}
							}
						});

					} //sideHeader check

					$('.header-special .close-wrapper a').on('click', function () {
						$(this).closest('.header-special').removeClass('active-slide-side-header');
						$('#body').removeClass('active-side-header slide-right');
					});

					// toggle sub-menus visibility on menu-side-click
					$('ul.menu-side-click').find('li').each(function () {
						var $thisLi = $(this);
						//toggle submenu only for menu items with submenu
						if ($thisLi.find('ul').length) {
							$thisLi
								.append('<span class="activate_submenu"></span>')
								//adding anchor
								.find('.activate_submenu, > a')
								.on('click', function (e) {
									var $thisSpanOrA = $(this);
									//if this is a link and it is already opened - going to link
									if (($thisSpanOrA.attr('href') === '#') || !($thisSpanOrA.parent().hasClass('active-submenu'))) {
										e.preventDefault();
									}
									if ($thisSpanOrA.parent().hasClass('active-submenu')) {
										//e.preventDefault();
										$thisSpanOrA.parent().removeClass('active-submenu');
										return;
									}
									$thisLi.addClass('active-submenu').siblings().removeClass('active-submenu');
								});
						} //eof sumbenu check
					});

					//side special header processing 
					var $sideHeaderSpecial = $('.page_header_side_special');

					if ($sideHeaderSpecial.length) {
						var $body = $('#body');
						$('.toggle_menu_side_special').on('click', function () {
							if ($(this).hasClass('header-slide')) {
								$sideHeaderSpecial.toggleClass('active-slide-side-header-special');
							} else {
								if ($(this).parent().hasClass('header_side_right')) {
									$body.toggleClass('active-side-header slide-right');
								} else {
									$body.toggleClass('active-side-header');
								}
							}
						});
					} //sideHeader check

					$('.header .top-nav ul.sub-menu ul.sub-menu').wrap("<div class='menu-padding-wrap'>");
					break;

				//preloader
				case '#preloader-wrap':
					var preloader = gid('preloader');
					if (preloader) {
						setTimeout(function () {
							preloader.classList.add('loaded');
						}, 1500);
					}
					break;

				//init masonry
				case '#layout':

					// init masonry
					if (typeof (Masonry) !== 'undefined' && typeof (imagesLoaded) !== 'undefined') {
						var grids = d.querySelectorAll('.masonry');
						if (grids.length) {
							var i;
							for (i = 0; i < grids.length; i++) {
								imagesLoaded(grids[i], function (el) {
									new Masonry(el.elements[0], {
										"itemSelector": ".grid-item",
										"columnWidth": ".grid-sizer",
										"percentPosition": true
									});
								});
							}
						}
					}
					var $teaser = $(".bg_teaser");
					var imagePath = $teaser.find("img").first().attr("src");
					if (imagePath) {
						$teaser.css("background-image", "url(" + imagePath + ")");
					}
					if (!$teaser.find('.bg_overlay').length) {
						$teaser.prepend('<div class="bg_overlay"/>');
					}
					break;


				//head (fonts)
				case 'head':
					jQuery('body').animate({ opacity: 1 }, 2500);
					break;
			}
		}); //partial-content-rendered

		//sidebar positions
		function setSidebarProcessor(controlId, view) {
			api(controlId, function (control) {
				control.bind(function (value) {
					if (view === w.iqconnetikPreviewObject.viewGlobal) {
						d.body.classList.remove('with-sidebar', 'sidebar-left');
						//left
						//right
						//no
						switch (value) {
							case 'left':
								d.body.classList.add('with-sidebar', 'sidebar-left');
								break;
							case 'right':
								d.body.classList.add('with-sidebar');
								break;
						}
						//set body classes
					}
				});
			});
		}
		var sidebars = [
			{ controlId: 'blog_single_sidebar_position', view: 'post' },
			{ controlId: 'blog_sidebar_position', view: 'archive' },
			{ controlId: 'search_sidebar_position', view: 'search' },
			{ controlId: 'shop_sidebar_position', view: 'shop' },
			{ controlId: 'product_sidebar_position', view: 'product' },
			{ controlId: 'bbpress_sidebar_position', view: 'bbpress' },
			{ controlId: 'buddypress_sidebar_position', view: 'buddypress' },
			{ controlId: 'events_sidebar_position', view: 'events' },
			{ controlId: 'event_sidebar_position', view: 'event' },
			{ controlId: 'wpjm_sidebar_position', view: 'wpjm' }
		];
		sidebars.forEach(function (obj, i) {
			setSidebarProcessor(obj.controlId, obj.view);
		});
	});
})(wp.customize, jQuery);
