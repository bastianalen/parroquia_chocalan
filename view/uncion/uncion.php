<!DOCTYPE html>
<html lang="en">

<!-- Incluye el head -->
<?php include_once '../partials/head.php'; ?>

<body data-spy="scroll" data-target=".navbar" data-offset="90">
    
    <!-- Incluye el header -->
    <?php include_once '../partials/loader.php'; ?>
    <!-- Incluye el header -->
    <?php include_once '../partials/header.php'; ?>


    <section id="sacramentos" class="about-sec">
        <div class="container">
            <div class="row text-center">
                <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 wow zoomIn heading-area"
                    data-wow-duration="1s" data-wow-delay=".1s">
                    <br>
                    <br>
                    <h3 class="heading text-center"> </h3> <span class="d-block font-Sofia-serif"> Unción De Los Enfermos</span>
                </div>
            </div>
            <!--Heading-->
            <div class="row padding-top-half container-info">
                <div class="col-md-4 mb-4">
                    <img src="../../public/vista/img/bendicion.jpg" class="img-fluid" alt="Imagen 2">
                </div>
                <div class="col-md-8 text-justify">
                    <h4>
                        El sacramento de la unción de los enfermos  es un rito en el que un sacerdote o un obispo unge con aceite a una persona enferma,
                        mayor o en riesgo de morir. Este gesto representa la ayuda especial que Dios brinda al enfermo para darle fuerzas y 
                        consuelo durante su enfermedad, preparándolo para encontrarse con Dios. 
                        La Iglesia enseña que Jesucristo instituyó este sacramento en beneficio de todo el pueblo fiel.  
                    </h4>
                </div>
                <div class="col-md-12 text-justify">
                    <h4>
                        <span class="underline">Procedimiento para solicitar la Unción de los Enfermos:</span>
                        <br><br>
                        <ul>
                            <li>&#8226; Realizar la solicitud en la oficina parroquial o directamente con el sacerdote.</li><br>
                            <li>&#8226; Solo el sacerdote o el obispo están autorizados para administrar este sacramento.</li><br>
                            <li>&#8226; El párroco puede administrar la unción a los enfermos graves, ya sea en la iglesia o en su hogar.</li><br>
                        </ul>
                    </h4>
                </div>
                <div class="col-md-2 mb-4 about-media wow fadeInUp padding-20-0 center centrar">
                    <a href="../solicitarhora/index.php">
                        <span class="about-icon">
                            <i class="las la-calendar"></i>
                        </span>
                        <h4 class="small-heading font-Sofia-serif ">Solicitar Hora</h4>
                        <br>
                        <span class="ex-line"></span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End About -->


    <!-- Incluye footer -->
    <?php include_once '../partials/footer.php'; ?>
    
    <!-- General js CUSTOM JS -->
    <?php
     include_once '../../public/linkScript.php'; 
     ?>
</body>

</html>