<?php 

namespace models;

use config\DataBase;

class Comment extends DataBase{

    private \PDO $bdd;
    
    public function __construct()
    {
        $this -> bdd = $this -> getBdd();
    }

    public function getCommentsByBookId($bookId){

        $query = $this->bdd->prepare("
                                    SELECT
                                        c.comment_id,
                                        c.commentContent,
                                        u.userName
                                    FROM
                                        comment AS c
                                    INNER JOIN
                                        user as u
                                    ON
                                        c.user_id = u.user_id
                                    WHERE
                                        c.book_id = ?
                                    ORDER BY 
                                        c.comment_id DESC;
        ");

        $query->execute([$bookId]);

        $comments = $query->fetchAll();

        return $comments;

    }

    public function addComment($commentContent,$user_id,$book_id){

        $query = $this->bdd -> prepare("
                                        INSERT INTO comment(
                                                `commentContent`,
                                                `user_id`,
                                                `book_id`
                                        )
                                        VALUES(
                                            ?,
                                            ?,
                                            ?
                                        )
        ");

        $test = $query->execute([$commentContent,$user_id,$book_id]);

    }
}

?>