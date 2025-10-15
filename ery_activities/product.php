<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Select Your Favorite Subject</h2>
    <form action="" method="post">
        <input type="checkbox" name="items[]" id="" value="50">Notebook (P50.00)<br>
        <input type="checkbox" name="items[]" id="" value="30">Pencil (P30.00)<br>
        <input type="checkbox" name="items[]" id="" value="100">Bag (P100.00)<br>
        <input type="checkbox" name="items[]" id="" value="75">Shoes (P75.00)<br>
        <input type="checkbox" name="items[]" id="" value="25">Eraser (P25.00)<br><br>
        <input type="submit" value="Submit" name="submit">
    </form>

    <?php 
        if (isset($_POST['submit'])){
            if (!empty($_POST['items'])){
                $total = 0;
                foreach($_POST['items'] as $price){
                    echo " $price<br>";
                }
            }
        }
        else{
            echo "<p>Please select at least one product.</p>";
        }
    
    ?>
</body>
</html>
