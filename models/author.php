<?php 

namespace models;

use config\DataBase;

class Author extends DataBase{

    private \PDO $bdd;
    
    public function __construct()
    {
        $this -> bdd = $this -> getBdd();
    }

    public function getAuthorByName($authorName){

        $query = $this->bdd->prepare("
                                        SELECT
                                            author_id
                                        FROM
                                            author
                                        WHERE
                                            authorName = ?
        ");

        $query->execute([$authorName]);

        $author_id = $query->fetchColumn();

        return $author_id;

    }

    public function addAuthor($authorName){

        $query = $this->bdd->prepare("
                                            INSERT INTO author (
                                                authorName
                                            )
                                            VALUES (
                                            ?
                                            )"
                                    );

        $test = $query->execute([$authorName]);

        if ($test)
        {
            return $this->bdd-> lastInsertId();
        } 
        else
        {
            return false;
        }

    }

}

?>