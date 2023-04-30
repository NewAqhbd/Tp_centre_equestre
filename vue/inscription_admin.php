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
<body>

    <div class="containter">
        <h3>Inscription Administrateur</h3>
        <form method="post" action="../controller/CompteController.php">
            <div>
                <input type="text" name="username" placeholder="nom d'utilisateur" required/>
            </div>
            <div>
                <input type="password" name="mdp" placeholder="mot de passe" required/>
            </div>
            <div>
                <input type="password" name="mdp_confirm" placeholder="confirmer mot de passe" required/>
            </div>
            <div>
                <input type="submit" name="create_account_admin" value="S'inscrire"/>
            </div>
        </form>
    </div>

</body>
</html>