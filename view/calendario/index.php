<?php
require_once("../../controller/initialize.php");

?>
<!DOCTYPE html>
<html lang="en">
    
    <?php 
            include_once("../partials/headCalendario.php");
    ?>
    <body data-spy="scroll" data-target=".navbar" data-offset="90">
        <?php 
            include_once("../partials/header.php");
        ?>
        <div class="container container-calendario">
            <div id="CalendarioWeb" style="padding: 3vh;"></div>
        </div>
        
        <?php 
            include_once("../partials/footer.php");
            include_once("../../public/linkCalendarios.php");
        ?>

        <script src="funcionescalendarioseguidores.js"></script>
    </body>

</html>

