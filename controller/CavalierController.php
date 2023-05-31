<?php
require "../inc/bdd.inc.php";
require "../model/Cavalier.php";
require "../model/Representant.php";
require "../model/CavalierRepresentant.php";
require "../model/Inscription.php";
require "../model/Cours.php";
require "../model/Participation.php";
require "../model/Compte.php";

$headerpath = "../vue/header.php";


/**
 * Retourne la vue qui affiche l'ensemble des Cavaliers 
 */

if(isset($_POST["action"]) && $_POST["action"] == "index"){
    $data = get_all_cav();
    return require_once "../vue/cav/cav_index.php";
}

/**
 * Retourne la vue qui affiche l'ensemble des Cavaliers après suppression ( SoftDelte ) d'un Cavalier
 */
if(isset($_POST["action"]) && $_POST["action"] == "delete"){

    soft_delete_cav_by_id($_POST["cav_id"]);
    $data = get_all_cav();
    return require_once "../vue/cav/cav_index.php";

}


/**
 * Reception des action sur la vue formulaire
 * 
 * Rentre via $_POST["action"] = form
 * 
 * S'execute selon $_POST["subaction"] =
 * new -> redirige sur formulaire vide
 * modify -> redirige sur formulaire pré rempli
 * [null] -> traitement d'ajout d'un cavalier
 * update -> traitement de modification d'un cavalier
 * 
 * 
 */
if(isset($_POST["action"]) && $_POST["action"] == "form"){
    /**
     * Affiche la vue de formulaire pour un nouveau cavalier
     */
    if(isset($_POST["subaction"] ) && $_POST["subaction"] == "new"){
        
        $new = true; //Permet de vérifier si le formulaire est celui d'ajout et non de modification
        return require_once "../vue/cav/cavrep_form.php";
    }
    /**
     * Affiche la vue de formulaire pour modifier un cavalier existant
     */
    if(isset($_POST["subaction"] ) && $_POST["subaction"] == "modify"){
        
        $data = get_one_cav($_POST['cav_id']);

        $infosaved["id_personne"]   = $data["id_personne"] ;
        $infosaved["nom"]           = $data["nom_personne"] ;
        $infosaved["prenom"]        = $data["prenom_personne"] ;
        $infosaved["datenaissance"] = $data["date_de_naissance"] ;
        $infosaved["mail"]          = $data["mail"] ;
        $infosaved["tel"]           = $data["tel"] ;
        $infosaved["photoName"]     = $data["photo"] ;
        $infosaved["galop"]         = $data["galop"];
        $infosaved["numlic"]        = $data["num_licence"] ;

        
        if ( isset($data["id_representant"]) && $data["id_representant"] != 0){

            $infosaved["id_representant"] = $data["id_representant"];
            $data = get_one_cav($data['id_representant']);

            $infosaved["nomrep"]    = $data["nom_personne"] ;
            $infosaved["prenomrep"] = $data["prenom_personne"] ;
            $infosaved["datenaissancerep"]    = $data["date_de_naissance"] ;
            $infosaved["mailrep"]   = $data["mail"] ;
            $infosaved["telrep"]    = $data["tel"] ;

        }
        
        $infosaved["rue"]           = $data["rue"] ;
        $infosaved["numaddr"]       = $data["complement"] ;
        $infosaved["codep"]         = $data["code_postal"];
        $infosaved["ville"]         = $data["ville"] ;
        $infosaved["pays"]          = "Pays" ;
        
        
        $update = true;

        return require_once "../vue/cav/cav_form.php";
        
    }

    if(isset($_POST["subaction"]) && $_POST["subaction"] == "modify_validation") {

        $infosaved = $_POST;
        require "../inc/photo.trait.php";
    
        if ($_FILES['photo']['size'] <= 0 ) {
            $photo = $_POST['photoName'];
        }
        if($_FILES['photo']['size'] > 0){
            if(!upload_photo('photo',$_POST['cav_nom'], true)){ 
                $error = "error photo";
                return require_once "../vue/cav/cav_form.php";
            }
            $photo = $_FILES['photo']['name'];

        }else {
            $data = get_one_cav((int)$_POST["cav_id"]);
        }

        $cavalier = new Cavalier(
            $_POST["cav_nom"],
            $_POST["cav_prenom"],
            $_POST["cav_dna"],
            $_POST["cav_mail"],
            $_POST["cav_tel"],
            $_POST["galop"],
            $_POST["numlic"],
            $photo,
        );

        update_cav($cavalier, $_POST["cav_id"]);
        $data = get_all_cav();
        return require_once '../vue/cav/cav_index.php';
    }

    
    
    
    //Sauvegarde en cas de rafraîchissement de la page ou d'erreur formulaire   
    $infosaved = $_POST;

    // Validation de l'input photo
    require "../inc/photo.trait.php";

    if ($_FILES['photo']['size'] <= 0 ) {
        $photo = $infosaved['photoName'];
    }
    if($_FILES['photo']['size'] > 0){
        if(!upload_photo('photo', $_POST['nom'], false)){ 
            $error = "error photo";
            return require_once "../vue/cav/cavrep_form.php";
        }
        $photo = $_FILES['photo']['name'];

    }else {
        $data = get_one_cav((int)$_POST["id_personne"]);
        // $photo = "choose-image.png";
    }

    // Validation de la composition du numéro de licence
    // 7 caractères alphabétiques + 1 caractère numérique
    if( !preg_match('/[A-Z]{7}[1-9]{1}/',$_POST["numlic"]) ){
        $error= "numlic";
        return require_once "../vue/cav/cavrep_form.php";
    }

    if( isset($_POST["choixRepresentant"]) && $_POST["choixRepresentant"] == "cav"){
        $cavalierRep = new CavalierRepresentant($_POST["nom"],
                                                    $_POST["prenom"],
                                                    $_POST["datenaissance"],
                                                    $_POST["mail"],
                                                    $_POST["tel"],
                                                    $_POST["galop"],
                                                    $_POST["numlic"],
                                                    $photo,
                                                    $_POST["rue"],
                                                    $_POST["numaddr"],
                                                    $_POST["codep"],
                                                    $_POST["ville"],
                                                    $_POST["pays"]
        );

        if ( isset($_POST["subaction"] ) && $_POST["subaction"] == "update") {
            if(!update_cavRep($cavalierRep,$_POST["id_personne"])){
                $error = "updcav";
                echo $error;
                return require_once "../vue/cav/cavrep_form.php";
            }else {
                $data = get_all_cav();
                return require_once "../vue/cav/cav_index.php";
            }
        }

        if(!add_cavRep($cavalierRep)){
            $error = "Erreur : Le mail existe déjà. Veuillez en choisir un autre.";
            $_POST["subaction"] = "create_after_fail";
            return require_once "../vue/cav/cavrep_form.php";
        }else {
            //Ajout d'un identifiant (mail) + mdp dans la table 'utilisateur' après la création du CavalierReprésentant
            $username = $_POST["mail"];
            $mdp = randomPassword();
            mail($username, "Création du compte de cavalier avec succès", "login : $username\nmdp : $mdp\nNe perdez pas votre code !");
            add_compte_u($username, $mdp);

            return require_once "../vue/ins/ins_form.php";
        }
        
        
    } else{
        $cavalier = new Cavalier($_POST["nom"],
                                    $_POST["prenom"],
                                    $_POST["datenaissance"],
                                    $_POST["mail"],
                                    $_POST["tel"],
                                    $_POST["galop"],
                                    $_POST["numlic"],
                                    $photo,
        );
        $representant = new Representant($_POST["nomrep"],
                                            $_POST["prenomrep"],
                                            $_POST["datenaissancerep"],
                                            $_POST["mailrep"],
                                            $_POST["telrep"],
                                            $_POST["rue"],
                                            $_POST["numaddr"],
                                            $_POST["codep"],
                                            $_POST["ville"],
                                            $_POST["pays"]
        );

        if (isset($_POST["subaction"] ) && $_POST["subaction"] == "update") {
            if(!update_cav($cavalier,$_POST["id_personne"])){
                $error = "updcav";
                return require_once "../vue/cav/cav_form.php";
            }else if(!update_rep($representant,$_POST["idrep"])){
                $error = "updrep";
                return require_once "../vue/cav/cav_form.php";
            }else{
                $data = get_all_cav();
                return require_once "../vue/cav/cav_index.php";
            }
        }

        if(!add_cav($cavalier)){
            $error = "Erreur : Le mail du cavalier et/ou du représentant existe déjà. Veuillez en choisir un autre.";
            $_POST["subaction"] = "create_after_fail";

            return require_once "../vue/cav/cavrep_form.php";
        }else if(!add_rep($representant)){
            $error = "Erreur : Le mail du cavalier et/ou du représentant existe déjà. Veuillez en choisir un autre.";
            $_POST["subaction"] = "create_after_fail";
            
            return require_once "../vue/cav/cavrep_form.php";
        }else{
            //Ajout d'un identifiant (mail) + mdp dans la table 'utilisateur' après la création du Cavalier
            $username = $_POST["mailrep"];
            $mdp = randomPassword();
            mail($username, "Création du compte de cavalier avec succès", "login : $username\nmdp : $mdp\nNe perdez pas votre code !");
            add_compte_u($username, $mdp);

            return require_once "../vue/ins/ins_form.php";
        }

    }
}

/**
 * Retourne la vue qui affiche un cavalier et son représentant s'il en a un
 */
isset($_SESSION["action"]) ? $_POST["action"] = $_SESSION["action"] : null ;
isset($_SESSION["cav_id"]) ? $_POST["cav_id"] = $_SESSION["cav_id"] : null ;

if(isset($_POST["action"]) && $_POST["action"] == "show")
{
    $data = get_one_cav($_POST["cav_id"]);
    $ins = get_ins_one_cav($_POST["cav_id"]);
    if ( isset($data["id_representant"]) && $data["id_representant"] != 0)
    {
        $rep = get_one_cav($data["id_representant"]);
    }
    $cou =  get_all_cou();
    $part1 = get_all_weekly_part_by_id($_POST["cav_id"],1);
    $part0 = get_all_part_by_id($_POST["cav_id"],0);

    return require_once "../vue/cav/cav_show.php";
}