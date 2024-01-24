<?php

session_start();

@include 'database.php';

if(!isset($_SESSION['admin_name'])){
    header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>

    <form action="shto_artikull.php" method ="post" enctype="multipart/form-data">
        <label for ="title">Titulli</label>
        <input type="text" id="title" name="title" required><br>

        <label for="image">Ngarko foton</label>
        <input type="file" id="image" name="image" accept="image/*"><br>

        <label for="content">Permbajtja:</label>
        <textarea id="content" name="content" required></textarea><br>

        <label for="category">Kategoria</label>
        <input type="text" id="category" name="category" required><br>

        <input type="submit" value = "Shto">
    </form>

    <a href="admin.php">Kthehu te Admin</a>

    <?php while($row=$result->fetch_assoc()):   ?>

        <tr>
            <td><?php echo $row['title'];?></td>
            <td><?php echo $row['content'];?></td>
            <td><?php echo $row['category'];?></td>
            <td><a href="fshi_artikull.php?id=<?php echo $row['ID']; ?>">Fshi</a></td>
         </tr>    
    <?php endwhile; ?>    
    
</body>
</html>