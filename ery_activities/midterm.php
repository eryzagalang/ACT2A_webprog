
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Activity - Product Purchase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="mb-4 text-center">🛒 Product Purchase</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">Customer Name</label>
                <input type="text" class="form-control" name="name" required value="">
            </div>
            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input type="number" class="form-control" name="quantity" required min="1" value="">
            </div>
            <div class="mb-3">
                <label class="form-label">Price per Item</label>
                <input type="number" class="form-control" name="price" required min="1" value="">
            </div>

            <div class="mb-3">
                <label class="form-label">Optional Add-ons</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="addons[]" value="Gift Wrap"
                        >
                    <label class="form-check-label">Gift Wrap (+₱50)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="addons[]" value="Express Shipping"
                        >
                    <label class="form-check-label">Express Shipping (+₱100)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="addons[]" value="Warranty"
                        >
                    <label class="form-check-label">Warranty (+₱200)</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Compute Total</button>
        </form>

        <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                $name = $_POST['name'];
                $quan = intval ($_POST['quantity']);
                $price = floatval ($_POST['price']);
                $add = $_POST['addons[]'] ? $_POST['addons'] : [];
                $add = 0;

                foreach($add as $addon){
                    switch($addon){
                        case "Gift Wrap":
                            $addon_cost += 50;
                            break;
                        case "Express Shipping":
                            $addon_cost += 100;
                            break;
                        case "Warranty":
                            $addon_cost += 200;
                            break;        
                    }
                }

                    $tot = $quan * $price;
                    $tal = $price + $addon;         
                }
                else{
                    $addon_cost = 0;
            }       
        ?>
        <div class="alert alert-success mt-4">
            <h4>💡 Purchase Summary</h4>
            <p><strong>Name:</strong> <?php $name; ?></p>
            <p><strong>Quantity:</strong> <?php  $quan; ?></p>
            <p><strong>Price per Item:</strong> <?php $quan; ?></p>
            <p><strong>Subtotal:</strong><?php $tot; ?></p>
            <p><strong>Add-ons:</strong> <?php  $addon; ?></p>
            <h5><strong>Final Total:</strong> <?php $tal; ?></h5>
        </div>       
    </div>
</div>


</body>
</html>
    

       