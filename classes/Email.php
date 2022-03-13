<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token) {

        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        
        //CREAR EL OBJETO DE EMAIL
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'abafee0023ccf9';
        $mail->Password = 'bb7a45ed681efa';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress("cuentas@appsalon.com", "AppSalon.com");
        $mail->Subject = 'Confirma tu Cuenta';

        //SET HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p> <strong> Hola " . $this->nombre . "</strong> Has creado tu cuenta 
        en AppSalon, solo debes confirmarla presionando el siguente enlace</p>";
        $contenido .= "<p> Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'> 
        Confirmar Cuenta </a></p>";
        $contenido .= "<p> Si tu no solicictaste esta cuenta, puedes ignorar el mensaje </p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //ENVIAR EL MAIL
        $mail->send();
    }

    public function enviarInstrucciones() {
       //CREAR EL OBJETO DE EMAIL
       $mail = new PHPMailer();
       $mail->isSMTP();
       $mail->Host = 'smtp.mailtrap.io';
       $mail->SMTPAuth = true;
       $mail->Port = 2525;
       $mail->Username = 'abafee0023ccf9';
       $mail->Password = 'bb7a45ed681efa';

       $mail->setFrom('cuentas@appsalon.com');
       $mail->addAddress("cuentas@appsalon.com", "AppSalon.com");
       $mail->Subject = 'Reestablece tu Password';

       //SET HTML
       $mail->isHTML(TRUE);
       $mail->CharSet = 'UTF-8';

       $contenido = "<html>";
       $contenido .= "<p> <strong> Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu contraseña, sigue el 
       siguiente enlace para hacerlo:</p>";
       $contenido .= "<p> Presiona aquí: <a href='http://localhost:3000/recuperar?token=" . $this->token . "'> 
       Reestablecer Password </a></p>";
       $contenido .= "<p> Si tu no solicictaste esta cuenta, puedes ignorar el mensaje </p>";
       $contenido .= "</html>";

       $mail->Body = $contenido;

       //ENVIAR EL MAIL
       $mail->send(); 
    }
}