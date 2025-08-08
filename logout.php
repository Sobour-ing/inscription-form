<?php
session_start();

//  pour deconnecter
$_SESSION = array();

// Détruire le cookie de session si il existe
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Déconnecter la session
session_destroy();

// Redirection vers la page  connexion avec message
session_start();
$_SESSION['success_message'] = "Vous avez été déconnecté avec succès.";
header("Location: connexion.php");
exit();
?>
