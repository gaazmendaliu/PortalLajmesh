<?php
@include 'database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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

         .artikull-container{
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
         }

        .artikull-container h2 {
            font-size: 1.2em;
            text-align: center;
            margin-bottom: 10px;
        }

        .artikull-container img {
            max-width: 100%;
            height: auto;
            margin: 0 auto;
            margin-bottom: 10px;
            max-height: 150px;
        }

        .artikull-container p {
            line-height: 1.4;
            text-align: center;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .button-container a.edit-button,
        .button-container form.delete-button input.delete-button {
            background-color: black;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            width: calc(50% - 5px);
            box-sizing:border-box;
            margin-right: 5px;
        }
     
    </style>

</head>

<body>

    <div class="shtoartikuj">
        <button class="shto-artikuj" onclick="location.href ='shto_artikuj.php'" >Shto Artikuj</button>
    </div>

    <div class="editslider">
        <button class="edit-slider" onclick="location.href ='edit_slider.php'" >Kyçu / Regjistrohu </button>
    </div>



    <?php
        
        require_once 'database.php';
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
