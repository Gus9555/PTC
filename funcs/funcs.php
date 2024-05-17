<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Document</title>
</head>

<body>

</body>

</html>

<?php
use PHPMailer\PHPMailer\PHPMailer;



// funcion de validar espacios vacios
function isNull($nombre, $user, $pass, $pass_con, $email)
{
    if (strlen(trim($nombre)) < 1 || strlen(trim($user)) < 1 || strlen(trim($email)) < 1) {
        return true;
    } else {
        return false;
    }
}

function isEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}
//funcion de comparacion de contraseñas
function validaPassword($var1, $var2)
{
    if (strcmp($var1, $var2) !== 0) {
        return false;
    } else {
        return true;
    }
}
// funcion delimitante de caracteres
function minMax($min, $max, $valor)
{
    if (strlen(trim($valor)) < $min) {
        return true;
    } else if (strlen(trim($valor)) > $max) {
        return true;
    } else {
        return false;
    }
}

function usuarioExiste($usuario)
{
    global $mysqli;

    $stmt = $mysqli->prepare("SELECT id FROM users WHERE usuario = ? LIMIT 1"); // ? indica que va un valor ahi
    $stmt->bind_param("s", $usuario); //aqui indicamos que tipo de valor va "s" string "i" int
    $stmt->execute();
    $stmt->store_result();
    $num = $stmt->num_rows;
    $stmt->close();

    if ($num > 0) {
        return true;
    } else {
        return false;
    }

}

function emailExiste($email)
{
    global $mysqli;

    $stmt = $mysqli->prepare("SELECT id FROM users WHERE correo = ? LIMIT 1"); // ?  indica que va un valor ahi
    $stmt->bind_param("s", $email); //aqui indicamos que tipo de valor va "s" string "i" int
    $stmt->execute();
    $stmt->store_result();
    $num = $stmt->num_rows;
    $stmt->close();

    if ($num > 0) {
        return true;
    } else {
        return false;
    }
}
//encriptado Hash
function hashPassword($password)
{
    $hash = password_hash($password, PASSWORD_DEFAULT);
    return $hash;
}
function caracterPassword($password)
{
    // Expresión regular para verificar la contraseña
    $patron = "'/^(?=.*[A-Z])(?=.*[\W_]).{8,}$/'"; // al menos 1 mayúscula, 1 símbolo y longitud mínima de 8 caracteres

    // Verificar si la contraseña coincide con el patrón
    if (preg_match($patron, $password)) {
        return true; // La contraseña es válida
    } else {
        return false; // La contraseña no es válida
    }
}

// generador del token al usuario para activar cuenta
function generateToken()
{
    $gen = md5(uniqid(mt_rand(), false));
    return $gen;
}

//metodo para registrar el usuario
function registraUsuario($usuario, $pass_hash, $nombre, $email, $token, $tipo_usuario, $codigo, $image, $estatus, $fechaRegistro)
{
   

    //conexion a la base de datos 
    global $mysqli;
    date_default_timezone_set("America/Bogota");
    $hora = date('h:i a', time() - 3600 * date('I'));
    $fecha = date("d/m/Y");
    $ran_id = rand(time(), 100000000);
    $fechaRegistro = $fecha . " " . $hora;
    $status = "Active now";

    //inserta los datos ingresados a la base de datos en su respectivo campo
    $stmt = $mysqli->prepare("INSERT INTO users ( usuario, password, nombre, correo, token, id_tipo, codigo, estatus, fecha_registro, unique_id) VALUES(?,?,?,?,?,?,?,?,?,?)");
    // Modificar la consulta para asignar la imagen predeterminada al campo 'imagen'
    $stmt->bind_param('sssssisssi', $usuario, $pass_hash, $nombre, $email, $token, $tipo_usuario, $codigo, $status, $fechaRegistro, $ran_id);
    //bucle que al momento del execute con la conexion $mysqli insertara el id
    if ($stmt->execute()) {
        return $mysqli->insert_id;
    } else {
        //y si no hara el return en falso 
        return 0;
    }

}


function enviarEmail($email, $nombre, $asunto, $cuerpo)
{


    require ("../plugins/PHPMailer-master/src/PHPMailer.php");
    require ("../plugins/PHPMailer-master/src/Exception.php");
    require ("../plugins/PHPMailer-master/src/SMTP.php");
    // $mail = new PHPMailer();

    $mail = new PHPMailer();
    // $mail->SMTPDebug = 2; Usar para verificar errores
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";

    // $mail->CharSet="UTF-8";

    // $mail->Host = 'smtp.gmail.com';
    // $mail->SMTPSecure = 'tipo de seguridad';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;

    $mail->Username = "lifeline.ptc.2024@gmail.com";
    $mail->Password = "xufuzzvkjdgxqqck";


    // $mail->SetFrom('miemail@dominio.com', 'Sistema con PHP');
    // $mail->AddAddress($email, $nombre);
    $mail->SetFrom('lifeline.ptc.2024@gmail.com', 'LIFELINE - FOR YOU');
    $mail->AddAddress($email, $nombre);

    $mail->Subject = $asunto;
    $mail->Body = $cuerpo;
    $mail->IsHTML(true);

    if ($mail->Send())
        return true;
    else
        return false;
}

function enviarPDF($email, $nombre, $asunto, $cuerpo)
{
    require ("../plugins/PHPMailer-master/src/PHPMailer.php");
    require ("../plugins/PHPMailer-master/src/Exception.php");
    require ("../plugins/PHPMailer-master/src/SMTP.php");
    // $mail = new PHPMailer();

    $mail = new PHPMailer;

    // Configurar el servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'lifeline.ptc.2024@gmail.com';
    $mail->Password = 'xufuzzvkjdgxqqck';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Configurar el remitente y destinatario
    $mail->setFrom('lifeline.ptc.2024@gmail.com', 'LifeLine');
    $mail->addAddress($email, $nombre);

    // Asignar asunto y cuerpo del mensaje
    $mail->Subject = 'Prueba de adjunto con PHPMailer';
    $mail->Body = 'Este es un correo de prueba con un archivo adjunto.';
//"C:\xampp\htdocs\PTC\assets\images\MANUAL DE LECCIONES TÉCNOLOGIA II SEGUNDO PERIODO.pdf";
    // Adjuntar un archivo

    $accion = $_POST['pdf'];
    if ($accion == "moto") {
        $pdf = 'Motorcycle Insurance.pdf';
    } elseif ($accion == "car") {
        $pdf = 'Car Insurance.pdf';
    } elseif ($accion == "industry") {
        $pdf = 'Utility Vehicles Insurance.pdf';
    }  elseif ($accion == "medical") {
        $pdf = 'Healthcare Insurance.pdf';
    } elseif ($accion == "home") {
        $pdf = 'Home Insurance.pdf';
    } else {
        echo "There is no file";
    }
    



    $file = $pdf;
    $file_path = '../assets/images/' . $file; // Ruta del archivo a adjuntar
    $mail->addAttachment($file_path); // Adjuntar el archivo

    // Enviar el correo
    if ($mail->send()) {
        echo '<p><script>swal({
            title: "Check Your E-Mail!",
            text: "We sent a link to your E-Mail",
            icon: "success",
             }).then(function() {
            window.location = "../views/view_user.php";
            });</script></p>';
        echo $pdf;
    } else {
        echo '<p><script>swal({
            title: "Try Again!",
            text: "We got an error sending the E-Mail",
            icon: "error",
             }).then(function() {
            window.location = "../views/view_user.php";
            });</script></p>';
    }
}

function resultBlock($errors)
{
    if (count($errors) > 0) {
        echo "<div id='error' class='alert alert-danger' role='alert'>
            <a href='#' onclick=\"showHide('error');\">[X]</a><ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
        echo "</div>";
    }
}


function isNullLogin($usuario, $password)
{
    if (strlen(trim($usuario)) < 1 || strlen(trim($password)) < 1) {
        return true;
    } else {
        return false;
    }
}

function activarUsuario($id)
{
    global $mysqli;

    $stmt = $mysqli->prepare("UPDATE users SET activacion=1 WHERE id = ?");
    $stmt->bind_param("s", $id);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

// metodo para el login////////////////////////////////////////////////
function login($usuario, $password)
{
    session_start();
    include ('conexion.php');

    $usuario = trim($_POST['correo']);
    $password = trim($_POST['password']);

    $stmt = $mysqli->prepare("SELECT id, id_tipo, unique_id, password, nombre, imagen FROM users WHERE correo = ? LIMIT 1");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;

    if ($rows > 0) {
        $stmt->bind_result($id, $id_tipo, $unique_id, $passwd, $nombre, $imagen);
        $stmt->fetch();

        if (isActivo($usuario)) {
            if (password_verify($password, $passwd)) {
                // Iniciando la sesión
                $_SESSION['id'] = $id;
                $_SESSION['tipo_usuario'] = $id_tipo;
                $_SESSION['nombre'] = $nombre;
                $_SESSION['correo'] = $usuario;
                $_SESSION['imagen'] = $imagen;
                $_SESSION['unique_id'] = $unique_id; // Asignando el unique_id a la sesión

                // Actualizar estado del usuario a "en línea"
                $stmt_update_status = $mysqli->prepare("UPDATE users SET estatus = 'Active now' WHERE id = ?");
                $stmt_update_status->bind_param("i", $id);
                $stmt_update_status->execute();
                $stmt_update_status->close();

                switch ($id_tipo) {
                    case "2":
                        header("location:../views/view_user.php");
                        exit;
                    case "1":
                        header("location:../views/Admin/Admin.php");
                        exit;
                    case "3":
                        header("location:../views/support/users.php");
                        exit;
                    default:
                        echo '<p><script>Swal.fire({
                                title: "ERROR",
                                text: "User type not recognized",
                                icon: "error"
                                });</script></p>';
                }
            } else {
                echo '<p><script>Swal.fire({
                        title: "ERROR",
                        text: "Incorrect credentials, try again.",
                        icon: "error"
                        });</script></p>';
            }
        } else {
            echo '<p><script>Swal.fire({
                    title: "ERROR",
                    text: "The account needs to be active, check your E-Mail",
                    icon: "error"
                    });</script></p>';
        }
    } else {
        echo '<p><script>Swal.fire({
                title: "ERROR",
                text: "This e-mail address is not registered",
                icon: "error"
                });</script></p>';
    }
    

}

//// FIN DEL METODO LOGIN***************************************************************************************************

function lastSession($id)
{
    global $mysqli;

    $stmt = $mysqli->prepare("UPDATE users SET last_session=NOW(), token_password='', password_request=1 WHERE id= ?");
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
}

function validaIdToken($id, $token)
{
    global $mysqli;

    $stmt = $mysqli->prepare("SELECT activacion FROM users WHERE id = ? AND token = ? LIMIT 1");
    $stmt->bind_param("is", $id, $token);
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;

    if ($rows > 0) {

        $stmt->bind_result($activacion);
        $stmt->fetch();

        if ($activacion == 1) {
            $msg = "This account is active.";
            echo '<p><script>Swal.fire({
                title: "Done!",
                text: "Active",
                 type: "success"
                 }).then(function() {
                 window.location = "../views/index.php";
                 });</script></p>';
        } else {
            if (activarUsuario($id)) {
                $msg = 'Active account.';
                echo '<p><script>Swal.fire({
                    title: "Done!",
                    text: "Active",
                    icon: "success"
                    }).then(function() {
                    window.location = "../views/index.php";
                    });</script></p>';
            } else {
                $msg = 'We got an error with the account activation';
            }
        }
    } else {
        $msg = 'There is no record with this account.';
    }

    return $msg;
}


function isActivo($usuario)
{
    global $mysqli;

    $stmt = $mysqli->prepare("SELECT activacion FROM users WHERE usuario = ? || correo = ? LIMIT 1");
    $stmt->bind_param("ss", $usuario, $usuario);
    $stmt->execute();
    $stmt->bind_result($activacion);
    $stmt->fetch();

    if ($activacion == 1) {
        return true;
    } else {
        return false;
    }

}
//$campo: que requerimos, $campoWhere: es el que usaremos para filtrar y $valor: valor del campo
function getValor($campo, $campoWhere, $valor)
{
    global $mysqli;

    $stmt = $mysqli->prepare("SELECT $campo FROM users WHERE $campoWhere = ? LIMIT 1");
    $stmt->bind_param('s', $valor);
    $stmt->execute();
    $stmt->store_result();
    $num = $stmt->num_rows;

    if ($num > 0) {
        $stmt->bind_result($resultado);
        $stmt->fetch();
        return $resultado;
    } else {
        $errors = 'This E-Mail address does not exists';

    }
    return $errors;
}

function generateTokenPass($user_id)
{
    global $mysqli;

    $token = generateToken();
    //update setea el token en bd y cambia el password request a 1 para saber que el usuario solicito el reseteo.
    $stmt = $mysqli->prepare("UPDATE users SET token_password = ?, password_request = 1 WHERE id = ?");
    $stmt->bind_param('ss', $token, $user_id);
    $stmt->execute();
    $stmt->close();

    return $token;
}

function verificaTokenPass($user_id, $token)
{
    global $mysqli;

    $stmt = $mysqli->prepare("SELECT activacion FROM users WHERE id = ? AND token_password = ? AND password_request = 1 LIMIT 1");
    $stmt->bind_param('is', $user_id, $token);
    $stmt->execute();
    $stmt->store_result();
    $num = $stmt->num_rows;

    if ($num > 0) {
        $stmt->bind_result($activacion);
        $stmt->fetch();
        if ($activacion == 1) {
            return true;
        } else {
            return false;
        }
    }
}

function cambiaPassword($password, $user_id, $token)
{
    global $mysqli;

    $stmt = $mysqli->prepare("UPDATE users SET password = ?, token_password = '', password_request = 0 WHERE id = ? AND token_password = ?");
    $stmt->bind_param('sis', $password, $user_id, $token);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
?>