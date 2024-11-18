<?php
@include 'config.php';
session_start();
error_reporting(0);
if(isset($_SESSION['admin']))
{
    date_default_timezone_set('Asia/Kolkata');
    if(isset($_POST['submit']))
    {
        $date=$_POST['date'];
        $_SESSION['date']=$date;
        echo'<script>location.href = "admindash.php"</script>';
    }
    $date=date('Y-m-d');
    if(isset($_POST['submit1']))
    {
        $email=$_POST['emailInput'];
        $sql="SELECT * FROM `admin` WHERE `admin`.`email`='$email'";
        $res=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($res);
        if($num>0)
        {
            echo'<script>alert("Admin Already Exist!")</script>';
            echo'<script>location.href = "admindash.php"</script>';
        }
        else
        {
            $timestamp = time();
            $date_time_string = date("Y-m-d H:i:s", $timestamp);
            $name=$_POST['nameInput'];
            $password=$_POST['passwordInput'];
            $cpassword=$_POST['cpasswordInput'];
            if($password===$cpassword)
            {
                $sql="INSERT INTO `admin` (`name`, `email`, `password`, `datetime`) VALUES ('$name', '$email', '$password', '$date_time_string')";
                $res=mysqli_query($conn,$sql);
                echo'<script>alert("Admin Added Successfully!")</script>';
                echo'<script>location.href = "admindash.php"</script>';
            }
            else
            {
                echo'<script>alert("Password Don not Match!")</script>';
                echo'<script>location.href = "admindash.php"</script>';
            }

        }
    }
    if(isset($_POST['submit2']))
    {
        $email=$_POST['emailInput'];
        if($email==="adminabhi@gmail.com")
        {
            echo'<script>alert("You Can not Delete Your Self!")</script>';
        }
        else
        {
            $sql="SELECT * FROM `admin` WHERE `admin`.`email`='$email'";
            $res = mysqli_query($conn,$sql);
            $num=mysqli_num_rows($res);
            if($num>0)
            {
                $sql="DELETE FROM admin WHERE `admin`.`email` = '$email'";
                $res=mysqli_query($conn,$sql);
                if($res)
                {
                    echo'<script>alert("Admin Delete Successfully!")</script>';
                    echo'<script>location.href = "admindash.php"</script>';
                }
            }
            else
            {
                echo'<script>alert("Admin is Not Exist!")</script>';
                echo'<script>location.href = "admindash.php"</script>';
            }

        }

    }
    if(isset($_POST['submit3']))
	{
		$email=$_SESSION['adminuser'];
    	$picture2 =explode("@", $email);
    	$picture = $picture2[0];
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$img_name=$_FILES['image']['name'];
        $tmp_name=$_FILES['image']['tmp_name'];
        $error=$_FILES['image']['error'];
        if($error===0)
        {
            $img_ex=pathinfo($img_name,PATHINFO_EXTENSION);
            // $img_ex = setImageFormat("jpg");
            $img_ex_lc=strtolower($img_ex);
            $allower_ex=array("jpg","jpeg","png");
            if(in_array($img_ex_lc,$allower_ex))
            {
                $new_img_name=str_replace(" ", "", $picture).'.'.$img_ex_lc;
                $img_upload_path='adminpic/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
                $sql="UPDATE `admin` SET `image` = '$new_img_name' WHERE `admin`.`email` = '$email'";
                mysqli_query($conn,$sql);
            }
        }
		$sql="UPDATE `admin` SET `name` = '$name', `phonenumber` = '$phone' WHERE `admin`.`email` = '$email'";
		mysqli_query($conn,$sql);
		echo'<script>location.href = "admindash.php"</script>';
	}
    if(isset($_POST['submit4']))
    {
        $month=$_POST['month'];
        $name=$_POST['foodname'];
        $sql="SELECT `name` FROM `food_menu` WHERE `name`='$name'";
        $res=mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)>0)
        {
            $date_str = $month;
            $date = date('F', strtotime($date_str)) . date('Y', strtotime($date_str));
            $sql1 = "SHOW COLUMNS FROM food_menu LIKE '$date'";
            $result1 = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($result1) > 0) 
            {
                $sql="SELECT `$date` FROM `food_menu` WHERE name='$name'";
                $res=mysqli_query($conn,$sql);
                $row=mysqli_fetch_assoc($res);
                $_SESSION['ItemCount']=$row[$date];
                $_SESSION['ItemCountF']=$name;
                $_SESSION['ItemCountT']=true;
                echo'<script>location.href = "admindash.php"</script>';
            }
            else
            {
                $_SESSION['ItemCountT']=false;
                unset($_SESSION['ItemCount']);
                echo'<script>alert("No Record is There")</script>';
                echo'<script>location.href = "admindash.php"</script>';
            }
        }
        else
        {
            $_SESSION['ItemCountT']=false;
            unset($_SESSION['ItemCount']);
            echo'<script>alert("Please Enter Correct Food Name")</script>';
            echo'<script>location.href = "admindash.php"</script>';
        }
    }
            ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCC | pkd | admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="image/fevicon.png">
</head>

<body class="d-flex flex-column min-vh-100 bg-info">
    <?php @include 'header.php'; ?>
    <?php 
                $email=$_SESSION['adminuser'];
                $sql="SELECT * FROM `admin` WHERE `admin`.`email`='$email'";
                $res=mysqli_query($conn,$sql);
                $row=mysqli_fetch_assoc($res);
                ?>
    <section>
        <div class="container" style="margin-top: 90px;">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-dark rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="index.php" class="text-white">Home</a></li>
                            <li class="breadcrumb-item"><a href="customer.php" class="text-white">Order List</a></li>
                            <li class="breadcrumb-item"><a href="customer_details.php" class="text-white">Customer
                                    Details</a></li>
                            <li class="breadcrumb-item"><a href="seecontactus.php" class="text-white">User Contact</a></li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="adminpic/<?= $row['image']; ?>" alt="avatar" class="rounded-circle img-fluid"
                                style="width: 150px;">
                            <h5 class="my-3">
                                <?php echo $row['name']; ?>
                            </h5>
                            <p class="text-muted mb-1">Centurion Coffee Connect</p>
                            <p class="text-muted mb-4">PKD, ODISHA 761211, INDIA</p>
                            <div class="d-flex justify-content-center mb-2">
                                <?php if($_SESSION['adminuser']==="adminabhi@gmail.com"){ ?>
                                <button type="button" class="btn btn-outline-warning ms-1" data-bs-toggle="modal"
                                    data-bs-target="#AddAdmin">Add</button>
                                <button type="button" class="btn btn-outline-danger ms-1" data-bs-toggle="modal"
                                    data-bs-target="#RemoveAdmin">Remove</button>
                                <?php    } ?>
                                <button type="button" class="btn btn-outline-success ms-1" data-bs-toggle="modal"
                                    data-bs-target="#UpdateAdmin">Update</button>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush rounded-3">
                                <form action="" method="post">
                                    <div class="col-sm">
                                        <input type="date" id="myDate" class="form-control btn btn-warning" name="date"
                                            value="<?php
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
                                </form>
                                <?php
                                        if(isset($_SESSION['date']))
                                                {
                                                    $date=$_SESSION['date'];
                                                    $sql1="SELECT * FROM `menu` WHERE DATE(datetime) = '$date' AND `status`='Recived'";
                                                    $sql2="SELECT * FROM `menu` WHERE DATE(datetime) = '$date' AND `status`='Cancel'";
                                                    $res1=mysqli_query($conn,$sql1);
                                                    $res2=mysqli_query($conn,$sql2);
                                                    $Recived=mysqli_num_rows($res1);
                                                    $Cancel=mysqli_num_rows($res2);
                                                    $_SESSION['Recived']=$Recived;
                                                    $_SESSION['Cancel']=$Cancel;
                                                }
                                                else
                                                {
                                                    $sql1="SELECT * FROM `menu` WHERE DATE(datetime) = '$date' AND `status`='Recived'";
                                                    $sql2="SELECT * FROM `menu` WHERE DATE(datetime) = '$date' AND `status`='Cancel'";
                                                    $res1=mysqli_query($conn,$sql1);
                                                    $res2=mysqli_query($conn,$sql2);
                                                    $Recived=mysqli_num_rows($res1);
                                                    $Cancel=mysqli_num_rows($res2);
                                                    $_SESSION['Recived']=$Recived;
                                                    $_SESSION['Cancel']=$Cancel;
                                                }?>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    Total Order
                                    <p class="mb-0">
                                        <?php echo $_SESSION['Recived']+$_SESSION['Cancel']; ?>
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    Cancel
                                    <p class="mb-0">
                                        <?php echo $_SESSION['Cancel']; ?>
                                    </p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    Recived
                                    <p class="mb-0">
                                        <?php echo $_SESSION['Recived']; ?>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo $row['name']; ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo $row['email']; ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Mobile</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo "+91 ".$row['phonenumber']; ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Joining Date</p>
                                </div>
                                <div class="col-sm-9">
                                    <?php $date_str = $row['datetime'];
                                    $date_obj = new DateTime($date_str);
                                    $formatted_time = $date_obj->format('Y-m-d'); ?>
                                    <p class="text-muted mb-0">
                                        <?php echo $formatted_time ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>

                    <div class="modal fade" id="AddAdmin" tabindex="-1" aria-labelledby="formModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="formModalLabel">Add your Addmin
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-dark">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div id="content1">
                                            <div class="mb-3 mt-4">
                                                <label for="nameInput" class="form-label">Name:</label>
                                                <input type="text" class="form-control" name="nameInput" required
                                                    autocomplete="off">
                                            </div>
                                            <div class="mb-3">
                                                <label for="numberInput" class="form-label">Email:</label>
                                                <input type="text" class="form-control" id="numberInput"
                                                    name="emailInput" autocomplete="off" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="numberInput" class="form-label">Password:</label>
                                                <input type="password" class="form-control" id="passwordInput"
                                                    name="passwordInput" autocomplete="off" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="passwordInput" class="form-label">Confirm Password:</label>
                                                <input type="password" class="form-control" id="cpasswordInput"
                                                    name="cpasswordInput" autocomplete="off" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="submit1"
                                                    class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="RemoveAdmin" tabindex="-1" aria-labelledby="formModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="formModalLabel">Remove your Addmin
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-dark">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div id="content1">
                                            <div class="mb-3">
                                                <label for="numberInput" class="form-label">Email:</label>
                                                <input type="text" class="form-control" id="numberInput"
                                                    name="emailInput" autocomplete="off" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="submit2"
                                                    class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="UpdateAdmin" tabindex="-1" aria-labelledby="formModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="formModalLabel">Plzz Do Not Submit Your Wrong Address
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-dark">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div id="content1">
                                            <div class="mb-3 mt-4">
                                                <label for="nameInput" class="form-label">Name:</label>
                                                <input type="text" class="form-control" id="nameInput" name="name"
                                                    required autocomplete="off" value="<?php echo $row['name']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="numberInput" class="form-label">Phone Number</label>
                                                <input type="text" class="form-control" id="numberInput" name="phone"
                                                    autocomplete="off" value="<?php echo $row['phonenumber']; ?>"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="numberInput" class="form-label">Profile Picture</label>
                                                <input type="file" class="form-control" name="image"
                                                    value="<?php echo $row['image']; ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="submit3"
                                                    class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="" method="post">
                        <div class="row g-3">
                            <div class="col ">
                                <input type="month" class="form-control bg-primary" name="month">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control bg-warning" placeholder="Food Name"
                                    name="foodname" autocomplete="off">
                            </div>
                            <div class="col">
                                <input type="submit" name="submit4" class="form-control btn-danger">
                            </div>
                        </div>
                    </form>
                    <div class="text-center bg-success text-white mt-3"><?php
                    if($_SESSION['ItemCountT'])
                    { ?>
                        Total Sell of <?php echo $_SESSION['ItemCountF'] ?> in this month is
                        <?php echo $_SESSION['ItemCount'] ?>
                        <?php } 
                        $sql="SELECT * FROM `user_db`";
                        $res=mysqli_query($conn,$sql);
                        $num=mysqli_num_rows($res);
                        $sum=0;
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $sum+=$row['star'];
                        }
                        ?>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="customRange1" class="form-label">Rating <span class="text-danger">(out of
                                    5)</span></label>
                            <input type="range" class="form-range" min="1" max="5" name="star" disabled
                                value="<?php echo $sum/$num ?>">
                        </div>
                    </div>

                    <!-- <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0">
                                <div class="card-body">
                                    <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project
                                        Status
                                    </p>
                                    <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 72%"
                                            aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 89%"
                                            aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0">
                                <div class="card-body">
                                    <p class="mb-4"><span class="text-primary font-italic me-1">check</span> your food
                                        sells
                                    </p>
                                    <p class="mb-1" style="font-size: .77rem;">select your date</p>
                                    <div class="progress rounded" style="height: 30px;">
                                        <input type="month" id="myDate" class="form-control btn btn-warning"
                                            name="month">
                                        <button style="width: 72%" class="btn btn-primary text-center">check</button>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Enter Your Food Name</p>
                                    <div class="progress rounded" style="height: 25px;"><input type="text"><button class="btn btn-info"
                                            style="width: 150px;">Submit</button>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 89%"
                                            aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>

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
}?>