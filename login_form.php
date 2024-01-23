<?php

@include 'database.php';

session_start();

if(isset($_POST['submitRegister'])){

    $fname=mysqli_real_escape_string($conn,$_POST[firstName]);
    $lname=mysqli_real_escape_string($conn,$_POST[lastName]);
    $username=mysqli_real_escape_string($conn,$_POST[registerUsername]);
    $email=mysqli_real_escape_string($conn,$_POST[email]);
    $bday=$_POST([birthday]);
    $pass = md5($_POST['registerPassword']);
    $cpass=md5($_POST(['confirmPassword']));
    $user_type=$_POST['user_type'];

    $select = "SELECT * FROM users WHERE Username = '$username' && Fjalëkalimi = '$pass' ";
    $result=mysqli_query($conn,$select);

    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_array($result);

        if($row['user_type']=='admin'){
            $_SESSION['admin_name']=$row['username'];
            header('location:admin.php');
        }
        else if($row['user_type']=='user'){
            $_SESSION['user_name']=$row['username'];
            header('location:user.php');
        }
        
        }else{
            $error[]= 'Username ose password nuk eshte i sakte';
        }
    
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
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

<body>

<div class="container" id="loginform">
<form action="LoginReg.php" method="post">
<?php
     if(isset($error)){
         foreach($error as $error){
            echo 'span class ="error_msg">'.$error.'</span>';
         }
    }

?>
            <label for="loginUsername">Username:</label>
            <input type="text" id="loginUsername" name="loginUsername" required>

            <label for="loginPassword">Fjalëkalimi:</label>
            <input type="password" id="loginPassword" name="loginPassword" required>

            <button type="submit" name="submit">Kyçu</button>
            <p>Nuk keni llogari? <a href="register_form.php">Regjistrohu këtu</a></p>
            
        </form>
</div>   
    
</body>
</html>