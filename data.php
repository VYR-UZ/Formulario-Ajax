<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
ini_set('display_errors',1);

include 'PHPMailer/Exception.php';
include 'PHPMailer/PHPMailer.php';
include 'PHPMailer/SMTP.php';


header('Access-Control-Allow-Origin: *');
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // Indica los métodos permitidos.
    header('Access-Control-Allow-Methods: GET, POST, DELETE');
    // Indica los encabezados permitidos.
    header('Access-Control-Allow-Headers: Authorization');
    http_response_code(204);
}




$nombre = htmlentities($_POST["nombre"]);
$email = htmlentities($_POST['email']);
$asunto = htmlentities($_POST['asunto']);
$tel = htmlentities($_POST['tel']);
$selectienda= htmlentities($_POST['selectienda']);
$comentario = htmlentities($_POST['comentario']);

/*echo "Contenido del Formulario: ". $nombre."</br>".$email."</br>".
                                    $asunto."</br>".$tel."</br>".$selectienda."</br>".
                                    $comentario."</br>";*/

switch ($_POST['selectienda']) {
  case 'TOLUCA':
    $correoTienda='toluca@micorreo.com.mx';
    break;
  case 'TIJUANA':
    $correoTienda='tijuana@micorreo.com.mx';
    break;
  case 'VILLAHERMOSA 1':
    $correoTienda='villahermosa@micorreo.com.mx';
    break;
  case 'VILLAHERMOSA 2':
    $correoTienda='villahermosa2@micorreo.com.mx';
    break;
  case 'TIENDA EN LÍNEA':
    $correoTienda='digital@micorreo.com.mx';
    break;
  case 'PAULO':
    $correoTienda='vyruz5590@gmail.com';
    break;
  case 'SERGIO':
      $correoTienda='sergio_mayoral@outlook.com';
  break;
}




$mail = new PHPMailer(true);


try {
    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'info@micorreo.com';                     // SMTP username
    $mail->Password   = '';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mail->Debug = 2;

    //Recipients
    $mail->setFrom('info@micorreo.com', 'EuroCotton');
    $mail->addAddress("$correoTienda");     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "$asunto";
    $mail->Body    = "$tel<br>$email<br>$comentario";

    $mail->send();
    echo "header('HTTP/1.1 200 OK')";
    } catch (Exception $e) {
  /*echo "NotFound: {$mail->ErrorInfo}";*/
    echo "header('HTTP/1.1 500 Internal Server Error')";
    }


?>
