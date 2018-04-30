<?php

namespace Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class ContactController extends AbstractController
{
    protected $errors = [];


    public function index()
    {

          session_start();


          $this->erreurs();
          if (isset($_POST['email'])) {
              $visuelErreur = $this->errors;
              return $this->twig->render('StrasCook/contact.html.twig', ['erreurs' => $visuelErreur, 'value' => $_POST]);
          }
          return $this->twig->render('StrasCook/contact.html.twig');
    }


    public function envoiMail()
    {
        $mail = new PHPMailer(true);
        // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'charlottehofraise@gmail.com';                 // SMTP username
            $mail->Password = 'tablechaise';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('charlottehofraise@gmail.com', 'Mailer');
            $mail->addAddress('charlottehofraise@gmail.com', 'Luc HUET');     // Add a recipient
            $mail->addReplyTo(" $this->email ", 'Information');

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = " $this->titre ";

            $mail->Body = " $this->message ";

            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send(header('Location:/contact'));
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

    public function erreurs()
    {

        //création des erreurs

        if (!array_key_exists('email', $_POST) || $_POST['email'] == '') {
            $this->errors['email'] = "Vous n'avez pas renseigné votre email";
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Vous n'avez pas renseigné un email valide";
        } else {
            $this->email = $_POST['email'];
        }

        if (!array_key_exists('message', $_POST) || $_POST['message'] == '') {
            $this->errors['message'] = "Vous n'avez pas renseigné votre message";
        } else {
            $this->message = $_POST['message'];
        }

        if (!array_key_exists('objet', $_POST) || $_POST['objet'] == '') {
            $this->errors['objet'] = "Vous n'avez pas choisi de motif";
        } else {
            $this->objet = $_POST['objet'];
        }

        if (!array_key_exists('titre', $_POST) || $_POST['titre'] == '') {
            $this->errors['titre'] = "Vous n'avez pas renseigné de titre";
        } else {
            $this->titre = $_POST['titre'];
        }

        // Faire dispparaître les erreurs

        if (empty($this->errors)) {
            $_POST = [];
            $this->envoiMail();
        }

    }

}
