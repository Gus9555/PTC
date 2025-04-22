<?php
function getConnection() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $dsn = "pgsql:host=localhost;port=5432;dbname=lifeline;user=castillo;password=kNHq5pJ@";
            $pdo = new PDO($dsn);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            exit();
        }
    }
    return $pdo;
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

?>
