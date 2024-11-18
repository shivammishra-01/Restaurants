<?php
error_reporting(0);
@include 'config.php';
session_start();
date_default_timezone_set('Asia/Kolkata');
unset($_SESSION['date'],$_SESSION['status']);
if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $select = " SELECT * FROM user_db WHERE email = '$email'";
    $result = mysqli_query($conn, $select);
    if(mysqli_num_rows($result) > 0)
    {
        echo'<script>alert("User Already Exist!")</script>';
        echo'<script>location.href = "index.php"</script>';
    }
    else
    {
        $name = $_POST['name'];
        $pass=$_POST['password'];
        $cpass=$_POST['cpassword'];
        if($pass==$cpass)
        {
            $timestamp = time();
            $date_time_string = date("Y-m-d H:i:s", $timestamp);
            $hash=password_hash($pass,PASSWORD_DEFAULT);
            $insert = "INSERT INTO `user_db` (`name`, `email`, `password`, `datetime`) VALUES ('$name', '$email', '$hash', '$date_time_string')";
            mysqli_query($conn, $insert);
            $subject = "WELCOME TO CUTM COFFEE CONNECT";
            $body = "Hii..\r\n".$name."\r\n\r\nyour registration is successfull\r\n\r\nThank You!";
            $headers = "From:tiwaryabhishek74@gmail.com";
            mail($email, $subject, $body, $headers);
            echo'<script>location.href = "login.php"</script>';
        }
        else
        {
            echo'<script>alert("Password Not Match!")</script>';
            echo'<script>location.href = "index.php"</script>';
        }
    }
}
if($_SESSION['Gateway'])
{
   $email=$_SESSION['Gatewayemail'];
   $sql="SELECT * FROM user_db WHERE email='$email'";
   $res=mysqli_query($conn,$sql);
   if(mysqli_num_rows($res)==1)
   {
            $_SESSION['user']=$email;
            $_SESSION['login']=true;    
            echo'<script>location.href = "profile.php"</script>';
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
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="image/fevicon.png">
    <style>
    .carousel-item img {
        height: 500px;
        width: 500px;
        object-fit: cover;
    }

    @media (max-width: 768px) {
        .carousel-item img {
            height: 300px;
            width: 400px;
        }
    }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php @include 'header.php'; ?>
    <div id="carouselExampleIndicators" class="carousel slide mt-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"
                aria-label="Slide 5"></button>
        </div>
        <div class="carousel-inner mt-3">
            <div class="carousel-item active">
                <img src="ImageGallery/1.jpg" class="d-block w-100" alt="..." height="">
            </div>
            <div class="carousel-item">
                <img src="ImageGallery/2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="ImageGallery/5.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="ImageGallery/4.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="ImageGallery/7.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <section id="counter">
        <section class="counter-section">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-3 mb-lg-0 mb-md-0 mb-5">
                        <h2>
                            <?php $sql="SELECT * FROM `menu`";
                                $res=mysqli_query($conn,$sql);
                                $num=mysqli_num_rows($res);
                                 ?>
                            <input type="hidden" id="order" value="<?php echo $num ?>">
                            <span id="count1"></span>+
                        </h2>
                        <p>ORDER</p>
                    </div>
                    <div class="col-md-3 mb-lg-0 mb-md-0 mb-5">
                        <h2>
                            <span id="count2"></span>+
                        </h2>
                        <p>PHOTOS</p>
                    </div>
                    <div class="col-md-3 mb-lg-0 mb-md-0 mb-5">
                        <h2><?php $sql="SELECT * FROM `food_menu`";
                                $res=mysqli_query($conn,$sql);
                                $num=mysqli_num_rows($res);
                                 ?><input type="hidden" id="item" value="<?php echo $num ?>">
                            <span id="count3"></span>+
                        </h2>
                        <p>ITEM</p>
                    </div>
                    <div class="col-md-3 mb-lg-0 mb-md-0 mb-5">
                        <h2>
                            <?php $sql="SELECT * FROM `user_db`";
                                $res=mysqli_query($conn,$sql);
                                $num=mysqli_num_rows($res); ?>
                            <input type="hidden" id="user" value="<?php echo $num ?>">
                            <span id="count4"></span>+
                        </h2>
                        <p>CUSTOMERS</p>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <section id="about">
        <div class="about-section wrapper">
            <div class="container">
                <div class="row align-item-center">
                    <div class="col-lg-7 col-md-12 mb-lg-0 mb-5">
                        <div class="card border-0">
                            <video autoplay loop muted src="ImageGallery/Video2.mp4"></video>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 text-sec">
                        <h2>ABOUT US</h2>
                        <p>"At ccc, we're passionate about providing an authentic and memorable dining
                            experience. Our chefs use fresh, locally-sourced ingredients to create flavorful dishes
                            that
                            reflect our love for Italian, French, Mexican, Chinese, Indian and many others. Our
                            team is dedicated to providing exceptional service
                            and making every guest feel at home."</p>
                        <button class="main-btn mt-4" onclick="location.href='about.php'">Learn More</button>
                    </div>
                </div>
            </div>
            <div class="container food-type">
                <div class="row align-item-center">
                    <div class="col-lg-5 col-md-12 text-sec mb-lg-0 mb-5">
                        <h2>We Make everythink by hand with the best possible ingredients.</h2>
                        <p>At our restaurant, we take pride in creating every dish by hand with only the best
                            possible
                            ingredients. From the freshest produce to the finest cuts of meat, we carefully select
                            each
                            element to ensure that every bite is bursting with flavor. Our commitment to quality and
                            attention to detail is evident in every dish we serve, making every meal a truly
                            unforgettable experience. So come join us and taste the difference that handmade,
                            premium
                            ingredients can make.</p>
                        <ul class="list-unstyled py-3">
                            <li>"Delicious food that delights"</li>
                            <li>"Taste the difference with us"</li>
                            <li>"Fresh and flavorful cuisine"</li>
                        </ul>
                        <button class="main-btn mt-4">Learn More</button>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <div class="card border-0">
                            <img src="image/menu.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="story">
        <div class="story-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-content">
                            <h2>"Our food is so good, it'll make you forget your ex's name!"</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="explore-food">
        <div class="explore-food wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-content text-center">
                            <h2>Explore Our Foods</h2>
                            <p>When you explore our food, you'll discover an enticing variety of flavors and
                                textures
                                expertly crafted by our talented chefs. From fresh, locally sourced ingredients to
                                carefully selected spices and seasonings, every dish is a celebration of culinary
                                artistry.</p>
                        </div>
                    </div>
                </div>
                <div class="row pt-5">
                    <div class="col-lg-4 col-md-6 mb-lg-0 mb-5">
                        <div class="card">
                            <img src="Food/ALOO TIKKI.jpg" class="img-fluid" alt="" style="height: 235px;">
                            <div class="pt-3">
                                <h4>Aloo Tikki</h4>
                                <p>Time: 10 - 15 Minutes | Servers: 1</p>
                                <span>₹25 <del>₹40</del></span>
                                <button class="mt-4 main-btn" onclick="location='explore-menu.php'">Order
                                    Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-lg-0 mb-5">
                        <div class="card">
                            <img src="Food/CHICKEN POTIE.jpg" class="img-fluid" alt="" style="height: 235px;">
                            <div class="pt-3">
                                <h4>Chicken Potie</h4>
                                <p>Time: 20 - 25 Minutes | Servers: 1</p>
                                <span>₹30 <del>₹50</del></span>
                                <button class="mt-4 main-btn" onclick="location='explore-menu.php'">Order
                                    Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-lg-0 mb-5">
                        <div class="card">
                            <img src="Food/coffee.jpg" class="img-fluid" alt="" style="height: 235px;">
                            <div class="pt-3">
                                <h4>Coffee</h4>
                                <p>Time: 5 - 10 Minutes | Servers: 1</p>
                                <span>₹25 <del>₹30</del></span>
                                <button class="mt-4 main-btn" onclick="location='explore-menu.php'">Order
                                    Now</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section id="FAQ">
        <div class="faq wrapper" data-aos="zoom-in-down">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center pb-4">
                            <h2>Frequently Asked Question</h2>
                        </div>
                    </div>
                </div>
                <div class="row pt-5">
                    <div class="col-sm-6 mb-4">
                        <h4><span>~</span>Can I make a reservation at your restaurant?</h4>
                        <p>Yes, we accept reservations. You can make a reservation by calling us at
                            <span>+91 9437268679</span> or through our website.
                        </p>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <h4><span>~</span>Are there vegetarian/vegan options on your menu?</h4>
                        <p>Yes, we offer vegetarian/vegan options on our menu. Please check our menu online or ask
                            your
                            server for recommendations.</p>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <h4><span>~</span>Do you offer takeout or delivery?</h4>
                        <p>Yes, we offer takeout and delivery services. You can order online through our website or
                            call
                            us at <span>+91 9437268679</span>.</p>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <h4><span>~</span>What are your restaurant's hours of operation?</h4>
                        <p>Our restaurant is open<span> Monday, Tuesday, Wednessday, Thursday, Friday, Saturday from
                                10:00 am to 8:00 pm.</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="book-food">
        <div class="book-food">
            <div class="container book-food-text">
                <div class="row text-center">
                    <div class="col-lg-9 col-md-12">
                        <h2>Baked fresh daily by bakers with passion.</h2>
                    </div>
                    <div class="col-lg-3 clo-md-12 mt-lg-0 mt-4">
                        <button class="main-btn">Learn more</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    if(!isset($_SESSION['login'])){ ?>
    <section id="newsletter">
        <div class="newsletter wrapper">
            <div class="container">
                <div class="col-sm-12">
                    <div class="text-content text-center pb-4">
                        <h2>Sign Up</h2>
                    </div>
                    <form action="" method="post" class="newsletter">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <input type="email" class="form-control" placeholder="Email Address here" id="email"
                                    name="email" required autocomplete="off"><br>
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
    </section>
    <?php } 
@include 'footer.php'; ?>
</body>
<script src="js/javascript1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
AOS.init({
    offset: 300,
    duration: 1000,
});
</script>

</html>