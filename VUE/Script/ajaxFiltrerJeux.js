$(document).ready(function() {
	$('#formFiltrer').submit(function(e)
	{
		e.preventDefault();
		jsFiltrerJeux();
	});
	jsFiltrerJeux();
});

	
function jsFiltrerJeux(){
		console.log("ready!");
		var genres = '';
		$('#formFiltrer input:checked').each(function()
		{
			if (genres != '')
				genres += ',';
			genres += $(this).attr('name').substring(5);
		});

		var support = $('#support').val();
		var editeur = $('#editeur').val();

		//APPEL du fichier de traitement (ici : tt_FiltrerJeuxVideo.php) qui va récupérer les données et les renvoyer en JSON à cette page
		var filterDataRequest = $.ajax({
			url: '../CONTROLEUR/tt_FiltrerJeuxVideo.php',
			type: 'GET',
			data: { genres: genres , support: support , editeur : editeur },
			dataType: 'json'
		});



  
		
		//une fois les donnees réceptionnées en JSON
		filterDataRequest.done(function(data) {
			console.log("success");	console.log(data);
			/*Pour afficher le tableau des jeux retournés en JSON par la requête AJAX*/
			$('#tabJeux').text(""); // Vide le tableau des jeux.
			
			/*CHARGEMENT des jeux*/
			$('#tabJeux').append('<tr><th>Nom du jeu</th><th>Année de sortie</th><th>Éditeur</th></tr>');
			 $.each(data, function(index, value) {
				 $('#tabJeux').append('<tr><td>' + value.NOMJV + '</td><td>' + value.ANNEESORTIE + '</td><td>' + value.EDITEUR + '</td><td><input type="radio" onclick="jsClickRadioButton();" name="nomidjv" id="' + value.IDJV + '" value="' + value.IDJV + '" /></td></tr>');
			 		});	
		});
		filterDataRequest.fail(function(jqXHR, textStatus) {
				//alert("ERROR, jqXHR : "+ jqXHR.responseText + "textStatus : "+ textStatus );
				console.log( "error" );
				if (jqXHR.status === 0){alert("Not connect.n Verify Network.");}
				else if (jqXHR.status == 404){alert("Requested page not found. [404]");}
				else if (jqXHR.status == 500){alert("Internal Server Error [500].");}
				else if (textStatus === "parsererror"){alert("Requested JSON parse failed.");}
				else if (textStatus === "timeout"){alert("Time out error.");}
				else if (textStatus === "abort"){alert("Ajax request aborted.");}
				else{alert("Uncaught Error.n" + jqXHR.responseText);}
			});
		
		
		filterDataRequest.always(function(data) {
			console.log("complete");
		});
}




