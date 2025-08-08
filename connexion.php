<?php
session_start();

//  user est déjà connecté, partie de la redirection vers acceuil.php
if (isset($_SESSION['user_id'])) {
    header("Location: acceuil.php");
    exit();
}

$success_message = '';
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

$error_message = '';
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}
?>
// ma page de connexion---amelioration
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion</title>
    <style>
        /* Reprise des styles de base avec adaptations */
        body {
            font-family: Arial, sans-serif;
            background-color: #bda7a7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: rgb(218, 213, 213);
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(136, 21, 21, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bolder;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #161515;
            border-radius: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #f10c0c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            width: 100%;
            margin-bottom: 15px;
        }

        button:hover {
            background-color: #746f6f;
        }

        .error {
            color: red;
            font-size: 0.9em;
            margin-bottom: 10px;
            text-align: center;
        }

        .success {
            color: green;
            font-size: 1em;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .links {
            text-align: center;
            margin-top: 15px;
        }

        .links a {
            color: #f10c0c;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .welcome-emoji {
            font-size: 1.5em;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <form action="login.php" method="POST">
        <h3>CONNEXION</h3>
        
        <?php if ($success_message): ?>
            <div class="success">
                <span class="welcome-emoji">🎉</span>
                <?php echo htmlspecialchars($success_message); ?>
                <span class="welcome-emoji">✨</span>
            </div>
        <?php endif; ?>
        
        <?php if ($error_message): ?>
            <div class="error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Se connecter</button>
        
        <div class="links">
            <p>Pas encore inscrit ? <a href="index.php">Créer un compte</a></p>
        </div>
    </form>
</body>


</html>
