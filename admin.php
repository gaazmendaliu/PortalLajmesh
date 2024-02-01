<?php
require_once 'database.php';
include 'header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>


    <div class="admin-title">
        <h1>Kronikë04 Admin Page</h1>
    </div>

    <div class="button-container">
        <button class="shto-artikuj" onclick="location.href ='shto_artikull.php'" >Shto Artikuj</button>
        <button class="edit-slider" onclick="location.href ='edit_slider.php'" >Shto slider </button>
    </div>



    <?php
        
        $sql = "SELECT * FROM Artikulli";
        $result = $conn->query($sql);

        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                echo '<div class="artikull-container">';
                echo "<h2>".$row['Titulli']."</h2>";
                echo "<img src='uploads/".$row['Foto']."'alt='Imazhi i artikullit'>";
                echo "<p>".$row['Permbajtja']."</p>";
                echo "<p>Kategoria: ".$row['Kategoria']."</p>";

                echo "<div class='button-container'>";
                echo "<a class='edit-button' href='edit.php?article_id=".$row['ID']." '>Ndrysho</a>";

                echo "<form action='fshi_artikull.php' method='post'>";
                echo "<input type='hidden' name='article_id' value = '".$row['ID']."'>";
                echo "<input type='submit' class='delete-button' value='Fshi'>";
                echo"</form>";
               
                echo "</div>";

                echo  "</div>" ;
        }
    }else{
        echo "Nuk ka artikuj";
    }
    $conn->close();
        
        ?>
         
    
</body>
</html>
