<?php

namespace controllers;
use traits\SecurityController;
use models\User;

class UserController
{
    use SecurityController;

    private User $user;
    
    public function __construct()
    {
        $this -> user = new User();
    }

    public function createAccountPage(){

        $template = "createAccount";
        require "views/layout.html.php";

    }
    
    public function createUser(){

        
        $userName = $_POST['userName'];
        $userMail = $_POST['userMail'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        if (
            isset($userName) && strlen($userName) <= 15 && strlen($userName) >= 3 &&
            isset($userMail) && strlen($userMail) <= 255 &&
            isset($password) && strlen($password) >= 8 &&
            isset($password2) && $password2 === $password
        ) {
            $this->user->createUser($userName, $userMail, $password);
        }

        

    }

    public function loginUser(){

        $userName = $_POST['userName'];
        $password = $_POST['password'];

        $userInfo = $this->user->getPasswordByEmail($userName);

        if(isset($userInfo))
        {

            $testPassword = $userInfo['password'];
            $userId = $userInfo['user_id'];

            if($testPassword)
            {
                //verification similarité
                $testMDP = password_verify($password,$testPassword);
                if ($testMDP) {

                    $userData = array(
                        'username' => $userName,
                        'id' => $userId,
                    );
                    $_SESSION['user'] = $userData;
                    
                    header("location:http://localhost/Projet%20final/backend/index.php?message=Connexion réussie ! bonjour $userData[username]");
                    exit();  
                } else {
                    header("location:http://localhost/Projet%20final/backend/index.php?action=loginPage&error=La connection à échoué ");
                    exit();
                }
            
            }
            else{
                header("location:http://localhost/Projet%20final/backend/index.php?action=loginPage&message=Informations incorrectes");
                exit;
            }
        
        }

    }

    public function loginPage(){

        $template = "login";
        require "views/layout.html.php";

    }
}