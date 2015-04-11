function submitForm(){
	xhr = new XMLHttpRequest;
	var x=document.getElementById('titre').value;
        var URL=Routing.generate('rechercher_guide', {titre: x});

	
	xhr.open("GET",URL, true);
	xhr.send(null);
	xhr.onreadystatechange=result;
           
             
	function result(){
           
               
		document.getElementById("result").innerHTML= xhr.responseText;
		}	
	}

        
       function visibilite(thingId)
        {
        var targetElement;
        targetElement = document.getElementById(thingId) ;
        if (targetElement.style.display === "none")
        {
        targetElement.style.display = "block" ;
        
        } else {
        targetElement.style.display = "none" ;
        }
        }
        
       