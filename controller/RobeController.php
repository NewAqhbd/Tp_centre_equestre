<?php
require "../inc/bdd.inc.php";
require "../model/Robe.php";
require "../inc/class/robe.class.php";

$headerpath = "../vue/header.php";

if(isset($_POST['action']) && $_POST['action'] == 'index'){
    $data = get_all_rob();
    return require_once '../vue/robe/rob_index.php';
}

if(isset($_POST['action']) && $_POST['action'] == 'delete'){
    soft_delete_rob_by_id($_POST['rob_id']);
    $data = get_all_rob();

    return require_once '../vue/robe/rob_index.php';
}

if(isset($_POST['action']) && $_POST['action'] == 'form'){

    if(isset($_POST['subaction']) && $_POST['subaction'] == 'modify'){
        $data = get_one_rob($_POST['rob_id']);
        $infosaved['libelle_rob'] = $data['libelle_robe'];

        $update = true;
        return require_once '../vue/robe/rob_form.php';
    }

    if(isset($_POST['subaction']) && $_POST['subaction'] == 'new'){
        return require_once '../vue/robe/rob_form.php';
    }


    $infosaved = $_POST;
    $robe = new Robe(
        $_POST['libelle_rob'],
    );
    

    if(isset($_POST["subaction"] ) && $_POST["subaction"] == "update") {
        if(!update_rob($robe, $_POST["id_rob"])){
            $error = "updrob";
            echo $error;
            return require_once "../vue/robe/rob_form.php";
        }else {
            $data = get_all_rob();
            return require_once "../vue/robe/rob_index.php";
        }
    }

    if(!add_rob($robe)){
        $error = "addrob";
        return require_once "../vue/robe/rob_form.php";
    }else {
        $data = get_all_rob();
        return require_once "../vue/robe/rob_index.php";
    }


}


?>