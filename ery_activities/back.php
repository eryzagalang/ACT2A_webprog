<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> .list-group-item { border: none !important; } </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0" align="center">Employee Payslip</h4>
        </div>
        <div class="card-body">

        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST")
            {
                $fullname = $_POST["fullname"];
                $days_of_work = $_POST["days_of_work"];
                $daily_rate = $_POST["daily_rate"];
                $cash_advance = $_POST["cash_advance"];
                $net_pay = ($daily_rate * $days_of_work) - $cash_advance;
                $grossPay = $days_of_work * $daily_rate;
                $tax = $grossPay * 0.02;
                $SSS = $grossPay * 0.015;
                $pagibig = 50;
                $total_deduction = $tax + $SSS + $pagibig + $cash_advance;
                $netPay = $grossPay - $total_deduction;
            }
        else {
            echo "<div class='alert alert-danger'>No Data Received.</div>";
            exit;
        }
        ?>
            <ul class="list-group">
                <li class="list-group-item"><strong>Employee Name: </strong><?=$fullname; ?></li>
                <li class="list-group-item"><strong>Total Days Worked:</strong> <?=$days_of_work; ?></li>
                <li class="list-group-item"><strong>Daily Rate: </strong>₱<?=number_format($daily_rate, 2); ?></li>
                <hr>
                <li class="list-group-item"><strong>Gross Pay:</strong> ₱<?=number_format($grossPay, 2);?> </li>
                <li class="list-group-item"><strong>Tax (2%):</strong> ₱<?=number_format($tax, 2);?> </li>
                <li class="list-group-item"><strong>SSS (1.5%):</strong> ₱<?=number_format($SSS, 2);?> </li>
                <li class="list-group-item"><strong>Pag-IBIG:</strong> ₱<?=number_format($pagibig, 2);?> </li>
                <li class="list-group-item"><strong>Cash Advance: </strong>₱<?=number_format($cash_advance, 2); ?></li>
                <hr>
                <li class="list-group-item"><strong>Total Deductions:</strong> ₱<?=number_format($total_deduction, 2);?> </li>
                <li class="list-group-item list-group-item-success text-success"><strong>Net Pay: ₱<?=number_format($netPay, 2);?></strong></li>
            </ul>
            <hr>
            <div class="mt-4 text-center">
                <a href="front.php" class="btn btn-primary bg-secondary border-0">Back</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>