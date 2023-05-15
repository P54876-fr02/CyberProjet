<?php
    session_start();
    require('db.php');

    if (isset($_POST['submit'])) {
        if (!empty($_POST['username']) AND !empty($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $bdd->prepare('SELECT * FROM admin WHERE username = ?');
            $user->execute(array($username));

            if ($user->rowCount() > 0) {

                $userdata = $user->fetch();

                if (password_verify($password, $userdata['passwords'])) {
                    $_SESSION['auth'] = true;
                    $_SESSION['username'] = $userdata['username'];
                    $_SESSION['email'] = $userdata['email'];

                    header('Location: ./dashboard.php');
                    
                }
            }else{
                header('HTTP/1.1 401 Unauthorized');
                error_log($_SERVER['REMOTE_ADDR'] . ' - ' . date('Y-m-d H:i:s') . ' - ' . $_SERVER['REQUEST_URI'] . ' - Connexion échouée: Nom d\'utilisateur ou mot de passe incorrect' . "\n", 3, 'access.log');
            }
        } else{
            header('HTTP/1.1 401 Unauthorized');
            error_log($_SERVER['REMOTE_ADDR'] . ' - ' . date('Y-m-d H:i:s') . ' - ' . $_SERVER['REQUEST_URI'] . ' - Connexion échouée: Nom d\'utilisateur ou mot de passe incorrect' . "\n", 3, 'access.log');
        }
    }
?>