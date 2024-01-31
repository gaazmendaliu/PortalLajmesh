<?php
@include 'database.php';

if($_SERVER["REQUEST_METHOD"]==="POST"){
    if(isset($_POST["addQuote"])){
        $newQuote = $_POST["newQuote"];
        $sql = "INSERT INTO Slider(Thenja) VALUES ('$newQuote')";
        $conn->query($sql);
    }
    elseif(isset($_POST["addBook"])){
        $newImage = $_FILES["newImage"]["name"];
        $newText=$_POST["newText"];
        $sql="INSERT INTO Slider (Kopertina,TitulliAutori) values ('$newImage','$newText')";
        $conn->query($sql);
    }
}


$existingQuotes=[];
$sql = "SELECT ID, Thenja from Slider";
$result=$conn ->query($sql);
if($result->num_rows>0){
    while($row = $result->fetch_assoc() ){
        $existingQuotes[]=$row;
    }
}

$existingBooks=[];
$sql = "SELECT ID, Kopertina, TitulliAutori from Slider";
$result=$conn ->query($sql);
if($result->num_rows>0){
    while($row = $result->fetch_assoc() ){
        $existingBooks[]=$row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Slider</title>
    <link rel="stylesheet" type="text/css" href="edit_slider.css">
</head>
<body>
    
    <h2>Shto Thënje</h2>
    <form method="post" action="" enctype="multipart/form-data">
        <label for="newQuote">Thenja e re:</label>
        <input type="text" name="newQuote" required>
        <button type="submit" name="addQuote">Shto</button>
    </form> 

    <h2>Shto libra</h2>
    <form method="post" action="" enctype="multipart/form-data">
        <label for="newImage">Kopertina e re</label>
        <input type="file" name="newImage" required>
        <label for="text" name="newText">Titulli dhe autori</label>
        <input type="text" name="newText" required>
        <button type="submit" name="addBook">Shto</button>
    </form> 

</body>
</html>