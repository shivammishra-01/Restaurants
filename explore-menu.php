<?php
session_start();
@include 'config.php';
error_reporting(0);
date_default_timezone_set('Asia/Kolkata');
unset($_SESSION['payment'],$_SESSION['Tablenumber'],$_SESSION['foods'],$_SESSION['name']);
$_SESSION['menu']=true;
if(isset($_SESSION['login']))
{
if(isset($_POST['submit']))
{
        $_SESSION['order']=true;
        $name=$_POST['name'];
        $table=$_POST['table'];
        $email=$_SESSION['user'];
        $food=$_POST['food'];
        $quantity=$_POST['quantity'];
        $price=$_POST['Amount'];
        $Amount=$_POST['price'];
        if(!$Amount)
        {
            echo'<script>location.href = "explore-menu.php"</script>';
        }
        else
        {
            for($i=0;$i<count($quantity);$i++)
            {
                if($quantity[$i]!="")
                {
                    $quantity1[]=$quantity[$i];
                }
            }
            for($i=0;$i<count($food);$i++)
            {
                if(isset($food[$i]))
                {
                    $food_quantity[]=$food[$i]. "-". $quantity1[$i];
                }
            }
            $_SESSION['quantity']=$quantity1;
            for($i=0;$i<count($price);$i++) 
            {
                if($price[$i]!="")
                {
                    $price1[]=$price[$i];
                }
            }
            date_default_timezone_set('Asia/Kolkata');
            $timestamp = time();
            $date_time_string = date("Y-m-d H:i:s", $timestamp);
            $foods=implode(", ",$food_quantity);
            $sql="INSERT INTO `menu` (`email`, `Name`, `Table.NO`, `Items`, `Price`, `datetime`, `status`) VALUES ('$email', '$name', '$table', '$foods', '$Amount', '$date_time_string', 'pending')";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo'<script>location.href = "conform.php"</script>';
            }
    }
}
else if(isset($_POST['submit1']))
{
    $name=$_POST['name'];
    $table=$_POST['table'];
    $email=$_SESSION['user'];
    $food=$_POST['food'];
    $quantity=$_POST['quantity'];
    $price=$_POST['Amount'];
    $Amount=$_POST['price'];
    if(!$Amount)
    {
        echo'<script>location.href = "explore-menu.php"</script>';
    }
    else
    { 
        $_SESSION['TotalPrice']=$Amount;
        for($i=0;$i<count($quantity);$i++)
        {
            if($quantity[$i]!="")
            {
                $quantity1[]=$quantity[$i];
            }
        }
        for($i=0;$i<count($food);$i++)
        {
            if(isset($food[$i]))
            {
                $food_quantity[]=$food[$i]. "-". $quantity1[$i];
            }
        }
        $_SESSION['quantity']=$quantity1;
        for($i=0;$i<count($price);$i++) 
        {
            if($price[$i]!="")
            {
                $price1[]=$price[$i];
            }
        }
        $timestamp = time();
        $date_time_string = date("Y-m-d H:i:s", $timestamp);
        $_SESSION['payment']=true;
        $foods=implode(", ",$food_quantity);
        $_SESSION['name']=$name;
        $_SESSION['foods']=$foods;
        $_SESSION['Tablenumber']=$table;
            echo'<script>location.href = "payment.php"</script>';
    }
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
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-info">
    <?php @include 'header.php'; ?>
    <div class="container" style="margin-top: 80px;">
        <h1 class="text-center text-danger">Our Menu</h1>
        <p><b class="text-dark"> Search Your Item</b></p>
        <input type="text" id="searchInput" class="btn-primary" placeholder="Search...">
        <br><br>
        <form action="" method="post">
            <div class="row" id="results">
                <?php 
                    $sql="SELECT * FROM `food_menu`";
                    $result = mysqli_query($conn, $sql);
                    while($row=mysqli_fetch_assoc($result))
                    { ?>
                <div class="col-md-6 col-lg-4 menu" style="margin-top: 20px;">
                    <div class="card bg-danger" style='width: 19rem;'>
                        <img src="Food/<?= $row['image'] ?>" class="card-img-top" style='height: 180px;'>
                        <div class="card-body">
                            <h5 class="text-white"><?php echo $row["name"] ?></h5>
                            <p class="text-white"><?php echo $row["summary"] ?></p>
                            <?php
                            if($row['status'])
                            { ?>
                            <p class="text-white amount">₹<?php echo $row["price"] ?></p>
                            <label class="btn btn-primary">Order <input type="checkbox"
                                    data-price="<?php echo $row["price"] ?>" value="<?php echo $row["name"] ?>"
                                    name="food[]"></label>
                            <input type="number" min="1" name="quantity[]" class="btn bg-white text-dark quantity"
                                style="width: 53px; height: 38px" placeholder="Qnt" required autocomplete="off"
                                readonly />
                            <input type="text" name="Amount[]" class="btn btn-warning text-dark price"
                                style="width: 60px; height: 38px" placeholder="Price" readonly />
                            <?php } 
                            else { ?>
                            <p class="amount text-white">Unavailable!</p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="mb-3 col-md-12 text-center">
                    <p class="text-dark">Total Amount</p>
                    <input type="text" name="price" id="totalPrice" class="btn btn-light"
                        style="width: 150px; height: 38px" placeholder="" readonly /><br><br>
                    <button type="button" class="btn btn-primary text-center" data-bs-toggle="modal"
                        data-bs-target="#formModal" name="Add">Place Order</button>
                </div>
            </div>
            <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title text-dark" id="formModalLabel">Enter your food details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nameInput" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="nameInput" name="name" required
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="numberInput" class="form-label">Table Number:</label>
                                <input type="number" class="form-control" id="numberInput" name="table" max="10" min="1"
                                    autocomplete="off" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="submit" class="btn btn-success">CASH</button>
                                <button type="submit" name="submit1" class="btn btn-success">PAY</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php @include 'footer.php'; ?>
</body>
<script src="js/javascript.js"></script>
<script src="js/javascript1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>

</html>
<?php }
else
{
    echo'<script>location.href = "login.php"</script>';unset($_SESSION['menu']);
} ?>