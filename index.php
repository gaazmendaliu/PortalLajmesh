<?php
require_once 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" type="text/css" href="index.css">

    
</head>
<body>
<nav class="navbar">
        <label class="Emri">Kronikë04</label>
        <ul>
            <li><a href="Politike.php" onclick="showContent('Politikë')">Politikë</a></li>
            <li><a href="Lifestyle.php" onclick="showContent('LifeStyle')">Lifestyle</a></li>
            <li><a href="Ekonomi.php" onclick="showContent('Ekonomi')">Ekonomi</a></li>
            <li><a href="Teknologji.php" onclick="showContent('Teknologji')" >Teknologji</a></li>
            <li><a href="Sport.php" onclick="showContent('Sport')">Sport</a></li>
            <li><a href="Showbiz.php" onclick="showContent('Showbiz')" >Showbiz</a></li>
            <li><a href="Slider.php" onclick="showContent('Faqe Arti')">FaqeArti</a></li>
        </ul>
    </nav>
    <div class="search-bar-container">
        <div class="search-bar">
            <form action="search.php" method="GET">
            <input type="text" name="search" placeholder="Kërkoni...">
            <button type="submit">Kërko</button>
        </form>
        </div>
        <div class="login-button-container">
        <button class="login-button" onclick="redirectToLogin()">Kyçu / Regjistrohu </button>
        </div>
    </div>

    
        <?php

if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $sql = "SELECT * FROM Artikulli WHERE Kategoria = '$category'";
} else {
    $sql = "SELECT * FROM Artikulli";
}

$result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="artikull-container">';
            echo "<h2>" . $row['Titulli'] . "</h2>";
            echo "<img src='uploads/" . $row['Foto'] . "' alt='Imazhi i artikullit'>";
            echo "<p>" . $row['Permbajtja'] . "</p>";

        if (!isset($_GET['category'])) {
            echo "<p>Kategoria: " . $row['Kategoria'] . "</p>";
        }

        echo "</div>";
    }
} else {
        echo "Nuk ka artikuj";
}
        

    
        
        ?>

       </div> 

    <footer>
        <div class="rreth-nesh">
            <h3>Rreth nesh</h3>
            <p> <br>Ky website është zhvilluar nga dy studentë të vitit të dytë në Fakultetin e  Shkencave Kompjuterike dhe Inxhinieri ,UBT, në kuadër të lëndës Dizajni dhe Zhvillimi i Webit</p>
        </div>

        <div class="Kontakti">
            <h3>Kontakti</h3>
            <ul>
                <li> 
                    <br><a href="mailto:kronikë04@gmail.com">kronikë04@gmail</a>
                </li>

                <li>
                   <a href="tel:+38349000000">00 383 49 000 000</a> 
                </li>

                <li>
                    <a href="tel:+38344000000">00 383 44 000 000</a>
                </li>
            </ul>
        </div>

        <div class="copyright-footer">
                <p style="margin: 0; padding: 10px;">&copy; 2024 Kronikë04 të gjitha të drejtat e rezervuara.</p>
        </div>

    </footer>

  <script>

        function toggleMenu(){
            const navUl =  document.querySelector('nav ul');
            navUl.classList.toggle('show');
        }

        function showContent(category){
            console.log(`show content for ${category}`)
        }

        function redirectToLogin(){
            window.location.href = 'login_form.php';
        }
    </script>

</body>
</html>