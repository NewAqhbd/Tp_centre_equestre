<?php

$pagename = "Nos chevaux";
require_once '../inc/bdd.inc.php';
require "../vue/header.php";

?>

<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<h3><span class="d-inline-block wow slideInDown" style="margin: 2rem 0 3rem 2rem">Les chevaux</span></h3>

<div class="row" style="margin-left: auto; margin-right: auto;">
    <?php 
    foreach($data as $che){ ?>
        <div class="col-sm-4" style="margin-bottom: 1rem;">
            <div class="card" style="width: 16rem;">
                <img class="card-img-top" src="<?= '../media/' . $che['photo_cheval']?>" alt="Image de cheval">
                <div class="card-body">
                    <h5 class="card-title"><?= $che['nom_cheval']?></h5>
                    <form action="" method="post">
                        <input type="hidden" name="che_id" value="<?= $che['id_cheval']?>">
                        <input type="hidden" name="action" value="che_details">
                        <input type="hidden" name="che_details">
                        <input type="submit" class="btn btn-primary" value="Afficher le cheval">
                    </form>
                    
                </div>
            </div>
        </div>
    <?php } ?>
</div>




