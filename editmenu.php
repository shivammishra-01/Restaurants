<?php
session_start();
error_reporting(0);
@include 'config.php';
if(isset($_SESSION['admin']))
{
    if(isset($_POST['Editmenu']))
    {
        $name1=$_POST['eddel'];
        $_SESSION['FoodEdit']= $name1;
        echo'<script>location.href = "editmenu.php"</script>';
    }
    if(isset($_POST['Edit']))
    {
        $name=$_SESSION['FoodEdit'];
        $price=$_POST['numberInput'];
        $des=$_POST['messageTextarea'];
        $status=$_POST['cars'];
        $img_name=$_FILES['My_Img']['name'];
        $tmp_name=$_FILES['My_Img']['tmp_name'];
        $error=$_FILES['My_Img']['error'];
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
                $sql= "UPDATE `food_menu` SET `image` = '$new_img_name' WHERE `food_menu`.`name` = '$name'";
                mysqli_query($conn,$sql);
            }
        }
        $sql= "UPDATE `food_menu` SET `summary` = '$des',`price` = '$price',`status` = '$status' WHERE `food_menu`.`name` = '$name'";
        $res= mysqli_query($conn,$sql);
        echo'<script>location.href = "additem.php"</script>';
    }

?>
<!DOCTYPE html>
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
    .card {
        max-width: 400px;
    }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-info">
    <?php @include 'header.php'; ?>
    <div class="container" style="margin-top: 70px;">
        <?php
    $name=$_SESSION['FoodEdit'];
    $sql ="SELECT * FROM `food_menu` WHERE `name`='$name'";
    $res=mysqli_query($conn,$sql);
                while($image=mysqli_fetch_assoc($res))
                {
                ?>
        <div class="card mx-auto">
            <div class="card-header">
                <h3 class="card-title">Food Item</h3>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="nameInput"
                            value="<?php echo $image['name']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="numberInput"
                            value="<?php echo $image['price']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="cars">
                            <?php if($image['status']==='0')
                                    { ?>
                            <option value="0">Not Available</option>
                            <option value="1">Available</option>
                            <?php  }
                                    else{ ?>
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>

                            <?php  } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="messageTextarea" rows="3"
                            required><?php echo $image['summary']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="My_Img">
                        <input type="text" hidden="hidden" name="old_pp" value="">
                    </div>
                    <button type="submit" class="btn btn-primary" name="Edit">Submit</button>
                </form>
            </div>
        </div>
        <?php }    ?>
    </div>
</body>
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