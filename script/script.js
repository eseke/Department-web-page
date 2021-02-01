function fja(){
	var fileElement = document.getElementById('fajlovi');
	document.getElementById('imena').innerHTML = "Dodajte nazive odabranih fajlova:<br/>";
	for(var i=0;i<fileElement.files.length;i++){
	document.getElementById('imena').innerHTML +="<input type='tekst' id='fajl"+i+"' name='fajl"+i+"'>"+fileElement.files[i].name+"<br/>";
	}
	if(document.getElementById('odabir_sekc').value!='info')
	document.getElementById('imena').innerHTML +="<input type='submit' value='Dodaj fajlove' onclick='return dodajFajlove()'><br/>";
	
}

function proveri_formu(){
	document.getElementById('obavestenja').innerHTML= "";
	var ne = false;
	if(document.getElementById('odabir')&&document.getElementById('odabir').value=="")
	{
		document.getElementById('obavestenja').innerHTML += "Odaberite predmet<br/>";
		ne = true;
	}
	if(document.getElementById('naslov').value=="")
	{
		document.getElementById('obavestenja').innerHTML += "Upišite naslov vesti!<br/>";
		ne = true;
	}
	if(document.getElementById('datepicker').value.length<11){
		document.getElementById('obavestenja').innerHTML += "Odaberite ispravan datum!<br/>";
		ne = true;
	}
	if(MyEditor.getData()==""){
		document.getElementById('obavestenja').innerHTML += "Unesite tekst obaveštenja!<br/>";
		ne = true;
	}
	for(var i =0;i<document.getElementById('fajlovi').files.length;i++){
		if(document.getElementById('fajl'+i).value==""){
		document.getElementById('obavestenja').innerHTML += "Unesite ime dodatog fajla!<br/>";
		ne = true;
		break;
		}
	}
	if(ne)
	return false;
}

function proveri_formu1(){
	document.getElementById('obavestenja').innerHTML="";
	var ne=false;
	if(isNaN(document.getElementById('ESPB').value)){
		document.getElementById('obavestenja').innerHTML += "Morate upisati broj za ESPB!<br/>";
		ne = true;
	}
	if(isNaN(document.getElementById('br_pred').value)){
		document.getElementById('obavestenja').innerHTML += "Broj predavanja treba biti broj!<br/>";
		ne = true;
	}
	if(isNaN(document.getElementById('br_vez').value)){
		document.getElementById('obavestenja').innerHTML += "Broj vežbi treba biti broj!<br/>";
		ne = true;
	}
	if(isNaN(document.getElementById('br_lab').value)){
		document.getElementById('obavestenja').innerHTML += "Broj laboratorijskih vežbi treba biti broj!<br/>";
		ne = true;
	}
	if(MyEditor1.getData()==""){
		document.getElementById('obavestenja').innerHTML += "Niste uneli cilj predmeta!<br/>";
		ne = true;
	}
	if(MyEditor2.getData()==""){
		document.getElementById('obavestenja').innerHTML += "Niste uneli ishod predmeta!<br/>";
		ne = true;
	}
	if(!ne)
		change_info();
	return false;
}

function dodajFajlove(){
	document.getElementById('obavestenja').innerHTML= "";
	var ne = false;
	for(var i =0;i<document.getElementById('fajlovi').files.length;i++){
		if(document.getElementById('fajl'+i).value==""){
			document.getElementById('obavestenja').innerHTML += "Unesite ime dodatog fajla!<br/>";
			ne = true;
			break;
		}
	}
	if(!ne)
		posaljiFajlove();
	return false;
}