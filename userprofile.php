<?php 
session_start();
@include 'config.php';
if(isset($_SESSION['admin']))
{
    if(isset($_POST['submit']))
    {
        $email=$_POST['customer'];
        $_SESSION['customer']=$email;
        echo'<script>location.href = "userprofile.php"</script>';
    }
    $email1 = $_SESSION['customer'];
    $sql = "SELECT * FROM `user_db` WHERE `email` = '$email1'";
    $res = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($res);
    $row = mysqli_fetch_assoc($res);
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
    body {
        background: rgb(0, 0, 0, 0.6);
        color: red;
    }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-info">
    <?php @include 'header.php' ;?>
    <section>
        <div class="container py-5" style="margin-top: 40px;">

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="userpic/<?= $row['image'] ?>" alt="avatar" class="rounded-circle img-fluid"
                                style="width: 150px;">
                            <h5 class="my-3">
                                <?php echo $row['name']; ?>
                            </h5>
                            <p class="text-muted mb-4"><?php echo $row['city'],', ',$row['state'],', ';?> INDIA</p>
                            <div class="d-flex justify-content-center mb-2">
                            </div>
                        </div>
                    </div>
                    <?php 
                            $email=$_SESSION['customer'];
                            $sql1="SELECT * FROM `menu` WHERE `email`='$email' AND `status`='Cancel'";
                            $res1=mysqli_query($conn,$sql1);
                            $sql2="SELECT * FROM `menu` WHERE `email`='$email' AND `status`='Recived'";
                            $res2=mysqli_query($conn,$sql2);
                            $num1=mysqli_num_rows($res1);
                            $num2=mysqli_num_rows($res2);
                            ?>
                    <div class="card mb-4 mb-lg-0 text-center">
                        <div class="card-body p-0">
                            <h5 class="text-center mt-2 text-primary">STATUS</h5>
                            <ul class="list-group list-group-flush rounded-3">
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center p-3 bg-primary">
                                    <i class="fa-lg text-white"><?php echo $num1+$num2 ?></i>
                                    <p class="mb-0 text-white">Total Order</p>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center p-3 bg-success">
                                    <i class="fa-lg text-white"><?php echo $num2 ?></i>
                                    <p class="mb-0 text-white">Received</p>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center p-3 bg-danger">
                                    <i class="fa-lg text-white"><?php echo $num1 ?></i>
                                    <p class="mb-0 text-white">Cancel</p>
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
                                        <?php echo $row['name'];?>
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
                                        <?php 
                                     echo $email ;?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">+91
                                        <?php echo $row['phone'];?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Pin Code</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo $row['pincode'];?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo $row['city'],', ',$row['state'],', ';?> INDIA
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="customRange1" class="form-label text-dark">Feedback </label>
                            <input type="range" class="form-range" min="1" max="5" name="star"
                                value="<?php echo $row['star'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label text-dark"">Suggestion to us</label>
                                <textarea class=" form-control" id="exampleFormControlTextarea1" rows="3" name="desc"
                                readonly maxlength="255"><?php echo $row['feedbacksummary']; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</body>
<script src="js/javascript1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>

</html>
<?php } 
else
{
	echo'<script>location.href = "index.php"</script>';
}
?>