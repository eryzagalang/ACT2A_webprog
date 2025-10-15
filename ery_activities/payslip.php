<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    
    
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Employee Payslip</h4>
        </div>
        <div class="card-body">
                <p class="lead">Here are the details you submitted:</p>
                <?php
                    if ($_SERVER ['REQUEST_METHOD'] == "POST"){
                    $name = htmlspecialchars($_POST['fullname']);
                    $day = htmlspecialchars($_POST['workday']);
                    $rate = htmlspecialchars($_POST['rate']);
                    $cash = htmlspecialchars($_POST['cash']);   
            
                    $prod = $day * $rate;
                    $tax = $prod * 0.02;
                    $sss = $prod * 0.015;
                    $pb = 50.00;
                    $total_deduc = $tax + $sss + $pb + $cash;
                    $netpay = $prod - $total_deduc;
                    } 
                    else {
                    echo "<div class='alert alert-danger'>No Data Received. </div>";
                    exit();
                    }
                ?>

                <ul class="list-group">
                    <li class="list-group-item"><strong>Employee name:</strong> <?= $name ?> </li>
                    <li class="list-group-item"><strong>Total Days Worked:</strong> <?= $day ?> </li>
                    <li class="list-group-item"><strong>Daily Rate:</strong> <?php echo "₱" . number_format ($rate, 2); ?> </li>
                    <hr>
                    <li class="list-group-item"><strong>Gross Pay:</strong>  <?php echo "₱" . number_format ($prod, 2); ?></li>
                    <li class="list-group-item"><strong>Tax (2%):</strong>  <?php echo "₱" . number_format ($tax, 2); ?> </li>
                    <li class="list-group-item"><strong>SSS (15%):</strong> <?php echo "₱" . number_format ($sss, 2); ?> </li>
                    <li class="list-group-item"><strong>Pag-IBIG:</strong> <?php echo "₱" . number_format ($pb, 2); ?> </li>
                    <li class="list-group-item"><strong>Cash Advance:</strong> <?php echo "₱" . number_format ($cash, 2); ?></li>
                    <hr>
                    <li class="list-group-item"><strong>Total Deductions:</strong> <?php echo "₱" . number_format ($total_deduc, 2); ?> </li>
                    <li class="list-group-item" style ="color:green; font-size: 1.2em;" ><strong>Net Pay:</strong> <?php echo "₱" . number_format ($netpay, 2); ?> </li>
                </ul>
 
                
                <div class="mt-4">
                    <a href="payroll.php" class="btn btn-primary">Back</a>
                </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
