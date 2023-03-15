//[app contact Javascript]

/**
 * Developer Information:
 *
 * Name: Kamruzzaman Polash
 * Email: kzaman3055@gmail.com
 *
 * Company Information:
 *
 * Name: The Riser IT
 * Email: info@theriserit.com
 * Phone: +880 1701 621575
 * Address: H#16, R# 22, Sector# 14, Uttara, Dhaka 1230, Bangladesh
 *
 * © 2023 The Riser IT. All rights reserved.
 */

$(function () {
    "use strict";


		//Enable iCheck plugin for checkboxes
		//iCheck for checkbox and radio inputs
		$('.media-list input[type="checkbox"]').iCheck({
		  checkboxClass: 'icheckbox_flat-blue',
		  radioClass: 'iradio_flat-blue'
		});

		//Enable check and uncheck all functionality
		$(".checkbox-toggle").click(function () {
		  var clicks = $(this).data('clicks');
		  if (clicks) {
			//Uncheck all checkboxes
			$(".media-list input[type='checkbox']").iCheck("uncheck");
			$(".ion", this).removeClass("ion-android-checkbox-outline").addClass('ion-android-checkbox-outline-blank');
		  } else {
			//Check all checkboxes
			$(".media-list input[type='checkbox']").iCheck("check");
			$(".ion", this).removeClass("ion-android-checkbox-outline-blank").addClass('ion-android-checkbox-outline');
		  }
		  $(this).data("clicks", !clicks);
		});

		//Handle starring for glyphicon and font awesome
		$(".app-contact-star").click(function (e) {
		  e.preventDefault();
		  //detect type
		  var $this = $(this).find("a > i");
		  var glyph = $this.hasClass("glyphicon");
		  var fa = $this.hasClass("fa");

		  //Switch states
		  if (glyph) {
			$this.toggleClass("glyphicon-star");
			$this.toggleClass("glyphicon-star-empty");
		  }

		  if (fa) {
			$this.toggleClass("fa-star");
			$this.toggleClass("fa-star-o");
		  }
		});

  }); // End of use strict