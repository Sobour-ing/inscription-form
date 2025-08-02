<?php
session_start();

// Récupérer les messages d'erreur ou de succès
$error_message = '';
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

$success_message = '';
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="">
    <title>Formulaire d'inscription</title>
</head>
<body>
    <form id="registrationForm" method="POST" action="register.php">
        <h3>BIENVENUE SUR LA PAGE D'INSCRIPTION</h3>
        
        <?php if ($error_message): ?>
            <div class="error" style="text-align: center; margin-bottom: 15px;">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($success_message): ?>
            <div class="success" style="color: green; text-align: center; margin-bottom: 15px;">
                <?php echo htmlspecialchars($success_message); ?>
            </div>
        <?php endif; ?>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        <span class="error" id="nomError"></span>
        <br><br>

        <label for="prenom">Prenom :</label>
        <input type="text" id="prenom" name="prenom" required>
        <span class="error" id="prenomError"></span>
        <br><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <span class="error" id="emailError"></span>
        <br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <span class="error" id="passwordError"></span>
        <br><br>

        <label for="confirmpassword">Confirm the Password :</label>
        <input type="password" id="confirmpassword" name="confirmpassword" required>
        <span class="error" id="confirmpasswordError"></span>
        <br><br>

        <label>
            <input type="checkbox" id="terms" required>
            I agreed with terms and conditions
        </label>
        <br>
        <span class="error" id="termsError"></span>
        <br><br>

        <button type="submit">S'inscrire</button>
        <p id="success-message"></p>
        
        <div style="text-align: center; margin-top: 15px;">
            <p>Déjà inscrit ? <a href="connexion.php" style="color: #f10c0c; text-decoration: none;">Se connecter</a></p>
        </div>
    </form>
    <script src="script.js"></script>
</body>
</html>