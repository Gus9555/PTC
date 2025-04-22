
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $purchase_id = $_POST['compra_id'];
    $new_plan = $_POST['plan'];

    // Establish database connection
    $pdo = getConnection();

    // Get the current insurance details to fetch the correct price, purchase date, and last plan update date
    $stmtPurchase = $pdo->prepare('SELECT seguro, correo, nombre, fecha_compra, last_plan_update FROM compras WHERE id_c = :id_c');
    $stmtPurchase->execute([':id_c' => $purchase_id]);
    $purchase = $stmtPurchase->fetch(PDO::FETCH_ASSOC);

    if ($purchase) {
        $insurance = $purchase['seguro'];
        $email = $purchase['correo']; // Get the user's email
        $name = $purchase['nombre']; // Get the user's name
        $purchase_date = $purchase['fecha_compra']; // Get the purchase date
        $last_update_date = $purchase['last_plan_update']; // Get the last plan update date

        // Check if 24 hours have passed since the purchase date
        $current_time = new DateTime(); // Current time
        $purchase_time = new DateTime($purchase_date); // Purchase time
        $time_since_purchase = $current_time->diff($purchase_time);

        if ($time_since_purchase->h < 24 && $time_since_purchase->d == 0) {
            // Show an alert if 24 hours have not passed
            echo "<script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Recent Purchase',
                    text: 'Your purchase was made less than 24 hours ago. Please wait 24 hours before changing your plan.',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../user/view_user.php';
                    }
                });
            </script>";
            exit();
        }

        // Check if 30 days have passed since the last plan update
        if ($last_update_date) { // Only check if the last_update_date exists
            $last_update_time = new DateTime($last_update_date); // Last plan update time
            $time_since_last_update = $current_time->diff($last_update_time);

            if ($time_since_last_update->days < 30) {
                // Show an alert if 30 days have not passed since the last update
                echo "<script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Plan Update Too Soon',
                        text: 'You have updated your plan recently. Please wait 30 days before changing your plan again.',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../user/view_user.php';
                        }
                    });
                </script>";
                exit();
            }
        }

        // Get the price of the new plan from the 'seguros' table
        $stmtPrice = $pdo->prepare('SELECT precio FROM seguros WHERE seguro = :seguro AND calidad = :calidad');
        $stmtPrice->execute([
            ':seguro' => $insurance,
            ':calidad' => $new_plan
        ]);
        $insuranceData = $stmtPrice->fetch(PDO::FETCH_ASSOC);

        if ($insuranceData) {
            $new_price = $insuranceData['precio'];

            // Update the 'compras' table with the new plan, price, and current date as the last update date
            $stmtUpdate = $pdo->prepare('UPDATE compras SET calidad = :calidad, precio = :precio, last_plan_update = NOW() WHERE id_c = :id_c');
            $stmtUpdate->execute([
                ':calidad' => $new_plan,
                ':precio' => $new_price,
                ':id_c' => $purchase_id
            ]);

            // Prepare email details
            $subject = "Insurance Plan Change";
            $body = "Dear $name,<br><br>Your insurance plan has been successfully changed to: $new_plan.<br>The new plan's charge will be applied in your next monthly payment.<br><br>Thank you for trusting our services.<br><br>Best regards,<br>LifeLine";

            // Send the email using the enviarEmail() function
            if (enviarEmail($email, $name, $subject, $body)) {
                // Show alert and redirect with SweetAlert
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Plan Updated',
                        text: 'The plan change has been successfully processed. Please check your email for more details.',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../user/view_user.php';
                        }
                    });
                </script>";
            } else {
                // Show alert of error in sending email
                echo "<script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Plan Updated',
                        text: 'The plan change has been processed, but there was an issue sending the email. Please check your account manually.',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../user/view_user.php';
                        }
                    });
                </script>";
            }
            exit();
        } else {
            // Error handling if the price is not found
            header('Location: ../user/view_user.php?error=price_not_found');
            exit();
        }
    } else {
        // Error handling if the purchase is not found
        header('Location: ../user/view_user.php?error=purchase_not_found');
        exit();
    }
}
