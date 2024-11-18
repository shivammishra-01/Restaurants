<?php
session_start();
error_reporting(0);
unset($_SESSION['date'],$_SESSION['status']);
@include 'config.php';
if(isset($_SESSION['admin']))
{
    // $_SESSION['editmenu']=true;
    if(isset($_POST['Delete']))
    {
        $food=$_POST['eddel'];
        $sql="DELETE FROM `food_menu` WHERE `food_menu`.`name` = '$food'";
        $res= mysqli_query($conn,$sql); 
        if($res)
        {
                echo'<script>location.href = "additem.php"</script>';
        }
    }
    
    // echo $_SESSION['editmenu'];
    if(isset($_POST['Add']))
    {
        $name=$_POST['nameInput'];
        $price=$_POST['numberInput'];
        $des=$_POST['messageTextarea'];
        $img_name=$_FILES['image']['name'];
        $tmp_name=$_FILES['image']['tmp_name'];
        $error=$_FILES['image']['error'];
        if($error===0)
        {
            $img_ex=pathinfo($img_name,PATHINFO_EXTENSION);
            $img_ex_lc=strtolower($img_ex);
            $allower_ex=array("jpg","jpeg","png");
            if(in_array($img_ex_lc,$allower_ex))
            {
                $new_img_name1=str_replace(" ", "", $name).'.'.$img_ex_lc;
                $new_img_name=strtolower($new_img_name1);
                $img_upload_path='Food/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
            }
        }
        $sql="INSERT INTO `food_menu` (`name`, `summary`, `status`, `price`,`image`) VALUES ('$name', '$des', '1', '$price','$new_img_name')";
        $res= mysqli_query($conn,$sql);
       if($res)
       {
        echo'<script>location.href = "additem.php"</script>';
       }
    }
    
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCC | pkd | additem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="image/fevicon.png">
</head>

<body class="d-flex flex-column min-vh-100 bg-info">
    <?php @include 'header.php'; ?>
    <div class="container" style="margin-top: 90px;">
        <h2 class="pb-3 text-justify text-danger">ADD YOUR FOOD</h2>
        <p><b class="text-dark"> Search Your Item</b></p>
        <input type="text" id="searchInput" class="btn-primary" placeholder="Search...">
        <br><br>
        <div class="row" id="results">
            <?php
            $sql ="SELECT * FROM `food_menu`";
            $res=mysqli_query($conn,$sql);
            $num=mysqli_num_rows($res);
            if($num)
            {
                while($image=mysqli_fetch_assoc($res))
                {
                ?>
            <div class='col-md-6 col-lg-4 menu' style="margin-top: 20px;">
                <div class='card' style='width: 18rem;'>
                    <img src='Food/<?= $image['image'] ?>' class='card-img-top' style='height: 180px;'>
                    <div class='card-body bg-danger'>
                        <h5 class="text-white"><?php echo $image['name']; ?></h5>
                        <p class='text-white'>
                            <?php echo $image['summary'] ?>
                        </p>
                        <?php if($image['status']==='1')
                        { ?>
                        <p class='text-white'>₹<?php echo $image['price'] ?></p>
                        <?php } 
                        else{ ?>
                        <p class='text-white'>unavailable!</p>
                        <?php   }
                        ?>
                        <div class="row g-3">
                            <form action="editmenu.php" method="post">
                                <input type="hidden" value="<?php echo $image['name']; ?>" name="eddel">
                                <button type="submit" name="Editmenu" class="btn btn-warning form-control">Edit</button>
                            </form>
                            <form action="" method="post">
                                <input type="hidden" value="<?php echo $image['name']; ?>" name="eddel">
                                <button type="submit" name="Delete" class="btn btn-info form-control">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } }     ?>
        </div>
    </div>
    <div class="mb-3 col-md-12 text-center">
    </div>
    <hr class="hr">
    <div>
        <div class="mb-3 col-md-12 text-center">
            <button type="button" class="btn btn-warning text-center" data-bs-toggle="modal" data-bs-target="#formModal"
                name="Add">Add Food</button>
            <button type="button" class="btn btn-warning text-center" onclick="location.href='index.php'" name="Add">Go
                Back</button>
        </div>
    </div>
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Enter your food details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nameInput" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="nameInput" name="nameInput" required
                                autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="numberInput" class="form-label">Price:</label>
                            <input type="number" class="form-control" id="numberInput" name="numberInput" required>
                        </div>
                        <div class="mb-3">
                            <label for="messageTextarea" class="form-label">Description:</label>
                            <textarea class="form-control" id="messageTextarea" name="messageTextarea" rows="3"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Food Photo</label>
                            <input type="file" class="form-control" name="image">
                            <input type="text" hidden="hidden" name="old_pp" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="Add" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php @include 'footer.php'; ?>
</body>
<script src="js/javascript.js"></script>
<script src="js/javascript1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>

</html>
<?php 
 }
 else
 {
    echo '<script>location.href="admin.php"</script>';
 }
?>