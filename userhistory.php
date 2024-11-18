<?php
error_reporting(0);
@include 'config.php';
session_start();
date_default_timezone_set('Asia/Kolkata');
if(isset($_SESSION['login']))
{    
    if(isset($_POST['submit']))
    {
        $_SESSION['date']=$_POST['date'];
        $_SESSION['status']=$_POST['status'];
        echo'<script>location.href = "userhistory.php"</script>';
    }
    $email=$_SESSION['user'];
    $select = "SELECT * FROM user_db WHERE email = '$email'";
    $result = mysqli_query($conn, $select);
    $row1=mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

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
    .card {
        background: #a82c48;
        color: white;
    }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-info">

    <?php @include 'header.php'; ?>
    <div class="container" style="margin-top: 90px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>CUTM COFFEE CONNECT</h3>
                    </div>
                    <div class="card-body text-center">
                        <img src="userpic/<?=$row1['image'] ?>" alt="Profile Photo" class="rounded-circle"
                            style="width: 200px">
                        <h4 class="mt-2">
                            <?php
                            echo '<span class="error-msg">'.$row1['name'].'</span>';
                            ?>
                        </h4>

                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <form action="" method="post">
                <div class="row g-6 mt-3">
                    <div class="col-sm">
                        <select id="inputState" class="form-select btn btn-dark" name="status">
                            <option value="All">All</option>
                            <option value="Recived">Recived</option>
                            <option value="Cancel">Cancel</option>
                        </select>
                    </div>
                    <div class="col-sm">
                        <input type="date" id="myDate" class="form-control btn btn-warning" name="date"
                            placeholder="dd Mmm yyyy">
                    </div>
                    <div class="col-sm">
                        <button type="submit" class="form-control btn btn-primary" name="submit"
                            aria-label="Zip">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive" id="no-more-tables">
            <table class="table bg-warning mt-2">
                <thead>
                    <tr>
                        <th>SI.NO</th>
                        <th>Name</th>
                        <th>Items</th>
                        <th>Price</th>
                        <th>Date/Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                            if(mysqli_num_rows($result)==1)
                            {
                                if(strlen($_SESSION['date'])>0)
                                {
                                    $date=$_SESSION['date'];
                                    $status=$_SESSION['status'];
                                    if($status==='Recived')
                                    {
                                        $select = "SELECT * FROM `menu` WHERE DATE(datetime) = '$date' AND `status`= '$status' AND email ='$email' ORDER BY datetime DESC";
                                        $result = mysqli_query($conn, $select);
                                    }
                                    else if($status==='Cancel')
                                    {
                                        $select = "SELECT * FROM `menu` WHERE DATE(datetime) = '$date' AND `status`= '$status' AND email ='$email' ORDER BY datetime DESC";
                                        $result = mysqli_query($conn, $select);
                                    }
                                    else
                                    {
                                        $select = "SELECT * FROM `menu` WHERE DATE(datetime) = '$date' AND email ='$email' ORDER BY datetime DESC";
                                        $result = mysqli_query($conn, $select);
                                    }
                                }
                                else 
                                {
                                    $status=$_SESSION['status'];
                                    if($status==='Recived')
                                    {
                                        $select = "SELECT * FROM `menu` WHERE  `status`= '$status' AND email ='$email' ORDER BY datetime DESC";
                                        $result = mysqli_query($conn, $select);
                                    }
                                    else if($status==='Cancel')
                                    {
                                        $select = "SELECT * FROM `menu` WHERE  `status`= '$status' AND email ='$email' ORDER BY datetime DESC";
                                        $result = mysqli_query($conn, $select);
                                    }
                                    else
                                    {
                                        $select = "SELECT * FROM `menu` WHERE email ='$email' ORDER BY datetime DESC";
                                        $result = mysqli_query($conn, $select);
                                    }
                                }
                                $on=1;
                                if(mysqli_num_rows($result)>0){
                                while($row=mysqli_fetch_assoc($result))
                                { 
                                    $dateStr = $row['datetime'];
                                    $dateObj = strtotime($dateStr);
                                    $formattedDate = date('j F Y h:i A', $dateObj); ?>

                    <tr>
                        <?php 
                                if($row['status']==='Recived')
                                { ?>
                        <td class="bg-success text-white">
                            <?php echo $on++ ?>
                        </td>
                        <td class="bg-success text-white">
                            <?php echo $row['Name'] ?>
                        </td>
                        <td class="bg-success text-white">
                            <?php echo $row['Items']?>
                        </td>
                        <td class="bg-success text-white">
                            <?php echo $row['Price'] ?>
                        </td>
                        <td class="bg-success text-white">
                            <?php echo $formattedDate; ?>
                        </td>
                        </td>
                        <td class="bg-success text-white">
                            <?php echo $row['status'] ?>
                        </td>

                        <?php }
                                else if($row['status']==='Cancel')
                                { ?>
                        <td class="bg-danger text-white">
                            <?php echo $on++ ?>
                        </td>
                        <td class="bg-danger text-white">
                            <?php echo $row['Name'] ?>
                        </td>
                        <td class="bg-danger text-white">
                            <?php echo $row['Items']?>
                        </td>
                        <td class="bg-danger text-white">
                            <?php echo $row['Price'] ?>
                        </td>
                        <td class="bg-danger text-white">
                            <?php echo $formattedDate; ?>
                        </td>
                        <td class="bg-danger text-white">
                            <?php echo $row['status'] ?>
                        </td>

                        <?php }
                                 ?>

                    </tr>
                    <?php
                                }}
                            } 
                            else
                            { ?>
                    <script>
                    alert("Wromg Email or Password")
                    </script>'
                    <script>
                    location.href = "login.php"
                    </script>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <button type='button' class="btn btn-danger" onclick="location='logout.php'">LOG
            OUT</button>
        <button type='button' class="btn btn-warning" onclick="location='index.php'">BACK</button>
        <br><br><br><br>
    </div>
    <?php @include 'footer.php'; ?>
</body>
<script src="js/javascript1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>

</html>

<?php
}
else
{
    unset($_SESSION['menu'],$_SESSION['Reserve']);
    echo'<script>location.href = "login.php"</script>';
}
?>