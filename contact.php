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

    <title>19D - Contactanos</title>

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

    <!-- contact section -->
    <section class="contact_section layout_padding">
        <div class="container contact_heading">
            <h2>
                Dejanos tu mensaje
            </h2>
        </div>
        <div class="container">
            <form id="contactForm">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputName4">Su Nombre:</label>
                        <input type="text" class="form-control" id="inputName4" name="inputName4" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Su Correo:</label>
                        <input type="email" class="form-control" id="inputEmail4" name="inputEmail4" />
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNumber4">Su Numero de Telefono:</label>
                        <input type="tel" class="form-control" id="inputNumber4" name="inputNumber4" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputState">Seleccione Servicio:</label>
                        <select id="inputState" class="form-control" name="inputState">
                            <option disabled selected value="0">Seleccione un servicio</option>
                            <option>Chat Bot</option>
                            <option>Gestor Documental</option>
                            <option>Evaluaciones de desempeño, trabajadores y proveedores</option>
                            <option>Desarrollo e integracion API Whatsapp</option>
                            <option>Otros</option>
                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <label for="inputMessage">Mensaje:</label>
                    <input type="text" class="form-control" id="inputMessage" name="inputMessage" placeholder="" />
                </div>
        </div>

        <div class="d-flex justify-content-center">
            <button>ENVIAR</button>
        </div>
        </form>

    </section>


    <!-- end contact section -->
    <?php 
        require_once('php/includes/footer.php');
    ?>

    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#contactForm').submit(function(event) {
                event.preventDefault();

                // Verificar si los campos están llenos
                var name = $('#inputName4').val();
                var email = $('#inputEmail4').val();
                var number = $('#inputNumber4').val();
                var service = $('#inputState').val();
                var message = $('#inputMessage').val();

                if (!name || !email || !number || !message) {
                    Swal.fire({
                        icon: 'error',
                        text: 'Por favor, completa todos los campos antes de enviar el formulario.'
                    });
                    return;
                }

                if (!service || service === '0' || service === null) {
                    Swal.fire({
                        icon: 'error',
                        text: 'Por favor, seleccione un servicio válido.'
                    });
                }

                // Si todos los campos están llenos y el servicio es válido, enviar el formulario a través de AJAX
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: 'procesar_formulario.php',
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            text: 'Formulario enviado con éxito:'
                        }, response);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            text: 'Error al enviar el formulario:'
                        }, error);
                    }
                });
            });
        });
    </script>
</body>

</html>