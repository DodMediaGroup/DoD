<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

	$msjReturn = array(
		'msj'=> 'Debe completar el campo',
		'status'=> false
	);

	if(isset($_POST['email']) && $_POST['email'] != ""){
		$from = $_POST['email'];
		$fromName = 'Visitante sitio web DOD';
		$subject='=?UTF-8?B?'.base64_encode('Contacto sitio web DOD').'?=';
		$headers="From: ".$fromName." <".$from.">\r\n".
			"Reply-To: ".$from." \r\n".
			"MIME-Version: 1.0\r\n".
			"Content-type: text/html; charset=UTF-8";
		$body = '<table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;background:#9096a5;min-width:620px;table-layout:fixed;">'.
			'<tbody><tr>'.
			'<td align="center" style="padding-right:10px;padding-top:10px;padding-bottom:10px;padding-left:10px;">'.
			'<div style="width:auto;margin-right:auto;margin-left:auto;margin-top:0;margin-bottom:0;color:#000;font-family:Arial;font-size:12px;line-height:150%;">'.
			'<table style="width:100%;border-collapse:separate;table-layout:fixed;" cellspacing="0" cellpadding="0">'.
			'<tbody><tr><td align="center">'.
			'<table width="600" cellspacing="0" cellpadding="0" style="border-collapse:separate;border-spacing:0px;table-layout:fixed;width:600px;background:#2f3546;">'.
			'<tbody><tr>'.
			'<td style="background:#FFFFFF;padding-top:10px;padding-right:35px;padding-bottom:10px;padding-left:35px;" >'.
			'<div style="word-wrap:break-word;line-height:19.600000381469727px;color:#444444;"><br>'.
			'Un visitante del sitio web de DOD Media Group desea obtener mas información de la empresa. A enviado el siguiente correo electrónico:<br>'.
			'<strong>Correo electrónico: </strong>'.$from.'<br><br>'.
			'Enviado desde sitio web DOD Media Group<br><br>'.
			'</div></td></tr>'.
			'<tr><td align="center" style="background-color:#eeeeee; color:#444444; font-size:10px; padding-top:5px; padding-bottom:5px;">Derechos reservados DOD Media Group</td></tr>'.
			'</tbody></table></td></tr></tbody></table></div></td></tr></tbody></table>';

		if(mail('info@dodmediagroup.co',$subject,$body,$headers)){
			$msjReturn = array(
				'msj'=> 'El correo electrónico se envio con exito. Pronto nos comunicaremos contigo',
				'status'=> true
			);
		}
		else{
			$msjReturn['msj'] = 'Ocurrio un erro al enviar el correo electronico. Recuerde que tambien nos puedes escribirnos a: info@dodmediagroup.co';
		}
	}

	echo json_encode($msjReturn);
}
else{
	header("Status: 404 Not Found");
}