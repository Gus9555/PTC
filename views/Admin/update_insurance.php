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

$pdo = getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Procesar la actualización
    $seguro = $_POST['seguro'];
    $calidad = $_POST['calidad'];
    $descripcion1 = $_POST['descripcion'];
    $descripcion2 = $_POST['descripcion2'];
    $descripcion3 = $_POST['descripcion3'];
    $descripcion4 = $_POST['descripcion4'];
    $descripcion5 = $_POST['descripcion5'];
    $descripcion6 = $_POST['descripcion6'];
    $precio = $_POST['precio'];
    $id = $_POST['id'];

    $sqlUpdate = "UPDATE seguros SET 
                    seguro = :seguro, 
                    calidad = :calidad, 
                    descripcion = :descripcion, 
                    descripcion2 = :descripcion2, 
                    descripcion3 = :descripcion3, 
                    descripcion4 = :descripcion4, 
                    descripcion5 = :descripcion5, 
                    descripcion6 = :descripcion6, 
                    precio = :precio 
                  WHERE id = :id";
    $stmtUpdate = $pdo->prepare($sqlUpdate);
    $stmtUpdate->bindParam(':seguro', $seguro);
    $stmtUpdate->bindParam(':calidad', $calidad);
    $stmtUpdate->bindParam(':descripcion', $descripcion1);
    $stmtUpdate->bindParam(':descripcion2', $descripcion2);
    $stmtUpdate->bindParam(':descripcion3', $descripcion3);
    $stmtUpdate->bindParam(':descripcion4', $descripcion4);
    $stmtUpdate->bindParam(':descripcion5', $descripcion5);
    $stmtUpdate->bindParam(':descripcion6', $descripcion6);
    $stmtUpdate->bindParam(':precio', $precio);
    $stmtUpdate->bindParam(':id', $id);
    $stmtUpdate->execute();

    header("Location: seguros.php");
    exit();
}

try {
    // Consulta para obtener los seguros
    $sqlSeguros = "SELECT * FROM seguros";
    $stmtSeguros = $pdo->prepare($sqlSeguros);
    $stmtSeguros->execute();
    $resultado = $stmtSeguros->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
    exit;
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
                    <li class="list-inline-item dropdown notification-list d-none d-md-inline-block">
                        <a class="nav-link waves-effect toggle-search" href="#" data-target="#search-wrap">
                            <i class="fas fa-search noti-icon"></i>
                        </a>
                    </li>

                    <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown"
                            href="../Admin/Admin.php" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="assets/images/flags/us_flag.jpg" class="mr-2" height="12" alt="" /> English
                            <span class="mdi mdi-chevron-down"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated language-switch">
                            <a class="dropdown-item" href="../Admin_spanish/update_insurance.php"><img
                                    src="../../assets/images/flags/spain_flag.jpg" alt="" height="16" /><span> Spanish
                                </span></a>
                        </div>
                    </li>

                    <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                        <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                            <i class="fas fa-expand noti-icon"></i>
                        </a>
                    </li>

                    <li class="dropdown notification-list list-inline-item">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fas fa-bell noti-icon"></i>
                            <span class="badge badge-pill badge-danger noti-icon-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg px-1">
                            <h6 class="dropdown-item-text">Notifications</h6>
                            <div class="slimscroll notification-item-list">
                                <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy
                                            text of the printing and typesetting industry.</span></p>
                                </a>

                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i>
                                    </div>
                                    <p class="notify-details"><b>New Message received</b><span class="text-muted">You
                                            have 87 unread messages</span></p>
                                </a>

                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info"><i class="mdi mdi-filter-outline"></i></div>
                                    <p class="notify-details"><b>Your item is shipped</b><span class="text-muted">It is
                                            a long established fact that a reader will</span></p>
                                </a>

                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-message-text-outline"></i>
                                    </div>
                                    <p class="notify-details"><b>New Message received</b><span class="text-muted">You
                                            have 87 unread messages</span></p>
                                </a>

                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-warning"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy
                                            text of the printing and typesetting industry.</span></p>
                                </a>

                            </div>
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
                                <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Profile</a>
                                <a class="dropdown-item d-block" href="#"><span
                                        class="badge badge-success float-right">11</span><i
                                        class="mdi mdi-settings"></i> Settings</a>
                                <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline"></i> Lock
                                    screen</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="../user/logout.php"><i
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
                                    Tabla de compras </span></a>
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
                                    <h4 class="page-title">Insurance Table</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="javascript:void(0);">LifeLine</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="javascript:void(0);">Tables</a>
                                        </li>
                                        <li class="breadcrumb-item active">Insurance Table</li>
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
                                    <h4 class="mt-0 header-title">LifeLine Edit Insurance</h4>

                                    <p class="sub-title">In this section you can edit the available insurances.
                                    </p>

                                    <table id="datatable-buttons"
                                        class="table table-striped table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Insurance</th>
                                                <th>Quality</th>
                                                <th>Description1</th>
                                                <th>Description2</th>
                                                <th>Description3</th>
                                                <th>Description4</th>
                                                <th>Description5</th>
                                                <th>Description6</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($resultado as $row) { ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['seguro']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['calidad']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['descripcion2']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['descripcion3']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['descripcion4']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['descripcion5']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['descripcion6']); ?></td>
                                                    <td>$<?php echo htmlspecialchars($row['precio']); ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-toggle="modal" data-target="#editModal"
                                                            data-id="<?php echo $row['id']; ?>"
                                                            data-seguro="<?php echo $row['seguro']; ?>"
                                                            data-calidad="<?php echo $row['calidad']; ?>"
                                                            data-descripcion="<?php echo $row['descripcion']; ?>"
                                                            data-descripcion2="<?php echo $row['descripcion2']; ?>"
                                                            data-descripcion3="<?php echo $row['descripcion3']; ?>"
                                                            data-descripcion4="<?php echo $row['descripcion4']; ?>"
                                                            data-descripcion5="<?php echo $row['descripcion5']; ?>"
                                                            data-descripcion6="<?php echo $row['descripcion6']; ?>"
                                                            data-precio="<?php echo $row['precio']; ?>">Edit</button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

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

    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Insurance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="seguros.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="insuranceId">
                        <div class="form-group">
                            <label for="insuranceName">Insurance</label>
                            <input type="text" class="form-control" id="insuranceName" name="seguro">
                        </div>
                        <div class="form-group">
                            <label for="insuranceQuality">Quality</label>
                            <input type="text" class="form-control" id="insuranceQuality" name="calidad">
                        </div>
                        <div class="form-group">
                            <label for="description1">Description 1</label>
                            <input type="text" class="form-control" id="description1" name="descripcion">
                        </div>
                        <div class="form-group">
                            <label for="description2">Description 2</label>
                            <input type="text" class="form-control" id="description2" name="descripcion2">
                        </div>
                        <div class="form-group">
                            <label for="description3">Description 3</label>
                            <input type="text" class="form-control" id="description3" name="descripcion3">
                        </div>
                        <div class="form-group">
                            <label for="description4">Description 4</label>
                            <input type="text" class="form-control" id="description4" name="descripcion4">
                        </div>
                        <div class="form-group">
                            <label for="description5">Description 5</label>
                            <input type="text" class="form-control" id="description5" name="descripcion5">
                        </div>
                        <div class="form-group">
                            <label for="description6">Description 6</label>
                            <input type="text" class="form-control" id="description6" name="descripcion6">
                        </div>
                        <div class="form-group">
                            <label for="insurancePrice">Price</label>
                            <input type="text" class="form-control" id="insurancePrice" name="precio">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

    <script>
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var seguro = button.data('seguro');
            var calidad = button.data('calidad');
            var descripcion = button.data('descripcion');
            var descripcion2 = button.data('descripcion2');
            var descripcion3 = button.data('descripcion3');
            var descripcion4 = button.data('descripcion4');
            var descripcion5 = button.data('descripcion5');
            var descripcion6 = button.data('descripcion6');
            var precio = button.data('precio');

            var modal = $(this);
            modal.find('#insuranceId').val(id);
            modal.find('#insuranceName').val(seguro);
            modal.find('#insuranceQuality').val(calidad);
            modal.find('#description1').val(descripcion);
            modal.find('#description2').val(descripcion2);
            modal.find('#description3').val(descripcion3);
            modal.find('#description4').val(descripcion4);
            modal.find('#description5').val(descripcion5);
            modal.find('#description6').val(descripcion6);
            modal.find('#insurancePrice').val(precio);
        });
    </script>
</body>

</html>