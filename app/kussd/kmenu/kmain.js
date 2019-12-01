
/**
 * @author Diodio MBODJ
 */
;
(function($) {
	// -initialize the javascript
	$(document)
			.ready(
					function() {	
						var okmenu = new kmenu();
						var userId=1;
                                                 okmenu.GetAllMenuByUser(userId, onListReceived, onError);
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
						
                                                // gestion des données de la liste des enregistrements 
                        function onListReceived(data) {
                             console.log(data);
                                $('.tree-tbody').empty();
                                var html = '';
                                $.each(data, function(key, value) {
                                     var node_id="";
                                    var node_class="";
                                    node_id = "node-" + value.id
                                    if(value.parent_id != null){
                                        node_class="child-of-node-" + value.parent_id;
                                    }
                                        
                                    html += '<tr id="'+node_id+'" class="'+node_class+'">'
                                           + '<td>'+value.title+'</td>'
                                           +'<td>'+value.text+'</td>'
                                           + '<td>'+value.type+'</td>'
                                           + '<td>'+value.parent_id+'</td>'
                                           + '<td>'+value.methode+'</td>'
                                           + '<td>'+value.url+'</td>'
                                        '</tr>';
                            
                              });
                               console.log(html);
                              $('.tree-tbody').append(html);
                              
                        }
                        
                        function onError() {

                        }
});
}(jQuery));
