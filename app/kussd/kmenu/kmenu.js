/* ==========================================================================
 * Univers Edu V2
 * kda.js plugin contient toutes les fonctions concernant la demande d'admission
 *  @copyright  2018 Kiwi/2SI Group
 * ==========================================================================
 */
;
(function ($) {
	kmenu = function (options) {
		var o = {
	            generateMenuUrl: '../../../backend/src/bo/menu/MenuController.php?ACTION=GENERATE_MENU',
	            addMenuUrl: '../../../backend/src/bo/menu/MenuController.php?ACTION=INSERT',
	            getAllMenuByUser: '../../../backend/src/bo/menu/MenuController.php?ACTION=GET_ALL_MENU_BY_USER',
	        };
		  // constructor
        var construct = function (options) {
            $.extend(o, options);
        };
    	
        //Ajout de menu
    	this.New = function (userId, onAdded, onError) {
            LoadForm(this, 'ADD', null, userId, onAdded, onError);
        };
        
        //Génération des menus sur l'ussd
        this.Generate = function ( userId, onGenered, onError) {
            LoadGenerate(this, userId, onGenered, onError);
        };
        
     // Cette fonction permet de charger tous les menus d'un user
        this.GetAllMenuByUser = function (userId, onDataReceived, onError) {
            $.ajax({
                method: "GET",
                url: o.getAllMenuByUser,
                async: false,
                data: {userId:userId}
            }).done(function (data) {
//            	console.log(data);
                onDataReceived($.parseJSON(data));
//                onDataReceived(data);
            }).fail(function (e) {
                new PNotify({type: 'error', title: 'Univers Edu', text: 'Une erreur est survenue lors du traitement de votre requête.'});
            });
        };
        
        
        function LoadForm(self, Action, eData, userId, onSaved, onError) {
            var $content = null;

            var dg = new bsDialog({
                title: 'Nouveau Menu ',
                size: '300',
                draggable: true,
                message: function (dialog) {
                    $content = $('<div style="width:100%">\
                            <form id="form_examen" style="margin-top: 1em;">\
                                        <div class="card-body">\
                                            <div class="row">\
                                              <div class="col-lg-6">\
                                      <div class="form-group row">\
                                <label class="col-12 col-sm-4 col-form-label text-left text-sm-right">Nom</label>\
                                <div class="col-12 col-sm-8 col-lg-7">\
                                    <input class="form-control form-control-sm" type="text" name="nom_name" id="nom_id" placeholder="">\
                                </div>\
                            </div>\
                            <div class="form-group row">\
                            <label class="col-12 col-sm-4 col-form-label text-left text-sm-right">Titre</label>\
                            <div class="col-12 col-sm-8 col-lg-7">\
                                <input class="form-control form-control-sm" type="text" name="titre_name" id="titre_id" placeholder="">\
                            </div>\
                        </div>\
                            <div class="form-group row">\
                    		<label class="col-12 col-sm-4 col-form-label text-left text-sm-right">Text</label>\
                    		<div class="col-12 col-sm-8 col-lg-7">\
                            <input class="form-control form-control-sm" type="text" name="text_name" id="text_id" placeholder="">\
                            </div>\
                            </div>\
                            <div class="form-group row">\
                                <label class="col-12 col-sm-4 col-form-label text-left text-sm-right">Parent</label>\
                                <div class="col-12 col-sm-8 col-lg-7">\
                    		<select class="form-control form-control-xs" id="parent_id"  style="height:30px!important;">\
                    		<option value="ALL">Selectionner un parent</option>\
                    		</select>\
                                </div>\
                            </div>\
                    		</div>\
                            <div class="col-lg-6">\
                    		<div class="form-group row">\
                    		<label class="col-12 col-sm-4 col-form-label text-left text-sm-right">Type</label>\
                    		<div class="col-12 col-sm-8 col-lg-30" >\
                            <label class="custom-control custom-radio custom-control-inline">\
                            <input class="custom-control-input type" type="radio" id="type_id" name="radio_type" value="input" checked=""><span class="custom-control-label">Form</span>\
                          </label>\
                              <label class="custom-control custom-radio custom-control-inline">\
                                <input class="custom-control-input type" type="radio" id="type_id" name="radio_type" value="accesskey" ><span class="custom-control-label">Menu</span>\
                            <div class="col-12 col-sm-8 col-lg-7 hidden ordre">\
                		<select class="form-control form-control-xs" id="ordre_id"  style="height:30px!important;width: 75px !important;">\
                		<option value="ALL">Ordre</option>\
                		<option value="1">1</option>\
						  	<option value="2">2</option>\
                		<option value="3">3</option>\
						  	<option value="4">4</option>\
						  	<option value="5">5</option>\
                		</select>\
                            </div>\
                    		</label>\
                            </div>\
                            </div>\
                    		<div class="form-group row">\
                    		<label class="col-12 col-sm-4 col-form-label text-left text-sm-right">Action</label>\
                            <div class="col-12 col-sm-8 col-lg-7">\
                                <input class="form-control form-control-sm" type="text" name="action_name" id="actions_id" placeholder="">\
                            </div>\
                        </div>\
                    		<div class="form-group row">\
                            <label class="col-12 col-sm-4 col-form-label text-left text-sm-right">Methode</label>\
                            <div class="col-12 col-sm-8 col-lg-7">\
                            <label class="custom-control custom-radio custom-control-inline">\
                            <input class="custom-control-input" type="radio" id="methode_id" name="radio_methode" value="get" checked=""><span class="custom-control-label">GET</span>\
                          </label>\
                          <label class="custom-control custom-radio custom-control-inline">\
                            <input class="custom-control-input" type="radio" id="methode_id" name="radio_methode" value="post"><span class="custom-control-label">POST</span>\
                          </label>\
                        </div>\
                        </div>\
                    		<div class="form-group row">\
                            <label class="col-12 col-sm-4 col-form-label text-left text-sm-right">URL</label>\
                            <div class="col-12 col-sm-8 col-lg-7">\
                                <input class="form-control form-control-sm" type="text" name="url_name" id="url_id" placeholder="">\
                            </div>\
                        </div>\
                        </div>\
                    </div>\
                    </form>\
           </div>');
                    dialog.getModal().addClass('dialog-large');
                    dialog.getModalBody().addClass('no-padding');
                    
                 // Debut chargement des nationalite sur le form
    				self.GetAllMenuByUser(userId, function(data) {
//    					console.log(JSON.parse(data));
						$content.find('#parent_id').empty();
						$content.find('#parent_id').append('<option value="ALL">Selectionner un parent</option>');
    					$.each(data, function (key, value) {
    						$content.find('#parent_id').append('<option value='+value.id+' >' +value.name+ '</option>');
    					});
    				}
    	            , function() { }// onError()
    			 );
    			// Fin chargement des nationalite sur le form
    				
    				//debut ordre
    					$content.find('.type').change(
    							function() {
    		    					console.log($content.find('.type:checked').val());
    								if($content.find('.type:checked').val()=="accesskey")
    		    						$content.find('.ordre').removeClass('hidden');
    								else
    		    						$content.find('.ordre').addClass('hidden');
    							});
    				//fin ordre
    				
                    return $content;
                },
                buttons: [
                    {
                        id: 'btn-ok',
                        cssClass: 'btn-success',
                        label: 'Valider',
                        action: function (dialog) {
                            var eParams = '';
                            eParams += 'userId=' + userId;
                            eParams += '&name=' + dialog.getModalBody().find('#nom_id').val();
                            eParams += '&title=' + dialog.getModalBody().find('#titre_id').val();
                            eParams += '&text=' + dialog.getModalBody().find('#text_id').val();
                            eParams += '&parent=' + dialog.getModalBody().find('#parent_id').val();
                            eParams += '&type=' + dialog.getModalBody().find('#type_id:checked').val();
                            eParams += '&ordre=' + dialog.getModalBody().find('#ordre_id').val();
                            eParams += '&actions=' + dialog.getModalBody().find('#actions_id').val();
                            eParams += '&methode=' + dialog.getModalBody().find('#methode_id').val();
                            eParams += '&url=' + dialog.getModalBody().find('#url_id').val();
                            console.log(dialog.getModalBody().find('#ordre_id').val());
                                $.post(o.addMenuUrl, eParams, function (serverResponse) {
//                                    console.log(serverResponse);
                                	serverResponse = $.parseJSON(serverResponse);
									if (serverResponse.rc === 0) {
                                	new PNotify({type: 'success', title: 'Univers Edu', text: serverResponse.message});
									dialog.close();
									dialog.getModalBody().off();
									dialog.getModalBody().empty();
									}
									else
										new PNotify({type: 'error', title: 'Univers Edu', text: serverResponse.error});
                                }).fail(function () {
                                	new PNotify({type: 'error', title: 'Univers Edu', text: 'Une erreur est survenue lors du traitement de votre requête.'});
                                });
//                                ;
//                            } else
//                                notification.alert('Certains champs sont vides.', 'color danger', 'top-right');
                        }
                    },
                    {
                        id: 'btn-cancel',
                        cssClass: 'btn-danger',
                        label: 'Annuler',
                        action: function (dialog) {
                            dialog.close();
                        }
                    }]
            });
            dg.show();
        };
        
        //Fin LoadForm 
        function LoadGenerate(self, userId, onGenered, onError) {
            var eParams = '';
            eParams += 'userId=' + userId;
       	 $.post(o.generateMenuUrl, eParams, function (serverResponse) {
              console.log(serverResponse);
          	serverResponse = $.parseJSON(serverResponse);
				if (serverResponse.rc === 0) {
          	new PNotify({type: 'success', title: 'Univers Edu', text: serverResponse.message});
				}
				else
					new PNotify({type: 'error', title: 'Univers Edu', text: serverResponse.error});
          })
          .fail(function () {
				new PNotify({type: 'error', title: 'Univers Edu', text: "Une erreur est survenue lors du traitement de votre requête"});
          });
       } ;
        //Debut loadForm
    	
        function onError() {
        	new PNotify({type: 'error', title: 'Univers Edu', text: serverResponse.error});
        }

   return construct(options);
    };
}(jQuery));