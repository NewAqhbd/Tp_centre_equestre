<?php
if (isset($_SESSION['connecte']) && $_SESSION['connecte'] === true && $_SESSION['type'] === 'a'){

} else {
    header('Location: http://localhost/tp_centre_equestre/');
}
$pagename = "Robes";
require $headerpath;
?>

<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#rob_list').DataTable();
        });   
    </script>
</head>

<body>
    
</body>
</html>
<p>Liste des robes</p>
<table id="rob_list">
    <thead>
        <tr>
            <th>Libelle</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(isset($data) && $data !== null){
            foreach ($data as $rob) {
        ?>
        <!-- Dialog box -->
        <!-- Permet l'ouverture d'une boite de dialogue pour confirmer l'exécution d'une action -->
        <div id="dialog_del<?= $rob["id_robe"]; ?>" title="Voulez-vous réellement SUPPRIMER cette robe ?"></div>
            <script>
                $(function() {
                    $("#dialog_del<?= $rob["id_robe"]; ?>").dialog({ 
                        minWidth: 520,
                        autoOpen: false,
                        modal: true,
                        buttons: {
                            Oui: function() {
                                document.getElementById('delete<?= $rob["id_robe"]; ?>').click(); //Exécution de la suppression quand dialog validé
                            },
                            Non: function() {
                                $(this).dialog("close");
                            }
                        },
                        post: true
                    });
                    $("#opener_del<?= $rob["id_robe"]; ?>").click(function() {
                        $("#dialog_del<?= $rob["id_robe"]; ?>").dialog("open");
                    })
                });
            </script>
        <!-- Dialog box -->

                    <tr>
                        <td><?= $rob["libelle_robe"] ?></td>

                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="rob_id" value="<?= $rob["id_robe"]; ?>">
                                <input type="hidden" name="action" value="form">
                                <input type="hidden" name="subaction" value="modify">
                                <input type="submit" value="Modifier">
                            </form>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="rob_id" value="<?= $rob["id_robe"]; ?>">
                                <input type="hidden" name="action" value="delete">
                                <input type="submit" id="delete<?= $rob["id_robe"]; ?>" name="delete" style="display: none">
                            </form>
                            <input id="opener_del<?= $rob["id_robe"]; ?>" type="submit" value="Supprimer">

                        </td>
                    </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
    <!--  CDN  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#rob_list').DataTable();
        });   
    </script>
