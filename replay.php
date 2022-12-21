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
           <a href="#" class="navbar-brand">
              <img src="./assets/images/LOGO.png" alt="">
            </a>
       </div>

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
          - navbar navigation
        -->

        <button class="navbar-search-btn">
            <ion-icon name="search-outline"></ion-icon>
        </button>
          <?php
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

      <!--
        - #BANNER SECTION
      -->
      <section class="banner">

        <!--
          - LECTEUR Video
        -->
      <div  class="V"> 
      <div class="embed-responsive embed-responsive-16by9" id="video">
       <iframe id="deo" width="100%" height="100%" class="embed-responsive-item" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <div> 
           <h3 class="card-title" id="titre">Titre: Présentation du Genie Logiciel</h3>
              <div class="card-info">
                  <span class="genre" id="genre">Classe:Gl2</span>
                  <span class="year" id="year">Date 2022</span></div>
         </div>
      </div>
    </div>
      </section>

      <section class="movies">

        <!--
          - filter bar
        -->

                <div class="filter-bar">

                  <div class="filter-dropdowns">

                  

                  </div>

                 </div>
                  <span id="filiere"></span>
      </section>
      

 
        <!--
          - REPLAY SECTION
        -->
      
      
    </main>


    <section class="live" id="live">


        <?php


          require 'model.php';

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
                          <div class="movie-card" onclick="ouvre( <?php echo $name1; echo ',\''. $dt['course_libelle'].'\',\''.$dt['level_libelle'].'\',\''.$dt['course_date'].'\'' ?>)">
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


        ?>
</section>


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