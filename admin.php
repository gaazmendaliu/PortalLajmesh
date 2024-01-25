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

        input[type="submit"]{
            background-color: black;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px;
            cursor: pointer;
        }

        a {
            color: black;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
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
         .article-display{


        }

        .article-display h2{


        }

        .article-display p{


        }

        .article-display img{


        }

        .article-display hr{

    
        }
        .delete-form{

            
        }
        .delete-button{


        }
        .delete-button:hover{


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


    <div class="article-display">
        <h2> Artikujt e fundit</h2>
        <?php
        
        require_once 'database.php';
        $sql = "SELECT * FROM Artikulli";
        $result = $conn->query($sql);

        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                echo "<h2>".$row['Titulli']."</h2>";
                echo "<p>".$row['Permbajtja']."</p>";
                echo "<p>Kategoria: ".$row['Kategoria']."</p>";
                echo "<img src='uploads/".$row['Foto']."'alt='Imazhi i artikullit'>";

                echo "<form action='fshi_artikull.php' method='post'>";
                echo "<input type='hidden' name='article_id' value = '".$row['ID']."'>";
                echo "input type='submit' class'delete-button' value='Fshi'>";
                echo"</form>";

                echo "<hr>";
        }
    }else{
        echo "Nuk ka artikuj";
    }
    $conn->close();
        
        ?>
       </div>    
    
</body>
</html>
