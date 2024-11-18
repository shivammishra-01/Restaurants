<?php
@include 'config.php';
error_reporting(0);
if(isset($_POST['submit'])) {
    $email=$_POST['email'];
    $select = " SELECT * FROM user_db WHERE email = '$email'";
    $result = mysqli_query($conn, $select);
    if(mysqli_num_rows($result) > 0)
    {
        session_start();
        $otp=rand(1000,9999);
        $_SESSION['otp']=$otp;
        $_SESSION['email1']=$email;
        $_SESSION['forget']=true;
        $subject = "FORGET PASSWORD";
        $body = "Hii..\r\n\r\nyour forget password pin:".$otp."\r\n\r\nThank You!";
        $headers = "From:tiwaryabhishek74@gmail.com";
        mail($email, $subject, $body, $headers);
        echo'<script>location.href = "confirmotp.php"</script>';
    }
    else{
        echo"<script>alert('user is not exist!')</script>";
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
                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Forget your
                                        account</h5>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example17">Email address</label>
                                        <input type="email" id="form2Example17" name="email"
                                            class="form-control form-control-lg" autocomplete="off" />
                                    </div>
                                    <div class="pt-1 mb-4">
                                        <button type="submit" class="btn btn-dark btn-lg btn-block" name="submit"
                                            type="button">Forget</button>
                                    </div>
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a
                                            href="register_form.php" style="color: #393f81;">Register here</a></p>
                                    <a href="termcond.php" class="small text-muted">Terms of use.</a>
                                    <a href="privacypolocy.php" class="small text-muted">Privacy policy</a>
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