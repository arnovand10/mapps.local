(function(){
	//***** KAMERS / ROOM.PHP *****//
	var filter = document.querySelectorAll(".filter");
	var filterknop = document.getElementById("filterknop");
	var pijl = document.querySelector(".glyphicon-menu-down");
	
	var numberOnly = document.querySelector(".numberOnly");
	var aantalPersonen = document.querySelector("#aantalPersonen");

	
	if(numberOnly!=null)checkNumberValue(numberOnly, 1, 100);	
	if(aantalPersonen!=null)checkNumberValue(aantalPersonen, 1,8);
	

	
	filterknop.addEventListener("click",function(e){
			console.log("click");
			if(filter[0].style.display == "none"){
				filter[0].style.display = "table-row";
				filter[1].style.display = "table-row";
				pijl.className="";
				pijl.className="glyphicon glyphicon-menu-up";
			}else{
				filter[0].style.display = "none";
				filter[1].style.display = "none";
				pijl.className="";
				pijl.className="glyphicon glyphicon-menu-down";
			}
		});
	


	//wanneer de waarde in het inputveld veranderd check of nummer tussen 1 en 100 ligt
	function checkNumberValue(el,min,max){
		el.addEventListener("change",function(){
			if(el.value==""){el.value = "";}
			else if(el.value<min){el.value = min;}
			else if(el.value>max){el.value =max;}
		});
	}

	

	//add knop
	var addKnop = document.querySelector(".glyphicon-plus");
	addKnop.addEventListener("click",function(e){
		console.log("click");
		document.querySelector(".addUser").style.visibility = "visible";
		document.querySelector('[name="addFamilienaam"]').focus();
		document.querySelector(".addKamer").style.visibility = "visible";
		document.querySelector('[name="addkamer"]').focus();
	});

	
	//*****EINDE KAMERS/ROOM.PHP*******//
})();