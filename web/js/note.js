function validerNote(){
	xhr = new XMLHttpRequest;
	
	var id_d = document.getElementById('id_d').value;
	var id_c = document.getElementById('id_c').value;
	var interactivite = document.getElementById('zone1').value;
	
	
	URL = "php/validerNote.php?id_d="+id_d+"&id_c="+id_c+"&interactivite="+interactivite+"&presence="+presence+"&modernite="+modernite;
	
	xhr.open("GET",URL, true);
	xhr.send(null);
	xhr.onreadystatechange=result;
	
	
	function result(){
		
		document.getElementById("zone").innerHTML= xhr.responseText;
		}	
	}