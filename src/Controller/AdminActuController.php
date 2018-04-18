<?php

namespace Controller;

class AdminActuController extends AbstractController
{

    protected $errors = [];

    public function erreurs()
    {
        //création des erreurs


        if(!array_key_exists('message', $_POST) || $_POST['message'] == ''){
            $this->errors['message'] = "Vous n'avez pas renseigné votre message";
        }else{
            $message = $_POST['message'];
        }

        // Faire dispparaître les erreurs

        if(empty($this->errors))
        {
            $_POST = [];
        }

    }


        public function index()
    {

        $this->erreurs();
        if (isset($_POST['email'])) {
            $visuelErreur = $this->errors;
        }
        return $this->twig->render('StrasCook/adminactu.html.twig', ['modif'=>$_POST]);
    }



        /**
        * @param $id
        * @return string
        */
    public function show(int $id)
    {
        $itemManager = new ItemManager();
        $item = $itemManager->findOneById($id);

        return $this->twig->render('Actu/show.html.twig', ['item' => $item]);
    }

    /**
    * @param $id
    * @return string
    */
    public function edit(int $id)
    {
        // TODO : edit item with id $id
        return $this->twig->render('Actu/edit.html.twig', ['item', $id]);
    }

    /**
    * @param $id
    * @return string
    */
    public function add()
    {
        // TODO : add a new item
        return $this->twig->render('Actu/add.html.twig');
    }

    /**
    * @param $id
    * @return string
    */
    public function delete(int $id)
    {
        // TODO : delete the item with id $id
        return $this->twig->render('Actu/index.html.twig');
    }
}