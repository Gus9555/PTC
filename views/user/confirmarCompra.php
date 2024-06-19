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
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';
session_start();
$seguro = $_SESSION['seguro'];
$id = $_SESSION['id'];
$stmt1 = "SELECT S_moto, S_auto, S_util, S_casa, S_vida FROM users WHERE id =".$id; // ? indica que va un valor ahi
$result = $mysqli->query($stmt1);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if ($seguro >= 1 && $seguro <= 3 && $row['S_moto'] == null) {
            $stmt = $mysqli->prepare("UPDATE users SET S_moto =".$seguro." WHERE id=".$id);
            if ($seguro == 1) {
                $pago = 14.99;
                $nombreSeguro = "Silver Motorcycle Insurance";
            } elseif ($seguro == 2) {
                $pago = 24.99;
                $nombreSeguro = "Golden Motorcycle Insurance";
            } elseif ($seguro == 3) {
                $pago = 49.99;
                $nombreSeguro = "Diamond Motorcycle Insurance";
            }
        } elseif ($seguro >= 4 && $seguro <= 6 && $row['S_auto'] == null) {
            $stmt = $mysqli->prepare("UPDATE users SET S_auto =".$seguro." WHERE id=".$id);
            if ($seguro == 4) {
                $pago = 24.99;
                $nombreSeguro = "Silver Car Insurance";
            } elseif ($seguro == 5) {
                $pago = 49.99;
                $nombreSeguro = "Golden Car Insurance";
            } elseif ($seguro == 6) {
                $pago = 99.99;
                $nombreSeguro = "Diamond Car Insurance";
            }
        } elseif ($seguro >= 7 && $seguro <= 9 && $row['S_util'] == null) {
            $stmt = $mysqli->prepare("UPDATE users SET S_util =".$seguro." WHERE id=".$id);
            if ($seguro == 7) {
                $pago = 44.99;
                $nombreSeguro = "Silver Industrial Vehicles Insurance";
            } elseif ($seguro == 8) {
                $pago = 84.99;
                $nombreSeguro = "Golden Industrial Vehicles Insurance";
            } elseif ($seguro == 9) {
                $pago = 149.99;
                $nombreSeguro = "Diamond Industrial Vehicles Insurance";
            }
        }elseif ($seguro >= 10 && $seguro <= 12 && $row['S_casa'] == null) {
            $stmt = $mysqli->prepare("UPDATE users SET S_casa =".$seguro." WHERE id=".$id);
            if ($seguro == 10) {
                $pago = 44.99;
                $nombreSeguro = "Silver Home Insurance";
            } elseif ($seguro == 11) {
                $pago = 84.99;
                $nombreSeguro = "Golden Home Insurance";
            } elseif ($seguro == 12) {
                $pago = 199.99;
                $nombreSeguro = "Diamond Home Insurance";
            }
        }elseif ($seguro >= 13 && $seguro <= 15  && $row['S_vida'] == null) {
            $stmt = $mysqli->prepare("UPDATE users SET S_vida =".$seguro." WHERE id=".$id);
            if ($seguro == 13) {
                $pago = 24.99;
                $nombreSeguro = "Silver Health Insurance";
            } elseif ($seguro == 14) {
                $pago = 74.99;
                $nombreSeguro = "Golden Health Insurance";
            } elseif ($seguro == 15) {
                $pago = 149.99;
                $nombreSeguro = "Diamond Health Insurance";
            }
        } elseif ($row['S_vida'] != null || $row['S_casa'] != null || $row['S_moto'] != null || $row['S_auto'] != null || $row['S_util'] != null) {
            $stmt = "100";
            echo '<p><script>swal({
                title: "ERROR!",
                text: "You already bought this type of insurance",
                icon: "error",
                 }).then(function() {
                window.location = "../user/view_user.php";
                });</script></p>';
        } 
    }else{ 
        $stmt = "100";
        echo '<p><script>swal({
            title: "ERROR!",
            text: "You need to read the terms and conditions, check the checkbox",
            icon: "error",
             }).then(function() {
            window.location = "../../views/user/buy.php";
            });</script></p>';  
    }
    

if($stmt != "100"){ 
if ($stmt->execute()) {
    return $mysqli;
} else {
    //y si no hara el return en falso 
    echo "ERROR";
    return 0;
}
}
?>