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
                    <span class="d-block font-Sofia-serif"> Cementerio Parroquial</span><br>
                </div>
            </div>
            <!--Heading-->
            <div class="row  padding-top-half position-relative container-info">
                <div class="row ">
                    <div class="col-md-4 mb-4">
                        <img src="../../public/vista/img/cemen.jpg" class="img-fluid" alt="Imagen 2">
                    </div>
                    <div class="col-md-8 text-justify">
                        <h5>
                            Nuestra misión como Cementerio va más allá de brindar sepultura; nos esforzamos por crear un
                            ambiente de reflexión y recogimiento para toda la comunidad de Chocalán y sus alrededores.
                            También nos dedicamos a preservar nuestro patrimonio histórico y cultural, fortaleciendo
                            nuestra identidad local y urbana. Nos comprometemos a honrar el legado de quienes han pasado
                            y a mantener viva su memoria en nuestro campo santo, contribuyendo así a la comprensión y
                            apreciación de nuestra historia y cultura, así como a la conexión emocional y espiritual con
                            nuestra comunidad.
                        </h5>
                    </div>
                    <div class="col-md-12 text-justify">
                        <h5>

                            <span class="underline">Procedimientos para
                                sepultación:</span>
                            <br><br>
                            <ul>
                                <li>&#8226; Presentarse con el documento de dominio de la sepultura (escritura).
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