<?php
	
	$emailContacto = 'info@dodmediagroup.co';

	/***** FUNCTIONS YII FRAMEWORK *****/
	function getIsAjaxRequest(){
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']==='XMLHttpRequest';
	}
	/***** END FUNCTIONS YII FRAMEWORK *****/

	if(getIsAjaxRequest()){
		$response = array(
			'status'=>false,
			'message'=>''
		);
		$error = false;

		if(!(isset($_POST['name']) && trim($_POST['name']) != "")){
			$response['message'] = 'Debe completar el campo nombre.';
			$error = true;
		}
		else if(!(isset($_POST['email']) && trim($_POST['email']) != "")){
			$response['message'] = 'Debe completar el campo correo electrónico.';
			$error = true;
		}
		else if(!(isset($_POST['message']) && trim($_POST['message']) != "")){
			$response['message'] = 'No nos has contado que necesitas. Por favor completa el campo mensaje!!!';
			$error = true;
		}

		if(!$error){
			$fromName = $_POST['name'];
			$from = $_POST['email'];
			$content = $_POST['message'];

			$subject='=?UTF-8?B?'.base64_encode('Mensaje Web Site DOD Media Group').'?=';

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
				'<div style="word-wrap:break-word;line-height:19.600000381469727px;color:#444444;">'.
				'<strong>Nombre: </strong>'.$fromName.'<br>'.
				'<strong>Correo electrónico: </strong>'.$from.'<br><br>'.
				$content.'<br><br><br>'.
				'Enviado desde formulario contacto Web Site DOD Media Group<br><br>'.
				'</div></td></tr>'.
				'<tr><td align="center" style="background-color:#eeeeee; color:#444444; font-size:10px; padding-top:5px; padding-bottom:5px;">Derechos reservados DOD Media Group</td></tr>'.
				'</tbody></table></td></tr></tbody></table></div></td></tr></tbody></table>';

			mail($emailContacto,$subject,$body,$headers);

			$response = array(
				'status'=>true,
				'message'=>'Su mensaje se envio con exito. Trataremos de responder en el menor tiempo posible.'
			);
		}
		echo json_encode($response);
	}
	else{
		header("Location: index.html"); // Redirecionamos a Google
		exit();
	}
?>