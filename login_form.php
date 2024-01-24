<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);

@include 'database.php';

session_start();

echo 'Form submitted';

if(isset($_POST['submit']) && $_POST['submit'] === 'submit'){

    $username = mysqli_real_escape_string($conn, $_POST['loginUsername']);
    $pass = md5($_POST['loginPassword']);

    $select = "SELECT * FROM users WHERE Username = '$username' AND Fjalekalimi = '$pass' " ;
    $result = mysqli_query($conn, $select);


    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
    
            if (isset($row['user_type']) && !empty($row['user_type'])) {
                if ($row['user_type'] == 'admin') {
                   $_SESSION['admin_name'] = $row['username'];
                    header('location: admin.php');
                    exit();
                } elseif ($row['user_type'] == 'perdorues'){
                   $_SESSION['user_name'] = $row['username'];
                    header('location: user.php');
                    exit();
                }
            } else {
                $error[] = '<span class="error_msg">Ju lutem zgjidhni nje nga llojet e perdoruesit!</span>';
            }
        } else {
            $error[] = ' Username ose fjalekalimi eshte i pasakte !';
        }
    } else {
        die('Error: ' . mysqli_error($conn));
    }
 }
    
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
<form action="" method="post">
<?php
     if(isset($error)){
         foreach($error as $error){
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
    
</body>
</html>