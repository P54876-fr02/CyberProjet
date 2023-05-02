<?php
     try {
        
        $bdd = new PDO('mysql:host=localhost;dbname=login_db;charset=utf8;', 'root', '');
        // print("ok");
    } catch (Exception $e) {
       
        die('error : '.$e->getMessage());
    }
?>