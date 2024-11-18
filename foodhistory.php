<?php
error_reporting(0);
@include 'config.php';
session_start();
if(isset($_SESSION['admin']))
{
    date_default_timezone_set('Asia/Kolkata');
    if(isset($_POST['submit']))
    {
        $status=$_POST['status'];
        $_SESSION['status']=$status;
        echo'<script>location.href = "foodhistory.php"</script>';
    }
    
    $adminuser = $_SESSION['adminuser'];
    $sql="SELECT * FROM `admin` WHERE `email` = '$adminuser'";
    $res= mysqli_query($conn,$sql);
    $image=mysqli_fetch_assoc($res);
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
                        <img src="adminpic/<?=$image['image'] ?>" alt="Profile Photo" class="rounded-circle"
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
        <h2 class="pb-3 text-justify text-danger">HISTORY</h2>
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
                        <button type="submit" class="form-control btn btn-primary" name="submit"
                            aria-label="Zip">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- <input class="mt-2" type="text" name="" id="" placeholder="search by name.."> -->
        <div class="table-responsive" id="no-more-tables">
            <table class="table bg-warning mt-2">
                <thead class="bg-dark text-light">
                    <tr>
                        <th>SL.NO</th>
                        <th>CUSTOMER NAME</th>
                        <th>TABLE NUMBER</th>
                        <th>ITEM</th>
                        <th>TOTAL PRICE</th>
                        <th>ORDER TIME</th>
                        <th>STATUS</th>
                        <th>RECEIPT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($conn){ 
                            if(isset($_SESSION['status']))
                            {
                                $status=$_SESSION['status'];
                                if($status==='Recived')
                                {
                                    $sql="SELECT * FROM `menu` WHERE `status`= '$status' ORDER BY datetime DESC";
                                    $res=mysqli_query($conn,$sql);
                                    $num=mysqli_num_rows($res);
                                }
                                else if($status==='Cancel')
                                {
                                    $sql="SELECT * FROM `menu` WHERE  `status`= '$status' ORDER BY datetime DESC";
                                    $res=mysqli_query($conn,$sql);
                                    $num=mysqli_num_rows($res);
                                }
                                else
                                {
                                    $sql="SELECT * FROM `menu` ORDER BY datetime DESC";
                                    $res=mysqli_query($conn,$sql);
                                    $num=mysqli_num_rows($res);
                                }
                            }
                            else
                            {
                                $status=$_SESSION['status'];
                                if($status==='Recived')
                                {
                                    $date=$_SESSION['date'];
                                    $sql="SELECT * FROM `menu` WHERE  `status`= '$status' ORDER BY datetime DESC";
                                    $res=mysqli_query($conn,$sql);
                                    $num=mysqli_num_rows($res);
                                }
                                else if($status==='Cancel')
                                {
                                    $date=$_SESSION['date'];
                                    $sql="SELECT * FROM `menu` WHERE  `status`= '$status' ORDER BY datetime DESC";
                                    $res=mysqli_query($conn,$sql);
                                    $num=mysqli_num_rows($res);
                                }
                                else
                                {
                                    $sql="SELECT * FROM `menu` ORDER BY datetime DESC";
                                    $res=mysqli_query($conn,$sql);
                                    $num=mysqli_num_rows($res);
                                }
                            }
                            if($num>0)
                            {
                                $on=1;
                                while($row=mysqli_fetch_assoc($res))
                                { 
                                    $dateStr = $row['datetime'];
                                    $dateObj = strtotime($dateStr);
                                    $formatted_time = date('j F Y h:i A', $dateObj);
                                    $formatted_time1 = date('j F Y', $dateObj);

                                    ?>

                    <tr>

                        <form action="Allbill.php" method="post">
                            <?php if($row['status']==='Recived')
                        {
                        ?>
                            <td class="bg-success text-white">
                                <?php echo $on++; ?>
                            </td>
                            <td class="bg-success text-white">
                                <?php echo $row['Name']; ?>
                            </td>
                            <td class="bg-success text-white">
                                <?php echo $row['Table.NO']; ?>
                            </td>
                            <td class="bg-success text-white">
                                <?php echo $row['Items']; ?>
                            </td>
                            <td class="bg-success text-white">
                                <?php echo $row['Price']; ?>
                            </td>
                            <td class="bg-success text-white">
                                <?php echo $formatted_time; ?>
                            </td>
                            <td class="bg-success text-white">
                                <?php echo $row['status']; ?>
                            </td>
                            <td class="bg-success text-white">
                                <input type="hidden" name="foodqnt1" value="<?php echo $row['Items']; ?>">
                                <input type="hidden" name="foodprice1" value="<?php echo $row['Price']; ?>">
                                <input type="hidden" name="foodname1" value="<?php echo $row['Name']; ?>">
                                <input type="hidden" name="foodstatus1" value="<?php echo $row['status']; ?>">
                                <input type="hidden" name="foodtime1" value="<?php echo $formatted_time1; ?>">
                                <input type="hidden" name="foodtime1" value="<?php echo $formatted_time1; ?>">
                                <input type="hidden" name="foodpayment1" value="<?php echo $row['paymentmode']; ?>">
                                <button type="submit" name="submit1" class="btn btn-info">Receipt</button>
                            </td>
                            <?php } else if($row['status']==='Cancel')
                        {  ?>
                            <td class="bg-danger text-white">
                                <?php echo $on++; ?>
                            </td>
                            <td class="bg-danger text-white">
                                <?php echo $row['Name']; ?>
                            </td>
                            <td class="bg-danger text-white">
                                <?php echo $row['Table.NO']; ?>
                            </td>
                            <td class="bg-danger text-white">
                                <?php echo $row['Items']; ?>
                            </td>
                            <td class="bg-danger text-white">
                                <?php echo $row['Price']; ?>
                            </td>
                            <td class="bg-danger text-white">
                                <?php echo $formatted_time; ?>
                            </td>
                            <td class="bg-danger text-white">
                                <?php echo $row['status']; ?>
                            </td>
                            <td class="bg-danger text-white">
                                <input type="hidden" name="foodqnt1" value="<?php echo $row['Items']; ?>">
                                <input type="hidden" name="foodprice1" value="<?php echo $row['Price']; ?>">
                                <input type="hidden" name="foodname1" value="<?php echo $row['Name']; ?>">
                                <input type="hidden" name="foodtime1" value="<?php echo $formatted_time1; ?>">
                                <input type="hidden" name="foodstatus1" value="<?php echo $row['status']; ?>">
                                <button type="submit" name="submit1" class="btn btn-info">Receipt</button>
                            </td>
                            <?php } ?>
                        </form>
                    </tr>
                    <?php 
                                }
                                 }
                        }
                        ?>
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
else {
    echo'<script>location.href = "admin.php"</script>';
} 
?>