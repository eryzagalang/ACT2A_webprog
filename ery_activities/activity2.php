<?php
$item = "Ballpen";
$quantity = 10;
$PricePerItem = 20;
$discountt = 0.10;
$AmountPaid = 300;

$total = $quantity * $PricePerItem;
$discount = $total * $discountt;
$final_amount = $total - $discount;
$change = $AmountPaid - $final_amount;

echo "<center>
▄▀█ █▀▀ ▀█▀ █ █░█ █ ▀█▀ █▄█<br>
█▀█ █▄▄ ░█░ █ ▀▄▀ █ ░█░ ░█░<br>__________________________________________<br>
</center>";

echo "                                                                                                                    __________________________________________<br>";
echo "                                                                                                                           <b>                 Purchase Summary</b><br><br>";
echo "                                                                                                                    =======================================<br>";
echo "                                                                                                                           Item:                                          <b>$item</b><br>";
echo "                                                                                                                           Quantity:                                    <b>$quantity</b><br>";
echo "                                                                                                                           Price per item:                            <b>₱$PricePerItem</b><br>";
echo "                                                                                                                           Total before discount:                <b>₱$total</b><br>";
echo "                                                                                                                           Discount (10%):                         <b>₱$discount</b><br>";
echo "                                                                                                                           Total after discount:                   <b>₱$final_amount</b><br>";
echo "                                                                                                                           Amount paid:                             <b>₱$AmountPaid</b><br>";
echo "                                                                                                                           Change:                                      <b>₱$change</b><br>";
?></center>