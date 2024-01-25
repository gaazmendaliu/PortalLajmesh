<?php

include 'database.php';
session_start();

if(!isset($_SESSION['admin_name'])){
    header('location: login_form.php');
    exit();
}

if(isset($_GET['ID'])){
    $artikulliID = $_GET['ID'];

    $sql="Delete FROM Artikulli where ID = '$artikulliID'";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("i",$artikulliID);

    if($stmt->execute()){
        header('location: admin.php');
        exit();
    }else{
>        echo "Error ".$stmt->error;
    }

    $stmt->close();
}else{
    header('location: admin.php');
    exit;
}
?>
