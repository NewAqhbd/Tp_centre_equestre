<?php

require_once "../inc/bdd.inc.php";
require_once "../model/Compte.php";
$headerpath = "../vue/header.php";

if(isset($_POST["inscription"])){
    return require_once "../vue/inscription.php";
}

if(isset($_POST["inscription_admin"])){
    return require_once "../vue/inscription_admin.php";
}

if(isset($_POST["create_account_user"])){
    //Ajout d'un compte dans la table utilisateur de type user (type='u')
    if($_POST["mdp"] == $_POST["mdp_confirm"]){
        add_compte_u($_POST["username"], $_POST["mdp"]); 
        return require_once "../vue/dashboard.php";
    }

    else{ ?>
        <script>alert("MDP pas similaire");</script>
    <?php  
    return require_once "../vue/inscription.php";
    }
}

if(isset($_POST["create_account_admin"])){
    //Ajout d'un compte dans la table utilisateur de type user (type='u')
    if($_POST["mdp"] == $_POST["mdp_confirm"]){
        add_compte_a($_POST["username"], $_POST["mdp"]); 
        return require_once "../vue/dashboard.php";
    }

    else{ ?>
        <script>alert("MDP pas similaire");</script>
    <?php  
        return require_once "../vue/inscription.php";
    }
}

if(isset($_POST["change_password"])){
    return require_once "../vue/nouveau_mdp.php";
}

if(isset($_POST["change_password_validation"])){
    $sql = "SELECT mdp FROM utilisateur WHERE nom_utilisateur = :mySession";
    $req = $con->prepare($sql);
    $req->bindValue(":mySession", $_SESSION["username"], PDO::PARAM_STR);
    $req->execute();
    $mdp_actuel = $req->fetchColumn();

    if(md5($_POST["mdp_actuel"]) == $mdp_actuel){
        if($_POST["mdp"] == $_POST["mdp_confirm"]) {
            $sql = "UPDATE utilisateur SET mdp = md5(:nouveau_mdp) WHERE nom_utilisateur = :mySession";
            $req = $con->prepare($sql);
            $req->bindValue(":nouveau_mdp", $_POST["mdp_confirm"], PDO::PARAM_STR);
            $req->bindValue(":mySession", $_SESSION["username"], PDO::PARAM_STR);
            $req->execute();
        } else { ?>
            <script>alert("Le nouveau mot de passe n'est pas saisi à l'identique")</script>
        <?php
        } ?>
        <script>
            alert("Mot de passe changé avec succès !");
            window.location.replace("../index.php");
        </script>
        <?php 

    } else { ?>
        <script>alert("Le mot de passe saisi ne correspond pas au mot de passe actuel")</script>
    <?php
    }
}



?>