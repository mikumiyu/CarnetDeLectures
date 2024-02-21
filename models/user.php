<?php 

namespace models;

use config\DataBase;

class User extends DataBase{

    private \PDO $bdd;
    
    public function __construct()
    {
        $this -> bdd = $this -> getBdd();
    }

    public function createUser($userName,$userMail,$password){

        

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $query = $this->bdd->prepare("
                                    INSERT INTO user (
                                        userName,
                                        userMail,
                                        password
                                    )
                                    VALUES (
                                        ?,
                                        ?,
                                        ?
                                    )
                            ");

                $query->execute([$userName,$userMail,$passwordHash]);

    }

    public function getPasswordByEmail($userName)
    {
        $query = $this -> bdd -> prepare("
                                            SELECT
                                                `password`,
                                                `user_id`
                                            FROM
                                                `user`
                                            WHERE
                                                `userName` = ?
                                        ");
        $test = $query -> execute([$userName]);
        $password = $query->fetch();
        var_dump($password);
        if($password)
        {
            return $password;
        }
        else
        {
            return false;
        }
    }

    public function getNameById($userId){

        $query = $this -> bdd -> prepare("
                                            SELECT
                                                `userName`
                                            FROM
                                                `user`
                                            WHERE
                                                `user_id` = ?
                                        ");
        $test = $query -> execute([$userId]);
        $password = $query->fetch();
        var_dump($password);
        if($password)
        {
            return $password;
        }
        else
        {
            return false;
        }

    }

}

?>