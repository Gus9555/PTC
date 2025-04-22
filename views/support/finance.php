
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <meta name="description" content="Tivo is a HTML landing page template built with Bootstrap to help you create engaging presentations for SaaS apps and convert visitors into users.">
    <meta name="author" content="Inovatik">

    <!-- OG Meta Tags -->
    <meta property="og:site_name" content="" />
    <meta property="og:site" content="" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:type" content="article" />

    <!-- Website Title -->
    <title>Users Pending Payment</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="../../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../../assets/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../../assets/boss/css/swiper.css" rel="stylesheet">
    <link href="../../assets/boss/css/magnific-popup.css" rel="stylesheet">
    <link href="../../assets/boss/css/styles.css" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="../../assets/boss/images/latido-del-corazon2.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand logo-image"><img src="../../assets/boss/images/logo.png"
          alt="alternative"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
        aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-awesome fas fa-bars"></span>
        <span class="navbar-toggler-awesome fas fa-times"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link page-scroll" href="users.php">CHAT<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link page-scroll" href="finance.php">FINANCE <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link page-scroll" href="../support_spanish/finance.php">ESPAÑOL <span
                class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
    <!-- Header -->
    <header id="header" class="ex-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Users Pending Payment</h1>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of ex-header -->

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <button class="btn btn-primary mb-3" onclick="enviarCorreos()">Send Mail</button>
                <h1 class="mt-5">Payment Details</h1>
                <table id="usuariosPendientes" class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Insurance</th>
                            <th>Quality</th>
                            <th>Price</th>
                            <th>Date of Purchase</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Los datos serán insertados aquí -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <svg class="footer-frame" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1920 79">
        <defs>
            <style>.cls-2 { fill: #3b5d50; }</style>
        </defs>
        <path class="cls-2" d="M0,72.427C143,12.138,255.5,4.577,328.644,7.943c147.721,6.8,183.881,60.242,320.83,53.737,143-6.793,167.826-68.128,293-60.9,109.095,6.3,115.68,54.364,225.251,57.319,113.58,3.064,138.8-47.711,251.189-41.8,104.012,5.474,109.713,50.4,197.369,46.572,89.549-3.91,124.375-52.563,227.622-50.155A338.646,338.646,0,0,1,1920,23.467V79.75H0V72.427Z" transform="translate(0 -0.188)" />
    </svg>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-col first">
                        <h4>About Tivo</h4>
                        <p class="p-small">We're passionate about offering some of the best business growth services for startups.</p>
                    </div>
                </div> <!-- end of col -->
                <div class="col-md-4">
                    <div class="footer-col middle">
                        <h4>Important Links</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media"><i class="fas fa-square"></i>
                                <div class="media-body">Our business partners <a class="white" href="#your-link">startupguide.com</a></div>
                            </li>
                            <li class="media"><i class="fas fa-square"></i>
                                <div class="media-body">Read our <a class="white" href="terms-conditions.html">Terms & Conditions</a>, <a class="white" href="privacy-policy.html">Privacy Policy</a></div>
                            </li>
                        </ul>
                    </div>
                </div> <!-- end of col -->
                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Contact</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media"><i class="fas fa-map-marker-alt"></i>
                                <div class="media-body">22 Innovative, San Francisco, CA 94043, US</div>
                            </li>
                            <li class="media"><i class="fas fa-envelope"></i>
                                <div class="media-body"><a class="white" href="mailto:contact@Tivo.com">contact@Tivo.com</a></div>
                            </li>
                        </ul>
                    </div>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of footer -->

    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © 2020 <a href="https://inovatik.com">Template by Inovatik</a></p>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of copyright -->

    <!-- Scripts -->
    <script src="../../assets/boss/js/jquery.min.js"></script>
    <script src="../../assets/boss/js/popper.min.js"></script>
    <script src="../../assets/boss/js/bootstrap.min.js"></script>
    <script src="../../assets/boss/js/jquery.easing.min.js"></script>
    <script src="../../assets/boss/js/swiper.min.js"></script>
    <script src="../../assets/boss/js/jquery.magnific-popup.js"></script>
    <script src="../../assets/boss/js/scripts.js"></script>

    <script>
        function enviarCorreos() {
            fetch('enviar_correos.php')
                .then(response => response.text())
                .then(data => Swal.fire({
                    title: 'Información',
                    text: 'el correo a sido enviado',
                    icon: 'info',
                    confirmButtonText: 'OK'
                }))
                .catch(error => console.error('Error:', error));
        }

        function cargarUsuariosPendientes() {
            fetch('obtener_usuarios_pendientes.php')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('usuariosPendientes').getElementsByTagName('tbody')[0];
                    tbody.innerHTML = ''; // Limpiar la tabla

                    data.forEach(usuario => {
                        const row = tbody.insertRow();
                        row.insertCell(0).textContent = usuario.nombre;
                        row.insertCell(1).textContent = usuario.correo;
                        row.insertCell(2).textContent = usuario.numero_telefonico;
                        row.insertCell(3).textContent = usuario.seguro;
                        row.insertCell(4).textContent = usuario.calidad;
                        row.insertCell(5).textContent = usuario.precio;
                        row.insertCell(6).textContent = usuario.fecha_compra;
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        // Cargar usuarios pendientes al cargar la página
        window.onload = cargarUsuariosPendientes;
    </script>

</body>

</html>
