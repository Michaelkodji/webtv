
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./assets/images/logo.png" type="image/png">
  <title>IfriTV</title>

  <!--
    -liens css 
  -->
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/main.css">
  <link rel="stylesheet" href="./assets/css/media_query.css">

  <!--
    - google font link
  -->
  <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
</head>

<body>




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
           <a href="index.php" class="navbar-brand">
              <img src="./assets/images/LOGO.png" alt="">
            </a>
       </div>
        <!--
          - navbar navigation
        -->

        <nav class="">
          <ul class="navbar-nav">

            <li> <a href="home.php" class="navbar-link">Acceuil</a> </li>
            <?php   
            session_start();
                if(isset($_SESSION['user_id'])){
                  echo '<li> <a href="live.php" class="navbar-link  indicator">Live</a> </li>';
                  echo'<li> <a href="replay.php" class="navbar-link">Replay</a> </li>';

                }
            ?>

          </ul>
        </nav>

        <!--
          - search and sign-in
        -->

        <div class="navbar-actions">

          <form action="#" class="navbar-form">
            <input type="text" name="search" placeholder="je recherche...." class="navbar-form-search">

            <button class="navbar-form-btn">
              <ion-icon name="search-outline"></ion-icon>
            </button>

            <button class="navbar-form-close">
              <ion-icon name="close-circle-outline"></ion-icon>
            </button>
          </form>


          <!--
            - search button for small screen
          -->

          <button class="navbar-search-btn">
            <ion-icon name="search-outline"></ion-icon>
          </button>
          <?php
                    require 'model.php';

              if(!isset($_SESSION['user_id'])){
               echo  '<a href="inscription.php" class="navbar-signin">
                        <span>inscription</span>|';
               echo '<a href="connexion.php" class="navbar-signin">
                        <span>connexion</span>
                        <ion-icon name="log-in-outline"></ion-icon>
                      </a>';
              }elseif ($_SESSION['user_profil']==1) {
                 echo '<a class="navbar-link  indicator"> Statut : En ligne </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| <a href="index.php?controller=control_logout" class="navbar-signin">Déconnexion</a>';
              }

              else{
                  echo '<a href="index.php?controller=control_dashboard" class="navbar-signin">
                        <span>Tableau de bord</span>
                        <ion-icon name="log-in-outline"></ion-icon>
                      </a>';
              }
          ?>

        </div>

      </div>
    </header>





    <!--
      - MAIN SECTION
    -->
    <main>

      <!--
        - #BANNER SECTION
      -->
      <section class="banner">
        <div class="banner-card">

          <img src="./assets/images/baniere.png" class="banner-img" alt="">

         

        </div>
      </section>



      <!--
        - #LIVE SECTION
      -->
      <section class="live" id="live">

       <h2 class="section-heading">Prochains cours </h2>

        
        <?php

        if(isset($_SESSION['user_id'])){

              $sql  = new crud();
              $field="*";
              $table="level,degree,program";
              $condition="program.prog_level=level.level_id and program.prog_degree=degree.degree_id and program.prog_level=? and program.prog_degree=?";

              $data=array($_SESSION['user_level'],$_SESSION['user_degree']);
              $req=$sql->readWhere($field,$table,$condition,$data);

              if ($req->rowCount()!=0) {
                  $z=1;
                  echo '<div class="movies-grid">';
                  while($dt=$req->fetch()){
                       
                      
                          ?> 
                          <div class="movie-card" >
                              <div class="card-head">
                                  <img src="./assets/images/tout.png" alt="" class="card-img">
                  
                                  <div class="card-overlay">
                                      <div class="play">
                                          <ion-icon name="play-circle-outline"></ion-icon>
                                      </div>
                  
                                  </div>
                              </div>
                              <div class="card-body">
                                  <h3 class="card-title"id="course_libelle"><?php echo $dt['prog_libelle']; ?></h3>
                                  <div class="">
                                      <span id="date"><?php echo 'Programmé le    : '.$dt['prog_date']." à ".$dt['prog_hours']; ?></span><br>
                                      <span id="level"><?php echo'Classe      : '.$dt['level_libelle']; ?></span><br>
                                      <span id=""><?php echo 'Filiere      : '.$dt['degree_libelle']; ?></span><br>
                  
                                  </div>
                              </div>
                          </div><br><br>
                          <script type="text/javascript" src="script.js"></script>
                    
                  <?php
                   }
                   echo '</div>';

              }else{
                $notice='<p style="color:#689D71";>Aucun cours programmé !</p>';
                echo $notice;}
        }else{ ?>





          <div class="live-grid">

            <div class="live-card">

              <div class="card-head">
                <img src="./assets/images/images.jpg" alt="" class="card-img">
                <div class="live-badge">LIVE</div>
                <div class="total-viewers">100 vue</div>
                <div class="play">
                  <ion-icon name="play-circle-outline"></ion-icon>
                </div>
              </div>

              <div class="card-body">
                <h3 class="card-title">Algorithme <br> Licence 1 - 2eme Sceance</h3>
              </div>

            </div>

            <div class="live-card">

              <div class="card-head">
                <img src="./assets/images/3.jpg" alt="" class="card-img">
                <div class="live-badge">LIVE</div>
                <div class="total-viewers">50 vue</div>
                <div class="play">
                  <ion-icon name="play-circle-outline"></ion-icon>
                </div>
              </div>

              <div class="card-body">
                <h3 class="card-title">Technologie BroadCast <br> IM3 - Derniere Sceance</h3>
              </div>

            </div>

            <div class="live-card">

              <div class="card-head">
                <img src="./assets/images/2.jpg" alt="" class="card-img">
                <div class="live-badge">LIVE</div>
                <div class="total-viewers">47 vue</div>
                <div class="play">
                  <ion-icon name="play-circle-outline"></ion-icon>
                </div>
              </div>

              <div class="card-body">
                <h3 class="card-title">Evenement <br>Soutenance IM3 - Bertini KAKANAKOU</h3>
              </div>

            </div>

          </div>
        


        <?php } ?><br>

           <!-- load more button-->

      </section><br><br><br>

      <!--
        - #MOVIES SECTION
      -->
      <section class="movies" id="Replay">
        
        <!--
          - filter bar
        -->
        <div class="filter-bar">

           <div class="filter-radios">
            <a href="#">
            <input type="radio" name="grade" id="featured" checked>
            <label for="featured" >Cours disponibles en replay</label>
            </a>
            <div class="checked-radio-bg"></div>

          </div>

        </div>


        <!--
          - movies grid
        -->

        <?php

        if(isset($_SESSION['user_id'])){

              $sql  = new crud();
              $field="*";
              $table="level,degree,course,file";
              $condition="course.course_level=level.level_id and course.course_degree=degree.degree_id 
                          and course.course_file=file.file_id and course.course_level=? and course.course_degree=?";

              $data=array($_SESSION['user_level'],$_SESSION['user_degree']);
              $req=$sql->readWhere($field,$table,$condition,$data);

              if ($req->rowCount()!=0) {
                  $z=1;
                  echo '<div class="movies-grid">';
                  while($dt=$req->fetch()){
                       
                          $name = $dt['file_name'];
                          $ext=$dt['file_extension'];

                          $name1 = "'".$name.".".$ext."'";
                          $date = $dt['course_date'];
                          $filiere = $dt['level_libelle'];
                          $libelle= $dt['course_libelle'];
                         
                      
                          // echo '<div class="movie-card" onclick="ouvre('.$name.')">';
                          ?> 
                          <div class="movie-card" onclick="ouvre( <?php echo $name1; ?>)">
                              <div class="card-head">
                                  <img src="./assets/images/tout.png" alt="" class="card-img">
                  
                                  <div class="card-overlay">
                                      <div class="play">
                                          <ion-icon name="play-circle-outline"></ion-icon>
                                      </div>
                  
                                  </div>
                              </div>
                              <div class="card-body">
                                  <h3 class="card-title"id="course_libelle"><?php echo $dt['course_libelle']; ?></h3>
                                  <div class="">
                                      <span id="date"><?php echo 'Publié le   : '.$dt['course_date']; ?></span><br>
                                      <span id="level"><?php echo 'Niveau      : '.$dt['level_libelle']; ?></span><br>
                                      <span id=""><?php echo 'Filiere      : '.$dt['degree_libelle']; ?></span><br>
                                      <?php //echo '<a href="uploads/'.$dt['file_name'].'.'.$dt['file_extension'].'">Télécharger</a>'; $z++; ?>
                  
                                  </div>
                              </div>
                          </div><br><br>
                          <script type="text/javascript" src="script.js"></script>
                    
                  <?php
                   }
                   echo '</div>';

              }else{
                $notice='<p style="color:#689D71";>Aucun cours disponibles !</p>';
                echo $notice;}
        }else{
        $notice='<p style="color:#689D71";>veuillez vous connecter!</p>';
        echo $notice;}


        ?>

        <br><br>
 <!-- load more button-->
        <button class="load-more">Plus</button>


      </section>





      <!--
        - #CATEGORY SECTION
      -->
      <section class="category" id="category">
        <?php if (!isset($_SESSION['user_id'])) {?>

          <h2 class="section-heading">Autres</h2>

        <div class="category-grid">

          <div class="category-card">
            <img src="./assets/images/5.jpg" alt="" class="card-img">
            <div class="name">Actualités</div>
          </div>

          <div class="category-card">
            <img src="./assets/images/6.jpg" alt="" class="card-img">
            <div class="name">Reportage</div>
          </div>

          <div class="category-card">
            <img src="./assets/images/w.jpg" alt="" class="card-img">
            <div class="name">Documentaire</div>
          </div>

          <div class="category-card">
            <img src="./assets/images/7.jpg" alt="" class="card-img">
            <div class="name">Interview</div>
          </div>

                 <button class="load-more">Plus</button>
        </div>

        <?php  } ?>
        
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
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>