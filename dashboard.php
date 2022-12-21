<?php
    $sql = new crud();
    $field1='*';
    $table1='level';
    $req1 = $sql->readall($field1,$table1);

    $field2='*';
    $table2='degree';
    $req2 = $sql->readall($field2,$table2);

   
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./assets/images/logo.png" type="image/png">
  <title>IfriTV Dashboard</title>

  <!--
    - custom css link
  -->
  
  <link rel="stylesheet" href="./assets/css/main.css">
  <link rel="stylesheet" href="./assets/css/media_query.css">
  <link href="./assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
  <link href="./assets/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
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


          <button class="navbar-search-btn">
            <ion-icon name="search-outline"></ion-icon>
          </button>
          <?php
           //session_start();
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
              echo '<a href="index.php?controller=control_add_program" class="navbar-signin">
              <span>Programmes</span>         
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
      </section>
        <div class="wrapper wrapper--w680" >
            <div class="card card-1" id="bk">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Dashboard Administrateur</h2>
                    <?php //echo $notice.'<br>';  ?>

                    <form method="POST" action="index.php?controller=control_publish" enctype="multipart/form-data">
                        <div class="row row-space">
                             <div class="col-2">
                                   <div class="input-group">
                                       <input class="input--style-1" type="text" placeholder="libelle du cours" name="libelle" required>
                                   </div>
                             </div>
                             <div class="col-2">
                                  <div class="input-group">
                                       <textarea  name="description" placeholder="votre description" required></textarea><br><br>
                                   </div>
                             </div>
                        </div>
                         <div class="row row-space">
                            <div class="col-2">
                            <div class="custom-select" id="sl">
                              <select name="level" required>
                                <?php 
   
                                    echo '';
                                    echo '<option selected="true" disabled="true">niveau</option>';
                                      foreach ($req1 as $k) {
                                        echo '<option value="'.$k['level_id'].'">'.$k['level_libelle'].'</option>';
                                      }
                                    echo '';
                                ?>
                              </select>&nbsp
                                <div class="select-dropdown"></div>
                            </div>
                            </div>

                            <div class="col-2">
                            <div class="col-3">
                              <div class="input-group">

                                       <input class="input--style-1" type="text" placeholder="Nom du professeur" name="teacher" required>
                              </div>
                             </div>
                            </div>
                        </div> <br><br>
                        <div class="row row-space">
                          <div class="col-2">
                                    <div class="custom-select" id="sl">
                                      <select name="degree" required>
                                      <?php 
                                          echo '';
                                          echo '<option selected="true" disabled="true">filiere</option>';
                                            foreach ($req2 as $k) {
                                              echo '<option value="'.$k['degree_id'].'" >'.$k['degree_libelle'].'</option>';
                                            }
                                          echo '';
                                      ?>   
                                      </select>&nbsp<br><br>
                                     <div class="select-dropdown"></div>

                                  </div>
                            </div>
                        </div>
                        <div class="input-group">
                          <input class="input--style-2" type="file" placeholder="NAME" name="file" required>
                          <label class="custom-file-label" for="customFile">Importer un fichier</label>
                        </div>
                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" name="publish" type="submit">Enregistrer</button>
                        </div>
                        </div>

                    </form>
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