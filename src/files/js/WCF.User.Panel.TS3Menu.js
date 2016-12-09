/**
 * User Panel implementation for todolist dropdown.
 * 
 * @see	WCF.User.Panel.Abstract
 */
WCF.User.Panel.TS3Menu = WCF.User.Panel.Abstract.extend({
	
   /**
	 * @see	WCF.User.Panel.Abstract.init()
	 */
	init: function(options) {
		options = $.extend({}, options, {
			enableMarkAsRead : false,
			pointerOffset : '5px',
			staticDropdown: true
		});
	
		this._super($('#TS3Menu'), 'TS3Menu', options);
		
		this._proxy = new WCF.Action.Proxy({
			showLoadingOverlay: false,
			success: $.proxy(this._success, this),
			failure: $.proxy(this._failure, this)
		});
		
		this._updateDataFromServer();

		// register for updates
		WCF.System.Event.addListener('com.woltlab.wcf.conversation.userPanel', 'reset', (function() {
			this._updateDataFromServer();
		}).bind(this));
	},
	
	
	_updateDataFromServer : function(){
		this._proxy.setOption('data', {
			actionName: 'getTsDataList',
			className: 'wcf\\data\\TS3Menu\\TS3MenuAction'
		});
		this._proxy.sendRequest();
	},
	
	_failure: function(data) {	
		// what should we do now?
		$('#TS3Menu .interactiveDropdownTS3Menu > div').remove();
		return false;
	},
	
	/**
	 * Handles successful AJAX requests.
	 * 
	 * @param	object		data
	 */
	_success: function(data) {		
		$('#TS3Menu .interactiveDropdownTS3Menu').prepend(data.returnValues.template);
		
		// update or create the badge
		var $badge = this._triggerElement.find('span.badge');
		if (!$badge.length || $badge.length === 0) {
			$badge = $('<span class="badge badgeInverse" />').appendTo($('#TS3Menu .togglelink'));
			$badge.before(' ');
		}
		
		$badge.text(data.returnValues.totalCount);
	}
});
