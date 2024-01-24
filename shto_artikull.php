<?php

session_start();

if(!isset($_SESSION['admin_name'])){
    header('location: login_form.php');
    exit();
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    $title = $_POST['title'];
    $content=$_POST['content'];
    $category=$_POST['category'];


    $uploadDir = 'uploads';
    $uploadFile = $uploadDir.basename($_FILES['image']['name']);

    if(move_uploaded_file($_FILES['image']['tmp_name'],$uploadFile)){
        $sql="INSERT INTO Artikulli(Titulli,Permbajtja,Kategoria,Foto) VALUES('$title','$content','$category','$_FILES['images']['name']')";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("ssss",$title,$content,$category,$_FILES['images']['name']);

        if($stmt->execute()){
            header('location: admin.php');
            exit();
        }else{
            echo "Error: ".$stmt->error;
        }
        $stmt->close();
    }else{
        echo "Gabim ne ngarkim te fotos";
    }
    $conn->close();
}

?>