
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
                                        okmenu.GetAllMenuByUser(userId, onListReceived, onError);

								});
						// bouton génération menu
						$('body').on('click', '#btn_generateMenu',function(e) {
									e.preventDefault();
									okmenu.Generate(userId);
								});
						
                                                // gestion des données de la liste des menus 
                        function onListReceived(data) {
                            
                             data = sortByKey(data);
                             var parent = [];
                             $.each(data, function(key, value){
                                 if(valueparent_id )
                                parent.push(key, value);
                            });
                            console.log(parent);
//                                $('.tree-tbody').empty();
//                                var html = '';
//                                $.each(data, function(key, value) {
//                                    
//                                     var node_id="";
//                                    var node_class="";
//                                    var empty_values='Neant';
//                                    node_id = "node-" + value.id
//                                    if(value.parent_id != null){
//                                        node_class="child-of-node-" + value.parent_id;
//                                       
//                                    }
//                                       //class="'+node_class+'" 
//                                    html += '<tr id="'+node_id+'" class="'+node_class+'" >';
//                                            if(value.title != null)
//                                               html +=  '<td>'+value.title+'</td>';
//                                             else
//                                                 html += '<td>'+empty_values+'</td>';
//                                              if(value.text != null)
//                                                html += '<td>'+value.text+'</td>';
//                                             else
//                                                 html += '<td>'+empty_values+'</td>';
//                                              if(value.type != null)
//                                                html +=  '<td>'+value.type+'</td>';
//                                            if(value.parent_id != null)
//                                           html +=  '<td>'+value.parent_id+'</td>';
//                                             else
//                                                html +=  '<td>'+empty_values+'</td>';
//                                                if(value.methode != null && value.methode != 'undefined')
//                                           html +=  '<td>'+value.methode+'</td>';
//                                             else
//                                                 html +=  '<td>'+empty_values+'</td>';
//                                             if(value.url != null)
//                                                 html +=  '<td>'+value.url+'</td>';
//                                             else
//                                                 html += '<td>'+empty_values+'</td>';
//                                        '</tr>';
//                            
//                              });
//                              $('.tree-tbody').append(html);
//                               $("#tree").treeTable();
                        }
                        
                        function onError() {

                        }
                        
                        function constructTrBody(node_id, node_class, title, text, type, parent_id, methode, url){
                            var empty_values = 'Neant';
                           var html = '<tr id="'+node_id+'" class="'+node_class+'" >';
                                            if(title != null)
                                               html +=  '<td>'+title+'</td>';
                                             else
                                                 html += '<td>'+empty_values+'</td>';
                                              if(text != null)
                                                html += '<td>'+text+'</td>';
                                             else
                                                 html += '<td>'+empty_values+'</td>';
                                              if(type != null)
                                                html +=  '<td>'+type+'</td>';
                                            if(parent_id != null)
                                           html +=  '<td>'+parent_id+'</td>';
                                             else
                                                html +=  '<td>'+empty_values+'</td>';
                                                if(methode != null && methode != 'undefined')
                                           html +=  '<td>'+methode+'</td>';
                                             else
                                                 html +=  '<td>'+empty_values+'</td>';
                                             if(url != null)
                                                 html +=  '<td>'+url+'</td>';
                                             else
                                                 html += '<td>'+empty_values+'</td>';
                                        '</tr>';
                                        return html;
                        }
                        
                        function getObjects(obj, key, val) 
                        {
                            
                            var newObj = []; 
                            $.each(obj, function(k,v)
                            {
                                if(val == v[key])
                                {
                                    newObj.push(v);
                                }
                            });

                            return newObj;
                        }
                        
                        function sortByKey(array, key) {
                            return array.sort(function(a, b) {
                                var x = a[key]; var y = b[key];
                                return ((x < y) ? -1 : ((x > y) ? 1 : 0));
                            });
                        }
});
}(jQuery));
