<?php
require '../../funcs/conexion.php';
require '../../funcs/funcs.php';
session_start();

if (!isset($_SESSION['id'])) {
    echo '<p><script>Swal.fire({
          title: "Warning",
          text: "LogIn again"
          }).then(function() {
          window.location = "../user/login.php";
          });</script></p>';
    exit; // Salir del script si no hay sesión iniciada
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Tivo is a HTML landing page template built with Bootstrap to help you crate engaging presentations for SaaS apps and convert visitors into users.">
    <meta name="author" content="Inovatik">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content="" /> <!-- website name -->
    <meta property="og:site" content="" /> <!-- website link -->
    <meta property="og:title" content="" /> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article" />

    <!-- Website Title -->
    <title>Terms Conditions - LifeLine</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext"
        rel="stylesheet">
    <link href="../../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../../assets/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../../assets/boss/css/swiper.css" rel="stylesheet">
    <link href="../../assets/boss/css/magnific-popup.css" rel="stylesheet">
    <link href="../../assets/boss/css/styles.css" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="../../assets/boss/images/latido-del-corazon2.png">
</head>

<body data-spy="scroll" data-target=".fixed-top">

    <!-- Preloader -->
    <div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- end of preloader -->


    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">

            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Tivo</a> -->

            <!-- Image Logo -->
            <a class="navbar-brand logo-image" href="index.html"><img src="../../assets/boss/images/logo.png"
                    alt="alternative"></a>

            <!-- Mobile Menu Toggle Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-awesome fas fa-bars"></span>
                <span class="navbar-toggler-awesome fas fa-times"></span>
            </button>
            <!-- end of mobile menu toggle button -->

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                        <a class="nav-link page-scroll" href="view_user.php">HOME <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../spanish/buy.php">ESPAÑOL <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../support/users.php">CHAT-SUPPORT <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../profile/profile.php">MY PROFILE <span class="sr-only">(current)</span></a>
                    </li>
                    <!-- Dropdown Menu -->
                    
                    <!-- end of dropdown menu -->

                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="index.html#pricing">PRICING</a>
                    </li>
                </ul>
                <span class="nav-item">
                    <a class="btn-outline-sm" href="log-in.html">LOG IN</a>
                </span>
            </div>
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->


    <!-- Header -->
    <header id="header" class="ex-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Terms & Conditions</h1>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of ex-header -->
    <!-- end of header -->


    <!-- Breadcrumbs -->
    <div class="ex-basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs">
                        <a href="index.html">Home</a><i class="fa fa-angle-double-right"></i><span>Terms &
                            Conditions</span>
                    </div> <!-- end of breadcrumbs -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of ex-basic-1 -->
    <!-- end of breadcrumbs -->


    <!-- Terms Content -->
    <div class="ex-basic-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container">
                        <h3>Introduction</h3>
                        <p>Welcome to LifeLine. By purchasing or using our insurance products and services,
                            you agree to comply with and be bound by the following terms and conditions. Please read
                            these Terms carefully.
                            If you do not agree with these Terms, you should not use our products or services.</p>

                        <h3>Definitions</h3>
                        <ul class="list-unstyled li-space-lg indent">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Policyholder:</b> The individual or entity that has purchased
                                    an insurance policy from LifeLine.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Insured:</b> The individual(s) or entity covered under the
                                    insurance policy.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Policy:</b> The insurance contract between the policyholder
                                    and LifeLine.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Premium:</b> The amount paid by the policyholder to
                                    LifeLine's for insurance coverage.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Claim:</b> A request by the insured or policyholder for
                                    payment or services under the terms of the policy.</div>
                            </li>
                        </ul>
                    </div> <!-- end of text-container -->

                    <div class="text-container">
                        <h3>Policy Agreement</h3>
                        <ul class="list-unstyled li-space-lg indent">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Coverage:</b> The coverage provided by the insurance policy
                                    is specified in the policy documentation, including any endorsements, riders, or
                                    amendments.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Policy Period:</b> The duration of the policy is stated in
                                    the policy documentation. Coverage begins and ends at 12:01 AM local time at the
                                    insured's address on the dates specified.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Premium Payments:</b> Premiums must be paid on time to
                                    maintain coverage. Failure to pay premiums may result in cancellation of the policy.
                                </div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><b>Cancellation:</b> Either party may cancel the policy as
                                    outlined in the policy documentation. Refunds of unearned premiums will be handled
                                    as specified in the policy terms.</div>
                            </li>
                        </ul>
                    </div> <!-- end of text-container -->

                    <div class="text-container">
                        <p>LifeLine reserves the right to amend these Terms at any time. Any amendments will be
                            communicated to the policyholder and will become effective as specified in the communication
                        </p>
                    </div> <!-- end of text-container -->

                    <div class="text-container last">
                    
                        <form method="POST" action="confirmarCompra.php">
                        <div class="form-group checkbox">
                                <input type="checkbox" id="terms" name="terms" required>I have read and I agree to LifeLine's Terms Conditions
                                <div class="help-block with-errors"></div>
                            </div>
                            <button type="submit" class="btn-solid-reg page-scroll">BUY</button>
                        </form>
                    </div> <!-- end of text-container -->
                </div>
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of ex-basic -->
    <!-- end of terms content -->


    <!-- Footer -->
    <svg class="footer-frame" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
        viewBox="0 0 1920 79">
        <defs>
            <style>
                .cls-2 {
                    fill: #3b5d50;
                }
            </style>
        </defs>
        <title>footer-frame</title>
        <path class="cls-2"
            d="M0,72.427C143,12.138,255.5,4.577,328.644,7.943c147.721,6.8,183.881,60.242,320.83,53.737,143-6.793,167.826-68.128,293-60.9,109.095,6.3,115.68,54.364,225.251,57.319,113.58,3.064,138.8-47.711,251.189-41.8,104.012,5.474,109.713,50.4,197.369,46.572,89.549-3.91,124.375-52.563,227.622-50.155A338.646,338.646,0,0,1,1920,23.467V79.75H0V72.427Z"
            transform="translate(0 -0.188)" />
    </svg>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-col first">
                        <h4>About Tivo</h4>
                        <p class="p-small">We're passionate about offering some of the best business growth services for
                            start more words</p>
                    </div>
                </div> <!-- end of col -->
                <div class="col-md-4">
                    <div class="footer-col middle">
                        <h4>Important Links</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Our business partners <a class="white"
                                        href="#your-link">startupguide.com</a></div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Read our <a class="white" href="terms-conditions.html">Terms &
                                        Conditions</a>, <a class="white" href="privacy-policy.html">Privacy Policy</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div> <!-- end of col -->
                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Contact</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="media-body">22 Innovative, San Francisco, CA 94043, US</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-envelope"></i>
                                <div class="media-body"><a class="white"
                                        href="mailto:contact@Tivo.com">contact@Tivo.com</a> <i
                                        class="fas fa-globe"></i><a class="white" href="#your-link">www.Tivo.com</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of footer -->
    <!-- end of footer -->


    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © 2020 <a href="https://inovatik.com">Template by Inovatik</a></p>
                </div> <!-- end of col -->
            </div> <!-- enf of row -->
        </div> <!-- end of container -->
    </div> <!-- end of copyright -->
    <!-- end of copyright -->


    <!-- Scripts -->
    <script src="../../assets/boss/js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="../../assets/boss/js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="../../assets/boss/js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="../../assets/boss/js/jquery.easing.min.js"></script>
    <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="../../assets/boss/js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="../../assets/boss/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <!--<script src="js/validator.min.js"></script>  Validator.js - Bootstrap plugin that validates forms -->
    <script src="../../assets/boss/js/scripts.js"></script> <!-- Custom scripts -->
    <script>
    function verificarCheckbox() {
            var checkbox = document.getElementById("terms");
            if (checkbox.disabled) {
                alert("The checkbox is disabled.");
                return false; // Evita el envío del formulario
            }
            return true; // Permite el envío del formulario
        }
        </script>
</body>

</html>