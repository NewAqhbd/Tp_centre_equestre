<?php
if (isset($_SESSION['connecte']) && $_SESSION['connecte'] === true && $_SESSION['type'] === 'a'){

} else {
    header('Location: http://localhost/tp_centre_equestre/');
}
$pagename = "Formulaire pour Pension";
require $headerpath;
?>

<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
</head>

<!-- Dialog box -->
<!-- Permet l'ouverture d'une boite de dialogue pour confirmer l'exécution d'une action -->
<!-- Valider modifications -->
<div id="dialog_create" title="Créer la pension ?"></div>
<div id="dialog_modify" title="Modifier la pension ?"></div>

<?php if(isset($update) && $update == true) { ?>
    <script>
        $(function() {
            $("#dialog_modify").dialog({ 
                minWidth: 250,
                autoOpen: false,
                modal: true,
                buttons: {
                    Oui: function() {
                        document.getElementById('modify').click(); //Modification du représentant quand dialog validé
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
<?php } else {?>
    <script>
        $(function() {
            $("#dialog_create").dialog({ 
                minWidth: 250,
                autoOpen: false,
                modal: true,
                buttons: {
                    Oui: function() {
                        document.getElementById('modify').click(); //Ajout du représentant quand dialog validé
                    },
                    Non: function() {
                        $(this).dialog("close");
                    }
                },
                post: true
            });

            $("#opener_modify").click(function() {
                $("#dialog_create").dialog("open");
            })
        });
    </script>
<?php } ?>
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
                    document.getElementById('cancel').click(); //Modification du représentant quand dialog validé
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
                    This is a danger alert—check it out! <?= $error ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_pension" value="<?= isset($infosaved["id_pension"]) ? $infosaved["id_pension"] : "" ;?>">
        <div class="row justify-content-md-center">
            <div class="form-group col">
                <label for="iTarifPension">Tarif mensuel*</label>
                <input type="number" min="0" name="tarif" value="<?= isset($infosaved) ? $infosaved["tarif"] : "";  ?>" class="form-control" id="iTarifPension" placeholder="" required>
            </div>
            <div class="form-group col">
                <label for="nom_cheval">Cheval sélectionné*</label>
                <input type="text" name="nom_cheval" id="nom_cheval" value="<?= isset($infosaved["nom_cheval"]) && $infosaved["nom_cheval"] != "" ? $infosaved["nom_cheval"] : "";  ?>" onkeyup = "autocomplete_che()" class="form-control" required>
                <input type="hidden" name="id_cheval" id="id_cheval" value="<?= isset($infosaved) && $infosaved["id_cheval"] != "" ? $infosaved["id_cheval"] : "";  ?>" class="form-control">
                <ul id="list_cheval"></ul>
            </div>
            <div class="form-group col">
                <label for="nom_cavalier">Cavalier bénéficiaire</label>
                <input type="text" name="nom_cavalier" id="nom_cavalier" value="<?= isset($infosaved["nom_cavalier"]) && $infosaved["nom_cavalier"] != "" ? $infosaved["nom_cavalier"] : "";  ?>" onkeyup = "autocomplete_cav()" class="form-control">
                <input type="hidden" name="id_cavalier" id="id_cavalier" value="<?= isset($infosaved["id_cavalier"]) && $infosaved["id_cavalier"] != "" ? $infosaved["id_cavalier"] : "";  ?>" class="form-control">
                <input type="hidden" name="id_old_cav" id="id_old_cav" value="<?= isset($oldCav) && $oldCav != "" ? $oldCav : "";  ?>" class="form-control">
                <ul id="list_cavalier"></ul>
            </div>
            <div class="form-group col-2">
                <label for="iLibellePension">Libelle*</label>
                <select name="libelle" class="form-select" id="iLibellePension" required>
                    <option value="" <?= (isset($infosaved["libelle"]) && $infosaved["libelle"] == "") ? "selected" : "" ?>></option>
                    <option value="Pension" <?= (isset($infosaved["libelle"]) && $infosaved["libelle"] == "Pension") ? "selected" : "" ?>>Pension</option>
                    <option value="Demi-pension" <?= (isset($infosaved["libelle"]) && $infosaved["libelle"] == "Demi-pension") ? "selected" : "" ?>>Demi-pension</option>
                </select>
                <!--<input type="text" name="libelle" value="<?= isset($infosaved) ? $infosaved["libelle"] : "";  ?>" class="form-control" id="iLibellePension" placeholder="" required>-->
            </div>
        </div>
        <div class="row">

            <div class="form-group col">
                <label for="iDatePension">Début de la pension*</label>
                <input type="date" name="date_de_debut" value="<?= isset($infosaved) ? $infosaved["date_de_debut"] : "";  ?>" class="form-control" id="iDatePension" placeholder="" required>
            </div>
            <div class="form-group col">
                <label for="iDuree">Durée (en mois)*</label>
                <input type="number" min="1" name="duree" value="<?= isset($infosaved) ? $infosaved["duree"] : "";  ?>" class="form-control" id="iDuree" placeholder="" required>
            </div>
        </div>

        <?php if(isset($update) && $update == true ){ ?>
            <input type="hidden" name="subaction" value="update">
        <?php  } ?>

        <input type="hidden" name="action" value="form">
        <input type="submit" id="modify" style="display: none;" />
    </form> 
    <form action="" method="POST">
        <input type="submit" id="cancel" name="action" value="index" style="display: none;" />
    </form>
    <div>
        <input type="button" id="opener_cancel" value="Annuler" class="btn btn-primary">
        <?php if($_POST["subaction"] == "new"){ ?>
            <input type="button" id="opener_modify" value="Créer" class="btn btn-primary">
        <?php } ?>
        <?php if($_POST["subaction"] == "modify"){ ?>
            <input type="button" id="opener_modify" value="Modifier" class="btn btn-primary">
        <?php } ?>
        
    </div>

</div>

<script> 
$(function (){
    $("libelle").selectmenu(); 
});

function setInputValueChe(e){
    //console.log(list);
    $("#id_cheval").val(e.getAttribute('value'));
    $("#nom_cheval").val(e.innerHTML);
    $("#list_cheval").hide();
}

function autocomplete_che(){
    var min_length = 2;
    var keyword = $("#nom_cheval").val();

    if (keyword.length >= min_length) {
        $.ajax({
            method: "POST",
            url: "../inc/autocomplete_che.php",
            data : {keyword :keyword},
            success:function(data){
                $('#list_cheval').show();
                $('#list_cheval').html(data);
            }
        });
    }
}

function setInputValueCav(e){
    //console.log(list);
    $("#id_cavalier").val(e.getAttribute('value'));
    $("#nom_cavalier").val(e.innerHTML);
    $("#list_cavalier").hide();
}

function autocomplete_cav(){
    var min_length = 2;
    var keyword = $("#nom_cavalier").val();

    if (keyword.length >= min_length) {
        $.ajax({
            method: "POST",
            url: "../inc/autocomplete.php",
            data : {keyword :keyword},
            success:function(data){
                $('#list_cavalier').show();
                $('#list_cavalier').html(data);
            }
        });
    }
}

</script>
</body>