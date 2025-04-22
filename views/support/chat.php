<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
    exit;
}
?>
<?php include_once "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php
        try {
            $pdo = getConnection();  // Usando la función desde config.php
            $user_id = $_GET['user_id'];
            $sql = "SELECT * FROM users WHERE unique_id = :user_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $imagen_predeterminada = ($row['id_tipo'] == 2) ? "php/images/OIP_2.jpeg" : "php/images/support.png";
            } else {
                header("location: users.php");
                exit;
            }
        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
            exit;
        }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="<?php echo $imagen_predeterminada; ?>" alt="">
        <div class="details">
          <span><?php $nombre = decryptPayload($row['nombre']);
          echo htmlspecialchars($nombre) . " " ?></span>
          <p><?php echo htmlspecialchars($row['estatus']); ?></p>
        </div>
        <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 3): ?>
          <button type="button" id="end-chat-button" class="end-chat-btn">End Chat</button>
        <?php endif; ?>
      </header>
      <div class="chat-box">
        
      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        let incoming_id = document.querySelector('.incoming_id').value;
        let user_type = "<?php echo $_SESSION['tipo_usuario']; ?>";
        
        if (user_type == 2) {
            sendDefaultMessage(incoming_id);
        }

        document.getElementById('end-chat-button')?.addEventListener('click', function () {
            let incoming_id = document.querySelector('.incoming_id').value;
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "php/end_chat.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText); // Muestra el mensaje de éxito o error
                    window.location.href = "users.php"; // Redirecciona a la página de usuarios
                }
            };
            xhr.send("incoming_id=" + incoming_id);
        });

        function sendDefaultMessage(incoming_id) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "php/check_default_message.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText); // Depuración
                    }
                }
            }
            xhr.send("incoming_id=" + incoming_id);
        }
    });
  </script>
</body>

</html>
