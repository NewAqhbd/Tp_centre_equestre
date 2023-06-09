<?php
require_once "../inc/bdd.inc.php";

/* CREATE / INSERT INTO
 * 
 * Créer la pension dans la table
 * 
 */
function create_pension(Pension $pension){
    global $con;    
    $sql = "INSERT INTO ".DB_TABLE_PENSION." (`libelle_pension`, `tarif`, `date_de_debut`, `duree`, `id_cheval`) 
            VALUES (:libelle_pension, :tarif, :date_de_debut, :duree, :id_cheval);";
    $req = $con->prepare($sql);
    $req->bindValue(':libelle_pension', $pension->getLibelle(), PDO::PARAM_STR);
    $req->bindValue(':tarif', $pension->getTarif(), PDO::PARAM_INT);
    $req->bindValue(':date_de_debut', $pension->getDate_de_debut(), PDO::PARAM_STR);
    $req->bindValue(':duree', $pension->getDuree(), PDO::PARAM_INT);
    $req->bindValue(':id_cheval', $pension->getId_Cheval(), PDO::PARAM_INT);
    try {
        $req->execute();
        return true;
    }
    catch (PDOException $e) {
        return $e->getMessage();
    }
}

function create_est_pensionnaire($idPen, $idCav) {
    global $con;
    $sql = "INSERT INTO est_pensionnaire(id_pension, id_personne) VALUES(:idPen, :idCav)";
    $req = $con->prepare($sql);
    $req->bindValue(':idPen', $idPen, PDO::PARAM_INT);
    $req->bindValue(':idCav', $idCav, PDO::PARAM_INT);
    try {
        $req->execute();
        return true;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/* READ / SELECT
 * 
 * Selectionne toutes les pensions de la table
 * 
 */
function get_all_pension(){
    global $con;
        
    $req="SELECT * FROM ".DB_TABLE_PENSION." WHERE actif = :actif;";
    $sql=$con->prepare($req);
    $sql->bindValue(':actif',1,PDO::PARAM_INT);
    try{
        $sql->execute();
        return $sql->fetchAll (PDO::FETCH_ASSOC);
    }
    catch(PDOException $e){
        return $e->getMessage();
    }
}

function get_one_pen(int $id){
    global $con;
    $sql = "SELECT * FROM ".DB_TABLE_PENSION." WHERE id_pension = :id ;";
    $req = $con->prepare($sql);
    $req->bindValue(':id',$id,PDO::PARAM_INT);
    
    try {
        $req->execute();
        return $req->fetch();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/* UPDATE
 * 
 * Modifie la pension dans la table
 * 
 */
function update_pension(Pension $pension, int $id){
    global $con; 
    $sql =  "UPDATE ".DB_TABLE_PENSION." SET    libelle_pension = :libelle_pension,
                                                tarif = :tarif,
                                                date_de_debut = :date_de_debut,
                                                duree = :duree,
                                                id_cheval = :id_cheval
            WHERE id_pension = :id ;";
    $req = $con->prepare($sql);
    $req->bindValue(':libelle_pension', $pension->getLibelle(), PDO::PARAM_STR);
    $req->bindValue(':tarif', $pension->getTarif(), PDO::PARAM_INT);
    $req->bindValue(':date_de_debut', $pension->getDate_de_debut(), PDO::PARAM_STR);
    $req->bindValue(':duree', $pension->getDuree(), PDO::PARAM_INT);
    $req->bindValue(':id_cheval', $pension->getId_Cheval(), PDO::PARAM_INT);
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    try {
        $req->execute();
        return true;
    }
    catch (PDOException $e) {
        return $e->getMessage();
    }
}

function update_est_pensionnaire($idPen, $idCav, $idOldCav) {
    global $con;
    $sql = "UPDATE est_pensionnaire SET id_personne = :idCav WHERE id_pension = :idPen AND id_personne = :idOldCav";
    $req = $con->prepare($sql);
    $req->bindValue(':idCav', $idCav, PDO::PARAM_INT);
    $req->bindValue(':idPen', $idPen, PDO::PARAM_INT);
    $req->bindValue(':idOldCav', $idOldCav, PDO::PARAM_INT);

    $req->execute();


    try{
        $req->execute();
        return true;
    } catch (PDOException $e) {
        var_dump("error");
        return $e->getMessage();
    }
}


/* DELETE
 * 
 * Supprime la pension dans la table
 * 
 */
function soft_delete_pen_by_id(int $id){
    global $con;
    $sql = "UPDATE ".DB_TABLE_PENSION." SET actif = :actif WHERE id_pension = :id ;";
    $req = $con->prepare($sql);
    $req->bindValue(':actif',0,PDO::PARAM_INT);
    $req->bindValue(':id',$id,PDO::PARAM_INT);
    
    try {
        $req->execute();
        return true;
    } 
    catch (PDOException $e) {
        return $e->getMessage();
    }
}


/*
 * 
 * Retourne les pensions à partir d'un nom de cheval
 * 
 */
function get_pen_che(int $id){
    global $con;
    $sql = "SELECT p.libelle_pension, p.tarif, p.date_de_debut, p.duree
        FROM ".DB_TABLE_PENSION." p
        INNER JOIN cheval c ON p.id_cheval = c.id_cheval
        WHERE c.id_cheval = :id ;";
    $req = $con->prepare($sql);
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    
    try {
        $req->execute();
        return $req->fetchAll (PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        return $e->getMessage();
    }
}


function get_date_de_fin(int $id){
    global $con;
    $sql = "SELECT DATE_ADD(date_de_debut,INTERVAL duree month) AS date_de_fin
            FROM ".DB_TABLE_PENSION." 
            WHERE id_pension = :id ;";
    
    $req = $con->prepare($sql);

    $req->bindValue(":id", $id, PDO::PARAM_INT);
    
    try {
        $req->execute();
        return $req->fetch (PDO::FETCH_ASSOC);
    }
    catch (PDOException $e){
        return $e->getMessage();
    }
}
/*
 * 
 * Reourne le ou les cavaliers d'une pension
 * 

function get_cav_pen (int $id)
{
    global $con;
    $sql = "SELECT * FROM personne cav
        INNER JOIN est_pensionnaire ep ON cav.id_personne = ep.id_personne
        INNER JOIN pension p ON p.id_pension = ep.id_pension
        WHERE id_pension = :id ;";
    $req = $con->prepare($sql);
    $req->bindValue (':id', int, PDO::PARAM_INT);
    
    try {
        $con->exec($sql);
        return $sql->fetchAll (PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        return $e->getMessage();
    }
}
 * 
 */

?>