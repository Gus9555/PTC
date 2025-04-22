<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';

if (!isset($_SESSION['id'])) {
    echo '<p><script>Swal.fire({
          title: "Advertencia",
          text: "Inicia sesion de nuevo"
          }).then(function() {
          window.location = "../../views/user/login.php";
          });</script></p>';
    exit;
}

$id_comprador = $_SESSION['id']; // Captura del id del usuario desde la sesión

$seguro = htmlspecialchars($_POST['seguro']);
$calidad = htmlspecialchars($_POST['calidad']);
$precio = htmlspecialchars($_POST['precio']);

$nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $numero_telefonico = $_POST['numero_telefonico'];
    $user_id = $id_comprador; // Obtener el id del usuario desde la sesión
    $estado = 'pendiente';
    $seguro = $_POST['seguro'];
    $calidad = $_POST['calidad'];


    $pdo = getConnection(); // Asegurarse de tener la conexión establecida antes de usarla
    
        $stmt = $pdo->prepare("INSERT INTO compras (nombre, correo, numero_telefonico, user_id, estado, seguro, calidad, precio) VALUES (:nombre, :correo, :numero_telefonico, :user_id, :estado, :seguro, :calidad, :precio)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':numero_telefonico', $numero_telefonico);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':seguro', $seguro);
        $stmt->bindParam(':calidad', $calidad);
        $stmt->bindParam(':precio', $precio);
        $stmt->execute();


if ($seguro == "Vehicule" || $seguro == "motorcycle" || $seguro == "Utility" ) {
    $tarjetaCirc = $_POST['tarjeta_circulacion'];
    $dui = $_POST['dui'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $num_telBene = $_POST['num_telBene'];
    $parentesco = $_POST['parentesco'];

    // Handle the PDF document upload
    if ($tarjetaCirc !== null) {
        $documentacion_encoded = base64_encode($tarjetaCirc);
    } else {
        $documentacion_encoded = null;
    }

    $stmt1 = $pdo->prepare("INSERT INTO datos_vehiculos (tarjetacirc, dui, num_tel, nombre, email, num_benefi, parentesco, activation) VALUES (:tarjetacirc, :dui, :numero_telefonico, :nombre, :email, :num_benefi, :parentesco, 0)");
    $stmt1->bindParam(':tarjetacirc', $documentacion_encoded);
    $stmt1->bindParam(':dui', $dui);
    $stmt1->bindParam(':numero_telefonico', $numero_telefonico);
    $stmt1->bindParam(':nombre', $name);
    $stmt1->bindParam(':email', $email);
    $stmt1->bindParam(':num_benefi', $num_telBene);
    $stmt1->bindParam(':parentesco', $parentesco);
    $stmt1->execute();

    echo '<p><script>Swal.fire({
        title: "Good job!",
        text: "Data send",
        icon: "success"
        }).then(function() {
        window.location = "../user_spanish/pagar.php?seguro=' . urlencode($seguro) . '&calidad=' . urlencode($calidad) . '&precio=' . urlencode($precio) . '";
        });</script></p>';

} elseif ($seguro == "Medical") {

    $name_asegrd = $_POST['name_asegrd'];
    $num_tel = $_POST['num_tel'];
    $age = $_POST['age'];
    $vivienda = $_POST['vivienda'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $num_telBene = $_POST['num_telBene'];
    $parentesco = $_POST['parentesco'];

    $stmt1 = $pdo->prepare("INSERT INTO datos_medicos (nombre, num_tel, edad, nombre_benefi, email, num_benefi, parentesco, Direccion_vivienda, activation) VALUES (:nombre_asegrd, :num_tel, :edad, :nombre, :email, :num_benefi, :parentesco, :direccion, 0)");
    $stmt1->bindParam(':nombre_asegrd', $name_asegrd);
    $stmt1->bindParam(':num_tel', $num_tel);
    $stmt1->bindParam(':edad', $age);
    $stmt1->bindParam(':nombre', $name);
    $stmt1->bindParam(':email', $email);
    $stmt1->bindParam(':num_benefi', $num_telBene);
    $stmt1->bindParam(':parentesco', $parentesco);
    $stmt1->bindParam(':direccion', $vivienda);
    $stmt1->execute();

    echo '<p><script>Swal.fire({
        title: "Good job!",
        text: "Data send",
        icon: "success"
        }).then(function() {
        window.location = "../user_spanish/pagar.php?seguro=' . urlencode($seguro) . '&calidad=' . urlencode($calidad) . '&precio=' . urlencode($precio) . '";
        });</script></p>';

} elseif ($seguro == "Home") {

    $fotos = $_POST['fotos'];
    $area = $_POST['area'];
    $habitaciones = $_POST['habitaciones'];
    $direccion = $_POST['direccion'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $num_telBene = $_POST['num_telBene'];
    $parentesco = $_POST['parentesco'];
     // Handle the PDF document upload
     if ($fotos !== null) {
        $documentacion_encoded = base64_encode($fotos);
    } else {
        $documentacion_encoded = null;
    }

    $stmt1 = $pdo->prepare("INSERT INTO datos_propiedad (fotos, area, num_habitaciones, nombre, email, num_benefi, parentesco, direccion_propiedad, activation) VALUES (:fotos, :area, :habitaciones, :nombre, :email, :num_benefi, :parentesco, :direccion, 0)");
    $stmt1->bindParam(':fotos', $documentacion_encoded);
    $stmt1->bindParam(':area', $area);
    $stmt1->bindParam(':habitaciones', $habitaciones);
    $stmt1->bindParam(':nombre', $name);
    $stmt1->bindParam(':email', $email);
    $stmt1->bindParam(':num_benefi', $num_telBene);
    $stmt1->bindParam(':parentesco', $parentesco);
    $stmt1->bindParam(':direccion', $direccion);
    $stmt1->execute();

    echo '<p><script>Swal.fire({
        title: "Bien Hecho!",
        text: "Informacion enviada",
        icon: "success"
        }).then(function() {
        window.location = "../user_spanish/pagar.php?seguro=' . urlencode($seguro) . '&calidad=' . urlencode($calidad) . '&precio=' . urlencode($precio) . '";
        });</script></p>';

} else {
    echo '<p><script>Swal.fire({
        title: "Error",
        text: "ERROR",
        icon: "error"
    }).then(function() {
        window.location = "datospago.php";
    });</script></p>';
}
    
        
        
    
