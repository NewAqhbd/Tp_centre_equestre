<?php

require "../inc/bdd.inc.php";
// REQUEST
$keyword = "%".$_POST['keyword']."%"; //'%' on cherchera n'importe quelle valeur contenant la chaîne de caractère $keyword

$sql = "SELECT * FROM ". DB_TABLE_CHEVAL ." WHERE nom_cheval LIKE (:var)";
$req = $con->prepare($sql);
$req->bindParam(':var',$keyword,PDO::PARAM_STR );

$req->execute();

$data = $req->fetchAll();           // On récupère les résultats 
foreach ($data as $key) {   

    echo '<p class="list_name" value="'.$key['id_cheval'].'" onclick="setInputValueChe(this)">'.$key['nom_cheval'].'</p>';

}