<?php

require('model.php');

function control_link(){
	require('enregistrement.php');
}

function control_signin(){
	$sql= new crud();
	$notice='';
	if(isset($_POST['validation'])){
		$field='*';
		$table='user';
		$condition='user_id=?';
		$data=array($_POST['id']);
		$resultat = $sql->readWhere($field,$table,$condition,$data);
		$req = $resultat -> fetchall();
		if (sizeof($req)==0) {
			$notice='<p style="color:#FF0000";>Votre numero d\'inscription est non conforme! </p>';
			echo $notice;
			require('inscription.php');
		}else{

			foreach ($req as $k) {
					if (!empty($k['user_mail'])) {
						$notice='<p style="color:#FF0000";>Vous avez déjà un compte !</p>';
						echo $notice;
						require('inscription.php');
					}else{
						require('sing_in.php');							
					}
				}
		}
	}

	if(isset($_POST['btn'])){
		if ($_POST['passwd'] != $_POST['repasswd']) {
				$notice = '<p style="color:#FF0000";>Erreur ! les mots de passe ne concorde pas</p>';
				echo $notice;
				$field='*';
				$table='user';
				$condition='user_id=?';
				$data=array($_POST['id']);
				$resultat = $sql->readWhere($field,$table,$condition,$data);
				$req = $resultat -> fetchall();
				require("sing_in.php");

		}else{
			$table='user';
			$field='*';
			$condition='user_mail=?';
			$data=array($_POST['mail']);
			$resultat= $sql->readWhere($field,$table,$condition,$data);
			$req = $resultat ->fetchall();

			if (empty($req)) {
				$table='user';
				$field='user_mail=?,user_passwd=?';
				$condition= 'user_id=?';
				$hashpasswd = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
				$data=array($_POST['mail'],$hashpasswd,$_POST['id']);
				$req = $sql->up($table,$field,$condition,$data);
				$notice='<p style="color:#689D71";>Félicitations vous venez de créer votre compte</p>';
				echo $notice;
				header('location:index.php?controller=control_login');
				//header('location:index.php?controller=control_login&notice='.$notice.'');

			}else{
				
				$notice = '<p style="color:#FF0000";>Erreur ! adresse email déjà utilisée</p>';
				echo $notice;
				$field='*';
				$table='user';
				$condition='user_id=?';
				$data=array($_POST['id']);
				$resultat = $sql->readWhere($field,$table,$condition,$data);
				$req = $resultat -> fetchall();
				require("sing_in.php");

			}
			
		}
	}
}

function control_login(){
	$sql = new crud ();
	if (isset($_POST['btn'])) {
		$notice='';
		$table='user';
		$field='*';
		$condition='user_mail=?';
		$data =array($_POST['mail']);
		$req = $sql ->readWhere($field,$table,$condition,$data);
		if($req->rowCount() == 1){
				$donnes=$req->fetch();
				if(password_verify($_POST['passwd'],$donnes['user_passwd'])){
					session_start();
					$_SESSION['user_id'] = $donnes["user_id"];
					$_SESSION['user_name'] = $donnes["user_name"];
					$_SESSION['user_mail'] = $donnes["user_mail"];
					$_SESSION['user_profil'] = $donnes["user_profil"];
					$_SESSION['user_degree'] = $donnes["user_degree"];
					$_SESSION['user_level'] = $donnes["user_level"];

					if($_SESSION['user_profil']==1){
						header('location:home.php');
					}else{
						header('location:index.php?controller=control_dashboard');
					}
				}else{
					$notice='<p style="color:#FF0000";>Erreur ! Mot de passe ou adresse email non conforme</p>';
					echo $notice;
				}
		}else{
				$notice='<p style="color:#FF0000">Erreur ! </b>Aucun compte associé à cette adresse mail</p>';
				echo $notice;
		}
	}
	
	//require("./vue/connexion.php");
	require("connexion.php");
}


function control_dashboard(){


	require("dashboard.php");	
}


function control_add_program(){
	require("add_program.php");	
}


function control_publish (){
	$sql = new crud();
	$notice ='';
	if (isset($_POST['publish'])) {
		if (!empty($_POST['teacher']) AND  !empty($_POST['level']) AND !empty($_POST['degree'])) {
			$table='course';
			$field='course_libelle,course_description,course_teacher,course_level,course_degree,course_file,course_date';
			$value='?,?,?,?,?,?,?';
			$date =date("d/m/y");
			$file_id=control_file($_FILES['file']);

			if (is_int($file_id)) {
				$data=array($_POST['libelle'],$_POST['description'],$_POST['teacher'],$_POST['level'],$_POST['degree'],$file_id,$date);
				$req=$sql->add($table,$field,$value,$data);
				$notice = '<p style="color:#689D71";>Cours publié avec succès!</p>';
				echo $notice;
			}else{

				$notice = '<p style="color:#FF0000";>Cours non publiés!</p>';
				echo $notice;
			}
			
		}else{

			$notice = '<p style="color:#FF0000";>Veuillez remplir tous leschamps!</p>';
			echo $notice;
		}	
		
	}
	require('dashboard.php');

}


function control_file(){
$sql=new crud();
 $notice='';
	if (isset($_FILES['file']) AND $_FILES['file']['error']==0) {
		
		if ($_FILES['file']['size']<=1000000000) {
			$infosfichier=pathinfo($_FILES['file']['name']);
			$extension_upload = $infosfichier['extension'];
			$extension_autorisees= array('mp4','avi');
			if (in_array($extension_upload,$extension_autorisees)) {
				$name='uploads_'.substr(str_shuffle("123457890"), 0,10);
				move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/'.$name.'.'.$extension_upload);
				$table='file';
				$field='file_name,file_extension,file_size';
				$value='?,?,?';
				$data=array($name,$extension_upload,$_FILES['file']['size']);
				$req=$sql->add($table,$field,$value,$data);
				return $req;
				$notice ='L \'envoi a bien été effectué';
				echo $notice;
			}else{
				$notice ='<p style="color:#FF0000";>Le fichier charger doit être une vidéo (mp40000000, avi)</p>';
				echo $notice;
			}
		}else{
			$notice ='<p style="color:#FF0000";>Fichier trop volumineux</p>';
			echo $notice;
		}
	}else{
		$notice='<p>Erreur lors de l\'envoi du fichier</p>';
		echo $notice;
	}

} 


function control_publish_cours(){

$sql=new crud();
$sql1= new crud();
$sql2 = new crud();
$sql3 = new crud();


	if (isset($_POST['btn'])) {
		$field="*";
		$table="course";
		$condition="course_level=?";
		$data=array($_POST['level']);
		$req=$sql->readWhere($field,$table,$condition,$data);
		$resultat=$req->fetchall();
		
		//$course_file='';$course_libelle='';$course_teacher='';$course_description='';$course_degree='';$course_date='';
		foreach ($resultat as $i) {
			$course_file=$i['course_file'];
			$course_libelle=$i['course_libelle'];
			$course_teacher=$i['course_teacher'];
			$course_description=$i['course_description'];
			$course_degree=$i['course_degree'];
			$course_date=$i['course_date'];	
		}


		if (!empty($course_date)) {
			
		  $field1='degree_libelle';
	      $table1='degree';
	      $condition1='degree_id=?';
	      $data1=array(intval($course_degree));
	      $req1=$sql1->readWhere($field1,$table1,$condition1,$data1);
	      $resultat1=$req1->fetchall();

	      $l = '';
	      foreach ($resultat1 as $k ) {
	        $l = $k['degree_libelle'];
	      }

	      $field2='level_libelle';
	      $table2='level';
	      $condition2='level_id=?';
	      $data2=array(intval($_SESSION['user_level']));
	      $req2=$sql2->readWhere($field2,$table2,$condition2,$data2);
	      $resultat2=$req2->fetchall();

	      $m = '';
	      foreach ($resultat2 as $m ) {
	        $m = $k['level_libelle'];
	      }

	      $field3='*';
          $table3='file';
          $condition3='course_file=?';
          $data3=array($course_file);
          $req3=$sql3->readWhere($field3,$table3,$condition3,$data3);
          $resultat3=$req3->fetchall();

          $filename = '';
          $file_extension='';
	      foreach ($resultat3 as $k ) {
	        $filename= $k['file_name'];
	        $file_extension= $k['file_extension'];
	      }
	    }

	}

require('publie_cours.php');
}



function control_addStudent(){
	$sql = new crud();
	$notice='';

       if (isset($_POST['addStudent'])) {			
		if (isset($_FILES['fichier_excel'])){
			$filename=$_FILES['fichier_excel']['tmp_name'];
			$fp = fopen($filename, "r");

			while (!feof($fp)) 
    		{  
      			$lignes = fgets($fp,4096);
      			$listes= explode(";", $lignes);
   				if (isset($listes[1])) {

	  				$table='user';
	   				$field='user_id,user_name,user_profil,user_birthday,user_level,user_degree';
	   				$value='?,?,?,?,?,?';
	   				$data=array($listes[0],$listes[1],$listes[2],$listes[3],$listes[4],$listes[5]);
	   				$req=$sql->add($table,$field,$value,$data);
	   				
   				}
   			
     		} 
     		$notice='<p style="color:#689D71";>Etudiants enregistrés avec succès!</p>';
	   		echo $notice;
	     	fclose($fp); 
		}
		else{ 
       		$noice='<p style="color:#FF0000";>Fichier introuvable importation stoppée!</p>';
       		exit();
       	}
     } 
     require('enregistrement.php');
 
}

function control_logout(){
	session_destroy();
	header('location:index.php');
}



?>