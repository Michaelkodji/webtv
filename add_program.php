<?php
    $sql = new crud();
    $field1='*';
    $table1='level';
    $req1 = $sql->readall($field1,$table1);

    $field2='*';
    $table2='degree';
    $req2 = $sql->readall($field2,$table2);

    $field3='*';
    $table3='user';
    $condition='user_profil=?';
    $data=array('2');
    $req3 = $sql->readWhere($field3,$table3,$condition,$data);

    
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

<body onload="read_program_admin()">




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
              echo '<a href="#" class="navbar-signin">
                    <span>Publier un cours</span>
                   </a>';
              echo '<a href="index.php?controller=control_link" class="navbar-signin">
                    <span>enrgistrer des etudiants</span>         
                   </a>';
              echo '<a href="index.php?controller=control_publish_cours" class="navbar-signin">
                    <span>Cours publi??s</span>         
                   </a>';
              echo '<a href="index.php?controller=control_add_program" class="navbar-signin">
              <span>Programmes</span>         
              </a>';
            }

          ?>
          <a href="index.php?controller=control_logout" class="navbar-signin">
            <span>D??connexion</span>
            <ion-icon name="log-in-outline"></ion-icon>
          </a>

        </div>

      </div>
    </header>

    <!--
      - MAIN SECTION
    -->
    <main>
        <div class="container" style="margin-bottom: 50px;">
            <button class="btn btn--radius btn--green" id="ajout" type="button" onclick="show()">Programmer un cours</button>
        </div>
        <div class="wrapper wrapper--w680" style="display:none ;" id="blocp" >
            <div class="card card-1" id="bk">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title" id="tete1">Programmer un cours</h2>
                    <?php //echo $notice.'<br>';  ?>

                    <form id="formp">
                        <div class="row row-space">
                             <div class="col-2">
                                   <div class="input-group">
                                       <input class="input--style-1" type="text" placeholder="libelle du cours" id="libelle" required>
                                   </div>
                             </div>

                        </div>
                        <div class="row row-space">
                             <div class="col-2">
                                  <div >
                                       <textarea cols="70" id="desc"  name="description" placeholder="Description du cours" required></textarea><br><br>
                                   </div>
                             </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <div class="custom-select" id="sl">
                                        <select id="level" required>
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
                            </div>

                        <!-- </div> <br><br>
                        <div class="row row-space"> -->
                          <div class="col-2">
                                <div class="input-group">
                                    <div class="custom-select" id="sl">
                                      <select id="degree" required>
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
                        </div>
                        <div class="row row-space">
                             <div class="col-2">
                                   <div class="input-group">
                                       <input class="input--style-1" type="text" placeholder="Nom du professeur" id="prof" name="libelle" required>
                                   </div>
                             </div>
                        </div>
                        <div class="row row-space">
                             <div class="col-2">
                                   <div class="input-group">
                                    <?php
                                        $date = date_create(date("Y-m-d"));
                                        date_add($date, date_interval_create_from_date_string("6 month"));
                                       $maxi= date_format($date,"Y-m-d");
                                      
                                    ?>
                                   
                                       <input class="input--style-1" type="date" id="date" min="<?php echo date("Y-m-d"); ?>" max="<?php echo $maxi; ?>" required>
                                   </div>
                             </div>
                             <div class="col-2">
                                   <div class="input-group">
                                       <input class="input--style-1" type="time" id="hours" required>
                                   </div>
                             </div>

                        </div>
                       
                        <div class="p-t-20">
                            <input type="hidden" id="idp" name="id">
                            <button class="btn btn--radius btn--green" id="btn_ajout" id="add_program" type="button" onclick="verify_form('ajout')">Enregistrer</button>
                            <button style="display:none ;" class="btn btn--radius btn--green" id="btn_modif" id="btn_modif" type="button" onclick="verify_form('modif')">Modifier</button>
                        </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <section class="container">
            <div id="content_program"></div> 
        </section>
                                          
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
  <script type="text/javascript" src="script.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="./assets/bt5/js/bootstrap.js"></script>
</body>

</html>