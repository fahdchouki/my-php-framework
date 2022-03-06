<?php include(INCS . 'header.php'); ?>

<section class="home" id="home-section">
    <div class="overlay">
      <div class="container">
        <div class="content" data-tilt data-tilt-perspective='500'>
          <h1>MSM-MEDIAS EDITION & DIFFUSION</h1>
          <p>Nous avons dévéloppé des collections spécifiques au besoin de l'enseignement, avec des manuels et documents faciles à comprendre et à manipuler.</p>
          <a href="#about-section" class="start-btn" id="start-btn">à propos de nous</a>
          <div id="about-section" ></div>
        </div>
      </div>
    </div>
  </section>
  <section class="about-section">
    <div class="container">
      <div class="about-container">
        <div class="about">
          <div class="about-text">
            <h4 class="section-title">à propos de nous</h4>
            <span class="line"></span>
            <p>
              Aujourd'hui, MSM MEDIAS reléve de nouveaux défis et ses activités d'une part, nous étendons notre offre éducative à d'autres niveaux scolaire, et d'autre part, s'appuyant sur son excellente maitrise du numérique, MSM MEDIAS propose au public et à ses partenaires des solutions toujours plus adaptées aux nouvelles technologies
            </p>
          </div>
          <div class="about-img">
            <img src="../../assets/images/bg3.jpg" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="services">
    <div class="container">
      <div class="section-title">
        <h3 class="title">Notre Mission</h3>
        <span class="line"></span>
      </div>
      <div class="intro">
        <div class="intro-container">
          <div class="text">
            <p>MSM MEDIAS s'est fixé pour objectif de faciliter la diffusion des connaissances à travers des supports de qualité. Notre premiére collection ,( découvrir l'informatique au primaire ), est consacré à l'apprentissage de l'informatique aux classes primaire de l'enseignement. Mais nous étendrons peu à peu notre offre à d'autres niveaux et disciplines. (exemple : collection de manuels d'informatique pour le collége)..</p>
          </div>
        </div>
      </div>
      <div class="section-title">
        <h3 class="title">Nos Valeurs</h3>
        <span class="line"></span>
      </div>
      <div class="cards">
        <div class="serv-card">
          <i class="fa fa-diamond"></i>
          <p>Un regard tourné vers l'avenir.</p>        
        </div>
        <div class="serv-card">
          <i class="fa fa-headphones"></i>
          <p>Une équipe à l'écoute des nouvelles tendances.</p>        
        </div>
        <div class="serv-card">
          <i class="fa fa-shield"></i>
          <p>Un service de qualité, adapté aux besoins des utilisateurs.</p>        
        </div>
        <div class="serv-card">
          <i class="fa fa-chain-broken"></i>
          <p>La passion des défis.</p>
        </div>
      </div>

    </div>
  </section>
  <footer>
    <p>Tous droits reserves &copy; 2021 MSM-MEDIAS</p>
  </footer>
  <script src="../../assets/js/jquery.min.js"></script>
  <script src="../../assets/js/jquery-ripples.js"></script>
  <script src="../../assets/js/tilt.js"></script>
  <script>
    $('.intro-container').ripples({
      'perturbance':0.01,
      'resolution' : 400,
    });
  </script>
  <script src="../../assets/js/main.js"></script>
</body>

</html>