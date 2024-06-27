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
                    <h3 class="heading text-center"> </h3> <span class="d-block font-Sofia-serif"> Velatorio</span>
                </div>
            </div>
            <!--Heading-->
            <div class="row  padding-top-half container-info">
                <div class="row ">
                    <div class="col-md-4 mb-4">
                        <img src="../../public/vista/img/velatorio.png" class="img-fluid" alt="Imagen 2">
                    </div>
                    <div class="col-md-8 text-justify">
                        <h5>
                            Nuestro velatorio es un lugar de encuentro, donde las lágrimas encuentran consuelo en la
                            oración y el amor fraterno de nuestra comunidad parroquial. Aquí, en este sagrado recinto,
                            les ofrecemos un ambiente sereno y acogedor, donde puedan reflexionar sobre el legado de
                            amor y bondad dejado por sus seres queridos.
                            <br>
                            Nos comprometemos a acompañarles en este difícil momento, recordándoles que la luz de la fé
                            y la esperanza brilla eternamente en el corazón de aquellos que han partido, guiándoles
                            hacia la paz y el consuelo que solo Dios puede brindar.
                            </ul>
                        </h5>
                    </div>
                    <div class="col-md-12 text-justify">
                        <h5>
                            <span class="underline">Procedimientos para acceder a velatorio:</span>
                            <br><br>
                            <ul>
                                <li>&#8226; Rellenar formulario de solicitud de servicio.
                                </li>
                            </ul>
                        </h5>

                    </div>
                    <div class="col-md-2 mb-4 about-media wow fadeInUp padding-20-0 center centrar">
                        <a href="../solicitarhora/index.php" style="text-decoration: none;">
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