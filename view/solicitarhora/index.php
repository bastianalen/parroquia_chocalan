<?php
require_once("../../controller/initialize.php");

// Obtiene los tipos de servicios
$tiposervicio = new TipoServicio();
$tipo_servicios = $tiposervicio->listoftiposervicio();
?>

<!DOCTYPE html>
<html lang="en">
    
    <!-- Incluye el head -->
    <?php include_once '../partials/head.php'; ?>
    
    <!-- Importes exclusivos -->
    <link rel="stylesheet" href="solicitarhora.css">
    <script src="solicitarhora.js"></script>
    
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
                    <span class="d-block font-Sofia-serif">Solicitar Servicio</span>
                </div>
            </div>
            <!--Heading-->
            <div class="row  padding-top-half position-relative container-info">
                <div class="row container">
                        <div class="content">
                            <div class="heading-area text-center">
                                <h3 class="heading"><span class="d-block d-block-heading font-Sofia-serif tipo-servicio"> </span>
                                </h3>
                            </div>
                            <div class="row justify-content-center container-input-form">
                                <div class="col-12 col-lg-10 text-center text-lg-left d-flex align-items-center mb-4">
                                    <!-- Formulario para solicitar un servicio -->
                                    <form class="row contact-form wow fadeInLeft mx-4 p-2 box box-form" id="contact-form-data" action="../../controller/controllerSolicitudHora.php?action=add" method="POST">
                                        <div class="col-12 col-lg-12 px-md-0 text-center">
                                            <input type="text" name="userName" placeholder="Nombre" class="form-control input-info">
                                            
                                            <input type="email" name="userEmail" placeholder="E-mail" class="form-control input-info">
                                            
                                            <input type="date" name="fecha" id="fecha" placeholder="01/01/2024" class="form-control input-info">
                                            
                                            <input type="text" name="userPhone" id="userPhone" placeholder="+569 12345678" class="form-control input-info">

                                            <select id="hora_solicitud" name="hora_solicitud" class="form-control">
                                                <option value="0" class="optionhora">Seleccione hora de atención</option>

                                            </select>

                                            <select id="tipo_servicio" name="tipo_servicio" class="form-control">
                                                <option value="0" class="option">Seleccione tipo de servicio</option>
                                                <?php
                                                foreach ($tipo_servicios as $tipo_servicio) {
                                                    echo '<option value="'. $tipo_servicio['id_servicio'] . '" class="option">' . $tipo_servicio['tipo'] .'</option>';
                                                }
                                                ?>
                                            </select>

                                            <input type="hidden" name="estado_solicitud" value=1>

                                            <textarea class="form-control text-area-form" name="userMessage" rows="6"
                                                placeholder="Escríbenos tu mensaje!"></textarea>
                                            <a href="javascript:void(0);" class="btn btn-medium btn-rounded btn-gradient rounded-pill w-100 contact_btn main-font" name="save" type="submit">
                                                <span class="fa fa-save fw-fa"></span> 
                                                Guardar
                                            </a>
                                            <!-- <button class="btn btn-medium btn-rounded btn-gradient rounded-pill w-100 contact_btn main-font" name="save" type="submit"><span class="fa fa-save fw-fa"></span> Guardar</button> -->
                                        </div>
                                        <br>
                                    </form>
                                </div>
                            </div>
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