<?php

namespace Controller;

use Model\Menus;
use Model\MenusManager;

class AdminMenuController extends AbstractController
{
    
    public function index ()
    {
        session_start();
        
        $donnees = [];
        
        if (!isset($_SESSION['user_id']))
        {
            header('Status: 301 Moved Permanently', false, 301); header('Location: /login'); exit();
            
        }
        
        
        $menusManager = new MenusManager();
        $resultat = $menusManager->recupererTypeTitre();
      
    public $erreurs = [];

    public function ajouter()
    {
        session_start();
        
        $resultat = "";
        $donnees = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $donnees['type'] = $_POST['type'];
            $donnees['titre'] = $_POST['titre'];

            if (isset($_FILES['image'])) {

                $typesAutorises = 'image/jpeg';
                $tailleAutorisee = 2000000;
                $nomOriginal = $_FILES['image']['name'];
                $repTemp = $_FILES['image']['tmp_name'];
                $typeFichier = $_FILES['image']['type'];
                $tailleFichier = $_FILES['image']['size'];
                $erreurFichier = $_FILES['image']['error'];
                $extensionFichier = pathinfo($nomOriginal, PATHINFO_EXTENSION);
                $repFinal = 'assets/img/img-menu/';

                if (!empty($_FILES) && $typeFichier != $typesAutorises || $tailleFichier > $tailleAutorisee) {
                    echo '<div class="alert alert-warning" role="alert">
                      <strong>Erreur lors de l\'envoi de l\'image ! Veuillez vérifier que le type ou la taille sont bien respectés !!!</strong></div>';
                    $this->erreurs['erreur'] = "Erreur d'envoi d'image";

                /*} elseif ($tailleFichier > $tailleAutorisee) {
                    echo '<div class="alert alert-warning" role="alert">
                      <strong>Le fichier est trop lourd.</strong></div>';
                    $this->erreurs['taille'] = "Taille de fichiers incorrecte";*/

                } else {
                    $nomFinal = 'image' . uniqid() . '.' . $extensionFichier;
                    move_uploaded_file($repTemp, $repFinal . $nomFinal);
                }

            }
            $donnees['image'] = $nomFinal;

            $donnees['introduction'] = $_POST['introduction'];
            $donnees['entree'] = $_POST['entree'];
            $donnees['d_entree'] = $_POST['d_entree'];
            $donnees['plat'] = $_POST['plat'];
            $donnees['d_plat'] = $_POST['d_plat'];
            $donnees['dessert'] = $_POST['dessert'];
            $donnees['d_dessert'] = $_POST['d_dessert'];
            $donnees['prix'] = $_POST['prix'];

            if (empty($this->erreurs)) {
                $menusManager = new MenusManager();
                $resultat = $menusManager->ajouter($donnees);
            }
        }
        
        header('Location: /admin');

    }
    
    public function supprimer()
    {
        session_start();
       
        $menu = [];
        
        if(isset($_POST['supprimer'])){
            
            $menu = $_POST['delete'];
            echo $menu;
            $menusManager = new MenusManager();
            $menusManager->supprimer($menu);
            
        }
        
         header('Location: /admin');
    }

    
}





