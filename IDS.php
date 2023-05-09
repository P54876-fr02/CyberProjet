<?php

// Configuration
$max_attempts = 3; // Nombre maximal de tentatives échouées autorisées avant de bloquer l'adresse IP
$block_duration = 3600; // Durée de blocage en secondes (1 heure par défaut)

// Récupération de l'adresse IP du visiteur
$ip_address = $_SERVER['REMOTE_ADDR'];

// Vérification si l'adresse IP est déjà bloquée
if(is_ip_blocked($ip_address)) {
    die("Votre adresse IP est bloquée. Veuillez réessayer plus tard.");
}

// Vérification si le formulaire a été soumis
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérification des identifiants
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(verify_credentials($username, $password)) {
        // Connexion réussie, réinitialisation du compteur d'essais
        reset_login_attempts($ip_address);
        // Redirection vers la page d'accueil
        header("Location: index.php");
        exit();
    } else {
        // Mauvais identifiants, incrémenter le compteur d'essais
        increment_login_attempts($ip_address);

        // Vérification si le nombre maximal de tentatives est atteint
        if(get_login_attempts($ip_address) >= $max_attempts) {
            // Bloquer l'adresse IP
            block_ip_address($ip_address, $block_duration);
            die("Votre adresse IP a été bloquée pour $block_duration secondes.");
        }

        // Identifiants incorrects, afficher un message d'erreur
        echo "Identifiants incorrects. Veuillez réessayer.";
    }
}

// Fonction pour vérifier si une adresse IP est déjà bloquée
function is_ip_blocked($ip_address) {
    // Code pour se connecter à la base de données
    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'mydatabase';
    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
// Vérification si l'adresse IP est bloquée
    $query = "SELECT * FROM blocked_ips WHERE ip_address='$ip_address' AND block_time > NOW()";
    $result = mysqli_query($conn, $query);
    $row_count = mysqli_num_rows($result);

    // Fermeture de la connexion à la base de données
    mysqli_close($conn);

    return $row_count > 0;
}

// Fonction pour incrémenter le compteur d'essais de connexion
function increment_login_attempts($ip_address) {
    // Code pour se connecter à la base de données
    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'mydatabase';
    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

    // Incrémentation du compteur d'essais de connexion
    $query = "INSERT INTO login_attempts (ip_address, attempt_time) VALUES ('$ip_address', NOW())";
    mysqli_query($conn, $query);

    // Fermeture de la connexion à la base de données
    mysqli_close($conn);
}

// Fonction pour obtenir le nombre de tentatives de connexion échouées