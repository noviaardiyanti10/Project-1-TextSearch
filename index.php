<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text Search</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="content">
        <div class="search mt-5">
            <h1>Search Engine</h1>
            <div>
                <form action="search.php" method="get" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Ketik Keyword" aria-label="Search" name="cari">
                    <input type="hidden" name="tail" value="50">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Cari</button>
                </form>
            <div>    
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>