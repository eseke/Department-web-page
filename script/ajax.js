function loadNotifications() {
	str = document.getElementById('odabir').value;
	if(str=="")
		document.getElementById('obavestenja').innerHTML = "";
	else{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById('obavestenja').innerHTML = this.responseText;
		}
		};
		xhttp.open("GET", "obav.php?predmet="+str, true);
		xhttp.send();
	}
}

let MyEditor1;
let MyEditor2;
let MyEditor3;
function load_info() {
	var predmet = document.getElementById('odabir_pred').value;
	var sekc = document.getElementById('odabir_sekc').value;
	if(sekc ==""||predmet=="")
		document.getElementById('sadrzaj').innerHTML = "";
	else{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById('sadrzaj').innerHTML = this.responseText;
			if(document.getElementById("editor1")){
				ClassicEditor
        		.create( document.querySelector( '#editor1' ),{
				toolbar: ['bold','italic', '|','bulletedList', 'numberedList']
				} )
				.then(editor => {
        			MyEditor1=editor;
    			})
        		.catch( error => {
				console.error( error );
			} );
			}
			if(document.getElementById("editor2")){
    			ClassicEditor
        		.create( document.querySelector( '#editor2' ),{
					toolbar: ['bold','italic', '|','bulletedList', 'numberedList']
				} )
				.then(editor => {
        			MyEditor2=editor;
    			})
        		.catch( error => {
            		console.error( error );
        		} );
			}
			if(document.getElementById("editor3")){
    			ClassicEditor
        		.create( document.querySelector( '#editor3' ),{
					toolbar: ['bold','italic', '|','bulletedList', 'numberedList']
				} )
				.then(editor => {
        			MyEditor3=editor;
    			})
        		.catch( error => {
            		console.error( error );
        		} );
			}
		}
		};
		var formData = new FormData();
		formData.append('odabir_pred',document.getElementById('odabir_pred').value);
		formData.append('odabir_sekc',document.getElementById('odabir_sekc').value);
		formData.append('prom',1);
		xhttp.open("POST", "predmeti.php", true);
		xhttp.send(formData);
	}
}

function change_info(){
	var xhttp = new XMLHttpRequest();
	var formData = new FormData( document.getElementById("forma") );
	formData.append('sadrzaj1',MyEditor1.getData());
	formData.append('ishod1',MyEditor2.getData());
	formData.append('kom1',MyEditor3.getData());
	xhttp.open("POST", "predmeti.php");
	xhttp.send(formData);	
}


function obr(a){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) 
			document.getElementById('sadrzaj').innerHTML = this.responseText;
	};
	var formData = new FormData();
	formData.append('odabir_pred',document.getElementById('odabir_pred').value);
	formData.append('odabir_sekc',document.getElementById('odabir_sekc').value);
	formData.append('obrisi',a);
	xhttp.open("POST", "predmeti.php", true);
	xhttp.send(formData);
	return false;
}


function vidi(ele){
	
	var xhttp = new XMLHttpRequest();
	var formData = new FormData();
	
	formData.append('vidi',ele.name);
	formData.append('val',ele.checked);
	xhttp.open("POST", "predmeti.php",true);
	xhttp.send(formData);	
}


function posaljiFajlove(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) 
			document.getElementById('sadrzaj').innerHTML = this.responseText;
	};
	var formData = new FormData( document.getElementById("forma") );
	xhttp.open("POST", "predmeti.php");
	xhttp.send(formData);	
}


function gore(g,id){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) 
			document.getElementById('sadrzaj').innerHTML = this.responseText;
	};
	
	var formData = new FormData( document.getElementById("forma") );
	formData.append('gore',g);
	formData.append('gore_id',id);
	xhttp.open("POST", "predmeti.php");
	xhttp.send(formData);
	return false;
}


function dole(d,id){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) 
			document.getElementById('res').innerHTML = this.responseText;
	};
	
	var formData = new FormData( document.getElementById("forma") );
	formData.append('dole',d);
	formData.append('dole_id',id);
	xhttp.open("POST", "predmeti.php");
	xhttp.send(formData);
	return false;
}


function dodaj_kat(){
	if(document.getElementById('nova_kat').value!=''){
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200){
				if(this.responseText=='1'){
					var option = document.createElement("option");
					option.text = document.getElementById('nova_kat').value;
					option.value = document.getElementById('nova_kat').value;
					document.getElementById("kat").add(option);
				}
				document.getElementById('nova_kat').value="";
			}
		};
		var formData = new FormData();
		formData.append('nova_kat',document.getElementById('nova_kat').value);
		xhttp.open("POST", "obavestenja.php");
		xhttp.send(formData);
	}
}


function posalji_obav(){
	var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200){
				if(this.responseText=='1'){
					document.getElementById('obavestenja').innerHTML = "Uspešno ste dodali obaveštenje!";
				}
			}
		};
		var formData = new FormData();
		formData.append('kat',document.getElementById('kat').value);
		formData.append('naslov',document.getElementById('naslov').value);
		formData.append('sadrzaj',MyEditor.getData());
		xhttp.open("POST", "obavestenja.php");
		xhttp.send(formData);
}

function dodaj_gr(){
	document.getElementById('obv1').innerHTML = "";
	tmp = document.getElementById('vreme').value;
	if(document.getElementById('predmet1').value=='')
		document.getElementById('obv1').innerHTML = "<span style='color:red'>Niste odabrali predmet!</span>";
	else if(document.getElementById('tip').value=='')
		document.getElementById('obv1').innerHTML = "<span style='color:red'>Niste odabrali tip grupe!</span>";
	else if(document.getElementById('dan').value=='')
		document.getElementById('obv1').innerHTML = "<span style='color:red'>Niste odabrali dan u nedelji!</span>";
	else if(tmp==''){
		document.getElementById('obv1').innerHTML = "<span style='color:red'>Unesite vreme početka!</span>";
	}
	else{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200){
				if(this.responseText=='1'){
					document.getElementById('obv1').innerHTML = "Uspešno ste dodali grupu!";
					document.getElementById('predmet1').value="";
					document.getElementById('tip').value = "";
					document.getElementById('dan').value="";
					document.getElementById('vreme').value="";
				}
			}
		};
		var formData = new FormData();
		formData.append('pred',document.getElementById('predmet1').value);
		formData.append('tip',document.getElementById('tip').value);
		formData.append('dan',document.getElementById('dan').value);
		formData.append('vreme',parseInt(document.getElementById('vreme').value));
		xhttp.open("POST", "nastavni_plan.php");
		xhttp.send(formData);
	}
}


function ispis_gr(){
	if(document.getElementById('predmet2').value!=''){
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200)
				document.getElementById('grupe').innerHTML = this.responseText;
		};
		var formData = new FormData();
		formData.append('predmet2',document.getElementById('predmet2').value);
		xhttp.open("POST", "nastavni_plan.php");
		xhttp.send(formData);
	}
	else
		document.getElementById('grupe').innerHTML = "";
		document.getElementById('obv2').innerHTML = "";
}

function dodaj_nas(){
	tmp = document.getElementById('vreme').value;
	if(document.getElementById('nastavnik1').value=='')
		document.getElementById('obv2').innerHTML = "<span style='color:red'>Niste odabrali nastavnika!</span>";
	else if(document.getElementById('grupa').value=='')
		document.getElementById('obv2').innerHTML = "<span style='color:red'>Niste odabrali grupu!</span>";
	else{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200){
				if(this.responseText=='1'){
					document.getElementById('obv2').innerHTML = "Uspešno ste dodali grupu!";
					document.getElementById('grupe').innerHTML="";
					document.getElementById('nastavnik1').value = "";
					document.getElementById('predmet2').value="";
				}else{
					document.getElementById('obv2').innerHTML = "Nastavnik je već dodat ovoj grupi!";
				}
			}
		};
		var formData = new FormData();
		formData.append('grupa',document.getElementById('grupa').value);
		formData.append('nastavnik',document.getElementById('nastavnik1').value);
		xhttp.open("POST", "nastavni_plan.php");
		xhttp.send(formData);
	}
}