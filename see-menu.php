<?php
session_start();
@include 'config.php';
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCC | pkd</title>

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="image/fevicon.png">
    <style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-info">
    <?php @include 'header.php'; ?>
    <div class="container" style="margin-top: 80px;">
        <h1 class="text-center text-danger">Our Menu</h1>
        <p><b class="text-dark"> Search Your Item</b></p>
        <input type="text" id="searchInput" class="btn-primary" placeholder="Search...">
        <br><br>
        <div class="row" id="results">
            <?php 
                    $sql="SELECT * FROM `food_menu`";
                    $result = mysqli_query($conn, $sql);
                    while($row=mysqli_fetch_assoc($result))
                    { ?>
            <div class="col-md-8 col-lg-4 menu" style="margin-top: 20px;">
                <div class="card bg-danger" style='width: 19rem;'>
                    <img src="Food/<?= $row['image'] ?>" class="card-img-top" style='height: 180px;'>
                    <div class="card-body">
                        <h5 class="text-white"><?php echo $row["name"] ?></h5>
                        <p class="text-white"><?php echo $row["summary"] ?></p>
                        <?php
                            if($row['status'])
                            { ?>
                        <p class="text-white amount">₹<?php echo $row["price"] ?></p>
                        <?php } 
                            else { ?>
                        <p class="amount text-white">Unavailable!</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="mb-3 col-md-12 text-center">
            </div>
        </div>
    </div>
    <?php @include 'footer.php' ?>
</body>
<script src="js/javascript1.js"></script>
<script src="js/javascript.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
<script>
AOS.init({
    offset: 300,
    duration: 1000,
});
</script>

</html>