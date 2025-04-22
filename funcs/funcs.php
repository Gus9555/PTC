<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
   
    <title>Document</title>
</head>

<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once 'conexion.php';


// Función para validar espacios vacíos
function isNull($nombre, $user, $pass, $pass_con, $email)
{
    // Verificar si alguno de los campos está vacío o tiene solo espacios en blanco
    if (strlen(trim($nombre)) < 1 || strlen(trim($user)) < 1 || strlen(trim($email)) < 1) {
        return true; // Devuelve true si algún campo está vacío
    } else {
        return false; // Devuelve false si todos los campos tienen valor
    }
}


// Función para validar formato de correo electrónico
function isEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true; // Devuelve true si el correo electrónico es válido
    } else {
        return false; // Devuelve false si el correo electrónico no es válido
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

// Función para verificar si un usuario existe en la base de datos
function usuarioExiste($pdo, $usuario)
{
    $stmt = $pdo->prepare("SELECT id FROM users WHERE usuario = :usuario LIMIT 1");
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }

}


// Función para verificar si un correo electrónico existe en la base de datos
function emailExiste($pdo, $email)
{
    try {
        if (!($pdo instanceof PDO)) {
            throw new Exception('La conexión no es válida.');
        }

        $stmt = $pdo->prepare("SELECT id FROM users WHERE correo = :correo LIMIT 1");
        $stmt->bindParam(':correo', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
function emailExisteR($pdo, $email)
{
    try {
        if (!($pdo instanceof PDO)) {
            throw new Exception('La conexión no es válida.');
        }

        $stmt = $pdo->prepare("SELECT id FROM users WHERE correo = :correo LIMIT 1");
        $stmt->bindParam(':correo', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
////////////////////////////////
function emailExisteAsociados($conn, $email)
{
    try {
        if (!($conn instanceof PDO)) {
            throw new Exception('La conexión no es válida.');
        }

        $stmt = $conn->prepare("SELECT id FROM asociados WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
function emailExistetalleres($conn, $email)
{
    try {
        if (!($conn instanceof PDO)) {
            throw new Exception('La conexión no es válida.');
        }

        $stmt = $conn->prepare("SELECT id FROM talleres WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR); // Corregido el nombre del parámetro
        $stmt->execute();

        return $stmt->rowCount() > 0;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function emailExisteconstructoras($conn, $email)
{
    try {
        if (!($conn instanceof PDO)) {
            throw new Exception('La conexión no es válida.');
        }

        $stmt = $conn->prepare("SELECT id FROM constructuras WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}


////////////////////////////////



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
function generador()
{
    $n = range(10, 99);
    shuffle($n);
    $resultado = '';
    for ($x = 0; $x < 5; $x++) {
        $resultado .= $n[$x] . ' ';
    }
    return $resultado;
}
//metodo para registrar el usuario



// Función para registrar un usuario en la base de datos

function registraPartner($pdo, $usuario, $password, $nombre, $email, $token, $tipo_usuario, $codigo, $estatus, $fechaRegistro, $ran_id, $password_request = 0, $pago = 'pendiente')
{
    date_default_timezone_set("America/Bogota");

    // Preparación de datos adicionales
    $hora = date('h:i a', time() - 3600 * date('I'));
    $fecha = date("d/m/Y");
    $estatus = "Disconnected";
    $ran_id = rand(time(), 100000000);
    $fechaRegistro = $fecha . " " . $hora;

    // Check if the tipo_usuario exists in the tipo_usuario table
    $stmt = $pdo->prepare("SELECT id FROM tipo_usuario WHERE id = :id_tipo");
    $stmt->bindParam(':id_tipo', $tipo_usuario, PDO::PARAM_INT);
    $stmt->execute();
    if (!$stmt->fetch()) {
        // If the tipo_usuario doesn't exist, insert it into the tipo_usuario table
        $stmt = $pdo->prepare("INSERT INTO tipo_usuario (id, tipo) VALUES (:id_tipo, :tipo)");
        $stmt->bindParam(':id_tipo', $tipo_usuario, PDO::PARAM_INT);
        $defaultTipo = 'Some default type'; // Ajusta el valor por defecto según sea necesario
        $stmt->bindParam(':tipo', $defaultTipo, PDO::PARAM_STR);
        $stmt->execute();
    }

    // Preparación y ejecución de la consulta SQL
    $stmt = $pdo->prepare("INSERT INTO users (usuario, password, nombre, correo, token, id_tipo, codigo, estatus, fecha_registro, unique_id, token_password, password_request, activacion, Api, pago) 
                          VALUES (:usuario, :password, :nombre, :correo, :token, :id_tipo, :codigo, :estatus, :fecha_registro, :unique_id, '', :password_request, 0, :api, :pago)");
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':correo', $email, PDO::PARAM_STR);
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    $stmt->bindParam(':id_tipo', $tipo_usuario, PDO::PARAM_INT);
    $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
    $stmt->bindParam(':estatus', $estatus, PDO::PARAM_STR);
    $stmt->bindParam(':fecha_registro', $fechaRegistro, PDO::PARAM_STR);
    $stmt->bindParam(':unique_id', $ran_id, PDO::PARAM_INT);
    $stmt->bindParam(':password_request', $password_request, PDO::PARAM_INT); // Ajusta el tipo de dato según tu base de datos
    $api = 0;
    $stmt->bindParam(':api', $api, PDO::PARAM_INT); // Establece el campo Api a 0 para los registros normales
    $stmt->bindParam(':pago', $pago, PDO::PARAM_STR); // Agrega el campo pago

    return $stmt->execute() ? $pdo->lastInsertId() : 0;
}
function registraUsuario($pdo, $usuario, $password, $nombre, $email, $token, $tipo_usuario, $codigo, $estatus, $fechaRegistro, $ran_id, $password_request = 0)
{
    date_default_timezone_set("America/Bogota");

    // Preparación de datos adicionales
    $hora = date('h:i a', time() - 3600 * date('I'));
    $fecha = date("d/m/Y");
    $estatus = "Disconnected";
    $ran_id = rand(time(), 100000000);
    $fechaRegistro = $fecha . " " . $hora;

    // Check if the tipo_usuario exists in the tipo_usuario table
    $stmt = $pdo->prepare("SELECT id FROM tipo_usuario WHERE id = :id_tipo");
    $stmt->bindParam(':id_tipo', $tipo_usuario, PDO::PARAM_INT);
    $stmt->execute();
    if (!$stmt->fetch()) {
        // If the tipo_usuario doesn't exist, insert it into the tipo_usuario table
        $stmt = $pdo->prepare("INSERT INTO tipo_usuario (id, tipo) VALUES (:id_tipo, :tipo)");
        $stmt->bindParam(':id_tipo', $tipo_usuario, PDO::PARAM_INT);
        $defaultTipo = 'Some default type'; // Ajusta el valor por defecto según sea necesario
        $stmt->bindParam(':tipo', $defaultTipo, PDO::PARAM_STR);
        $stmt->execute();
    }

    // Preparación y ejecución de la consulta SQL
    $stmt = $pdo->prepare("INSERT INTO users (usuario, password, nombre, correo, token, id_tipo, codigo, estatus, fecha_registro, unique_id, token_password, password_request, activacion, Api) 
                          VALUES (:usuario, :password, :nombre, :correo, :token, :id_tipo, :codigo, :estatus, :fecha_registro, :unique_id, '', :password_request, 0, :api)");
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':correo', $email, PDO::PARAM_STR);
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    $stmt->bindParam(':id_tipo', $tipo_usuario, PDO::PARAM_INT);
    $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
    $stmt->bindParam(':estatus', $estatus, PDO::PARAM_STR);
    $stmt->bindParam(':fecha_registro', $fechaRegistro, PDO::PARAM_STR);
    $stmt->bindParam(':unique_id', $ran_id, PDO::PARAM_INT);
    $stmt->bindParam(':password_request', $password_request, PDO::PARAM_INT); // Ajusta el tipo de dato según tu base de datos
    $api = 0;
    $stmt->bindParam(':api', $api, PDO::PARAM_INT); // Establece el campo Api a 0 para los registros normales

    return $stmt->execute() ? $pdo->lastInsertId() : 0;
}
//////////////////////////////////////////////////////////////
function registraAsociados($pdo, $usuario, $password, $nombre, $email, $token, $tipo_usuario, $codigo, $estatus, $fechaRegistro, $ran_id, $password_request = 0)
{
    date_default_timezone_set("America/Bogota");

    // Preparación de datos adicionales
    $hora = date('h:i a', time() - 3600 * date('I'));
    $fecha = date("d/m/Y");
    $estatus = "Disconnected";
    $ran_id = rand(time(), 100000000);
    $fechaRegistro = $fecha . " " . $hora;

    // Check if the tipo_usuario exists in the tipo_usuario table
    $stmt = $pdo->prepare("SELECT id FROM tipo_usuario WHERE id = :id_tipo");
    $stmt->bindParam(':id_tipo', $tipo_usuario, PDO::PARAM_INT);
    $stmt->execute();
    if (!$stmt->fetch()) {
        // If the tipo_usuario doesn't exist, insert it into the tipo_usuario table
        $stmt = $pdo->prepare("INSERT INTO tipo_usuario (id, tipo) VALUES (:id_tipo, :tipo)");
        $stmt->bindParam(':id_tipo', $tipo_usuario, PDO::PARAM_INT);
        $defaultTipo = 'Some default type'; // Ajusta el valor por defecto según sea necesario
        $stmt->bindParam(':tipo', $defaultTipo, PDO::PARAM_STR);
        $stmt->execute();
    }
}


/////////////////////////////////////////////////////////////


function enviarEmail($email, $nombre, $asunto, $cuerpo)
{


    require (__DIR__ . '/../plugins/PHPMailer-master/src/PHPMailer.php');
    require (__DIR__ . '/../plugins/PHPMailer-master/src/Exception.php');
    require (__DIR__ . '/../plugins/PHPMailer-master/src/SMTP.php');

    // $mail = new PHPMailer();

    $mail = new PHPMailer();
    //$mail->SMTPDebug = 2; 
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
/////////////////////////////////////////Proceso de envio de cotizacion/////////////////////////////////
function enviarPDF($email, $nombre, $asunto, $cuerpo, $pdfValue)
{
    require (__DIR__ . '/../plugins/PHPMailer-master/src/PHPMailer.php');
    require (__DIR__ . '/../plugins/PHPMailer-master/src/Exception.php');
    require (__DIR__ . '/../plugins/PHPMailer-master/src/SMTP.php');

    $mail = new PHPMailer();

    try {
        // Desencriptar el email antes de usarlo
        $email = decryptPayload($email);

        // Verificar si el correo desencriptado es válido
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email address after decryption: " . $email);
        }

        // Configurar el servidor SMTP
        $mail->SMTPDebug = 2; 
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
        $mail->Subject = $asunto;
        $mail->Body = $cuerpo;
        $mail->isHTML(true);

        // Determinar el archivo PDF a adjuntar
        $file = '';
        if (strpos($pdfValue, 'moto') === 0) {
            $file = 'Motorcycle Insurance.pdf';
        } elseif (strpos($pdfValue, 'vehi') === 0) {
            $file = 'Car Insurance.pdf';
        } elseif (strpos($pdfValue, 'util') === 0) {
            $file = 'Utility Vehicles Insurance.pdf';
        } elseif (strpos($pdfValue, 'medical_') === 0) {
            $file = 'Healthcare Insurance.pdf';
        } elseif (strpos($pdfValue, 'home_') === 0) {
            $file = 'Home Insurance.pdf';
        }

        error_log("Archivo PDF seleccionado: " . $file);

        if (!empty($file)) {
            $file_path = __DIR__ . '/../assets/images/' . $file; // Ruta del archivo a adjuntar
            if (file_exists($file_path)) {
                $mail->addAttachment($file_path); // Adjuntar el archivo
            } else {
                throw new Exception("El archivo $file no existe en la ruta $file_path.");
            }
        } else {
            throw new Exception("No se seleccionó un archivo para adjuntar.");
        }

        // Enviar el correo
        if (!$mail->send()) {
            throw new Exception("Error al enviar el correo: " . $mail->ErrorInfo);
        }
        return true;
    } catch (Exception $e) {
        error_log("Error en enviarPDF: " . $e->getMessage());
        echo '<script>
            Swal.fire({
                title: "Oops!",
                text: "We encountered a problem: ' . $e->getMessage() . '",
                icon: "error"
            }).then(function() {
                window.location = "../user/view_user.php";
            });
        </script>';
        return false;
    }
}








/////////////////////////////////////////Fin de Proceso de envio de cotizacion/////////////////////////////////

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

// Función para activar un usuario en la base de datos
function activarUsuario($id, $pdo)
{
    try {
        // Preparar la consulta SQL con PDO
        $stmt = $pdo->prepare("UPDATE users SET activacion = 1 WHERE id = :id");

        // Vincular parámetros
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Ejecutar la consulta
        $result = $stmt->execute();

        // Cerrar la conexión
        $stmt->closeCursor();

        // Devolver el resultado de la ejecución de la consulta
        return $result;

    } catch (PDOException $e) {
        // Manejo de errores - puedes personalizar según tu aplicación
        echo "Error al activar usuario: " . $e->getMessage();
        return false;
    }
}



function lastSession($id, $pdo)
{
    try {
        // Preparar la consulta SQL con PDO
        $stmt = $pdo->prepare("UPDATE users SET last_session = NOW(), token_password = '', password_request = 1 WHERE id = :id");

        // Vincular parámetros
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Ejecutar la consulta
        $stmt->execute();

        // Cerrar la conexión
        $stmt->closeCursor();

    } catch (PDOException $e) {
        // Manejo de errores - puedes personalizar según tu aplicación
        echo "Error al actualizar última sesión: " . $e->getMessage();
    }
}

function validaIdToken($id, $token, $pdo)
{
    try {
        // Preparar la consulta SQL con PDO
        $stmt = $pdo->prepare("SELECT activacion FROM users WHERE id = :id AND token = :token LIMIT 1");

        // Vincular parámetros
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $activacion = $stmt->fetchColumn();

        // Cerrar la conexión
        $stmt->closeCursor();

        if ($activacion === '1') {
            $msg = "";
            echo '<p><script>Swal.fire({
                title: "Done!",
                text: "Active",
                icon: "success"
                }).then(function() {
                window.location = "../user/login.php";
                });</script></p>';
        } else {
            // Si la cuenta no está activa, intentamos activarla
            if (activarUsuario($id, $pdo)) {
                $msg = '';
                echo '<p><script>Swal.fire({
                    title: "Done!",
                    text: "Active",
                    icon: "success"
                    }).then(function() {
                    window.location = "../user/login.php";
                    });</script></p>';
            } else {
                $msg = 'There was an error activating the account.';
            }
        }

    } catch (PDOException $e) {
        // Manejo de errores - puedes personalizar según tu aplicación
        echo "Error: " . $e->getMessage();
        $msg = 'Error occurred while validating ID and token.';
    }

    return $msg;
}
//////////////////////////////////////////////////////////////////////
function validaId($id, $token, $pdo)
{
    try {
        // Preparar la consulta SQL con PDO
        $stmt = $pdo->prepare("SELECT activacion FROM users WHERE id = :id AND token = :token LIMIT 1");

        // Vincular parámetros
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $activacion = $stmt->fetchColumn();

        // Cerrar la conexión
        $stmt->closeCursor();

        if ($activacion === '1') {
            $msg = "";
            echo '<p><script>Swal.fire({
                title: "Done!",
                text: "Active",
                icon: "success"
                }).then(function() {
                window.location = "../../user/login.php";
                });</script></p>';
        } else {
            // Si la cuenta no está activa, intentamos activarla
            if (activarUsuario($id, $pdo)) {
                $msg = '';
                echo '<p><script>Swal.fire({
                    title: "Done!",
                    text: "Active",
                    icon: "success"
                    }).then(function() {
                    window.location = "../../user/login.php";
                    });</script></p>';
            } else {
                $msg = 'There was an error activating the account.';
            }
        }

    } catch (PDOException $e) {
        // Manejo de errores - puedes personalizar según tu aplicación
        echo "Error: " . $e->getMessage();
        $msg = 'Error occurred while validating ID and token.';
    }

    return $msg;
}

///////////////////////////////////////////////////////////////////////



function isActivo($id, $pdo)
{
    try {
        $stmt = $pdo->prepare("SELECT activacion FROM users WHERE id = :id LIMIT 1");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $activacion = $stmt->fetchColumn();
        return $activacion == 1;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}


//$campo: que requerimos, $campoWhere: es el que usaremos para filtrar y $valor: valor del campo
function getValor($campo, $campoWhere, $valor, $pdo) {
    try {
        if (!($pdo instanceof PDO)) {
            throw new Exception('La conexión no es válida.');
        }

        $stmt = $pdo->prepare("SELECT $campo FROM users WHERE $campoWhere = :valor LIMIT 1");
        $stmt->bindParam(':valor', $valor, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row[$campo];
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}



function generateTokenPass($user_id, $pdo) {
    $token = bin2hex(random_bytes(16));
    try {
        if (!($pdo instanceof PDO)) {
            throw new Exception('La conexión no es válida.');
        }

        $stmt = $pdo->prepare("UPDATE users SET token_password = :token, password_request = 1 WHERE id = :id");
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $token;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}


function verificaTokenPass($user_id, $token, $pdo) {
    try {
        // Preparar la consulta SQL con PDO
        $stmt = $pdo->prepare("SELECT activacion FROM users WHERE id = :user_id AND token_password = :token AND password_request = 1 LIMIT 1");

        // Vincular parámetros
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $activacion = $stmt->fetchColumn();

        // Cerrar la conexión
        $stmt->closeCursor();

        // Verificar si el valor de activacion es 1 (entero)
        return $activacion == 1;

    } catch (PDOException $e) {
        // Manejo de errores - puedes personalizar según tu aplicación
        echo "Error: " . $e->getMessage();
        return false;
    }
}


function cambiaPassword($password, $user_id, $token, $pdo)
{
    try {
        // Preparar la consulta SQL con PDO
        $stmt = $pdo->prepare("UPDATE users SET password = :password, token_password = '', password_request = 0 WHERE id = :user_id AND token_password = :token");

        // Vincular parámetros
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    } catch (PDOException $e) {
        // Manejo de errores - puedes personalizar según tu aplicación
        echo "Error: " . $e->getMessage();
        return false;
    }
}
function encryptPayload($plainText) {
    $key = '7>xwv,9jN.!0LEsSwc.Ca3X!SdAO//';  
    $iv = '<w,jN.0EScC3!dO/';
   
    $encrypted = openssl_encrypt($plainText, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    $payload = base64_encode($iv . $encrypted);
   
    return $payload;
  }

  function decryptPayload($encryptedPayload) {
    $key = '7>xwv,9jN.!0LEsSwc.Ca3X!SdAO//';
    $data = base64_decode($encryptedPayload);
    $ivLength = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($data, 0, $ivLength);
    $encryptedText = substr($data, $ivLength);
    $decrypted = openssl_decrypt($encryptedText, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    return $decrypted;
 }


 function registraUsuarioGoogle($pdo, $usuario, $password, $nombre, $email, $token, $tipo_usuario, $codigo, $estatus, $fechaRegistro, $ran_id, $api, $password_request = 0)
{
    date_default_timezone_set("America/Bogota");

    // Preparación de datos adicionales
    $hora = date('h:i a', time() - 3600 * date('I'));
    $fecha = date("d/m/Y");
    $estatus = "Disconnected";
    $ran_id = rand(time(), 100000000);
    $fechaRegistro = $fecha . " " . $hora;

    // Check if the tipo_usuario exists in the tipo_usuario table
    $stmt = $pdo->prepare("SELECT id FROM tipo_usuario WHERE id = :id_tipo");
    $stmt->bindParam(':id_tipo', $tipo_usuario, PDO::PARAM_INT);
    $stmt->execute();
    if (!$stmt->fetch()) {
        // If the tipo_usuario doesn't exist, insert it into the tipo_usuario table
        $stmt = $pdo->prepare("INSERT INTO tipo_usuario (id, tipo) VALUES (:id_tipo, :tipo)");
        $stmt->bindParam(':id_tipo', $tipo_usuario, PDO::PARAM_INT);
        $defaultTipo = 'Some default type'; // Ajusta el valor por defecto según sea necesario
        $stmt->bindParam(':tipo', $defaultTipo, PDO::PARAM_STR);
        $stmt->execute();
    }

    // Preparación y ejecución de la consulta SQL
    $stmt = $pdo->prepare("INSERT INTO users (usuario, password, nombre, correo, token, id_tipo, codigo, estatus, fecha_registro, unique_id, token_password, password_request, activacion, api) 
                          VALUES (:usuario, :password, :nombre, :correo, :token, :id_tipo, :codigo, :estatus, :fecha_registro, :unique_id, '', :password_request, 0, :api)");
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':correo', $email, PDO::PARAM_STR);
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    $stmt->bindParam(':id_tipo', $tipo_usuario, PDO::PARAM_INT);
    $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
    $stmt->bindParam(':estatus', $estatus, PDO::PARAM_STR);
    $stmt->bindParam(':fecha_registro', $fechaRegistro, PDO::PARAM_STR);
    $stmt->bindParam(':unique_id', $ran_id, PDO::PARAM_INT);
    $stmt->bindParam(':password_request', $password_request, PDO::PARAM_INT); // Ajusta el tipo de dato según tu base de datos
    $stmt->bindParam(':api', $api, PDO::PARAM_INT);

    return $stmt->execute() ? $pdo->lastInsertId() : 0;
}
function insertTalleres($conn, $nombre, $nombre_dueño, $activation, $email, $telefono, $telefono2, $direccion, $ubicacion_taller, $dui, $agencia, $documentacion) {
    $activation = "2";

    // Verificar si el correo electrónico ya existe en la base de datos
    $sql = "SELECT * FROM talleres WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]); // Usando el email directamente
    if ($stmt->rowCount() > 0) {
        return "The email is already registered, try a different one";
    }
    
    // Codificar el documento en base64 para evitar problemas de codificación de caracteres
    if ($documentacion !== null) {
        $documentacion_encoded = base64_encode($documentacion);
    } else {
        $documentacion_encoded = null;
    }
    
    $sql = "INSERT INTO talleres (tipo_agencia, nombre_taller, direccion, telefono_fijo, telefono_personal, email, documentacion, activation, nombre_dueño, ubicacion_taller, dui) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$agencia, $nombre, $direccion, $telefono, $telefono2, $email, $documentacion_encoded, $activation, $nombre_dueño, $ubicacion_taller, $dui]);
    
    if ($result) {
        return "Registration successful";
    } else {
        $errorInfo = $stmt->errorInfo();
        return "Error inserting data: " . $errorInfo[2];
    }
}




function insertAsociados($conn, $nombre_completo, $telefono, $email, $dui, $jvpm, $nit, $especialidad, $subespecialidad, $direccion_clinica, $zona_medica, $documentacion) {
    $activation = "2";
   
    // Verificar si el correo electrónico ya está registrado
    $sql = "SELECT * FROM asociados WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        return "The email is already registered, try a different one";
    }
    
    // Codificar el documento en base64 si no es nulo
    $documentacion_encoded = $documentacion ? base64_encode($documentacion) : null;

    // Preparar y ejecutar la consulta de inserción
    $sql = "INSERT INTO asociados (nombre_completo, telefono, email, dui, nit, jvpm, especialidad, subespecialidad, direccion_clinica, zona_medica, documentacion, activation) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$nombre_completo, $telefono, $email, $dui, $nit, $jvpm, $especialidad, $subespecialidad, $direccion_clinica, $zona_medica, $documentacion_encoded, $activation]);

    // Verificar si la inserción fue exitosa
    if ($result) {
        return "Registration successful";
    } else {
        // $errorInfo = $stmt->errorInfo();
        // return "Error inserting data: " . $errorInfo[2];
    }
}





?>

