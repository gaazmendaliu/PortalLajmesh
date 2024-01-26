<?php
include 'database.php';


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['article_id'])){
        $article_id = $_POST['article_id'];

        $sql = " DELETE FROM Artikulli WHERE ID = $article_id";
        if ($conn->query($sql) === TRUE) {
            echo "Artikulli u fshi me sukses.";
        } else {
            echo "Error: " .$sql . "<br>" . $conn->error;
        }

        header("Location: admin.php");
        exit();
    }
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fshi Artikull</title>


    <style>

   
    

    
    </style>
</head>
<body>
    
</body>
</html>
