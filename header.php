<?php session_start(); 
@include 'config.php';
if(isset($_POST['submit1']))
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
            echo'<script>location.href = "index.php"</script>';
        }
    }
    else
    {
        echo'<script>location.href = "index.php"</script>';
    }
}
if(isset($_POST['submit2']))
{
    $email=$_POST['Aemail'];
    $pass=$_POST['Apassword'];
    $sql="SELECT * FROM admin WHERE email='$email' AND password='$pass'";
    $res=mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)==1)
    {
        $_SESSION['admin']=true;
        $_SESSION['adminuser']=$email;
        unset($_SESSION['login']);
        echo'<script>location.href = "index.php"</script>';

    }
    else{
        $error[] = 'Wrong Email or Password!';
    }
}
?>

<header>
    <nav class="navbar navbar-expand-lg navigation-wrap">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="image/logo.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gallery.php">Gallery</a>
                    </li>
                    <?php
                            @include 'config.php';
                             if(isset($_SESSION['admin']))
                            { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="additem.php">Update Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tablebooking.php">Booked Table</a>
                        <?php } 
                        else if(isset($_SESSION['login']))
                        { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="Reserve.php">Table Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="explore-menu.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#FAQ">FAQ</a>
                    </li>
                    <?php  }
                            else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="see-menu.php">Menu</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contactus.php">Contact Us</a>
                    </li><?php } ?>
                    <?php
                        if(isset($_SESSION['login'])){ 
                            $email= $_SESSION['user'];
                            $sql="SELECT * FROM `user_db` WHERE `user_db`.`email` = '$email'";
                            $res=mysqli_query($conn,$sql);
                            $num=mysqli_num_rows($res);
                            ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                                    if($num)
                                    {
                                        while($image=mysqli_fetch_assoc($res))
                                        {
                                        ?>
                            <img src="userpic/<?= $image['image'] ?>" alt="Profile" width="30" height="30"
                                class="rounded-circle me-2">
                            <?php  }} ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="edit_profile.php"><i class="fa-solid fa-user"></i>
                                    Profile</a></li>
                            <li><a class="dropdown-item" href="profile.php"><i class="fa-brands fa-first-order-alt"></i>
                                    My Order</a></li>

                            <li><a class="dropdown-item" href="logout.php"><i
                                        class="fa-solid fa-right-from-bracket"></i>
                                    Logout</a></li>
                            <li><a class="dropdown-item" href="passres.php"><i class="fa-solid fa-key"></i>
                                    Reset Password</a></li>
                        </ul>
                    </li>
                    <?php }
                       else if(isset($_SESSION['admin']))
                        { ?>
                    <li class="nav-item dropdown">
                        <?php $email = $_SESSION['adminuser'];
                        $admin="SELECT * FROM `admin` WHERE  `admin`.`email`= '$email'";
                        $res=mysqli_query($conn,$admin);
                        $adminpic=mysqli_fetch_assoc($res);
                        ?>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="adminpic/<?= $adminpic['image'] ?>" alt="Profile" width="30" height="30"
                                class="rounded-circle me-2">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="admindash.php"><i class="fa-solid fa-user"></i>
                                    Profile</a></li>
                            <li><a class="dropdown-item" href="customer_details.php"><i
                                        class="fa-sharp fa-solid fa-person-military-pointing"></i> Customer
                                    Details</a></li>

                            <li><a class="dropdown-item" href="customer.php"><i class="fa-solid fa-list"></i>
                                    Order List</a></li>
                            <li><a class="dropdown-item" href="logout.php"><i
                                        class="fa-solid fa-right-from-bracket"></i>
                                    Logout</a></li>
                        </ul>
                    </li>
                    <?php }
                       else{ ?>
                    <li class="nav-item mt-2">
                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                            data-bs-target="#LoginId">Login</button>
                    </li>
                    <li class="nav-item mt-2">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#SignUp">Sign
                            Up</button>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="modal fade" id="LoginId" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Welcome To CCC</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="col-sm">
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="showContent(1)">
                        User
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="showContent(2)">
                        Admin
                    </button>
                </div>
                <form action="" method="post">
                    <div id="content1">
                        <div class="mb-3 mt-4">
                            <label for="nameInput" class="form-label">User Email:</label>
                            <input type="email" class="form-control" id="nameInput" name="email" required
                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="numberInput" class="form-label">Password</label>
                            <input type="password" class="form-control" id="numberInput" name="password"
                                autocomplete="off" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="submit1" class="btn btn-primary">Submit</button>
                        </div>
                        <a class="small text-muted" href="forget.php">Forgot password?</a>
                    </div>
                </form>
                <form action="" method="post">
                    <div id="content2" style="display: none;">
                        <div class="mb-3 mt-4">
                            <label for="nameInput" class="form-label">Admin Email:</label>
                            <input type="email" class="form-control" id="nameInput" name="Aemail" required
                                autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="numberInput" class="form-label">Password</label>
                            <input type="password" class="form-control" id="numberInput" name="Apassword"
                                autocomplete="off" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="submit2" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="SignUp" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Welcome To CCC</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <input type="email" class="form-control" placeholder="Email Address here" id="email"
                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="email" required
                                autocomplete="off"><br>
                            <input type="name" class="form-control" placeholder="Name here" id="name" name="name"
                                autocomplete="off" required><br>
                            <input type="password" class="form-control" placeholder="Password here" id="password"
                                name="password" autocomplete="off" required><br>
                            <input type="password" class="form-control" placeholder="Confirm Password here"
                                id="cpassword" name="cpassword" autocomplete="off" required><br>
                        </div>
                        <div class="col-md-12 col-12 text-center">
                            <button class="main-btn" type="submit" name="submit">Submit</button>
                        </div>
                        <div class="col-md-12 col-12">
                            <p>I have an Account! <a href="login.php" class="link-danger">Login</a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function showContent(contentNum) {
    if (contentNum == 1) {
        // Show Content 1, hide Content 2
        document.getElementById("content1").style.display = "block";
        document.getElementById("content2").style.display = "none";
    } else if (contentNum == 2) {
        // Show Content 2, hide Content 1
        document.getElementById("content1").style.display = "none";
        document.getElementById("content2").style.display = "block";
    }
}
</script>