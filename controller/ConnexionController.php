<?php
require_once '.././inc/bdd.inc.php';
$headerpath = "../vue/header.php";


if(isset($_POST['connexion'])){

    return require_once '../vue/connexion.php';

}

if(isset($_POST['deconnexion'])){

    session_destroy();
    session_start();
    if(!isset($_SESSION['connecte'])){ 
    /*Initialiser l'index 'connecte' afin d'éviter l'erreur 'undefined index' quand, dans 'header.php',
    il est vérifié si l'utilisateur est connecté, afin d'afficher en conséquence le boutton 'déconnexion'*/
        $_SESSION['connecte'] = False; //Initialisation de la variable de contrôle de l'état de connexion
        $_SESSION['type'] = null;
    }
    header('Location: http://localhost/tp_centre_equestre/vue/connexion.php');
}

if(isset($_POST['connexion_validation'])){

    if(isset($_POST['username'])){
        $username = $_POST['username'];
        $mdp = $_POST['mdp'];
    
        $sql = "SELECT * FROM utilisateur WHERE nom_utilisateur = :username AND mdp = md5(:mdp)";
        $req = $con->prepare($sql);
        $req->bindValue(':username', $username, PDO::PARAM_STR);
        $req->bindValue(':mdp', $mdp, PDO::PARAM_STR);
        $req->execute();

        $count = $req->rowCount();
        // var_dump($count);

        $sql = "SELECT type FROM utilisateur WHERE nom_utilisateur = :username AND mdp = md5(:mdp)";
        $req = $con->prepare($sql);
        $req->bindValue(':username', $username, PDO::PARAM_STR);
        $req->bindValue(':mdp', $mdp, PDO::PARAM_STR);
        $req->execute();

        $type = $req->fetchColumn();
    
        if($count == 1 && $type == 'a'){ //S'il existe une correspondance entre login et mdp, établir la connexion
            require $headerpath;
            $_SESSION['username'] = $username;
            $_SESSION['mdp'] = $mdp;
            $_SESSION['connecte'] = True;
            $_SESSION['type'] = $type;
            header("Location: ../../tp_centre_equestre/vue/dashboard.php");
            exit();
        } elseif ($count == 1 && $type == 'u') {
            require $headerpath;
            $_SESSION['username'] = $username;
            $_SESSION['mdp'] = $mdp;
            $_SESSION['connecte'] = True;
            $_SESSION['type'] = $type;
            header("Location: ../../tp_centre_equestre");
            exit();
        }
        else{
            ?>
            <script>alert("Mot de passe ou mail invalide")</script>
            <?php require '../vue/connexion.php';
        }
    }
}

?>