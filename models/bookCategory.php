<?php 

use config\DataBase;

class BookCategory extends DataBase{

    private \PDO $bdd;
    
    public function __construct()
    {
        $this -> bdd = $this -> getBdd();
    }

}

?>