<?php 
  $pagename = "Centre Equestre";
  include "./inc/bdd.inc.php"; 
  include dirname(__FILE__)."/vue/header.php";

  ?>
  <body>
    <div class="preloader">
      <div class="wrapper-triangle">
        <div class="pen">
          <div class="line-triangle">
            <div class="triangle"></div>
            <div class="triangle"></div>
            <div class="triangle"></div>
            <div class="triangle"></div>
            <div class="triangle"></div>
            <div class="triangle"></div>
            <div class="triangle"></div>
          </div>
          <div class="line-triangle">
            <div class="triangle"></div>
            <div class="triangle"></div>
            <div class="triangle"></div>
            <div class="triangle"></div>
            <div class="triangle"></div>
            <div class="triangle"></div>
            <div class="triangle"></div>
          </div>
          <div class="line-triangle">
            <div class="triangle"></div>
            <div class="triangle"></div>
            <div class="triangle"></div>
            <div class="triangle"></div>
            <div class="triangle"></div>
            <div class="triangle"></div>
            <div class="triangle"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="page">

      <!-- Swiper-->
      <section class="section swiper-container swiper-slider swiper-slider-2 swiper-slider-3" data-loop="true" data-autoplay="5000" data-simulate-touch="false" data-slide-effect="fade">
        <div class="swiper-wrapper text-sm-left">
          <div class="swiper-slide context-dark" data-slide-bg="media/accueil-photo-1.jpg">
            <div class="swiper-slide-caption section-md">
              <div class="container">
                <div class="row">
                  <div class="col-sm-9 col-md-8 col-lg-7 col-xl-7 offset-lg-1 offset-xxl-0">
                    <h1 class="oh swiper-title"><span class="d-inline-block" data-caption-animate="slideInUp" data-caption-delay="0">Centre Equestre Qualifié</span></h1>
                    <p class="big swiper-text" data-caption-animate="fadeInLeft" data-caption-delay="300">Des cours pour enfants et cavaliers aguéris</p>
                    <div class="button-wrap oh"><a class="button button-lg button-primary button-winona button-shadow-2" href="#" data-caption-animate="slideInUp" data-caption-delay="0">Rencontrer nos moniteurs</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide context-dark" data-slide-bg="media/accueil-photo-5.jpg">
            <div class="swiper-slide-caption section-md">
              <div class="container">
                <div class="row">
                  <div class="col-sm-8 col-lg-8 offset-lg-1 offset-xxl-0">
                    <h1 class="oh swiper-title"><span class="d-inline-block" data-caption-animate="slideInDown" data-caption-delay="0">Parmis les plus beaux environnements de la corrèze</span></h1>
                    <p class="big swiper-text" data-caption-animate="fadeInRight" data-caption-delay="300">Grâçe à 2 milles hectares de végétation au coeur de la plus belle région de France</p>
                    <div class="button-wrap oh"><a class="button button-lg button-primary button-winona button-shadow-2" href="#" data-caption-animate="slideInUp" data-caption-delay="0">Découvrez le centre</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Swiper Pagination-->
        <div class="swiper-pagination" data-bullet-custom="true"></div>
        <!-- Swiper Navigation-->
        <div class="swiper-button-prev">
          <div class="preview">
            <div class="preview__img"></div>
          </div>
          <div class="swiper-button-arrow"></div>
        </div>
        <div class="swiper-button-next">
          <div class="swiper-button-arrow"></div>
          <div class="preview">
            <div class="preview__img"></div>
          </div>
        </div>
      </section>
      <!-- What We Offer-->
      <section class="section section-md bg-default">
        <div class="container">
          <h3 class="oh-desktop"><span class="d-inline-block wow slideInDown">La vie au Club</span></h3>

          <div class="row row-md row-30">

            <div class="col-sm-6 col-lg-4">
              <div class="oh-desktop">
                <!-- Services Terri-->
                <article class="services-terri wow slideInDown">
                  <div class="services-terri-figure"><img src="media/stock-photo-beautiful-draft-horse-on-the-pasture-large-horse-bred-to-be-a-working-animal-doing-hard-tasks-such-1860914509.jpg" alt="" width="370" height="278"/>
                  </div>
                  <div class="services-terri-caption"><span class="services-terri-icon linearicons-star"></span>
                    <form action="./controller/CoursController.php" method="post">
                        <input type="hidden" name="display_cours">
                        <h5 class="services-terri-title"><input value="Les cours" type="submit"></h5>
                    </form>
                      
                  </div>
                </article>
              </div>
            </div>

            <div class="col-sm-6 col-lg-4">
              <div class="oh-desktop">
                <!-- Services Terri-->
                <article class="services-terri wow slideInDown">  
                    <div class="services-terri-figure"><img src="media/stock-photo-welsh-pony-running-and-standing-in-high-grass-long-mane-brown-horse-galloping-brown-horse-1175510683.jpg" alt="" width="370" height="278"/>
                    </div>
                    <div class="services-terri-caption"><span class="services-terri-icon linearicons-heart"></span>
                      <form action="./controller/ChevalController.php" method="post">
                        <input type="hidden" name="front_che">
                        <h5 class="services-terri-title"><input value="Nos chevaux" type="submit"></h5>
                      </form>
                    </div>
                </article>
              </div>
            </div>

            <div class="col-sm-6 col-lg-4">
              <div class="oh-desktop">
                <!-- Services Terri-->
                <article class="services-terri wow slideInUp">
                  <div class="services-terri-figure"><img src="media/stock-photo-close-up-portrait-of-horse-1889100730.jpg" alt="" width="370" height="278"/>
                  </div>
                  <div class="services-terri-caption"><span class="services-terri-icon linearicons-sun"></span>
                    <form action="./controller/ChevalController.php" method="post">
                        <input type="hidden" name="display_gallery">
                        <h5 class="services-terri-title"><input value="Galerie" type="submit"></h5>
                    </form>
                  </div>
                </article>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Section CTA-->
      <section class="primary-overlay section parallax-container" data-parallax-img="media/accueil-photo-3.jpg  ">
        <div class="parallax-content section-xl context-dark text-md-left">
          <div class="container">
            <div class="row justify-content-end">
              <div class="col-sm-8 col-md-7 col-lg-5">
                <div class="cta-modern">
                  <h3 class="cta-modern-title wow fadeInRight">Notre Histoire</h3>
                  <p class="lead">Parmi les premiers centres équestres de la région, il a été fondé au coeur d'une des plus belles forêts de France</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>



      <!-- What We Offer-->
      <section class="section section-xl bg-default">
        <div class="container">
          <h3 class="wow fadeInLeft">Nos recommendations</h3>
        </div>
        <div class="container container-style-1">
          <div class="owl-carousel owl-style-12" data-items="1" data-sm-items="2" data-lg-items="3" data-margin="30" data-xl-margin="45" data-autoplay="true" data-nav="true" data-center="true" data-smart-speed="400">
            <!-- Quote Tara-->
            <article class="quote-tara">
              <div class="quote-tara-caption">
                <div class="quote-tara-text">
                  <p class="q">Mon fils à été trés bien accompagné alors qu'il avait beaucoup d'apréhension à commencer l'équitation</p>
                </div>
                <div class="quote-tara-figure"><img src="assets/img/user-6-115x115.jpg" alt="" width="115" height="115"/>
                </div>
              </div>
              <h6 class="quote-tara-author">Ashley Fitzgerald</h6>
              <div class="quote-tara-status">Mère d'un licencier</div>
            </article>
            <!-- Quote Tara-->
            <article class="quote-tara">
              <div class="quote-tara-caption">
                <div class="quote-tara-text">
                  <p class="q">Une magnifique balade, qui m'a été offert pour mon anniversaire. Une journée inoubliable</p>
                </div>
                <div class="quote-tara-figure"><img src="assets/img/user-8-115x115.jpg" alt="" width="115" height="115"/>
                </div>
              </div>
              <h6 class="quote-tara-author">Stephanie Williams</h6>
            </article>
            <!-- Quote Tara-->
            <article class="quote-tara">
              <div class="quote-tara-caption">
                <div class="quote-tara-text">
                  <p class="q">Une préparation pour mon parcours T6 très qualitative. </p>
                </div>
                <div class="quote-tara-figure"><img src="assets/img/user-7-115x115.jpg" alt="" width="115" height="115"/>
                </div>
              </div>
              <h6 class="quote-tara-author">Bill Johnson</h6>
              <div class="quote-tara-status">Athlètes</div>
            </article>
            <!-- Quote Tara-->
            <article class="quote-tara">
              <div class="quote-tara-caption">
                <div class="quote-tara-text">
                  <p class="q">Un staff de qualité qui s'est extremement bien occupée de mon cheval lors de sa pension</p>
                </div>
                <div class="quote-tara-figure"><img src="assets/img/user-9-115x115.jpg" alt="" width="115" height="115"/>
                </div>
              </div>
              <h6 class="quote-tara-author">Aaron Wilson</h6>
              <div class="quote-tara-status">Pensionnaire</div>
            </article>
          </div>
        </div>
      </section>

      <!-- Tell-->
      <section class="section section-sm section-first bg-default">
        <div class="container">
          <h3 class="heading-3">Contactez-nous</h3>
          <form class="rd-form rd-mailform form-style-1" data-form-output="form-output-global" data-form-type="contact" method="post" action="bat/rd-mailform.php">
            <div class="row row-20 gutters-20">
              <div class="col-md-6 col-lg-6 oh-desktop">
                <div class="form-wrap wow slideInDown">
                  <input class="form-input" id="contact-your-name-6" type="text" name="name" data-constraints="@Required">
                  <label class="form-label" for="contact-your-name-6">Votre nom (obligatoire)</label>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 oh-desktop">
                <div class="form-wrap wow slideInUp">
                  <input class="form-input" id="contact-email-6" type="email" name="email" data-constraints="@Email @Required">
                  <label class="form-label" for="contact-email-6">Votre e-mail (obligatoire)</label>
                </div>
              </div>
              <div class="col-12">
                <div class="form-wrap wow fadeIn">
                  <label class="form-label" for="contact-message-6">Message (obligatoire)</label>
                  <textarea class="form-input textarea-lg" id="contact-message-6" name="message" data-constraints="@Required"></textarea>
                </div>
              </div>
            </div>
            <div class="group-custom-1 group-middle oh-desktop">
              <button class="button button-lg button-primary button-winona wow fadeInRight" type="submit">Envoyer un message</button>
              <!-- Quote Classic-->
              <article class="quote-classic quote-classic-3 wow slideInDown">
                <div class="quote-classic-text">
                  <p class="q">Notre passion au service de nos plus fidèles amis.</p>
                </div>
              </article>
            </div>
          </form>
        </div>
      </section>


      <!-- Page Footer-->

    </div>
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Javascript-->
    <script src="inc/script/js/core.min.js"></script>
    <script src="inc/script/js/script.js"></script>
    <!-- coded by Himic-->
  </body>
</html>