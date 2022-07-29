<?php
include_once '../../config/ConexionDB.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../Libraries/gmail/vendor/autoload.php';
$mail = new PHPMailer(true);

if ($_POST) {
    if ($_POST['email'] == '' || $_POST['email'] == ' ') {
        echo json_encode('error');
    }else{
        $email = $_POST['email'];

        /**Envio de correo cuando el status en solicitada */
        try {
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'preparatoriasno.33@gmail.com';
            $mail->Password = 'imoqwgaobzjvisvp';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('preparatoriasno.33@gmail.com', 'Innovative Transport');
            $mail->addAddress('al222110833@gmail.com');
            // $mail->addCC('copia@gmail.com') para mandar copia de correo

            $email_template = 'email.html';

            $mail->isHTML(true);
            $mail->Subject = 'Seguimiento de Factura';
            $message = file_get_contents($email_template);
            $message = str_replace('%N_Operacion%', $_POST['operacion'], $message);
            $message = str_replace('%cliente%', $row_cliente['nombre'] . ' ' . $row_cliente['apellidos'], $message);
            $message = str_replace('%solicitud%', $solicitada, $message);
            $message = str_replace('%TUsuario%', $row_TUsuario['nombreUsuario'], $message);
            $message = str_replace('%email%', $row_cliente['email'], $message);
            $message = str_replace('%telefono%', $row_cliente['telefono'], $message);
            $message = str_replace('%status%', $statusEmail, $message);

            $mail->MsgHTML($message);
            $mail->send();
            // echo 'correo enviado';
        } catch (Exception $e) {
            echo 'Mensaje ' . $mail->ErrorInfo;
        }

    }
}