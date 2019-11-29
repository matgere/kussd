; (function ($) {	
	bsDialog = function (options) {
		var o = {  
			header: true,
			title: '',
			size:'',
			class:'',
			draggable: true,
			message: null,
			buttons: []
		};
		var root = this;
		
		// constructor
		var construct = function (options) {
			$.extend(o, options);
			
			//init the dialog elements
			if(!o.header) dialog.find('.modal-header').remove();
			else dialog.find('.modal-title').html(o.title);
			$.each(o.buttons, function (index, button) {	
				var $button = $('<button class="btn"></button>');	
				$button.prop('id', button.id);	
				$button.html(button.label);
				$button.addClass(button.cssClass);					
				dialog.find('.modal-footer').append($button);
				root.indexedButtons[button.id] = $button;
				
				$button.toggleEnable = function (enable) {
					var $this = this;
					if (typeof enable !== 'undefined') {
						$this.prop("disabled", !enable).toggleClass('disabled', !enable);
					} else {
						$this.prop("disabled", !$this.prop("disabled"));
					}
					return $this;
				};
						
				$button.enable = function () {
					var $this = this;
					$this.toggleEnable(true);
					return $this;
				};
				$button.disable = function () {
					var $this = this;
					$this.toggleEnable(false);
					return $this;
				};
				$button.hide = function (bhide) {
					var $this = this;
					bhide ? $this.addClass('hidden') : $this.removeClass('hidden');
					return $this;
				};
				$button.on('click', function(e){button.action.call(this, root);});
				
				//dialog.find('.modal-footer').append('<button id="'+button.id+'" class="btn" type="button" ><i class="icon mdi mdi-spinner mdi-spin"></i> '+button.label+'</button>');					
			});
			if($.isFunction(options.message)) {
				//dialog.find('.modal-body').html(options.message.call(this, root));
			}
			$(dialog).modal({
				backdrop: 'static',
				keyboard: false
			});
			 
		};
		this.indexedButtons = {};
		this.show = function () {				
			$(dialog).modal('show');
		};
		this.close = function () {				
			$(dialog).modal('hide');
		};
		this.getButton = function (id) {
			if (typeof this.indexedButtons[id] !== 'undefined') {
				return this.indexedButtons[id];
			}
			return null;
		};
		this.getModal = function () {			
			return dialog.find('.modal-dialog');
		};
		this.getModalBody = function () {			
			return dialog.find('.modal-body');
		};
		var dialog = $('<div class="modal fade colored-header colored-header-primary" id="md-colored" tabindex="-1" role="dialog">\
						  <div class="modal-dialog">\
							<div class="modal-content">\
							  <div class="modal-header modal-header-colored bDialog-header">\
								<h3 class="modal-title">bla bla</h3>\
								<button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="mdi mdi-close"></span></button>\
							  </div>\
							  <div class="modal-body" style="padding:5px;">\
							  <div class="form-group row">\
			  <label class="col-12 col-sm-3 col-form-label text-sm-right">Success</label>\
			  <div class="col-12 col-sm-8 col-lg-6 pt-1">\
				<div class="switch-button switch-button-success">\
				  <input type="checkbox" checked="" name="swtd45" id="swtd45"><span>\
					<label for="swtd45"></label></span>\
				</div>\
			  </div>\
			</div></div>\
							  <div class="modal-footer bDialog-footer" style="padding: 15px 20px;"></div>\
							</div>\
						  </div>\
						</div>');
		
		return construct(options);
	};
}(jQuery));