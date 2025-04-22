<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Your Plan</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext"
        rel="stylesheet">
    <link href="../../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../../assets/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../../assets/boss/css/styles.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Select Your Plan</h1>
                <form id="selectPlanForm" action="datospago.php" method="POST">
                    <div class="form-group">
                        <label for="plan">Plan:</label>
                        <input type="text" class="form-control" id="plan" name="plan" value="Publicity Plan" readonly>
                    </div>
                    <div class="form-group">
                        <label for="precio">Price:</label>
                        <input type="text" class="form-control" id="precio" name="precio" value="$50.00" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Proceed to Payment</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
