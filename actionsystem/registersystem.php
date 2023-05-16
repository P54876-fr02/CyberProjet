<?php
    session_start();
    require("db.php");

    if(isset($_POST['submit'])){
        // Vérifie si le formulaire de soumission a été envoyé

        
        if (!empty($_POST['username']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['repassword']) AND $_POST['password'] == $_POST['repassword']) {
            // Vérifie que tous les champs requis sont remplis et que les mots de passe correspondent

            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $repassword = $_POST['repassword'];

            // Prépare les requêtes pour vérifier si le nom d'utilisateur ou l'e-mail existent déjà dans la base de données
            $checkuserifexist = $bdd->prepare("SELECT * FROM admin WHERE username = ? ");
            $checkemailifexist = $bdd->prepare("SELECT * FROM admin WHERE email = ? ");

            // Exécute les requêtes en remplaçant les paramètres par les valeurs réelles
            $checkuserifexist->execute(array($username));
            $checkuserifexist->execute(array($email));

            if ($checkemailifexist->rowCount() == 0 && $checkuserifexist->rowCount() == 0) {
                // Vérifie que ni le nom d'utilisateur ni l'e-mail ne sont déjà présents dans la base de données

                $pwd = password_hash($password, PASSWORD_BCRYPT);
                $repwd = password_hash($repassword, PASSWORD_BCRYPT);
                // Hash les mots de passe avant de les stocker dans la base de données

                $insertuser = $bdd->prepare('INSERT INTO admin(username, email, passwords, repassword) VALUES (?, ?, ?, ?)');
                // Prépare la requête d'insertion pour ajouter les données dans la table 'admin'

                $insertuser->execute(array($username,$email,$pwd,$repwd));
                // Exécute la requête d'insertion en remplaçant les paramètres par les valeurs réelles
                

                header('Location: ./index.php');
            }
        }
    }
?>