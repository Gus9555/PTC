<?php 
session_start();
if(isset($_SESSION['unique_id'])){
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = $_POST['incoming_id'];

    $pdo = getConnection();
    $output = "";

    $sql = "SELECT * FROM messages 
            LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
            WHERE (outgoing_msg_id = :outgoing_id AND incoming_msg_id = :incoming_id)
            OR (outgoing_msg_id = :incoming_id AND incoming_msg_id = :outgoing_id) 
            ORDER BY msg_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
    $stmt->bindParam(':incoming_id', $incoming_id, PDO::PARAM_INT);
    $stmt->execute();

    if($stmt->rowCount() > 0){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            if($row['outgoing_msg_id'] === $outgoing_id){
                $output .= '<div class="chat outgoing">
                              <div class="details">
                                <p>'. htmlspecialchars($row['msg']) .'</p>
                              </div>
                            </div>';
            }else{
                $userTypeImage = $row['id_tipo'] == 2 ? "php/images/OIP_2.jpeg" : "php/images/support.png";
                $output .= '<div class="chat incoming">
                              <img src="' . $userTypeImage . '" alt="">
                              <div class="details">
                                <p>'. htmlspecialchars($row['msg']) .'</p>
                              </div>
                            </div>';
            }
        }
    } else {
        $output .= '<div class="text">No messages are available. Once you send a message, they will appear here.</div>';
    }
    echo $output;
} else {
    header("location: ../login.php");
}
?>
