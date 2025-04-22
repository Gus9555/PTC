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

        // Consulta para contar los tipos de usuarios
        $sql = "SELECT 
                COUNT(*) as total_users, 
                COUNT(CASE WHEN id_tipo = 1 THEN 1 END) as total_admins, 
                COUNT(CASE WHEN id_tipo = 2 THEN 1 END) as total_regular_users, 
                COUNT(CASE WHEN id_tipo = 3 THEN 1 END) as total_support,
                COUNT(CASE WHEN id_tipo = 4 THEN 1 END) as total_deactivated
            FROM users";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Obtener todos los usuarios para la tabla
        $sqlUsers = "SELECT * FROM users";
        $stmtUsers = $pdo->prepare($sqlUsers);
        $stmtUsers->execute();
        $resultado = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Query failed: ' . $e->getMessage();
        exit();
    }
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
                                <a class="dropdown-item" href="../Admin_spanish/TablaU.php"><img
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
                                        <h4 class="page-title">User Table</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="javascript:void(0);">LifeLine</a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="javascript:void(0);">Tables</a>
                                            </li>
                                            <li class="breadcrumb-item active">User Table</li>
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
                                        <h4 class="mt-0 header-title">LifeLine User Table</h4>
                                        <p class="sub-title">In this section, a detailed list of all users who have
                                            completed the registration process on the platform is presented. Here you
                                            can
                                            access key information about each user, such as their username and contact
                                            details if available. This resource provides a valuable overview of the
                                            platform's user base, which can help in community management, audience
                                            segmentation and data analysis to improve the user experience.
                                        </p>

                                        <table id="datatable-buttons"
                                            class="table table-striped table-bordered dt-responsive nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Name</th>
                                                    <th>Last Session Start</th>
                                                    <th>Account Code</th>
                                                    <th>Estatus</th>
                                                    <th>Date of registration</th>
                                                    <th>User Type</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($resultado as $row) { ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['usuario']); ?></td>
                                                        <td><?php $correo = decryptPayload($row['correo']); echo htmlspecialchars($correo); ?></td>
                                                        <td><?php $nombre = decryptPayload($row['nombre']); echo htmlspecialchars($nombre); ?></td>
                                                        <td><?php echo htmlspecialchars($row['last_session']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['codigo']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['estatus']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['fecha_registro']); ?></td>
                                                        <td>
                                                            <?php
                                                            switch ($row['id_tipo']) {
                                                                case 1:
                                                                    echo 'Admin';
                                                                    break;
                                                                case 2:
                                                                    echo 'User';
                                                                    break;
                                                                case 3:
                                                                    echo 'Support';
                                                                    break;
                                                                case 4:
                                                                    echo 'Deactived';
                                                                    break;
                                                                case 5:
                                                                    echo 'Associated';
                                                                    break;
                                                                default:
                                                                    echo 'Unknown';
                                                                    break;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <form action="eliminar.php" method="post">
                                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                                <input type="hidden" name="id_tipo" value="<?php echo $row['id_tipo'] == 4 ? 2 : 4; ?>">
                                                                <button type="submit" class="btn btn-<?php echo $row['id_tipo'] == 4 ? 'success' : 'danger'; ?> btn-sm"><?php echo $row['id_tipo'] == 4 ? 'Activate' : 'Deactivate'; ?></button>
                    
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
                    labels: ['Total Users', 'Admins', 'Users', 'Support', 'Deactivated'],
                    datasets: [{
                        label: 'Number of Users',
                        data: [<?php echo $result['total_users']; ?>, <?php echo $result['total_admins']; ?>, <?php echo $result['total_regular_users']; ?>, <?php echo $result['total_support']; ?>, <?php echo $result['total_deactivated']; ?>],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)'
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
