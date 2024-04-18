<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>LIFELINE</title>
</head>

<body>

</body>

</html>
<?php
 require '../funcs/conexion.php';
 require '../funcs/funcs.php';

 $user_id = $mysqli->real_escape_string($_POST['user_id']);
 $token = $mysqli->real_escape_string($_POST['token']);
 $password = $mysqli->real_escape_string($_POST['password']);
 $con_password = $mysqli->real_escape_string($_POST['con_password']);

 if(validaPassword($password, $con_password))
 {
     $pass_hash = hashPassword($password);

     if(cambiaPassword($pass_hash, $user_id, $token))
     {
         
         echo '<p><script>swal({
            title: "Done!",
            text: "Updated Password",
            icon: "success",
             }).then(function() {
            window.location = "../views/index.php";
            });</script></p>';

     }else{
        echo "Error updating the password";
     }
 } else{
    echo 'Both passwords need to match';
 }

?>