<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['id'])) {
    echo '<p><script>Swal.fire({
            title: "Warning",
            text: "LogIn again"
        }).then(function() {
            window.location = "../user/login.php";
        });</script></p>';
    exit;
}

$nombre = $_SESSION['nombre'];
$tipo_usuario = $_SESSION['tipo_usuario'];

$departamentos = [
    1 => 'Ahuachapán',
    2 => 'Cabañas',
    3 => 'Chalatenango',
    4 => 'Cuscatlán',
    5 => 'La Libertad',
    6 => 'La Paz',
    7 => 'La Unión',
    8 => 'Morazán',
    9 => 'San Miguel',
    10 => 'San Salvador',
    11 => 'Santa Ana',
    12 => 'San Vicente',
    13 => 'Sonsonate',
    14 => 'Usulután'
];

$especialidades = [
    1 => 'Cardiology',
    2 => 'Dermatology',
    3 => 'Neurology',
    4 => 'Pediatrics',
    5 => 'Orthopedics',
    6 => 'Gastroenterology',
    7 => 'Oncology',
    8 => 'Psychiatry',
    9 => 'Ophthalmology',
    10 => 'Gynecology',
    11 => 'Urology',
    12 => 'Endocrinology',
    13 => 'Rheumatology',
    14 => 'Pulmonology',
    15 => 'Nephrology',
    16 => 'Hematology'
];

$activacion = [
    1 => 'Active',
    2 => 'Pending...',
    3 => 'Denied'
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Tivo is a HTML landing page template built with Bootstrap to help you create engaging presentations for SaaS apps and convert visitors into users.">
    <meta name="author" content="Inovatik">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    
    <title>LifeLine</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="../../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../../assets/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../../assets/boss/css/swiper.css" rel="stylesheet">
    <link href="../../assets/boss/css/magnific-popup.css" rel="stylesheet">
    <link href="../../assets/boss/css/styles.css" rel="stylesheet">
    <link href="../../assets/boss/css/styles3.css" rel="stylesheet">
    <link rel="icon" href="../../assets/boss/images/latido-del-corazon2.png">
    <style>
        .doctor-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .doctor-item .icon {
            font-size: 40px;
            color: #3b5d50;
            margin-bottom: 10px;
        }

        .doctor-item h5 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .doctor-item p {
            font-size: 16px;
            color: #666;
            margin: 5px 0;
        }

        .doctor-item::after {
            content: "";
            display: block;
            width: 100%;
            height: 4px;
            background-color: #3b5d50;
            position: absolute;
            bottom: 0;
            left: 0;
            border-radius: 0 0 8px 8px;
        }

        .doctor-item:hover {
            transform: scale(1.05);
        }

        .modal-body p {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
        }

        .modal-body p span:first-child {
            text-transform: uppercase;
        }

        .modal-body p span:last-child {
            font-weight: normal;
        }

        .modal-title {
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .modal-title .icon {
            font-size: 24px;
            color: #3b5d50;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">

            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Tivo</a> -->

            <!-- Image Logo -->
            <a class="navbar-brand logo-image" href="view_user.php"><img src="../../assets/boss/images/logo.png"
                    alt="alternative"></a>

            <!-- Mobile Menu Toggle Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-awesome fas fa-bars"></span>
                <span class="navbar-toggler-awesome fas fa-times"></span>
            </button>
            <!-- end of mobile menu toggle button -->

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="view_user.php">HOME <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../spanish/view_user.php">ESPAÑOL <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../support/users.php">CHAT-SUPPORT <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../profile/profile.php">PROFILE <span
                                class="sr-only">(current)</span></a>
                    </li>
                    
                    <!-- end of dropdown menu -->

                </ul>
                <span class="nav-item">
                    <a class="btn-outline-sm" href="logout.php">LOG OUT</a>
                </span>
            </div>
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->

<div class="wrapper">
    <header id="header" class="header">
        <div class="header-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-xl-5">
                        <div class="text-container">
                            <h1>LifeLine Health Care Network</h1>
                            <p class="p-large">At lifeLine we prioritize your health, that's why we offer you the contact of our network of Doctors.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-7">
                        <div class="image-container">
                            <div class="img-wrapper">
                                <img class="img-fluid" src="../../assets/boss/images/doctorW.png" alt="alternative">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <svg class="header-frame" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1920 310">
        <defs>
            <style>.cls-1 { fill: #3b5d50; }</style>
        </defs>
        <title>header-frame</title>
        <path class="cls-1" d="M0,283.054c22.75,12.98,53.1,15.2,70.635,14.808,92.115-2.077,238.3-79.9,354.895-79.938,59.97-.019,106.17,18.059,141.58,34,47.778,21.511,47.778,21.511,90,38.938,28.418,11.731,85.344,26.169,152.992,17.971,68.127-8.255,115.933-34.963,166.492-67.393,37.467-24.032,148.6-112.008,171.753-127.963,27.951-19.26,87.771-81.155,180.71-89.341,72.016-6.343,105.479,12.388,157.434,35.467,69.73,30.976,168.93,92.28,256.514,89.405,100.992-3.315,140.276-41.7,177-64.9V0.24H0V283.054Z" />
    </svg>
</div>

<div class="untree_co-section">
    <div class="container">
        <div class="row mb-5"></div>
        <div class="row">
            <div class="col-md-6 mb-5 mb-md-0">
                <h2 class="h3 mb-3 text-black">LifeLine Health Care Network</h2>
                <div class="wrapper">
                    <form method="POST" class="border p-4">
                        <div class="form-group">
                            <label for="specialty" class="text-black">Medical Specialty </label>
                            <select id="specialty" name="specialty" class="form-control">
                            <option value="">Select a Specialty</option>
                                <?php foreach ($especialidades as $key => $value): ?>
                                    <option value="<?= $key ?>"><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>  
                        <div class="form-group">
                            <label for="department" class="text-black">Department </label>
                            <select id="department" name="department" class="form-control">
                                <option value="">Select a department</option>
                                <?php foreach ($departamentos as $key => $value): ?>
                                    <option value="<?= $key ?>"><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="searchName" class="text-black">Search Name</label>
                                <input type="text" class="form-control" id="searchName" name="searchName">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-outline-sm">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="h3 mb-3 text-black">Doctor List</h2>
                <div class="p-3 p-lg-5 border bg-white">
                    <div class="container">
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            require '../../funcs/conexion.php';
                            $pdo = getConnection();
                            $specialty = $_POST['specialty'] ?? '';
                            $department = $_POST['department'] ?? '';
                            $searchName = $_POST['searchName'] ?? '';

                            $sql = "SELECT * FROM asociados WHERE activation NOT IN (2, 3)";
                            $params = [];

                            if (!empty($specialty)) {
                                $sql .= " AND especialidad = ?";
                                $params[] = $specialty;
                            }

                            if (!empty($department)) {
                                $sql .= " AND zona_medica = ?";
                                $params[] = $department;
                            }

                            if (!empty($searchName)) {
                                $sql .= " AND nombre_completo LIKE ?";
                                $params[] = "%$searchName%";
                            }

                            $stmt = $pdo->prepare($sql);
                            $stmt->execute($params);
                            $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if ($doctors) {
                                foreach ($doctors as $doctor) {
                                    $modalId = 'modal' . htmlspecialchars($doctor['id']);
                                    echo "<div class='doctor-item' data-toggle='modal' data-target='#$modalId'>";
                                    echo "<div class='icon'><i class='fas fa-stethoscope'></i></div>";
                                    echo "<h5>" . htmlspecialchars($doctor['nombre_completo']) . "</h5>";
                                    echo "</div>";

                                    // Modal
                                    echo "<div class='modal fade' id='$modalId' tabindex='-1' role='dialog' aria-labelledby='{$modalId}Label' aria-hidden='true'>";
                                    echo "<div class='modal-dialog' role='document'>";
                                    echo "<div class='modal-content'>";
                                    echo "<div class='modal-header'>";
                                    echo "<h5 class='modal-title' id='{$modalId}Label'><i class='fas fa-stethoscope'></i>" . htmlspecialchars($doctor['nombre_completo']) . "</h5>";
                                    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                                    echo "<span aria-hidden='true'>&times;</span>";
                                    echo "</button>";
                                    echo "</div>";
                                    echo "<div class='modal-body'>";
                                    echo "<p><span>Specialty:</span> <span>" . htmlspecialchars($especialidades[$doctor['especialidad']]) . "</span></p>";
                                    echo "<p><span>Subspecialty:</span> <span>" . htmlspecialchars($doctor['subespecialidad']) . "</span></p>";
                                    echo "<p><span>Department:</span> <span>" . htmlspecialchars($departamentos[$doctor['zona_medica']]) . "</span></p>";
                                    echo "<p><span>Clinic Location:</span> <span>" . htmlspecialchars($doctor['direccion_clinica']) . "</span></p>";
                                    echo "<p><span>Phone:</span> <span class='phone-number'>" . htmlspecialchars($doctor['telefono']) . "</span></p>";
                                    echo "<p><span>Email:</span> <span>" . htmlspecialchars($doctor['email']) . "</span></p>";
                                    echo "</div>";
                                    echo "<div class='modal-footer'>";
                                    echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            } else {
                                echo "<p>No doctors found.</p>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<svg class="footer-frame" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1920 79">
    <defs>
        <style>.cls-2 { fill: #3b5d50; }</style>
    </defs>
    <title>footer-frame</title>
    <path class="cls-2" d="M0,72.427C143,12.138,255.5,4.577,328.644,7.943c147.721,6.8,183.881,60.242,320.83,53.737,143-6.793,167.826-68.128,293-60.9,109.095,6.3,115.68,54.364,225.251,57.319,113.58,3.064,138.8-47.711,251.189-41.8,104.012,5.474,109.713,50.4,197.369,46.572,89.549-3.91,124.375-52.563,227.622-50.155A338.646,338.646,0,0,1,1920,23.467V79.75H0V72.427Z" transform="translate(0 -0.188)" />
</svg>
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-col first">
                    <h4>About LifeLine</h4>
                    <p class="p-small">We are one of your best options in the market to acquire an insurance policy.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-col middle">
                    <h4>Important Links</h4>
                    <ul class="list-unstyled li-space-lg p-small">
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Our business partners <a class="white"
                                    href="#your-link">startupguide.com</a></div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Read our <a class="white" href="terms-conditions.html">Terms &
                                    Conditions</a>, <a class="white" href="privacy-policy.html">Privacy Policy</a></div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-col last">
                    <h4>Contact</h4>
                    <ul class="list-unstyled li-space-lg p-small">
                        <li class="media">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="media-body"> Calle Don Bosco y Av. Manuel Gallardo, 1-1, Santa Tecla</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-envelope"></i>
                            <div class="media-body">
                                <a class="white"
                                    href="mailto:lifeline.ptc.2024@gmail.com">lifeline.ptc.2024@gmail.com</a>
                                <i class="fas fa-globe"></i>
                                <a class="white" href="#your-link">www.LifeLine.com</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p class="p-small">Copyright © 2020 Template by LifeLine</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/inputmask/dist/jquery.inputmask.min.js"></script>
<script src="../../assets/boss/js/jquery.min.js"></script>
<script src="../../assets/boss/js/popper.min.js"></script>
<script src="../../assets/boss/js/bootstrap.min.js"></script>
<script src="../../assets/boss/js/jquery.easing.min.js"></script>
<script src="../../assets/boss/js/swiper.min.js"></script>
<script src="../../assets/boss/js/jquery.magnific-popup.js"></script>
<script src="../../assets/boss/js/scripts.js"></script>
<script>
$(document).ready(function(){
    $(".phone-number").each(function(){
        var phoneNumber = $(this).text().trim();
        var formattedNumber = phoneNumber.replace(/(\d{4})(\d{4})/, "$1-$2");
        $(this).text(formattedNumber);
    });
});
</script>
</body>
</html>
