<?php
error_reporting(0);
@include 'config.php';
session_start();
if(isset($_SESSION['admin']))
{
    date_default_timezone_set('Asia/Kolkata');
    if(isset($_POST['submit']))
    {
        $date=$_POST['date'];
        $status=$_POST['status'];
        $_SESSION['date']=$date;
        $_SESSION['status']=$status;
        echo'<script>location.href = "customer.php"</script>';
    }
    if(isset($_POST['received']))
    {
        $time=$_POST['updateid'];
        $date=$_POST['updateid1'];
        $food_qnt=$_POST['foodqnt'];
        $sql="UPDATE `menu` SET `status` = 'Recived' WHERE `menu`.`datetime` = '$time' AND `menu`.`Items` = '$food_qnt'";
        mysqli_query($conn,$sql);
        $column_name=date('FY');
        $order_arr = explode(", ", $food_qnt);
        $menu_items = array();
        foreach ($order_arr as $item) 
        {
            $item_arr = explode("-", $item);
            $menu_items[$item_arr[0]] = $item_arr[1];
        }
        $sql1 = "SHOW COLUMNS FROM food_menu LIKE '$column_name'";
        $result1 = mysqli_query($conn, $sql1);
        if (mysqli_num_rows($result1) > 0) 
        {
            foreach ($menu_items as $item_name => $quantity) 
            {
            $sql = "SELECT $column_name FROM food_menu WHERE name='$item_name'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $current_quantity = $row[$column_name];
            $new_quantity = $current_quantity + $quantity;
            $sql = "UPDATE food_menu SET $column_name=$new_quantity WHERE name='$item_name'";
            mysqli_query($conn, $sql);
            echo'<script>location.href = "customer.php"</script>';
            }
        }
        else
        {
            $sql="ALTER TABLE `food_menu` ADD `$column_name` INT(20) ";  
            if(mysqli_query($conn,$sql))
            {
            foreach ($menu_items as $item_name => $quantity) 
            {
            $sql = "SELECT $column_name FROM food_menu WHERE name='$item_name'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $current_quantity = $row[$column_name];
            $new_quantity = $current_quantity + $quantity;
            $sql = "UPDATE food_menu SET $column_name=$new_quantity WHERE name='$item_name'";
            mysqli_query($conn, $sql);
            }
            echo'<script>location.href = "customer.php"</script>';
        }
        }
    }
    else if(isset($_POST['cancel']))
    {  
        $time=$_POST['updateid'];  
        $food_qnt=$_POST['foodqnt'];
        $sql="UPDATE `menu` SET `status` = 'Cancel' WHERE `menu`.`datetime` = '$time' AND `menu`.`Items` = '$food_qnt'";
        $res=mysqli_query($conn,$sql);
        if($res)
        {
            echo'<script>location.href = "customer.php"</script>';
        }
        else{
            echo"failed";
        }
    }
    $date=date('Y-m-d');
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
            <!-- <div class="col-md-6">
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
                        </h4><button type="button" class="btn btn-info btn-rounded"
                            onclick="location.href='foodhistory.php'">History</button>
                    </div>
                </div>
            </div> -->
        </div>
        <h2 class="pb-3 text-justify text-danger">ORDER DETAILS</h2>
        <div class="row g-3">
            <form action="" method="post">
                <div class="row g-6 mt-3">
                    <div class="col-sm">
                        <select id="inputState" class="form-select btn btn-dark" name="status">
                            <option value="All">All</option>
                            <option value="pending">Pending</option>
                            <option value="Recived">Recived</option>
                            <option value="Cancel">Cancel</option>
                        </select>
                    </div>
                    <div class="col-sm">
                        <input type="date" id="myDate" class="form-control btn btn-warning" name="date" value="<?php
                        if(isset($_SESSION['date']))
                        {
                            $date1=$_SESSION['date'];
                            $date_str = $date1;
                            $date2 = date('Y-m-d', strtotime($date_str));
                            echo $date2;
                        } 
                        else{
                            echo date('Y-m-d');
                         } ?>" placeholder="dd Mmm yyyy">
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
                        <th>CUSTOMER</th>
                        <th>TABLE</th>
                        <th>ITEM</th>
                        <th>PRICE</th>
                        <th>TIME</th>
                        <th>STATUS</th>
                        <th>PAYMENT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($conn){ 
                            if(isset($_SESSION['date']))
                            {
                                $date=$_SESSION['date'];
                                $status=$_SESSION['status'];
                                if($status==='Recived')
                                {
                                    $sql="SELECT * FROM `menu` WHERE DATE(datetime) = '$date' AND `status`= '$status' ORDER BY datetime DESC";
                                    $res=mysqli_query($conn,$sql);
                                    $num=mysqli_num_rows($res);
                                }
                                else if($status==='Cancel')
                                {
                                    $sql="SELECT * FROM `menu` WHERE DATE(datetime) = '$date' AND `status`= '$status' ORDER BY datetime DESC";
                                    $res=mysqli_query($conn,$sql);
                                    $num=mysqli_num_rows($res);
                                }
                                else if($status==='pending')
                                {
                                    $sql="SELECT * FROM `menu` WHERE DATE(datetime) = '$date' AND `status`= '$status' ORDER BY datetime DESC";
                                    $res=mysqli_query($conn,$sql);
                                    $num=mysqli_num_rows($res);
                                }
                                else
                                {
                                    $sql="SELECT * FROM `menu` WHERE DATE(datetime) = '$date' ORDER BY datetime DESC";
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
                                    $sql="SELECT * FROM `menu` WHERE DATE(datetime) = '$date' AND `status`= '$status' ORDER BY datetime DESC";
                                    $res=mysqli_query($conn,$sql);
                                    $num=mysqli_num_rows($res);
                                }
                                else if($status==='Cancel')
                                {
                                    $date=$_SESSION['date'];
                                    $sql="SELECT * FROM `menu` WHERE DATE(datetime) = '$date' AND `status`= '$status' ORDER BY datetime DESC";
                                    $res=mysqli_query($conn,$sql);
                                    $num=mysqli_num_rows($res);
                                }else if($status==='pending')
                                {
                                    $date=$_SESSION['date'];
                                    $sql="SELECT * FROM `menu` WHERE DATE(datetime) = '$date' AND `status`= '$status' ORDER BY datetime DESC";
                                    $res=mysqli_query($conn,$sql);
                                    $num=mysqli_num_rows($res);
                                }
                                else
                                {
                                    $sql="SELECT * FROM `menu` WHERE DATE(datetime) = '$date' ORDER BY datetime DESC";
                                    $res=mysqli_query($conn,$sql);
                                    $num=mysqli_num_rows($res);
                                }
                            }
                            if($num>0)
                            {
                                $on=1;
                                while($row=mysqli_fetch_assoc($res))
                                { 
                                    $date_str = $row['datetime'];
                                    $date_obj = new DateTime($date_str);
                                    $formatted_time = $date_obj->format('g:i a');?>

                    <tr>
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
                            <?php echo $row['paymentmode']; ?>
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
                            <?php echo $row['paymentmode']; ?>
                        </td>
                        <?php }
                        else { ?>
                        <td>
                            <?php echo $on++; ?>
                        </td>
                        <td>
                            <?php echo $row['Name']; ?>
                        </td>
                        <td>
                            <?php echo $row['Table.NO']; ?>
                        </td>
                        <td>
                            <?php echo $row['Items']; ?>
                        </td>
                        <td>
                            <?php echo $row['Price']; ?>
                        </td>
                        <td>
                            <?php echo $formatted_time; ?>
                        </td>
                        <td>
                            <?php echo $row['status']; ?>
                        </td>
                        <td>
                            <?php echo $row['paymentmode']; ?>
                        </td>
                        <td>
                            <div class='row'>
                                <form action="" method="POST">
                                    <input type="hidden" name="updateid" value="<?php echo $row['datetime']; ?>">
                                    <input type="hidden" name="foodqnt" value="<?php echo $row['Items']; ?>">
                                    <button type="submit" name="received" class="btn btn-success">Received</button>
                                    <button type="submit" name="cancel" class="btn btn-danger">Cancel</button>
                                </form>
                            </div>
                        </td>
                        <?php } ?>
                    </tr>
                    <?php } } } ?>
                </tbody>
            </table>
        </div>
        <div class="mt-4">
        <button type='button' class="btn btn-warning" onclick="location='foodhistory.php'">HISTORY</button>
    </div></div>
    <div class="mt-4"></div>
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