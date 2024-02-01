<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

@include 'database.php';

$errors = array();

if($_SERVER['REQUEST_METHOD']==='POST'){
    $username = $_POST['loginUsername'];
    $password= md5($_POST['loginPassword']);
    $userType = $_POST['lloji_perdoruesit'];

    $query = "SELECT * FROM users where Username=? AND Fjalekalimi=? AND User_type =?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss",$username,$password,$userType);
    $stmt->execute();
    $result=$stmt->get_result();

    if($result){
        if(mysqli_num_rows($result)>0){
            session_start();
            $_SESSION['Username'] = $username;
            $_SESSION['User_type'] = $userType;

            if($userType == 'admin'){
                $redirectURL = 'admin.php';
            }
            else if($userType == 'user'){
                $redirectURL = 'index.php';
            }

            echo '<script type="text/javascript">';
            echo 'window.location.href="' .$redirectURL.'";';
            echo '</script>';
            exit;
        }else{
            $errors[] = 'Username or password is incorrect';
        }
    }else{
        $errors[]='Error executing the query';
    }
}   
 
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="login_form.css">

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

            <input type="radio" id="user" name="lloji_perdoruesit" value="user">
            <label for="perdorues">user</label>

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