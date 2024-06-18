<?php 
include_once("public/vendor/contact-mailer.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <!-- Author -->
    <meta name="author" content="Themes Industry">
    <!-- Description -->
    <meta name="description" content="">
    <!-- Page Title -->
    <title>Parroquia Chocalán</title>
    <!-- General links-->
    <!-- Favicon -->
    <link href="public/vista/img/logosinletras.png" rel="icon">
    <!-- Bundle -->
    <link rel="stylesheet" href="public/vendor/css/bundle.min.css">
    <!-- Plugin Css -->
    <link href="public/vendor/css/LineIcons.min.css" rel="stylesheet">
    <link href="public/vendor/css/jquery.fancybox.min.css" rel="stylesheet">
    <link href="public/vendor/css/owl.carousel.min.css" rel="stylesheet">
    <link href="public/vendor/css/cubeportfolio.min.css" rel="stylesheet">
    <link href="public/vendor/css/wow.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofia&display=swap" rel="stylesheet">
    <!-- Style Sheet -->
    <link href="public/vista/css/line-awesome.min.css" rel="stylesheet">
    <link href="public/vista/css/style.css" rel="stylesheet">
     <!-- logo de transbank -->
     <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
     <!-- CSS DONACIONES -->
    <link href="public/css/cssdonaciones.css" rel="stylesheet">

    <!-- Personal link -->
    <link rel="stylesheet" href="styleIndex.css">
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="90">
    <!-- Start Loader -->
    <div class="loader">
        <div class="indicator">
            <img src="public/vista/img/logito.jpg" alt="Logo" class="img-load">
        </div>
    </div>
    <!-- End Loader -->
    <!-- Start Header -->
    <header id="home" class="header-style4 header-style8">
        <div class="upper-nav">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-lg-6 mt-auto mb-auto">

                        <div class="toggle-btn d-block font-Sofia-serif d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <a class="navbar-brand scroll nav-logo d-inline-block d-lg-none" href="index.php">
                            <img src="public/vista/img/logosinletras.png" alt="logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="lower-nav lower-nav-style4" class="div-crem-color">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light d-none d-lg-block">
                    <div class="main-nav collapse navbar-collapse d-flex">
                        <a class="navbar-brand scroll" href="index.php#home">
                            <img src="public/vista/img/logosinletras.png" alt="logo">
                        </a>
                        <ul class="navbar-nav right-nav d-flex  ml-auto">
                            <li class="nav-item">
                                <a class="nav-link scroll nav-link-specific font-Sofia-serif" href="#home">Parroquia</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link scroll nav-link-specific font-Sofia-serif"
                                    href="#about-sec">Historia</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link scroll nav-link-specific font-Sofia-serif"
                                    href="#servicios">Servicios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link scroll nav-link-specific font-Sofia-serif"
                                    href="#sacramentos">Sacramentos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link scroll nav-link-specific font-Sofia-serif"
                                    href="#patientgallery">Capillas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link scroll nav-link-specific font-Sofia-serif"
                                    href="#personal">Personal</a>
                            </li>
                            <!-- se agrega el apartado de donaciones donde se implementara pagos por api de webpay -->
                            <li class="nav-item">
                                <a class="nav-link scroll nav-link-specific font-Sofia-serif" href="">Donaciones</a>
                            </li>
                            <!-- Redirige a la vista del calendario -->
                            <li class="nav-item">
                                <a class="nav-link nav-link-specific font-Sofia-serif"
                                    href="view/calendario/index.php">Calendario</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link scroll nav-link-specific font-Sofia-serif"
                                    href="#contact">Contacto</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="toggle-btn toggle-btn-lg d-none d-lg-block">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="broad div-crem-color">
            <div class="close-nav"><i class="las la-times"></i></div>
            <nav class="navbar navbar-light">
                <div class="main-nav collapse navbar-collapse d-flex justify-content-center align-items-center">
                    <ul class="navbar-nav text-center">
                        <li class="nav-item">
                            <a class="nav-link nav-link-specific font-Sofia-serif" href="view/admin/login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scroll nav-link-specific font-Sofia-serif" href="#home">Parroquia</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scroll nav-link-specific font-Sofia-serif" href="#about-sec">Historia</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scroll nav-link-specific font-Sofia-serif"
                                href="#servicios">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scroll nav-link-specific font-Sofia-serif"
                                href="#sacramentos">Sacramentos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scroll nav-link-specific font-Sofia-serif"
                                href="#patientgallery">Capillas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scroll nav-link-specific font-Sofia-serif" href="#personal">Personal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scroll nav-link-specific font-Sofia-serif" href="">Donaciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scroll nav-link-specific font-Sofia-serif"
                                href="view/calendario/index.php">Calendario</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link scroll nav-link-specific font-Sofia-serif" href="#contact">Contacto</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <a id="close_side_menu" class="close_side_menu" href="javascript:void(0);"></a>
    </header>
    <section id="home" class="parro">
        <div class="row ">
            <div class="background-overlay ">
            </div>
            <div class="row">
                <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 wow zoomIn heading-area text-left"
                    data-wow-duration="1s" data-wow-delay=".1s">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <h3 class="heading text-black"> </h3>
                    <span class="d-block font-Sofia-serif text-black font-weight-bold"> Parroquia</span>
                    <br>
                    <h3 class="heading font-Sofia-serif text-black font-weight-bold subtitle"> Santa Rosa de Lima,
                        Chocalán</span>
                </div>
            </div>
        </div>
    </section>

    <section id="about-sec" class="about-sec back-fff">
        <div class="container">
            <!--Heading-->
            <div class="row text-center">
                <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 wow zoomIn heading-area"
                    data-wow-duration="1s" data-wow-delay=".1s">
                    <h3 class="heading text-center"> <span
                            class="d-block font-Sofia-serif d-block-heading">Historia</span>
                    </h3>
                    <p class="text text-center font-Sofia-serif">El terreno de la parroquia fue generosamente donado por
                        Doña Carmen Lecaros, quien destinó la propiedad para usos litúrgicos y religiosos. Tras su
                        fallecimiento en 1836, fue enterrada en su propia iglesia, a la derecha del altar. Doña Carmen
                        no tuvo hijos, por lo que heredó la hacienda a su sobrina, Doña Rosana Valdés de Solar.
                        <br>
                        En 1863,
                        Doña Rosana inauguró la segunda iglesia y la casa de ejercicios, continuando con la obra de su
                        tía. En 1875, Doña Rosana Valdés renunció a la herencia para compensar los años en que no hubo
                        servicio eclesiástico debido a la construcción de la iglesia. Ella cedió la propiedad al primer
                        capellán, Padre Emilio Larli, el primer sacerdote residente en Chocalán y administrador de la
                        casa de ejercicios.
                        <br>
                        En 1893, José Luis Villanueva capellán tambien, llevó una solicitud al arzobispado para que la
                        capilla fuera elevada al rango de parroquia. Tras verificar que se cumplían todas las
                        condiciones necesarias, la solicitud fue aceptada, y la iglesia fue oficialmente convertida en
                        parroquia. Aunque la iglesia original fue destruida en el terremoto de 1985, sobrevivieron su
                        campanario y su cruz original. Estos elementos históricos se preservaron en la reconstrucción de
                        la iglesia.
                        <br>
                        Finalmente, el 6 de septiembre de 1909, se fundó la Parroquia Santa Rosa de Lima de
                        Chocalán. Desde entonces, ha sido un pilar de la comunidad, sirviendo a los fieles y manteniendo
                        viva la herencia de sus fundadoras. La Parroquia Santa Rosa de Lima de Chocalán no solo es un
                        lugar de culto, sino también un símbolo de la devoción y la generosidad de las mujeres que la
                        fundaron y cuidaron.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End Header -->
    <section id="servicios" class="team-sec">
        <div class="container">
            <div class="row text-center">
                <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 wow zoomIn heading-area">
                    <div class="team-detail-sec wow fadeInLeft">
                        <!--Heading-->
                        <div class="heading-area">
                            <h3 class="heading"><span class="d-block-heading font-Sofia-serif">Servicios</span>
                        </div>
                    </div>

                </div>
            </div>

            <p class="text text-center font-Sofia-serif">Nos complace ofrecer una variedad de servicios para nuestra
                comunidad, desde brindar
                consuelo en tiempos de duelo hasta celebrar la vida y la fé a través de nuestras eucaristías, estamos
                aquí para servir con compasión, amor y fé. <br> Nuestro compromiso es ser un faro de luz y esperanza,
                extendiendo la bendición divina a cada hogar y corazón necesitado.</p><br>

            <div class="row justify-content-center mt-4">

                <div class="col-md-2 mb-4">
                    <div class="center">
                        <a href="view/cementerio/cementerio.php">
                            <img src="public/vista/img/cemen.jpg" class="servicio" alt="...">
                        </a>
                        <div class="image-caption font-Sofia-serif">
                            Cementerio
                        </div>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <div class="center">
                        <a href="view/velatorio/velatorio.php">
                            <img src="public/vista/img/velatorio.png" class="servicio" alt="...">
                        </a>
                        <div class="image-caption font-Sofia-serif">
                            Velatorio
                        </div>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <div class="center">
                        <a href="view/corona/corona.php">
                            <img src="public/vista/img/corona.png" class="servicio" alt="...">
                        </a>
                        <div class="image-caption font-Sofia-serif">Corona
                            de Caridad
                        </div>
                    </div>
                </div>

                <div class="col-md-2 mb-4">
                    <div class="center">
                        <a href="view/visita/visita.php">
                            <img src="public/vista/img/visita.png" class="servicio" alt="...">
                        </a>
                        <div class="image-caption font-Sofia-serif">Visita
                            a Enfermos
                        </div>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <div class="center">
                        <a href="view/bendicion/bendicion.php">
                            <img src="public/vista/img/bendicion.jpg" class="servicio" alt="...">
                        </a>
                        <div class="image-caption font-Sofia-serif">
                            Bendición a Hogares
                        </div>
                    </div>
                </div>

                <div class="col-md-2 mb-4">
                    <div class="center">
                        <a href="view/eucaristias/eucaristias.php">
                            <img src="public/vista/img/euc.jpg" class="servicio" alt="...">
                        </a>
                        <div class="image-caption font-Sofia-serif">
                            Eucaristías
                        </div>
                    </div>
                </div>
                <br><br>
            </div>
        </div>
    </section>

    <section id="sacramentos" class="about-sec back-fff">
        <div class="container">
            <div class="row text-center">
                <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 wow zoomIn heading-area"
                    data-wow-duration="1s" data-wow-delay=".1s">
                    <h3 class="heading text-center"> </h3>
                    <span class="d-block d-block-heading font-Sofia-serif">Sacramentos</span>
                </div>
            </div>
            <br>
            <p class="text text-center font-Sofia-serif">Los sacramentos sagrados son pilares fundamentales en la vida
                espiritual de nuestros
                fieles. A través de estos, acompañamos a nuestra querida comunidad en su camino de fé y crecimiento
                espiritual, fortaleciendo su vínculo con Dios y la comunidad cristiana.</p>

            <!--Heading-->
            <div class="row text-center padding-top-half">
                <div class="col-md-2 mb-4 about-media wow fadeInUp padding-20-0">
                    <a href="view/bautismo/bautismo.php">
                        <span class="about-icon">
                            <i class="las la-dove"></i>
                        </span>
                        <h4 class="small-heading font-Sofia-serif ">Bautismo</h4>
                        <br>
                        <span class="ex-line"></span>
                    </a>
                </div>
                <div class="col-md-2 mb-4 about-media wow fadeInUp padding-20-0">
                    <a href="view/matrimonio/matrimonio.php">
                        <span class="about-icon">
                            <i class="las la-ring"></i>
                        </span>
                        <h4 class="small-heading font-Sofia-serif ">Matrimonio</h4>
                        <br>
                        <span class="ex-line"></span>
                    </a>
                </div>
                <div class="col-md-2 mb-4 about-media wow fadeInUp padding-20-0">
                    <a href="view/primeracomunion/primeracomunion.php">
                        <span class="about-icon">
                            <i class="las la-praying-hands"></i>
                        </span>
                        <h4 class="small-heading font-Sofia-serif ">Primera comunión</h4>
                        <span class="ex-line"></span>
                    </a>
                </div>
                <div class="col-md-2 mb-4 about-media wow fadeInUp padding-20-0">
                    <a href="view/confirmacion/confirmacion.php">
                        <span class="about-icon">
                            <i class="las la-bible"></i>
                        </span>
                        <h4 class="small-heading font-Sofia-serif ">Confirmación</h4>
                        <br>
                        <span class="ex-line"></span>
                    </a>
                </div>
                <div class="col-md-2 mb-4 about-media wow fadeInUp padding-20-0">
                    <a href="view/uncion/uncion.php">
                        <span class="about-icon">
                            <i class="las la-cross"></i>
                        </span>
                        <h4 class="small-heading font-Sofia-serif ">Unción de los enfermos</h4>
                        <span class="ex-line"></span>
                    </a>
                </div>
                <div class="col-md-2 mb-4 about-media wow fadeInUp padding-20-0">
                    <a href="view/confesion/confesion.php">
                        <span class="about-icon">
                            <i class="las la-pray"></i>
                        </span>
                        <h4 class="small-heading font-Sofia-serif ">Confesión</h4>
                        <br>
                        <span class="ex-line"></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Capillas -->
    <section id="patientgallery" class="back-fff">
        <div class="container">
            <!--Heading-->
            <div class="row text-center">
                <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 wow zoomIn heading-area"
                    data-wow-duration="1s" data-wow-delay=".1s">
                    <h3 class="heading text-center"><span class="d-block d-block-heading font-Sofia-serif">
                            Capillas De La Zona</span>
                    </h3>
                </div>
            </div>
            <br>
            <p class="text text-center font-Sofia-serif">
                Actualmente, la Parroquia Santa Rosa de Lima de Chocalán tiene la importante responsabilidad de
                administrar 27 capillas dispersas al sur de Melipilla. Estas capillas, cada una con su propia historia y
                comunidad, forman parte integral del servicio pastoral de la parroquia, extendiendo su alcance y apoyo
                espiritual a una amplia región.</p>
            <div class="swiper mySwiper font-Sofia-serif">
                <div class="swiper-wrapper">

                    <div class="swiper-slide center">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>San Judas Tadeo, Cholqui</h3>
                            </div>
                            <div class="product-img">
                                <!-- Utilizamos overflow: hidden para recortar el contenido que exceda los bordes de la tarjeta -->
                                <a href="https://www.google.com/maps/place/33%C2%B047'04.8%22S+71%C2%B008'15.9%22W/@-33.7846681,-71.138405,172m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.7846681!4d-71.1377613?hl=es&entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    Ubicación
                                </a>
                                <img src="public/vista/img/judas.jpeg" alt="" class="img-product-inter">
                                <!-- Mantenemos el border-radius de la imagen -->
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide center">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>Santa Teresa de los Andes, Manantiales</h3>
                            </div>
                            <div class="product-img"><a
                                    href="https://www.google.com/maps/place/33%C2%B046'13.2%22S+71%C2%B010'33.9%22W/@-33.7702404,-71.176356,86m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.7703458!4d-71.1760764?hl=es&entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    Ubicación
                                </a>


                                <img src="public/vista/img/mananteales.jpeg" alt="" class="img-product-inter">
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide center">
                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>Nuestra Señora de Lourdes, Pabellón</h3>
                            </div>
                            <div class="product-img">
                                <a href="https://www.google.com/maps/place/33%C2%B044'39.6%22S+71%C2%B011'47.3%22W/@-33.7443272,-71.197108,172m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.7443272!4d-71.1964643?hl=es&entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    Ubicación
                                </a>
                                <img src="public/vista/img/lourdes.jpeg" alt="" class="img-product-inter">
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide center">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>San Guillermo, Isla de Chocalán</h3>
                            </div>
                            <div class="product-img">
                                <img src="public/vista/img/sanguillermo.jpeg" alt="" class="img-product-inter">
                            </div>
                            <a href="https://www.google.com/maps/place/33%C2%B044'56.6%22S+71%C2%B013'49.6%22W/@-33.7490425,-71.2310896,172m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.7490425!4d-71.2304459?hl=es&entry=ttu"
                                class="btn-1 btn-1-product" target="_blank">
                                <i class="las la-map-marker-alt icon-map-marker"></i>
                                Ubicación
                            </a>
                        </div>
                    </div>

                    <div class="swiper-slide center">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>Sagrado Corazon, La Viluma</h3>
                            </div>
                            <div class="product-img">
                                <img src="public/vista/img/viluma.jpeg" alt="" class="img-product-inter">
                            </div>
                            <a href="https://www.google.com/maps/place/33%C2%B046'53.9%22S+71%C2%B004'58.7%22W/@-33.7816244,-71.0878339,689m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-33.781629!4d-71.082963?hl=es&entry=ttu"
                                class="btn-1 btn-1-product" target="_blank">
                                <i class="las la-map-marker-alt icon-map-marker"></i>
                                Ubicación
                            </a>
                        </div>
                    </div>

                    <div class="swiper-slide center">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>Nuestra Señora del Carmen, C. de las Rosas</h3>
                            </div>
                            <div class="product-img">
                                <img src="public/vista/img/carmendelasrosas.jpeg" alt="" class="img-product-inter">
                            </div>
                            <a href="https://www.google.com/maps/place/33%C2%B045'25.4%22S+71%C2%B009'17.8%22W/@-33.7570554,-71.1562231,345m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.7570554!4d-71.1549356?hl=es&entry=ttu"
                                class="btn-1 btn-1-product" target="_blank">
                                <i class="las la-map-marker-alt icon-map-marker"></i>
                                Ubicación
                            </a>
                        </div>
                    </div>

                    <div class="swiper-slide center">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>San José Obrero, La Vega</h3>
                            </div>
                            <div class="product-img">
                                <img src="public/vista/img/lavega.jpeg" alt="" class="img-product-inter">
                                <a href="https://www.google.com/maps/place/33%C2%B043'02.0%22S+71%C2%B010'59.5%22W/@-33.717224,-71.1844843,345m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.717224!4d-71.1831968?hl=es&entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    Ubicación
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide center">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>San Alberto Hurtado, Carmen Bajo</h3>
                            </div>
                            <div class="product-img">
                                <img src="public/vista/img/carmenbajo.jpeg" alt="" class="img-product-inter">
                                <a href="https://www.google.com/maps/place/33%C2%B043'25.9%22S+71%C2%B011'19.7%22W/@-33.7238536,-71.1901019,345m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.7238536!4d-71.1888144?hl=es&entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    Ubicación
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide center">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>Santa Teresita del niño Jesús, Culiprán</h3>
                            </div>
                            <div class="product-img">
                                <img src="public/vista/img/culipran.jpeg" alt="" class="img-product-inter">
                                <a href="https://www.google.com/maps/place/33%C2%B047'28.5%22S+71%C2%B015'12.2%22W/@-33.7912474,-71.2559626,689m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-33.7912474!4d-71.2533877?hl=es&entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    Ubicación
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide center">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>San Jose Obrero, Popeta</h3>
                            </div>
                            <div class="product-img">
                                <img src="public/vista/img/sanjosepopeta.jpeg" alt="" class="img-producto-inter">
                                <a href="https://www.google.com/maps/place/33%C2%B048'59.1%22S+71%C2%B017'13.6%22W/@-33.8164087,-71.2877539,172m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.8164087!4d-71.2871102?hl=es&entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    Ubicación
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide center">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>Nuestra Señora de Fatima, San Juan de Popeta</h3>
                            </div>
                            <div class="product-img">
                                <img src="public/vista/img/fatima.jpeg" alt="" class="img-product-inter">
                                <a href="https://www.google.com/maps/place/33%C2%B050'19.2%22S+71%C2%B016'31.8%22W/@-33.838675,-71.2761551,172m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.838675!4d-71.2755114?hl=es&entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    Ubicación
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide center">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>San Martin de Porres, Tantehue Bajo</h3>
                            </div>
                            <div class="product-img">
                                <img src="public/vista/img/porres.jpg" alt="" class="img-product-inter">
                                <a href="https://www.google.com/maps/place/33%C2%B052'32.2%22S+71%C2%B013'13.7%22W/@-33.8755693,-71.2214442,260m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.8756117!4d-71.22046?entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    Ubicación
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide center">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>San Sebastian, Tantehue Alto</h3>
                            </div>
                            <div class="product-img">
                                <img src="public/vista/img/tantehuealto.jpeg" alt="" class="img-product-inter">
                                <a href="https://www.google.com/maps/place/33%C2%B050'57.4%22S+71%C2%B010'56.0%22W/@-33.8492756,-71.1835213,344m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.8492756!4d-71.1822338?hl=es&entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    Ubicación
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide center">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>Divina Misericordia, San Benito</h3>
                            </div>
                            <div class="product-img">
                                <img src="public/vista/img/divinamisericordia.jpg" alt="" class="img-product-inter">
                                <a href="https://www.google.com/maps/place/33%C2%B046'30.7%22S+71%C2%B015'26.6%22W/@-33.7751816,-71.2586698,345m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.7751816!4d-71.2573823?entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    Ubicación
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide center">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>San Juan Pablo Segundo, San Manuel</h3>
                            </div>
                            <div class="product-img">
                                <img src="public/vista/img/sanmanuel.jpeg" alt="" class="img-product-inter">
                                <a href="https://www.google.com/maps/place/33%C2%B046'00.8%22S+71%C2%B016'11.9%22W/@-33.7668315,-71.2709221,345m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.7668851!4d-71.269971?hl=es&entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    Ubicación
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide center">

                        <div class="product-content producto-content-text">
                            <br>
                            <div class="product-txt">
                                <h3>San Rafael, Codigua</h3>
                            </div>
                            <div class="product-img">
                                <img src="public/vista/img/sanrafael.jpeg" alt="" class="img-product-inter">
                                <a href="https://www.google.com/maps/place/33%C2%B045'49.2%22S+71%C2%B017'37.9%22W/@-33.7636575,-71.294494,172m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.7636575!4d-71.2938503?hl=es&entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    Ubicación
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide center">

                        <div class="product-content producto-content-text">
                            <br>
                            <div class="product-txt">
                                <h3>San Pablo, Codigua</h3>
                            </div>
                            <div class="product-img">
                                <img src="public/vista/img/sanpablo.jpeg" alt="" class="img-product-inter">
                                <a href="https://www.google.com/maps/place/33%C2%B045'01.4%22S+71%C2%B017'43.8%22W/@-33.7503738,-71.2967763,345m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.7503738!4d-71.2954888?hl=es&entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    Ubicación
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide center">
                        <div class="product-content producto-content-text">
                            <br>
                            <div class="product-txt">
                                <h3>San José, Codigua</h3>
                            </div>
                            <div class="product-img">
                                <img src="public/vista/img/sanjose.jpeg" alt="" class="img-product-inter">
                                <a href="https://www.google.com/maps/place/33%C2%B045'35.7%22S+71%C2%B019'39.5%22W/@-33.7598858,-71.3280985,86m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.7599182!4d-71.3276291?hl=es&entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    Ubicación
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide center">

                        <div class="product-content producto-content-text">
                            <br>
                            <div class="product-txt">
                                <h3>San Valentín, Codigua</h3>
                            </div>
                            <div class="product-img">
                                <img src="public/vista/img/sanvalentin.jpeg" alt="" class="img-product-inter">
                                <a href="https://www.google.com/maps/place/33%C2%B046'32.1%22S+71%C2%B021'07.1%22W/@-33.7755734,-71.3532551,345m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.7755734!4d-71.3519676?hl=es&entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    Ubicación
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide center">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>Nuestra Señora del Carmen, La unión de Codigua</h3>
                            </div>
                            <div class="product-img">
                                <img src="public/vista/img/carmencodigua.jpeg" alt="" class="img-product-inter">
                            </div>
                            <div class="product-txt">
                                <a href="https://www.google.com/maps/place/33%C2%B047'26.0%22S+71%C2%B022'38.8%22W/@-33.7905507,-71.3787368,345m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.7905507!4d-71.3774493?hl=es&entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    Ubicación
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide center">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>Nuestra Señora de la Esperanza, Mandinga</h3>
                            </div>
                            <div class="product-img">
                                <img src="public/vista/img/laesperanza.jpeg" alt="" class="img-product-inter">
                            </div>
                            <div class="product-txt">
                                <a href="https://www.google.com/maps/place/33%C2%B047'16.1%22S+71%C2%B016'55.4%22W/@-33.7878706,-71.2824316,172m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.7877993!4d-71.2820534?hl=es"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>ubicación
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide center">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>San Francisco, Mandinga</h3>
                            </div>
                            <div class="product-img">
                                <a href="https://www.google.com/maps/place/Capilla+San+Francisco+de+Mandinga/@-33.7970055,-71.3006418,345m/data=!3m1!1e3!4m6!3m5!1s0x9663ad89b296cfb3:0xae9a8820142f32c9!8m2!3d-33.797215!4d-71.2999337!16s%2Fg%2F11gxvs9789?entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    ubicación
                                </a>
                                <img src="public/vista/img/sanfrancisco.jpeg" alt="" class="img-product-inter">
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>Sagrado Corazón de Jesús, Sector 4 Popeta</h3>
                            </div>
                            <div class="product-img">
                                <a href="https://www.google.com/maps/place/33%C2%B048'04.8%22S+71%C2%B017'22.1%22W/@-33.8013296,-71.2907691,344m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.8013296!4d-71.2894816?entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    ubicación
                                </a>
                                <img src="public/vista/img/popetasector4.jpg" alt="" class="img-product-inter">
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>Santa María, Altos de Popeta</h3>
                            </div>
                            <div class="product-img">
                                <a href="#" class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    ubicación
                                </a>
                                <img src="public/vista/img/z.png" alt="" class="img-product-inter">
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>San Juan Bautista, Ulmén</h3>
                            </div>
                            <div class="product-img">
                                <a href="https://www.google.com/maps/place/33%C2%B050'06.4%22S+71%C2%B021'36.6%22W/@-33.8351022,-71.3614619,344m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.8351022!4d-71.3601744?hl=es&entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    ubicación
                                </a>
                                <img src="public/vista/img/ulmen.jpeg" alt="" class="img-product-inter">
                            </div>

                        </div>
                    </div>

                    <div class="swiper-slide">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>San Pedro, La Puntilla</h3>
                            </div>
                            <div class="product-img">
                                <a href="https://www.google.com/maps/place/33%C2%B045'02.5%22S+71%C2%B009'53.7%22W/@-33.7506877,-71.1674966,689m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-33.7506877!4d-71.1649217?entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    ubicación
                                </a>
                                <img src="public/vista/img/lapuntilla.jpg" alt="" class="img-product-inter">
                            </div>

                        </div>
                    </div>

                    <div class="swiper-slide">

                        <div class="product-content producto-content-text">
                            <div class="product-txt">
                                <h3>Santa Cruz, Los Guindos</h3>
                            </div>
                            <div class="product-img">
                                <a href="https://www.google.com/maps/place/33%C2%B053'25.9%22S+71%C2%B014'01.2%22W/@-33.8905387,-71.2349611,344m/data=!3m1!1e3!4m4!3m3!8m2!3d-33.8905387!4d-71.2336736?entry=ttu"
                                    class="btn-1 btn-1-product" target="_blank">
                                    <i class="las la-map-marker-alt icon-map-marker"></i>
                                    ubicación
                                </a>
                                <img src="public/vista/img/losguindos.jpg" alt="" class="img-product-inter">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Capillas -->
    <section id="personal" class="mini-blog-sec">
        <div class="container">
            <div class="row text-center">
                <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 wow zoomIn heading-area"
                    data-wow-duration="1s" data-wow-delay=".1s">
                    <h3 class="heading text-center">
                        <span class="d-block d-block-heading font-Sofia-serif">Personal Al Servicio</span>
                    </h3>
                </div>
            </div>
            <br>
            <p class="text text-center font-Sofia-serif">La Parroquia cuenta con un
                dedicado equipo de 8 personas al servicio de la comunidad. Cada miembro del equipo desempeña un papel
                esencial en la vida diaria de la parroquia, asegurando que todas las necesidades pastorales y
                administrativas sean atendidas con devoción y eficiencia.</p>

            <!--Heading-->
            <br>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-2 mb-4">
                <div class="info-personal">
                    <img src="public/vista/img/padre.jpg" class="servicio" alt="...">
                    <button class="btn btn-primary btn-personal font-Sofia-serif">- Sacerdote - Manuel Quiroz</button>
                </div>
            </div>
            <div class="col-md-2 mb-4">
                <div class="info-personal">
                    <img src="public/vista/img/marcos.png" class="servicio" alt="...">
                    <button class="btn btn-primary btn-personal font-Sofia-serif">- Vicario - Marco Pardo</button>

                </div>
            </div>
            <div class="col-md-2 mb-4">
                <div class="info-personal">
                    <img src="public/vista/img/osval.jpg" class="servicio" alt="...">
                    <button class="btn btn-primary btn-personal font-Sofia-serif"> - Párroco - Oavaldo Mesa</button>
                </div>
            </div>

            <div class="col-md-2 mb-4">
                <div class="info-personal">
                    <img src="public/vista/img/don.png" class="servicio" alt="...">
                    <button class="btn btn-primary btn-personal font-Sofia-serif"> - Párroco - Juan Pizarro
                        Morales</button>
                </div>
            </div>
            <div class="col-md-2 mb-4">
                <div class="info-personal">
                    <img src="public/vista/img/migue.jpeg" class="servicio" alt="...">
                    <button class="btn btn-primary btn-personal font-Sofia-serif">- Seminarista - Miguel
                        Aguilera</button>
                </div>
            </div>

            <div class="col-md-2 mb-4">
                <div class="info-personal">
                    <img src="public/vista/img/alej.jpg" class="servicio" alt="...">
                    <button class="btn btn-primary btn-personal font-Sofia-serif">- Secretaria - Alejandra
                        Saavedra</button>
                </div>
            </div>

            <div class="col-md-2 mb-4">
                <div class="info-personal">
                    <img src="public/vista/img/maria.jpg" class="servicio" alt="...">
                    <button class="btn btn-primary btn-personal font-Sofia-serif"> - Sacristana - María Nuñez</button>
                </div>
            </div>

            <div class="col-md-2 mb-4">
                <div class="info-personal">
                    <img src="public/vista/img/carmen.jpg" class="servicio" alt="...">
                    <button class="btn btn-primary btn-personal font-Sofia-serif"> - Sacristana - Carmen
                        Aguilar</button>
                </div>
            </div>
            <br><br>
        </div>
    </section>



     <!--  --------------------------------------------------------------------  -->
    <!--  --------------------------------------------------------------------  -->

    <!-- Ultimo codigo para redireccionar a seccion de donaciones -->
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <div class="text-center">
                    <h3>Donaciones para nuestra parroquia</h3>
                    <br>
                    <p class="parrafo">Tu donacion es fundamental para el funcionamiento de 
                        nuestra paroquia  y llevar a cabo proyectos de la 
                        comunidad. Cada aporte, por pequeño que sea, marca la diferencia
                        y constribuye a fortalecer nuestra labor diaria.
                        Agradecemos de todo corazon tu apoyo y generosidad. 
                        Juntos podemos seguir constribuyendo una comunidad mas unidad y solidaria
                        <br>
                        <br>
                        ¡Gracias por ser parte de nuestra familia parroquial!
                    </p>
                    <a href="view/donaciones/donaciones.php" target="_blank">
                    <br>
                     <button class="btn btn-primary">ir a donar </button>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
            <img src="public/img/logodonaciones.jpg" class="imagen" alt="imagen a la derecha">
            <h1 class="text-4xl font-bold text-pink-700">Transbank<span class="text-sm font-thin">Web pay parroquia chocalan</span> </h1>
        </div>
    </div>     
    
    
    <!--  --------------------------------------------------------------------  -->
    <!--  --------------------------------------------------------------------  -->
    

    <section class="contact-sec position-relative" id="contact2">
        <div class="heading-area text-center">
            <h3 class="heading"><span class="d-block d-block-heading font-Sofia-serif">
                    En nuestra parroquia estamos comprometidos con:</span>
            </h3>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 mb-4">
                    <div class="contact_img box box-contact-1  box-contact-1">
                        <img src="public/vista/img/cre1.jpg" alt="Imagen 1" class="img-contact">
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="contact_img box box-contact-1">
                        <img src="public/vista/img/cre2.jpg" alt="Imagen 2" class="img-contact">
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="contact_img box  box-contact-1">
                        <img src="public/vista/img/cre3.jpg" alt="Imagen 3" class="img-contact">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4 mb-4">
                    <div class="contact_img  box  box-contact-2">
                        <img src="public/vista/img/autoridad2.jpg" alt="Imagen 1" class="img-contact">
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="contact_img  box  box-contact-2">
                        <img src="public/vista/img/diocesis.png" alt="Imagen 2" class="img-contact">
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="contact_img  box box-contact-2">
                        <img src="public/vista/img/autoridad.jpg" alt="Imagen 3" class="img-contact">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Google Maps -->
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5398.710742204733!2d-71.20402554651507!3d-33.72455875609692!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x966255686db658d3%3A0x884abcc4393f762d!2sParroquia%20Santa%20Rosa%20de%20Lima!5e1!3m2!1ses!2scl!4v1710380733448!5m2!1ses!2scl"
        width="1000" height="400" style="border:0;box-shadow: 0 0 20px #2f4ba5;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    <!-- END Google Maps -->

    <!-- Start Contact -->
    <section class="contact-sec position-relative" id="contact">
        <div class="heading-area text-center">
            <h3 class="heading"><span class="d-block d-block-heading font-Sofia-serif">
                    Contacto</span>
            </h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-4 text-center text-lg-left d-flex align-items-center mb-4">
                <form class="row contact-form wow fadeInLeft mx-4 p-2 box box-form" id="contact-form-data">
                    <div>
                        <div class="col-12 col-lg-12 px-md-0 text-center">

                            <input type="text" name="userName" placeholder="Nombre" class="form-control input-info">

                            <input type="email" name="userEmail" placeholder="E-mail" class="form-control input-info">

                            <input type="text" name="userPhone" placeholder="56 9 8449 6843" class="form-control input-info">

                            <textarea class="form-control text-area-form" name="userMessage" rows="6"
                                placeholder="Escríbenos tu mensaje!"></textarea>
                                
                            <a href="javascript:void(0);"
                                class="btn btn-medium btn-rounded btn-gradient rounded-pill w-100 contact_btn main-font">enviar</a>
                        </div>
                        <br>

                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Start Footer -->
    <footer class="footer padding-top-half padding-bottom-half">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center our-loc">
                <div class="col-12 col-md-6 col-lg-3">
                    <a><i aria-hidden="true" class="las la-paper-plane"></i>parroquiachocalan@gmail.com</a>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <a><i aria-hidden="true" class="las la-phone"></i>+569 8449 6843</a>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <a><i aria-hidden="true" class="las la-map-marker"></i> Camino a Cholqui, Chocalán</a>
                </div>
            </div>
            <div class="row align-items-center social-media padding-top-half">
                <!--Social-->
                <div class="col-12 text-center">
                    <div class="footer-social">
                        <ul class="list-unstyled social-icons social-icons-simple inline-icons">
                            <li>
                                <a class="facebook_bg_hvr2 wow fadeInUp"
                                    href="https://www.facebook.com/friends/?profile_id=100009155210147&notif_id=1705949369162720&notif_t=friend_confirmed&ref=notif"
                                    target="_blank">
                                    <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a class="whatsapp-bg-hvr2 wow fadeInUp" href="https://wa.me/56984496843"
                                    target="_blank">
                                    <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!--Text-->
                    <p class="company-about fadeIn">&copy; 2024 Made by JennyP@nk <a href="javascript:void(0);"></a></p>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- General js -->
    <!-- JavaScript -->
    <script src="public/vendor/js/bundle.min.js"></script>
    <script src="public/vendor/js/wow.min.js"></script>
    <!-- Plugin Js -->
    <script src="public/vendor/js/jquery.appear.js"></script>
    <script src="public/vendor/js/morphext.min.js"></script>
    <script src="public/vendor/js/jquery.fancybox.min.js"></script>
    <script src="public/vendor/js/owl.carousel.min.js"></script>
    <script src="public/vendor/js/jquery.cubeportfolio.min.js"></script>
    <script src="public/vista/js/isotope.pkgd.js"></script>
    <script src="public/vendor/js/modernizr.custom.97074.js"></script>
    <script src="public/vendor/js/jquery.hoverdir.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJRG4KqGVNvAPY4UcVDLcLNXMXk2ktNfY"></script>
    <script src="public/vista/js/map.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- CUSTOM JS -->
    <script src="public/vendor/js/contact_us.js"></script>
    <script src="public/vista/js/script.js"></script>
    
    <!-- Sweet alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Funciones -->
    <script src="funcionesIndex.js"></script>
</body>

</html>