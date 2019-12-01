
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
      function sortByKeyAsc(array, key) {
        return array.sort(function (a, b) {
            var x = a[key]; var y = b[key];
            return ((x < y) ? -1 : ((x > y) ? 1 : 0));
        });
    }
                        function onListReceived(data) {
                             console.log(sortByKeyAsc(data,'child-of-node-'));
                                $('.tree-tbody').empty();
                                var html = '';
                                $.each(data, function(key, value) {
                                     var node_id="";
                                    var node_class="";
                                    var empty_values='Neant';
                                    node_id = "node-" + value.id
                                    if(value.parent_id != null){
                                        node_class="child-of-node-" + value.parent_id;
                                       
                                    }
                                       //class="'+node_class+'" 
                                    html += '<tr id="'+node_id+'" class="'+node_class+'" >';
                                            if(value.title != null)
                                               html +=  '<td>'+value.title+'</td>';
                                             else
                                                 html += '<td>'+empty_values+'</td>';
                                              if(value.text != null)
                                                html += '<td>'+value.text+'</td>';
                                             else
                                                 html += '<td>'+empty_values+'</td>';
                                              if(value.type != null)
                                                html +=  '<td>'+value.type+'</td>';
                                            if(value.parent_id != null)
                                           html +=  '<td>'+value.parent_id+'</td>';
                                             else
                                                html +=  '<td>'+empty_values+'</td>';
                                                if(value.methode != null && value.methode != 'undefined')
                                           html +=  '<td>'+value.methode+'</td>';
                                             else
                                                 html +=  '<td>'+empty_values+'</td>';
                                             if(value.url != null)
                                                 html +=  '<td>'+value.url+'</td>';
                                             else
                                                 html += '<td>'+empty_values+'</td>';
                                        '</tr>';
                            
                              });
                               console.log(html);
                              $('.tree-tbody').append(html);
                               $("#tree").treeTable();
                        }
                        
                        function onError() {

                        }
});
}(jQuery));
