<?php

require '../../config/ConexionDB.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../Libraries/gmail/vendor/autoload.php';
$mail = new PHPMailer(true);

if ($_POST) {
    if ($_POST['status'] == '' || $_POST['status'] == ' ') {
        echo json_encode('error');
    } elseif ($_POST['operacion'] == '' || $_POST['operacion'] == ' ') {
    } else {
        if ($_POST['status'] == 1) {
            /** La factura fue solicitada*/
            $queryTickets = "SELECT * FROM tickets WHERE N_Operacion =" . $_POST['operacion'];
            $tickets = mysqli_query($conexion, $queryTickets);
            $row_tickets = mysqli_fetch_assoc($tickets);

            $queryfacturas = "SELECT * FROM facturas WHERE idCliente =" . $row_tickets['idCliente'];
            $facturas = mysqli_query($conexion, $queryfacturas);
            $row_facturas = mysqli_fetch_assoc($facturas);

            $queryCliente = "SELECT * FROM cliente WHERE idCliente = " . $row_tickets['idCliente'];
            $cliente = mysqli_query($conexion, $queryCliente);
            $row_cliente = mysqli_fetch_assoc($cliente);

            $queryTUsuario = "SELECT * FROM tipousuario WHERE idTUsuario = " . $row_cliente['idTUsuario'];
            $TUsuario = mysqli_query($conexion, $queryTUsuario);
            $row_TUsuario = mysqli_fetch_assoc($TUsuario);

            $idCliente = $row_facturas['idCliente'];
            $Producto = $row_facturas['Producto'];
            $costo = $row_facturas['costo'];
            $solicitada = $row_facturas['fechaC'];
            $idTicket = $row_facturas['idTicket'];
            $status = $_POST['status'];

            $updateFactura = "UPDATE `facturas` SET `idCliente`='$idCliente',`Producto`='$Producto',`costo`='$costo',`fechaC`='$solicitada',`idTicket`='$idTicket',`status`='$status',`dateProceso`=NULL,`dateAprobada`=NULL,`dateRechazada`=NULL WHERE idTicket =" . $row_facturas['idTicket'];
            $ticket = mysqli_query($conexion, $updateFactura);


            if ($status == 1) {
                $statusEmail = 'Solicitada';
            } elseif ($status == 2) {
                $statusEmail = 'En proceso...';
            } elseif ($status == 3) {
                $statusEmail = 'Aprobada';
            } elseif ($status == 4) {
                $statusEmail = 'Rechazada';
            }
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
        } elseif ($_POST['status'] == 2) {
            /** La factura se encuentra en proceso*/
            $queryTickets = "SELECT * FROM tickets WHERE N_Operacion =" . $_POST['operacion'];
            $tickets = mysqli_query($conexion, $queryTickets);
            $row_tickets = mysqli_fetch_assoc($tickets);

            $queryfacturas = "SELECT * FROM facturas WHERE idCliente =" . $row_tickets['idCliente'];
            $facturas = mysqli_query($conexion, $queryfacturas);
            $row_facturas = mysqli_fetch_assoc($facturas);

            $queryCliente = "SELECT * FROM cliente WHERE idCliente = " . $row_tickets['idCliente'];
            $cliente = mysqli_query($conexion, $queryCliente);
            $row_cliente = mysqli_fetch_assoc($cliente);

            $queryTUsuario = "SELECT * FROM tipousuario WHERE idTUsuario = " . $row_cliente['idTUsuario'];
            $TUsuario = mysqli_query($conexion, $queryTUsuario);
            $row_TUsuario = mysqli_fetch_assoc($TUsuario);

            $idCliente = $row_facturas['idCliente'];
            $Producto = $row_facturas['Producto'];
            $costo = $row_facturas['costo'];
            $solicitada = $row_facturas['fechaC'];
            $idTicket = $row_facturas['idTicket'];
            $status = $_POST['status'];
            $dateProceso = date("Y-m-d H:i:s");

            $updateFactura = "UPDATE `facturas` SET `idCliente`='$idCliente',`Producto`='$Producto',`costo`='$costo',`fechaC`='$solicitada',`idTicket`='$idTicket',`status`='$status',`dateProceso`='$dateProceso',`dateAprobada`=NULL,`dateRechazada`=NULL WHERE idTicket =" . $row_facturas['idTicket'];
            $ticket = mysqli_query($conexion, $updateFactura);

            if ($status == 1) {
                $statusEmail = 'Solicitada';
            } elseif ($status == 2) {
                $statusEmail = 'En proceso...';
            } elseif ($status == 3) {
                $statusEmail = 'Aprobada';
            } elseif ($status == 4) {
                $statusEmail = 'Rechazada';
            }
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
        } elseif ($_POST['status'] == 3) {
            /** La factura fue aprobada*/
            $queryTickets = "SELECT * FROM tickets WHERE N_Operacion =" . $_POST['operacion'];
            $tickets = mysqli_query($conexion, $queryTickets);
            $row_tickets = mysqli_fetch_assoc($tickets);

            $queryfacturas = "SELECT * FROM facturas WHERE idCliente =" . $row_tickets['idCliente'];
            $facturas = mysqli_query($conexion, $queryfacturas);
            $row_facturas = mysqli_fetch_assoc($facturas);

            $queryCliente = "SELECT * FROM cliente WHERE idCliente = " . $row_tickets['idCliente'];
            $cliente = mysqli_query($conexion, $queryCliente);
            $row_cliente = mysqli_fetch_assoc($cliente);

            $queryTUsuario = "SELECT * FROM tipousuario WHERE idTUsuario = " . $row_cliente['idTUsuario'];
            $TUsuario = mysqli_query($conexion, $queryTUsuario);
            $row_TUsuario = mysqli_fetch_assoc($TUsuario);

            $idCliente = $row_facturas['idCliente'];
            $Producto = $row_facturas['Producto'];
            $costo = $row_facturas['costo'];
            $solicitada = $row_facturas['fechaC'];
            $idTicket = $row_facturas['idTicket'];
            $status = $_POST['status'];
            $dateProceso = $row_facturas['dateProceso'];
            $dateAprobada = date("Y-m-d H:i:s");

            $updateFactura = "UPDATE `facturas` SET `idCliente`='$idCliente',`Producto`='$Producto',`costo`='$costo',`fechaC`='$solicitada',`idTicket`='$idTicket',`status`='$status',`dateProceso`='$dateProceso',`dateAprobada`='$dateAprobada',`dateRechazada`=NULL WHERE idTicket =" . $row_facturas['idTicket'];
            $ticket = mysqli_query($conexion, $updateFactura);

            if ($status == 1) { 
                $statusEmail = 'Solicitada';
             } elseif ($status == 2) { 
                $statusEmail = 'En proceso...';
             } elseif ($status == 3) { 
                $statusEmail = 'Aprobada';
             } elseif ($status == 4) { 
                $statusEmail = 'Rechazada';
             }
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
        } elseif ($_POST['status'] == 4) {
            /** La factura fue rechazada*/
            /** La factura fue aprobada*/
            $queryTickets = "SELECT * FROM tickets WHERE N_Operacion =" . $_POST['operacion'];
            $tickets = mysqli_query($conexion, $queryTickets);
            $row_tickets = mysqli_fetch_assoc($tickets);

            $queryfacturas = "SELECT * FROM facturas WHERE idCliente =" . $row_tickets['idCliente'];
            $facturas = mysqli_query($conexion, $queryfacturas);
            $row_facturas = mysqli_fetch_assoc($facturas);

            $queryCliente = "SELECT * FROM cliente WHERE idCliente = " . $row_tickets['idCliente'];
            $cliente = mysqli_query($conexion, $queryCliente);
            $row_cliente = mysqli_fetch_assoc($cliente);

            $queryTUsuario = "SELECT * FROM tipousuario WHERE idTUsuario = " . $row_cliente['idTUsuario'];
            $TUsuario = mysqli_query($conexion, $queryTUsuario);
            $row_TUsuario = mysqli_fetch_assoc($TUsuario);

            $idCliente = $row_facturas['idCliente'];
            $Producto = $row_facturas['Producto'];
            $costo = $row_facturas['costo'];
            $solicitada = $row_facturas['fechaC'];
            $idTicket = $row_facturas['idTicket'];
            $status = $_POST['status'];
            $dateProceso = $row_facturas['dateProceso'];
            $dateRechazada = date("Y-m-d H:i:s");

            $updateFactura = "UPDATE `facturas` SET `idCliente`='$idCliente',`Producto`='$Producto',`costo`='$costo',`fechaC`='$solicitada',`idTicket`='$idTicket',`status`='$status',`dateProceso`='$dateProceso',`dateAprobada`=NULL,`dateRechazada`='$dateRechazada' WHERE idTicket =" . $row_facturas['idTicket'];
            $ticket = mysqli_query($conexion, $updateFactura);

            if ($status == 1) { 
                $statusEmail = 'Solicitada';
             } elseif ($status == 2) { 
                $statusEmail = 'En proceso...';
             } elseif ($status == 3) { 
                $statusEmail = 'Aprobada';
             } elseif ($status == 4) { 
                $statusEmail = 'Rechazada';
             }
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

        if ($ticket) {
            echo json_encode('success');
        } else {
            echo json_encode('error-insertar');
        }
    }
}
