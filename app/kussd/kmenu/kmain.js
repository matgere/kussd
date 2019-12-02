
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
                             //console.log(data);
                                $('.tree-tbody').empty();
                                var html = '';
                                $.each(data, function(key, value) {
                                    console.log(value.Parent);
                                     var node_id="";
                                    var node_class="";
                                    var empty_values='Neant';
                                   
                                    var title='';
                                        var type='';
                                        var parent_id='';
                                        var parent_name='';
                                        var text='';
                                        var methode='';
                                        var url='';
                                        var ordre='';
                                    if(typeof value.Parent != 'undefined'){
                                        node_id = "node-" + value.id;
                                        title = value.Parent;
                                    }
                                    else if(typeof value.Parent == 'undefined'){
                                         node_id = "node-" + value.id;
                                         node_class="child-of-node-" + value.parent_id;
                                            parent_name = value.parent_name;
                                            title = value.title;
                                            type = value.type +', seq: '+value.ordre;
                                            text = value.text;
                                            parent_id = value.parent_id;
                                            methode = value.methode;
                                            url = value.url;
                                            //ordre = value.ordre;
                                    }
                                        
                                       //class="'+node_class+'" 
                                    html += '<tr id="'+node_id+'" class="'+node_class+'" >';
                                            if(title != null )
                                               html +=  '<td>'+title+'</td>';
                                             else
                                                 html += '<td>'+empty_values+'</td>';
                                              if(value.text != null)
                                                html += '<td>'+text+'</td>';
                                             else
                                                 html += '<td>'+empty_values+'</td>';
                                              if(value.type != null)
                                                html +=  '<td>'+type+'</td>';
                                            if(value.parent_name != null)
                                           html +=  '<td>'+parent_name+'</td>';
                                             else
                                                html +=  '<td>'+empty_values+'</td>';
                                                if(value.methode != null && value.methode != 'undefined')
                                           html +=  '<td>'+methode+'</td>';
                                             else
                                                 html +=  '<td>'+empty_values+'</td>';
                                             if(value.url != null)
                                                 html +=  '<td>'+url+'</td>';
                                             else
                                                 html += '<td>'+empty_values+'</td>';
                                        '</tr>';
                            
                              });
//                               console.log(html);
                              $('.tree-tbody').append(html);
                               $("#tree").treeTable();
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
