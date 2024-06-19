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
                    <h3 class="heading text-center"> </h3> <span class="d-block font-Sofia-serif"> Visita a
                        Enfermos</span>
                </div>
            </div>
            <!--Heading-->
            <div class="row  padding-top-half container-info">
                <div class="row ">
                    <div class="col-md-4 mb-4">
                        <img src="../../public/vista/img/visita.png" class="img-fluid" alt="Imagen 2">
                    </div>
                    <div class="col-md-8 text-justify">
                        <h5>
                            Nuestra parroquia se complace en ofrecer un servicio de
                            visita a los enfermos a todos aquellos que lo necesiten en nuestra comunidad. Reconocemos
                            que la enfermedad puede ser una experiencia desafiante y a menudo solitaria, y estamos aquí
                            para brindar apoyo, consuelo y compañía en estos momentos difíciles.
                            <br>
                            Entendemos que cada situación es única y personal, por lo que nos comprometemos a adaptarnos
                            a las necesidades individuales de cada persona que visitamos, ya sea para ofrecer una
                            palabra de aliento o cualquier otra forma de apoyo que se necesite.
                        </h5>
                    </div>
                    <div class="col-md-12 text-justify">
                        <h5>
                            <span class="underline">Procedimientos para solicitar una visita:</span>
                            <br><br>
                            <ul>
                                <li>&#8226; Rellenar formulario de solicitud de servicio.</li>
                                <br>
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