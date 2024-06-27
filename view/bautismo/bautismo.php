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
        <div class="background-image">
            <!-- Imagen de fondo -->
        </div>
        <div class="overlay"> <!-- Capa semitransparente -->
            <div class="container position-relative">
                <div class="row text-center">
                    <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 wow zoomIn heading-area"
                        data-wow-duration="1s" data-wow-delay=".1s">
                        <br>
                        <br>
                        <h3 class="heading text-center"> </h3> <span class="d-block font-Sofia-serif"> Bautismo</span>
                    </div>
                </div>
                <!--Heading-->
                <div class="row padding-top-half position-relative container-info">
                    <div class="row ">
                        <div class="col-md-4 mb-4">
                            <img src="../../public/vista/img/bautismo.png" class="img-fluid" alt="Imagen 2">
                        </div>
                        <div class="col-md-8 text-justify">
                            <h5>
                                El sacramento del Bautismo marca el inicio de la vida en la fe, representando una puerta
                                de
                                entrada
                                fundamental a la iglesia. Por tanto, es crucial que los padres estén debidamente
                                preparados al
                                solicitar este sacramento para sus hijos, renovando así el compromiso que en su momento
                                adquirieron
                                sus propios padres y padrinos. A través del Bautismo, se nos libera del Pecado Original,
                                nos
                                regeneramos como hijos de Dios, nos integramos a la comunidad católica, nos unimos a la
                                misión
                                de
                                Cristo y recibimos la promesa de la Vida Eterna.

                            </h5>
                        </div>
                        <div class="col-md-12 text-justify">
                            <h5>

                                <span class="underline">Procedimiento para solicitar el
                                    Bautismo:</span>
                                <br><br>

                                <li>&#8226; Realizar la solicitud en la oficina parroquial, por uno de los padres
                                    (tutores
                                    legales).
                                </li>
                                <br>
                                <li>&#8226; Presentar el Certificado de Nacimiento del niño que será bautizado.</li>
                                <br>
                                <li>&#8226; Certificado de confirmación de los padrinos, debidamente casados por la
                                    iglesia
                                    o solteros.
                                </li>
                                <br>
                                <li>&#8226; Los bautizos se llevarán a cabo sólo los días sábados entre las 11:00 y
                                    12:00
                                    hrs.</li>
                                <br>
                                <li>&#8226; Inscribirse en la oficina parroquial, idealmente en el mes de febrero,
                                    con
                                    su
                                    certificado de bautismo.</li>
                                <br>
                            </h5>
                        </div>
                        <!-- Pseudo-elemento para superposición de imagen de fondo semitransparente -->
                        <div class="background-overlay"></div>
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