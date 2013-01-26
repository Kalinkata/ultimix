jQuery(
	function()
	{
		jQuery( 'body' ).layout(
			{
				enableCursorHotkey			: false , 
				sliderTip					: ultimix.get_string( 'slide_panel' ) , 
				togglerTip_open				: ultimix.get_string( 'close_panel' ) , 
				togglerTip_closed			: ultimix.get_string( 'open_panel' ) , 
				resizerTip					: ultimix.get_string( 'resize_panel' ) , 
				west__slideTrigger_open		: 'mouseover' , 
				east__slideTrigger_open		: 'mouseover' , 
				north__slideTrigger_open	: 'mouseover' , 
				south__slideTrigger_open	: 'mouseover'
			}
		);
	}
);
