<?php
session_start();

@include 'config.php';
if(isset($_SESSION['admin']))
{
    $sql="SELECT * FROM `user_db` ORDER BY datetime DESC";
    $result = mysqli_query($conn, $sql);
    
?>
<!DOCTYPE html>
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
    .card {
        background: black;
        color: white;
    }

    .card-text {
        color: aqua;
    }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-info">
    <?php @include 'header.php' ?>
    <div class="container" style="margin-top: 90px;">
        <p><b class="text-dark">Find Your Customer</b></p>
        <input type="text" id="search-query" placeholder="Search...">
        <div class="row" id="search-results">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php
            $no=1;
                while($row=mysqli_fetch_assoc($result))
            {
                
                $date_str = $row['datetime'];
                $formatted_time = date('j F Y',strtotime($date_str));
            ?>
                <div class="col search">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Customer Details <?php echo $no++ ?></h5>
                            <p class="card-text">Name: <?php echo $row["name"]; ?></p>
                            <p class="card-text">Email: <?php echo $row["email"]; ?></p>
                            <p class="card-text">Phone: <?php echo $row["phone"]; ?></p>
                            <p class="card-text">City: <?php echo $row["city"]; ?></p>
                            <p class="card-text">State: <?php echo $row["state"]; ?></p>
                            <p class="card-text">Pin Code: <?php echo $row["pincode"] ?></p>
                            <p class="card-text">Registraion Date: <?php echo $formatted_time; ?></p>
                            <div class="row g-6 mt-3">
                                <div class="col-sm">
                                    <form action="userprofile.php" method="post">
                                        <input type="hidden" name="customer" value="<?php echo $row["email"]; ?>">
                                        <button class="btn btn-warning" type="submit" name="submit">More
                                            Details</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="mt-5"></div>
    <?php @include 'footer.php'; ?>
</body>
<script src="js/javascript1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
<script>
// Get the input field and search results container
let input = document.getElementById("search-query");
let resultsContainer = document.getElementById("search-results");

// Attach a keyup event listener to the input field
input.addEventListener("keyup", function() {
    // Get the search query value
    let query = input.value.toLowerCase();

    // Loop through all search results and hide/show them based on the query
    let results = resultsContainer.querySelectorAll(".search");
    for (let i = 0; i < results.length; i++) {
        if (results[i].textContent.toLowerCase().includes(query)) {
            results[i].style.display = "";
        } else {
            results[i].style.display = "none";
        }
    }
});
</script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
<script>
AOS.init({
    offset: 300,
    duration: 1000,
});

<
/html>

<?php
}
else
{
    echo '<script>location.href="admin.php"
</script>';
} ?>