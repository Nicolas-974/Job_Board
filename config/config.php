<?php
    //Infos pour se co

    $db_host = "mysql-jobboard.alwaysdata.net";         //URL de la bdd
    $db_name = "jobboard_bdd";                          //bdd que l'on va travailler
    $db_user = "jobboard";                              //User MySQL
    $db_pass = "job_board974";                          //mDp

    //Création du PDO

    try {
        $pdo = new PDO(
            "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", // DSN (Data Source Name)
            $db_user,
            $db_pass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,       // active les erreurs sous forme d'exceptions
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  // les résultats seront renvoyés sous forme de tableau associatif

            ]
            );
    } 
    
    catch (PDOException $e) {

        // Si la connexion échoue, on arrête tout et on affiche l'erreur
        die('Connexion échouée : ' . $e->getMessage());

    }


?>