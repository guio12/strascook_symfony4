<?php

$errors = [];


if(!array_key_exists('email', $_POST) || $_POST['email'] == ''){
  $errors['email'] = "Vous n'avez pas renseigné votre email";
}
elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  $errors['email'] = "Vous n'avez pas renseigné un email valide";
}

if(!array_key_exists('message', $_POST) || $_POST['message'] == ''){
  $errors['message'] = "Vous n'avez pas renseigné votre message";
}

if (!array_key_exists('objet', $_POST) || $_POST['objet'] =='') {
  $errors['objet'] = "Vous n'avez pas choisi de motif";
}

?>

<?php

// Affichage des erreurs :


// if (isset($_POST['prenom']) || isset($_POST['nom']) || isset($_POST['email']) || isset($_POST['tel']) || isset($_POST['message']))

if (isset($_POST['email']))
{
  $ShowErrors = implode("<br>", $errors);
  echo $ShowErrors;
}


 ?>
