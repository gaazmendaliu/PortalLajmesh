<?php
    @include 'database.php';

    if(isset($_GET['article_id'])){
        $article_id=$_GET['article_id'];

        $sql="SELECT * FROM Artikulli WHERE ID = $article_id";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("i",$article_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows>0){
            $article=$result->fetch_assoc();
        }else{
            echo"Artikulli nuk u gjet";
            exit;
        }
    }else{
        echo "ID e artikullit nuk u percaktua";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ndrysho</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type ="hidden" name="article_id" value="<?php echo $article['ID'];?>">
       
        <label for="title">Titulli i ri</label>
        <input type="text" id="title" name="title" value="<?php echo $article['Titulli'];?>">

        <label for="image">Foto e re</label>
        <input type="file" id="image" name="image" accept="image/*"><br>

        <label for="content">Permbajtja e re</label>
        <textarea id="content" name="content" required><?php echo $article['Permbajtja'];?></textarea>

        <label for="category">Kategoria e re</label>
        <input type="text" id="category" name="category" value="<?php echo $article['Kategoria'];?>" required><br>

        <input type="submit" value="Ruaj ndryshimet">
</form>

<?php

require_once 'database.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $article_id = $_POST['article_id'];
    $title=$_POST['title'];
    $content=$_POST['content'];
    $category=$_POST['category'];

    $sql="UPDATE Artikulli SET Titulli='$title', Permbajtja='$content', Kategoria='$category' WHERE ID=$article_id";

    if($stmt->execute()){
        echo "Artikulli u ndryshua me sukses";
    }else{
        echo "Gabim gjate ndryshimit te artikullit: ".$conn->error;
    }
}

$conn->close();

?>

</body>
</html>