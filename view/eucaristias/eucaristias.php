<!DOCTYPE html>
<html lang="en">

<!-- Incluye el head -->
<?php 
include_once("../partials/headCalendario.php");
?>

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
                    <h3 class="heading text-center"> </h3> <span class="d-block font-Sofia-serif"> Eucaristías</span>
                </div>
            </div>
            <!--Heading-->
            <div class="row  padding-top-half container-info">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <img src="../../public/vista/img/euc.jpg" class="img-fluid" alt="Imagen 2">
                    </div>
                    <div class="col-md-8 text-justify">
                        <h4>
                            En nuestras Eucaristías, experimentamos la presencia viva de Cristo en el pan y el vino
                            consagrados, y recibimos su gracia y su amor de manera tangible. Es un momento de renovación
                            espiritual, donde nos unimos como hermanos y hermanas en Cristo para alabar, agradecer y
                            suplicar al Señor.
                            <br>
                            Nuestra Parroquia complace en anunciar las Eucaristías que se
                            celebran regularmente en nuestro santuario y en nuestras 27 capillas ubicadas en la zona de
                            Chocalán y
                            sus alrededores. Estas sagradas celebraciones son momentos de encuentro con Cristo en la
                            Santa Eucaristía, donde la comunidad se reúne para compartir la Palabra de Dios, la comunión
                            fraterna y la adoración.
                            <br>
                            Nuestro calendario de Eucaristías ofrece una variedad de horarios y ubicaciones para
                            que todos los fieles puedan participar y enriquecer su vida espiritual. Desde las
                            solemnidades litúrgicas hasta las misas diarias,
                        </h4>

                    </div>
                    <div class="col-md-12 text-justify">
                        <h4>
                            cada celebración está cuidadosamente
                            organizada para nutrir y fortalecer la fe de nuestra comunidad.
                            <br>
                            Invitamos a todos los fieles a unirse a nosotros en estas celebraciones sagradas, donde
                            encontrarán consuelo, esperanza y renovación para sus almas. Que la Eucaristía sea para
                            nosotros el alimento que fortalece nuestro camino de fé y nos impulsa a vivir como
                            discípulos de Cristo en el mundo.
                            <br>
                            Revise aquí nuestro calendario de Eucaristías para conocer los horarios y ubicaciones de
                            las celebraciones en nuestra parroquia y capillas. Esperamos darle la bienvenida y compartir
                            juntos la mesa del Señor.
                        </h4>

                    </div>
                    <div data-spy="scroll" data-target=".navbar" data-offset="90">
                        

                            <div class="container container-calendario">
                                <div id="CalendarioWeb" style="padding: 3vh;"></div>
                            </div>

                    </div>
                </div>
    </section>


    <!-- Incluye footer -->
    <?php include_once '../partials/footer.php'; 
    include_once("../../public/linkCalendarios.php");?>
    <script src="funcionescalendarioseguidores.js"></script>
    
</body>

</html>