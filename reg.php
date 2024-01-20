<?php

if(isset($_POST["submit"])){
    $fname = $_POST["firstName"];
    $lname = $_POST["lastName"];
    $username=$_POST["registerUsername"];
    $email = $_POST["email"];
    $birthday = $_POST["birthday"];
    $password = password_hash($_POST["registerPassword"],PASSWORD_DEFAULT);
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
            echo "<div class='alert alert-danger'>$error</div>"
        }
    }
    else{
        $sql = "insert into users (Emri,Mbiemri,Username, E-mail,Ditëlindja,Fjalëkalimi) values ($fname,$lname,$username,$email,$birthday,$password)";
        $stmt = mysqli_stat_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
        if($prepareStm t){
            mysqli_stat_bind_param($stm t,"sss",$fname,$lname,$username,$email,$birthday,$password,$confirmpass);
            mysqli_stat_execute($stmt);
            echo"<div class='alert alert-success'>Jeni regjistruar.</div>";
        }
        else{
            die("Dicka nuk shkoi mire");
        }
    }
    

}
?> 