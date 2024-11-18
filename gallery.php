<?php 
session_start(); ?>
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
    <link rel="stylesheet" href="css/gallery.css">
    <link rel="icon" type="image/x-icon" href="image/fevicon.png">
    <style>
    .carousel-item img {
        height: 500px;
        width: 500px;
        object-fit: cover;
    }

    @media (max-width: 768px) {
        .carousel-item img {
            height: 300px;
            width: 400px;
        }
    }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php @include 'header.php' ?>
    <div id="carouselExampleIndicators" class="carousel slide mt-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner mt-3">
            <div class="carousel-item active">
                <img src="ImageGallery/5.jpg" class="d-block w-100" alt="..." height="">
            </div>
            <div class="carousel-item">
                <img src="ImageGallery/2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="ImageGallery/3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item text-center Abhi">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button bg-warning  text-white collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                    aria-controls="collapseOne">
                    <h2>Image Gallery</h2>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body bg-info">

                    <section class="gallery min-vh-100">
                        <div class="container-lg">
                            <div class="row gy-4 row-cols-1 row-cols-sm-2 row-cols-md-3">
                                <div class="col" data-aos="flip-right">
                                    <img src="ImageGallery/1.jpg" class="gallery-item" alt="gallery"
                                        style='height: 200px;'>
                                </div>
                                <div class="col" data-aos="flip-right">
                                    <img src="ImageGallery/2.jpg" class="gallery-item" alt="gallery"
                                        style='height: 200px;'>
                                </div>
                                <div class="col" data-aos="flip-right">
                                    <img src="ImageGallery/3.jpg" class="gallery-item" alt="gallery"
                                        style='height: 200px;'>
                                </div>
                                <div class="col" data-aos="flip-right">
                                    <img src="ImageGallery/4.jpg" class="gallery-item" alt="gallery"
                                        style='height: 200px;'>
                                </div>
                                <div class="col" data-aos="flip-right">
                                    <img src="ImageGallery/5.jpg" class="gallery-item" alt="gallery"
                                        style='height: 200px;'>
                                </div>
                                <div class="col" data-aos="flip-right">
                                    <img src="ImageGallery/6.jpg" class="gallery-item" alt="gallery"
                                        style='height: 200px;'>
                                </div>
                                <div class="col" data-aos="flip-right">
                                    <img src="ImageGallery/7.jpg" class="gallery-item" alt="gallery"
                                        style='height: 200px;'>
                                </div>
                                <div class="col" data-aos="flip-right">
                                    <img src="ImageGallery/13.jpg" class="gallery-item" alt="gallery"
                                        style='height: 200px;'>
                                </div>
                                <div class="col" data-aos="flip-right">
                                    <img src="ImageGallery/9.jpg" class="gallery-item" alt="gallery"
                                        style='height: 200px;'>
                                </div>
                                <div class="col" data-aos="flip-right">
                                    <img src="ImageGallery/10.jpg" class="gallery-item" alt="gallery"
                                        style='height: 200px;'>
                                </div>
                                <div class="col" data-aos="flip-right">
                                    <img src="ImageGallery/11.jpg" class="gallery-item" alt="gallery"
                                        style='height: 200px;'>
                                </div>
                                <div class="col" data-aos="flip-right">
                                    <img src="ImageGallery/12.jpg" class="gallery-item" alt="gallery"
                                        style='height: 200px;'>
                                </div>

                            </div>
                        </div>
                    </section>

                    <div class="modal fade" id="gallery-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="img/1.jpg" class="modal-img" alt="modal img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item text-center Abhi">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button bg-warning text-white collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <h2 class="text-center">Food Gallery</h2>
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body bg-info">
                    <section class="gallery min-vh-100">
                        <div class="container-lg">
                            <div class="row gy-4 row-cols-1 row-cols-sm-2 row-cols-md-3">
                                <?php 
                                $sql="SELECT * FROM `food_menu` LIMIT 12";
                                $res=mysqli_query($conn,$sql);
                                while($row=mysqli_fetch_assoc($res))
                                { ?>

                                <div class="col" data-aos="flip-left">
                                    <img src="Food/<?=$row['image'] ?>" class="gallery-item1" alt="gallery"
                                        style='height: 200px;'>
                                </div>
                                <?php   }
                                ?>
                            </div>
                        </div>
                    </section>

                    <!-- Modal -->
                    <div class="modal fade" id="gallery-modal1" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="img/1.jpg" class="modal-img1" alt="modal img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php @include 'footer.php' ?>

</body>
<script src="js/main.js"></script>
<script src="js/javascript.js"></script>
<script src="js/javascript1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
<script>
AOS.init({
    offset: 300,
    duration: 1000,
});
</script>

</html>