

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <style>
        *{
            padding: 0;
            margin: 0;
            text-decoration: none;
            list-style: none;
            box-sizing: border-box;
        }
    
        body {
            font-family: 'Times New Roman', Times, serif;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }
        nav{
            display: flex;
            flex-direction: column;
            align-items: center;
            background: black;
            padding: 25px;
            margin-top: 15px;
            width: 100%;
            position: relative;
            z-index: 1000;
        }

        label.Emri {
            color: white;
            font-size: 24px;
            margin-bottom: 10px;
        }
    
        nav ul {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
    
        nav ul li {
            margin: 0 10px;
        }
    
        nav ul li a {
            color:  white;
            font-size: 17px;
            padding: 18px 20px;
        }
    
        nav li a:hover {
            background-color: white;
            color: black;
        }

    
        .search-bar-container{
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding-left: 25px;
            position: relative;
            top: 30px;
            left: 0;
            background-color: white;
            z-index: 1000;
        }
        .search-bar {
            display: flex;
            align-items: center;
            width: 50%;
        }
        .search-bar input {
            flex: 1;
            height: 40px;
            padding: 10px;
            border: 2px solid black;
            border-radius: 20px;
            box-sizing: border-box;
            font-size: 14px;
        }
        .search-bar button {
            background-color: white;
            color: black;
            height: 40px;
            border: 2px solid black;
            border-bottom: 3px solid black;
            border-radius: 20px;
            padding: 8px 12px;
            cursor: pointer;
            margin-left: 5px;
        }
        .login-button-container {
            display: flex;
            align-items: center;
            margin-left: auto;
            margin-right: 25px;
        }
    
        .login-button {
            background-color: white;
            color: black;
            padding: 10px;
            border: 2px solid black;
            border-radius: 20px;
            cursor: pointer;
            margin-right: 25px;
        }
        
        @media only screen and (min-width : 600px) {
            nav {
                flex-direction: row;
                justify-content: space-between;
            }
            label.Emri {
                font-size: 35px;
                margin-bottom: 0;
            }
            nav ul {
                margin-top: 0;
            }
            
        }
        footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            padding: 20px;
            background-color: black;
            color: white;
            width: 100%;
        }

        .rreth-nesh {
            max-width: 300px;
            margin-bottom: 20px;
            margin-left: 30px;
        }

        .Kontakti {
            margin-bottom: 10px;
            margin-right: 30px;
        }

        .Kontakti li {
            color: white !important;
        }

        .Kontakti li a {
            color: white !important;
        }

        .copyright-footer {
            text-align: center;
            width: 100%;
        }

        </style>
</head>
<body>
<nav class="navbar">
        <label class="Emri">Kronikë04</label>
        <ul>
            <li><a href="Politikë.html" onclick="showContent('Politikë')">Politikë</a></li>
            <li><a href="Lifestyle.html" onclick="showContent('LifeStyle')">Lifestyle</a></li>
            <li><a href="Ekonomi.html" onclick="showContent('Ekonomi')">Ekonomi</a></li>
            <li><a href="Teknologji.html" onclick="showContent('Teknologji')" >Teknologji</a></li>
            <li><a href="Sport.html" onclick="showContent('Sport')">Sport</a></li>
            <li><a href="Showbiz.html" onclick="showContent('Showbiz')" >Showbiz</a></li>
            <li><a href="Slider.html" onclick="showContent('Faqe Arti')">Faqe Arti</a></li>
        </ul>
    </nav>
    <div class="search-bar-container">
        <div class="search-bar">
            <input type="text" placeholder="Kërkoni...">
            <button type="button">Kërko</button>
        </div>
        <div class="login-button-container">
        <button class="login-button" onclick="location.href ='login_form.php'" >Kyçu / Regjistrohu </button>
        </div>
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
        function showContent(category){
            console.log(`show content for ${category}`)
        }
    </script>

</body>
</html>