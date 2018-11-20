		$(function () {
			'use strict'
			$('#icon_menu').on('click', function (e) {
				$('#aside').css('left', '0px');
				$('#overlay_main').css('display', 'block');
			});
			$('#overlay_main').on('click', function (e) {
				$('#aside').css('left', '-250px');
				$('#overlay_main').css('display', 'none');
			});
			$('#right_side').on('click', function (e) {
				$('#right-side-bar').css('right', '0px');
				$('#overlay_main').css('display', 'block');
			});
			$('#overlay_main').on('click', function (e) {
				$('#right-side-bar').css('right', '-250px');
				$('#overlay_main').css('display', 'none');
			});

		});