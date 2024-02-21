<?php
namespace models;

use config\DataBase;

class Admin extends DataBase
{
    private \PDO $bdd;
    
    public function __construct()
    {
        $this -> bdd = $this -> getBdd();
    }
 
    public function adminLogin($adminName)
    {
        $query = $this -> bdd -> prepare("
                                            SELECT
                                                password,
                                                admin_id
                                            FROM
                                                admin
                                            WHERE
                                                adminName = ?
        ");

        $query-> execute([$adminName]);

        $adminData = $query->fetch();
        if($adminData)
        {
            return $adminData;
        }
        else
        {
            return false;
        }
        
    }

}





