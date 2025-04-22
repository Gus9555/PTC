<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>LifeLine</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
    <link rel="icon" href="../../assets/boss/images/favicon.png">
</head>

<body>

    <?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require '../../funcs/conexion.php';
    require '../../funcs/funcs.php';

    if (!isset($_SESSION['id'])) {
        header("Location: ../../views/user/login.php");
        exit();
    }

    $id = $_SESSION['id'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    try {
        $pdo = getConnection();
        // Obtener todos los usuarios para la tabla
        $sqlUsers = "SELECT * FROM datos_vehiculos";
        $stmtUsers = $pdo->prepare($sqlUsers);
        $stmtUsers->execute();
        $resultado = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Query failed: ' . $e->getMessage();
        exit;
    }
    $activacion = [
        1 => 'Active',
        2 => 'Pending...',
        3 => 'Denied'
    ];
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>LifeLine</title>
        <link rel="shortcut icon" href="../../assets/boss/images/favicon.png">
        <link href="../../plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="../../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../../plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../../plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="../../assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
        <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="../../assets/css/style2.css" rel="stylesheet" type="text/css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Incluir SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Incluir SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        <input class="search-input" type="search" placeholder="Search" />
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
                                <img src="assets/images/flags/us_flag.jpg" class="mr-2" height="12" alt="" /> English
                                <span class="mdi mdi-chevron-down"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated language-switch">
                                <a class="dropdown-item" href="../Admin_spanish/Tabla_datosVehi.php"><img
                                        src="../../assets/images/flags/spain_flag.jpg" alt="" height="16" /><span>
                                        Spanish
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
                                <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user"
                                    data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                    aria-expanded="false">
                                    <img src="../../assets/images/users/gear.png" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Profile</a>

                                    <a class="dropdown-item text-danger" href="../user/logout.php"><i
                                            class="mdi mdi-power text-danger"></i> Logout</a>
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
                        <li class="menu-title">Menu</li>
                        <li>
                            <a href="Admin.php" class="waves-effect">
                                <i class="dripicons-meter"></i><span
                                    class="badge badge-info badge-pill float-right"></span> <span> Dashboard </span>
                            </a>
                        </li>
                        <li>
                            <a href="TablaU.php" class="waves-effect"><i class="fas fa-users"></i><span> User Table
                                </span></a>
                        </li>
                        <li>
                            <a href="tabla_compras.php" class="waves-effect"><i class="fas fa-dollar-sign"></i><span>
                            Purchase register </span></a>
                        </li>
                        <li>
                            <a href="seguros.php" class="waves-effect"><i class="fas fa-shield-alt"></i><span> Insurance
                                    Table </span></a>
                        </li>


                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-list"></i><span>
                                    Partners Table <span class="float-right menu-arrow"><i
                                            class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="Tabla_medico.php">Medical Table</a></li>
                                <li><a href="Tabla_taller.php">Mechanical Workshop Table</a></li>
                                <li><a href="Tabla_contructora.php">Construction Table</a></li>
                            </ul>

                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-list"></i><span>
                            Table of Registered Beneficiaries <span class="float-right menu-arrow"><i
                                            class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="Tabla_datosVehi.php">Vehicle Policy Data</a></li>
                                <li><a href="Tabla_datosVida.php">Health Policy Data</a></li>
                                <li><a href="Tabla_datosCasa.php">Property Policy Data</a></li>
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
                                        <h4 class="page-title">Vehicle Insurance Table</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="javascript:void(0);">LifeLine</a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="javascript:void(0);">Tables</a>
                                            </li>
                                            <li class="breadcrumb-item active">Associates Table</li>
                                        </ol>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="float-right d-none d-md-block app-datepicker">
                                        <input type="text" class="form-control" data-date-format="MM dd, yyyy"
                                            readonly="readonly" id="datepicker">
                                        <i class="mdi mdi-chevron-down mdi-drop"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="sub-title">Here are the requests from our customers to link a property or someone to their insurance policy
                                        </p>


                                        <table id="datatable-buttons"
                                            class="table table-striped table-bordered dt-responsive nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Circulation Card</th>
                                                    <th>Personal ID</th>
                                                    <th>Phone Number</th>
                                                    <th>beneficiarys' Name</th>
                                                    <th>E-Mail</th>
                                                    <th>Benefiarys' Phone Number</th>
                                                    <th>Relationship</th>
                                                    <th>Active</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($resultado as $row) { ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                                                        <td><a href='Descarga_doc/download_d_vehiculos.php?id=<?php echo $row['id']; ?>'>Download the submitted Documentation</a></td>
                                                        <td><?php echo htmlspecialchars($row['dui']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['num_tel']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['email']);?></td>
                                                        <td><?php echo htmlspecialchars($row['num_benefi']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['parentesco']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['activation']); ?></td>
                                                        <td>
                                                            <form action="Action/accion_vehi.php" method="post" >
                                                            
                                                                <input type="hidden" name="id" id="id"
                                                                    value="<?php echo $row['id']; ?>">
                                                                <button type="submit" name="action" value="accept"
                                                                    class="btn btn-success btn-sm">Accept</button>
                                                                <button type="submit" name="action" value="denied"
                                                                    class="btn btn-warning btn-sm">Denied</button>
                                                                <button type="submit" name="action" value="deleted"
                                                                    class="btn btn-warning btn-sm">Delete</button>
                                                            </form>
                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <div style="width: 50%; margin: auto;">
                                            <canvas id="userChart" width="400" height="200"></canvas>
                                        </div>

                                    </div>
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
        <script>
            var ctx = document.getElementById('userChart').getContext('2d');
            var userChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Total Users', 'Admins', 'Users', 'Support'],
                    datasets: [{
                        label: 'Number of Users',
                        data: [<?php echo $result['total_users']; ?>, <?php echo $result['total_admins']; ?>, <?php echo $result['total_regular_users']; ?>, <?php echo $result['total_support']; ?>],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/js/metismenu.min.js"></script>
        <script src="../../assets/js/jquery.slimscroll.js"></script>
        <script src="../../assets/js/waves.min.js"></script>
        <script src="../../plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../../plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="../../plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="../../plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="../../plugins/datatables/jszip.min.js"></script>
        <script src="../../plugins/datatables/pdfmake.min.js"></script>
        <script src="../../plugins/datatables/vfs_fonts.js"></script>
        <script src="../../plugins/datatables/buttons.html5.min.js"></script>
        <script src="../../plugins/datatables/buttons.print.min.js"></script>
        <script src="../../plugins/datatables/buttons.colVis.min.js"></script>
        <script src="../../plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="../../plugins/datatables/responsive.bootstrap4.min.js"></script>
        <script src="../../assets/pages/datatables.init.js"></script>
        <script src="../../assets/js/app.js"></script>

    </body>

    </html>