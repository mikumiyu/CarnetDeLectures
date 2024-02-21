<?php

    namespace controllers;
    use traits\SecurityController;
    use models\Book;
    use models\Author;
    use models\Category;

    Class BookController{

        private Book $book;
        private Author $author;
        private Category $category;

        public function __construct()
        {
            $this -> book = new Book();
            $this -> author = new Author();
            $this -> category = new Category();
        }

        public function bookListPage()
        {

            $books = $this->book->getBooks();

            if(isset($_GET['id'])){
                $currentBook = $this->book->getBookById($_GET['id']);
            }

            $template = "views/admin/adminPannel";
            require "views/layout.html.php";    

        }

        public function addBook(){

            

            if(isset($_POST['submit'])){
                $uploads_dir = "assets/image/upload";
                if (!empty($_FILES['image']['name'])) {
                    $tmp_name = $_FILES["image"]["tmp_name"];
                    $name = $_FILES["image"]["name"];
                    move_uploaded_file($tmp_name, "$uploads_dir/$name");
                }

                if(isset($_POST['authorName']) && isset($_POST['title']) && isset($_POST['description']) && isset($name) && isset($_POST['category'])){
                    $authorName = strtolower($_POST['authorName']);
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $image = $name;
                    $category = $_POST['category'];

                    if(is_string($authorName) && strlen($authorName) >= 6 && strlen($authorName) <= 255 &&
                    is_string($title) && strlen($title) >= 6 && strlen($title) <= 50 &&
                    is_string($description) && strlen($description) >= 10 && strlen($description) <= 400
                    ){
                        $author_id = $this->author->getAuthorByName($authorName);
                        if(!$author_id){
                            $author_id = $this->author->addAuthor($authorName);
                        }
                        $category_id = $this->category->getCategoryByName($category);
                        if(!$category_id){
                            $category_id = $this->category->addCategory($category);
                        }

                        $test = $this->book->createNewBook($title,$description,$image,$category_id,$author_id);

                        if($test){
                            header("location:index.php?action=adminPannel&message=L'article : $title a bien été crée.");
                            exit(); 
                        }else{
                            header("location:index.php?action=adminPannel&error=L'ajout de livre a échoué");
                            exit(); 
                        }
                    }
                    
                }
                
                

                
            }
            

        }

        public function modifBook(){

            if(isset($_POST['submit'])){
                $uploads_dir = "assets/image/upload";
                if (!empty($_FILES['image']['name'])) {
                    $tmp_name = $_FILES["image"]["tmp_name"];
                    $name = $_FILES["image"]["name"];
                    move_uploaded_file($tmp_name, "$uploads_dir/$name");
                    $imageToUse = $name;
                }
                else{
                    $imageToUse = $_POST['currentImage'];
                }

                if(
                isset($_POST['authorName']) && 
                isset($_POST['title']) && 
                isset($_POST['description']) && 
                isset($_POST['category']) && 
                isset($imageToUse) && 
                isset($_GET['id'])
                )
                {
                    $authorName = strtolower($_POST['authorName']);
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $image = $imageToUse;
                    $book_id = $_GET['id'];
                    $category = $_POST['category'];

                    if(
                    is_string($authorName) && strlen($authorName) >= 6 && strlen($authorName) <= 255 &&
                    is_string($title) && strlen($title) >= 6 && strlen($title) <= 50 &&
                    is_string($description) && strlen($description) >= 10 && strlen($description) <= 400
                    )
                    {
                        $author_id = $this->author->getAuthorByName($authorName);
                        if(!$author_id){
                            $author_id = $this->author->addAuthor($authorName);
                        }
                        $category_id = $this->category->getCategoryByName($category);
                        if(!$category_id){
                            $category_id = $this->category->addCategory($category);
                        }

                        $test = $this->book->modifBook($title,$description,$image,$author_id,$category_id,$book_id);

                        if($test){
                            header("location:index.php?action=adminPannel&message=L'article : $title a bien été modifié.");
                            exit(); 
                        }else{
                            header("location:index.php?action=adminPannel&error=La modification de l'article a échoué");
                            exit(); 
                        }
                    }
                    
                }


            }



        }

        public function deleteBook(){

            $test = $this->book->deleteBook();

            if($test){
                header("location:index.php?action=adminPannel&message=L'article a bien été supprimé.");
                exit(); 
            }else{
                header("location:index.php?action=adminPannel&error=La suppression de l'article a échoué");
                exit(); 
            }

        }

        public function getRandomBook(){

            $randomBook = $this->book->getRandomBook();

            return $randomBook;

        }

        public function getBooks(){

            $books = $this->book->getBooks();

            return $books;
        }

        public function articlePage(){

            $book = $this->book->getBookById($_GET['id']);

            $template = "articlePage";
            require "views/layout.html.php";
        }

    }
