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
    require '../funcs/conexion.php';
    require '../funcs/funcs.php';

    $errors = array();
    
    if(!empty($_POST))
    {
        $email = $mysqli->real_escape_string($_POST['email']);
    
        if(!isEmail($email))
        {
            $errors[] = "Debe ingresar un correo electronico valido";
        }
        //valida si el email existe y asi poder hacer el proceso del email
            if(emailExiste($email))
            {
                
                $user_id = getValor('id', 'correo', $email);
                $nombre = getValor('nombre', 'correo', $email);
                 //se declara la variable con token con el proceso que esta en funcs.php, que es generatetokenpass
                $token = generateTokenPass($user_id);
                  //esta es la variable que redireccionara al usuario en el correo que se le enviara
                $url = 'http://'.$_SERVER["SERVER_NAME"].'/PTC/views/cambiaPass.php? id='.$user_id.'&token='.$token;
                //el asuto y cuerpo es lo que ira en el mesaje del correo
                $asunto = 'Recuperar Password - Sistema PHP';
                $cuerpo = "Estimado $nombre: <br /><br /> Se ha solicitado un reinicio
                de contrase&ntilde;a. <br/> Para restaurar la contrase&ntilde;a, haz click en el siguiente enlace: <a href='$url'>$url</a>";
                //aca se envia el correo usando las anteriores mencionadas variables
                if(enviarEmail($email, $nombre, $asunto, $cuerpo))
                {
                    
                    echo '<p><script>swal({
                        title: "E-Mail Sent!",
                        text: "Check your E-Mail",
                        icon: "success",
                         }).then(function() {
                        window.location = "../views/index.php";
                        });</script></p>';
        
                    exit;
                }
                else
                {
                    echo '<p><script>Swal.fire({
                        title: "Opsss!",
                        text: "We got a problem sending the E-Mail!",
                        type: "error"
                        }).then(function() {
                        window.location = "../views/registro.php";
                        });</script></p>';
                } 
                
                
                
            }
        else
        {
            echo '<p><script>Swal.fire({
                title: "Opsss!",
                text: "This E-Mail address does not exist, try again",
                type: "error"
                }).then(function() {
                window.location = "../views/registro.php";
                });</script></p>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Website Title -->
    <title>Log In</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext"
        rel="stylesheet">
    <link href="../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../assets/boss/css/swiper.css" rel="stylesheet">
    <link href="../assets/boss/css/magnific-popup.css" rel="stylesheet">
    <link href="../assets/boss/css/styles2.css" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="../assets/boss/images/favicon.png">
</head>

<body data-spy="scroll" data-target=".fixed-top">




    <!-- Header -->
    <header id="header" class="ex-2-header">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Password Recovery</h1>
                    <br>
                    <!-- Sign Up Form -->
                    <div class="form-container">
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="card-header">
                                <a class="navbar-brand logo-image" href=""><img src="../assets/boss/images/padlock-unlock.png"
                                        alt="alternative" width="100px"></a>
                            </div>
                            <div class="card-body">
                                <div class="small mb-3 text-muted">Enter your email address and we will send you a link
                                    to reset your password.</div>
                                <form id="loginform" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Email</label>
                                        <input class="form-control py-4" id="inputEmailAddress" name="email"
                                            type="email" aria-describedby="emailHelp"
                                            placeholder="Enter email address" />
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">

                                        <button type="submit" class="form-control-submit-button">Send</a>
                                    </div>
                                    <div>
                                        <a class="small" href="../views/index.php">Return to login</a>
                                    </div>
                                </form>
                                <?php echo resultBlock($errors); ?>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="../views/registro.php">No account? Sign up!</a></div>
                            </div>
                        </form>

                    </div> <!-- end of form container -->
                    <!-- end of sign up form -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of ex-header -->
    <!-- end of header -->


    <!-- Scripts -->
    <script src="../assets/boss/js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="../assets/boss/js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="../assets/boss/js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="../assets/boss/js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="../assets/boss/js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="../assets/boss/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <!--  <script src="boss/js/validator.min.js"></script>  Validator.js - Bootstrap plugin that validates forms -->
    <script src="../assets/boss/js/scripts.js"></script> <!-- Custom scripts -->
</body>

</html>