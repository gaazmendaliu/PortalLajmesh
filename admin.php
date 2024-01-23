<?php

@include 'database.php';

session_start();

if(!isset[$_SESSION['admin_name']]){
    header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    
</body>
</html>