<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>LifeLine</title>
    <link rel="icon" href="../assets/boss/images/favicon.png">
</head>

<body>

</body>

</html>
<b></b>
<?php
session_start();

if (!isset($_SESSION['id'])) {
    echo '<p><script>Swal.fire({
          title: "Warning",
          text: "LogIn again"
          }).then(function() {
          window.location = "../views/index.php";
          });</script></p>';
    exit; // Salir del script si no hay sesión iniciada
}

$nombre = $_SESSION['nombre'];
$tipo_usuario = $_SESSION['tipo_usuario'];
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
    <title>LifeLine</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext"
        rel="stylesheet">
    <link href="../assets/boss/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/boss/css/fontawesome-all.css" rel="stylesheet">
    <link href="../assets/boss/css/swiper.css" rel="stylesheet">
    <link href="../assets/boss/css/magnific-popup.css" rel="stylesheet">
    <link href="../assets/boss/css/styles.css" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="../assets/boss/images/latido-del-corazon2.png">
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
            <a class="navbar-brand logo-image" href="view_user.php"><img src="../assets/boss/images/logo.png"
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
                        <a class="nav-link page-scroll" href="view_user.php">HOME <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="../views/support/home.php">CHAT-SUPPORT <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <!-- Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle page-scroll" href="#video" id="navbarDropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">VIDEO</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="article-details.html"><span class="item-text">ARTICLE
                                    DETAILS</span></a>
                            <div class="dropdown-items-divide-hr"></div>
                            <a class="dropdown-item" href="terms-conditions.html"><span class="item-text">TERMS
                                    CONDITIONS</span></a>
                            <div class="dropdown-items-divide-hr"></div>
                            <a class="dropdown-item" href="privacy-policy.html"><span class="item-text">PRIVACY
                                    POLICY</span></a>
                        </div>
                    </li>
                    <!-- end of dropdown menu -->

                </ul>
                <span class="nav-item">
                    <a class="btn-outline-sm" href="logout.php">LOG OUT</a>
                </span>
            </div>
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->


    <!-- Header -->
    <header id="header" class="header">
        <div class="header-content">
            
        </div> <!-- end of header-content -->
    </header> <!-- end of header -->
    
    <!-- end of header -->


    <!-- Customers -->
    
    <!-- end of customers -->


    <!-- Details -->
    <div id="details" class="basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="text-container">
                        <h2>Now is the time to upgrade your car insurance</h2>
                        <p>Here at LifeLine we focus on our customer's safety, that's why we offer the best car
                            insurance plans. Click down below to enter a request for a price quote.
                        </p>
                        <ul class="list-unstyled li-space-lg">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Damage to the insured vehicle</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Civil Liability for injury or death of third parties</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Total or Partial Theft</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Civil Liability for property damage to third parties' assets
                                </div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">24/7 towing service all around the country</div>
                            </li>
                        </ul>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="../assets/images/33.png" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-1 -->
    <!-- end of details -->


    <!-- Pricing -->
    <div id="pricing" class="cards-2 tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="above-heading">PRICING</div>
                    <h2 class="h2-heading">Pricing Options Table</h2>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">
                    <!-- Tabs Links -->
                    <ul class="nav nav-tabs" id="argoTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="nav-tab-1" data-toggle="tab" href="#tab-1" role="tab"
                                aria-controls="tab-1" aria-selected="true"><i class="fas fa-motorcycle"></i>Motorcycle</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-tab-2" data-toggle="tab" href="#tab-2" role="tab"
                                aria-controls="tab-2" aria-selected="false"><i class="fas fa-car"></i>Civil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-tab-3" data-toggle="tab" href="#tab-3" role="tab"
                                aria-controls="tab-3" aria-selected="false"><i class="fas fa-tractor"></i>Utility</a>
                        </li>
                    </ul>
                    <!-- end of tabs links -->

                    <!-- Tabs Content -->
                    <div class="tab-content" id="argoTabsContent">
                        <!-- Tab -->
                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
                            <div class="row">

                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">SILVER</div>
                                        <div class="price"><span class="currency">$</span><span
                                                class="value">19.99</span></div>
                                        <div class="frequency">Monthly</div>
                                        <div class="divider"></div>
                                        <ul class="list-unstyled li-space-lg">
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Third-Party Liability</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Damage to your Motorcycle</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Roadside Assistance</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-times"></i>
                                                <div class="media-body">Theft</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-times"></i>
                                                <div class="media-body">Legal Assistance</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-times"></i>
                                                <div class="media-body">Coverage for Rider's Injuries</div>
                                            </li>
                                        </ul>
                                        <div class="button-wrapper">
                                        <form method="POST" action="cotizar.php">
                                            <button type="submit"  class="btn-solid-reg page-scroll" name="pdf" id="pdf" value="moto" href="cotizar.php">Price Quote</button>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- end of card -->

                                <div class=" card">
                                    <div class="card-body ">
                                        <div class="card-title">GOLD</div>
                                        <div class="price"><span class="currency">$</span><span
                                                class="value">29.99</span></div>
                                        <div class="frequency">Monthly</div>
                                        <div class="divider"></div>
                                        <ul class="list-unstyled li-space-lg">
                                        <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Extended Third-Party Liability</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Expanded Motorcycle Damage Coverage</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Total and Partial Theft</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Legal Assistance</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-times"></i>
                                                <div class="media-body">Extended Travel Assistance</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-times"></i>
                                                <div class="media-body">Coverage for Rider's Injuries</div>
                                            </li>
                                        </ul>
                                        <div class="button-wrapper">
                                        <form method="POST" action="cotizar.php">
                                            <button type="submit"  class="btn-solid-reg page-scroll" name="pdf" id="pdf" value="moto" href="cotizar.php">Price Quote</button>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- end of card -->

                                <div class=" card">
                                    <div class="card-body ">
                                        <div class="card-title">DIAMOND</div>
                                        <div class="price"><span class="currency">$</span><span
                                                class="value">39.99</span></div>
                                        <div class="frequency">Monthly</div>
                                        <div class="divider"></div>
                                        <ul class="list-unstyled li-space-lg">
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Maximum Third-Party Liability</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Maximum Motorcycle Damage Coverage with Agreed Value</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Total and Partial Theft Expanded</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Maximum Travel Assistance</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Coverage for Rider's Injuries</div>
                                            </li>
                                        </ul>
                                        <div class="button-wrapper">
                                            <form method="POST" action="cotizar.php">
                                            <button type="submit"  class="btn-solid-reg page-scroll" name="pdf" id="pdf" value="moto" href="cotizar.php">Price Quote</button>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- end of card -->

                            </div> <!-- end of col -->

                        </div> <!-- end of tab-pane -->
                        <!-- end of tab -->

                        <!-- Tab -->
                        
                        <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2">
                            <div class="row">
                                <div class="card">
                                    <div class="card-body ">
                                        <div class="card-title">SILVER</div>
                                        <div class="price"><span class="currency">$</span><span
                                                class="value">24.99</span></div>
                                        <div class="frequency">Monthly</div>
                                        <div class="divider"></div>
                                        <ul class="list-unstyled li-space-lg">
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Third-Party Liability</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Collision Coverage</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Comprehensive Coverage</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Roadside Assistance</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-times"></i>
                                                <div class="media-body">Legal Assistance</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-times"></i>
                                                <div class="media-body">Coverage for Occupant Injuries</div>
                                            </li>
                                        </ul>
                                        <div class="button-wrapper">
                                        <form method="POST" action="cotizar.php">
                                            <button type="submit"  class="btn-solid-reg page-scroll" name="pdf" id="pdf" value="car" href="cotizar.php">Price Quote</button>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- end of card -->

                                <div class="card">
                                    <div class="card-body ">
                                        <div class="card-title">GOLD</div>
                                        <div class="price"><span class="currency">$</span><span
                                                class="value">39.99</span></div>
                                        <div class="frequency">Monthly</div>
                                        <div class="divider"></div>
                                        <ul class="list-unstyled li-space-lg">
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Extended Third-Party Liability</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Expanded Collision Coverage</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Expanded Non-collision Coverage</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Total and Partial Theft</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Legal Assistance</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-times"></i>
                                                <div class="media-body">Coverage for Occupant Injuries</div>
                                            </li>
                                        </ul>
                                        <div class="button-wrapper">
                                        <form method="POST" action="cotizar.php">
                                            <button type="submit"  class="btn-solid-reg page-scroll" name="pdf" id="pdf" value="car" href="cotizar.php">Price Quote</button>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- end of card -->

                                <div class="card">
                                    <div class="card-body ">
                                        <div class="card-title">DIAMOND</div>
                                        <div class="price"><span class="currency">$</span><span
                                                class="value">49.99</span></div>
                                        <div class="frequency">Monthly</div>
                                        <div class="divider"></div>
                                        <ul class="list-unstyled li-space-lg">
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Maximum Third-Party Liability</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Expanded Collision Coverage with Agreed Value</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Expanded Comprehensive Coverage with Deductible Waiver</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Total and Partial Theft Expanded</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Maximum Travel Assistance</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Coverage for Occupant Injuries</div>
                                            </li>
                                        </ul>
                                        <div class="button-wrapper">
                                        <form method="POST" action="cotizar.php">
                                            <button type="submit"  class="btn-solid-reg page-scroll" name="pdf" id="pdf" value="car" href="cotizar.php">Price Quote</button>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- end of card -->

                            </div> <!-- end of col -->
                        </div> <!-- end of col -->
                        

                        <!-- end of tab -->

                        <!-- Tab -->
                        
                        <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab-3">
                            <div class="row">
                                <div class="card">
                                    <div class="card-body ">
                                        <div class="card-title">SILVER</div>
                                        <div class="price"><span class="currency">$</span><span
                                                class="value">49.99</span>
                                        </div>
                                        <div class="frequency">Monthly</div>
                                        <div class="divider"></div>
                                        <ul class="list-unstyled li-space-lg">
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Liability Coverage</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Collision Coverage</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-times"></i>
                                                <div class="media-body">Non-collision Coverage</div>
                                            </li>
                                        </ul>
                                        <div class="button-wrapper">
                                        <form method="POST" action="cotizar.php">
                                            <button type="submit"  class="btn-solid-reg page-scroll" name="pdf" id="pdf" value="industry" href="cotizar.php">Price Quote</button>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- end of card -->

                                <div class="card">
                                    <div class="card-body ">
                                        <div class="card-title">GOLD</div>
                                        <div class="price"><span class="currency">$</span><span
                                                class="value">64.99</span>
                                        </div>
                                        <div class="frequency">Monthly</div>
                                        <div class="divider"></div>
                                        <ul class="list-unstyled li-space-lg">
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Extended Liability Coverage</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Rental Reimbursement</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-times"></i>
                                                <div class="media-body">Towing and Roadside Assistance</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-times"></i>
                                                <div class="media-body">Uninsured/Underinsured Motorist Coverage</div>
                                            </li>
                                        </ul>
                                        <div class="button-wrapper">
                                        <form method="POST" action="cotizar.php">
                                            <button type="submit"  class="btn-solid-reg page-scroll" name="pdf" id="pdf" value="industry" href="cotizar.php">Price Quote</button>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- end of card -->

                                <div class="card">
                                    <div class="card-body ">
                                        <div class="card-title">DIAMOND</div>
                                        <div class="price"><span class="currency">$</span><span
                                                class="value">99.99</span>
                                        </div>
                                        <div class="frequency">Monthly</div>
                                        <div class="divider"></div>
                                        <ul class="list-unstyled li-space-lg">
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Agreed Value Coverage</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Business Interruption Coverage</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Equipment Coverage</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Loss of Use Coverage</div>
                                            </li>
                                            <li class="media">
                                                <i class="fas fa-check"></i>
                                                <div class="media-body">Enhanced Medical Payments</div>
                                            </li>
                                        </ul>
                                        <div class="button-wrapper">
                                        <form method="POST" action="cotizar.php">
                                            <button type="submit"  class="btn-solid-reg page-scroll" name="pdf" id="pdf" value="industry" href="cotizar.php">Price Quote</button>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- end of card -->

                            </div> <!-- end of col -->
                        </div> <!-- end of col -->
                        
                    </div> <!-- end of tab-pane -->
                </div> <!-- end of row -->
            </div> <!-- end of tab-pane -->
            <!-- end of tab -->

        </div> <!-- end of tab content -->


    </div> <!-- end of col -->
    </div> <!-- end of row -->
    </div> <!-- end of container -->
    </div> <!-- end of cards-2 -->
    <!-- end of pricing -->


    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-col first">
                        <h4>About LifeLine</h4>
                        <p class="p-small">We are one of your best options in the market to acquire an insurance policy.
                        </p>
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
                                <div class="media-body">Read our <a class="white"
                                        href="views/terms-conditions.html">Terms &
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
                                <div class="media-body"> Calle Don Bosco y Av. Manuel Gallardo, 1-1, Santa Tecla</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-envelope"></i>
                                <div class="media-body">
                                    <a class="white"
                                        href="mailto:lifeline.ptc.2024@gmail.com">lifeline.ptc.2024@gmail.com</a>
                                    <i class="fas fa-globe"></i>
                                    <a class="white" href="#your-link">www.LifeLine.com</a>
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
                    <p class="p-small">Copyright © 2020 Template by LifeLine</p>
                </div> <!-- end of col -->
            </div> <!-- enf of row -->
        </div> <!-- end of container -->
    </div> <!-- end of copyright -->
    <!-- end of copyright -->


    <!-- Scripts -->
    <script src="../assets/boss/js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="../assets/boss/js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="../assets/boss/js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="../assets/boss/js/jquery.easing.min.js"></script>
    <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="../assets/boss/js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="../assets/boss/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <!--<script src="js/validator.min.js"></script>  Validator.js - Bootstrap plugin that validates forms -->
    <script src="../assets/boss/js/scripts.js"></script> <!-- Custom scripts -->
</body>

</html>