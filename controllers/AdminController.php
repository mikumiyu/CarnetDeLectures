<?php

namespace controllers;
use traits\SecurityController;
use models\Admin;

class AdminController
{
    use SecurityController;
    private Admin $admin;
    
    public function __construct()
    {
        $this -> admin = new Admin();
    }
    
    public function adminPage():void
    {
        $template = "admin/admin";
        require "views/layout.html.php";
    }
    public function adminPannel():void
    {
        $books = $this->admin->getBooks();
        $template = "admin/adminPannel";
        require "views/layout.html.php";
    }

    public function adminLogin()
    {

        if(isset($_POST['submit']))
        {
            $adminName = $_POST['adminName'];
            $password = $_POST['password'];
            $adminData =$this->admin->adminLogin($adminName);
            $dataToSend = array(
                'adminName' => $adminName,
                'id' => $adminData['admin_id'],
            );
    
            if($adminData) {
                $testMDP = password_verify($password,$adminData['password']); 
                if ($testMDP) {
                    $_SESSION['admin'] = $dataToSend;
                    header("location:index.php?action=adminPannel&message=Bonjour, ".$_SESSION['admin']." ! Vous êtes bien connecté en tant qu'administrateur");
                    exit();  
                } else {
                    header("location:index.php?action=admin&error=Votre mot de passe ou Pseudo est invalide");
                    exit();  
                }
            } else {
                header("location:index.php?action=admin&error=Votre mot de passe ou Pseudo est invalide");
                exit();  
            }

        }

    }

    public function isAdmin(){

        header('Content-Type: application/json');

        if (isset($_SESSION['admin'])) {
            echo json_encode(['isAdmin' => true]);
        } else {
            echo json_encode(['isAdmin' => false]);
        }

    }
}