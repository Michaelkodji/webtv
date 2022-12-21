<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./assets/images/logo.png" type="image/png">
  <title>IfriTV Replay</title>

  <!--
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/main.css">
  <link rel="stylesheet" href="./assets/css/media_query.css">

  <!--
    - google font link
  -->
  <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
</head>

<body onload="read_program()">




  <!--
    - main container
  -->
  <div class="container">

    <!--
      - #HEADER SECTION
    -->

    <header class="">
      <div class="navbar">

        <!--
          - menu button for small screen
        -->
        <button class="navbar-menu-btn">
          <span class="one"></span>
          <span class="two"></span>
          <span class="three"></span>
        </button>

        <div class="ico">
           <a href="#" class="navbar-brand">
              <img src="./assets/images/LOGO.png" alt="">
            </a>
       </div>
        <!--
          - navbar navigation
        -->

        <button class="navbar-search-btn">
            <ion-icon name="search-outline"></ion-icon>
        </button>
          <?php
            session_start();
            if ($_SESSION['user_profil']==2) {
                echo '<a href="index.php?controller=control_dashboard" class="navbar-signin">
                        <span>Publier un cours</span>
                    </a>';
                echo '<a href="index.php?controller=control_link" class="navbar-signin">
                        <span>enrgistrer des etudiants</span>         
                    </a>';
                echo '<a href="index.php?controller=control_publish_cours" class="navbar-signin">
                        <span>Cours publiés</span>         
                    </a>';
            }

          ?>
          <a href="index.php?controller=control_logout" class="navbar-signin">
            <span>Déconnexion</span>
            <ion-icon name="log-in-outline"></ion-icon>
          </a>

        </div>

      </div>
    </header>

    <!--
      - MAIN SECTION
    -->
    <main>
    <section class="container">
        <div id="content_program"></div>
    </section>

    </main>
    
    <!--
      - FOOTER SECTION
    -->
    <footer>

      <div class="footer-content">

        <div class="footer-brand">
          <img src="./assets/images/logo.png" alt="" class="footer-logo">
          <p class="slogan">IfriTv la web Tv dedié au 
          activié scolaire et para-scolaire de l'IFRI
          "IFRI:Nous bâtisons l'exellence"
        </p>


          <div class="social-link">

            <a href="#">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
            <a href="#">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
            <a href="#">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
            <a href="#">
              <ion-icon name="logo-tiktok"></ion-icon>
            </a>
            <a href="#">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>

          </div>
        </div>


        <div class="footer-links">


        </div>

      </div>

      <div class="footer-copyright">

        <div class="copyright">
          <p>&copy; copyright 2022 Bertini KAKANAKOU</p>
        </div>

        <div class="wrapper">
          <a href="#">Tout droit reserver</a>
          <a href="#">Termes et conditions</a>
        </div>

      </div>

    </footer>

  </div>

  <!--
    - custom js link
  -->
  <script src="./assets/js/main.js"></script>

  <!--
    - ionicon link
  -->
  <script type="text/javascript" src="script.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>