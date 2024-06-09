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
        <div class="container position-relative">
            <div class="row text-center">
                <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 wow zoomIn heading-area"
                    data-wow-duration="1s" data-wow-delay=".1s">
                    <br>
                    <br>
                    <h3 class="heading text-center"> </h3> <span class="d-block"> Confesión</span>
                </div>
            </div>
            <!--Heading-->
            <div class="row padding-top-half container-info">
                <h4>
                    El sacramento de la Confesión, Penitencia o Reconciliación, surge del misterio pascual. 
                    Y en la Confesión pedimos el perdón a Jesús por nuestros pecados, pensamientos contra los hermanos y
                    contra la Iglesia. Y es necesario pedir perdón a la Iglesia y a los hermanos en la persona del sacerdote.
                    ¿Cuándo ha sido la última vez que te has confesado? Si ha pasado mucho tiempo, no pierdas un día más.
                    <br><br>
                    <span class="underline">Procedimiento para solicitar la Confesión:</span>
                    <br><br>
                    <ul>
                        <li>&#8226; Realizar la solicitud en la oficina parroquial, por uno de los padres.</li><br>
                        <li>&#8226; Presentar el Certificado de Nacimiento del niño que será bautizado.</li><br>
                        <li>&#8226; Certificado de confirmación de los padrinos, debidamente casados o solteros.</li>
                        <br>
                        <li>&#8226; Los bautizos se llevarán a cabo solo los días sábados entre las 11:00 y 12:00 hrs.
                        </li>
                    </ul>
                </h4>
                <div class="background-overlay"></div>
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