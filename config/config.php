<?php
    //Infos pour se co

    $db_host = "localhost";         //URL de la bdd
    $db_name = "my_job_board";      //bdd que l'on va travailler
    $db_user = "root";              //User MySQL
    $db_pass = "";                  //mDp

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