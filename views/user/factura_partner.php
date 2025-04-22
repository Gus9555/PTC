<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partner Purchase Form</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <form id="purchaseForm" method="POST">
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required><br><br>

        <label for="gmail">Email:</label>
        <input type="email" id="gmail" name="gmail" required><br><br>

        <label for="telefono">Phone Number:</label>
        <input type="text" id="telefono" name="telefono" required><br><br>

        <input type="submit" value="Submit">
    </form>

    <script>
        function validateForm() {
            const fullname = document.getElementById('fullname').value.trim();
            const gmail = document.getElementById('gmail').value.trim();
            const telefono = document.getElementById('telefono').value.trim();

            if (fullname === "" || gmail === "" || telefono === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'All fields are required!'
                });
                return false;
            }

            return true;
        }

        $(document).ready(function() {
            $('#purchaseForm').on('submit', function(event) {
                event.preventDefault(); // Evita el envío del formulario estándar

                if (validateForm()) {
                    $.ajax({
                        url: 'process_purchase_partner.php',
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Form Submitted',
                                text: 'Your purchase information has been submitted successfully!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            // Puedes manejar cualquier respuesta adicional aquí
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'There was a problem submitting your information. Please try again.'
                            });
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
