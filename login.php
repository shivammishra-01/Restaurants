<?php
error_reporting(0);
@include 'config.php';
session_start();
if(isset($_SESSION['login']))
{
    echo'<script>location.href = "profile.php"</script>';
}
else{
if(isset($_POST['submit']))
{
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $sql="SELECT * FROM user_db WHERE email='$email'";
    $res=mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)==1)
    {
        $row=mysqli_fetch_assoc($res);
        $hash=password_verify($pass,$row['password']);
        if($hash)
        {
            $_SESSION['user']=$email;
            $_SESSION['login']=true;
            unset($_SESSION['admin']);
            if(isset($_SESSION['menu']))
            {
                echo'<script>location.href = "explore-menu.php"</script>';
            }
            else if(isset($_SESSION['Reserve']))
            {
                echo'<script>location.href = "Reserve.php"</script>';
            }
            else
            {
                echo'<script>location.href = "index.php"</script>';
            }
        }
        else
        {
            $error[] = 'Wrong Email or Password!';
            echo'<script>location.href = "login.php"</script>';
        }
    }
    else
    {
        $error[] = 'Wrong Email or Password!';
        echo'<script>location.href = "login.php"</script>';
    }
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
    <style>
    body {
        background: rgb(0, 0, 0, 0.6);
        color: #9aa9c1;
    }
    </style>
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
                                        <label class="form-label" for="form2Example17">Email address</label>
                                        <input type="email" id="form2Example17" name="email"
                                            class="form-control form-control-lg" autocomplete="off" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example27">Password</label>
                                        <input type="password" id="form2Example27" name="password"
                                            class="form-control form-control-lg" />
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button type="submit" class="btn btn-dark btn-lg btn-block" name="submit"
                                            type="button">Login</button>
                                    </div>

                                    <a class="small text-muted" href="forget.php">Forgot password?</a>
                                    <p class="pb-lg-2" style="color: #393f81;">Don't have an account? <a
                                            href="register_form.php" style="color: #393f81;">Register here</a></p>
                                    <p class="pb-lg-2" style="color: #393f81;">Are you Admin? <a href="admin.php"
                                            style="color: #393f81;">Click here</a></p>
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