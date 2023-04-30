<?php
    if (isset($_SESSION['connecte']) && $_SESSION['connecte'] === true && $_SESSION['type'] === 'a'){

    } else {
        header('Location: http://localhost/tp_centre_equestre/');
    }
    $pagename = "Modifier Cavalier " . $infosaved['prenom'] ." ". $infosaved['nom']; 
    require $headerpath; //Importe le header ('header.php')
?>

<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
</head>

<!-- Dialog box -->
<!-- Permet l'ouverture d'une boite de dialogue pour confirmer l'exécution d'une action -->

<!-- Valider modifications -->
<div id="dialog_modify" title="Appliquer les modification ?"></div>
<script>
    $(function() {
        $("#dialog_modify").dialog({ 
            minWidth: 250,
            autoOpen: false,
            modal: true,
            buttons: {
                Oui: function() {
                    document.getElementById('modify').click(); //Modification du cavalier quand dialog validé
                },
                Non: function() {
                    $(this).dialog("close");
                }
            },
            post: true
        });
        $("#opener_modify").click(function() {
            $("#dialog_modify").dialog("open");
        })
    });
</script>

<!-- Annuler modifications -->
<div id="dialog_cancel" title="Annuler les modifications ?"></div>
<script>
    $(function() {
        $("#dialog_cancel").dialog({ 
            minWidth: 250,
            autoOpen: false,
            modal: true,
            buttons: {
                Oui: function() {
                    document.getElementById('cancel').click(); //Modification du cavalier quand dialog validé
                },
                Non: function() {
                    $(this).dialog("close");
                }
            },
            post: true
        });
        $("#opener_cancel").click(function() {
            $("#dialog_cancel").dialog("open");
        })
    });
</script>
<!-- Dialog box -->

    <body>
        <div class="container">
            <h3 text-align="center">Modifier le profil de <b><?= $infosaved["prenom"]." ".$infosaved["nom"] ?></b></h3> <!-- Titre personnalisé -->
            <form method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="cav_id" value="<?= isset($infosaved["id_personne"]) ? $infosaved["id_personne"] : "" ;?>">
                <div>
                    <label for='id'></label>
                </div>

                <div class="row">
                    <div class="form-group col-4">
                        <label for="iPhotoCavalier">Photo</label>
                        <img  id="imgCavalier" src="<?= isset($infosaved) ? "http://localhost/tp_centre_equestre/media/".$infosaved['photoName'] : "http://localhost/tp_centre_equestre/media/choose-image.png" ?>" alt="" onclick="openFileDialog()">
                        <input type="file" name="photo" class="form-control" id="iPhotoCavalier" style="display:none;">
                        <input type="hidden" name="photoName" value="<?= $infosaved["photoName"] ?>">                        
                    </div>
                    <div class="form-group col">
                        <label for="iLicCavalier">N° Licence FFE*</label>
                        <input type="text" pattern="[A-Z]{7}[1-9]{1}" name="numlic" value="<?= isset($infosaved) ? $infosaved["numlic"] : "";  ?>" class="form-control" id="iLicCavalier" placeholder="7 lettres + 1 chiffre" required>
                    </div>
                    <div class="form-group col">
                        <label for="iSelectGalop">Galop*</label>
                        <select name="galop" class="form-select" id="iSelectGalop" required>
                            <option value=1 <?= (isset($infosaved["galop"]) && $infosaved["galop"] == "1") ? "selected" : "" ?>> Galop 1</option>
                            <option value=2 <?= (isset($infosaved["galop"]) && $infosaved["galop"] == "2") ? "selected" : "" ?>> Galop 2 </option>
                            <option value=3 <?= (isset($infosaved["galop"]) && $infosaved["galop"] == "3") ? "selected" : "" ?>> Galop 3 </option>
                            <option value=4 <?= (isset($infosaved["galop"]) && $infosaved["galop"] == "4") ? "selected" : "" ?>> Galop 4 </option>
                            <option value=5 <?= (isset($infosaved["galop"]) && $infosaved["galop"] == "5") ? "selected" : "" ?>> Galop 5 </option>
                            <option value=6 <?= (isset($infosaved["galop"]) && $infosaved["galop"] == "6") ? "selected" : "" ?>> Galop 6 </option>
                            <option value=7 <?= (isset($infosaved["galop"]) && $infosaved["galop"] == "7") ? "selected" : "" ?>> Galop 7 </option>
                        </select>
                    </div>
                </div>

                <div class="row justify-content-md-center">
                    <div class="form-group col">
                        <label for="nom">Nom</label>
                        <input type="text" id="cav_nom" name="cav_nom" value="<?= isset($infosaved) ? $infosaved["nom"] : "";  ?>" class="form-control">
                    </div>
                    <div class="form-group col">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="cav_prenom" name="cav_prenom" value="<?= isset($infosaved) ? $infosaved["prenom"] : "";  ?>" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col">
                        <label for="date">Date de Naissance</label>
                        <input type="date" id="cav_dna" name="cav_dna" value="<?= isset($infosaved) ? $infosaved["datenaissance"] : "";  ?>" class="form-control">
                    </div>
                    <div class="form-group col">
                        <label for="mail">Mail</label>
                        <input type="email" id="cav_mail" name="cav_mail" value="<?= isset($infosaved) ? $infosaved["mail"] : "";  ?>" class="form-control">
                    </div>
                    <div class="form-group col">
                        <label for="tel">Tel</label>
                        <input type="text" id="cav_tel" name="cav_tel" value="<?= isset($infosaved) ? $infosaved["tel"] : "";  ?>" class="form-control">
                    </div>
                </div>

                <input type="hidden" name="action" value="form">
                <input type="hidden" name="subaction" value="update">
                <input type="submit" id="modify" name="subaction" value="modify_validation" style="display: none;" /> <!-- Exécute la requête de modification si msg de confirmation validé-->
                <input type="submit" id="cancel" name="action" value="index" style="display: none"/> <!-- Retourne sur la page 'cav_index.php' -->  
            </form>
            <div>
                <input type="button" id="opener_cancel" value="Annuler" class="btn btn-primary">
                <input type="button" id="opener_modify" value="Modifier" class="btn btn-primary">
            </div>
            
        </div>

        <script>

        
    let iFile = document.getElementById('iPhotoCavalier')
    
    function openFileDialog()
    {
        iFile.click()
    }

    $(document).ready(function(){
    $(iFile).on('change', function(evt){
        var f = evt.target.files[0]; 
        if (f){
        var r = new FileReader();
        r.onload = function(e){  
            $('#imgCavalier').attr('src', e.target.result);        
            console.log(e.target.result);
        };
            r.readAsDataURL(f);
        } else 
        {
            console.log("failed");
        }
    });
});

</script>
    </body>
</html>