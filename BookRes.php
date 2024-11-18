<?php
session_start();
if(isset($_SESSION['reserve']))
{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCC | pkd | booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="image/fevicon.png">
    <style>
    .card {
        background: #a82c48;
        color: white;
    }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-info">
    <?php @include 'header.php'; 
    
    date_default_timezone_set('Asia/Kolkata');
    $date = $_SESSION['date'];
    $formatted_date = date("F j Y", strtotime($date));
    $stime = $_SESSION['stime'];
    $etime = $_SESSION['etime'];
    $formatted_stime = date("g:i a", strtotime($stime));
    $formatted_etime = date("g:i a", strtotime($etime));
    ?>

    <div class="container" style="margin-top: 60px;">
        <div class="card bg-white">
            <div class="card-body mx-4">
                <div class="container">
                    <p class="my-5 mx-5" style="font-size: 30px;">Thank for booking</p>
                    <div class="row">
                        <ul class="list-unstyled">
                            <li class="text-black"><?php echo $_SESSION['name']; ?></li>
                            <li class="text-muted mt-1"><span class="text-black">Invoice
                            <li class="text-black mt-1"><?php  echo $formatted_date; ?></li>
                        </ul>
                        <hr>
                        <div class="col-xl-8">
                            <p>Time</p>
                        </div>
                        <div class="col-xl">
                            <p class="float-end"><?php echo $formatted_stime ." To ".$formatted_etime;?>
                            </p>
                        </div>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-xl-8">
                            <p>Table Number</p>
                        </div>
                        <div class="col-xl">
                            <p class="float-end"><?php echo $_SESSION['Table']; ?>
                            </p>
                        </div>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-xl-10">
                            <p>Support</p>
                        </div>
                        <div class="col-xl-2">
                            <p class="float-end">+91 7488048437
                            </p>
                        </div>

                        <button onclick="window.print()" class="bg-white">Print</button>
                        <hr style="border: 2px solid black;">
                    </div>
                    <div class="row text-black">

                        <hr style="border: 2px solid black;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5"></div>
    <?php @include 'footer.php' ?>
</body>
<script src="js/javascript1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>

</html>
<?php 
unset($_SESSION['reserve'],$_SESSION['stime'],$_SESSION['etime'],$_SESSION['date'],$_SESSION['name'],$_SESSION['phnum'],$_SESSION['Table']);
}
else 
{
    echo'<script>location.href = "Reserve.php"</script>';
}
 ?>