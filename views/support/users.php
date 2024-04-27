<?php
session_start();
include ('config/config.php');

if (isset($_SESSION['correo']) && isset($_SESSION['id']) && isset($_SESSION['imagen']) && isset($_SESSION['nombre'])) {
  $idConectado = $_SESSION['id'];
  $email_user = $_SESSION['correo'];
  $NombreUsarioSesion = $_SESSION['nombre'];
  $imgPerfil = $_SESSION['imagen'];

  // Determinar el tipo de usuario que está ingresando al chat
  $QueryTipoUsuario = "SELECT id_tipo FROM users WHERE id = '$idConectado'";
  $resultTipoUsuario = mysqli_query($con, $QueryTipoUsuario);
  $rowTipoUsuario = mysqli_fetch_assoc($resultTipoUsuario);
  $idTipoUsuario = $rowTipoUsuario['id_tipo'];

  // Definir la consulta SQL según el tipo de usuario
  if ($idTipoUsuario == 2) {
    // Si el usuario es tipo 2, mostrar todos los usuarios tipo 3
    $QueryUsers = "SELECT id, correo, imagen, nombre, fecha_session, estatus, id_tipo 
                   FROM users 
                   WHERE id_tipo = 3 AND id != '$idConectado'
                   ORDER BY correo ASC";
  } elseif ($idTipoUsuario == 3) {
    // Si el usuario es tipo 3, mostrar solo usuarios con quienes ha intercambiado mensajes
    $QueryUsers = "SELECT DISTINCT u.id, u.correo, u.nombre, u.fecha_session, u.estatus, u.id_tipo 
                   FROM users u
                   INNER JOIN msjs m ON ((u.id = m.user_id AND m.to_id = '$idConectado') OR (u.id = m.to_id AND m.user_id = '$idConectado'))
                   WHERE u.id != '$idConectado' AND u.id_tipo != 1
                   ORDER BY u.correo ASC";
  }

  $resultadoQuery = mysqli_query($con, $QueryUsers);
}
  ?>

  <div class="status-bar"></div>
  <div class="row heading">
    <div class="col-sm-8 col-xs-8 heading-avatar">
      <div class="heading-avatar-icon">
        <img src="<?php echo 'imagenesperfil/' . $imgPerfil; ?>">
        <strong style="padding: 0px 0px 0px 20px;">
          <?php echo $NombreUsarioSesion; ?>
        </strong>
      </div>
    </div>

    <div class="col-sm-1 col-xs-1 heading-compose pull-right">
      <a href="acciones/salir.php?id=<?php echo $idConectado; ?>">
        <i class="zmdi zmdi-power" style="font-size: 25px;"></i>
      </a>
    </div>
    <div class="col-sm-1 col-xs-1 pull-right icohome">
      <a href="home.php">
        <i class="zmdi zmdi-refresh zmdi-hc-2x"></i>
      </a>
    </div>
  </div>

  <div class="row searchBox">
    <div class="col-sm-12 searchBox-inner">
      <div class="form-group has-feedback">
        <input id="searchText" type="search" class="form-control" name="searchText" placeholder="Buscar">
        <span class="glyphicon glyphicon-search form-control-feedback"></span>
      </div>
    </div>
  </div>

  <div class="row sideBar">
    <?php
    while ($FilaUsers = mysqli_fetch_array($resultadoQuery)) {
      $id_persona = $FilaUsers['id'];

      $resultado = ("SELECT * FROM msjs WHERE user_id='$id_persona' AND  to_id='$idConectado'  AND leido='NO' ");
      $re = mysqli_query($con, $resultado);
      $numero_filas = mysqli_num_rows($re);

      // Buscando los mensajes que están sin leer por dicho usuario en sesión.
      $no_leidos = '';
      if ($numero_filas > 0) {
        $res = ("SELECT * FROM msjs WHERE user_id='$id_persona' AND leido='NO' ");
        $ree = mysqli_query($con, $res);
        if ($cantMsjs = mysqli_num_rows($ree) > 0) { ?>
          <div style="display:none;">
            <audio controls autoplay>
              <source src="effect.mp3" type="audio/mp3">
            </audio>
          </div>
          <?php
        }
      }
      $no_leidos = $numero_filas;
      ?>

      <div class="row sideBar-body" id="<?php echo $FilaUsers['id']; ?>">
        <div class="col-sm-3 col-xs-3 sideBar-avatar">
          <?php
          if ($FilaUsers['estatus'] != 'Inactiva') { ?>
               <div class="avatar-icon">
                 <?php if ($FilaUsers['id_tipo'] == 2) { ?>
                     <img src="imagenesperfil/user.jpeg" class="notification-container" style="border:3px solid #28a745 !important;">
                 <?php } elseif ($FilaUsers['id_tipo'] == 3) { ?>
                     <img src="imagenesperfil/support.png" class="notification-container" style="border:3px solid #28a745 !important;">
                 <?php } else { ?>
                     <img src="<?php echo 'imagenesperfil/' . $FilaUsers['imagen']; ?>" class="notification-container"
                       style="border:3px solid #28a745 !important;">
                 <?php } ?>
               </div>
           <?php } else { ?>
               <div class="avatar-icon">
                 <?php if ($FilaUsers['id_tipo'] == 2) { ?>
                     <img src="imagenesperfil/user.jpeg" class="notification-container" style="border:3px solid #696969 !important;">
                 <?php } elseif ($FilaUsers['id_tipo'] == 3) { ?>
                     <img src="imagenesperfil/support.png" class="notification-container" style="border:3px solid #696969 !important;">
                 <?php } else { ?>
                     <img src="<?php echo 'imagenesperfil/' . $FilaUsers['imagen']; ?>" class="notification-container" style="border:3px solid #696969 !important;">
                 <?php } ?>
               </div>
           <?php } ?>
        </div>

        <div class="col-sm-9 col-xs-9 sideBar-main">
          <div class="row">
            <div class="col-sm-8 col-xs-8 sideBar-name">
              <span class="name-meta">
                <?php
                echo $FilaUsers['nombre'];
                ?>
              </span>
            </div>
            <div class="col-sm-4 col-xs-4 pull-right sideBar-time" style="color:#93918f;">
              <span class="notification-counter">
                <?php echo $no_leidos; ?>
              </span>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>


  <script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript">
    $(function () {
      $(".sideBar-body").on("click", function () {

        /**marcar el usuario selecciona**/
        $(".sideBar-body").removeClass("seleccionado");
        $(this).addClass("seleccionado");

        var id = $(this).attr('id');
        var idConectado = "<?php echo $idConectado; ?>";
        var email_user = "<?php echo $email_user; ?>";
        var dataString = 'id=' + id + '&idConectado=' + idConectado + '&email_user=' + email_user;

        var ruta = "UserSeleccionado.php";
        $('#capausermsj').html('<img src="assets/img/cargando.gif" class="ImgCargando"/>');
        $.ajax({
          url: ruta,
          type: "POST",
          data: dataString,
          success: function (data) {
            $("#capausermsj").html(data);
            $("#conversation").animate({
              scrollTop: $(document).height()
            }, 1000);
          }
        });
        return false;
      });
    });


    $(function () {
      $(".heading-compose").click(function () {
        $(".side-two").css({
          "left": "0"
        });
      });

      $(".newMessage-back").click(function () {
        $(".side-two").css({
          "left": "-100%"
        });
      });
    });
  </script>

<?php  ?>