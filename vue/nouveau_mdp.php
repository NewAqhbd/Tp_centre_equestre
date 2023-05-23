<?php
if (isset($_SESSION['connecte']) && $_SESSION['connecte'] === true){
    
} else {
    header('Location: http://localhost/tp_centre_equestre/');
}
$pagename = 'Renouveller mot de passe';
require_once '../vue/header.php';


?>

<head>
    <link rel="stylesheet" href="../lib/form_template.css">
</head>

<body>


    <div class="container">
        <form method="post" action="../controller/CompteController.php">
            <div class="row">
                <h4>Changer mon mot de passe</h4>
                <div class="input-group input-group-icon">
                    <input type="password" name="mdp_actuel" placeholder="Saisir le mot de passe actuel" required/>
                    <div class="input-icon"><i class="fa fa-key"></i></div>
                </div>
                <div class="input-group input-group-icon">
                    <input type="password" name="mdp" placeholder="Saisir le nouveau mot de passe" required/>
                    <div class="input-icon"><i class="fa fa-key"></i></div>
                </div>
                <div class="input-group input-group-icon">
                    <input type="password" name="mdp_confirm" placeholder="Répeter le nouveau mot de passe" required/>
                    <div class="input-icon"><i class="fa fa-key"></i></div>
                </div>
                <div>
                    <input type="submit" name="change_password_validation" value="Changer le mot de passe" />
                </div>
            </div>
        </form>
    </div>

</body>

</html>