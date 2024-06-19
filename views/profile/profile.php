<?php
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';
session_start();
$id = $_SESSION['id'];
$nombre = $_SESSION['nombre'];
$correo = $_SESSION['correo'];

$stmt1 = "SELECT S_moto, S_auto, S_util, S_casa, S_vida FROM users WHERE id =".$id; // ? indica que va un valor ahi
$result = $mysqli->query($stmt1);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}

if ($row['S_moto'] == 1) {
    $S_moto = '<p class="mb-4"><span class="text-primary font-italic me-1"></span>Insurance</p>
                                    <p class="mb-1" style="font-size: .77rem;"><b>Silver Motorcycle Insurance</b></p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>';
} elseif ($row['S_moto'] == 2) {
    $S_moto = '<p class="mb-4"><span class="text-primary font-italic me-1"></span>Insurance</p>
                                    <p class="mb-1" style="font-size: .77rem;"><b>Golden Motorcycle Insurance</b></p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>';
} elseif ($row['S_moto'] == 3) {
    $S_moto = '<p class="mb-4"><span class="text-primary font-italic me-1"></span>Insurance</p>
                                    <p class="mb-1" style="font-size: .77rem;"><b>Diamond Motorcycle Insurance</b></p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>';
}

if ($row['S_auto'] == 4) {
    $S_auto = '<p class="mb-4"><span class="text-primary font-italic me-1"></span>Insurance</p>
                                    <p class="mb-1" style="font-size: .77rem;"><b>Silver Car Insurance</b></p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>';
} elseif ($row['S_auto'] == 5) {
    $S_auto = '<p class="mb-4"><span class="text-primary font-italic me-1"></span>Insurance</p>
                                    <p class="mb-1" style="font-size: .77rem;"><b>Golden Car Insurance</b></p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>';
} elseif ($row['S_auto'] == 6) {
    $S_auto = '<p class="mb-4"><span class="text-primary font-italic me-1"></span>Insurance</p>
                                    <p class="mb-1" style="font-size: .77rem;"><b>Diamond Car Insurance</b></p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>';
}

if ($row['S_util'] == 7) {
    $S_util = '<p class="mb-4"><span class="text-primary font-italic me-1"></span>Insurance</p>
                                    <p class="mb-1" style="font-size: .77rem;"><b>Silver Utility Vehicles Insurance</b></p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>';
} elseif ($row['S_util'] == 8) {
    $S_util = '<p class="mb-4"><span class="text-primary font-italic me-1"></span>Insurance</p>
                                    <p class="mb-1" style="font-size: .77rem;"><b>Golden Utility Vehicles Insurance</b></p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>';
} elseif ($row['S_util'] == 9) {
    $S_util = '<p class="mb-4"><span class="text-primary font-italic me-1"></span>Insurance</p>
                                    <p class="mb-1" style="font-size: .77rem;"><b>Diamond Utility Vehicles Insurance</b></p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>';
}

if ($row['S_casa'] == 10) {
    $S_casa = '<p class="mb-4"><span class="text-primary font-italic me-1"></span>Insurance</p>
                                    <p class="mb-1" style="font-size: .77rem;"><b>Silver Home Insurance</b></p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>';
} elseif ($row['S_casa'] == 11) {
    $S_casa = '<p class="mb-4"><span class="text-primary font-italic me-1"></span>Insurance</p>
                                    <p class="mb-1" style="font-size: .77rem;"><b>Golden Home Insurance</b></p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>';
} elseif ($row['S_casa'] == 12) {
    $S_casa = '<p class="mb-4"><span class="text-primary font-italic me-1"></span>Insurance</p>
                                    <p class="mb-1" style="font-size: .77rem;"><b>Diamond Home Insurance</b></p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>';
}

if ($row['S_vida'] == 13) {
    $S_vida = '<p class="mb-4"><span class="text-primary font-italic me-1"></span>Insurance</p>
                                    <p class="mb-1" style="font-size: .77rem;"><b>Silver Health Insurance</b></p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>';
} elseif ($row['S_vida'] == 14) {
    $S_vida = '<p class="mb-4"><span class="text-primary font-italic me-1"></span>Insurance</p>
                                    <p class="mb-1" style="font-size: .77rem;"><b>Golden Health Insurance</b></p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>';
} elseif ($row['S_vida'] == 15) {
    $S_vida = '<p class="mb-4"><span class="text-primary font-italic me-1"></span>Insurance</p>
                                    <p class="mb-1" style="font-size: .77rem;"><b>Diamond Health Insurance</b></p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>';
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
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">LifeLine</a></li>
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="img/5-removebg-preview.png"
                                alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3"><?php echo $nombre; ?></h5>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-primary">Logout</button>
                                <button type="button" class="btn btn-outline-primary ms-1">Home</button>
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
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $correo; ?></p>
                                </div>
                            </div>                           
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0">
                                <div class="card-body">
                                <?php echo $S_moto ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0">
                            <div class="card-body">
                                <?php echo $S_auto ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                            <div class="card mb-4 mb-md-0">
                            <div class="card-body">
                                <?php echo $S_util ?>
                                </div>
                            </div>
                        </div>
                    <div class="col-md-6">
                            <div class="card mb-4 mb-md-0">
                            <div class="card-body">
                                <?php echo $S_casa ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                            <div class="card mb-4 mb-md-0">
                            <div class="card-body">
                                <?php echo $S_vida ?>
                                </div>
                            </div>
                        </div>
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
</body>

</html>