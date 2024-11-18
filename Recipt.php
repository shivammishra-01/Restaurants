<?php
session_start();
if(isset($_SESSION['order']))
{ 
    date_default_timezone_set('Asia/Kolkata');
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
</head>

<body class="d-flex flex-column min-vh-100">
    <?php @include 'header.php' ; ?>
    <div class="container" style="margin-top: 90px;">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="row d-flex align-items-baseline">
                        <div class="col-xl-9">

                        </div>
                        <div class="col-xl-3 float-end">
                            <button class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"
                                onclick="window.print()"><i class="fas fa-print text-primary"></i> Print</button>
                            <button class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"
                                onclick="location.href='index.php'"><i class="fa-solid fa-backward text-danger"></i></i>
                                Go Back</button>
                        </div>
                        <hr>
                    </div>
                    <div class="container">
                        <div class="col-md-12">
                            <div class="text-center">
                                <p class="fs-1 fw-bold">CCC</p>
                                <p class="pt-0">CUTM COFFEE CONNECT</p>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-xl-8">
                                <ul class="list-unstyled">
                                    <li class="text-muted">To: <span
                                            style="color:#5d9fc5 ;"><?php echo$_SESSION['name'];?></span></li>
                                    <li class="text-muted">761211, PKD</li>
                                    <li class="text-muted">ODISHA, IN</li>
                                    <li class="text-muted"><i class="fas fa-phone"></i> 7488048437</li>
                                </ul>
                            </div>
                            <div class="col-xl-4">
                                <p class="text-muted">Invoice</p>
                                <ul class="list-unstyled">
                                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                            class="fw-bold">Creation Date: </span><?php echo date('F d, Y'); ?></li>
                                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                            class="me-1 fw-bold">Status:</span><span
                                            class="badge bg-warning text-black fw-bold">
                                            Unpaid</span></li>
                                </ul>
                            </div>
                        </div>

                        <div class="row my-2 mx-1 justify-content-center">
                            <table class="table table-striped table-borderless">
                                <thead style="background-color:#84B0CA ;" class="text-white">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
				$selected_foods = $_SESSION['food'];
				$quantities =$_SESSION['quantity'];
				$price=$_SESSION['Amount'];
                $no=1;
				for ($i = 0; $i < count($selected_foods); $i++) {
					if (!empty($selected_foods[$i]) && !empty($quantities[$i])) { ?>

                                    <tr>
                                        <td><?php echo $no++ ; ?> </td>
                                        <td><?php echo $selected_foods[$i]; ?></td>
                                        <td><?php echo $quantities[$i]; ?></td>
                                        <td><?php echo $price[$i]; ?></td>
                                    </tr> <?php
					}
				}
				unset($_SESSION['order']);
			?>
                                </tbody>

                            </table>
                        </div>
                        <div class="row">
                            <div class="col-xl-8">


                            </div>
                            <div class="col-xl-3">

                                <p class="text-black float-start"><span class="text-black me-3"> Total
                                        Amount</span><span
                                        style="font-size: 25px;"><?php echo $_SESSION['TotalPrice'];?></span></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xl-10">
                                <p>Thank you for your purchase</p>
                            </div>
                            <div class="col-xl-2">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php @include 'footer.php' ; ?>
</body>
<script src="js/javascript1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>

</html>
<?php 
unset($_SESSION['TotalPrice'],$_SESSION['order'],$_SESSION['food'],$_SESSION['quantity'],$_SESSION['name']);
}
else
{
	echo'<script>location.href = "explore-menu.php"</script>';
} ?>