<?php
    session_start();
    require("db.php");

    if(isset($_POST['submit'])){
        
        if (!empty($_POST['username']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['repassword']) AND $_POST['password'] == $_POST['repassword']) {

            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $repassword = $_POST['repassword'];

            $checkuserifexist = $bdd->prepare("SELECT * FROM admin WHERE username = ? ");
            $checkemailifexist = $bdd->prepare("SELECT * FROM admin WHERE email = ? ");
            $checkuserifexist->execute(array($username));
            $checkuserifexist->execute(array($email));

            if ($checkemailifexist->rowCount() == 0 && $checkuserifexist->rowCount() == 0) {
                $pwd = password_hash($password, PASSWORD_BCRYPT);
                $repwd = password_hash($repassword, PASSWORD_BCRYPT);

                $insertuser = $bdd->prepare('INSERT INTO admin(username, email, passwords, repassword) VALUES (?, ?, ?, ?)');
                $insertuser->execute(array($username,$email,$pwd,$repwd));

                

                header('Location: ./index.php');
            }
        }
    }
?>