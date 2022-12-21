<?php

require('model.php');
session_start();
$sql  = new crud();
if(isset($_POST['choix']) && $_POST['choix']=="addStudent"){
    if(!empty($_FILES)){

        $nomFichier=$_FILES['file']['name'];
        $tab=explode(".",$nomFichier);
        $extensionFichier=$tab[1];
        $tempRep=$_FILES['file']['tmp_name'];
        $tailleFichier=$_FILES['file']['size'];
        $typeFichier=$_FILES['file']['type'];
        $error=$_FILES['file']['error'];

        if ($extensionFichier=="csv") {
            if($error !=0 || !$tempRep){
                echo 'Le fichier n\'a pas pu être importé';
                die();
            }
            if(move_uploaded_file($tempRep, 'uploads/'.$nomFichier)){
                echo 'Importation du fichier '.$nomFichier. ' terminé!!!';
            }else{
                echo 'Une erreur est survenue lors de l\'importation du fichier';
            }

            $fichier = fopen("uploads/".$nomFichier, "r");
            $i=0;$j=0;
            while (!feof($fichier)){
                $ligne = addslashes(rtrim(fgets($fichier)));
                $i=$i+1;
                $tableauValeurs = explode(';', $ligne);
                if ($i>1){  
                    if (isset($tableauValeurs[0]) && isset($tableauValeurs[1])){
                        $j=$j+1; 
                        $sql=new crud();
                        //eleve
                        $table='user';$field='user_id';$condition='user_id=?';$data=array($tableauValeurs[0]);
                        $re=$sql->readWhere($field,$table,$condition,$data);
                        $dt=$re->fetch();
                        if ($re->rowcount()==0) {
                            $table='degree';$field='degree_id';$condition='degree_libelle=?';$data=array($tableauValeurs[3]);
                            $re=$sql->readWhere($field,$table,$condition,$data);
                            $dt=$re->fetch();

                            $table='user';$field='user_id,user_name,user_profil,user_birthday,user_level,user_degree';$value='?,?,?,?,?,?';$data=array(intval($tableauValeurs[0]),$tableauValeurs[1],1,$tableauValeurs[2],intval($tableauValeurs[4]),$dt['degree_id']);
                            $req=$sql->add($table,$field,$value,$data);
                        }else{
                            $table='degree';$field='degree_id';$condition='degree_libelle=?';$data=array($tableauValeurs[4]);
                            $re=$sql->readWhere($field,$table,$condition,$data);
                            $dt=$re->fetch();

                            $table='user';$field='user_name=?,user_profil=?,user_birthday=?,user_level=?,user_degree=?';$condition='user_id='.intval($tableauValeurs[0]).'';$data=array($tableauValeurs[1],1,$tableauValeurs[2],intval($tableauValeurs[4]),$dt['degree_id']);
                            $req=$sql->up($table,$field,$condition,$data);
                        }
                    }
                }
            }
            //echo $j;
            fclose($fichier);
        }else{
            echo 'Mauvais fichier';
        }
    }



}
          
if(isset($_GET['word'])){

    $sql  = new crud();
    /*select * from level,degree,course,file where course.course_level=level.level_id and course.course_degree=degree.degree_id 
    and course.course_file=file.file_id and course.course_level=2; */

    $field="*";
    $table="level,degree,course,file";
    $condition="course.course_level=level.level_id and course.course_degree=degree.degree_id 
                and course.course_file=file.file_id and course.course_level=?";
    $data=array($_GET['word']);
    $req=$sql->readWhere($field,$table,$condition,$data);
    if ($req->rowCount()!=0) {
        $z=1;
        echo '<div class="movies-grid">';
        while($dt=$req->fetch()){
             
                $name = $dt['file_name'];
                $ext=$dt['file_extension'];
                $name1 = "'".$name.".".$ext."'";
               
            
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
                            <span id=""></span><br>
                            <?php //echo '<a href="uploads/'.$dt['file_name'].'.'.$dt['file_extension'].'">Télécharger</a>'; $z++; ?>
        
                        </div>
                    </div>
                </div>
          
        <?php
         }
         echo '</div>';

    }else{
      $notice='<p style="color:#689D71";>Aucun cours disponibles !</p>';
      echo $notice;
    }

    //echo $resultat;
}
if(isset($_GET['task']) && $_GET['task']=='print_program'){
    $table='program,level,degree'; $field='*';$condition='program.prog_level=level.level_id and program.prog_degree=degree.degree_id and degree.degree_id = ? and level.level_id = ? order by prog_id desc';$data=array($_SESSION['user_degree'],$_SESSION['user_level']);
    $req=$sql->readWhere($field,$table,$condition,$data);
    
    if($req->rowCount()==0){
        echo 'Aucun programme disponible';
    }else{
        
        while($dt=$req->fetch()){
            
            echo '<div class="live-grid">

                    <div class="live-card">

                      <div class="card-head">
                        <img src="./assets/images/images.jpg" alt="" class="card-img">
                        <div class="live-badge">'.$dt['prog_libelle'].'</div>
                        <div class="total-viewers">'.$dt['prog_description'].'</div>
                        <div class="play">
                          <ion-icon name="play-circle-outline"></ion-icon>
                        </div>
                      </div>

                      <div class="card-body">
                        <h3 class="card-title">'.$dt['prog_date'].' à '.$dt['prog_hours'].' avec le pofesseur '.$dt['prog_prof'].'</h3>
                      </div>

                    </div>
                </div>';
        }
    }
}
 if(isset($_GET['task']) && $_GET['task']=='print_program_admin'){
    $table='program order by prog_id desc'; $field='*';
    $req=$sql->readAll($field,$table);
   
    if($req->rowCount()==0){
         echo 'Aucun programme disponible';
    }else{

        echo '<section class="live" id="live">';
        echo '<div class="movies-grid">';

       
        while($dt=$req->fetch()){
            $data=$dt['prog_id'].','.$dt['prog_libelle'].','.$dt['prog_description'].','.$dt['prog_date'].','.$dt['prog_hours'].','.$dt['prog_prof'].','.$dt['prog_level'].','.$dt['prog_degree'];

            echo '<div class="movie-card" >
                              <div class="card-head">
                                  <img src="./assets/images/tout.png" alt="" class="card-img">
                  
                                  <div class="card-overlay">
                                      <div class="play">
                                          <ion-icon name="play-circle-outline"></ion-icon>
                                      </div>
                  
                                  </div>
                              </div>
                              <div class="card-body">
                                  <h3 class="card-title"id="course_libelle">'.$dt['prog_libelle'].'</h3>
                                  <div class="">
                                      <span id="date">Programmé le    : '.$dt['prog_date']." à ".$dt['prog_hours'].'</span><br>
                                      <span id="level">Classe      : '.$dt['prog_level'].'</span><br>
                                      <span id="">Filiere      : '.$dt['prog_prof'].'</span><br>
                  
                                  </div>
                              </div>
                          </div>';
        }
    echo "<div>";
    echo '</section>';
      
    }
}

if(isset($_GET['task']) && $_GET['task']=='add_program'){
  
    $field='prog_libelle,prog_description,prog_date,prog_hours,prog_prof,prog_level,prog_degree';
    $table='program'; $value='?,?,?,?,?,?,?';
    
    $data=array($_GET['libelle'],$_GET['desc'],$_GET['date'],$_GET['hours'],$_GET['prof'],$_GET['level'],$_GET['degree']);
    $req1=$sql->add($table,$field,$value,$data);
}

if(isset($_GET['task']) && $_GET['task']=='modif_program'){
    $data=array($_GET['libelle'],$_GET['desc'],$_GET['date'],$_GET['hours'],$_GET['prof'],$_GET['level'],$_GET['degree']);
    $field='prog_libelle=?,prog_description=?,prog_date=?,prog_hours=?,prog_prof=?,prog_level=?,prog_degree=?';
    $table='program'; $condition='prog_id='.$_GET['idp'].'';
    $sql->up($table,$field,$condition,$data);
 }
 if(isset($_GET['task']) && $_GET['task']=='del_program'){
       $table='program';$condition='prog_id='.$_GET['idp'].'';  
       $sql->del($table,$condition,$data);
 }
?>