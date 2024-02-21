<?php 

namespace models;

use config\DataBase;

class Category extends DataBase{

    private \PDO $bdd;
    
    public function __construct()
    {
        $this -> bdd = $this -> getBdd();
    }

    public function getCategoryByName($categoryName){

        $query = $this->bdd->prepare("
                                        SELECT
                                            category_id
                                        FROM
                                            category
                                        WHERE
                                            categoryName = ?
        ");

        $query->execute([$categoryName]);

        $category_id = $query->fetchColumn();

        return $category_id;

    }

    public function addCategory($categoryName){

        $query = $this->bdd->prepare("
                                            INSERT INTO category (
                                                categoryName
                                            )
                                            VALUES (
                                            ?
                                            )"
                                    );

        $test = $query->execute([$categoryName]);

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