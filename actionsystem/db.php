<?php
     try {
        
        $bdd = new PDO('mysql:host=localhost;dbname=login_db;charset=utf8;', 'root', '');
        // print("ok");
        // Établit une connexion à la base de données MySQL en utilisant PDO.
       
    } catch (Exception $e) {
        // Si une exception se produit lors de la tentative de connexion à la base de données, l'erreur est capturée.
       
        die('error : '.$e->getMessage());
        // Affiche un message d'erreur et arrête l'exécution du script en affichant le message de l'exception.

    }
?>