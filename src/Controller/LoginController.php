<?php

namespace Controller;

use Model\LoginManager;

class LoginController extends AbstractController
{
    public function index()
    {
        session_start();

        if (isset($_SESSION['user_id'])) {
            header('Status: 301 Moved Permanently', false, 301);
            header('Location: /login2');
            exit();

        }
        return $this->twig->render('StrasCook/login.html.twig');
    }

    public function entree()
    {
        session_start();
        /**
         * Check if the user is logged in.
         */
        if (!isset($_SESSION['user_id'])) {
            //User not logged in. Redirect them back to the login.php page.
            header('Status: 301 Moved Permanently', false, 301);
            header('Location: /login');
            exit();
        } else {
            return $this->twig->render('StrasCook/login2.html.twig');
        }


    }

    public function identifier()

    {
        session_start();


        if (isset($_POST['submit'])) {

            //Retrieve the field values from our login form.
            $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
            $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
            //Appel à la bdd
            $loginManager = new LoginManager();
            $login = $loginManager->getLogin($_POST['username']);


            //If $row is FALSE.

            if ($login === false) {
                //Could not find a user with that username!
                //PS: You might want to handle this error in a more user-friendly manner!
                $this->errors[] = "Nom d'utilisatrice incorrect";
                $error = true;
                return $this->twig->render('StrasCook/login.html.twig', ['errors' => $this->errors]);
                //die("Nom d'utilisatrice incorrect");
            } else {
                //User account found. Check to see if the given password matches the
                //password hash that we stored in our users table.

                //Compare the passwords.
                // $validPassword = array_key_exists($_POST['password'], $login['password']);

                //If $validPassword is TRUE, the login has been successful.
                if ($_POST['password'] == $login['password']) {

                    //Provide the user with a login session.
                    $_SESSION['user_id'] = $login['id'];
                    //$_SESSION['logged_in'] = time();

                    //Redirect to our protected page, which we called home.php
                    header('Location: /login2');
                    exit;

                } else {
                    //$validPassword was FALSE. Passwords do not match.
                    $this->errors[] = "Mot de passe incorrect";
                    $error = true;
                    $server = $_SERVER["PHP_SELF"];
                    return $this->twig->render('StrasCook/login.html.twig', ['errors' => $this->errors]);
                }
            }
        }
    }

    public function deco()
    {
        session_start();
        session_destroy();
        header("Location: /login");
    }
}