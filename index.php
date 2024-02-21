<?php 

session_start();

use controllers\AdminController;
use controllers\BookController;
use controllers\CommentController;
use controllers\UserController;

function chargerClasse($classe)
{
    $classe=str_replace('\\','/',$classe);      
    require $classe.'.php'; 
}

spl_autoload_register('chargerClasse');

$adminController = new AdminController();
$bookController = new BookController();
$commentController = new CommentController();
$userController = new UserController();

// Appel unique a la page createAdmin
// require('createAdmin.php');

if(isset($_GET['action'])){

    $action = (string)$_GET['action'];

    switch($action){

        case "admin":
            $adminController->adminPage();
            break;

        case "connexionAdmin":
            $adminController->adminLogin();
            break;
    
        case "adminPannel":
            $bookController->bookListPage();
            break;
        case 'addBook';
            $bookController->addBook();
            break;
        case 'modifBook';
            $bookController->modifBook();
            break;
        case 'deleteBook';
            $bookController->deleteBook();
            break;
        case 'articlePage';
            $bookController->articlePage();
            break;
        case 'createAccount';
            $userController->createAccountPage();
            break;
        case 'createUser';
            $userController->createUser();
            break;
        case 'loginPage';
            $userController->loginPage();
            break;
        case 'loginUser';
            $userController->loginUser();
            break;
        case 'addCommentAJAX';
            $commentController->addComment();
            break;
        case 'getCommentsAJAX';
            $commentController->getCommentsByBookId();
            break;
        case 'isAdmin';
            $adminController->isAdmin();
            break;
        case 'disconnect';
            session_destroy();
            header("Location: ./index.php?message=Vous êtes maintenant déconnecté");
            exit;
            break;

    }

}
else{
    $randomBook = $bookController->getRandomBook();
    $books = $bookController->getBooks();
    $template = "homePage";
    require("./views/layout.html.php");
}




?>