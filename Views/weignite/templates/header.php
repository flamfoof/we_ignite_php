<style media="screen">
    .center-message-header{
        position: absolute;
        top: 0;
        left: 0;
        width: 100vw;
        height: 642px;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .center-message-header h3{
        font-family: 'Roboto', sans-serif !important;
    }
    .center-message-header h3{
        font-size: 32px;
        color: #bbb9b7 !important;
    }
    .center-message-header a{
        display: block !important;
        width: 250px !important;
        margin: auto !important;
        font-size: 16px;
    }
    #contact_title{
        text-align: right !important;
    }
    #contact_text{
        text-align: left !important;
        margin-left: 20px !important;
    }
    @media only screen and (max-width: 800px) {
        .center-message-header{
            display: none;
        }
        #contact_title{
            text-align: center !important;
        }
        #contact_text{
            text-align: left !important;
            margin-left: auto !important;
        }
    }
</style>
<a href="javascript:" id="return-to-top"><span data-uk-icon="icon: chevron-up; ratio: 1" class="text-gray-extra-dark"></span></a>


<!-- Loading Screen -->
<div id="loader-wrapper">

    <!-- Loading Image -->
    <div class="loader-img"><img src="<?= base_url("weignite/assets/images/loading-screen.gif") ?>" alt="" /></div>
    <!-- END Loading Image -->


    <!-- Loading Screen Split -->
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
    <!-- End Loading Screen Split -->

</div>
<!-- End Loading Screen -->



<?php if (!isset($ignore_banner)): ?>
    <!-- Home -->
    <div class="uk-position-relative uk-visible-toggle uk-slideshow" data-uk-slideshow="animation: scale; autoplay: true; autoplay-interval: 3000">

        <!-- Container -->
        <ul class="uk-slideshow-items" data-uk-height-viewport="" style="min-height: calc(100vh);">

            <!-- Item -->
            <li class="uk-active uk-transition-active" style="z-index: -1;">

                <!-- Video -->
                <video src="<?= base_url("weignite/assets/videos/video.mp4") ?>" autoplay="" loop="" muted="" playsinline="" data-uk-cover="" class="uk-cover" style="height: 900px; width: 1803px;"></video>

                <!-- Overlay -->
                <div class="uk-position-cover uk-overlay-primary">

                    <!-- Column -->
                    <div class="text-right width-90 margin-bottom-five-percent sm-margin-bottom-100px sm-margin-right-25px uk-position-bottom-right">

                        <div>



                            <div class="no-margin-bottom text-weight-200 text-white sm-text-weight-400" style="text-align: left;">
                                <img src="<?= base_url("weignite/assets/images/logo-min.png") ?>" alt="">
                            </div>

                            <h1 class="margin-bottom-10px text-weight-800" style="font-family: 'Ubuntu', sans-serif; text-align: left;">
                                <span style="color: #eda90d;">We Ignite</span>
                            </h1>

                            <div class="separator bottom-border border-3px border-color-red" style="text-align: left; width: 20%; font-size: 24px; text-align: center; margin-top: 25px;">
                                Digital Events Reinvented
                            </div>


                            <div class="center-message-header">
                                <div class="">
                                    <h3>Schedule a free demo today</h3>
                                    <a href="#" class="btn btn-small btn-red margin-left-15px uk-visible@l" data-uk-toggle="target: .modal-1">
                                        Book now
                                    </a>
                                </div>
                            </div>


                        </div>

                    </div>
                    <!-- End Column -->

                </div>

            </li>
            <!-- End Item -->

        </ul>
        <!-- End Container -->

    </div>
<?php endif; ?>




<!-- Off-Canvas Navigation -->
<div id="offcanvas-nav" data-uk-offcanvas="mode: push; overlay: true; esc-close: true;">

    <!-- Off-Canvas Bar -->
    <div class="uk-offcanvas-bar menu-dark bg-white">

        <!-- Off-Canvas Links-->
        <ul class="uk-nav-default uk-nav-parent-icon text-left" data-uk-nav>


            <li class="margin-top-20px">
                <a class="uk-navbar-item uk-logo" href="<?= base_url("") ?>">
                    <img class="width-25px" src="<?= base_url("weignite/assets/images/logo-hor.png") ?>" alt="" />
                </a>
            </li>


            <!-- Link -->
            <li class="uk-parent margin-bottom-10px">

                <a href="<?= isset($ignore_banner) ? base_url() : "" ?>#home" class="bottom-border border-1px border-color-gray-extra-light">
                    <span class="text-small text-gray-extra-dark roboto text-weight-400 padding-bottom-20px">
                        Home
                    </span>
                </a>

            </li>
            <!-- End Link -->


            <!-- Link -->
            <li class="margin-bottom-10px">

                <a href="<?= isset($ignore_banner) ? base_url() : "" ?>#about" class="bottom-border border-1px border-color-gray-extra-light" <?= isset($ignore_banner) ? "" : "data-uk-scroll" ?>><span class="text-small text-gray-extra-dark roboto text-weight-400 padding-bottom-20px">About</span></a>


            </li>
            <!-- End Link -->


            <!-- Link -->
            <li class="margin-bottom-10px">

                <a href="#services" class="bottom-border border-1px border-color-gray-extra-light" <?= isset($ignore_banner) ? "" : "data-uk-scroll" ?>><span class="text-small text-gray-extra-dark roboto text-weight-400 padding-bottom-20px">Services</span></a>


            </li>
            <!-- End Link -->


            <!-- Link -->
            <li class="margin-bottom-10px">

                <a href="<?= isset($ignore_banner) ? base_url() : "" ?>#ignite" class="bottom-border border-1px border-color-gray-extra-light" <?= isset($ignore_banner) ? "" : "data-uk-scroll" ?>>
                    <span class="text-small text-gray-extra-dark roboto text-weight-400 padding-bottom-20px">How We Ignite</span>
                </a>

            </li>
            <!-- End Link -->



            <!-- Link -->
            <li class="margin-bottom-10px">

                <a href="<?= isset($ignore_banner) ? base_url() : "" ?>#team" class="bottom-border border-1px border-color-gray-extra-light" <?= isset($ignore_banner) ? "" : "data-uk-scroll" ?>>
                    <span class="text-small text-gray-extra-dark roboto text-weight-400 padding-bottom-20px">Team</span>
                </a>


            </li>
            <!-- End Link -->


            <!-- Link
            <li class="margin-bottom-10px">

                <a href="#team" class="bottom-border border-1px border-color-gray-extra-light" data-uk-scroll>
                    <span class="text-small text-gray-extra-dark roboto text-weight-400 padding-bottom-20px">Social Media</span>
                </a>


            </li>
            <!-- End Link -->


            <!-- Link -->
            <li class="margin-bottom-10px">

                <a href="<?= isset($ignore_banner) ? base_url() : "" ?>#faq" class="bottom-border border-1px border-color-gray-extra-light" <?= isset($ignore_banner) ? "" : "data-uk-scroll" ?>>
                    <span class="text-small text-gray-extra-dark roboto text-weight-400 padding-bottom-20px">FAQ</span>
                </a>


            </li>
            <!-- End Link -->


            <!-- Link -->
            <li class="margin-bottom-10px">

                <a href="<?= isset($ignore_banner) ? base_url() : "" ?>#contact" class="bottom-border border-1px border-color-gray-extra-light" <?= isset($ignore_banner) ? "" : "data-uk-scroll" ?>>
                    <span class="text-small text-gray-extra-dark roboto text-weight-400 padding-bottom-20px">Contact</span>
                </a>

            </li>
            <!-- End Link -->


        </ul>
        <!-- End Off-Canvas Links -->



        <!-- Navigation Footer -->
        <div class="nav-footer margin-top-50px">


            <!-- Social Links for Off-Canvas Footer -->
            <ul class="list-unstyled no-margin-bottom margin-top-20px">

                <li class="display-inline-block margin-right-25px"><a href="https://www.facebook.com/eventsreinvented/"><i class="fab fa-facebook facebook"></i></a></li>
                <li class="display-inline-block margin-right-25px"><a href="https://www.linkedin.com/company/49167432/"><i class="fab fa-linkedin linkedin"></i></a></li>
                <li class="display-inline-block margin-right-25px"><a href="https://www.instagram.com/weignite.us/"><i class="fab fa-instagram instagram"></i></a></li>

            </ul>
            <!-- End Social Links for Off-Canvas Footer -->

            <!-- Copyright Information -->
            <p class="no-margin-bottom margin-top-20px text-small text-gray-extra-dark text-weight-400">Copyright © 2020 of We Ignite.</p>
            <p class="no-margin-bottom text-small text-gray-dark text-weight-400 text-black">All rights reserved.</p>
            <!-- End Copyright Information -->

        </div>
        <!-- End Navigation Footer -->

    </div>
    <!-- End Off-Canvas Bar -->

</div>
<!-- End Off-Canvas Navigation -->

<style media="screen">
.uk-logo img {
    height: 52px;
    width: auto;
}
</style>


<!-- Header Light -->
<div class="z-index-999">

    <!-- Header Options -->
    <div class="navbar-white no-shadow" data-uk-sticky>

        <!-- Header Container -->
        <nav class="uk-navbar-container no-shadow" data-uk-navbar="boundary-align: true; align: center;">

            <!-- Navigation Left Side -->
            <div class="uk-navbar-left padding-left-two-percent">

                <!-- Logo Image -->
                <a class="uk-navbar-item uk-logo " href="<?= base_url("") ?>">
                    <img class="width-15px" src="<?= base_url("weignite/assets/images/logo-hor.png") ?>" alt="" />
                </a>

            </div>
            <!-- End Navigation Left Side -->



            <!-- Navigation Right Side -->
            <div class="uk-navbar-right uk-dark padding-right-two-percent">

                <!-- Links -->
                <ul class="uk-navbar-nav text-weight-600">


                <!-- Link -->
                <li>

                    <a class="text-gray-extra-light text-extra-small uk-visible@l" href="<?= isset($ignore_banner) ? base_url() : "" ?>#home">Home</a>

                </li>

                <!-- Link -->
                <li>

                    <a class="uk-visible@l" href="<?= isset($ignore_banner) ? base_url() : "" ?>#about" <?= isset($ignore_banner) ? "" : "data-uk-scroll" ?>>About</a>


                </li>

                <!-- Link -->
                <li>

                    <a class="uk-visible@l" href="<?= isset($ignore_banner) ? base_url() : "" ?>#services" <?= isset($ignore_banner) ? "" : "data-uk-scroll" ?>>Services</a>


                </li>


                <!-- Link -->
                <li>

                    <a class="uk-visible@l" href="<?= isset($ignore_banner) ? base_url() : "" ?>#ignite" <?= isset($ignore_banner) ? "" : "data-uk-scroll" ?>>How We Ingite</a>


                </li>

                <!-- Link -->
                <li>

                    <a class="uk-visible@l" href="<?= isset($ignore_banner) ? base_url() : "" ?>#team" <?= isset($ignore_banner) ? "" : "data-uk-scroll" ?>>Team</a>


                </li>


                <!-- Link -->
                <li>

                    <a class="uk-visible@l" href="<?= isset($ignore_banner) ? base_url() : "" ?>#faq" <?= isset($ignore_banner) ? "" : "data-uk-scroll" ?>>FAQ</a>


                </li>


                <!-- Link -->
                <li>

                    <a class="uk-visible@l" href="<?= isset($ignore_banner) ? base_url() : "" ?>#contact" <?= isset($ignore_banner) ? "" : "data-uk-scroll" ?>>Contact</a>


                </li>



                <!-- Off-Canvas Navigation Toggle -->
                <li>

                    <div class="uk-navbar-right uk-hidden@l">

                        <a class="uk-navbar-toggle" data-uk-navbar-toggle-icon data-uk-toggle="target: #offcanvas-nav"></a>

                    </div>

                </li>
                <!-- End Off-Canvas Navigation Toggle -->

            </ul>


            <!-- End Links -->
            <a href="#" class="btn btn-small btn-red margin-left-15px uk-visible@l" data-uk-toggle="target: .modal-1">
                Connect With Us
            </a>

            <!-- Modal Pop Up -->
            <div class="modal-1" data-uk-modal>

                <!-- Modal Container -->
                <div class="uk-modal-dialog width-500px uk-margin-auto-vertical overlay-black-dense text-center">

                    <button class="uk-modal-close-default" type="button" data-uk-close></button>

                    <!-- Newsletter Form -->
                    <form action="<?= base_url("contactar") ?>" id="contact_form" class="padding-75px" method="post">

                        <!-- Title -->
                        <h6 class="margin-bottom-30px text-weight-300 text-capitalize text-white">
                            We get in touch <span class="text-weight-800 text-red">with you.</span>
                        </h6>

                        <!-- Input -->
                        <div class="uk-inline margin-bottom-15px width-100">

                            <span class="uk-form-icon" data-uk-icon="icon: phone"></span>

                            <input name="ficha[phone]" id="phone" class="uk-input bg-transparent border-color-gray-dark" type="text" data-uk-tooltip="title: Phone number; pos: right">

                        </div>
                        <!-- End Input -->


                        <!-- Input -->
                        <div class="uk-inline margin-bottom-15px width-100">

                            <span class="uk-form-icon" data-uk-icon="icon: mail"></span>

                            <input name="ficha[email]" id="email" class="uk-input bg-transparent border-color-gray-dark" type="text" data-uk-tooltip="title: Email; pos: right">

                        </div>
                        <!-- End Input -->

                        <!-- Button -->
                        <button id="send" class="btn btn-medium btn-red sm-margin-left-right-auto sm-display-table">Contact me</button>

                    </form>
                    <!-- End Newsletter Form -->


                </div>
                <!-- End Modal Container -->

            </div>
            <!-- End Modal Pop Up -->


        </div>
        <!-- End Navigation Right Side -->

    </nav>
    <!-- End Header Container -->

</div>
<!-- End Header Options -->

</div>
<!-- End Header Light -->
