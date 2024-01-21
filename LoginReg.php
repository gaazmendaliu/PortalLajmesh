<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>


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

        .toggle-link {
            text-align: center;
            margin-top: 10px;
            cursor: pointer;
            color: black;
            text-decoration: underline;
        }

        #registerForm label ,
        #registerForm input {
            width: 100%;
            box-sizing: border-box;
        }


        
    </style>

</head>
<body>
    
        <div class = "container" id="loginForm">

    <?php

if(isset($_POST['submit'])){
    $username=$_POST["loginUsername"];
    $password=$_POST["loginPassword"];

    require_once "database.php";
    $sql="SELECT * FROM users where Username = '$username'";
    $result = mysqli_query($conn, $sql);
    $user=mysqli_fetch_array($result, MYSQLI_ASSOC);

    if($user){
        if(password_verify($password, $user["Fjalëkalimi"])){
            session_start();
            $_SESSION["user"]="yes";
            header("Location: index.php");
            die();
        }else{
            echo"<div class='alert alert-danger'>Pasword nuk eshte i sakte</div>";
        }
    }else{
        echo "<div class='alert alert-danger'>Username  nuk eshte i sakte</div>";
    }
}


?>



        <form action="LoginReg.php" method="post">
            <label for="loginUsername">Username:</label>
            <input type="text" id="loginUsername" name="loginUsername" required>
            <div class="error-message" id="lognameError"></div>


            <label for="loginPassword">Fjalëkalimi:</label>
            <input type="password" id="loginPassword" name="loginPassword" required>
            <div class="error-message" id="logpassError"></div>

            <button type="submit" name="submit">Kyçu</button>
            
        </form>
     
        <div class="toggle-link" onclick="toggleForms()">Nuk keni llogari?Regjistrohunu këtu!</div>

        </div>
        

    <div class = "container" id="registerForm" style="display: none;"> 

    <?php

if(isset($_POST["submitRegister"])){
    $fname = $_POST["firstName"];
    $lname = $_POST["lastName"];
    $username=$_POST["registerUsername"];
    $email = $_POST["email"];
    $birthday = $_POST["birthday"];
    $password = password_hash($_POST["registerPassword"], PASSWORD_DEFAULT);
    $confirmpass = $_POST["confirmPassword"];


    $errors = array();

    if(empty($fname) OR empty($lname) OR empty($username) OR empty($email) OR empty($birthday) OR empty($password) OR empty($confirmpass)){
        array_push($errors,"Plotesoni te gjitha fushat");
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors,"Email nuk eshte valid");
    }
    if(strlen($password)<8){
        array_push($errors, "Falimi duhet te jete minimumi 8 karaktere");
    }
    if(($password!== $confirmpass)){
        array_push($errors, "Fjalekalimet nuk perputhen");
    }


    require_once "database.php";
    $sql="select * from users where E-mail='$email'";
    $result = mysqli_query($conn,$sql);
    $rowCount = mysqli_num_rows($result);
    
    if($rowCount>0){
        array_push($errors, "Email-i ekziston");
    }

    if(count($errors)>0){

        foreach($errors as $error){
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
    else{
        $sql = "insert into users (Emri,Mbiemri,Username, E-mail,Ditëlindja,Fjalëkalimi) values ('$fname',' $lname',' $username', '$email', '$birthday', '$password')";
        $stmt = mysqli_stmt_init($conn);

        $prepareStmt = mysqli_stmt_prepare($stmt,$sql);

        if($prepareStmt){
            mysqli_stmt_bind_param($stmt,"ssssss",$fname,$lname,$username,$email,$birthday,$password);
            mysqli_stmt_execute($stmt);
            echo"<div class='alert alert-success'>Jeni regjistruar.</div>";
        }else{
            die("Dicka nuk shkoi mire");
        }
    }
    

}

    ?>

        <form action = "LoginReg.php" method="post">
            <label for="firstName">Emri:</label>
            <input type="text" id="firstName" name="firstName" required>


            <label for="lastName">Mbiemri:</label>
            <input type="text" id="lastName" name="lastName" required>


            <label for="Username">Username:</label>
            <input type="text" id="registerUsername" name="registerUsername" required>


            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>


            <label for="birthday">Ditëlindja:</label>
            <input type="date" id="birthday" name="birthday" required>

            <label for="registerPassword">Fjalëkalimi:</label>
            <input type="password" id="registerPassword" name="registerPassword" required>


            <label for="confirmPassword">Konfirmo fjalëkalimin:</label>
            <input type="password" id="confirmPassword" name="confirmPassword">


            <button type="submit" name="submitRegister">Regjistrohu</button>
            <div class="toggle-link" onclick="toggleForms()">Keni llogari?Kyçuni këtu!</div>
        </form>
        </div>
        

        

    <script>

        

        function toggleForms() {
            var loginForm = document.querySelector('#loginForm');
            var registerForm = document.querySelector('#registerForm');
            var toggleLink = document.querySelector('.toggle-link');

            if (loginForm.style.display === 'none' || loginForm.style.display === '') {
                loginForm.style.display = 'block';
                registerForm.style.display = 'none';
                toggleLink.innerText ='Nuk keni llogari?Regjistrohuni këtu!';
            } else {
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
                toggleLink.innerText = 'Keni llogari?Kyçuni këtu!';
            }
        } 

    </script>

</body>
</html>