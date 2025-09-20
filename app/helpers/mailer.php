<?php
namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php'; // ajusta la ruta según tu estructura

class Mailer {
    public static function enviarReservaExitosa(string $para, string $nombre, array $reservaData): bool {
        $mail = new PHPMailer(true);

        try {
            // Configuración servidor SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';  
            $mail->SMTPAuth   = true;
            $mail->Username   = 'nominasena793@gmail.com'; 
            $mail->Password   = 'zlwp jisw lsfz sskz'; // no la clave normal, debe ser App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Remitente y destinatario
            $mail->setFrom('nominasena793@gmail.com', 'Style Barber');
            $mail->addAddress($para, $nombre);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = "Confirmación de tu reserva en Style Barber";
            $mail->Body    = "
                <h2>Hola {$nombre},</h2>
                <p>Tu reserva fue registrada exitosamente.</p>
                <p><strong>Fecha:</strong> {$reservaData['fecha']}<br>
                   <strong>Hora:</strong> {$reservaData['hora']}<br>
                   <strong>Barbero:</strong> {$reservaData['barbero']}</p>
                <p>¡Gracias por confiar en nosotros!</p>
            ";

            return $mail->send();
        } catch (Exception $e) {
            error_log("Error al enviar correo: {$mail->ErrorInfo}");
            return false;
        }
    }
}
