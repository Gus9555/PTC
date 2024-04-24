<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>LifeLine</title>
    <link rel="icon" href="../assets/boss/images/favicon.png">
</head>

<body>

</body>

</html>
<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        echo '<p><script>Swal.fire({
            title: "Warning",
            text: "LogIn again"
            }).then(function() {
            window.location = "../../views/index.php";
            });</script></p>';
        exit; // Salir del script si no hay sesión iniciada
    }
    
    $nombre = $_SESSION['nombre'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>LifeLine</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="../../assets/images/favicon.ico">

    <link href="../../plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="../../plugins/morris/morris.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
                <a href="index.html" class="logo">
                    <img src="../../assets/images/logo-light.png" class="logo-lg" alt="" height="22">
                    <img src="../../assets/images/logo-sm.png" class="logo-sm" alt="" height="24">
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
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="assets/images/flags/us_flag.jpg" class="mr-2" height="12" alt="" /> English <span class="mdi mdi-chevron-down"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated language-switch">
                            <a class="dropdown-item" href="#"><img src="../../assets/images/flags/french_flag.jpg" alt="" height="16" /><span> French </span></a>
                            <a class="dropdown-item" href="#"><img src="../../assets/images/flags/spain_flag.jpg" alt="" height="16" /><span> Spanish </span></a>
                            <a class="dropdown-item" href="#"><img src="../../assets/images/flags/russia_flag.jpg" alt="" height="16" /><span> Russian </span></a>
                            <a class="dropdown-item" href="#"><img src="../../assets/images/flags/germany_flag.jpg" alt="" height="16" /><span> German </span></a>
                            <a class="dropdown-item" href="#"><img src="../../assets/images/flags/italy_flag.jpg" alt="" height="16" /><span> Italian </span></a>
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
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="" href="../../views/support/home.php" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fas fa-bell noti-icon"></i>
                            <span class="badge badge-pill badge-danger noti-icon-badge">3</span>
                        </a>
                    </li>

                    <li class="dropdown notification-list list-inline-item">
                        <div class="dropdown notification-list nav-pro-img">
                            <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="../../assets/images/users/user-1.jpg" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                                <!-- item-->
                                <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="mdi mdi-wallet"></i> My Wallet</a>
                                <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="mdi mdi-settings"></i> Settings</a>
                                <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline"></i> Lock screen</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="../../views/logout.php"><i class="mdi mdi-power text-danger"></i> Logout</a>
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
                            <a href="index.html" class="waves-effect">
                                <i class="dripicons-meter"></i><span class="badge badge-info badge-pill float-right">9+</span> <span> Dashboard </span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-list"></i><span> Tables <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
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
                                    <h4 class="page-title">Dashboard</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active">Welcome to Zegva Dashboard</li>
                                    </ol>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="float-right d-none d-md-block app-datepicker">
                                    <input type="text" class="form-control" data-date-format="MM dd, yyyy" readonly="readonly" id="datepicker">
                                    <i class="mdi mdi-chevron-down mdi-drop"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page-title -->

                    <!-- start top-Contant -->
                    <div class="row">
                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center p-1">
                                        <div class="col-lg-6">
                                            <h5 class="font-16">Total Expenses</h5>
                                            <h4 class="text-info pt-1 mb-0">$67,670</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <div id="chart1"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center p-1">
                                        <div class="col-lg-6">
                                            <h5 class="font-16">Total Invoice</h5>
                                            <h4 class="text-warning pt-1 mb-0">$7,360</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <div id="chart2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center p-1">
                                        <div class="col-lg-6">
                                            <h5 class="font-16">Amount Due</h5>
                                            <h4 class="text-primary pt-1 mb-0">$5000</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <div id="chart3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center p-1">
                                        <div class="col-lg-6">
                                            <h5 class="font-16">Unpaid Invoices</h5>
                                            <h4 class="text-danger pt-1 mb-0">$2,480</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <div id="chart4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end top-Contant -->

                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">Sales Statistics</h4>
                                    <ul class="list-inline widget-chart mt-4 mb-0 text-center">
                                        <li class="list-inline-item">
                                            <h5>3654</h5>
                                            <p class="text-muted">Marketplace</p>
                                        </li>
                                        <li class="list-inline-item">
                                            <h5>954</h5>
                                            <p class="text-muted">Last week</p>
                                        </li>
                                        <li class="list-inline-item">
                                            <h5>8462</h5>
                                            <p class="text-muted">Last Month</p>
                                        </li>
                                    </ul>
                                    <div id="morris-bar-stacked" class="text-center" style="height: 350px;"></div>

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">Trends Monthly</h4>
                                    <ul class="list-inline widget-chart mt-4 mb-0 text-center">
                                        <li class="list-inline-item">
                                            <h5>3654</h5>
                                            <p class="text-muted">Marketplace</p>
                                        </li>
                                        <li class="list-inline-item">
                                            <h5>954</h5>
                                            <p class="text-muted">Last week</p>
                                        </li>
                                        <li class="list-inline-item">
                                            <h5>8462</h5>
                                            <p class="text-muted">Last Month</p>
                                        </li>
                                    </ul>
                                    <div id="morris-donut-example" class="morris-charts morris-chart-height text-center" style="height: 350px;"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">

                        <div class="col-xl-4">
                            <div class="card messages">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">Latest Messages</h4>
                                    <nav>
                                        <div class="nav nav-tabs messages-tabs tab-wid nav-justified" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-first-tab" data-toggle="tab" href="#nav-first" role="tab" aria-controls="nav-first" aria-selected="true">
                                                <h5 class="mt-0 date">14</h5>
                                                <p class="text-muted mb-0">April</p>
                                            </a>
                                            <a class="nav-item nav-link" id="nav-second-tab" data-toggle="tab" href="#nav-second" role="tab" aria-controls="nav-second" aria-selected="false">
                                                <h5 class="mt-0 date">16</h5>
                                                <p class="text-muted mb-0">April</p>
                                            </a>
                                        </div>
                                    </nav>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="nav-first" role="tabpanel" aria-labelledby="nav-first-tab">
                                            <div class="p-2 mt-2">
                                                <ul class="list-unstyled latest-message-list mb-0">
                                                    <li class="message-list-item">
                                                        <a href="#">
                                                            <div class="media">
                                                                <img class="mr-3 thumb-md rounded-circle" src="../../assets/images/users/user-2.jpg" alt="">
                                                                <div class="media-body">
                                                                    <p class="float-right font-12 text-muted">Just Now</p>
                                                                    <h6 class="mt-0">Mary Frye</h6>
                                                                    <p class="text-muted mb-0">Hey! there I'm available...</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="message-list-item">
                                                        <a href="#">
                                                            <div class="media">
                                                                <img class="mr-3 thumb-md rounded-circle" src="../../assets/images/users/user-3.jpg" alt="">
                                                                <div class="media-body">
                                                                    <p class="float-right font-12 text-muted">11:42am</p>
                                                                    <h6 class="mt-0">David Smith</h6>
                                                                    <p class="text-muted mb-0">I've finished it! See you so...</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="message-list-item">
                                                        <a href="#">
                                                            <div class="media">
                                                                <img class="mr-3 thumb-md rounded-circle" src="../../assets/images/users/user-4.jpg" alt="">
                                                                <div class="media-body">
                                                                    <p class="float-right font-12 text-muted">01:56pm</p>
                                                                    <h6 class="mt-0">Troy Long</h6>
                                                                    <p class="text-muted mb-0">This theme is awesome!</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="text-center">
                                                <a href="#" class="btn btn-primary btn-sm">Load more</a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-second" role="tabpanel" aria-labelledby="nav-second-tab">
                                            <div class="p-2 mt-2">
                                                <ul class="list-unstyled latest-message-list mb-0">
                                                    <li class="message-list-item">
                                                        <a href="#">
                                                            <div class="media">
                                                                <img class="mr-3 thumb-md rounded-circle" src="../../assets/images/users/user-5.jpg" alt="">
                                                                <div class="media-body">
                                                                    <p class="float-right font-12 text-muted">09:42am</p>
                                                                    <h6 class="mt-0">John Carle</h6>
                                                                    <p class="text-muted mb-0">Hey! there I'm available...</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="message-list-item">
                                                        <a href="#">
                                                            <div class="media">
                                                                <img class="mr-3 thumb-md rounded-circle" src="../../assets/images/users/user-6.jpg" alt="">
                                                                <div class="media-body">
                                                                    <p class="float-right font-12 text-muted">11:07am</p>
                                                                    <h6 class="mt-0">Jerry Carter</h6>
                                                                    <p class="text-muted mb-0">I've finished it! See you so...</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="message-list-item">
                                                        <a href="#">
                                                            <div class="media">
                                                                <img class="mr-3 thumb-md rounded-circle" src="../../assets/images/users/user-7.jpg" alt="">
                                                                <div class="media-body">
                                                                    <p class="float-right font-12 text-muted">01:17pm</p>
                                                                    <h6 class="mt-0">Shane Hill</h6>
                                                                    <p class="text-muted mb-0">This theme is awesome!</p>

                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="text-center">
                                                <a href="#" class="btn btn-primary btn-sm">Load more</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end tab-content -->
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">Recent Activity</h4>
                                    <ol class="activity-feed mb-0 pl-3">
                                        <li class="feed-item">
                                            <div class="feed-item-list">
                                                <p class="text-muted mb-1">Now</p>
                                                <p class="font-15 mt-0 mb-0">Andrei Coman magna sed porta finibus, risus posted a new article: <b class="text-primary">Forget UX Rowland</b></p>
                                            </div>
                                        </li>
                                        <li class="feed-item">
                                            <p class="text-muted mb-1">Yesterday</p>
                                            <p class="font-15 mt-0 mb-0">Andrei Coman posted a new article: <b class="text-primary">Designer Alex</b></p>
                                        </li>
                                        <li class="feed-item">
                                            <p class="text-muted mb-1">2:30PM</p>
                                            <p class="font-15 mt-0 mb-0">Zack Wetass, sed porta finibus, risus Chris Wallace Commented <b class="text-primary"> Developer Moreno</b></p>
                                        </li>
                                        <li class="feed-item pb-1">
                                            <p class="text-muted mb-1">12:48 PM</p>
                                            <p class="font-15 mt-0 mb-2">Zack Wetass, Chris combined with Wallace They Commented <b class="text-primary">UX Murphy</b></p>
                                        </li>

                                    </ol>

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="social-box text-center">
                                        <i class="mdi mdi-facebook text-primary h1"></i>
                                        <h5 class="font-19 mt-3"><span class="text-primary">8.625K</span> New Peoples</h5>
                                        <p class="text-muted">Your main list is growing</p>

                                        <div class="mt-2 pt-1 mb-2">
                                            <button type="button" class="btn btn-primary btn-sm waves-effect waves-light">Follwing you</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="social-box text-center">
                                        <i class="mdi mdi-twitter text-info h1"></i>
                                        <h5 class="font-19 mt-3"><span class="text-info">125.3K</span> New Peoples</h5>
                                        <p class="text-muted">Your main list is growing</p>

                                        <div class="mt-2 pt-1 mb-2">
                                            <button type="button" class="btn btn-info btn-sm waves-effect waves-light">Follwing you</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">Latest Projects</h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Assigned</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Priority</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <!-- start 1 -->
                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck1" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                            <label class="custom-control-label" for="customCheck1">Zegva Themes</label>
                                                        </div>
                                                    </td>
                                                    <td> <img src="../../assets/images/users/user-1.jpg" alt="" class="thumb-md rounded-circle mr-2"> Philip Smead</td>
                                                    <td>April, 25</td>
                                                    <td><span class="badge badge-primary">High</span></td>
                                                </tr>
                                                <!-- end 1 -->

                                                <!-- start 2 -->

                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck2" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                            <label class="custom-control-label" for="customCheck2"> Themesdesign</label>
                                                        </div>
                                                    </td>
                                                    <td><img src="../../assets/images/users/user-2.jpg" alt="" class="thumb-md rounded-circle mr-2"> Brent Shipley</td>
                                                    <td>April, 28</td>
                                                    <td><span class="badge badge-danger">Low</span></td>
                                                </tr>

                                                <!-- end 2 -->

                                                <!-- start 3 -->
                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck3" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                            <label class="custom-control-label" for="customCheck3">Zegva Themes</label>
                                                        </div>
                                                    </td>
                                                    <td><img src="../../assets/images/users/user-3.jpg" alt="" class="thumb-md rounded-circle mr-2">Kevin Ashley</td>
                                                    <td>June, 12</td>
                                                    <td><span class="badge badge-success">Medium</span></td>
                                                </tr>
                                                <!-- end 3 -->

                                                <!-- start 4 -->
                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck4" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                            <label class="custom-control-label" for="customCheck4">Themesdesign</label>
                                                        </div>
                                                    </td>
                                                    <td><img src="../../assets/images/users/user-4.jpg" alt="" class="thumb-md rounded-circle mr-2">Martin Whitmer</td>
                                                    <td>June, 28</td>
                                                    <td><span class="badge badge-success">Medium</span></td>
                                                </tr>
                                                <!-- end 4 -->

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">Latest Projects</h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Assigned</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Priority</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <!-- start 5 -->
                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                            <label class="custom-control-label" for="customCheck5">Zegva Themes</label>
                                                        </div>
                                                    </td>
                                                    <td> <img src="../../assets/images/users/user-5.jpg" alt="" class="thumb-md rounded-circle mr-2"> Enrique Peters</td>
                                                    <td>July, 15</td>
                                                    <td><span class="badge badge-danger">Low</span></td>
                                                </tr>
                                                <!-- end 5 -->

                                                <!-- start 6 -->

                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck6" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                            <label class="custom-control-label" for="customCheck6"> Themesdesign</label>
                                                        </div>
                                                    </td>
                                                    <td><img src="../../assets/images/users/user-6.jpg" alt="" class="thumb-md rounded-circle mr-2"> Richard Schnell</td>
                                                    <td>July, 30</td>
                                                    <td><span class="badge badge-primary">High</span></td>
                                                </tr>

                                                <!-- end 6 -->

                                                <!-- start 7 -->
                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck7" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                            <label class="custom-control-label" for="customCheck7">Zegva Themes</label>
                                                        </div>
                                                    </td>
                                                    <td><img src="../../assets/images/users/user-7.jpg" alt="" class="thumb-md rounded-circle mr-2">Dennis Jackson</td>
                                                    <td>August, 08</td>
                                                    <td><span class="badge badge-success">Medium</span></td>
                                                </tr>
                                                <!-- end 7 -->

                                                <!-- start 8 -->

                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck8" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                            <label class="custom-control-label" for="customCheck8">Zegva Themes</label>
                                                        </div>
                                                    </td>
                                                    <td> <img src="../../assets/images/users/user-8.jpg" alt="" class="thumb-md rounded-circle mr-2">Carlos Rodrigues</td>
                                                    <td>August, 23</td>
                                                    <td><span class="badge badge-danger">Low</span></td>
                                                </tr>

                                                <!-- end 8 -->

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- container-fluid -->

            </div>
            <!-- content -->

            <footer class="footer">
                © 2019 Zegva <a href="https://1.envato.market/themesdesign" target="_blank" class="">Themesdesign</a>
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

    <script src="../../plugins/apexchart/apexcharts.min.js"></script>
    <script src="../../plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <!--Morris Chart-->
    <script src="../../plugins/morris/morris.min.js"></script>
    <script src="../../plugins/raphael/raphael.min.js"></script>

    <script src="../../assets/pages/dashboard.init.js"></script>

    <!-- App js -->
    <script src="../../assets/js/app.js"></script>

</body>

</html>