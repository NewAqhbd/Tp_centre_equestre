<?php
if (isset($_SESSION['connecte']) && $_SESSION['connecte'] === true && $_SESSION['type'] === 'a'){

} else {
    header('Location: http://localhost/tp_centre_equestre/');
}
$pagename = "Inscriptions";
require $headerpath;
?>

<body>
    
</body>
</html>
<p>Liste des Inscriptions</p>
<table id="ins_list">
    <thead>
        <tr>
            <th>Cavalier</th>
            <th>Cottisation Club</th>
            <th>Cottisation FFE</th>
            <th>Date</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(isset($data) && $data !== null){
            foreach ($data as $ins) {
                $sql = "SELECT nom_personne FROM personne WHERE id_personne = :id";
                $req = $con->prepare($sql);
                $req->bindValue(":id", $ins["id_cav"], PDO::PARAM_INT);
                try {
                    $req->execute();
                } catch (PDOException $e){
                    return $e->getMessage();
                }
                $nom = $req->fetchColumn();

                ?>
                    <tr>
                        <td><?= $nom ?></td>
                        <td><?= $ins["montant_cotisation"] ?>€</td>
                        <td><?= $ins["montant_ffe"] ?>€</td>
                        <td><?= date('d/m/Y', strtotime($ins["annee"])) ?></td>

                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="ins_id" value="<?= $ins["id_inscription"]; ?>">
                                <input type="hidden" name="action" value="form">
                                <input type="hidden" name="subaction" value="modify">
                                <input type="submit" value="Modifier">
                            </form>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="ins_id" value="<?= $ins["id_inscription"]; ?>">
                                <input type="hidden" name="action" value="delete">
                                <input type="submit" value="Supprimer">
                            </form>
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
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#ins_list').DataTable();
        });   
    </script>
