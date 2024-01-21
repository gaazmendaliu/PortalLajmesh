<?php

@include 'database.php';

if(isset($_POST['submitRegister'])){

    $fname=mysqli_real_escape_string($conn,$_POST[firstName]);
    $lname=mysqli_real_escape_string($conn,$_POST[lastName]);
    $username=mysqli_real_escape_string($conn,$_POST[registerUsername]);
    $email=mysqli_real_escape_string($conn,$_POST[email]);
    $bday=$_POST([birthday]);
    $pass = md5($_POST['registerPassword']);
    $cpass=md5($_POST([confirmPassword]));
    $user_type=$_POST['user_type'];

    $select = "SELECT * FROM users WHERE Username = '$username' && Fjalëkalimi = '$pass' ";
    $result=mysqli_query($conn,$select);

    if(mysqli_num_rows($result)>0){
        $error[] = 'Perdoruesi ekziston'; 
    }
    else{
        if($pass != $cpass){
            $error[] = 'Fjalekalimet nuk pershtaten';
        }else{
            $insert = "INSERT INTO users (Emri,Mbiemri,Username,E-mail,Ditëlindja,Fjalëkalimi,User_type) values ('$fname','$lname','$username','$email','$bday','$pass','$user_type')";
            mysqli_query($conn,$insert);
            header('location: login_form.php');
        }
    }
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register form</title>
</head>
<body>
    
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

        #registerForm{
            display: none;
        }
        
        #registerForm label ,
        #registerForm input {
            width: 100%;
            box-sizing: border-box;
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
    <div class="container" id="registerForm">
    <form action = "" method="post">
      <?php
        if(isset($error)){
            foreach($error as $error){
                echo 'span class ="error_msg">'.$error.'</span>';
            }
        }

        ?>

            <label for="firstName">Emri:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">Mbiemri:</label>
            <input type="text" id="lastName" name="lastName" required>

            <label for="Username">Username:</label>
            <input type="text" id="registerUsername" name="registerUsername" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="registerPassword">Fjalëkalimi:</label>
            <input type="password" id="registerPassword" name="registerPassword" required>

            <label for="confirmPassword">Konfirmo fjalëkalimin:</label>
            <input type="password" id="confirmPassword" name="confirmPassword">

            <option value = "user">user</option>
            <option value="admin">admin</option>

            <button type="submit" name="submitRegister">Regjistrohu</button>
            <p>Keni llogari? <a href="login_form.php">Kycu këtu</a></p>
        </form>

</div>
</body>

</html>