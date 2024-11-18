<?php
session_start();
@include 'config.php';
error_reporting(0);
$_SESSION['menu']=true;
if(isset($_SESSION['login']))
{
if(isset($_POST['submit']))
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
            $_SESSION['food']=$food;            //for bill generate
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
            date_default_timezone_set('Asia/Kolkata');
            $current_date = date('d M Y');
            $current_time = date('h:i:s A');
            $_SESSION['Amount']=$price1;
            $foods=implode(", ",$food_quantity);
            $_SESSION['order']=true;
            $_SESSION['name']=$name;
            $sql="INSERT INTO `menu` (`email`, `Name`, `Table.NO`, `Items`, `Price`, `date`, `time`, `status`) VALUES ('$email', '$name', '$table', '$foods', '$Amount', '$current_date', '$current_time', 'pending')";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo'<script>location.href = "conform.php"</script>';
            }
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
    <div class="container" style="margin-top: 90px;">
        <h1 class="text-center text-white">Our Menu</h1>
        <p><b class="text-white"> Search Your Item</b></p>
        <input type="text" id="searchInput" class="btn-primary" placeholder="Search...">
        <br><br>
        <form action="" method="post">
            <div class="row" id="results">
                <?php 
                    $sql="SELECT * FROM `food_menu`";
                    $result = mysqli_query($conn, $sql);
                    while($row=mysqli_fetch_assoc($result))
                    { ?>
                <div class="col-md-6 col-lg-4 menu">
                    <div class="card bg-danger" style='width: 19rem;'>
                        <img src="uploadfood/<?= $row['image'] ?>" class="card-img-top" style='height: 180px;'>
                        <div class="card-body">
                            <h5 class="text-white"><?php echo $row["name"] ?></h5>
                            <p class="text-white"><?php echo $row["summary"] ?></p>
                            <?php
                            if($row['status'])
                            { ?>
                            <p class="text-white amount">₹<?php echo $row["price"] ?></p>
                            <label class="btn btn-primary">Add to Cart <input type="checkbox"
                                    data-price="<?php echo $row["price"] ?>" value="<?php echo $row["name"] ?>"
                                    name="food[]"></label>
                            <input type="number" min="1" name="quantity[]" class="btn bg-white text-dark quantity"
                                style="width: 53px; height: 38px" placeholder="Qnt" required autocomplete="off"
                                readonly />
                            <input type="text" name="Amount[]" class="btn btn-warning text-dark price"
                                style="width: 60px; height: 38px" placeholder="Price" readonly />
                            <?php } 
                            else { ?>
                            <p class="amount">Unavailable!</p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="mb-3 col-md-12 text-center">
                    <p class="text-white">Total Amount</p>
                    <input type="text" name="price" id="totalPrice" class="btn btn-light"
                        style="width: 150px; height: 38px" placeholder="" readonly /><br><br>
                    <button type="button" class="btn btn-primary text-center" data-bs-toggle="modal"
                        data-bs-target="#formModal" name="Add">Place Order</button>
                </div>
            </div>
            <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="formModalLabel">Enter your food details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-primary" >
                            <div class="mb-3">
                                <label for="nameInput" class="form-label">Name:</label>
                                <input type="email" class="form-control" id="nameInput" name="name" required
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="numberInput" class="form-label">Phone:</label>
                                <input type="text" class="form-control" id="numberInput" name="phone" required
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="numberInput" class="form-label">Street Number:</label>
                                <input type="text" class="form-control" id="numberInput" name="street" required
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="numberInput" class="form-label">House Number:</label>
                                <input type="text" class="form-control" id="numberInput" name="house" required
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="numberInput" class="form-label">Nearest Famous Place:</label>
                                <input type="text" class="form-control" id="numberInput" name="placenear" required
                                    autocomplete="off">
                            </div>

                            <div class="modal-footer">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php @include 'footer.php' ?>
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