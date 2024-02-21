<?php 


namespace models;

use config\DataBase;


class Book extends DataBase{

    private \PDO $bdd;
    
    public function __construct()
    {
        $this -> bdd = $this -> getBdd();
    }
    
    public function getBooks(){

        $query = $this->bdd->prepare("
                                        SELECT
                                            b.title,
                                            b.description,
                                            b.book_id,
                                            b.image,
                                            a.authorName,
                                            a.author_id,
                                            c.categoryName
                                        FROM
                                            book AS b
                                        INNER JOIN
                                            author as a
                                        ON
                                            b.author_id = a.author_id
                                        INNER JOIN
                                            category as c
                                        ON
                                            b.category_id = c.category_id
        ");

        $query->execute();

        $books = $query->fetchAll();

        return $books;
    }

    public function createNewBook($title,$description,$image,$category_id,$author_id){

        $query = $this->bdd->prepare("
                                            INSERT INTO book (
                                                title,
                                                description,
                                                image,
                                                author_id,
                                                category_id
                                            )
                                            VALUES (
                                            ?,
                                            ?,
                                            ?,
                                            ?,
                                            ?
                                            )"
                                    );

        $test = $query->execute([$title,$description,$image,$author_id,$category_id]);

        if ($test)
        {
            return $this->bdd-> lastInsertId();
        } 
        else
        {
            return false;
        }

    }

    public function getRandomBook(){

        $query = $this->bdd->prepare("
                                        SELECT 
                                            * 
                                        FROM 
                                            book
                                        ORDER BY 
                                            RAND()
                                        LIMIT 
                                            1;

        ");

        $query->execute();

        $randomBook = $query->fetch();

        return $randomBook;
    }

    public function getBookById(){

        $query = $this->bdd->prepare("
                                    SELECT
                                        b.title,
                                        b.description,
                                        b.book_id,
                                        b.image,
                                        a.authorName,
                                        a.author_id,
                                        c.categoryName
                                    FROM
                                        book AS b
                                    INNER JOIN
                                        author as a
                                    ON
                                        b.author_id = a.author_id
                                    INNER JOIN
                                        category as c
                                    ON
                                        b.category_id = c.category_id
                                    WHERE
                                        b.book_id = ?;
        ");

        $query->execute([$_GET['id']]);

        $currentBook = $query->fetch();

        return $currentBook;

    }

    public function modifBook($title,$description,$image,$author_id,$category_id,$book_id){

        $query = $this->bdd->prepare("
                                        UPDATE 
                                            book
                                        SET
                                            title = ?,
                                            description = ?,
                                            image = ?,
                                            author_id = ?,
                                            category_id = ?
                                        WHERE
                                            book_id = ?

        ");

        $test = $query->execute([$title,$description,$image,$author_id,$category_id,$book_id]);

        return $test;
    }

    public function deleteBook(){

        $query = $this->bdd->prepare("
                                    DELETE FROM
                                        book
                                    WHERE
                                        book_id = ?
        ");

        $test = $query->execute([$_GET['id']]);

        return $test;

    }

}

?>