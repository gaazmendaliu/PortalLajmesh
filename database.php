<?php

    $hostName="localhost";
    $dbUser="root";
    $dbName="LoginRegForm";

   $conn = mysqli_connect($hostName,$dbUser,'',$dbName);

   if(!$conn){
    die("Dicka nuk shkoi mire" . mysqli_connect_error());
   }
?>
