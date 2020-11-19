<?php
include 'database.php';
$id = $_GET['id'];
$query = "SELECT judul, isi FROM dokumen WHERE id=" . $id;
$hasil = $db->query($query);
$hasil = $hasil->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text Search</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
    <div class="container" style="margin-top: 25px;">
        <h2><?= $hasil['judul'] ?></h2>
        <p style="text-align: justify;"><?= $hasil['isi'] ?></p>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>