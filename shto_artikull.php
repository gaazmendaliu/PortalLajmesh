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
        $stmt->bind_param("ssss",$title,$content,$category,$_FILES['image']['name']);

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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shto artikuj</title>
    <style>
    body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #000;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            position: relative;
        }

        label {

            display: block;
            margin-bottom: 8px;
        }

        input,
        textarea {
            width: 100%;
            max-width: 100%;
            min-width: 600px;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="file"]{
            cursor: pointer;
        }

        input[type="submit"],
        a.edit-button ,
        input.delete-button {
            background-color: black;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px;
            cursor: pointer;
            display: inline-block;
            width: calc(50% - 5px);
            box-sizing: border-box;
            margin-right: 5px;
        
        }

    
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
         table, th, td {
            border: 1px solid #ddd;
         }

         th, td {
            padding: 10px;
            text-align: left;
         }
    </style>     
</head>
<body>
    <form action="shto_artikull.php" method ="post" enctype="multipart/form-data">
        <label for ="title">Titulli</label>
        <input type="text" id="title" name="title" required><br>

        <label for="image">Ngarko foton</label>
        <input type="file" id="image" name="image" accept="image/*"><br>

        <label for="content">Permbajtja:</label>
        <textarea id="content" name="content" required></textarea><br>

        <label for="category">Kategoria</label>
        <input type="text" id="category" name="category" required><br>

        <input type="submit" value = "Shto">
    </form> 
</body>
</html>