<!doctype html>
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
    <style>
        .ratio {
            border: 10px solid #a82c48;
            overflow: hidden;
            border-radius: 8px;
        }
        .ratio+.ratio {
            margin-top: 1rem;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-info">
    <?php @include 'header.php' ?>

    <div class="container" style="margin-top: 90px;">
        <div class="row">
            <div class="col-md-6">
                <h1 class="mb-4">About Us</h1>
                <p>Welcome to <span class="text-danger fs-5 bb"><b>CENTURION COFFEE CONNECT</b></span>, where we're
                    passionate
                    about food and creating an exceptional dining
                    experience for our guests. Our restaurant has been serving delicious cuisine and warm hospitality to
                    the Parlakhemundi, Oshisa, India community for 3 years.</p>

                <p>At <span class="text-danger fs-5 bb"><b>CENTURION COFFEE CONNECT</b></span>, we believe that the
                    dining experience extends beyond just the food. Our
                    restaurant is designed to create a warm and inviting atmosphere, with comfortable seating and
                    elegant decor. Whether you're celebrating a special occasion or just enjoying a casual night out
                    with friends and family, our restaurant is the perfect destination.</p>
                <p>Thank you for choosing <span class="text-danger fs-5 bb"><b>CENTURION COFFEE CONNECT</b></span>. We
                    look forward to serving you and providing you with a truly memorable dining experience.</p>
            </div>
            <div class="col-md-6 mt-5">
                <div class="ratio ratio-16x9">
                    <video autoplay loop muted src="ImageGallery/Video1.mp4"></video>
                </div>
                <div class="ratio ratio-16x9">
                    <video autoplay loop muted src="ImageGallery/Video2.mp4"></video>
                    <!-- <iframe src="Video.mp4?autoplay=1&loop=1" title="YouTube video"
                        allowfullscreen></iframe> -->
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-4">
                <img src="ImageGallery/10.jpg" alt="Image" class="img-fluid mb-4 ratio">
            </div>
            <div class="col-md-4">
                <img src="ImageGallery/11.jpg" alt="Image" class="img-fluid mb-4 ratio">
            </div>
            <div class="col-md-4">
                <img src="ImageGallery/2.jpg" alt="Image" class="img-fluid mb-4 ratio">
            </div>
        </div>
    </div>
    <?php @include 'footer.php' ?>

</body>
<script src="js/javascript1.js"></script>
<script src="js/javascript.js"></script>
<script src="js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

</html>