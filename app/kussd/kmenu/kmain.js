;
(function($) {
	// -initialize the javascript
	$(document)
			.ready(
					function() {	
						var okmenu = new kmenu();
						var userId=1;
						
						  $("#tree").treeTable();
						  
						// bouton ajout dossier
						$('body').on('click', '#btn_newMenu',function(e) {
									e.preventDefault();
//									$( ".div-menu" ).show();
									okmenu.New(userId, function () {
	                                }, null);
								});
						// bouton génération menu
						$('body').on('click', '#btn_generateMenu',function(e) {
									e.preventDefault();
									okmenu.Generate(userId);
								});
						
});
}(jQuery));
