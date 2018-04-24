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
      

        return $this->twig->render('StrasCook/admin.html.twig', [
                'donnees' => $resultat
        ]);
    }
    
    
    public function ajouter()
    {
        session_start();
        
        $resultat = "";
        $donnees = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $donnees['type'] = $_POST['type'];
            $donnees['titre'] = $_POST['titre'];
            $donnees['image'] = $_POST['image'];

            if (isset($_FILES['image'])) {

                $typesAutorises = ['image/jpeg', 'image/png'];
                $tailleAutorisee = 2000000;

                for ($i = 0; $i < count($_FILES['image']['name']); $i++) {

                    $nomOriginal = $_FILES['image']['name'][$i];
                    $repTemp = $_FILES['image']['tmp_name'][$i];
                    $typeFichier = $_FILES['image']['type'][$i];
                    $tailleFichier = $_FILES['image']['size'][$i];
                    $erreurFichier = $_FILES['image']['error'][$i];

                    $extensionFichier = pathinfo($nomOriginal, PATHINFO_EXTENSION);
                    $nomFinal = 'image' . uniqid() . '.' . $extensionFichier;
                    $repFinal = 'public/assets/img/img-menu/';

                    if ($repTemp != "") {

                        if (!in_array($typeFichier, $typesAutorises)) {
                            echo '<div class="alert alert-warning" role="alert">
                            <strong>Le fichier n\'est pas au bon format.</strong></div>';

                        } elseif ($tailleFichier > $tailleAutorisee || $erreurFichier === 1) {
                            echo '<div class="alert alert-warning" role="alert">
                            <strong>Le fichier est trop lourd.</strong></div>';

                        } else {
                            move_uploaded_file($repTemp, $repFinal . $nomFinal);
                        }
                    }
                }
            }

            $donnees['introduction'] = $_POST['introduction'];
            $donnees['entree'] = $_POST['entree'];
            $donnees['d_entree'] = $_POST['d_entree'];
            $donnees['plat'] = $_POST['plat'];
            $donnees['d_plat'] = $_POST['d_plat'];
            $donnees['dessert'] = $_POST['dessert'];
            $donnees['d_dessert'] = $_POST['d_dessert'];
            $donnees['prix'] = $_POST['prix'];

            $menusManager = new MenusManager();
            $resultat = $menusManager->ajouter($donnees);
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





