<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Tak Tak - User-to-User Object Exchange</title>
  <meta name="description" content="Tak Tak is a web application for easy user-to-user object exchanges">

  <!-- Favicons -->
  <link href="<?=site_url('assets/img/taktak.png')?>" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?=site_url("/assets/vendor/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet">
  <link href="<?=site_url("assets/vendor/bootstrap-icons/bootstrap-icons.css")?>" rel="stylesheet">
  <link href="<?=site_url("assets/vendor/aos/aos.css")?>" rel="stylesheet">
  <link href="<?=site_url("assets/vendor/glightbox/css/glightbox.min.css")?>" rel="stylesheet">
  <link href="<?=site_url('assets/vendor/swiper/swiper-bundle.min.css')?>" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="<?=site_url('assets/css/main.css')?>" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="/" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
         <img src="<?=site_url('assets/img/taktak.png')?>" alt="">
        <h1 class="sitename">Tak Tak</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">How It Works</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="<?= site_url('/auth/login')?>">Sign In</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-lg-last">
            <img src="<?=site_url('assets/img/imageebgrm.png')?>" class="img-fluid" alt="Object Exchange Illustration">
          </div>
          <div class="col-lg-6  d-flex flex-column justify-content-center">
            <h1>Exchange Objects Easily with Tak Tak</h1>
            <p>Tak Tak is a user-friendly platform for exchanging objects with people in your community</p>
            <p>
            </p>
            <ul>
              <li><i class="bi bi-check2"></i> Easy-to-use interface for listing and browsing items</li>
             <!-- <li><i class="bi bi-check2"></i> Secure messaging system for arranging exchanges</li>
              <li><i class="bi bi-check2"></i> Community-driven ratings and reviews for trust and safety</li>-->
            </ul>
            <p></p>
            <div class="d-flex">
              <a href="#about" class="btn-get-started">Get Started</a>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-xl-center gy-5">

          <div class="col-xl-5 content">
            <h3>About Tak Tak</h3>
            <h2>Revolutionizing the Way We Exchange Objects</h2>
            <p>Tak Tak is a cutting-edge web application designed to facilitate easy and secure object exchanges between users. Our platform connects people who want to swap, trade, or give away items, creating a sustainable and community-driven marketplace.</p>
            <a href="#" class="read-more"><span>Learn More</span><i class="bi bi-arrow-right"></i></a>
          </div>

          <div class="col-xl-7">
            <div class="row gy-4 icon-boxes">

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="icon-box">
                  <i class="bi bi-people"></i>
                  <h3>Community-Driven</h3>
                  <p>Connect with like-minded individuals in your area who share your interests and values</p>
                </div>
              </div> <!-- End Icon Box -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box">
                  <i class="bi bi-shield-check"></i>
                  <h3>Secure Exchanges</h3>
                  <p>Our platform ensures safe and reliable transactions through user verification and secure messaging</p>
                </div>
              </div> <!-- End Icon Box -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="icon-box">
                  <i class="bi bi-recycle"></i>
                  <h3>Sustainable Living</h3>
                  <p>Promote eco-friendly practices by giving new life to pre-loved items and reducing waste</p>
                </div>
              </div> <!-- End Icon Box -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="icon-box">
                  <i class="bi bi-graph-up-arrow"></i>
                  <h3>Growing Network</h3>
                  <p>Join our rapidly expanding community of users and access a wide variety of items for exchange</p>
                </div>
              </div> <!-- End Icon Box -->

            </div>
          </div>

        </div>
      </div>

    </section><!-- /About Section -->

    <!-- Why Us Section -->
    <section id="why-us" class="why-us section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Why Choose Tak Tak</h2>
        <p>Discover the benefits of using Tak Tak for your object exchanges</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card-item">
              <span>01</span>
              <h4><a href="" class="stretched-link">User-Friendly Interface</a></h4>
              <p>Our intuitive design makes it easy to list items, browse exchanges, and communicate with other users</p>
            </div>
          </div><!-- Card Item -->

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card-item">
              <span>02</span>
              <h4><a href="" class="stretched-link">Local and Global Reach</a></h4>
              <p>Connect with users in your neighborhood or across the globe, expanding your exchange possibilities</p>
            </div>
          </div><!-- Card Item -->

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card-item">
              <span>03</span>
              <h4><a href="" class="stretched-link">Eco-Friendly Solution</a></h4>
              <p>Reduce waste and promote sustainability by giving pre-loved items a new home through exchanges</p>
            </div>
          </div><!-- Card Item -->

        </div>

      </div>

    </section><!-- /Why Us Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>How It Works</h2>
        <p>Follow these simple steps to start exchanging objects on Tak Tak</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item item-cyan position-relative">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,521.0016835830174C376.1290562159157,517.8887921683347,466.0731472004068,529.7835943286574,510.70327084640275,468.03025145048787C554.3714126377745,407.6079735673963,508.03601936045806,328.9844924480964,491.2728898941984,256.3432110539036C474.5976632858925,184.082847569629,479.9380746630129,96.60480741107993,416.23090153303,58.64404602377083C348.86323505073057,18.502131276798302,261.93793281208167,40.57373210992963,193.5410806939664,78.93577620505333C130.42746243093433,114.334589627462,98.30271207620316,179.96522072025542,76.75703585869454,249.04625023123273C51.97151888228291,328.5150500222984,13.704378332031375,421.85034740162234,66.52175969318436,486.19268352777647C119.04800174914682,550.1803526380478,217.28368757567262,524.383925680826,300,521.0016835830174"></path>
                </svg>
                <i class="bi bi-person-plus"></i>
              </div>
              <a href="<?= site_url('/auth/login')?>" class="stretched-link">
                <h3>Sign Up</h3>
              </a>
              <p>Create your Tak Tak account and set up your profile with your interests and preferences</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item item-orange position-relative">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,582.0697525312426C382.5290701553225,586.8405444964366,449.9789794690241,525.3245884688669,502.5850820975895,461.55621195738473C556.606425686781,396.0723002908107,615.8543463187945,314.28637112970534,586.6730223649479,234.56875336149918C558.9533121215079,158.8439757836574,454.9685369536778,164.00468322053177,381.49747125262974,130.76875717737553C312.15926192815925,99.40240125094834,248.97055460311594,18.661163978235184,179.8680185752513,50.54337015887873C110.5421016452524,82.52863877960104,119.82277516462835,180.83849132639028,109.12597500060166,256.43424936330496C100.08760227029461,320.3096726198365,92.17705696193138,384.0621239912766,124.79988738764834,439.7174275375508C164.83382741302287,508.01625554203684,220.96474134820875,577.5009287672846,300,582.0697525312426"></path>
                </svg>
                <i class="bi bi-camera"></i>
              </div>
              <a href="<?= site_url('/auth/login')?>" class="stretched-link">
                <h3>List Your Items</h3>
              </a>
              <p>Take photos and create listings for the items you want to exchange, including descriptions and condition</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item item-teal position-relative">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,541.5067337569781C382.14930387511276,545.0595476570109,479.8736841581634,548.3450877840088,526.4010558755058,480.5488172755941C571.5218469581645,414.80211281144784,517.5187510058486,332.0715597781072,496.52539010469104,255.14436215662573C477.37192572678356,184.95920475031193,473.57363656557914,105.61284051026155,413.0603344069578,65.22779650032875C343.27470386102294,18.654635553484475,251.2091493199835,5.337323636656869,175.0934190732945,40.62881213300186C97.87086631185822,76.43348514350839,51.98124368387456,156.15599469081315,36.44837278890362,239.84606092416172C21.716077023791087,319.22268207091537,43.775223500013084,401.1760424656574,96.891909868211,461.97329694683043C147.22146801428983,519.5804099606455,223.5754009179313,538.201503339737,300,541.5067337569781"></path>
                </svg>
                <i class="bi bi-search"></i>
              </div>
              <a href="<?= site_url('/auth/login')?>" class="stretched-link">
                <h3>Browse and Connect</h3>
              </a>
              <p>Search for items you're interested in and connect with other users to arrange exchanges</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item item-red position-relative">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,503.46388370962813C374.79870501325706,506.71871716319447,464.8034551963731,527.1746412648533,510.4981551193396,467.86667711651364C555.9287308511215,408.9015244558933,512.6030010748507,327.5744911775523,490.211057578863,256.5855673507754C471.097692560561,195.9906835881958,447.69079081568157,138.11976852964426,395.19560036434837,102.3242989838813C329.3053358748298,57.3949838291264,248.02791733380457,8.279543830951368,175.87071277845988,42.242879143198664C103.41431057327972,76.34704239035025,93.79494320519305,170.9812938413882,81.28167332365135,250.07896920659033C70.17666984294237,320.27484674793965,64.84698225790005,396.69656628748305,111.28512138212992,450.4950937839243C156.20124167950087,502.5303643271138,231.32542653798444,500.4755392045468,300,503.46388370962813"></path>
                </svg>
                <i class="bi bi-chat-dots"></i>
              </div>
              <a href="<?= site_url('/auth/login')?>" class="stretched-link">
                <h3>Communicate</h3>
              </a>
              <p>Use our secure messaging system to discuss exchange details and arrange meetups</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-item item-indigo position-relative">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,532.3542879108572C369.38199826031484,532.3153073249985,429.10787420159085,491.63046689027357,474.5244479745417,439.17860296908856C522.8885846962883,383.3225815378663,569.1668002868075,314.3205725914397,550.7432151929288,242.7694973846089C532.6665558377875,172.5657663291529,456.2379748765914,142.6223662098291,390.3689995646985,112.34683881706744C326.66090330228417,83.06452184765237,258.84405631176094,53.51806209861945,193.32584062364296,78.48882559362697C121.61183558270385,105.82097193414197,62.805066853699245,167.19869350419734,48.57481801355237,242.6138429142374C34.843463184063346,315.3850353017275,76.69343916112496,383.4422959591041,125.22947124332185,439.3748458443577C170.7312796277747,491.8107796887764,230.57421082200815,532.3932930995766,300,532.3542879108572"></path>
                </svg>
                <i class="bi bi-arrows-angle-contract"></i>
              </div>
              <a href="<?= site_url('/auth/login')?>" class="stretched-link">
                <h3>Exchange</h3>
              </a>
              <p>Meet up safely to complete your exchange and enjoy your new item</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item item-pink position-relative">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,566.797414625762C385.7384707136149,576.1784315230908,478.7894351017131,552.8928747891023,531.9192734346935,484.94944893311C584.6109503024035,417.5663521118492,582.489472248146,322.67544863468447,553.9536738515405,242.03673114598146C529.1557734026468,171.96086150256528,465.24506316201064,127.66468636344209,395.9583748389544,100.7403814666027C334.2173773831606,76.7482773500951,269.4350130405921,84.62216499799875,207.1952322260088,107.2889140133804C132.92018162631612,134.33871894543012,41.79353780512637,160.00259165414826,22.644507872594943,236.69541883565114C3.319112789854554,314.0945973066697,72.72355303640163,379.243833228382,124.04198916343866,440.3218312028393C172.9286146004772,498.5055451809895,224.45579914871206,558.5317968840102,300,566.797414625762"></path>
                </svg>
                <i class="bi bi-star"></i>
              </div>
              <a href="<?= site_url('/auth/login')?>" class="stretched-link">
                <h3>Rate and Review</h3>
              </a>
              <p>Leave feedback for your exchange partner to help build trust in the Tak Tak community</p>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Frequently Asked Questions</h2>
        <p>Get answers to common questions about using Tak Tak</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

            <div class="faq-container">

              <div class="faq-item">
                <h3>How does Tak Tak ensure safe exchanges?</h3>
                <div class="faq-content">
                  <p>Tak Tak uses user verification, secure messaging, and community ratings to promote safe exchanges. We also provide guidelines for safe meetups and encourage users to exchange in public places.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Is Tak Tak free to use?</h3>
                <div class="faq-content">
                  <p>Yes, Tak Tak is free to use for basic exchanges. We offer premium features for a small fee, but most users find the free version sufficient for their needs.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>What types of items can I exchange on Tak Tak?</h3>
                <div class="faq-content">
                  <p>Tak Tak supports exchanges of a wide variety of items, including books, clothing, electronics, furniture, and more. However, we prohibit the exchange of illegal items, weapons, and other potentially dangerous goods.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div><!-- End Faq Column-->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">

            <div class="faq-container">

              <div class="faq-item">
                <h3>How do I report a problem with an exchange or user?</h3>
                <div class="faq-content">
                  <p>If you encounter any issues during an exchange or with another user, you can use the "Report" button on the user's profile or the item listing. Our support team will review your report and take appropriate action.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Can I exchange items with users in other countries?</h3>
                <div class="faq-content">
                  <p>Yes, Tak Tak allows international exchanges. However, users are responsible for any shipping costs and customs fees associated with international exchanges.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>How does Tak Tak handle disputes between users?</h3>
                <div class="faq-content">
                  <p>In case of disputes, we encourage users to communicate and resolve issues amicably. If needed, our support team can mediate and help find a fair resolution based on our platform's policies and community guidelines.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div><!-- End Faq Column-->

        </div>

      </div>

    </section><!-- /Faq Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact Us</h2>
        <p>Get in touch with the Tak Tak team for support or inquiries</p>
      </div><!-- End Section Title -->

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer">
    <div class="container copyright text-center mt-4">
      <strong class="px-1 sitename">Tak Tak</strong> &copy; 2024. All Rights Reserved
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="<?=site_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
  <script src="<?=site_url('assets/vendor/aos/aos.js')?>"></script>
  <script src="<?=site_url('assets/vendor/glightbox/js/glightbox.min.js')?>"></script>
  <script src="<?=site_url('assets/vendor/purecounter/purecounter_vanilla.js')?>"></script>

  <!-- Main JS File -->
  <script src="<?=site_url('assets/js/main.js')?>"></script>

</body>

</html>