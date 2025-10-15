<?php
    $n1 = $_POST["num1"];
    $n2 = $_POST["num2"];
    $n3 = $_POST["num3"];
    $n4 = $_POST["num4"];

    $sum = $n1 + $n2;
    $diff = $n4 - $n3;
    $prod = $n1 * $n3;
    $quot = $n2 / $n3;

    $average = ($n1 + $n2 + $n3 + $n4) / 4;

    echo "The sum of $n1 and $n2 is: $sum <br><br>";
    echo "The difference of $n4 and $n3 is: $diff <br><br>";
    echo "The product of $n1 and $n3 is: $prod <br><br>";
    echo "The quotient of $n2 and $n3 is: $quot <br><br>";
    echo "The average of all numbers is: $average <br><br>";
?>