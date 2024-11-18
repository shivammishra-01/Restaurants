<?php session_start();
if(isset($_SESSION['login']))
{
	$email=$_SESSION['user'];
	@include 'config.php';
	if(isset($_POST['submit']))
	{
    	$picture2 =explode("@", $email);
    	$picture = $picture2[0];
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$pincode = $_POST['pincode'];
		$city = $_POST['city'];
		$state = $_POST['state'];
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
                $img_upload_path='userpic/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
                $sql="UPDATE `user_db` SET `image` = '$new_img_name' WHERE `user_db`.`email` = '$email'";
                mysqli_query($conn,$sql);
            }
        }
		$sql="UPDATE `user_db` SET `name` = '$name', `city` = '$city', `state` = '$state', `pincode` = '$pincode', `phone` = '$phone' WHERE `user_db`.`email` = '$email'";
		mysqli_query($conn,$sql);
		echo'<script>location.href = "edit_profile.php"</script>';
	}
    if(isset($_POST['submit2']))
    {
        $value=$_POST['star'];
        $descrp=$_POST['desc'];
        $sql="UPDATE `user_db` SET `star` = '$value', `feedbacksummary` = '$descrp' WHERE `user_db`.`email` = '$email'";
        mysqli_query($conn,$sql);
		echo'<script>location.href = "edit_profile.php"</script>';
    }
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
</head>

<body class="d-flex flex-column min-vh-100 bg-info">
    <?php @include 'header.php' ;?>
    <section>
        <div class="container py-5" style="margin-top: 40px;">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-warning rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0 fs-5">
                            <li class="breadcrumb-item"><a href="index.php" class="text-dark fw-bold fs-5">Home</a></li>
                            <li class="breadcrumb-item"><a href="tableno.php"
                                    class="text-dark fw-bold fs-5">Booking</a></li>
                            <li class="breadcrumb-item"><a href="profile.php" class="text-dark fw-bold fs-5">My
                                    Order</a>
                            </li>
                            <li class="breadcrumb-item"><a href="userhistory.php" class="text-dark fw-bold fs-5">All</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <?php
			$sql = "SELECT * FROM `user_db` WHERE `email` = '$email'";
			$res = mysqli_query($conn,$sql);
			$num = mysqli_num_rows($res);
			$row = mysqli_fetch_assoc($res);
			 ?>
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
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#Update">Update</button>
                                <button type="button" class="btn btn-outline-danger ms-1"
                                    onclick="location.href='index.php'">Home</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="Update" tabindex="-1" aria-labelledby="formModalLabel"
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
                                                    autocomplete="off" value="<?php echo $row['phone']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="numberInput" class="form-label">Pincode</label>
                                                <input type="text" class="form-control" id="numberInput" name="pincode"
                                                    autocomplete="off" value="<?php echo $row['pincode']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="numberInput" class="form-label">City</label>
                                                <input type="text" class="form-control" id="numberInput" name="city"
                                                    autocomplete="off" value="<?php echo $row['city']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="numberInput" class="form-label">State</label>
                                                <select id="inputState" class="form-select" name="state">
                                                    <option>
                                                        <?php if($row['state']==='india')
                                                    { ?>
                                                        select state
                                                        <?php }
                                                   else{
                                                    echo $row['state'];
                                                   }
															?>
                                                    </option>
                                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                    <option value="Assam">Assam</option>
                                                    <option value="Bihar">Bihar</option>
                                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                                    <option value="Goa">Goa</option>
                                                    <option value="Gujarat">Gujarat</option>
                                                    <option value="Haryana">Haryana</option>
                                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                    <option value="Jharkhand">Jharkhand</option>
                                                    <option value="Karnataka">Karnataka</option>
                                                    <option value="Kerala">Kerala</option>
                                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                    <option value="Maharashtra">Maharashtra</option>
                                                    <option value="Manipur">Manipur</option>
                                                    <option value="Meghalaya">Meghalaya</option>
                                                    <option value="Mizoram">Mizoram</option>
                                                    <option value="Nagaland">Nagaland</option>
                                                    <option value="Odisha">Odisha</option>
                                                    <option value="Punjab">Punjab</option>
                                                    <option value="Rajasthan">Rajasthan</option>
                                                    <option value="Sikkim">Sikkim</option>
                                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                                    <option value="Telangana">Telangana</option>
                                                    <option value="Tripura">Tripura</option>
                                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                    <option value="Uttarakhand">Uttarakhand</option>
                                                    <option value="West Bengal">West Bengal</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="numberInput" class="form-label">Profile Picture</label>
                                                <input type="file" class="form-control" name="image"
                                                    value="<?php echo $row['image']; ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="submit"
                                                    class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                            $email=$_SESSION['user'];
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
                                        <?php $user = $_SESSION['user'];
                                     echo $user ;?>
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
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="customRange1" class="form-label">Give Feedback <span
                                        class="text-danger">(out of
                                        5)</span></label>
                                <input type="range" class="form-range" min="1" max="5" name="star"
                                    value="<?php echo $row['star'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Give suggestion to us <span
                                        class="text-danger">(max 255 word)</span></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="desc"
                                    maxlength="255"><?php echo $row['feedbacksummary']; ?></textarea>
                            </div>
                            <div class="mb-3 ">
                                <button type="submit" name="submit2" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
    <?php @include 'footer.php' ;?>
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