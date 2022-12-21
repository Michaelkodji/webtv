
/*function search(){
	var xhr=new XMLHttpRequest();
	xhr.onreadystatechange=function(){
		if (xhr.readyState==4 && xhr.status==200){
			var tab = xhr.responseText.split(",");
			var lp='<table  border="0" bgcolor="#acacac" width="300">';
			for(var i=0; i<tab.length; i++){
				lp+='<tr><td onclick="vld()"><a href="index.php?controlleur=control_question&idq='+$dt['id_quiz']+'&nom='+$dt['nom_quiz']+'">'+tab[i]+'</a></td></tr>';
			}
			lp+='</table>';
			_('country').innerHTML = lp;
		}
	};
	xhr.open('GET', 'server.php?word='+_('search').value, true);
	xhr.send(null);
}*/
function _(elt){return document.getElementById(elt)}
function uploadFichier(){
	var file=_('file').files[0];
	var choix="addStudent";
	//console.log(choix);
	var data = new FormData();
	data.append('file', file);
	data.append('choix', choix);
  
	var xhr = new XMLHttpRequest();
	xhr.upload.addEventListener("progress", progressHandler, false);
	xhr.addEventListener("load", completHandler, false);
	xhr.addEventListener("error", errorHandler, false);
	xhr.addEventListener("abort", abortHandler, false);
	xhr.open("POST","server1.php");
	xhr.send(data);

	_('progressBar').style.display="block";
}
function progressHandler(e){
	//_('status_bytes').innerHTML = e.loaded + ' bytes uploadé sur ' + e.total;
	var percent = (e.loaded/e.total) * 100;
	_('status').innerHTML= Math.round(percent) + '% uploadé...Patientez';
	_('progressBar').value= Math.round(percent);
}
function completHandler(e){
	if (e.target.responseText!="Mauvais fichier") {
		_('status').innerHTML = e.target.responseText;
		//_('progressBar').style.display="none";
	}else{
		_('progressBar').style.display="none";
		_('status').style.display="none";
		alert("Choisissez un fichier csv svp!!!");
	}
}
function errorHandler(){
	_('status').innerHTML= "L'Importation a échoué";
}
function abortHandler(){
	_('status').innerHTML= "L'importation a été annulé";
}
document.getElementById('search').onChange=function search(){
	var xhr=new XMLHttpRequest();
	xhr.onreadystatechange=function(){
		if (xhr.readyState==4 && xhr.status==200){
			document.getElementById('filiere').innerHTML=="<? php echo 'Filière     : '.$l; ?>";

		}
	};
	xhr.open('GET', 'server.php?word='+_('search').value, true);
	xhr.send(null);	
}
function choix(){
	var search = document.getElementById('search');
	var course_libelle = document.getElementById('course_libelle');
	var date = document.getElementById('date');
	var filiere = document.getElementById('filiere');
	var level = document.getElementById('level');

	var xhr=new XMLHttpRequest();
	xhr.onreadystatechange=function(){
	  if (xhr.readyState==4 && xhr.status==200){
		filiere.innerHTML=xhr.responseText;

	  }
	};
	xhr.open('GET','server1.php?word='+search.value, true);
	xhr.send(null);
} 
function show(){
	if (_('blocp').style.display==="none") {
		_('blocp').style.display="block";
	}else{
		_('blocp').style.display="none";
	}
}     

function ouvre(name,titre,niveau,publication){
	var emplacement = document.getElementById('deo');
	emplacement.src="./uploads/"+name+"";
	_('titre').textContent="Titre: "+titre;
	_('genre').textContent="Niveau : "+niveau;
	_('year').textContent="Publiée le : "+publication;
}

function read_program(){
	var xhr= new XMLHttpRequest();
	xhr.onreadystatechange=function(){
	  if(xhr.readyState==4 && xhr.status==200){
		_('content_program').innerHTML=xhr.responseText;
	  } 
	}
	xhr.open('GET','server1.php?task=print_program',true)
	xhr.send(null)
}
function read_program_admin(){
	var xhr= new XMLHttpRequest();
	xhr.onreadystatechange=function(){
	  if(xhr.readyState==4 && xhr.status==200){
		_('content_program').innerHTML=xhr.responseText
	  } 
	}
	xhr.open('GET','server1.php?task=print_program_admin',true)
	xhr.send(null)
}
function verify_form(name){
	if (_('libelle').value=="" || _('desc').value=="" || _('date').value=="" || _('hours').value=="" || _('prof').value=="" || _('level').value=="" || _('degree').value=="" ) {
		alert('Remplissez bien les champs du formulaire');
		
	}else{
		date1=new Date().toLocaleDateString();
		date2=new Date(_('date').value).toLocaleDateString();
		time1=new Date().getHours()+':'+new Date().getMinutes();
		time2=_('hours').value;
		console.log(new Date().getHours()+':'+new Date().getMinutes());
		console.log(time2<time1);
		if (date2 < date1) {
			alert('Choisissez une date supérieure ou égale à celle d\'aujourd\'hui');
		}else if (time2 < time1) {
			alert('Choisissez une heure supérieure à celle choisi');
		}else{
			if (name=="ajout") {
				add_program_cours();
			}else{
				modif_program_cours();
			}
		}	
	}    
}

function add_program_cours(){
	
	var xhr=new XMLHttpRequest();
	xhr.onreadystatechange=function(){
	  if (xhr.readyState==4 && xhr.status==200){
		read_program_admin();
		_('formp').reset();
		_('blocp').style.display="none";
	  }
	};
	xhr.open('GET','server1.php?task=add_program&libelle='+_('libelle').value+'&desc='+_('desc').value+'&date='+_('date').value+'&hours='+_('hours').value+'&level='+_('level').value+'&degree='+_('degree').value+'&prof='+_('prof').value,true);
	xhr.send(null);
}
function modif(data){
	_('blocp').style.display='block';
	_('tete1').innerHTML="Modifier un programme";
	var tab=data.split(",");
	console.log(tab); 
	_('idp').value=tab[0];
	_('libelle').value=tab[1];    
	_('desc').value=tab[2];
	_('date').value=tab[3];    
	_('hours').value=tab[4];
	_('prof').value=tab[5];
	_('level').value=tab[6];    
	_('degree').value=tab[7];
	    
	_('btn_ajout').style.display='none'
	_('btn_modif').style.display='block'
}
   
function modif_program_cours(){
	if(confirm('Voulez vous vraiment appliquez ces modifications ?')){
	var xhr=new XMLHttpRequest();
	xhr.onreadystatechange=function(){
	if (xhr.readyState==4 && xhr.status==200){
		read_program_admin();
		_('formp').reset();
		_('blocp').style.display="none";
		alert('Moification effectué avec succès');
	}
	};
	xhr.open('GET','server1.php?task=modif_program&libelle='+_('libelle').value+'&desc='+_('desc').value+'&date='+_('date').value+'&hours='+_('hours').value+'&level='+_('level').value+'&degree='+_('degree').value+'&prof='+_('prof').value+'&idp='+_('idp').value,true);
	xhr.send(null);
	}else{
	_('formp').reset();
	_('blocp').style.display="none";
	}   
}
function del_program(id){
	if(confirm('Voulez vous vraiment supprimer ce programme ?')){
	  var xhr=new XMLHttpRequest();
	 xhr.onreadystatechange=function(){
		 if(xhr.readyState==4 && xhr.status==200){
			read_program_admin();
			alert('Suppression effectué abec succès');
		 }
	   };
	 xhr.open('GET','server1.php?task=del_program&idp='+id, true);
	 xhr.send(null);
	}  
}


