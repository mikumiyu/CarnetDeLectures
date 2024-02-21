<?php

namespace controllers;
use traits\SecurityController;
use models\Comment;

class CommentController
{
    use SecurityController;

    private Comment $comment;
    
    public function __construct()
    {
        $this -> comment = new Comment();
    }
    
    public function getCommentsByBookId(){


        if (isset($_GET['action']) && $_GET['action'] === 'getCommentsAJAX') {


            $bookId = $_POST['id'];

            $comments = $this->comment->getCommentsByBookId($bookId);
            
            header('Content-type: application/json');
            echo json_encode([$comments]);

        }
        
        

    }

    public function addComment(){

        //ajouter des sécurités
        // if(){
        //     $commentContent = $_POST['commentContent'];
        //     $date = $_POST['date'];
        //     $user_id = $_POST['userId'];
        //     $book_id = $_POST['bookId'];
        // }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'addCommentAJAX') {
            // Récupérer les données JSON du corps de la requête
            $json = file_get_contents('php://input');
        
            // Décoder les données JSON en un tableau associatif PHP
            $commentData = json_decode($json, true);
        
            if ($commentData && isset($commentData['commentData'])) {
                // Accédez aux propriétés du tableau associatif $commentData['commentData']
                $commentContent = $commentData['commentData']['commentContent'];
                $userId = $commentData['commentData']['userId'];
                $bookId = $commentData['commentData']['bookId'];
        
                // Ajoutez le commentaire en utilisant la classe Comment
                $result = $this->comment->addComment($commentContent,$userId, $bookId);
                $response = "Commentaire ajouté";
                header('Content-type: application/json');
                echo json_encode($response);
                
            }
        }
        


    }
}