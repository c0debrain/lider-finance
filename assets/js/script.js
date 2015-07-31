//
//	jQuery Validate example script
//
//	Prepared by David Cochran
//
//	Free for your use -- No warranties, no guarantees!
//

$(document).ready(function(){

	// Validate
	// http://bassistance.de/jquery-plugins/jquery-plugin-validation/
	// http://docs.jquery.com/Plugins/Validation/
	// http://docs.jquery.com/Plugins/Validation/validate#toptions

		$('#MyForm').validate({
	    rules: {
	      firstname: {
	        minlength: 3,
	        required: true
	      },
	      lastname: {
	        minlength: 3,
	        required: true
	      },
	      email: {
	        required: true,
	        email: true
	      },
	      pr: {
	      	minlength: 2,
	        required: true
	      },
	      answer: {
	      	minlength: 2,
	        required: true
	      },
	      secret: {
	        required: true
	      },
	      accept: {
	        required: true
	      },
	      phone: {
	      	 minlength: 3,
	      	 required: true,
			 number: true
	      },
	      country: {
	        minlength: 2,
	        required: true
	      }
	    },
			highlight: function(element) {
				$(element).closest('.control-group').removeClass('success').addClass('error');
			},
			success: function(element) {
				element
				.text('OK!').addClass('valid')
				.closest('.control-group').removeClass('error').addClass('success');
			}
	  });

}); // end document.ready