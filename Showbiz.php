<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showbiz</title>

    <style>
        h1{
            border-bottom: 3px solid black;
            padding-bottom: 5px;
            cursor: pointer;
        }

        body{
            font-family:'Times New Roman',Times,serif;
            display: flex;
            flex-direction:column;
            overflow-x:hidden;
        }

        main{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
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

    </style>
</head>

<body>

<h1 onclick="goToMainPage()">Showbiz</h1>

<?php
    
    require_once 'database.php';
        $sql = "SELECT * FROM Artikulli where Kategoria='Showbiz'";
        $result = $conn->query($sql);

        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                echo '<div class="artikull-container">';
                echo "<h2>".$row['Titulli']."</h2>";
                echo "<img src='uploads/".$row['Foto']."'alt='Imazhi i artikullit'>";
                echo "<p>".$row['Permbajtja']."</p>";
                echo "<p>Kategoria: ".$row['Kategoria']."</p>";
                echo "</div>";
            }
        }else{
            echo "Nuk ka artikuj";
        }        
        $conn->close();
?>

<script>
    function showContent(category){
        console.log(`show content for ${category}`)
    }
    
    function goToMainPage(){

    console.log("Navigating to the main page");
    window.location.href = 'index.php';
}

</script>
    
</body>
</html>