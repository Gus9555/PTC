<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LifeLine</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
    <link rel="icon" href="../../assets/boss/images/favicon.png">
</head>

<body>

</body>

</html>


<?php
session_start();
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';

if (!isset($_SESSION['id'])) {
    echo '<p><script>Swal.fire({
        title: "Advertencia",
        text: "Inicie sesión nuevamente"
    }).then(function() {
        window.location = "../../views/user/login.php";
    });</script></p>';
    exit;
}

// Conexión a la base de datos
try {
    $pdo = getConnection();

    $sqlPlanes = "SELECT SUM(precio) AS total_precio
FROM compra_plan
WHERE estado = 'activo'";
    $stmtPlanes = $pdo->prepare($sqlPlanes);
    $stmtPlanes->execute();
    $totalPlanes = $stmtPlanes->fetchColumn();

    // Consulta para obtener la cantidad de seguros por tipo y calidad para Utility, Vehículo, Motocicleta
    $sqlQuality = "SELECT 
                    seguro,
                    calidad, 
                    COUNT(*) as cantidad 
                   FROM compras 
                   WHERE seguro IN ('Utility', 'Vehicule', 'motorcycle')
                   GROUP BY seguro, calidad";
    $stmtQuality = $pdo->prepare($sqlQuality);
    $stmtQuality->execute();
    $qualityData = $stmtQuality->fetchAll(PDO::FETCH_ASSOC);

    $chartData = [
        'Utility' => ['Silver' => 0, 'Gold' => 0, 'Diamond' => 0],
        'vehicule' => ['Silver' => 0, 'Gold' => 0, 'Diamond' => 0],
        'motorcycle' => ['Silver' => 0, 'Gold' => 0, 'Diamond' => 0],
    ];

    foreach ($qualityData as $row) {
        $chartData[$row['seguro']][$row['calidad']] = intval($row['cantidad']);
    }



    // Consulta para obtener la cantidad de seguros "Home" por calidad
    $sqlHomeQuality = "SELECT 
                            calidad, 
                            COUNT(*) as cantidad 
                          FROM compras 
                          WHERE seguro = 'Home' 
                          GROUP BY calidad";
    $stmtHomeQuality = $pdo->prepare($sqlHomeQuality);
    $stmtHomeQuality->execute();
    $homeQualityData = $stmtHomeQuality->fetchAll(PDO::FETCH_ASSOC);

    $homeChartData = [
        'Silver' => 0,
        'Gold' => 0,
        'Diamond' => 0
    ];

    foreach ($homeQualityData as $row) {
        $homeChartData[$row['calidad']] = intval($row['cantidad']);
    }


    // Consulta para obtener la cantidad de seguros "Medical" por calidad
    $sqlMedicalQuality = "SELECT 
      calidad, 
      COUNT(*) as cantidad 
    FROM compras 
    WHERE seguro = 'Medical' 
    GROUP BY calidad";
    $stmtMedicalQuality = $pdo->prepare($sqlMedicalQuality);
    $stmtMedicalQuality->execute();
    $medicalQualityData = $stmtMedicalQuality->fetchAll(PDO::FETCH_ASSOC);

    $medicalChartData = [
        'Silver' => 0,
        'Gold' => 0,
        'Diamond' => 0
    ];

    foreach ($medicalQualityData as $row) {
        $medicalChartData[$row['calidad']] = intval($row['cantidad']);
    }


    // Consulta para obtener las estadísticas de usuarios
    $sql = "SELECT 
                COUNT(*) as total_users, 
                COUNT(CASE WHEN id_tipo = 1 THEN 1 END) as total_admins, 
                COUNT(CASE WHEN id_tipo = 2 THEN 1 END) as total_regular_users, 
                COUNT(CASE WHEN id_tipo = 3 THEN 1 END) as total_support 
            FROM users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Consulta para obtener todos los usuarios
    $sqlUsers = "SELECT * FROM users";
    $stmtUsers = $pdo->prepare($sqlUsers);
    $stmtUsers->execute();
    $resultado = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);

    // Fetch pending, accepted, and denied requests for asociados
    $sqlAsociados = "SELECT 
                        COUNT(CASE WHEN activation = 2 THEN 1 END) as pending_asociados, 
                        COUNT(CASE WHEN activation = 1 THEN 1 END) as accepted_asociados, 
                        COUNT(CASE WHEN activation = 3 THEN 1 END) as denied_asociados 
                    FROM asociados";
    $stmtAsociados = $pdo->prepare($sqlAsociados);
    $stmtAsociados->execute();
    $resultAsociados = $stmtAsociados->fetch(PDO::FETCH_ASSOC);

    // Fetch pending, accepted, and denied requests for constructuras
    $sqlConstructuras = "SELECT 
                            COUNT(CASE WHEN activation = 2 THEN 1 END) as pending_constructuras, 
                            COUNT(CASE WHEN activation = 1 THEN 1 END) as accepted_constructuras, 
                            COUNT(CASE WHEN activation = 3 THEN 1 END) as denied_constructuras 
                        FROM constructuras";
    $stmtConstructuras = $pdo->prepare($sqlConstructuras);
    $stmtConstructuras->execute();
    $resultConstructuras = $stmtConstructuras->fetch(PDO::FETCH_ASSOC);

    // Fetch pending, accepted, and denied requests for talleres
    $sqlTalleres = "SELECT 
                        COUNT(CASE WHEN activation = 2 THEN 1 END) as pending_talleres, 
                        COUNT(CASE WHEN activation = 1 THEN 1 END) as accepted_talleres, 
                        COUNT(CASE WHEN activation = 3 THEN 1 END) as denied_talleres 
                    FROM talleres";
    $stmtTalleres = $pdo->prepare($sqlTalleres);
    $stmtTalleres->execute();
    $resultTalleres = $stmtTalleres->fetch(PDO::FETCH_ASSOC);

    // Consulta para obtener las ganancias por tipo de seguro y calidad
    $sqlGanancias = "SELECT 
    seguro, 
    calidad,
    SUM(precio) as total_ganancias 
FROM compras 
WHERE estado = 'activo'
GROUP BY seguro, calidad";
    $stmtGanancias = $pdo->prepare($sqlGanancias);
    $stmtGanancias->execute();
    $gananciasData = $stmtGanancias->fetchAll(PDO::FETCH_ASSOC);

    $ganancias = [
        'Medical' => ['Silver' => 0, 'Gold' => 0, 'Diamond' => 0],
        'Home' => ['Silver' => 0, 'Gold' => 0, 'Diamond' => 0],
        'Utility' => ['Silver' => 0, 'Gold' => 0, 'Diamond' => 0],
        'motorcycle' => ['Silver' => 0, 'Gold' => 0, 'Diamond' => 0],
        'vehicule' => ['Silver' => 0, 'Gold' => 0, 'Diamond' => 0],
    ];

    foreach ($gananciasData as $row) {
        $ganancias[$row['seguro']][$row['calidad']] = floatval($row['total_ganancias']);
    }

    // Calcula los totales de cada tipo de seguro
    $totalMedical = $ganancias['Medical']['Silver'] + $ganancias['Medical']['Gold'] + $ganancias['Medical']['Diamond'];
    $totalHome = $ganancias['Home']['Silver'] + $ganancias['Home']['Gold'] + $ganancias['Home']['Diamond'];
    $totalUtility = $ganancias['Utility']['Silver'] + $ganancias['Utility']['Gold'] + $ganancias['Utility']['Diamond'];
    $totalMotorcycle = $ganancias['motorcycle']['Silver'] + $ganancias['motorcycle']['Gold'] + $ganancias['motorcycle']['Diamond'];
    $totalVehicle = $ganancias['vehicule']['Silver'] + $ganancias['vehicule']['Gold'] + $ganancias['vehicule']['Diamond'];

    // Calcula las ganancias totales
    $totalEarnings = $totalMedical + $totalHome + $totalUtility + $totalMotorcycle + $totalVehicle;


} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
    exit;
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>LifeLine</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="../../assets/images/favicon.ico">

    <link href="../../plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../plugins/morris/morris.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">


    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/style2.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="../../assets/boss/images/favicon.png">
</head>

<body>
    <div id="wrapper">
        <div class="topbar">
            <div class="topbar-left">
                <a href="Admin.php" class="logo">
                    <img src="../../assets/boss/images/logo.png" class="logo-lg" alt="" height="45">
                    <img src="../../assets/boss/images/header-software-app.png" class="logo-sm" alt="" height="34">
                </a>
            </div>

            <div class="search-wrap" id="search-wrap">
                <div class="search-bar">
                    <input class="search-input" type="search" placeholder="Buscar" />
                    <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                        <i class="mdi mdi-close-circle"></i>
                    </a>
                </div>
            </div>

            <nav class="navbar-custom">
                <ul class="navbar-right list-inline float-right mb-0">

                    <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href=""
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="assets/images/flags/spain_flag.jpg" class="mr-2" height="12" alt="" /> Español <span
                                class="mdi mdi-chevron-down"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated language-switch">
                            <a class="dropdown-item" href="../Admin/Admin.php"><img
                                    src="../../assets/images/flags/us_flag.jpg" alt="" height="16" /><span> English
                                </span></a>
                        </div>
                    </li>
                    <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                        <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                            <i class="fas fa-expand noti-icon"></i>
                        </a>
                    </li>

                    <li class="dropdown notification-list list-inline-item">
                        <div class="dropdown notification-list nav-pro-img">
                            <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown"
                                href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="../../assets/images/users/gear.png" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                                <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Perfil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="../user/logout.php"><i
                                        class="mdi mdi-power text-danger"></i> Cerrar sesión</a>
                            </div>
                        </div>
                    </li>
                </ul>

                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left waves-effect">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="left side-menu">
            <div class="slimscroll-menu" id="remove-scroll">
                <div id="sidebar-menu">
                    <ul class="metismenu" id="side-menu">
                        <li class="menu-title">Menú</li>
                        <li>
                            <a href="Admin.php" class="waves-effect">
                                <i class="dripicons-meter"></i><span
                                    class="badge badge-info badge-pill float-right"></span> <span> Tablero </span>
                            </a>
                        </li>
                        <li>
                            <a href="TablaU.php" class="waves-effect"><i class="fas fa-users"></i><span> Tabla de Usuarios
                                </span></a>
                        </li>
                        <li>
                            <a href="tabla_compras.php" class="waves-effect"><i class="fas fa-dollar-sign"></i><span>
                                    Registro de Compras </span></a>
                        </li>
                        <li>
                            <a href="seguros.php" class="waves-effect"><i class="fas fa-shield-alt"></i><span> Tabla de Seguros
                                    </span></a>
                        </li>


                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-list"></i><span>
                                    Tabla de Socios <span class="float-right menu-arrow"><i
                                            class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="Tabla_medico.php">Tabla Médica</a></li>
                                <li><a href="Tabla_taller.php">Tabla de Talleres Mecánicos</a></li>
                                <li><a href="Tabla_contructora.php">Tabla de Construcción</a></li>
                            </ul>

                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-list"></i><span>
                                    Tabla de Beneficiarios Registrados <span class="float-right menu-arrow"><i
                                            class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="Tabla_datosVehi.php">Datos de Póliza de Vehículos</a></li>
                                <li><a href="Tabla_datosVida.php">Datos de Póliza de Salud</a></li>
                                <li><a href="Tabla_datosCasa.php">Datos de Póliza de Propiedad</a></li>
                            </ul>

                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="page-title-box">
                        <div class="row align-items-center ">
                            <div class="col-md-8">
                                <div class="page-title-box">
                                    <h4 class="page-title">Tablero</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active">Bienvenido al Tablero de LifeLine</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- start top-Content -->
                    <div class="row">
                        <div class="col-md-4 col-xl-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center p-1">
                                        <div class="col-lg-12">
                                            <h5 class="font-16">Ganancias Médicas</h5>
                                            <h4 class="text-info pt-1 mb-0">
                                                $<?php echo number_format($totalMedical, 2); ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center p-1">
                                        <div class="col-lg-12">
                                            <h5 class="font-16">Ganancias de Propiedades</h5>
                                            <h4 class="text-warning pt-1 mb-0">
                                                $<?php echo number_format($totalHome, 2); ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center p-1">
                                        <div class="col-lg-12">
                                            <h5 class="font-16">Ganancias de Servicios</h5>
                                            <h4 class="text-primary pt-1 mb-0">
                                                $<?php echo number_format($totalUtility, 2); ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center p-1">
                                        <div class="col-lg-12">
                                            <h5 class="font-16">Ganancias de Motocicletas</h5>
                                            <h4 class="text-danger pt-1 mb-0">
                                                $<?php echo number_format($totalMotorcycle, 2); ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center p-1">
                                        <div class="col-lg-12">
                                            <h5 class="font-16">Ganancias de Vehículos</h5>
                                            <h4 class="text-success pt-1 mb-0">
                                                $<?php echo number_format($totalVehicle, 2); ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center p-1">
                                        <div class="col-lg-12">
                                            <h5 class="font-16">Ganancias Totales</h5>
                                            <h4 class="text-primary pt-1 mb-0">
                                                $<?php echo number_format($totalEarnings, 2); ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-4 col-xl-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center p-1">
                                        <div class="col-lg-12">
                                            <h5 class="font-16">Ganancias de Comision de Asociados</h5>
                                            <h4 class="text-primary pt-1 mb-0">
                                                $<?php echo number_format($totalPlanes, 2); ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end top-Content -->

                    <div class="row">
                        <div class="col-xl-6">

                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">Estadísticas de Solicitudes</h4>
                                    <div style="max-width: 885px; margin: auto;">
                                        <canvas id="requestsChart"></canvas>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">Estadísticas de Usuarios</h4>
                                    <div style="max-width: 375px; margin: auto;">
                                        <canvas id="userChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">Estadísticas de Calidad de Seguros Médicos</h4>
                                    <div style="max-width: 700px; margin: auto;">
                                        <canvas id="medicalChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">Estadísticas de Calidad de Seguros de Propiedad</h4>
                                    <div style="max-width: 700px; margin: auto;">
                                        <canvas id="homeChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title mb-4">Estadísticas de Calidad de Seguros de Servicios, Vehículos y Motocicletas</h4>
                                        <div style="max-width: 885px; margin: auto;">
                                            <canvas id="insuranceChart"></canvas>
                                        </div>
                                    </div>
                                </div>



                            </div>

                        </div>

                        <footer class="footer">
                            © 2024 LifeLine
                        </footer>
                    </div>
                </div>

                <script src="../../assets/js/jquery.min.js"></script>
                <script src="../../assets/js/bootstrap.bundle.min.js"></script>
                <script src="../../assets/js/metismenu.min.js"></script>
                <script src="../../assets/js/jquery.slimscroll.js"></script>
                <script src="../../assets/js/waves.min.js"></script>
                <script src="../../plugins/apexchart/apexcharts.min.js"></script>
                <script src="../../plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
                <script src="../../plugins/morris/morris.min.js"></script>
                <script src="../../plugins/raphael/raphael.min.js"></script>
                <script src="../../assets/pages/dashboard.init.js"></script>
                <script src="../../assets/js/app.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    var ctxInsurance = document.getElementById('insuranceChart').getContext('2d');
                    var insuranceChart = new Chart(ctxInsurance, {
                        type: 'bar',
                        data: {
                            labels: ['Plata', 'Oro', 'Diamante'],
                            datasets: [
                                {
                                    label: 'Utility',
                                    data: [<?php echo $chartData['Utility']['Silver']; ?>, <?php echo $chartData['Utility']['Gold']; ?>, <?php echo $chartData['Utility']['Diamond']; ?>],
                                    backgroundColor: 'rgba(75, 192, 192, 1)',  // Color mate
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Vehículo',
                                    data: [<?php echo $chartData['Vehicule']['Silver']; ?>, <?php echo $chartData['Vehicule']['Gold']; ?>, <?php echo $chartData['Vehicule']['Diamond']; ?>],
                                    backgroundColor: 'rgba(54, 162, 235, 1)',  // Color mate
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Motocicleta',
                                    data: [<?php echo $chartData['motorcycle']['Silver']; ?>, <?php echo $chartData['motorcycle']['Gold']; ?>, <?php echo $chartData['motorcycle']['Diamond']; ?>],
                                    backgroundColor: 'rgba(249, 191, 41, 1)',  // Color mate
                                    borderColor: 'rgba(249, 191, 41, 1)',
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            let label = context.dataset.label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            if (context.raw !== null) {
                                                label += context.raw;
                                            }
                                            return label;
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>

                <script>
                    var ctx = document.getElementById('userChart').getContext('2d');
                    var userChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Administradores', 'Usuarios Regulares', 'Soporte'],
                            datasets: [{
                                label: 'Número de Usuarios',
                                data: [<?php echo $result['total_admins']; ?>, <?php echo $result['total_regular_users']; ?>, <?php echo $result['total_support']; ?>],
                                backgroundColor: [
                                    'rgba(59, 93, 80, 1)',  // Rojo mate
                                    'rgba(54, 162, 235, 1)',  // Azul mate
                                    'rgba(249, 191, 41, 1)'   // Amarillo mate
                                ],
                                borderColor: [
                                    'rgba(59, 93, 80, 1)',  // Rojo mate
                                    'rgba(54, 162, 235, 1)',  // Azul mate
                                    'rgba(249, 191, 41, 1)'   // Amarillo mate
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            let label = context.label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            if (context.parsed !== null) {
                                                label += context.parsed;
                                            }
                                            return label;
                                        }
                                    }
                                }
                            }
                        }
                    });

                    var ctxRequests = document.getElementById('requestsChart').getContext('2d');
                    var requestsChart = new Chart(ctxRequests, {
                        type: 'bar',
                        data: {
                            labels: ['Pendientes', 'Aceptadas', 'Denegadas'],
                            datasets: [
                                {
                                    label: 'MÉDICOS',
                                    data: [<?php echo intval($resultAsociados['pending_asociados']); ?>, <?php echo intval($resultAsociados['accepted_asociados']); ?>, <?php echo intval($resultAsociados['denied_asociados']); ?>],
                                    backgroundColor: 'rgba(59, 93, 80, 1)',  // Rojo mate
                                    borderColor: 'rgba(59, 93, 80, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'CONSTRUCTORAS',
                                    data: [<?php echo intval($resultConstructuras['pending_constructuras']); ?>, <?php echo intval($resultConstructuras['accepted_constructuras']); ?>, <?php echo intval($resultConstructuras['denied_constructuras']); ?>],
                                    backgroundColor: 'rgba(54, 162, 235, 1)',  // Azul mate
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'TALLERES MECÁNICOS',
                                    data: [<?php echo intval($resultTalleres['pending_talleres']); ?>, <?php echo intval($resultTalleres['accepted_talleres']); ?>, <?php echo intval($resultTalleres['denied_talleres']); ?>],
                                    backgroundColor: 'rgba(249, 191, 41, 1)',  // Amarillo mate
                                    borderColor: 'rgba(249, 191, 41, 1)',
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            let label = context.dataset.label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            if (context.raw !== null) {
                                                label += context.raw;
                                            }
                                            return label;
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>

                <script>
                    var ctxMedical = document.getElementById('medicalChart').getContext('2d');
                    var medicalChart = new Chart(ctxMedical, {
                        type: 'bar',
                        data: {
                            labels: ['Plata', 'Oro', 'Diamante'],
                            datasets: [
                                {
                                    label: 'Seguro Médico',
                                    data: [<?php echo $medicalChartData['Silver']; ?>, <?php echo $medicalChartData['Gold']; ?>, <?php echo $medicalChartData['Diamond']; ?>],
                                    backgroundColor: [
                                        'rgba(192, 192, 192, 1)',  // Silver mate
                                        'rgba(255, 215, 0, 1)',    // Oro mate
                                        'rgba(185, 242, 255, 1)'   // Diamante mate
                                    ],
                                    borderColor: [
                                        'rgba(192, 192, 192, 1)',  // Silver mate
                                        'rgba(255, 215, 0, 1)',    // Oro mate
                                        'rgba(185, 242, 255, 1)'   // Diamante mate
                                    ],
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            let label = context.dataset.label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            if (context.raw !== null) {
                                                label += context.raw;
                                            }
                                            return label;
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>

                <script>
                    var ctxHome = document.getElementById('homeChart').getContext('2d');
                    var homeChart = new Chart(ctxHome, {
                        type: 'bar',
                        data: {
                            labels: ['Plata', 'Oro', 'Diamante'],
                            datasets: [
                                {
                                    label: 'Seguro de Propiedad',
                                    data: [<?php echo $homeChartData['Silver']; ?>, <?php echo $homeChartData['Gold']; ?>, <?php echo $homeChartData['Diamond']; ?>],
                                    backgroundColor: [
                                        'rgba(192, 192, 192, 1)',  // Silver mate
                                        'rgba(255, 215, 0, 1)',    // Oro mate
                                        'rgba(185, 242, 255, 1)'   // Diamante mate
                                    ],
                                    borderColor: [
                                        'rgba(192, 192, 192, 1)',  // Silver mate
                                        'rgba(255, 215, 0, 1)',    // Oro mate
                                        'rgba(185, 242, 255, 1)'   // Diamante mate
                                    ],
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            let label = context.dataset.label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            if (context.raw !== null) {
                                                label += context.raw;
                                            }
                                            return label;
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>



</body>

</html>
