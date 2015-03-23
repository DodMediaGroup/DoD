var urlSend = 'send.php';

$(document).on('ready', function() {
	$.heightHeader();

	$('#form-contact input, #form-contact textarea').on('focus', function(event) {
		event.preventDefault();

		$(this).removeClass('error');
	});

	$('.form-header').on('submit', function(event) {
		event.preventDefault();

		$('#contact-email').val($(this).find('input').val());
		$('#contact-name').focus();

		$('html, body').animate({
	        scrollTop: $(document).height()
	    }, 'slow');
	});

	$('#form-contact').on('submit', function(event) {
		event.preventDefault();

		var name = $.trim($('#contact-name').val());
		var email = $.trim($('#contact-email').val());
		var message = $.trim($('#contact-message').val());
		var error = false;

		if(name == ''){
			$('#contact-name').addClass('error');
			error = true;
		}
		if(email == ''){
			$('#contact-email').addClass('error');
			error = true;
		}
		if(message == ''){
			$('#contact-message').addClass('error');
			error = true;
		}

		if(!error){
			var loading = $.loading();
			$.ajax({
		        data: {
		            'name': name,
		            'email': email,
		            'message': message,
		        },
		        dataType: "json",
		        type: 'POST',
		        url: urlSend,
		        success: function(data){
		            loading.remove();
		            if(data.status == true)
		            	$.showMessage('success', data.message);
		            else
		            	$.showMessage('error', data.message);
		            $.clearAll();
		        },
		        error: function(xhr, textStatus, error){
		            loading.remove();
		            $.showMessage('error', 'Ocurrio un error en la conexión con el servidor. Intente mas tarde.');
		            $.clearAll();
		        }
		    });
		}
	});
});

$.heightHeader = function(){
	var heightWindow = $(window).outerHeight();

	$('.header').css({
		height: heightWindow,
	});
};
$.clearAll = function(){
	$('input, textarea').val('');
}
$.loading = function(){
	var loading = $('<div>',{
		class: 'loading'
	});
	$('body').append(loading);

	return loading;
}
$.showMessage = function(type, message){
	var alert = $('<div>',{
		class: 'notification '+type,
		text: message,
	});
	
	$('body').append(alert);

	setTimeout(function() {
        alert.remove();
    }, 8000);
}