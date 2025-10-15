<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Bootstrap demo</title>
  </head>
  <body>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-4"> <!-- Small width -->
        <div class="card shadow-sm rounded-4">
          <div class="card-header bg-primary text-white text-center">
            <h5>Enter Two Numbers</h5>
          </div>
          <div class="card-body">
            <form method="get" action="process.php">
              <div class="mb-3">
                <label for="firstNumber" class="form-label">First Number</label>
                <input type="number" class="form-control" id="firstNumber" placeholder="First number" name="num1">
              </div>

              <div class="mb-3">
                <label for="secondNumber" class="form-label">Second Number</label>
                <input type="number" class="form-control" id="secondNumber" placeholder="Second number" name="num2">
              </div>

              <button type="submit" class="btn btn-success w-100">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<script src="js/bootstrap.js"></script>
  </body>
</html>