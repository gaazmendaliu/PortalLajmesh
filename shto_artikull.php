<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

@include 'database.php';



if($_SERVER['REQUEST_METHOD']==='POST'){
    $title = $_POST['title'];
    $content=$_POST['content'];
    $category=$_POST['category'];


    $uploadDir = 'uploads/';
    if (!file_exists($uploadDir) && !is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    $uploadFile = $uploadDir . basename($_FILES['image']['name']);

    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        echo "Gabim ne ngarkim te fotos. Error code: " . $_FILES['image']['error'];
        exit();
    }

    if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        $sql= "INSERT INTO Artikulli(Titulli, Permbajtja ,Kategoria ,Foto) VALUES(?, ?, ?, ?)";
        $stmt= $conn->prepare($sql);
        $stmt->bind_param("ssss",$title,$content,$category,$_FILES['images']['name']);

        if($stmt->execute()){
            header('location: admin.php');
            exit();
        }else{
            echo "Error: ".$stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
}

?>