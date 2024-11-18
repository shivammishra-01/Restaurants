<?php session_start(); ?>
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
    <style>
    .Abhi {
        background-color: #a82c48;
        color: white;
    }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-info">
    <?php @include 'header.php' ?>
    <div class="container" style="margin-top: 60px;">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item Abhi Abhi">
                <h2 class="accordion-header " id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h5 class="text-dark">Privacy Policy</h5>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p class="text-white">At Centurion coffee connect, we value your privacy and are committed to
                            protecting your personal
                            information. This Privacy Policy outlines the types of information we collect and how we use
                            it when you use
                            our website.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item Abhi">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <h5 class="text-dark">Information We Collect</h5>
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p class="text-white"> When you visit our website, we may collect certain personal information,
                            such as your name, email address,
                            phone number, and other details that you voluntarily provide through our contact form or
                            reservation system.
                            We may also collect non-personal information, such as your IP address, browser type, and
                            device type.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item Abhi">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <h5 class="text-dark">How We Use Your Information</h5>

                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p class="text-white">We use the personal information you provide to respond to your inquiries,
                            process your reservations, and
                            improve our services. We may also use your information to send you promotional emails about
                            our restaurant
                            or to respond to legal requests.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item Abhi">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <h5 class="text-dark">Security</h5>

                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p class="text-white">
                            We may update this Privacy Policy from time to time to reflect changes in our practices or
                            legal
                            requirements. We encourage you to review this page periodically to stay informed about our
                            privacy
                            practices./p>
                    </div>
                </div>
            </div>
            <div class="accordion-item Abhi">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        <h5 class="text-dark">Updates to this Privacy Policy</h5>

                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p class="text-white">Our liability to you for any cause whatsoever and regardless of the form
                            of the action, will
                            at all times be
                            limited to the amount paid, if any, by you to us for the services during the term of the
                            agreement.</p>
                    </div>
                </div>
            </div>

            <hr>
            <p class="text-white">If you have any questions about these <a href="termcond.php" class="text-dark">Terms Conditions</a> and Privacy Policy, please <a href="mailto:ccc.pkd@cutm.ac.in?subject=Question about your product&body=Dear seller,"
                            class="me-4 text-dark">
                            Contact Us</a></p>
        </div>
    </div>
</body>

<script src="js/javascript1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>

</html>