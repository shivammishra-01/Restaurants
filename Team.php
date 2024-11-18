<?php session_start(); 

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
    <style type="text/css">
    body {
        /* margin-top: 20px; */
        background: rgb(0, 0, 0, 0.6);
        color: #9aa9c1;
    }

    a {
        text-decoration: none;
    }

    .team_title {
        color: #fff;
        margin-bottom: 60px;
        text-align: center;
        text-transform: capitalize;
        font-weight: 600;

    }

    @media only screen and (max-width:768px) {
        .our-team {
            margin-bottom: 30px
        }
    }

    .single-team {
        margin-bottom: 10px;
    }

    .single-team img {
        margin-bottom: 15px;
        width: 120px;
        border-radius: 50%;
        height: 120px;
        border: 10px solid rgba(255, 255, 255, 0.1);
    }

    .single-team h3 {
        margin-bottom: 0px;
        font-size: 18px;
        font-weight: 600;
        color: #0b0a0ae1;
    }

    .single-team p {
        margin-bottom: 0px;
    }

    .our-team .social {
        list-style: none;
        padding: 0;
        margin: 0;
        text-align: center;
        -webkit-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
    }

    .our-team .social li {
        display: inline-block;
    }

    .our-team .social li a {
        display: block;
        width: 35px;
        height: 35px;
        line-height: 35px;
        font-size: 15px;
        color: #fff;
        position: relative;
        -webkit-transition: all 0.3s ease-in-out 0s;
        transition: all 0.3s ease-in-out 0s;
        border-radius: 30px;
        margin: 3px;
    }

    .our-team:hover .social li:nth-child(1) a {
        -webkit-transition-delay: 0.3s;
        transition-delay: 0.3s;
    }

    .our-team:hover .social li:nth-child(2) a {
        -webkit-transition-delay: 0.2s;
        transition-delay: 0.2s
    }

    .our-team:hover .social li:nth-child(3) a {
        -webkit-transition-delay: 0.1s;
        transition-delay: 0.1s;
    }

    .our-team:hover .social li:nth-child(4) a {
        -webkit-transition-delay: 0s;
        transition-delay: 0s;
    }

    .our-team .social li a:hover {
        -webkit-transition-delay: 0s;
        transition-delay: 0s;
    }

    .facebook {
        background: #1C58A1;
    }

    .facebook:hover {
        background: #fff;
        color: #1C58A1 !important;
    }

    .twitter {
        background: #0CBCE3;
    }

    .twitter:hover {
        background: #fff;
        color: #0CBCE3 !important;
    }

    .google {
        background: #F04537;
    }

    .google:hover {
        background: #fff;
        color: #F04537 !important;
    }

    /*START BOARD DIRECTOR*/
    .bod_area {
        padding-bottom: 80px;
    }


    @media only screen and (max-width:768px) {
        .our-bod {
            margin-bottom: 30px
        }
    }

    .single-bod {
        margin-bottom: 10px;
    }

    .single-bod img {
        margin-bottom: 20px;
        width: 120px;
        border-radius: 100%;
        height: 120px;
        border: 10px solid rgba(255, 255, 255, 0.1);
    }

    .single-bod h3 {
        margin-bottom: 0px;
        font-size: 18px;
        font-weight: 600;
        color: black;
    }

    .single-bod p {
        margin-bottom: 0px;
    }

    .our-bod .social {
        list-style: none;
        padding: 0;
        margin: 0;
        text-align: center;
        -webkit-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
    }

    .our-bod .social li {
        display: inline-block;
    }

    .our-bod .social li a {
        display: block;
        width: 35px;
        height: 35px;
        line-height: 35px;
        font-size: 15px;
        color: #fff;
        position: relative;
        -webkit-transition: all 0.3s ease-in-out 0s;
        transition: all 0.3s ease-in-out 0s;
        border-radius: 30px;
        margin: 3px;
    }

    .our-bod:hover .social li:nth-child(1) a {
        -webkit-transition-delay: 0.3s;
        transition-delay: 0.3s;
    }

    .our-bod:hover .social li:nth-child(2) a {
        -webkit-transition-delay: 0.2s;
        transition-delay: 0.2s
    }

    .our-bod:hover .social li:nth-child(3) a {
        -webkit-transition-delay: 0.1s;
        transition-delay: 0.1s;
    }

    .our-bod:hover .social li:nth-child(4) a {
        -webkit-transition-delay: 0s;
        transition-delay: 0s;
    }

    .our-bod .social li a:hover {
        -webkit-transition-delay: 0s;
        transition-delay: 0s;
    }

    .title_spectial {
        color: red;
        text-align: center;
        font-weight: 600;
        position: relative;
        margin-bottom: 60px;
        text-transform: uppercase;
        font-size: 24px;
    }

    .bod_area {
        padding-bottom: 80px;
    }

    .section-padding {
        padding: 60px 0;
        padding-top: 70px;
    }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-info">
    <?php @include 'header.php' ?>
    <section id="team" class="team_area section-padding">
        <div class="container">
            <h2 class="title_spectial">Meet creative team</h2>
            <div class="row text-center">
                <div class="col-lg-3 col-sm-4 col-xs-12 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.1s"
                    data-wow-offset="0" data-aos="flip-right"
                    style="visibility: visible; animation-duration: 1s; animation-delay: 0.1s; animation-name: fadeInUp;">
                    <div class="our-team">
                        <div class="single-team">
                            <img src="Team/shivam.jpg" class="img-fluid" alt="">
                            <h3>Shivam Tiwari</h3>
                            <p>Full Stack Developer</p>
                        </div>
                        <ul class="social">
                            <li><a href="https://api.whatsapp.com/send?phone=9827676521"><i
                                        class="fa-brands fa-whatsapp"></i></a></li>
                            <li><a href="https://lnkd.in/d-7A8PRK"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            <li><a
                                    href="mailto:210101120023@cutm.ac.in?subject=Question about your product&body=Dear seller,"><i
                                        class="fa-sharp fa-solid fa-envelope"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s"
                    data-wow-offset="0" data-aos="flip-right"
                    style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="our-team">
                        <div class="single-team">
                            <img src="Team/niraj.jpeg" class="img-fluid" alt="">
                            <h3>Niraj Upadhyay</h3>
                            <p>Full Stack Developer</p>
                        </div>
                        <ul class="social">
                            <li><a href="https://api.whatsapp.com/send?phone=7667972647"><i
                                        class="fa-brands fa-whatsapp"></i></a></li>
                            <li><a href="https://lnkd.in/dvnF6fdW"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            <li><a
                                    href="mailto:210101120025@cutm.ac.in?subject=Question about your product&body=Dear seller,"><i
                                        class="fa-sharp fa-solid fa-envelope"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s"
                    data-wow-offset="0" data-aos="flip-right"
                    style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInUp;">
                    <div class="our-team">
                        <div class="single-team">
                            <img src="Team/ujjwal.jpeg" class="img-fluid" alt="">
                            <h3>Ujjwal Tiwari</h3>
                            <p>Full Stack Developer</p>
                        </div>
                        <ul class="social">
                            <li><a href="https://api.whatsapp.com/send?phone=7070709136"><i
                                        class="fa-brands fa-whatsapp"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            <li><a
                                    href="mailto:210101120029@cutm.ac.in?subject=Question about your product&body=Dear seller,"><i
                                        class="fa-sharp fa-solid fa-envelope"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s"
                    data-wow-offset="0" data-aos="flip-right"
                    style="visibility: visible; animation-duration: 1s; animation-delay: 0.4s; animation-name: fadeInUp;">
                    <div class="our-team">
                        <div class="single-team">
                            <img src="Team/mukesh.jpg" class="img-fluid" alt="">
                            <h3>Mukesh Pandey</h3>
                            <p>Full Stack Developer</p>
                        </div>
                        <ul class="social">
                            <li><a href="https://api.whatsapp.com/send?phone=7488781126"><i
                                        class="fa-brands fa-whatsapp"></i></a></li>
                            <li><a href="https://lnkd.in/dMDq_XGR"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            <li><a
                                    href="mailto:210101120003@cutm.ac.in?subject=Question about your product&body=Dear seller,"><i
                                        class="fa-sharp fa-solid fa-envelope"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-3 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s"
                    data-wow-offset="0" data-aos="flip-right"
                    style="visibility: visible; animation-duration: 1s; animation-delay: 0.6s; animation-name: fadeInUp;">
                    <div class="our-team">
                        <div class="single-team">
                            <img src="Team/Abhishek.jpeg" class="img-fluid" alt="">
                            <h3>Abhishek Tiwari</h3>
                            <p>Full Stack Developer</p>
                        </div>
                        <ul class="social">
                            <li><a href="https://api.whatsapp.com/send?phone=7488048437"><i
                                        class="fa-brands fa-whatsapp"></i></a></li>
                            <li><a href="https://lnkd.in/d9SJwVYF"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            <li><a
                                    href="mailto:210101120022@cutm.ac.in?subject=Question about your product&body=Dear seller,"><i
                                        class="fa-sharp fa-solid fa-envelope"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="bod" class="bod_area">
        <div class="container">
            <h2 class="title_spectial">Project Mentors</h2>
            <div class="row text-center">

                <div class="col-lg-6 col-xs-12 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s"
                    data-wow-offset="0" data-aos="flip-right"
                    style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                    <div class="our-bod">
                        <div class="single-bod">
                            <img src="Team/deansir.jpg" class="img-fluid" alt="">
                            <h3>Dr. Ashish Ranjan Das</h3>
                            <p>Dean, SoET</p>
                            <p>CUTM , Paralakhemundi</p>

                        </div>
                        <ul class="social">
                            <li><a href="https://api.whatsapp.com/send?phone=9437268679"><i
                                        class="fa-brands fa-whatsapp"></i></a></li>
                            <li><a
                                    href="mailto:ashish.dash@cutm.ac.in?subject=Question about your product&body=Dear seller,"><i
                                        class="fa-sharp fa-solid fa-envelope"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s"
                    data-wow-offset="0" data-aos="flip-right"
                    style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                    <div class="our-bod">
                        <div class="single-bod">
                            <img src="Team/Abhishek.jp" class="img-fluid" alt="">
                            <h3>Jyoti Mam</h3>
                            <p>Mentor</p>
                        </div>
                        <ul class="social">
                            <li><a href="https://api.whatsapp.com/send?phone=8455066018"><i
                                        class="fa-brands fa-whatsapp"></i></a></li>
                            <li><a
                                    href="mailto:jyotirmayee.behera@cutm.ac.in?subject=Question about your product&body=Dear seller,"><i
                                        class="fa-sharp fa-solid fa-envelope"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php @include 'footer.php' ?>
</body>
<script src="js/javascript1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
AOS.init({
    offset: 300,
    duration: 1000,
});
</script>

</html>