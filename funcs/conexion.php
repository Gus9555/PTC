<?php
function getConnection() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $dsn = "pgsql:host=localhost;port=5432;dbname=lifeline;user=castillo;password=kNHq5pJ@";
            $pdo = new PDO($dsn);

            // Establecer el modo de error de PDO para lanzar excepciones
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            exit();
        }
    }
    return $pdo;
}
?>