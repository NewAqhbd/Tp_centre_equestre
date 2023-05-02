<?php

$pagename = 'Connexion';
require_once '../vue/header.php';


?>

<head>
    <link rel="stylesheet" href="../lib/form_template.css">
</head>

<body>

    <div class="container">
        <form method="post" action="../controller/ConnexionController.php">
            <div class="row">
                <h4>Connexion</h4>
                <div class="input-group input-group-icon">
                    <input type="text" name="username" placeholder="Saisir le nom d'utilisateur (adresse email)" required/>
                    <div class="input-icon"><i class="fa fa-user"></i></div>
                </div>
                <div class="input-group input-group-icon">
                    <input type="password" name="mdp" placeholder="Saisir le mot de passe" required/>
                    <div class="input-icon"><i class="fa fa-key"></i></div>
                </div>
                <div>
                    <input type="submit" name="connexion_validation" value="Se Connecter" />
                </div>
            </div>
        </form>
    </div>
</body>
</html>