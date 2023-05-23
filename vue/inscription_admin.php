<?php
if (isset($_SESSION['connecte']) && $_SESSION['connecte'] === true && $_SESSION['type'] === 'a'){
    
} else {
    header('Location: http://localhost/tp_centre_equestre/');
}
require_once "../inc/bdd.inc.php";
$pagename = "Inscription Administrateur";
require $headerpath;


?>

<html>

<head>
    <link rel="stylesheet" href="../lib/form_template.css">
</head>

<body>

    <div class="container">
        <form method="post" action="../controller/CompteController.php">
            <div class="row">
                <h4>Inscription Administrateur</h4>
                <div class="input-group input-group-icon">
                    <input type="text" name="username" placeholder="nom d'utilisateur" required/>
                    <div class="input-icon"><i class="fa fa-user"></i></div>
                </div>
                <div class="input-group input-group-icon">
                    <input type="password" name="mdp" placeholder="mot de passe" required/>
                    <div class="input-icon"><i class="fa fa-key"></i></div>
                </div>
                <div class="input-group input-group-icon">
                    <input type="password" name="mdp_confirm" placeholder="confirmer mot de passe" required/>
                    <div class="input-icon"><i class="fa fa-key"></i></div>
                </div>
                <div>
                    <input type="submit" name="create_account_admin" value="S'inscrire"/>
                </div>
            </div>
        </form>
    </div>

</body>
</html>