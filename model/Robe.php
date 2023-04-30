<?php

/**
 * Selectionne tous les chevals de la table
 * On distingue un cheval d'un représentant par la valeur de sa license 
 */
function get_all_rob()
{
    global $con;
    $sql = "SELECT * FROM ".DB_TABLE_ROBE." WHERE actif = :actif;";
    $req = $con->prepare($sql);
    $req->bindValue(':actif', 1, PDO::PARAM_INT);
    try {
        $req->execute();
        return $req->fetchAll();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function get_one_rob(int $id){
    global $con;
    $sql = "SELECT * FROM ".DB_TABLE_ROBE." WHERE id_robe = :id ;";
    $req = $con->prepare($sql);
    $req->bindValue(':id',$id,PDO::PARAM_INT);
    
    try {
        $req->execute();
        return $req->fetch();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function soft_delete_rob_by_id(int $id){
    global $con;
    $sql = "UPDATE ".DB_TABLE_ROBE." SET actif = :actif WHERE id_robe = :id";
    $req = $con->prepare($sql);
    $req->bindValue(':actif', 0, PDO::PARAM_INT);
    $req->bindValue(':id', $id, PDO::PARAM_INT);

    try{
        $req->execute();
        return true;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    
}

function add_rob(Robe $robe){
    global $con;
    $sql = "INSERT INTO robe(libelle_robe, actif) VALUES(:libelle, :actif)";
    $req = $con->prepare($sql);
    $req->bindValue(':actif', 1, PDO::PARAM_INT);
    $req->bindValue(':libelle', $robe->getLibelle(), PDO::PARAM_STR);

    try{
        $req->execute();
        return true;
    } catch (PDOException $e) {
        return $e->getMessage();
    }

}

function update_rob(Robe $robe, int $id){
    global $con;
    $sql = "UPDATE ".DB_TABLE_ROBE." SET libelle_robe = :libelle WHERE id_robe = :id";
    $req = $con->prepare($sql);
    $req->bindValue(':libelle', $robe->getLibelle());
    $req->bindValue(':id', $id, PDO::PARAM_INT);

    try{
        $req->execute();
        return true;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
