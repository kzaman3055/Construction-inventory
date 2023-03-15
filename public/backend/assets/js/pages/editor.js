//[editor Javascript]

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


//Add text editor
    $(function () {
    "use strict";

    // Replace the <textarea id="editor1"> with a CKEditor
	// instance, using default configuration.
	CKEDITOR.replace('editor1')
	//bootstrap WYSIHTML5 - text editor
	$('.textarea').wysihtml5();

  });

