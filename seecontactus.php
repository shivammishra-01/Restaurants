<?php session_start();
if(isset($_SESSION['admin']))
{
@include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCC | pkd | about</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/gallery.css">
    <link rel="icon" type="image/x-icon" href="image/fevicon.png">
</head>

<body class="d-flex flex-column min-vh-100">
    <?php @include 'header.php'; ?>

    <div class="container" style="margin-top: 90px;">

        <h1 class="text-center mb-4">Messages</h1>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="d-none d-md-table-cell">Sl. No.</th>
                        <th class="d-none d-md-table-cell">Name</th>
                        <th class="d-none d-md-table-cell">Email</th>
                        <th>Message</th>
                        <th class="d-none d-md-table-cell">Date/Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql="SELECT * FROM `contactus` ORDER BY `timedate` DESC";
                        $res=mysqli_query($conn,$sql);
                        $num=mysqli_num_rows($res);
                        $no=1;
                    while($row=mysqli_fetch_assoc($res)) 
                    {
                    ?>
                    <tr>
                        <td class="d-none d-md-table-cell"><?php echo $no++; ?></td>
                        <td class="d-none d-md-table-cell"><?php echo $row['name']; ?></td>
                        <td class="d-none d-md-table-cell"><?php echo $row['email']; ?></td>
                        <td><?php echo $row['Description']; ?></td>
                        <td class="d-none d-md-table-cell"><?php echo $row['timedate']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script src="js/javascript1.js"></script>
<script src="js/javascript.js"></script>
<script src="js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>

</html>
<?php } else
{
    echo'<script>location.href = "index.php"</script>';
} ?>