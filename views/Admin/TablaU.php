<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeLine</title>
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
    header("Location: ../../views/login.php");
    exit();
}

$id = $_SESSION['id'];
$tipo_usuario = $_SESSION['tipo_usuario'];

if ($tipo_usuario == 1) {
    $where = "";
} else if ($tipo_usuario == 2) {
    $where = "WHERE id=$id";
}

$sql = "SELECT * FROM users $where";
$resultado = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title></title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="../../plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <!-- DataTables -->
    <link href="../../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="../../plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/style2.css" rel="stylesheet" type="text/css">

</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="Admin.php" class="logo">
                    <img src="../../assets/boss/images/logo.png" class="logo-lg" alt="" height="45">
                    <img src="../../assets/boss/images/header-software-app.png" class="logo-sm" alt="" height="34">
                </a>
            </div>

            <!-- Search input -->
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

                    <li class="list-inline-item dropdown notification-list d-none d-md-inline-block">
                        <a class="nav-link waves-effect toggle-search" href="#" data-target="#search-wrap">
                            <i class="fas fa-search noti-icon"></i>
                        </a>
                    </li>

                    <!-- language-->
                    <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="../Admin/Admin.php"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="../../assets/images/flags/us_flag.jpg" class="mr-2" height="12" alt="" /> English
                            <span class="mdi mdi-chevron-down"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated language-switch">
                            <a class="dropdown-item" href="../Admin_spanish/TablaU.php"><img src="../../assets/images/flags/spain_flag.jpg" alt=""
                                    height="16" /><span> Spanish </span></a>
                           
                        </div>
                    </li>

                    <!-- full screen -->
                    <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                        <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                            <i class="fas fa-expand noti-icon"></i>
                        </a>
                    </li>

                    <!-- notification -->
                    <li class="dropdown notification-list list-inline-item">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fas fa-bell noti-icon"></i>
                            <span class="badge badge-pill badge-danger noti-icon-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg px-1">
                            <!-- item-->
                            <h6 class="dropdown-item-text">
                                Notifications
                            </h6>
                            <div class="slimscroll notification-item-list">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy
                                            text of the printing and typesetting industry.</span></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i>
                                    </div>
                                    <p class="notify-details"><b>New Message received</b><span class="text-muted">You
                                            have 87 unread messages</span></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info"><i class="mdi mdi-filter-outline"></i></div>
                                    <p class="notify-details"><b>Your item is shipped</b><span class="text-muted">It is
                                            a long established fact that a reader will</span></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-message-text-outline"></i>
                                    </div>
                                    <p class="notify-details"><b>New Message received</b><span class="text-muted">You
                                            have 87 unread messages</span></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-warning"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy
                                            text of the printing and typesetting industry.</span></p>
                                </a>

                            </div>
                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-center notify-all text-primary">
                                View all <i class="fi-arrow-right"></i>
                            </a>
                        </div>
                    </li>

                    <li class="dropdown notification-list list-inline-item">
                        <div class="dropdown notification-list nav-pro-img">
                            <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown"
                                href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="../../assets/images/users/user-1.jpg" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                                <!-- item-->
                                <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="mdi mdi-wallet"></i> My Wallet</a>
                                <a class="dropdown-item d-block" href="#"><span
                                        class="badge badge-success float-right">11</span><i
                                        class="mdi mdi-settings"></i> Settings</a>
                                <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline"></i> Lock
                                    screen</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="../../views/logout.php"><i
                                        class="mdi mdi-power text-danger"></i>
                                    Logout</a>
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
        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="slimscroll-menu" id="remove-scroll">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu" id="side-menu">
                        <li class="menu-title">Menu</li>
                        <li>
                            <a href="Admin.php" class="waves-effect">
                                <i class="dripicons-meter"></i><span
                                    class="badge badge-info badge-pill float-right">9+</span> <span> Dashboard </span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-list"></i><span>
                                    Tables <span class="float-right menu-arrow"><i
                                            class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="TablaU.php">User Table</a></li>
                            </ul>
                        </li>
                    </ul>

                </div>
                <!-- Sidebar -->
                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
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
                    <!-- end page-title -->

                    <!-- end row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="mt-0 header-title">lifeline user table</h4>
                                    <p class="sub-title">In this section, a detailed list of all users who have
                                        completed the registration process on the platform is presented. Here you can
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
                                                <th>Usuario</th>
                                                <th>Correo</th>
                                                <th>Nombre</th>
                                                <th>Tipo Usuario</th>

                                                <!-- <th>Eliminar</th> -->
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $indice = 0; ?>
                                            <?php while ($row = $resultado->fetch_assoc()) { ?>
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['usuario']; ?></td>
                                                    <td><?php echo $row['correo']; ?></td>
                                                    <td><?php echo $row['nombre']; ?></td>
                                                    <td><?php if ($row['id_tipo'] == 2) {
                                                        echo "usuario";
                                                    } else if ($row['id_tipo'] == 1) {
                                                        echo "admin";
                                                    }
                                                    ; ?></td>



                                                    <!--<td>
                                                        <a
                                                            href="eliminar.php?id=<?php echo $row["id"]; ?>&id_tipo=<?php echo $row["id_tipo"]; ?>">Eliminar</a>

                                                    </td>  -->
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                </div>
                <!-- container-fluid -->

            </div>
            <!-- content -->

            <footer class="footer">
                © 2024 LifeLine
            </footer>

        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- jQuery  -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/metismenu.min.js"></script>
    <script src="../../assets/js/jquery.slimscroll.js"></script>
    <script src="../../assets/js/waves.min.js"></script>

    <script src="../../plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <!-- Required datatable js -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="../../plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables/jszip.min.js"></script>
    <script src="../../plugins/datatables/pdfmake.min.js"></script>
    <script src="../../plugins/datatables/vfs_fonts.js"></script>
    <script src="../../plugins/datatables/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables/buttons.print.min.js"></script>
    <script src="../../plugins/datatables/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="../../plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="../../assets/pages/datatables.init.js"></script>

    <!-- App js -->
    <script src="../../assets/js/app.js"></script>

</body>

</html>