<?php

@include 'config.php';
date_default_timezone_set('Asia/Kolkata');
if(isset($_POST['submit']))
{
    $timestamp = time();
    $date_time_string = date("Y-m-d H:i:s", $timestamp);
    $name=$_POST['name'];
    $email=$_POST['email'];
    $essay=$_POST['essay'];
    $sql="INSERT INTO `contactus` (`name`, `email`, `Description`,`timedate`) VALUES ('$name', '$email', '$essay', '$date_time_string')";
    $res=mysqli_query($conn,$sql);
    if($res)
    {
        echo'<script>location.href = "index.php"</script>';
    }
    else{
        echo'<script>alert("Sorry You are Failed to Contact Us!")</script>';
        echo'<script>location.href = "index.php"</script>';
    }

}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCC | pkd | contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="image/fevicon.png">
</head>

<body class="d-flex flex-column min-vh-100 bg-info">
    <?php @include 'header.php' ?>

    <div class="container" style="margin-top: 90px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-4">Contact Us</h1>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name"
                            autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email"
                            autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="5" placeholder="Enter your message"
                            name="essay" maxlength="255" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Send Message</button>
                    </div>
                    <div class="mt-3">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include 'footer.php' ?>
</body>
<script src="js/javascript1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>

</html>