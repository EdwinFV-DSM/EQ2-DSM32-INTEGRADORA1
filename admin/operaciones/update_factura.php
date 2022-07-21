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

            require_once '../../Libraries/PDF/fpdf.php';
            /**Se genera el PDF */
            class PDF extends FPDF
            {
                function Header()
                {

                    $this->setY(12);
                    $this->setX(10);

                    $this->Image('../../assets/img/Logo.png', 10, 5, 45.6);

                    $this->SetFont('times', 'B', 13);

                    $this->Text(75, 15, utf8_decode('Innovative Transport S.A de C.V'));

                    $this->Text(77, 21, utf8_decode('6ª av. Los Angeles, California'));
                    $this->Text(88, 27, utf8_decode('Tel: 7785-8223'));
                    $this->Text(72, 33, utf8_decode('innovative.transport@gmail.com'));

                    $this->Image('https://seeklogo.com/images/G/gobierno-del-estado-de-mexico-logo-2B2D6D043E-seeklogo.com.png', 160, 5, 30);
                    require '../../config/ConexionDB.php';

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
                    //información de # de factura
                    $this->SetFont('Arial', 'B', 10);
                    $this->Text(150, 48, utf8_decode('FACTURA N°:') . $row_facturas['No_operacionF']);
                    $this->SetFont('Arial', '', 10);
                    $this->Text(176, 48, '');



                    // Agregamos los datos del cliente
                    $this->SetFont('Arial', 'B', 10);
                    $this->Text(10, 48, utf8_decode('Fecha:'));
                    $this->SetFont('Arial', '', 10);
                    $this->Text(25, 48, date('d/m/Y'));
                    $this->Ln(60);
                    $this->SetFont('Arial', 'B', 10);
                    $this->Text(50, 48, utf8_decode('Fecha de solicitud:'));
                    $this->SetFont('Arial', '', 10);
                    $this->Text(85, 48, $row_facturas['dateProceso']);




                    // Agregamos los datos de la factura
                    $this->SetFont('Arial', 'B', 10);
                    $this->Text(10, 54, utf8_decode('Cliente:'));
                    $this->SetFont('Arial', '', 10);
                    $this->Text(25, 54, $row_cliente['nombre'] . ' ' . $row_cliente['apellidos']);

                    $this->Ln(50);
                }

                function Footer()
                {
                    $this->SetFont('helvetica', 'B', 8);
                    $this->SetY(-15);
                    $this->Cell(95, 5, utf8_decode('Página ') . $this->PageNo() . ' / {nb}', 0, 0, 'L');
                    $this->Cell(95, 5, date('d/m/Y | g:i:a'), 00, 1, 'R');
                    $this->Line(10, 287, 200, 287);
                    $this->Cell(0, 5, utf8_decode("Innovative Transport S.A de C.V © Todos los derechos reservados."), 0, 0, "C");
                }
            }
            $pdf = new PDF();
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetAutoPageBreak(true, 20);
            $pdf->SetTopMargin(15);
            $pdf->SetLeftMargin(10);
            $pdf->SetRightMargin(10);



            $pdf->setY(60);
            $pdf->setX(135);
            $pdf->Ln();
            // En esta parte estan los encabezados
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(20, 7, utf8_decode('Cod'), 1, 0, 'C', 0);
            $pdf->Cell(95, 7, utf8_decode('Descripción'), 1, 0, 'C', 0);
            $pdf->Cell(20, 7, utf8_decode('Cant'), 1, 0, 'C', 0);
            $pdf->Cell(25, 7, utf8_decode('Precio'), 1, 0, 'C', 0);
            $pdf->Cell(25, 7, utf8_decode('Total'), 1, 1, 'C', 0);

            $pdf->SetFont('Arial', '', 10);

            require '../../config/ConexionDB.php';
            $queryTickets = "SELECT * FROM tickets WHERE N_Operacion =" . $_POST['operacion'];
            $tickets = mysqli_query($conexion, $queryTickets);
            $row_tickets = mysqli_fetch_assoc($tickets);

            $idTickets = $row_tickets['idTicket'];
            // echo $idTickets;

            $querypago = "SELECT * FROM pago WHERE idTicket =" . $idTickets;
            $pago = mysqli_query($conexion, $querypago);
            $pagos = mysqli_fetch_assoc($pago);
            // if ($pago) {
            //     echo "Se realizo correctamente <br>";
            //     var_dump($pagos);
            // } else {
            // }

            //Aqui inicia el for con todos los productos
            $pdf->Cell(20, 7, $row_tickets['N_Operacion'], 1, 0, 'L', 0);
            $pdf->Cell(95, 7, utf8_decode($row_facturas['Producto']), 1, 0, 'L', 0);
            $pdf->Cell(20, 7, utf8_decode('1'), 1, 0, 'R', 0);
            $pdf->Cell(25, 7, utf8_decode($row_tickets['costo']), 1, 0, 'R', 0);
            $pdf->Cell(25, 7, $pagos['total'], 1, 1, 'R', 0);


            //// Apartir de aqui esta la tabla con los subtotales y totales

            $pdf->Ln(10);

            // $pdf->setX(95);
            // $pdf->Cell(40, 6, 'Subtotal', 1, 0);
            // $pdf->Cell(60, 6, '4000', '1', 1, 'R');
            if ($row_TUsuario['idTUsuario'] == 2) {
                $descuent = "30%";
            } else {
                $descuent = "No Aplica";
            }

            $pdf->setX(95);
            $pdf->Cell(40, 6, 'Descuento', 1, 0);
            $pdf->Cell(60, 6, $descuent, '1', 1, 'R');
            $pdf->setX(95);
            $pdf->Cell(40, 6, 'Impuesto', 1, 0);
            $pdf->Cell(60, 6, 'NA', '1', 1, 'R');
            $pdf->setX(95);
            $pdf->Cell(40, 6, 'Total', 1, 0);
            $pdf->Cell(60, 6, $pagos['total'], '1', 1, 'R');



            $pdf_document = 'Factura_' . $row_tickets['N_Operacion'] . '.pdf';

            $pdf->Output('F', '../../temp_pdf/Factura_' . $row_tickets['N_Operacion'] . '.pdf');

            $updateFactura = "UPDATE `facturas` SET `idCliente`='$idCliente',`Producto`='$Producto',`costo`='$costo',`fechaC`='$solicitada',`idTicket`='$idTicket',`status`='$status',`dateProceso`='$dateProceso',`dateAprobada`='$dateAprobada',`dateRechazada`=NULL,`pdf_factura`='$pdf_document'  WHERE idTicket =" . $row_facturas['idTicket'];
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
