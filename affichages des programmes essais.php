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
                          <div class="live-card">
                            <div class="card-head">
                              <img src="./assets/images/images.jpg" alt="" class="card-img">
                              <div class="live-badge"><?php echo $dt['prog_libelle']; ?></div>
                              <div class="total-viewers"><?php echo 'Programmé le    : '.$dt['prog_date']." à ".$dt['prog_hours']; ?></div>
                              <div class="play">
                                <ion-icon name="play-circle-outline"></ion-icon>
                              </div>
                            </div>

                            <div class="card-body">
                              <h3 class="card-title"><?php echo'Classe      : '.$dt['level_libelle']; ?><br><?php echo 'Filiere      : '.$dt['degree_libelle']; ?></h3>
                            </div>

                          </div>
                    
                  <?php
                   }
                   echo '</div>';

              }else{
                $notice='<p style="color:#689D71";>Aucun cours programmé !</p>';
                echo $notice;}
        }else{
        $notice='<p style="color:#689D71";>veuillez vous connecter!</p>';
        echo $notice;}


        ?>
