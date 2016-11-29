$(document).ready(function(){


	$('button.close').click(function(e){

		e.preventDefault();

		// Equivault a .attr('data-dismiss')
		var dataDismiss = $(this).data('dismiss');

		//closest est un element jquery qui va selectionner la classe la plus proche . 
		
		$(this).closest('.'+dataDismiss).remove();


	})//Fin du bouton_close






}); //Fin du dom 