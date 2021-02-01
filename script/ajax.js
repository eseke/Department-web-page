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
			document.getElementById('sadrzaj').innerHTML = this.responseText;
	};
	
	var formData = new FormData( document.getElementById("forma") );
	formData.append('dole',d);
	formData.append('dole_id',id);
	xhttp.open("POST", "predmeti.php");
	xhttp.send(formData);
	return false;
}