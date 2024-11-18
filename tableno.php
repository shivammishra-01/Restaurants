<?php
error_reporting(0);
@include 'config.php';
session_start();
if(isset($_SESSION['login']))
{
    date_default_timezone_set('Asia/Kolkata');
    $email=$_SESSION['user'];
     if(isset($_POST['cancel']))
    {  
        $datetime=$_POST['datetime'];  
        $sql="UPDATE `tableno` SET `status` = 'Cancel' WHERE `tableno`.`datetime` = '$datetime' AND `tableno`.`email` = '$email'";
        $res=mysqli_query($conn,$sql);
        if($res)
        {
            echo'<script>location.href = "tableno.php"</script>';
        }
        else{
            echo"failed2";
        }
    }
    if(isset($_POST['visit']))
    {  
        $datetime=$_POST['datetime'];  
        $sql="UPDATE `tableno` SET `status` = 'visited' WHERE `tableno`.`datetime` = '$datetime' AND `tableno`.`email` = '$email'";
        $res=mysqli_query($conn,$sql);
        if($res)
        {
            echo'<script>location.href = "tableno.php"</script>';
        }
        else{
            echo"failed2";
        }
    }
    $date=date('Y-m-d');
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
                    <?php  $adminuser = $_SESSION['user'];
                    $sql="SELECT * FROM `user_db` WHERE `email` = '$adminuser'";
                    $res= mysqli_query($conn,$sql);
                    $image=mysqli_fetch_assoc($res); ?>
                    <div class="card-body text-center">
                        <img src="userpic/<?=$image['image'] ?>" alt="Profile Photo" class="rounded-circle"
                            style="width: 200px">
                        <h4 class="mt-2">
                            <?php
                            echo '<span class="error-msg">'.$image['name'].'</span>';
                            ?>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <h2 class="pb-3 text-justify text-danger">Table Booked</h2>
        <!-- <input class="mt-2" type="text" name="" id="" placeholder="search by name.."> -->
        <div class="table-responsive" id="no-more-tables">
            <table class="table bg-warning mt-2">
                <thead class="bg-dark text-light">
                    <tr>
                        <th>SL.NO</th>
                        <th>CUSTOMER NAME</th>
                        <th>PHONE NUMBER</th>
                        <th>TABLE NUMBER</th>
                        <th>DATE</th>
                        <th>STIME</th>
                        <th>ETIME</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($conn){
                                $sql="SELECT * FROM `tableno` WHERE email='$adminuser' ORDER BY datetime ASC";
                                $res= mysqli_query($conn,$sql);
                                $on=1;
                                while($row=mysqli_fetch_assoc($res))
                                { 
                                    $date_str = $row['start_time'];
                                    $date_obj = new DateTime($date_str);
                                    $formatted_time = $date_obj->format('g:i a');
                                    $date_str = $row['end_time'];
                                    $date_obj = new DateTime($date_str);
                                    $formatted_time2 = $date_obj->format('g:i a');?>

                    <tr>
                        <?php if($row['status']=="visited") { ?>
                        <td class="bg-success text-white">
                            <?php echo $on++; ?>
                        </td>
                        <td class="bg-success text-white">
                            <?php echo $row['name']; ?>
                        </td>
                        <td class="bg-success text-white">
                            <?php echo $row['phonenumber']; ?>
                        </td>
                        <td class="bg-success text-white">
                            <?php echo $row['table_number']; ?>
                        </td>
                        <td class="bg-success text-white">
                            <?php echo $row['date']; ?>
                        </td>
                        <td class="bg-success text-white">
                            <?php echo $formatted_time; ?>
                        </td>
                        <td class="bg-success text-white">
                            <?php echo $formatted_time2; ?>
                        </td>
                        <td class="bg-success text-white">
                            <?php echo $row['status']; ?>
                        </td>
                        <?php } if($row['status']=="confirm") { ?>
                        <td class="bg-primary text-white">
                            <?php echo $on++; ?>
                        </td>
                        <td class="bg-primary text-white">
                            <?php echo $row['name']; ?>
                        </td>
                        <td class="bg-primary text-white">
                            <?php echo $row['phonenumber']; ?>
                        </td>
                        <td class="bg-primary text-white">
                            <?php echo $row['table_number']; ?>
                        </td>
                        <td class="bg-primary text-white">
                            <?php echo $row['date']; ?>
                        </td>
                        <td class="bg-primary text-white">
                            <?php echo $formatted_time; ?>
                        </td>
                        <td class="bg-primary text-white">
                            <?php echo $formatted_time2; ?>
                        </td>
                        <td class="bg-primary text-white">
                            <?php echo $row['status']; ?>
                        </td>
                        <td>
                            <div class='row'>
                                <form action="" method="POST">
                                    <input type="hidden" name="datetime" value="<?php echo $row['datetime']; ?>">
                                    <button type="submit" name="cancel" class="btn btn-danger">cancel</button>
                                    <button type="submit" name="visit" class="btn btn-danger">Visit</button>
                                </form>
                            </div>

                        </td>
                        <?php } else if($row['status']==='Cancel')
                        {  ?>
                        <td class="bg-danger text-white">
                            <?php echo $on++; ?>
                        </td>
                        <td class="bg-danger text-white">
                            <?php echo $row['name']; ?>
                        </td>
                        <td class="bg-danger text-white">
                            <?php echo $row['phonenumber']; ?>
                        </td>
                        <td class="bg-danger text-white">
                            <?php echo $row['table_number']; ?>
                        </td>
                        <td class="bg-danger text-white">
                            <?php echo $row['date']; ?>
                        </td>
                        <td class="bg-danger text-white">
                            <?php echo $formatted_time; ?>
                        </td>
                        <td class="bg-danger text-white">
                            <?php echo $formatted_time2; ?>
                        </td>
                        <td class="bg-danger text-white">
                            <?php echo $row['status']; ?>
                        </td>
                        <?php } ?>

                    </tr>
                    <?php  } } ?>
                </tbody>
            </table>
        </div>
        <button type='button' class="btn btn-danger" onclick="location='logout.php'">LOG
            OUT</button>
        <button type='button' class="btn btn-warning" onclick="location='index.php'">BACK</button>
    </div>
    <div class="mt-4"></div>
    <?php @include 'footer.php'; ?>
</body>
<script src="js/javascript1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>

</html>
<?php }
else
{
    echo'<script>location.href = "admin.php"</script>';
} ?>