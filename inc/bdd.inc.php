<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if(!isset($_SESSION)){ 

    session_start();

}

if(!isset($_SESSION['connecte']) || !isset($_SESSION['type'])){

    $_SESSION['connecte'] = False;
    $_SESSION['type'] = null;
    
}

//WhiteList des liens accessibles sans connexion
if(isset($_SESSION['connecte']) 
    && $_SESSION['connecte'] == False 
    && !isset($_POST["inscription"]) 
    && !isset($_POST["create_account"]) 
    && !isset($_POST["create_account_admin"]) 
    && !isset($_POST["front_che"])
    && !isset($_POST["che_details"])
    && !isset($_POST["display_cours"])
    && !isset($_POST["display_gallery"])


    ){ 

    if($actual_link !== "http://localhost/tp_centre_equestre/" && $actual_link !== "http://localhost/tp_centre_equestre/vue/cours/loadCours.php") {
        // <script>window.location.replace('../vue/connexion.php')</script>
        header('Location: http://localhost/tp_centre_equestre/vue/connexion.php');
    }}


try {
    /*  Connexion  */
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tp_centre_equestre";

    $con = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8mb4", $username, $password);
    //echo "Connected to database";
}catch(PDOException $e) {
    echo $e->getMessage();
}

// DEFINE
define('DB_TABLE_PERSONNE','personne');
define('DB_TABLE_EVENT','event');
define('DB_TABLE_PENSION','pension');
define('DB_TABLE_CHEVAL','cheval');
define('DB_TABLE_ROBE','robe');
define('DB_TABLE_UTILISATEUR','utilisateur');
define('DB_TABLE_INSCRIPTION','inscription');
define('DB_TABLE_COURS','cours');
define('DB_TABLE_PARTICIPATION','participation');


/* Include des class  */
require "class/Personne.class.php";
require "class/Cavalier.class.php";
require "class/Representant.class.php";
require "class/CavalierRepresentant.class.php";
require "class/cheval.class.php";
require "class/pension.class.php";
require "class/inscription.class.php";
require "class/cours.class.php";

