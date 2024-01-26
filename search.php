<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
   .artikull-container{
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            text-align: center;

        }

        .artikull-container h2{
            font-size: 1.2em;
            text-align: center;
            margin-bottom: 10px;

        }

        .artikull-container img{
            max-width: 100%;
            height: auto;
            margin: 0 auto;
            margin-bottom: 10px;
            max-height: 150px;

        }

        .artikull-container p{
            line-height: 1.4;
            text-align: center:

        }

</style>
</head>
<body>
    
<?php

@include 'database.php';

if(isset($_GET['search'])){
    $searchTerm=$_GET['search'];
    $searchTerm= mysqli_real_escapr_string($conn, $searchTerm);

    $sql="SELECT * FROM Artikulli WHERE Titulli like '%$searchTerm%' or Permbajtja like '%$searchTerm%' or Kategoria like '%$searchTerm%'";
    $result=$conn -> query($sql);

    if($result->num_rows >0){
        while($row->fetch_assoc()){
            echo '<div class="artikull-container">';
            echo "<h2>".$row['Titulli']."</h2>";
            echo "<img src='uploads/".$row['Foto']."'alt='Imazhi i artikullit'>";
            echo "<p>".$row['Permbajtja']."</p>";
            echo "<p>Kategoria: ".$row['Kategoria']."</p>";
            echo "</div>";
        }
    }else{
        echo "Nuk ka rezultate per kerkimin tuaj";
    }
}else{
    echo "Kerkese invalide";
}
$conn->close();
?>

</body>
</html>