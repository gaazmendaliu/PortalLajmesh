<?php

require_once 'database.php';

$errors = array();

if($_SERVER['REQUEST_METHOD']==='POST'){
    $username = $_POST['loginUsername'];
    $password= $_POST['loginPassword'];
    $userType = $_POST['lloji_perdoruesit'];

    $query = "SELECT * FROM users where Username='$username' and Fjalekalimi='$password' AND user_type ='$userType'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result)>0){
        echo '<script>';
        if($userType=='admin'){
            echo 'window.location.href="admin.php";';
        } elseif($userType == 'perdorues'){
            echo 'window.location.href="user.php";';
        }
        echo '</script>';
    }else{
        $errors[]='Username ose fjalekalimi i gabuar';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 305px;
            margin: auto;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
        }

        input {
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: black;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: black;
        }

        .container .error_msg{
            margin: 10px 0;
            display:block;
            background:crimson;
            color: #fff;
            border-radius:5px;
            font-size:20px;
        }

    </style>
</head>


<body>

<div class="container" id="loginform">
<form action="" method="post">
<?php
     if(!empty($errors)){
         foreach($errors as $error){
            echo '<span class ="error_msg">'.$error.'</span>';
         }
    }

?>
            <label for="loginUsername">Username:</label>
            <input type="text" id="loginUsername" name="loginUsername" required>

            <label for="loginPassword">Fjalëkalimi:</label>
            <input type="password" id="loginPassword" name="loginPassword" required>

            <label>Lloji i përdoruesit:</label>
            <input type="radio" id="admin" name="lloji_perdoruesit" value="admin">
            <label for="admin">Admin</label>

            <input type="radio" id="perdorues" name="lloji_perdoruesit" value="perdorues">
            <label for="perdorues">Perdorues</label>

            <button type="submit" name="submit" value="submit">Kyçu</button>
            <p>Nuk keni llogari? <a href="register_form.php">Regjistrohu këtu</a></p>
            
        </form>
</div> 

<script>
    document.querySelector('form').addEventListener('submit',function (e){
        var userType = document.querySelector('input[name="lloji_perdoruesit"]:checked');
        if(!userType){
            alert('Ju lutem zgjedhni nje lloj te perdoruesit');
            e.preventDefault();
        }
    });
    </script>
    
</body>
</html>