<?php 
$pagename = "Cheval : ".$data["nom_cheval"]." ".$data["SIRE"];
require $headerpath;

?>

<div>
    <div class="col">
        <h3 text-align="center" class="col-10">Détails de <b><?= $data["nom_cheval"] ?></b></h3>
        <div class="row">
            <img  id="imgCavalier" src="<?= "http://localhost/tp_centre_equestre/media/".$data['photo_cheval'] ?>" alt="" class="col-4">
            <div class="col-4">
                <p> Robe : <?= $rob['libelle_robe'] ?></p>
            </div>
            <div class="col-4">
                    <div class="row justify-content-between">
                        <p> Son propriétaire : <img src="<?= $cav['photo'] ?>" > </p>
                    </div>
                    <div class="row justify-content-between">
                        <p> Nom: <?= $cav['nom_personne'] ?> </p>
                    </div>
                    <div class="row justify-content-between">
                        <p> Prénom: <?= $cav['prenom_personne'] ?> </p>
                    </div>    
            </div>
        </div>

    </div>
</div>
