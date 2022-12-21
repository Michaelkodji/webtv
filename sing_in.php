<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./assets/images/logo.png" type="image/png">
  <title>IfriTV Inscription</title>

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

          <a href="connexion.php" class="navbar-signin">
            <span>Connexion</span>
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
                    <h2 class="title">Inscription</h2>

					<form method="post" action="/index.php?controller=control_signin">
						<?php
							foreach ($req as $k) {
								if (!empty($k['user_mail'])) {
									$notice='<p style="color:#FF0000";>Vous avez déjà un compte !</p>';
									echo $notice;
								}else{
									echo '<input type="hidden" readonly name="id" value="'.$k['user_id'].'"><br>';
									echo '<input type="text" readonly value="'.$k['user_name'].'">&nbsp;&nbsp;';
									echo '<input type="text" readonly value="'.$k['user_birthday'].'"><br><br>';
								}
							}
							if ($k['user_profil']==1) {
								foreach ($req as $k){
									$sql = new crud();
									$field1='degree_libelle';
									$table1='degree INNER JOIN user ON degree.degree_id = user.user_degree';
									$condtion1='user_id=?';
									$data1=array($k['user_id']);
									$req1 = $sql->readWhere($field1,$table1,$condtion1,$data1);
									$resultat1=$req1->fetchall();

									$field2='level_libelle';
									$table2='level INNER JOIN user ON level.level_id=user.user_level';
									$condtion2='user_id=?';
									$data2=array($k['user_id']);
									$req2 = $sql->readWhere($field2,$table2,$condtion2,$data2);
									$resultat2=$req2->fetchall();

									foreach($resultat2 as $k){
									echo '<input type="text" name="level" readonly value="'.$k['level_libelle'].'"><br><br>';
									}
									foreach($resultat1 as $k){
										echo '<input type="text" name="degree" readonly value="'.$k['degree_libelle'].'"><br><br>';
									}
								}		
							}
							
						?>

						<input type="mail" name="mail" placeholder="adresse mail">&nbsp;&nbsp;
						<input type="password" name="passwd" placeholder="votre mot de passe" required>&nbsp;&nbsp;
						<input type="password" name="repasswd" placeholder="confimer mot de passe" required><br><br>
						<input class="btn btn--radius btn--green"  type="submit" name="btn" value="inscription">

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
