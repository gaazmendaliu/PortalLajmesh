<?php
@include 'database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["addQuote"])) {
        $newQuote = $_POST["newQuote"];
        $sql = "INSERT INTO Quotes (Thenja) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $newQuote);

        if ($stmt->execute()) {
            echo "Thenja u shtua me sukses";
        } else {
            echo "Nodhi nje gabim gjate shtimit te thenjes! " . $stmt->error;
        }
    } elseif (isset($_POST["addBook"])) {
        $newText = $_POST["newText"];
        $newImage = $_FILES["newImage"]["name"];
        $sql = "INSERT INTO Books (TitulliAutori, Kopertina) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $newText, $newImage);

        if ($stmt->execute()) {
            echo "Libri u shtua me sukses!";
        } else {
            echo "Ndodhi nje gabim gjate shtimit te librit! " . $stmt->error;
        }
    }
}

$existingQuotes = [];
$sql = "SELECT ID, Thenja FROM Quotes";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $existingQuotes[] = $row;
    }
}

$existingBooks = [];
$sql = "SELECT ID, TitulliAutori, Kopertina FROM Books";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $existingBooks[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Slider</title>
    <link rel="stylesheet" type="text/css" href="edit_slider.css">
</head>
<body>
    
    <h2>Shto Thënje</h2>
    <form method="post" action="" enctype="multipart/form-data">
        <label for="newQuote">Thenja e re:</label>
        <input type="text" name="newQuote" required>
        <button type="submit" name="addQuote">Shto</button>
    </form> 

    <h2>Shto libra</h2>
    <form method="post" action="" enctype="multipart/form-data">
        <label for="newImage">Kopertina e re</label>
        <input type="file" name="newImage" required>
        <label for="newText">Titulli dhe autori</label>
        <input type="text" name="newText" required>
        <button type="submit" name="addBook">Shto</button>
    </form> 

</body>
</html>
