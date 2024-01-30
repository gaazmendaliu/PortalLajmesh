<?php

@include 'database.php';

$quoteArray = array();
$sql="SELECT Thenja from Slider";
$result = $conn->query($sql);

if($result->num_rows>0){
    while($row = $result->fetch_assoc()){
        $quoteArray[]=$row["Thenja"];
    }
}

$imgArray = array();
$textArray = array();
$sql = "SELECT Kopertina, TitulliAutori FROM Slider";
$result = $conn->query($sql);

if($result->num_rows>0){
    while($row = $result->fetch_assoc()){
        $imgArray[] = $row["Kopertina"];
        $textArray[] = $row["TitulliAutori"];
    }
}

$conn -> close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slider</title>
</head>
<style>

    body {
        background-color: #ffffff;
        font-family: 'Times New Roman', Times, serif;
        margin: 0;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #ThënjeSection , 
    #Content{
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 500px;
        border: 2px solid black;
        padding:10px;
        margin-top: 20px; 
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        max-width: 500px;
        border: 2px solid  #000000;
        padding: 20px;
        margin-top: 20px;
        background-color: #ffffff;
    }

    #ThënjeSection,
    #Content {
        margin-top: 20px;
    }


    #quotes{
        text-align: center;
        margin-top: 10px;  
    }

    #quoteControls, 
    #bookControls {
        display: flex;
        justify-content:space-between;
        align-items: center;
        width: 100%;
        margin-top: 10px;
    }

    button {
        background-color: transparent;
        border: none;
        padding: 0;
        cursor: pointer;
        font-size: 24px;
        color: #000000;
    }
    
    #Kontenti1{
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        max-width: 500px;
        border: 2px solid #000000;
        padding:20px;
        margin-top: 20px;
        background-color: #ffffff;
   }

   #Kontenti1 img{
    width: 100%;
    max-width: 250px;
    height: auto;
    margin-top: 10px;
   }

   #textbox{
        text-align: center;
        margin-top: 10px;
   }

   @media screen and (max-width: 600px){
    #ThënjeSection, #Content {
        width: 90%;
    }
   }

</style>
<body>

    <div class="container" id="ThënjeSection">
        <h1>Thënjet e ditës</h1>
        <div id="quotes"></div>
        <div id="quoteControls">
            <button onclick="prevQuote()">&#60;</button>
            <button onclick="nextQuote()">&#62;</button>
        </div>
    </div>

    <div class="container" id="content">
        <header>
            <h2>Rekomandime për libra</h2>
            <img id="slideshow" />
            <div id="textbox"></div>
        </header>

        <div id="bookControls">
            <button onclick="prevBook()">&#60;</button>
            <button onclick="nextBook()">&#62;</button>
        </div>
    </div>
   
    <script>
        let quoteArray = <?php echo json_encode($quoteArray); ?>;
        let imgArray = <?php echo json_encode($imgArray);?>;
        let textArray = <?php echo json_encode($textArray);?>;

        let quoteIndex = 0;
        let bookIndex =0;

        function changeQuote() {
            if(quoteArray.length >0){
            document.getElementById('quotes').innerText = quoteArray[quoteIndex];
        }
    }

        function nextQuote() {
            if(quoteArray.length>0){
            quoteIndex = (quoteIndex + 1) % quoteArray.length;
            changeQuote();
            }
        }
        
        function prevQuote() {
            if(quoteArray.length >0){
            quoteIndex = (quoteIndex - 1 + quoteArray.length) % quoteArray.length;
            changeQuote();
            }
        }

        function changeBook() {
            if(imgArray.length>0){
            document.getElementById('slideshow').src = imgArray[bookIndex];
            document.getElementById('textbox').innerText = textArray[bookIndex];
            }
        }

        function nextBook() {
            if(imgArray.length>0){
            bookIndex = (bookIndex + 1) % imgArray.length;
            changeBook();
            }
        }

        function prevBook() {
            if(imgArray.length >0){
            bookIndex = (bookIndex - 1 + imgArray.length) % imgArray.length;
            changeBook();
            }
        }

        document.addEventListener('DOMContentLoaded' , () =>{
            changeQuote();
            changeBook();
        });
       
    </script>
</body>
</html>