<?php
error_reporting(0);
session_start();
@include 'config.php';
if(isset($_SESSION['login']))
{
    date_default_timezone_set('Asia/Kolkata');
    unset($_SESSION['Reserve']);
    $_SESSION['reserve']=true;
    $email=$_SESSION['user'];
    if(isset($_POST['submit']))
    {
        $timestamp = time();
        $date_time_string = date("Y-m-d H:i:s", $timestamp);
        $date = $_POST['date'];
        $stime = $_POST['stime'];
        $etime = $_POST['etime'];
        $table = $_POST['table'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $sql ="SELECT * FROM  tableno WHERE table_number = '$table' AND date = '$date' AND ((start_time <= '$stime'AND end_time >= '$stime') OR (start_time >= '$stime' AND start_time < '$etime'))";
        $res=mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)>0)
        {
            echo'<script>alert("Sorry Table is Already Booked!")</script>';
            echo'<script>location.href = "Reserve.php"</script>';
        }
        else
        {
            $_SESSION['stime']=$stime;
            $_SESSION['etime']=$etime;
            $_SESSION['date']=$date;
            $_SESSION['name']=$name;
            $_SESSION['phnum']=$phnum;
            $_SESSION['Table']=$table;

            $sql ="INSERT INTO `tableno` (`date`, `start_time`, `end_time`, `status`, `email`, `table_number`, `phonenumber`, `name`,`datetime`) VALUES ('$date', '$stime', '$etime', 'confirm', '$email', '$table', '$phone', '$name','$date_time_string')";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                $_SESSION['Reserve']=true;
                echo'<script>alert("Table Book")</script>';
                echo'<script>location.href = "BookRes.php"</script>';
            }
        }
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCC | pkd</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="image/fevicon.png">
    <style>
    .form-control:focus {
        border-color: #8e44ad;
        box-shadow: 0 0 0 0.2rem rgba(142, 68, 173, 0.25);
    }

    .btn-primary {
        background-color: #8e44ad;
        border-color: #8e44ad;
        font-weight: bold;
    }

    .btn-primary:hover {
        background-color: #6c3483;
        border-color: #6c3483;
    }

    h1 {
        color: #8e44ad;
        font-weight: bold;
    }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-info">
    <?php include 'header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1 style="margin-top: 60px;" class="text-white">Table Booking</h1>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label text-white">Date</label>
                            <input type="date" class="form-control" id="date" name="date"
                                min="<?php echo date('Y-m-d');?>"
                                max="<?php echo date('Y-m-d', strtotime('+30 days')); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="starting-time" class="form-label text-white">Starting Time</label>
                            <input type="time" class="form-control " id="starting-time" min="8:00" max="20:00"
                                name="stime" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="ending-time" class="form-label text-white">Ending Time</label>
                            <input type="time" class="form-control" id="etime" name="etime" min="08:00" max="22:00"
                                onchange="setMin(this)" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label text-white">Name</label>
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label text-white">Phone Number</label>
                            <input type="number" class="form-control" id="phone" name="phone" autocomplete="off"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="table-number" class="form-label text-white">Table Number</label>
                            <input type="number" min="1" max="10" class="form-control" id="table-number" name="table"
                                autocomplete="off" required>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary mt-4 my-6">Book Table</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
<script src="js/javascript1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
<script>
function setMin(elem) {
    var startingTime = document.getElementById("starting-time").value;
    elem.min = startingTime;
    if (elem.value < startingTime) {
        elem.value = startingTime + 2;
    }
}
</script>

</html>
<?php }
else
{
    echo'<script>location.href = "login.php"</script>';
}
?>