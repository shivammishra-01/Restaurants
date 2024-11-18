<?php
@include 'config.php';

session_start();
if(!isset($_SESSION['otp']))
{
    echo'<script>location.href = "forget.php"</script>';
}
if(isset($_POST['submit']))
{
    $pass=$_POST['pass'];
    $cpass=$_POST['cpass'];
    $email=$_SESSION['email1'];
    if($cpass==$pass)
    {
        $hash=password_hash($pass,PASSWORD_DEFAULT);
        $sql="UPDATE `user_db` SET `password` = '$hash' WHERE `user_db`.`email` = '$email'";
        $res=mysqli_query($conn,$sql);
        if($res)
        {
            echo"<script>alert('Password change')</script>";
            echo'<script>location.href = "login.php"</script>';

        }
        else{
            echo"<script>alert('Try again')</script>";
        }
    }
    else{
        $error[]="Password do not match!";
    }
}
?>
<!doctype html>
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
</head>

<body class="d-flex flex-column min-vh-100 bg-info">
    <?php @include 'header.php'; ?>
    <div class="container" style="margin-top: 90px;">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="image/login.jpg" alt="login form" class="img-fluid"
                                style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">

                                <form action="" method="post">

                                    <div class="d-flex align-items-center mb-3 pb-1"><i
                                            class="fa-sharp fa-solid fa-wreath"></i>
                                        <span class="h1 fw-bold mb-0">Welcome</span>
                                    </div>
                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Login your
                                        account</h5>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example27">New Password</label>
                                        <input type="password" id="form2Example27" name="pass"
                                            class="form-control form-control-lg" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example27">Confirm Password</label>
                                        <input type="password" id="form2Example27" name="cpass"
                                            class="form-control form-control-lg" />
                                    </div>
                                    <div class="pt-1 mb-4">
                                        <button type="submit" class="btn btn-dark btn-lg btn-block" name="submit"
                                            type="button">Confirm</button>
                                    </div>
                                    <a href="#!" class="small text-muted">Terms of use.</a>
                                    <a href="#!" class="small text-muted">Privacy policy</a>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php @include 'footer.php'; ?>
</body>
<script src="js/javascript1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>

</html>