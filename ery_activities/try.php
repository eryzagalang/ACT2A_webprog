<?php

$age = 21;
$gender = "Female";

if ($gender == "Female"){
    if($age >= 18){
        echo "You are a Female Debutant!";
    }
    else{
        echo "You are not Debutant!";
    }
}
elseif ($gender == "Male"){
    if($age >= 21){
        echo "You are a Male Debutant!";
    }
    else{
        echo "You are not Debutant!";
    }
}
else{
    echo "Error";
}

?>