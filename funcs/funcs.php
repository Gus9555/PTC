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
    function isNull($nombre, $user, $pass, $pass_con, $email){
        if(strlen(trim($nombre)) < 1 || strlen(trim($user)) < 1 || strlen(trim($email)) < 1){
            return true;
        }else{
            return false;
        }
    }

    function isEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }
  //funcion de comparacion de contraseñas
    function validaPassword($var1, $var2)
    {
        if(strcmp($var1, $var2)!== 0){
            return false;
        }else{
            return true;
        }
    }
// funcion delimitante de caracteres
    function minMax($min, $max, $valor){
        if(strlen(trim($valor)) < $min){
            return true;
        }else if(strlen(trim($valor)) >$max){
            return true;
        }else{
            return false;
        }
    }
    
    function usuarioExiste($usuario)
    {
        global $mysqli;

        $stmt = $mysqli->prepare("SELECT id FROM usuarios WHERE usuario = ? LIMIT 1"); // ? indica que va un valor ahi
        $stmt->bind_param("s", $usuario); //aqui indicamos que tipo de valor va "s" string "i" int
        $stmt->execute();
        $stmt->store_result();
        $num = $stmt->num_rows;
        $stmt->close();

        if($num > 0){
            return true;
        }else{
            return false;
        }

    }

    function emailExiste($email)
    {
        global $mysqli;

        $stmt = $mysqli->prepare("SELECT id FROM usuarios WHERE correo = ? LIMIT 1"); // ?  indica que va un valor ahi
        $stmt->bind_param("s", $email); //aqui indicamos que tipo de valor va "s" string "i" int
        $stmt->execute();
        $stmt->store_result();
        $num = $stmt->num_rows;
        $stmt->close();

        if($num > 0){
            return true;
        }else{
            return false;
        }
    }
    //encriptado Hash
    function hashPassword($password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $hash;
    }

    // generador del token al usuario para activar cuenta
    function generateToken(){
        $gen = md5(uniqid(mt_rand(), false));
        return $gen;
    }

//metodo para registrar el usuario
    function registraUsuario($usuario, $pass_hash, $nombre, $email, $token, $tipo_usuario, $codigo){
        //conexion a la base de datos 
        global $mysqli;
        //inserta los datos ingresados a la base de datos en su respectivo campo
        $stmt = $mysqli->prepare("INSERT INTO usuarios (usuario, password, nombre, correo, token, id_tipo, codigo) VALUES(?,?,?,?,?,?,?)");
        $stmt->bind_param('sssssis', $usuario, $pass_hash, $nombre, $email, $token, $tipo_usuario, $codigo);
        //bucle que al momento del execute con la conexion $mysqli insertara el id
       
        if($stmt->execute()){
            return $mysqli->insert_id;
        }else{
             //y si no hara el return en falso 
            return 0;
        }
    

    }
        function enviarEmail($email, $nombre, $asunto, $cuerpo){
        

        require("../plugins/PHPMailer-master/src/PHPMailer.php");
        require("../plugins/PHPMailer-master/src/Exception.php");
        require("../plugins/PHPMailer-master/src/SMTP.php");
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

        if($mail->Send())
        return true;
        else
        return false;
    }

    function resultBlock($errors){
        if(count($errors) > 0)
        {
            echo "<div id='error' class='alert alert-danger' role='alert'>
            <a href='#' onclick=\"showHide('error');\">[X]</a><ul>";
            foreach($errors as $error)
            {
                echo "<li>".$error."</li>";
            }
            echo "</ul>";
            echo "</div>";
        }
    }

    function validaIdToken($id, $token){
        global $mysqli;

        $stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE id = ? AND token = ? LIMIT 1");
        $stmt->bind_param("is", $id, $token);
        $stmt->execute();
        $stmt->store_result();
        $rows = $stmt->num_rows;

        if($rows > 0){

            $stmt->bind_result($activacion);
            $stmt->fetch();

            if($activacion == 1){
                $msg = "This account is active.";
                // echo '<p><script>Swal.fire({
                //     title: "Done!",
                //     text: "Active",
                //     type: "success"
                //     }).then(function() {
                //     window.location = "index.php";
                //     });</script></p>';
            }else{
                if(activarUsuario($id)){
                    $msg = 'Active account.';
                    echo '<p><script>Swal.fire({
                        title: "Done!",
                        text: "Active",
                        icon: "success"
                        }).then(function() {
                        window.location = "../views/index.php";
                        });</script></p>';
                }else{
                    $msg = 'We got an error with the account activation';
                }
            }
        }else{
            $msg = 'There is no record with this account.';
        }

        return $msg;
    }


    function activarUsuario($id){
        global $mysqli;

        $stmt = $mysqli->prepare("UPDATE usuarios SET activacion=1 WHERE id = ?");
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    function isNullLogin($usuario, $password){
        if(strlen(trim($usuario)) < 1 || strlen(trim($password)) < 1 )
        {
            return true;
        }else{
            return false;
        }
    }
 // metodo para el login////////////////////////////////////////////////
    function login($usuario, $password)
    {
        global $mysqli;
        // selecciona los datos del usuario que esta ingresando para validar si existen////////////////////////////////////////////////
        $stmt = $mysqli->prepare("SELECT id, id_tipo, password, nombre FROM usuarios WHERE usuario = ? || correo = ? LIMIT 1");
        $stmt->bind_param("ss", $usuario, $usuario);
        $stmt->execute();
        $stmt->store_result();
        $rows = $stmt->num_rows;
        // este if valida si el usuario existe en la base datos////////////////////////////////////////////////
        if($rows > 0){

            // valida si el usuario esta activo////////////////////////////////////////////////

           
                // aca ya empieza a verificar si las contraseñas que estan insertadas en la base de datos conciden////////////////////////////////////////////////

                $stmt->bind_result($id, $id_tipo, $passwd, $nombre);
                $stmt->fetch();
                
                $validaPass = password_verify($password, $passwd);

                // si las contraseñas consicen procede hacer el metodo de redireccion si es admin por medio de tipo de id 2, o si es 1 lo redirecciona con la vista usuario////////////////////////////////////////////////
                if($validaPass){    
                    if($id_tipo == "2"){
                        lastSession($id);
                        $_SESSION['id_usuario'] = $id;
                        $_SESSION['tipo_usuario'] = $id_tipo;
                        $_SESSION['nombre'] = $nombre;
                        header("location: ../views/view_user.php"); // esta linea es la que designamos a donde lo redireccionara si es usuario
                    }else{
                        lastSession($id);
                        $_SESSION['id_usuario'] = $id;
                        $_SESSION['tipo_usuario'] = $id_tipo;
                        $_SESSION['nombre'] = $nombre;
                        header("location: ../views/Admin/Admin.html"); // esta linea es la que designamos a donde lo redireccionara si es admin


                    }
                   
                    
                  // estos elses son las alertas   
                }else{
                    echo '<p><script>Swal.fire({
                        title: "ERROR",
                        text: "Wrong credentials, try again",
                        icon: "error"
                        });</script></p>';
                        
                }
            
        }else{
            echo '<p><script>Swal.fire({
                title: "ERROR",
                text: "This username already exists",
                icon: "error"
                });</script></p>';
        }
        return;
    }

    //// FIN DEL METODO LOGIN***************************************************************************************************

    function lastSession($id)
    {
        global $mysqli;

        $stmt = $mysqli->prepare("UPDATE usuarios SET last_session=NOW(), token_password='', password_request=1 WHERE id= ?");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->close();
    }

    function isActivo($usuario){
        global $mysqli;

        $stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE usuario = ? || correo = ? LIMIT 1");
        $stmt->bind_param("ss", $usuario, $usuario);
        $stmt->execute();
        $stmt->bind_result($activacion);
        $stmt->fetch();

        if($activacion == 1)
        {
            return true;
        }else{
            return false;
        }

    }
    //$campo: que requerimos, $campoWhere: es el que usaremos para filtrar y $valor: valor del campo
    function getValor($campo, $campoWhere, $valor)
    {
        global $mysqli;

        $stmt = $mysqli->prepare("SELECT $campo FROM usuarios WHERE $campoWhere = ? LIMIT 1");
        $stmt->bind_param('s', $valor);
        $stmt->execute();
        $stmt->store_result();
        $num = $stmt->num_rows;

        if($num > 0 )
        {
            $stmt->bind_result($resultado);
            $stmt->fetch();
            return $resultado;
        }
        else
        {
            $errors = 'This E-Mail address does not exists';
           
        }
        return $errors;
    }

    function generateTokenPass($user_id)
    {
        global $mysqli;
        
        $token = generateToken();
        //update setea el token en bd y cambia el password request a 1 para saber que el usuario solicito el reseteo.
        $stmt = $mysqli->prepare("UPDATE usuarios SET token_password = ?, password_request = 1 WHERE id = ?");
        $stmt->bind_param('ss', $token, $user_id);
        $stmt->execute();
        $stmt->close();
        
        return $token;
    }

    function verificaTokenPass($user_id, $token)
    {
        global $mysqli;

        $stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE id = ? AND token_password = ? AND password_request = 1 LIMIT 1");
        $stmt->bind_param('is', $user_id, $token );
        $stmt->execute();
        $stmt->store_result();
        $num = $stmt->num_rows;

        if($num > 0)
        {
            $stmt->bind_result($activacion);
            $stmt->fetch();
            if($activacion == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }

    function cambiaPassword($password, $user_id, $token)
    {
        global $mysqli;

        $stmt = $mysqli->prepare("UPDATE usuarios SET password = ?, token_password = '', password_request = 0 WHERE id = ? AND token_password = ?");
        $stmt->bind_param('sis', $password, $user_id, $token);

        if($stmt->execute())
        {
            return true;
        }else{
            return false;
        }
    }
?>