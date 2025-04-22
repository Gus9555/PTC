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
    <!-- Incluir jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Incluir la librería Inputmask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script>


    <style>
        .oculto {
            display: none;
        }
    </style>
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
    
    <script>
        $(document).ready(function () {
            $('#telefono_fijo, #telefono, #telefono_personal').mask('0000-0000');
        });
    </script>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require '../../funcs/conexion.php';
    require '../../funcs/funcs.php';
    session_start();

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
    $agencias = [
        1 => 'Agency',
        2 => 'Not an Agency'
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

    $id = $_SESSION['id'] ?? null;
    $nombre = decryptPayload($_SESSION['nombre']) ?? null;
    $correo = decryptPayload($_SESSION['correo']) ?? null;
    $tipo = '';
$usuario = '';

    $pdo = getConnection();

      // Verificar el estado de pago
      $stmtPago = $pdo->prepare('SELECT pago FROM users WHERE id = :id');
      $stmtPago->execute(['id' => $id]);
      $rowPago = $stmtPago->fetch(PDO::FETCH_ASSOC);
      $pago = $rowPago['pago'] ?? null;
  
      if ($pago === 'pendiente') {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Payment Pending',
                        text: 'Your payment is currently pending. Please complete the payment to proceed.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'plan.php?tipo=" . urlencode($tipo) . "&nombre=" . urlencode($nombre) . "&correo=" . urlencode($correo) . "&usuario=" . urlencode($usuario) .  "';
                        }
                    });
                });
              </script>";
    }

    $stmt1 = $pdo->prepare('SELECT "usuario" FROM users WHERE id = :id');
    $stmt1->execute(['id' => $id]);
    $row = $stmt1->fetch(PDO::FETCH_ASSOC);
    $usuario = $row['usuario'] ?? null;

    $stmt4 = $pdo->prepare('SELECT * FROM talleres WHERE email = :email');
    $stmt4->execute(['email' => $correo]);
    $row = $stmt4->fetch(PDO::FETCH_ASSOC);
    $stmt5 = $pdo->prepare('SELECT * FROM asociados WHERE email = :email');
    $stmt5->execute(['email' => $correo]);
    $row = $stmt5->fetch(PDO::FETCH_ASSOC);
    $stmt6 = $pdo->prepare('SELECT * FROM constructuras WHERE email = :email');
    $stmt6->execute(['email' => $correo]);
    $row = $stmt6->fetch(PDO::FETCH_ASSOC);

    if ($stmt4->rowCount() > 0) {
        $tipo = "talleres";
        $stmt2 = $pdo->prepare('SELECT * FROM talleres WHERE email = :email');
        $stmt2->execute(['email' => $correo]);
        $row = $stmt2->fetch(PDO::FETCH_ASSOC);
        $tipoAgencia = $row['tipo_agencia'];
        $nombreTaller = $row['nombre_taller'];
        $direccion = $row['direccion'];
        $numFijo = $row['telefono_fijo'];
        $numPers = $row['telefono_personal'];
        $nombreDuenho = $row['nombre_dueño'];
        $ubicacion = $row['ubicacion_taller'];
        $dui = $row['dui'];

    } elseif ($stmt5->rowCount() > 0) {
        $tipo = "asociados";
        $stmt2 = $pdo->prepare('SELECT * FROM asociados WHERE email = :email');
        $stmt2->execute(['email' => $correo]);
        $row = $stmt2->fetch(PDO::FETCH_ASSOC); //nombre_completo, telefono, email, dui, nit, jvpm, especialidad, subespecialidad, direccion_clinica, zona_medica, documentacion, activation
        $nombreComp = $row['nombre_completo'];
        $numPers = $row['telefono'];
        $dui = $row['dui'];
        $nit = $row['nit'];
        $jvpm = $row['jvpm'];
        $especialidad = $row['especialidad'];
        $subespecialidad = $row['subespecialidad'];
        $direccion = $row['direccion_clinica'];
        $zonaMedica = $row['zona_medica'];

    } elseif ($stmt6->rowCount() > 0) {
        $tipo = "constructuras";
        $stmt2 = $pdo->prepare('SELECT * FROM constructuras WHERE email = :email');
        $stmt2->execute(['email' => $correo]);
        $row = $stmt2->fetch(PDO::FETCH_ASSOC);
        $tipoAgencia = $row['tipo_agencia'];
        $direccionConstructora = $row['direccion_constructora'];
        $nombreConstructora = $row['nombre_constructora'];
        $numFijo = $row['telefono_fijo'];
        $numPers = $row['telefono'];
        $nombreDuenho = $row['nombre_dueño'];
        $direccion = $row['departamento'];

    }

    switch ($tipo) {
        case 'talleres':

            $modal = '<div id="openModal" class="modal">
            <div class="modal-content">
                <a href="#" class="close">&times;</a>
                <h2 class="modal-title">EDIT</h2>
                <form action="update_partnerData.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="' . $correo . '">
                    <div class="form-group">
                        <label class="small mb-1" for="direccion">Department</label>
                        <select id="direccion" name="direccion" value="' . $departamentos[$direccion] . '" class="form-control" required>
                            <option value="">Select a department</option>
                            <option value="1">Ahuachapán</option>
                            <option value="2">Cabañas</option>
                            <option value="3">Chalatenango</option>
                            <option value="4">Cuscatlán</option>
                            <option value="5">La Libertad</option>
                            <option value="6">La Paz</option>
                            <option value="7">La Unión</option>
                            <option value="8">Morazán</option>
                            <option value="9">San Miguel</option>
                            <option value="10">San Salvador</option>
                            <option value="11">Santa Ana</option>
                            <option value="12">San Vicente</option>
                            <option value="13">Sonsonate</option>
                            <option value="14">Usulután</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ubicacion_taller">Address</label>
                        <input type="text" onpaste="return false;" class="form-control" id="ubicacion_taller"
                            name="ubicacion_taller" value="' . $ubicacion . '" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono_fijo">Landline Phone Number</label>
                        <input type="number" onpaste="return false;" class="form-control" id="telefono_fijo"
                            name="telefono_fijo" minlength="8" maxlength="8" value="' . $numFijo . '" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono_personal">Personal Phone Number</label>
                        <input type="number" onpaste="return false;" class="form-control" id="telefono_personal"
                            name="telefono_personal" minlength="8" maxlength="8"  value="' . $numPers . '" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="edit" name="edit" value="talleres">Save changes</button>
        </div>
                </form>
            </div>
        </div>';
            $idEditar = 'talleres';
            $lista = '<div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Agency Type</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $agencias[$tipoAgencia] . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Agency Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $nombreTaller . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Department</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $departamentos[$direccion] . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $ubicacion . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Landline Phone Number</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $numFijo . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Personal Phone Number</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $numPers . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Owner Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $nombreDuenho . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Owner ID</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $dui . '</p>
                                        </div>
                                    </div>';
            break;
        case 'asociados':
            $modal = '<div id="openModal" class="modal">
            <div class="modal-content">
                <a href="#" class="close">&times;</a>
                <h2 class="modal-title">EDIT</h2>
                <form action="update_partnerData.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="' . $correo . '">
                    <div class="form-group">
                        <label class="small mb-1" for="departamento">Department</label>
                        <select id="departamento" name="departamento" value="' . $departamentos[$zonaMedica] . '" class="form-control" required>
                            <option value="">Select a department</option>
                            <option value="1">Ahuachapán</option>
                            <option value="2">Cabañas</option>
                            <option value="3">Chalatenango</option>
                            <option value="4">Cuscatlán</option>
                            <option value="5">La Libertad</option>
                            <option value="6">La Paz</option>
                            <option value="7">La Unión</option>
                            <option value="8">Morazán</option>
                            <option value="9">San Miguel</option>
                            <option value="10">San Salvador</option>
                            <option value="11">Santa Ana</option>
                            <option value="12">San Vicente</option>
                            <option value="13">Sonsonate</option>
                            <option value="14">Usulután</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subespecialidad">Subspecialty</label>
                        <input type="text" onpaste="return false;" class="form-control" id="subespecialidad"
                            name="subespecialidad" value="' . $subespecialidad . '" required>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Address</label>
                        <input type="text" onpaste="return false;" class="form-control" id="direccion"
                            name="direccion" value="' . $direccion . '" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono_personal">Personal Phone Number</label>
                        <input type="number" onpaste="return false;" class="form-control" id="telefono_personal"
                            name="telefono_personal" minlength="8" maxlength="8" value="' . $numPers . '" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="edit" name="edit" value="asociados">Save changes</button>
        </div>
                </form>
            </div>
        </div>';
            $idEditar = 'asociados';
            $lista = '<div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $nombreComp . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Phone Number</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $numPers . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">ID</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $dui . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">TIN</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $nit . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">JVPM</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $jvpm . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Medical Specialty</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $especialidades[$especialidad] . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Medical Subspeciality</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $subespecialidad . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $direccion . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Department</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $departamentos[$zonaMedica] . '</p>
                                        </div>
                                    </div>';
            break;
        case 'constructuras':
            $modal = '<div id="openModal" class="modal">
            <div class="modal-content">
                <a href="#" class="close">&times;</a>
                <h2 class="modal-title">EDIT</h2>
                <form action="update_partnerData.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="' . $correo . '">
                    <div class="form-group">
                        <label class="small mb-1" for="direccion">Department</label>
                        <select id="direccion" name="direccion" value="' . $departamentos[$direccion] . '" class="form-control" required>
                            <option value="">Select a department</option>
                            <option value="1">Ahuachapán</option>
                            <option value="2">Cabañas</option>
                            <option value="3">Chalatenango</option>
                            <option value="4">Cuscatlán</option>
                            <option value="5">La Libertad</option>
                            <option value="6">La Paz</option>
                            <option value="7">La Unión</option>
                            <option value="8">Morazán</option>
                            <option value="9">San Miguel</option>
                            <option value="10">San Salvador</option>
                            <option value="11">Santa Ana</option>
                            <option value="12">San Vicente</option>
                            <option value="13">Sonsonate</option>
                            <option value="14">Usulután</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ubicacion_constructora">Address</label>
                        <input type="text" onpaste="return false;" class="form-control" id="ubicacion_constructora"
                            name="ubicacion_constructora" value="' . $direccionConstructora . '" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono_fijo">Landline Phone Number</label>
                        <input type="number" onpaste="return false;" class="form-control" id="telefono_fijo"
                            name="telefono_fijo" minlength="8" maxlength="8" value="' . $numFijo . '" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono_personal">Personal Phone Number</label>
                        <input type="number" onpaste="return false;" class="form-control" id="telefono_personal"
                            name="telefono_personal" minlength="8" maxlength="8" value="' . $numPers . '" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="edit" name="edit" value="constructuras">Save changes</button>
        </div>
                </form>
            </div>
        </div>';
            $idEditar = 'constructuras';
            $lista = '<div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Agency Type</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $agencias[$tipoAgencia] . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Building Company Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $nombreConstructora . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $direccionConstructora . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Department</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $departamentos[$direccion] . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Landline Phone Number</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $numFijo . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Personal Phone Number</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $numPers . '</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Owner Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">' . $nombreDuenho . '</p>
                                        </div>
                                    </div>';
            break;

        default:
            # code...
            break;
    }





    // Verificar las variables de sesión
    if (!$id || !$nombre || !$correo) {
        echo 'Error: Variables de sesión no definidas.';
        exit;
    }


    //     $no_seguro = '';
//     if (empty($seguros)) {
//         $no_seguro = '
// <div class="card seguro-card">
//     <div class="card-body text-center">
//         <p class="mb-4"><span class="text-primary font-italic me-1"></span>YOU HAVE NOT YET TAKEN OUT INSURANCE</p>
//         <i class="fas fa-frown fa-2x"></i>
//         <div class="card-body_bg"></div>
//         <img src="../../assets/images/Diseño_sin_título__4_-removebg-preview.png" alt="Centered Image" class="center-image">
//     </div>
// </div>';
//     }
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
                        <a class="navbar-brand logo-image" href="#"><img src="../../assets/boss/images/logo.png"
                                alt="alternative"></a>

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
                                    <a class="nav-link page-scroll" href="../spanish/view_user.php">ESPAÑOL <span
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
                                        <!-- <button type="button" class="btn btn-outline-primary ms-1" data-toggle="modal" data-target="#editModal" data-id="<?php //echo $row['id']; ?>" data-direccion="<?php //echo $departamentos[$row['direccion']]; ?>" data-ubicacion_taller="<?php //echo $row['ubicacion_taller']; ?>" data-telefono_fijo="<?php //echo $row['telefono_fijo']; ?>" data-telefono_personal="<?php //echo $row['telefono_personal']; ?>">EDIT</button> -->
                                        <a href="#openModal">
                                            <button class="btn btn-outline-primary ms-1">EDIT</button>
                                        </a>

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
                            <div class="card mb-4">
                                <div class="card-body">
                                    <?php echo $lista; ?>
                                </div>
                            </div>

                            <!-- inicio card seguro-->



                            <!-- fin de card seguro-->

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End your project here-->

        <style>
            body {
                font-family: Arial, sans-serif;
            }

            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.5);
            }

            .modal-content {
                background-color: #fff;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                max-width: 300px;
            }

            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
                cursor: pointer;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
            }

            /* Target para abrir el modal */
            #openModal:target {
                display: block;
            }

            button {
                cursor: pointer;
                padding: 10px 20px;
                font-size: 16px;
            }
        </style>

        <!-- Modal -->
        <?php echo $modal; ?>

        <!-- Modal -->
        <!-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Insurance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="update_partnerData.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                                            <label class="small mb-1" for="direccion">Department</label>
                                            <select id="direccion" name="direccion" class="form-control">
                                                <option value="">Select a department</option>
                                                <option value="1">Ahuachapán</option>
                                                <option value="2">Cabañas</option>
                                                <option value="3">Chalatenango</option>
                                                <option value="4">Cuscatlán</option>
                                                <option value="5">La Libertad</option>
                                                <option value="6">La Paz</option>
                                                <option value="7">La Unión</option>
                                                <option value="8">Morazán</option>
                                                <option value="9">San Miguel</option>
                                                <option value="10">San Salvador</option>
                                                <option value="11">Santa Ana</option>
                                                <option value="12">San Vicente</option>
                                                <option value="13">Sonsonate</option>
                                                <option value="14">Usulután</option>
                                            </select>
                                        </div>
                        <div class="form-group">
                            <label for="ubicacion_taller">Address</label>
                            <input type="text"onpaste="return false;" class="form-control" id="ubicacion_taller" name="ubicacion_taller">
                        </div>
                        <div class="form-group">
                            <label for="telefono_fijo">Landline Phone Number</label>
                            <input type="text"onpaste="return false;" class="form-control" id="telefono_fijo" name="telefono_fijo">
                        </div>
                        <div class="form-group">
                            <label for="telefono_personal">Personal Phone Number</label>
                            <input type="text" onpaste="return false;" class="form-control" id="telefono_personal" name="telefono_personal">
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="edit" name="edit" value="workshop">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->

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

        <script>
            $('#editModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var direccion = button.data('direccion');
                var ubicacion_taller = button.data('ubicacion_taller');
                var telefono_fijo = button.data('telefono_fijo');
                var telefono_personal = button.data('telefono_personal');


                var modal = $(this);
                modal.find('#id').val(id);
                modal.find('#direccion').val(direccion);
                modal.find('#ubicacion_taller').val(ubicacion_taller);
                modal.find('#telefono_fijo').val(telefono_fijo);
                modal.find('#telefono_personal').val(telefono_personal);
            });
        </script>
        <script>
            $(document).ready(function () {
                $('#telefono_fijo, #telefono, #telefono_personal').mask('0000-0000');
            });
        </script>

        <script>
            // Aplicar la máscara al campo de teléfono
            $(document).ready(function () {
                $("#telefono_personal").inputmask("9999-9999"); // Máscara para el formato de teléfono
            });
        </script>

    </body>

    </html>