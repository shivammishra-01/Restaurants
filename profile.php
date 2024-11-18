<?php
error_reporting(0);
@include 'config.php';
session_start();
unset($_SESSION['Gateway']);
date_default_timezone_set('Asia/Kolkata');
if(isset($_SESSION['login']))
{

    $email=$_SESSION['user'];
    $select = "SELECT * FROM user_db WHERE email = '$email'";
    $result = mysqli_query($conn, $select);
    $row1=mysqli_fetch_assoc($result);
    if(isset($_POST['received']))
    {
        $email=$_SESSION['user'];
        $time=$_POST['updateid'];
        $food_qnt=$_POST['foodqnt'];
        $sql="UPDATE `menu` SET `status` = 'Recived' WHERE `menu`.`datetime` = '$time' AND `menu`.`email` = '$email'";
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
            echo'<script>location.href = "profile.php"</script>';
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
            echo'<script>location.href = "profile.php"</script>';
        }
        }
    }
    else if(isset($_POST['cancel']))
    {  
        $email=$_SESSION['user'];
        $time=$_POST['updateid'];   
        $sql="UPDATE `menu` SET `status` = 'Cancel' WHERE `menu`.`datetime` = '$time' AND `menu`.`email` = '$email'";
        $res=mysqli_query($conn,$sql);
        if($res)
        {
            echo'<script>location.href = "profile.php"</script>';
        }
        else{
            echo"failed2";
        }
    }
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
                        <button type="button" class="btn btn-info btn-rounded"
                            onclick="location.href='userhistory.php'">History</button>

                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive" id="no-more-tables">
            <div class="text-white fs-5">
                <?php date_default_timezone_set('Asia/Kolkata');
                 echo date('d M Y'); ?></div>
            <table class="table bg-warning mt-2">
                <thead class="bg-dark text-light">
                    <tr>
                        <th>SI.NO</th>
                        <th>Name</th>
                        <th>Items</th>
                        <th>Price</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                            $select = "SELECT * FROM user_db WHERE email = '$email'";
                            $result = mysqli_query($conn, $select);
                            if(mysqli_num_rows($result)==1)
                            {
                                $select = "SELECT * FROM `menu` WHERE email ='$email' ORDER BY datetime DESC LIMIT 5";
                                $result = mysqli_query($conn, $select);
                                $on=1;
                                while($row=mysqli_fetch_assoc($result))
                                { 
                                    $date_str = $row['datetime'];
                                    $date_obj = new DateTime($date_str);
                                    $formatted_time = $date_obj->format('g:i a'); ?>
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
                            <?php echo $formatted_time; ?>
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
                            <?php echo $formatted_time; ?>
                        </td>
                        <td class="bg-danger text-white">
                            <?php echo $row['status'] ?>
                        </td>

                        <?php }
                                else
                                { ?>
                        <td>
                            <?php echo $on++ ?>
                        </td>
                        <td>
                            <?php echo $row['Name'] ?>
                        </td>
                        <td>
                            <?php echo $row['Items']?>
                        </td>
                        <td>
                            <?php echo $row['Price'] ?>
                        </td>
                        <td>
                            <?php echo $formatted_time; ?>
                        </td>
                        <td>
                            <?php echo $row['status'] ?>
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
                        <?php }
                                 ?>

                    </tr>
                    <?php
                                }
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
        <div class="mt-4">
        <button type='button' class="btn btn-danger" onclick="location='logout.php'">LOG
            OUT</button>
        <button type='button' class="btn btn-warning" onclick="location='index.php'">BACK</button>
        </div>

    </div>
    <div class="mt-4"></div>
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