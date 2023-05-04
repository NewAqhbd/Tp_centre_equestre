<?php
require "../inc/bdd.inc.php";
require "../model/Pension.php";
require "../model/Cheval.php";
require "../model/Cavalier.php";

$headerpath = "../vue/header.php";

/**
 * Retourne la vue qui affiche l'ensemble des Pensions 
 */
if(isset($_POST["action"]) && $_POST["action"] == "index"){
    
    $data=get_all_pension();

    return require_once "../vue/pen/pen_index.php";

}

/**
 * Retourne la vue qui affiche une Pension
 */
if(isset($_POST["action"]) && $_POST["action"] == "show")
{
    global $con;
    $data = get_one_pen($_POST["pen_id"]);
    $ddf = get_date_de_fin($data["id_pension"]);
    
    $sql = "SELECT nom_cheval FROM cheval WHERE id_cheval = :idChe";
    $req = $con->prepare($sql);
    $req->bindValue(':idChe', $data["id_cheval"], PDO::PARAM_INT);
    $req->execute();
    $che_nom = $req->fetchColumn();
            
    if ( isset($data["id_pension"]) && $data["id_pension"] != 0)
    {
        $pen = get_one_pen($data["id_pension"]);
    }

    return require_once "../vue/pen/pen_show.php";
}

/**
 * Retourne la vue qui affiche l'ensemble des Pensions après suppression ( SoftDelte ) d'une Pension
 */
if(isset($_POST["action"]) && $_POST["action"] == "delete"){

    soft_delete_pen_by_id($_POST["pen_id"]);
    
    $data=get_all_pension();
    
    return require_once "../vue/pen/pen_index.php";

}

/**
 * Reception des action sur la vue formulaire
 * 
 * Rentre via $_POST["action"] = form
 * 
 * S'execute selon $_POST["subaction"] =
 * new -> redirige sur formulaire vide
 * modify -> redirige sur formulaire pré rempli
 * [null] -> traitement d'ajout d'une pension
 * update -> traitement de modification d'une pension
 * 
 * 
 */
if(isset($_POST["action"]) && $_POST["action"] == "form"){

    /**
     * Affiche la vue de formulaire pour une nouvelle pension
     */
    if(isset($_POST["subaction"] ) && $_POST["subaction"] == "new"){
        
        return require_once "../vue/pen/pen_form.php";
    }
    /**
     * Affiche la vue de formulaire pour modifier une pension existante
     */
    if(isset($_POST["subaction"] ) && $_POST["subaction"] == "modify"){
        global $con;
        $data = get_one_pen($_POST['pen_id']);

        $sql = "SELECT id_personne FROM est_pensionnaire WHERE id_pension = :idPension";
        $req = $con->prepare($sql);
        $req->bindValue("idPension", $data["id_pension"], PDO::PARAM_INT);
        $req->execute();
        $cavIds = $req->fetchColumn();

        $infosaved["id_pension"]    = $data["id_pension"] ;
        $infosaved["libelle"]       = $data["libelle_pension"] ;
        $infosaved["tarif"]         = $data["tarif"] ;
        $infosaved["date_de_debut"] = $data["date_de_debut"] ;
        $infosaved["duree"]         = $data["duree"] ;
        $infosaved["id_cheval"]     = $data["id_cheval"];
        $infosaved["id_cavalier"]   = $cavIds;     
        if(isset($data["id_cheval"]) && $data["id_cheval"] != ""){
            $che = get_one_che($data["id_cheval"]);
            $infosaved["nom_cheval"] = $che["nom_cheval"];
        }
        if(isset($cavIds) && $cavIds != ""){
            $cav = get_one_cav($cavIds);
            $infosaved["nom_cavalier"] = $cav["nom_personne"];
            $oldCav = $cavIds;
        }
        
        $update = true;

        return require_once "../vue/pen/pen_form.php";
    }

    //Sauvegarde en cas de rafraichissement de la page ou d'erreur formulaire
    $infosaved = $_POST;
    $error = null;

    $pension = new Pension($_POST["tarif"], $_POST["duree"], $_POST["date_de_debut"], $_POST["libelle"], $_POST["id_cheval"]);
    
    if (isset($_POST["subaction"] ) && $_POST["subaction"] == "update") {
        
        // Quand cavalier déjà affecté à la pension
        if (isset($_POST['nom_cavalier']) && $_POST['nom_cavalier'] != '') {
            if(!update_pension($pension,$_POST["id_pension"]) || !update_est_pensionnaire($infosaved["id_pension"] , $_POST["id_cavalier"], $_POST["id_old_cav"])){
                $error = "updpen";
                echo $error;
                return require_once "../vue/pen/pen_form.php";
            }else {
                $data = get_all_pension();
                return require_once "../vue/pen/pen_index.php";
            }
        } else {
            //Quand aucun cavalier affecté à la pension
            if(!update_pension($pension,$_POST["id_pension"]) || !create_est_pensionnaire($_POST['id_pension'], $_POST["id_cavalier"])){
                $error = "updpen";
                echo $error;
                return require_once "../vue/pen/pen_form.php";
            }else {
                $data = get_all_pension();
                return require_once "../vue/pen/pen_index.php";
            }
        }
    }

    //Création d'une nouvelle pension avec cavalier
    if(isset($_POST["nom_cavalier"]) && $_POST["nom_cavalier"] != "") {
        global $con;
        if(!create_pension($pension) || !create_est_pensionnaire($con->lastInsertId(), $_POST['id_cavalier'])){
            $error = "addpen";
            return require_once "../vue/pen/pen_form.php";
        }else {
            $data = get_all_pension();
            return require_once "../vue/pen/pen_index.php";
        }
    }

    //Création d'une nouvelle pension sans cavalier
    if(!create_pension($pension)){
        $error = "addpen";
        return require_once "../vue/pen/pen_form.php";
    }else {
        $data = get_all_pension();
        return require_once "../vue/pen/pen_index.php";
    }

} else{
        $pension = new Pension(     $_POST["libelle"],
                                    $_POST["tarif"],
                                    $_POST["date_de_debut"],
                                    $_POST["duree"],
                                    $_POST["id_cheval"],
                                    $_POST
    );

    if (isset($_POST["subaction"] ) && $_POST["subaction"] == "update") {
        if(!update_pension($pension,$_POST["id_pension"])){
            $error = "updpen";
            echo $error;
            return require_once "../vue/pen/pen_form.php";
        }else{
            $data = get_all_pension();
           //var_dump(update_pension($pension,$_POST["id_pension"]));
            return require_once "../vue/pen/pen_index.php";
        }
    }
        
        if(!create_pension($pension)){
            $error = "addpen";
            return require_once "../vue/pen/pen_form.php";
        }else{
            $data = get_all_pension();
            return require_once "../vue/pen/pen_index.php";
        }
}