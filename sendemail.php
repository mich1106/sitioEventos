<?php
include "PHPMailer/class.phpmailer.php";
include "PHPMailer/class.smtp.php";

//Recibir todos los parámetros del formulario
$para = 'contacto@nemsa.com';
$asunto = 'Mensaje enviado desde la web de nemsa.mx';

$name = $_POST['name'];
$correo = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$mensaje = file_get_contents('template.html');
$mensaje = str_replace('%name%', $name, $mensaje);
$mensaje = str_replace('%correo%', $correo, $mensaje);
$mensaje = str_replace('%subject%', $subject, $mensaje);
$mensaje = str_replace('%message%', $message, $mensaje);

//Este bloque es importante
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "";
$mail->Host = "nemsa.mx";
$mail->Port = 25;
//Nuestra cuenta
$mail->Username ='noreply@nemsa.mx';
$mail->Password = 'ejemplo'; //Su password
//Agregar destinatario
$mail->AddAddress($para);
$mail->Subject = $asunto;
$mail->MsgHTML($mensaje);
$mail->IsHTML(true);
$mail->CharSet="utf-8";

//Avisar si fue enviado o no y dirigir al index
//Avisar si fue enviado o no y dirigir al index
if($mail->Send())
{
    $response = ['success' => true, 'message'=>"El correo electrónico fue enviado correctamente"];
    echo json_encode($response);
}
else{
    $response = ['success' => false, 'message'=>"El correo electrónico no fue enviado correctamente"];
    echo json_encode($response);
}
?>