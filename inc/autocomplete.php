<?php

require "../inc/bdd.inc.php";
// REQUEST
$keyword = "%".$_POST['keyword']."%"; //'%' on cherchera n'importe quelle valeur contenant la chaîne de caractère $keyword

$sql = "SELECT * FROM ". DB_TABLE_PERSONNE ." WHERE nom_personne LIKE (:var) OR prenom_personne LIKE (:var);";
$req = $con->prepare($sql);
$req->bindParam(':var',$keyword,PDO::PARAM_STR );

$req->execute();

$data = $req->fetchAll();           // On récupère les résultats 
foreach ($data as $key) {   

    echo '<p class="list_name" value="'.$key['id_personne'].'" onclick="setInputValueCav(this)">'.$key['nom_personne'].' '.$key['prenom_personne'].'</p>';

}