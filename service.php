<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />


    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="pagina, web, desarrollo, servicios, aplicaciones, programas, ciudad, barrancabermeja, pais, colombia" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>19D - Servicios</title>

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

    <!--ICONOS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="19D/images/favicon">

    <!--FAVICON-->
    <link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- MANIFEST-->
    <link rel="manifest" href="manifest.json" />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Dosis:400,500|Poppins:400,700&amp;display=swap" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">
    <div class="hero_area">
        <!-- header section strats -->
        <?php 
            require_once('php/includes/menu.php');
        ?>
        <!-- end header section -->
    </div>

    <!-- service section -->

    <section class="service_section">
        <div class="container">
            <div class="custom_heading-container">
                <h2>
                    Qué soluciones ofrecemos?
                </h2>
            </div>
            <div class="service_container layout_padding2">
                <div class="service_box">
                    <div class="img-box">
                        <img src="images/chatbot.jpg" alt="" />
                    </div>
                    <div class="detail-box">
                        <h4>
                            CHAT BOT
                        </h4>
                        <p>
                            Nuestro chat bot ofrece la oportunidad de conectar con más clientes con una herramienta automatizada y fácil de usar para el usuario final.
                        </p>
                    </div>
                </div>
                <div class="service_box">
                    <div class="img-box">
                        <img src="images/gestordocumental.jpg" alt="" />
                    </div>
                    <div class="detail-box">
                        <h4>
                            Gestor documental
                        </h4>
                        <p>
                            Reduce hasta un 70% las tareas manuales de creación, organización, intercambio y firma de documentos con un Gestor Documental software.
                        </p>
                    </div>
                </div>
                <div class="service_box">
                    <div class="img-box">
                        <img src="images/evaluacionesdedesempeñotrabajadoresyproveedores.jpg" alt="" />
                    </div>
                    <div class="detail-box">
                        <h4>
                            Evaluaciones de desempeño trabajadores y proveedores
                        </h4>
                        <p>
                            Siempre podrás contar con nuestra ayuda para crear un lugar de trabajo más feliz. Agéndate. Puedes configurar distintos tipos de formularios para cada tipo de evaluación.
                        </p>
                    </div>
                </div>
                <div class="service_box">
                    <div class="img-box">
                        <img src="images/desarrolloeintegraciónapiwhatsapp.jpg" alt="" />
                    </div>
                    <div class="detail-box">
                        <h4>
                            Desarrollo e integración API Whatsapp
                        </h4>
                        <p>
                            Chatbots personalizados para enviar mensajes automáticos. ¡Descubre API Oficial Whatsapp! Amplía tu alcance y fortalece la seguridad en canales digitales con Whatsapp API Oficial.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end service section -->
    <?php 
        require_once('php/includes/footer.php');
    ?>
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>