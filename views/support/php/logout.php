<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $logout_id = $_GET['logout_id'];
    
    if (isset($logout_id)) {
        try {
            $pdo = getConnection();
            $status = "Offline now";
            $sql = "UPDATE users SET estatus = :status WHERE unique_id = :logout_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':logout_id', $logout_id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                session_unset();
                session_destroy();
                header("Location: ../../../views/user/login.php");
                exit;
            }
        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
            exit;
        }
    } else {
        header("Location: ../users.php");
        exit;
    }
} else {  
    header("Location: ../../../views/user/login.php");
    exit;
}
?>
