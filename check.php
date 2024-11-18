<!-- Insert detail -->

<?php  @include 'conection.php';  ?>


<?php 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    session_start();


    // $username = $_POST["username"];

    $user = $_POST['username'];
    $phone = $_POST["phone"];
    $pin = $_POST["pin"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    

    $update = " UPDATE `user_registration` SET `username`='$user' , `phone`='$phone' , `pin`='$pin' , `city`='$city', `state`='$state' ";



    $result = mysqli_query($conn, $update);
    
    if($result){
        echo "Sucessfull";
    }
    else
    {
        echo "Not sucessfull";
    }
        
}

?>







<!-- Fetch detail -->

<?php 
if(isset($_SESSION['loggedin']))
{
    
  $email= $_SESSION['email'];
  
  $sql="SELECT * FROM `user_registration` WHERE `email`='$email'";
  $find=mysqli_query($conn,$sql);
  $num=mysqli_num_rows($find);
  
  if($num>0)
  {

    while($row = mysqli_fetch_assoc($find)){

        $usernam = $row["username"];
        $phone = $row["phone"];
        $pin = $row["pin"];
        $city = $row["city"];
        $state = $row["state"];
        $email= $row["email"];


    }





  }

}
?>













<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>

    <section style="background-color: gold;">
        <div class="container py-5">
            <div class="row ">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-info rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3"><?php echo $usernam ?></h5>
                            <p class="text-muted mb-1">Full Stack Developer</p>
                            <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
                            <div class="d-flex justify-content-center mb-2">

                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#profileModal">update</button>
                                <button type="button" class="btn btn-outline-primary ms-1"
                                    onclick="location.href='../index.php'">Home</button>

                            </div>
                        </div>
                    </div>


                    <div class="card mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush rounded-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                    <p class="mb-0">@mdbootstrap</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                    <p class="mb-0">mdbootstrap</p>
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
                                    <p class="text-muted mb-0"><?php echo$usernam ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo  $email ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo  $phone ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Pin Code</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $pin ?> </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $city ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>

</html>




<!-- Address Form -->

<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="profileModalLabel">Your Address </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label"> Name</label>
                        <input type="text" class="form-control" id="name" name="username">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Phone No</label>
                        <input type="text" class="form-control" id="email" name="phone" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Pin code </label>
                        <input type="text" class="form-control" id="password" name="pin" required>
                    </div>


                    <div class="mb-3">
                        <label for="cfpassword" class="form-label">City</label>
                        <input type="text" class="form-control" id="cfpassword" name="city" required>
                    </div>

                    <div class="mb-3">
                        <label for="pass" class="form-label">State</label>
                        <input type="text" class="form-control" id="pass" name="state" required>
                    </div>

                    <div class="mb-3">

                        <label for="Input" class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" name="image" id="Input">

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="sinup">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>