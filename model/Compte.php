<?php

function add_compte_u($username, $mdp){ //Ajoute un utilisateur
    $type = "u";
    global $con;
    $sql = "INSERT INTO ".DB_TABLE_UTILISATEUR." (id_personne, nom_utilisateur, mdp, type) VALUES (:id_pers, :user, md5(:mdp), :type);";
    $req = $con->prepare($sql);
    $req->bindValue(':id_pers', $con->lastInsertId(), PDO::PARAM_STR);
    $req->bindValue(':user', $username, PDO::PARAM_STR);
    $req->bindValue(':mdp', $mdp, PDO::PARAM_STR);
    $req->bindValue(':type', $type, PDO::PARAM_STR);

    try {
        $req->execute();
        return true;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function add_compte_a($username, $mdp){ //Ajoute un administrateur
    $type = "a";
    global $con;
    $sql = "INSERT INTO ".DB_TABLE_UTILISATEUR." (id_personne, nom_utilisateur, mdp, type) VALUES (:id_pers, :user, md5(:mdp), :type);";
    $req = $con->prepare($sql);
    $req->bindValue(':id_pers', $con->lastInsertId(), PDO::PARAM_INT);
    $req->bindValue(':user', $username, PDO::PARAM_STR);
    $req->bindValue(':mdp', $mdp, PDO::PARAM_STR);
    $req->bindValue(':type', $type, PDO::PARAM_STR);

    try {
        $req->execute();
        return true;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 15; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}










?>