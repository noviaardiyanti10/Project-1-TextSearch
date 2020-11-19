<?php

include 'database.php';
require 'functions.php';

$awal = microtime(true);
//mengambil input keyword dari user
$keyword = $_GET['cari'];
$cari = $_GET['cari'];
$cari = explode(" ", $cari);
$tail = $_GET['tail'];

//mengambil semua data isi dokumen yang tersimpan di database
$query = "SELECT * FROM dokumen WHERE id BETWEEN 1 AND " . $tail;
$result = $db->query($query);
$result = $result->fetch_all(MYSQLI_ASSOC);

//deklarasi variabel
$sum = 0;
$doc= [];
$judul = [];
$deskripsi = [];
$textnya = [];

//mengubah keyword kedalam satu string tanpa spasi
$noSpace = str_replace(" ", "", $keyword);
$startState = 0;
$jumlahState = strlen($noSpace);
$finalState = [];
for ($i = 0; $i < count($cari); $i++) {
    array_push($finalState, strlen($cari[$i]));
}

foreach ($result as $accept) {
    $word = [];
    $isi = $accept['isi'];
    $nilai = []; //ada ini untuk variable index ke brapa dia
    for ($i = 0; $i < count($cari); $i++) {
        //memanggil fungsi Caridata untuk menentukan apakah keyword terdapat dalam dokumen
        $final = cariData($isi, $cari[$i]);
        if ($final['state'] == $finalState[$i]) {
            array_push($nilai, $i);
            array_push($word, $final['word']);
        }
    }
    if (!empty($nilai)) {
        $sum++;
        array_push($doc, $accept['id']);
        array_push($judul, $accept['judul']);
        array_push($deskripsi, $word[count($word) - 1]);
        $tmp = "";
        for ($i = 0; $i < count($nilai); $i++) {
            $tmp = $tmp . $cari[$nilai[$i]] . ", ";
        }
        array_push($textnya, $tmp);
    }
}
$akhir = microtime(true);


?>
<?php 
$waktu = $akhir - $awal;
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
    <nav class="navbar fixed-top navbar-light bg-dark">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <div class="justify-content-md-center">
                    <form class="form-inline my-2 my-lg-0 pencarian" action="" method="get">
                        <input type="text" name="cari" class="form-control mr-sm-2 ml-5" style="width: 600px;" value="<?= $keyword ?>" required>
                        <input type="hidden" class="tail" value="<?= $tail ?>" name="tail">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Cari</button>
                        <button type="button" class="btn btn-outline-success ml-2 btn-quin" data-toggle="tooltip" data-placement="bottom" title="Quintuple">Δ</button>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <div class="container" style="margin-top: 65px;">
        <div class="quintuple">
            <?php include 'quintuple.php'; ?>
        </div>
        <h6>Waktu eksekusi = <?=$waktu?> detik</h6>
        <h5 class="text-muted"> Ada <?= $sum ?> dokumen dari <?= $tail ?> dokumen.</h5>


        <?php for ($i = 0; $i < $sum; $i++) : ?>
            <div class="card mb-2">
                <div class="card-body">
                   <a href="dokumen.php?id=<?= $doc[$i] ?>" class="text-dark" > <h5 class="card-title"><?= $judul[$i] ?></h5> </a>
                    <p class="card-text"><?= $deskripsi[$i] ?></p>
                    <a href="dokumen.php?id=<?= $doc[$i] ?>" class="card-link">Lihat</a>
                </div>
            </div>
        <?php endfor; ?>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
        var s = parseInt($(".tail").val());
        $(document).ready(function() {
            $(".quintuple").hide();
            var click = 1;
            $(".btn-quin").click(function() {
                if (click == 1) {
                    $(".quintuple").show(300);
                    click++;
                } else {
                    $(".quintuple").hide(300);
                    click = 1
                }
            })
            $(".pencarian").submit(function() {
                s = s + 50;
                if (s > 225) s = 225
                $(".tail").val(s);
                console.log($(".tail").val());
            })
        });

    </script>
</body>

</html>