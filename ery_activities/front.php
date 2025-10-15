<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0" align="center">Payroll Calculator</h4>
        </div>
        <div class="card-body">
            <form action="back.php" method="POST">
                <!-- Full Name -->
                <div class="mb-3">
                    <label for="fullname" class="form-label">Employee Name</label>
                    <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Enter your full name" required>
                </div>

                <!-- DAYS  OF  WORK -->
                <div class="mb-3">
                    <label for="days_of_work" class="form-label">Total Days of Work</label>
                    <input type="number" name="days_of_work" id="days_of_work" class="form-control" placeholder="Enter total days of work" required>
                </div>

                <!-- DAILY RATE -->
                <div class="mb-3">
                    <label for="daily_rate" class="form-label">Daily Rate</label>
                    <input type="number" name="daily_rate" id="daily_rate" class="form-control" placeholder="Enter daily rate" required>
                </div>

                <!-- Cash Advance -->
                <div class="mb-3">
                    <label for="cash_advance" class="form-label">Cash Advance</label>
                    <input type="number" name="cash_advance" id="cash_advance" class="form-control" placeholder="Enter cash advance" required>
                </div>

                <!-- Submit Button -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary w-100"><strong>Generate Payslip</strong></button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>