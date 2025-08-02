<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

$nom = $_SESSION['user_nom'];
$prenom = $_SESSION['user_prenom'];
$email = $_SESSION['user_email'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Bienvenue</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .header {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            backdrop-filter: blur(10px);
        }

        .header h1 {
            color: white;
            margin: 0;
            font-size: 1.5em;
        }

        .user-info {
            color: white;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logout-btn {
            background-color: #f10c0c;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .logout-btn:hover {
            background-color: #d10a0a;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 80px);
            padding: 20px;
        }

        .welcome-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }

        .welcome-message {
            font-size: 2.5em;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .user-details {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
        }

        .user-details h3 {
            color: #667eea;
            margin-bottom: 15px;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: bold;
            color: #555;
        }

        .detail-value {
            color: #333;
        }

        .emoji {
            font-size: 3em;
            margin-bottom: 20px;
        }

        .actions {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .action-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            transition: transform 0.2s;
        }

        .action-btn:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Mon Espace Personnel</h1>
        <div class="user-info">
            <span>Connecté en tant que <?php echo htmlspecialchars($prenom . ' ' . $nom); ?></span>
            <a href="logout.php" class="logout-btn">Déconnexion</a>
        </div>
    </div>

    <div class="container">
        <div class="welcome-card">
            <div class="emoji">👋</div>
            <div class="welcome-message">
                Bonjour <?php echo htmlspecialchars($prenom . ' ' . $nom); ?> !
            </div>
            <p style="color: #666; font-size: 1.1em;">
                Bienvenue sur votre espace personnel. Nous sommes ravis de vous revoir !
            </p>

            <div class="user-details">
                <h3>Vos informations</h3>
                <div class="detail-item">
                    <span class="detail-label">Nom :</span>
                    <span class="detail-value"><?php echo htmlspecialchars($nom); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Prénom :</span>
                    <span class="detail-value"><?php echo htmlspecialchars($prenom); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Email :</span>
                    <span class="detail-value"><?php echo htmlspecialchars($email); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Statut :</span>
                    <span class="detail-value" style="color: green; font-weight: bold;">✅ Connecté</span>
                </div>
            </div>

            <div class="actions">
                <a href="#" class="action-btn">Mon Profil</a>
                <a href="#" class="action-btn">Paramètres</a>
                <a href="logout.php" class="action-btn" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);">
                    Déconnexion
                </a>
            </div>
        </div>
    </div>
</body>
</html>