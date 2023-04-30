<?php
if (isset($_SESSION['connecte']) && $_SESSION['connecte'] === true && $_SESSION['type'] === 'a'){

} else {
    header('Location: http://localhost/tp_centre_equestre/');
}
$pagename = "Formulaire pour Robes";
require $headerpath;
?>
<body>
    <style>
        .collapse.in{
            display: block;
        }
    </style>
<div class="container">
    <?php if(isset($error) && $error != ""){  ?>
        <div class="row justify-content-center" >
            <div class="col-6" role="alert">
                <div class="alert alert-danger" style="border:1px solid red;" role="alert">
                    <?= $error ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <form action="" method="POST">

            <input type="hidden" name="id_rob" value="<?= isset($_POST["rob_id"]) ? $_POST["rob_id"] : "" ;?>">

            <!-- Input Cottisation  * 2 -->
            <div class="form-group col">
                <label for="iCotisationIns">Libelle de la Robe*</label>
                <input type="text" name="libelle_rob" id="iLibelleRob" value="<?= isset($infosaved["libelle_rob"]) ? $infosaved["libelle_rob"] : "";  ?>" required>
            </div>

            <?php if(isset($update) && $update == true ){ ?>
                <input type="hidden" name="subaction" value="update">
            <?php  } ?>
            <input type="hidden" name="action" value="form">
            <input type="submit" value="Appliquer" class="btn btn-primary">
    </form> 

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="../../inc/script/js/jquery-ui.min.js"></script>

</body>