<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./assets/images/logo.png" type="image/png">
  <title>IfriTV Identification</title>

  <!--
    - custom css link
  -->
  
  <link rel="stylesheet" href="./assets/css/main.css">
  <link rel="stylesheet" href="./assets/css/media_query.css">
  <link href="./assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
  <link href="./assets/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">

  <!---Vidéo JS--->
  <link href="videos_js/video-js.css" rel="stylesheet" />

  <!-- Vendor CSS-->
    <link href="./assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="./assets/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="./assets/css/main1.css" rel="stylesheet" media="all">
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
      </section>
        <div class="wrapper wrapper--w680" >
            <div class="card card-1" id="bk">
                <div class="card-body">
                    <video
                      id="my-video"
                      class="video-js"
                      controls
                      preload="auto"
                      width="640"
                      height="264"
                      poster="MY_VIDEO_POSTER.jpg"
                      data-setup="{}"
                    >
                      <source src="http://192.168.100.40:8088/hls/obs_stream.m3u8" type="application/x-mpegURL" />
                      <source src="http://192.168.100.40:8088/hls/obs_stream.m3u8" type="application/x-mpegURL" />
                      <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a
                        web browser that
                        <a href="https://videojs.com/html5-video-support/" target="_blank"
                          >supports HTML5 video</a
                        >
                      </p>
                    </video>

                    <script src="videos_js/video.min.js"></script>
                </div>
            </div>
        </div>

</main>





    

  </div>




    <!-- Jquery JS-->
    <script src="./assets/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="./assets/vendor/select2/select2.min.js"></script>
    <script src="./assets/vendor/datepicker/moment.min.js"></script>
    <script src="./assets/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="./assets/js/global.js"></script>
  <!--
    - custom js link
  -->
  <script src="./assets/js/main.js"></script>

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="./assets/bt5/js/bootstrap.js"></script>
</body>

</html>