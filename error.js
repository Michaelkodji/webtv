function add_personnel(){
var nom= document.getElementById('name').value;
var prenom = document.getElementById('prenom').value;
var sexe = document.getElementById('sexe').value;
var birthday = document.getElementById('birth_date').value;
var date_embauche = document.getElementById('embauche_date').value;
var phone = document.getElementById('phone').value;
var cnss = document.getElementById('cnss').value;
var sb = document.getElementById('sb').value;
var diplome = document.getElementById('diplome').value;
var personnel = document.getElementById('cnss').value;


	if(nom=="" || prenom=="" || sexe=="" || date_embauche=="" || phone=="" || sb=="" || diplome=="" || prersonnel==""){
		alert('Remplissez bien les champs du formulaire');
	}
	else{
		var xhr= new XMLHttpRequest();
		xhr.onreadystatechange=function(){
			if(xhr.readyState==4 && xhr.status==200){
				read_personnel();
				document.getElementById('personnel_form').reset();

			}
		};

		xhr.open('GET','server.php?task=add_personnel&nom='+nom+'&prenom='+prenom+'&sexe='+sexe+'&birthday='+birthday+'&date_embauche='+date_embauche+'&phone='+phone+'&cnss='+cnss+'&sb='+sb+'&diplome='+diplome+'&personnel='+personnel,true);
		xhr.send(null);
	}
}
