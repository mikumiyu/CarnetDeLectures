<?php

use config\DataBase;

$database = new DataBase;

$db = $database->getBdd();


$nomUtilisateur = "margauxfrch";
$motDePasseAdmin = "sécurité";

$motDePasseHash = password_hash($motDePasseAdmin, PASSWORD_DEFAULT);

$query = $db->prepare("
                            INSERT INTO admin (
                                adminName,
                                password
                            )
                            VALUES (
                                ?,
                                ?
                            )
                    ");

        $query->execute([$nomUtilisateur,$motDePasseHash]);

?>