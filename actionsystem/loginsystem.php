<?php
    session_start();
    require('db.php'); // Importe le fichier contenant la connexion à la base de données.

    if (isset($_POST['submit'])) { 
        if (!empty($_POST['username']) AND !empty($_POST['password'])) { // Vérifie si les champs 'username' et 'password' ne sont pas vides.

            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $bdd->prepare('SELECT * FROM admin WHERE username = ?'); // Prépare une requête SQL pour récupérer les informations de l'utilisateur correspondant au nom d'utilisateur fourni.
            $user->execute(array($username));

            if ($user->rowCount() > 0) { // Vérifie s'il existe un enregistrement correspondant au nom d'utilisateur dans la base de données.

                $userdata = $user->fetch(); // Récupère les données de l'utilisateur.

                if (password_verify($password, $userdata['passwords'])) { // Vérifie si le mot de passe correspond au hash stocké dans la base de données.
                    $_SESSION['auth'] = true; // Définit la variable de session 'auth' à true pour indiquer que l'utilisateur est authentifié.
                    $_SESSION['username'] = $userdata['username']; // Stocke le nom d'utilisateur dans la variable de session 'username'.
                    $_SESSION['email'] = $userdata['email']; // Stocke l'adresse e-mail dans la variable de session 'email'.

                    header('Location: ./dashboard.php'); // Redirige l'utilisateur vers la page 'dashboard.php'.
                    
                }
            }else{ 
                header('HTTP/1.1 401 Unauthorized'); // Envoie une réponse d'erreur 401 Unauthorized si le nom d'utilisateur n'est pas trouvé dans la base de données.
                error_log($_SERVER['REMOTE_ADDR'] . ' - ' . date('Y-m-d H:i:s') . ' - ' . $_SERVER['REQUEST_URI'] . ' - Connexion échouée: Nom d\'utilisateur ou mot de passe incorrect' . "\n", 3, 'access.log'); // Enregistre un message d'erreur dans le fichier de journal 'access.log'.
            }
        } else{
            header('HTTP/1.1 401 Unauthorized'); // Envoie une réponse d'erreur 401 Unauthorized si les champs 'username' ou 'password' sont vides.
            error_log($_SERVER['REMOTE_ADDR'] . ' - ' . date('Y-m-d H:i:s') . ' - ' . $_SERVER['REQUEST_URI'] . ' - Connexion échouée: Nom d\'utilisateur ou mot de passe incorrect' . "\n", 3, 'access.log'); // Enregistre un message d'erreur dans le fichier de journal 'access.log'.
        }
    }
?>