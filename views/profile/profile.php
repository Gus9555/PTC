<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>LifeLine</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel="icon" href="../../assets/boss/images/favicon.png">

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext"
        rel="stylesheet">
    <link href="../../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../../assets/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../../assets/boss/css/swiper.css" rel="stylesheet">
    <link href="../../assets/boss/css/magnific-popup.css" rel="stylesheet">
    <link href="../../assets/boss/css/styles.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        section {
            flex: 1;
        }

        .cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .card {
            flex: 1 1 calc(50% - 1rem);
            box-sizing: border-box;
        }

        .seguro-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .seguro-card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .seguro-card .card-body {
            text-align: center;
            position: relative;
        }

        .card-body_bg {
            height: 128px;
            width: 128px;
            z-index: 1;
            position: absolute;
            top: -75px;
            right: -75px;
            border-radius: 50%;
            transition: all .5s ease;
        }

        .card-body_bg.diamond {
            background-color: #b9f2ff;
        }

        .card-body_bg.silver {
            background-color: #c0c0c0;
        }

        .card-body_bg.gold {
            background-color: #ffd700;
        }

        .seguro-card:hover .card-body_bg {
            transform: scale(10);
        }

        .wrapper {
            margin-top: 80px;
        }

        .insurance-image {
            display: block;
            margin: 0 auto 1rem;
            width: 120px;
            height: auto;
        }

        .center-image {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 200px;
            height: auto;
            opacity: 0;
            transition: opacity 0.5s ease;
            z-index: 2;
        }

        .seguro-card:hover .center-image {
            opacity: 1;
        }
    </style>
</head>

<body>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require '../../funcs/conexion.php';
    require '../../funcs/funcs.php';
    session_start();

    $id = $_SESSION['id'] ?? null;
    $nombre = decryptPayload($_SESSION['nombre']) ?? null;
    $correo = decryptPayload($_SESSION['correo']) ?? null;

    $pdo = getConnection();
    $stmt1 = $pdo->prepare('SELECT "usuario" FROM users WHERE id = :id');
    $stmt1->execute(['id' => $id]);
    $row = $stmt1->fetch(PDO::FETCH_ASSOC);
    $usuario = $row['usuario'] ?? null;

    // Verificar las variables de sesión
    if (!$id || !$nombre || !$correo) {
        echo 'Error: Variables de sesión no definidas.';
        exit;
    }

    // Verificar si hay alguna compra con estado "pendiente"
    $stmtPendiente = $pdo->prepare('SELECT estado FROM compras WHERE user_id = :id AND estado = :estado');
    $stmtPendiente->execute(['id' => $id, 'estado' => 'pendiente']);
    $compraPendiente = $stmtPendiente->fetch(PDO::FETCH_ASSOC);

    // Mostrar alerta si hay una compra pendiente
    if ($compraPendiente) {
        echo "<script>
    Swal.fire({
        icon: 'warning',
        title: 'Pending payment',
        text: 'Your monthly payment is pending, check your email.',
        confirmButtonText: 'OK'
    });
</script>";
    }

    // Obtener todos los seguros contratados, independientemente del estado
    $stmt2 = $pdo->prepare('SELECT id_c, seguro, calidad, nombre, correo, precio, fecha_compra FROM compras WHERE user_id = :id');
    $stmt2->execute(['id' => $id]);
    $seguros = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    $no_seguro = '';
    if (empty($seguros)) {
        $no_seguro = '
<div class="card seguro-card">
    <div class="card-body text-center">
        <p class="mb-4"><span class="text-primary font-italic me-1"></span>YOU HAVE NOT YET TAKEN OUT INSURANCE</p>
        <i class="fas fa-frown fa-2x"></i>
        <div class="card-body_bg"></div>
    </div>
</div>';
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>LifeLine</title>
        <!-- MDB icon -->
        <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
        <!-- Google Fonts Roboto -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
        <!-- MDB -->
        <link rel="stylesheet" href="css/bootstrap-profiles.min.css" />
    </head>

    <body>
        <!-- Start your project here-->
        <section style="background-color: #3b5d50;">
            <div class="container py-5">
                <!-- Preloader -->
                <div class="spinner-wrapper">
                    <div class="spinner">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>
                <!-- end of preloader -->

                <!-- Navigation -->
                <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
                    <div class="container">
                        <!-- Image Logo -->
                        <a class="navbar-brand logo-image" href="../user/view_user.php"><img
                                src="../../assets/boss/images/logo.png" alt="alternative"></a>

                        <!-- Mobile Menu Toggle Button -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-awesome fas fa-bars"></span>
                            <span class="navbar-toggler-awesome fas fa-times"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link page-scroll" href="../user/view_user.php">HOME <span
                                            class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link page-scroll" href="profile_spanish.php">ESPAÑOL <span
                                            class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link page-scroll" href="../support/users.php">CHAT-SUPPORT <span
                                            class="sr-only">(current)</span></a>
                                </li>

                            </ul>
                            <span class="nav-item">
                                <a class="btn-outline-sm" href="../user/logout.php">LOG OUT</a>
                            </span>
                        </div>
                    </div>
                </nav>
                <!-- end of navigation -->

                <div class="wrapper">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <img src="../../assets/images/Diseño_sin_título__4_-removebg-preview.png"
                                        alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                    <h5 class="my-3"><?php echo $nombre; ?></h5>
                                    <div class="d-flex justify-content-center mb-2">
                                        <li class="btn btn-outline-primary ms-1"><a href="../user/logout.php">Logout</a>
                                        </li>
                                        <li class="btn btn-outline-primary ms-1"><a
                                                href="../user/view_user.php">Home</a>
                                        </li>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Full Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $nombre; ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">User</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $usuario; ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $correo; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- inicio card seguro-->

                            <div class="cards-container">
                                <?php
                                foreach ($seguros as $index => $seguro) {
                                    $colorClase = '';
                                    switch (strtolower($seguro['calidad'])) {
                                        case 'diamond':
                                            $colorClase = 'diamond';
                                            break;
                                        case 'silver':
                                            $colorClase = 'silver';
                                            break;
                                        case 'gold':
                                            $colorClase = 'gold';
                                            break;
                                    }
                                    echo '<div class="card seguro-card">
                                        <div class="card-body">
                                            <p class="mb-4"><b>INSURANCE</b></p>';
                                    if (strtolower($seguro['seguro']) == 'vehicule') {
                                        echo '<img src="../../assets/boss/images/33.png" alt="Vehicle Insurance" class="insurance-image">';
                                    } elseif (strtolower($seguro['seguro']) == 'medical') {
                                        echo '<img src="../../assets/boss/images/44.png" alt="Medical Insurance" class="insurance-image">';
                                    } elseif (strtolower($seguro['seguro']) == 'home') {
                                        echo '<img src="../../assets/boss/images/333.png" alt="Home Insurance" class="insurance-image">';
                                    } elseif (strtolower($seguro['seguro']) == 'motorcycle') {
                                        echo '<img src="../../assets/boss/images/motos.png" alt="Motorcycle Insurance" class="insurance-image">';
                                    } elseif (strtolower($seguro['seguro']) == 'Utility') {
                                        echo '<img src="../../assets/boss/images/tractorcito.png" alt="Utility Insurance" class="insurance-image">';
                                    }
                                    echo '   <p class="mb-1" style="font-size: .77rem;"><b>' . htmlspecialchars($seguro['seguro']) . '</b></p>
                                            <p class="mb-1" style="font-size: .77rem;">' . htmlspecialchars($seguro['calidad']) . '</p>
                                            <div class="card-body_bg ' . $colorClase . '"></div>
                                            <img src="../../assets/images/Diseño_sin_título__4_-removebg-preview.png" alt="Centered Image" class="center-image">
                                            <a href="#insuranceModal' . $index . '" data-toggle="modal" class="stretched-link"></a>
                                        </div>
                                    </div>';

                                    // Modal for each insurance card
                                    echo '<div class="modal fade" id="insuranceModal' . $index . '" tabindex="-1" role="dialog" aria-labelledby="insuranceModalLabel' . $index . '" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insuranceModalLabel' . $index . '">' . htmlspecialchars($seguro['seguro']) . ' Insurance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Insurance Type: ' . htmlspecialchars($seguro['seguro']) . '</p>
                    <p>Insurance Quality: ' . htmlspecialchars($seguro['calidad']) . '</p>
                    <p>Name: ' . htmlspecialchars($seguro['nombre']) . '</p>
                    <p>Email: ' . htmlspecialchars($seguro['correo']) . '</p>
                    <p>Price: $' . htmlspecialchars($seguro['precio']) . '</p>
                    <p>purchase Date: ' . htmlspecialchars($seguro['fecha_compra']) . '</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#planSelectionModal' . $index . '">Change Insurance Plan</button>
                </div>
            </div>
        </div>
    </div>';

                                    /// Modal for selecting the plan
echo '<div class="modal fade" id="planSelectionModal' . $index . '" tabindex="-1" role="dialog" aria-labelledby="planSelectionModalLabel' . $index . '" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="planSelectionModalLabel' . $index . '">Select Insurance Plan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body text-center">
            <form method="post" action="update_plan.php">
                <input type="hidden" name="compra_id" value="' . $seguro['id_c'] . '">
                <div class="card-deck">';

                // Silver Plan Button
                $disabled = (strtolower($seguro['calidad']) == 'silver') ? 'disabled style="opacity:0.5; cursor:not-allowed;"' : '';
                echo '<button type="submit" name="plan" value="Silver" class="card" ' . $disabled . '>
                        <img src="../../assets/boss/images/plata.png" class="card-img-top" alt="Silver">
                        <div class="card-body">
                            <h5 class="card-title">Silver Plan</h5>
                        </div>
                    </button>';

                // Gold Plan Button
                $disabled = (strtolower($seguro['calidad']) == 'gold') ? 'disabled style="opacity:0.5; cursor:not-allowed;"' : '';
                echo '<button type="submit" name="plan" value="Gold" class="card" ' . $disabled . '>
                        <img src="../../assets/boss/images/oro.png" class="card-img-top" alt="Gold">
                        <div class="card-body">
                            <h5 class="card-title">Gold Plan</h5>
                        </div>
                    </button>';

                // Diamond Plan Button
                $disabled = (strtolower($seguro['calidad']) == 'diamond') ? 'disabled style="opacity:0.5; cursor:not-allowed;"' : '';
                echo '<button type="submit" name="plan" value="Diamond" class="card" ' . $disabled . '>
                        <img src="../../assets/boss/images/diamante.png" class="card-img-top" alt="Diamond">
                        <div class="card-body">
                            <h5 class="card-title">Diamond Plan</h5>
                        </div>
                    </button>';

                echo '</div>
            </form>
        </div>
    </div>
</div>
</div>';

                                }
                                echo $no_seguro;
                                ?>
                            </div>

                            <!-- fin de card seguro-->

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End your project here-->

        <!-- MDB -->
        <script type="text/javascript" src="js/mdb.min.js"></script>
        <!-- Custom scripts -->
        <script type="text/javascript"></script>

        <!-- Scripts -->
        <script src="../../assets/boss/js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
        <script src="../../assets/boss/js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
        <script src="../../assets/boss/js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
        <script src="../../assets/boss/js/jquery.easing.min.js"></script>
        <!-- jQuery Easing for smooth scrolling between anchors -->
        <script src="../../assets/boss/js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
        <script src="../../assets/boss/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
        <script src="../../assets/boss/js/scripts.js"></script> <!-- Custom scripts -->

    </body>

    </html>
