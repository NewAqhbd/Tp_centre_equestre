<?php

require "header.php";

?>

<body>
<div class="container">
    <div class="row">
        
        <div class="col-6">
            <h5>Cavalier</h5>
            <form action="../controller/CavalierController.php" method="post">
                <input type="hidden" name="action" value="index">
                <input type="submit" value="INDEX">
            </form>
            <form action="../controller/CavalierController.php" method="post">
                <input type="hidden" name="action" value="form">
                <input type="hidden" name="subaction" value="new">
                <input type="submit" value="AJOUT">
            </form>
        </div>
        <div class="col-6">
            <h5>Representant</h5>
            
        </div>
        <div class="col-6">
            <h5>Pension</h5>
            
        </div>
        <div class="col-6"></div>
    </div>


</div>

</body>