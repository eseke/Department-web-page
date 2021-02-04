function fja(){
	var fileElement = document.getElementById('fajlovi');
	document.getElementById('imena').innerHTML = "Dodajte nazive odabranih fajlova:<br/>";
	for(var i=0;i<fileElement.files.length;i++){
	document.getElementById('imena').innerHTML +="<input type='tekst' id='fajl"+i+"' name='fajl"+i+"'>"+fileElement.files[i].name+"<br/>";
	}
	if(document.getElementById('odabir_sekc') && document.getElementById('odabir_sekc').value!='info')
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


function dodaj_obav(){
	document.getElementById('obavestenja').innerHTML='';
	var da= true;
	if(document.getElementById('kat').value==''){
		da = false;
		document.getElementById('obavestenja').innerHTML += "Niste izabrali kategoriju obaveštenja!<br/>";
	}
	if(document.getElementById('naslov').value==''){
		da = false;
		document.getElementById('obavestenja').innerHTML += "Niste uneli naslov obaveštenja!<br/>";
	}
	if(MyEditor.getData()==""){
		da = false;
		document.getElementById('obavestenja').innerHTML += "Niste uneli tekst obaveštenja!<br/>";
	}

	if(da)
		posalji_obav();
	return false;
}

function azur_nast(){
	document.getElementById('obav').innerHTML = "";
	var da = true;
	if(document.getElementsByName('name')[0].value==''){
		document.getElementById('obav').innerHTML += "Ime mora biti uneto!<br/>";
		da = false;
	}
	if(document.getElementsByName('surname')[0].value==''){
		document.getElementById('obav').innerHTML += "Prezime mora biti uneto!<br/>";
		da = false;
	}
	if(document.getElementsByName('adresa')[0].value==''){
		document.getElementById('obav').innerHTML += "Adresa mora biti uneta!<br/>";
		da = false;
	}
	if(document.getElementsByName('mobilni')[0].value!='' && isNaN(document.getElementsByName('mobilni')[0].value)){
		document.getElementById('obav').innerHTML += "Niste pravilno uneli broj telefona!<br/>";
		da = false;
	}
	if(document.getElementsByName('zvanje')[0].value==''){
		document.getElementById('obav').innerHTML += "Niste odabrali zvanje!<br/>";
		da = false;
	}
	if(document.getElementsByName('kabinet')[0].value==''){
		document.getElementById('obav').innerHTML += "Niste uneli broj kabineta!<br/>";
		da = false;
	}
	if(document.getElementsByName('slika')[0].value!=''){
		var img = new Image();
		img.onload = function(){
		
			if(this.width>300||this.height>300){
				document.getElementById('obav').innerHTML += "Slika je prevelika!<br/>";
				da = false;
			}
			if(da)
				azur_nasta();
		};
		img.src = document.getElementsByName('slika')[0].value;
	}
	else{
		if(da)
			azur_nasta();
	}
	
	return false;
}

function dodaj_nast(){
	document.getElementById('obav').innerHTML = "";
	var da = true;
	if(document.getElementsByName('username')[0].value==''){
		document.getElementById('obav').innerHTML += "Korisničko ime mora biti uneta!<br/>";
		da = false;
	}
	if(document.getElementsByName('pass')[0].value==''){
		document.getElementById('obav').innerHTML += "Inicijalna šifra mora biti uneta!<br/>";
		da = false;
	}
	if(document.getElementsByName('name')[0].value==''){
		document.getElementById('obav').innerHTML += "Ime mora biti uneto!<br/>";
		da = false;
	}
	if(document.getElementsByName('surname')[0].value==''){
		document.getElementById('obav').innerHTML += "Prezime mora biti uneto!<br/>";
		da = false;
	}
	if(document.getElementsByName('adresa')[0].value==''){
		document.getElementById('obav').innerHTML += "Adresa mora biti uneta!<br/>";
		da = false;
	}
	if(document.getElementsByName('mobilni')[0].value!='' && isNaN(document.getElementsByName('mobilni')[0].value)){
		document.getElementById('obav').innerHTML += "Niste pravilno uneli broj telefona!<br/>";
		da = false;
	}
	if(document.getElementsByName('zvanje')[0].value==''){
		document.getElementById('obav').innerHTML += "Niste odabrali zvanje!<br/>";
		da = false;
	}
	if(document.getElementsByName('kabinet')[0].value==''){
		document.getElementById('obav').innerHTML += "Niste uneli broj kabineta!<br/>";
		da = false;
	}
	if(da)
		dodaj_nasta();

	return false;
}

function azur_stud(){
	document.getElementById('obav').innerHTML = "";
	var da = true;
	var ind = document.getElementsByName('indeks')[0].value.split("/");
	var tip_st = document.getElementsByName('tip_studija')[0].value;
	if(ind.length!=2 || isNaN(ind[0])|| isNaN(ind[1])||ind[0].length!=4||ind[1].length!=4||(tip_st=='d'&&ind[1][0]!='0')||(tip_st=='m'&&ind[1][0]!='3')||(tip_st=='p'&&ind[1][0]!='5')){
		document.getElementById('obav').innerHTML += "Broj indeksa nije ispravan!<br/>";
		da = false;
	}
	if(document.getElementsByName('name')[0].value==''){
		document.getElementById('obav').innerHTML += "Ime mora biti uneto!<br/>";
		da = false;
	}
	if(document.getElementsByName('surname')[0].value==''){
		document.getElementById('obav').innerHTML += "Prezime mora biti uneto!<br/>";
		da = false;
	}
	if(document.getElementsByName('tip_studija')[0].value==''){
		document.getElementById('obav').innerHTML += "Niste odabrali tip studija!<br/>";
		da = false;
	}
	if(da)
		azur_studa();
	return false;
}

function dodaj_stud(){
	document.getElementById('obav').innerHTML = "";
	var da = true;
	if(document.getElementsByName('pass')[0].value==''){
		document.getElementById('obav').innerHTML += "Inicijalna šifra mora biti uneta!<br/>";
		da = false;
	}
	var ind = document.getElementsByName('indeks')[0].value.split("/");
	var tip_st = document.getElementsByName('tip_studija')[0].value;
	if(ind.length!=2 || isNaN(ind[0])|| isNaN(ind[1])||ind[0].length!=4||ind[1].length!=4||(tip_st=='d'&&ind[1][0]!='0')||(tip_st=='m'&&ind[1][0]!='3')||(tip_st=='p'&&ind[1][0]!='5')){
		document.getElementById('obav').innerHTML += "Broj indeksa nije ispravan!<br/>";
		da = false;
	}
	if(document.getElementsByName('name')[0].value==''){
		document.getElementById('obav').innerHTML += "Ime mora biti uneto!<br/>";
		da = false;
	}
	if(document.getElementsByName('surname')[0].value==''){
		document.getElementById('obav').innerHTML += "Prezime mora biti uneto!<br/>";
		da = false;
	}
	if(document.getElementsByName('tip_studija')[0].value==''){
		document.getElementById('obav').innerHTML += "Niste odabrali tip studija!<br/>";
		da = false;
	}
	if(da)
		dodaj_studa();

	return false;
}

function change_pass(){
	document.getElementById('obav').innerHTML = "";
	var da = true;
	if(document.getElementById('old_pass').value==''||document.getElementById('new_pass1').value==''||document.getElementById('new_pass2').value==''){
		document.getElementById('obav').innerHTML += "Šifra ne može biti prazna!<br/>";
		da = false;
	}
	if(document.getElementById('new_pass1').value!=document.getElementById('new_pass2').value){
		document.getElementById('obav').innerHTML += "Na oba polja treba da upišete istu novu šifru!<br/>";
		da = false;
	}
	if(da)
		change_passa();
	return false;
}