jQuery(document).ready(function($) {
	$('#contact_mail').on('submit', function(event) {
		event.preventDefault();

		$email = $.trim($('#email_form').val());
		if($email != ""){
			$('.div-loading').addClass('active');
			$.ajax($(this).attr('action'), {
	            data: $(this).serialize(),
	            dataType: 'json',
	            type: 'POST',
	            success: function(data){
                    $('.div-loading').removeClass('active');
                    $('#email_form').val('');
                    $.loadMessage(data.status, data.msj);
	            },
	            error: function(xhr, textStatus, error){
	                $.loadMessage('Error', 'Error contactando con el servidor, intenta nuevamente.');
	                $('.div-loading').removeClass('active');
	            }
	        });
		}
	});
});

$.loadMessage = function(status, msj){
	var divMsj = $('<div>', {
		class: 'div-message',
		text: msj
	});

	$('body').append(divMsj);

	divMsj.addClass('active')

	setTimeout(function(){
        divMsj.remove();
    }, 8000);
}