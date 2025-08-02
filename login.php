<?php
session_start();

// Configuration de la base de données
$host = 'localhost';
$dbname = 'formulaire_inscription tp1';
$username = 'root'; 
$password = '';    

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    if (empty($email) || empty($password)) {
        $_SESSION['error_message'] = "Veuillez remplir tous les champs";
        header("Location: connexion.php");
        exit();
    }
    
    // Recherche de l'utilisateur par email
    $stmt = $pdo->prepare("SELECT id, nom, prenom, email, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['password'])) {
        // Connexion réussie
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nom'] = $user['nom'];
        $_SESSION['user_prenom'] = $user['prenom'];
        $_SESSION['user_email'] = $user['email'];
        
        header("Location: acceuil.php");
        exit();
    } else {
        // Échec de la connexion
        $_SESSION['error_message'] = "Email ou password incorrect";
        header("Location: connexion.php");
        exit();
    }
} else {
    // Accès direct au fichier sans POST
    header("Location: connexion.php");
    exit();
}
?>