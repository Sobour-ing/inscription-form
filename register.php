<?php
session_start(); // Ajout de session_start()

$host = 'localhost';
$dbname = 'formulaire_inscription tp1';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validation côté serveur
    $errors = [];
    
    if (empty($nom)) {
        $errors[] = "Le nom est requis";
    }
    if (empty($prenom)) {
        $errors[] = "Le prénom est requis";
    }
    if (empty($email)) {
        $errors[] = "L'email est requis";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format d'email invalide";
    }
    if (empty($password)) {
        $errors[] = "Le mot de passe est requis";
    } elseif (strlen($password) < 8) {
        $errors[] = "Le mot de passe doit contenir au moins 8 caractères";
    }

    if (!empty($errors)) {
        $_SESSION['error_message'] = implode(", ", $errors);
        header('Location: index.php');
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $check = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        $_SESSION['error_message'] = "Cet email est déjà enregistré.";
        header('Location: index.php');
        exit();
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (nom, prenom, email, password, date_inscription) 
                               VALUES (?, ?, ?, ?, NOW())");
        if ($stmt->execute([$nom, $prenom, $email, $hashedPassword])) {
            // Message de succès et redirection vers connexion.php
            $_SESSION['success_message'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            header('Location: connexion.php');
            exit();
        } else {
            $_SESSION['error_message'] = "Erreur lors de l'inscription.";
            header('Location: index.php');
            exit();
        }
    }
}
?>