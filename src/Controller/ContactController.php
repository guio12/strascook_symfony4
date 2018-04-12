<?php

namespace Controller;

class ContactController extends AbstractController
{


    protected $errors = [];

// Create the Transport

  // public function Swift_SmtpTransport($email, $message, $objet)
  // {
  //
  //     $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465))
  //       ->setUsername('charlottehofraise@gmail.com')
  //       ->setPassword('tablechaise')
  //     ;
  //
  //     // Create the Mailer using your created Transport
  //     $mailer = new Swift_Mailer($transport);
  //
  //     // Create a message
  //     $message = (new Swift_Message($objet))
  //       ->setFrom($email)
  //       ->setTo(['charlottehofraise@gmail.com', 'charlottehofraise@gmail.com' => 'Charlotte'])
  //       ->setBody($message)
  //       ;
  //
  //     // Send the message
  //     $result = $mailer->send($message);
  //
  //     if ($result = $mailer->send($message)) {
  //       echo "Votre message a bien été envoyé.";
  //     }else{
  //       $errors['echec'] = "Suite à une erreur, votre e-mail n'a pu être envoyé.";
  //     }
  //
  //     // var_dump($result);
  //
  //
  // }

    public function erreurs()
    {
      //création des erreurs

      if(!array_key_exists('email', $_POST) || $_POST['email'] == ''){
      $this->errors['email'] = "Vous n'avez pas renseigné votre email";
      }
      elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $this->errors['email'] = "Vous n'avez pas renseigné un email valide";
      }else {
        $email=$_POST['email'];
      }

      if(!array_key_exists('message', $_POST) || $_POST['message'] == ''){
        $this->errors['message'] = "Vous n'avez pas renseigné votre message";
      }else{
        $message = $_POST['message'];
      }

      if (!array_key_exists('objet', $_POST) || $_POST['objet'] =='') {
        $this->errors['objet'] = "Vous n'avez pas choisi de motif";
      }else{
        $objet = $_POST['objet'];
      }

      if (!array_key_exists('titre', $_POST) || $_POST['titre'] =='') {
        $this->errors['titre'] = "Vous n'avez pas renseigné de titre";
      }else{
        $objet = $_POST['titre'];
      }

      // Faire apparaître les erreurs

      if(empty($this->errors))
      {
        $_POST = [];
      }

    }


    public function index()
    {

      $this->erreurs();
      return $this->twig->render('StrasCook/contact.html.twig', ['erreurs' => $errors, 'value'=>$_POST]);

    }

    /**
     * @param $id
     * @return string
     */
    public function show(int $id)
    {
        $itemManager = new ItemManager();
        $item = $itemManager->findOneById($id);

        return $this->twig->render('Item/show.html.twig', ['item' => $item]);
    }

    /**
     * @param $id
     * @return string
     */
    public function edit(int $id)
    {
        // TODO : edit item with id $id
        return $this->twig->render('Item/edit.html.twig', ['item', $id]);
    }

    /**
     * @param $id
     * @return string
     */
    public function add()
    {
        // TODO : add a new item
        return $this->twig->render('Item/add.html.twig');
    }

    /**
     * @param $id
     * @return string
     */
    public function delete(int $id)
    {
        // TODO : delete the item with id $id
        return $this->twig->render('Item/index.html.twig');
    }
}
