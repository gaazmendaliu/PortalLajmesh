<?php

@include 'database.php';

$quoteArray = array();
$sql="SELECT Thenja from Quotes";
$result = $conn->query($sql);

if($result->num_rows>0){
    while($row = $result->fetch_assoc()){
        $quoteArray[]=$row["Thenja"];
    }
}

$imgArray = array();
$textArray = array();
$sql = "SELECT TitulliAutori, Kopertina FROM Books";
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
    <link rel="stylesheet" type="text/css" href="Slider.css">

</head>

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