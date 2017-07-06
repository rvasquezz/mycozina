<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;

/**
 * @var $this \yii\base\View
 * @var $content string
 */
// $this->registerAssetBundle('app');
?>
<?php $this->beginPage(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="#">
        <title>Starter Template for Bootstrap</title>
        

        <link href="<?php echo $this->theme->baseUrl ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $this->theme->baseUrl ?>/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo $this->theme->baseUrl ?>/css/animsition.min.css" rel="stylesheet">
        <link href="<?php echo $this->theme->baseUrl ?>/css/animate.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="<?php echo $this->theme->baseUrl ?>/css/style.css" rel="stylesheet">
    </head>
    
<body class="home">
<?php $this->beginBody() ?>
  <!-- <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out"> -->
     <!-- <div class="site-wrapper " > -->
        <!--header starts-->
        <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="<?= yii\helpers\Url::to(["/site/index"]) ?>"> <img class="img-rounded" src="<?php echo $this->theme->baseUrl ?>/images/eslogan1.png" alt=""> </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="<?= yii\helpers\Url::to(["/site/index"]) ?>">Home <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Food</a>
                                <div class="dropdown-menu"> <a class="dropdown-item" href="<?= yii\helpers\Url::to(["/site/food-resultado"]) ?>">Food results</a> <a class="dropdown-item" href="<?= yii\helpers\Url::to(["/site/mapa-resultado"]) ?>">Map results</a></div>
                            </li>
                            <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Restaurants</a>
                                <div class="dropdown-menu"> <a class="dropdown-item" href="restaurants.php">Search results</a> <a class="dropdown-item" href="profile.php">Profile page</a></div>
                            </li>
                            <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Pages</a>
                                <div class="dropdown-menu"> <a class="dropdown-item" href="pricing.php">Pricing</a> <a class="dropdown-item" href="<?= yii\helpers\Url::to(["/site/contact"]) ?>">Contact</a> <a class="dropdown-item" href="submition.php">Submit restaurant</a> <a class="dropdown-item" href="<?= yii\helpers\Url::to(["/site/signup"]) ?>">Registration</a>
                                    <div class="dropdown-divider"></div> <a class="dropdown-item" href="checkout.php">Checkout</a> </div>
                            </li>

                             <li class="nav-item dropdown">  
                            <?php if (!Yii::$app->user->isGuest): ?>
                                   <?= Html::beginForm(['/site/logout'], 'post')
                                    . Html::submitButton(
                                        'Logout (' . Yii::$app->user->identity->nombres.' '.Yii::$app->user->identity->apellidos.')',
                                        ['class' => 'btn btn-link logout']
                                    )
                                    . Html::endForm(); ?>
                             <?php endif; ?>

                             <?php if (Yii::$app->user->isGuest): ?>
                                <?= Html::a('Login', ['site/login'], ['class' => 'nav-link']) ?>
                             <?php endif; ?>                               
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
            <!-- /.navbar -->
        </header>
     

   
       
           <div class="page-wrapper">

                <?= $content; ?>
                
           </div>


        <!-- Featured restaurants ends -->
        <section class="app-section">
            <div class="app-wrap">
                <div class="container">
                    <div class="row text-img-block text-xs-left">
                        <div class="container">
                            <div class="col-xs-12 col-sm-5 right-image text-center">
                                <figure> <img src="<?php echo $this->theme->baseUrl ?>/images/app.png" alt="Right Image" class="img-fluid"> </figure>
                            </div>
                            <div class="col-xs-12 col-sm-7 left-text">
                                <h3>The Best Food Delivery App</h3>
                                <p>Now you can make food happen pretty much wherever you are thanks to the free easy-to-use Food Delivery &amp; Takeout App.</p>
                                <div class="social-btns">
                                    <a href="#" class="app-btn apple-button clearfix">
                                        <div class="pull-left"><i class="fa fa-apple"></i> </div>
                                        <div class="pull-right"> <span class="text">Available on the</span> <span class="text-2">App Store</span> </div>
                                    </a>
                                    <a href="#" class="app-btn android-button clearfix">
                                        <div class="pull-left"><i class="fa fa-android"></i> </div>
                                        <div class="pull-right"> <span class="text">Available on the</span> <span class="text-2">Play store</span> </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- start: FOOTER -->
        <footer class="footer">
            <div class="container">
                <!-- top footer statrs -->
                <div class="row top-footer">
                    <div class="col-xs-12 col-sm-3 footer-logo-block color-gray">
                        <a href="#"> <img src="<?php echo $this->theme->baseUrl ?>/images/nombre.png" alt="Footer logo"> </a> <span>Order Delivery &amp; Take-Out </span> </div>
                    <div class="col-xs-12 col-sm-2 about color-gray">
                        <h5>About Us</h5>
                        <ul>
                            <li><a href="#">About us</a> </li>
                            <li><a href="#">History</a> </li>
                            <li><a href="#">Our Team</a> </li>
                            <li><a href="#">We are hiring</a> </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-2 how-it-works-links color-gray">
                        <h5>How it Works</h5>
                        <ul>
                            <li><a href="#">Enter your location</a> </li>
                            <li><a href="#">Choose restaurant</a> </li>
                            <li><a href="#">Choose meal</a> </li>
                            <li><a href="#">Pay via credit card</a> </li>
                            <li><a href="#">Wait for delivery</a> </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-2 pages color-gray">
                        <h5>Pages</h5>
                        <ul>
                            <li><a href="#">Search results page</a> </li>
                            <li><a href="#">User Sing Up Page</a> </li>
                            <li><a href="#">Pricing page</a> </li>
                            <li><a href="#">Make order</a> </li>
                            <li><a href="#">Add to cart</a> </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-3 popular-locations color-gray">
                        <h5>Popular locations</h5>
                        <ul>
                            <li><a href="#">Sarajevo</a> </li>
                            <li><a href="#">Split</a> </li>
                            <li><a href="#">Tuzla</a> </li>
                            <li><a href="#">Sibenik</a> </li>
                            <li><a href="#">Zagreb</a> </li>
                            <li><a href="#">Brcko</a> </li>
                            <li><a href="#">Beograd</a> </li>
                            <li><a href="#">New York</a> </li>
                            <li><a href="#">Gradacac</a> </li>
                            <li><a href="#">Los Angeles</a> </li>
                        </ul>
                    </div>
                </div>
                <!-- top footer ends -->
                <!-- bottom footer statrs -->
                <div class="bottom-footer">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 payment-options color-gray">
                            <h5>Payment Options</h5>
                            <ul>
                                <li>
                                    <a href="#"> <img src="<?php echo $this->theme->baseUrl ?>/images/paypal.png" alt="Paypal"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="<?php echo $this->theme->baseUrl ?>/images/mastercard.png" alt="Mastercard"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="<?php echo $this->theme->baseUrl ?>/images/maestro.png" alt="Maestro"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="<?php echo $this->theme->baseUrl ?>/images/stripe.png" alt="Stripe"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="<?php echo $this->theme->baseUrl ?>/images/bitcoin.png" alt="Bitcoin"> </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-4 address color-gray">
                            <h5>Address</h5>
                            <p>Concept design of oline food order and deliveye,planned as restaurant directory</p>
                            <h5>Phone: <a href="tel:+080000012222">080 000012 222</a></h5> </div>
                        <div class="col-xs-12 col-sm-5 additional-info color-gray">
                            <h5>Addition informations</h5>
                            <p>Join the thousands of other restaurants who benefit from having their menus on TakeOff</p>
                        </div>
                    </div>
                </div>
                <!-- bottom footer ends -->
            </div>
        </footer>
        <!-- end:Footer -->
    <!-- </div> -->
    <!--/end:Site wrapper -->
    <!-- Bootstrap core JavaScript
    ================================================== -->


   <script src="<?php echo $this->theme->baseUrl ?>/js/jquery.min.js"></script>
    <script src="<?php echo $this->theme->baseUrl ?>/js/tether.min.js"></script>
    <script src="<?php echo $this->theme->baseUrl ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo $this->theme->baseUrl ?>/js/animsition.min.js"></script>
    <script src="<?php echo $this->theme->baseUrl ?>/js/bootstrap-slider.min.js"></script>
    <script src="<?php echo $this->theme->baseUrl ?>/js/jquery.isotope.min.js"></script>
    <script src="<?php echo $this->theme->baseUrl ?>/js/headroom.js"></script>
    <script src="<?php echo $this->theme->baseUrl ?>/js/foodpicky.min.js"></script>

<!--     <script src="<?php echo $this->theme->baseUrl ?>/js/tether.min.js"></script>
    <script src="<?php echo $this->theme->baseUrl ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo $this->theme->baseUrl ?>/js/animsition.min.js"></script> 
    <script src="<?php echo $this->theme->baseUrl ?>/js/bootstrap-slider.min.js"></script>
    <script src="<?php echo $this->theme->baseUrl ?>/js/jquery.isotope.min.js"></script>
    <script src="<?php echo $this->theme->baseUrl ?>/js/headroom.js"></script>
    <script src="<?php echo $this->theme->baseUrl ?>/js/foodpicky.min.js"></script>
    <script src="<?php echo $this->theme->baseUrl ?>/js/bootstrap-slider.min.js"></script>
    <script src="<?php echo $this->theme->baseUrl ?>/js/markerclusterer.js"></script>
    <script src="<?php echo $this->theme->baseUrl ?>/js/jquery.googlemap.js"></script>
    <script src="<?php echo $this->theme->baseUrl ?>/js/data.json"></script> -->
    <?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>