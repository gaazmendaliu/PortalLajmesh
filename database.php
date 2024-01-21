<?php

    $hostname="localhost";
    $dbUser="root";
    $dbPassword="";
    $dbName="LoginRegForm";

   $conn = mysqli_connect($hostName,$dbUser,$dbPassword,$dbName);

   if(!$conn){
    die("Dicka nuk shkoi mire");
   }
?>