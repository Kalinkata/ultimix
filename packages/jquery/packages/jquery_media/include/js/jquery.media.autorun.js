jQuery(
	function()
	{
		jQuery.fn.media.defaults.params[ 'allowfullscreen' ] = 'true';
		jQuery( '.media' ).each(
			function( i , Object )
			{
				var			Autoplay = jQuery( Object ).attr( 'rel' ) == '1';
				var			FlashVars = { autostart : Autoplay };
				jQuery( Object ).media(
					{
						flashvars: FlashVars , 
						autoplay : Autoplay , 
						width : jQuery( Object ).attr( 'width' ) , 
						height : jQuery( Object ).attr( 'height' ) , 
						mp3Player : './packages/jquery/packages/jquery_media/include/swf/mediaplayer.swf' , 
						flvPlayer : './packages/jquery/packages/jquery_media/include/swf/mediaplayer.swf'
					}
				);
			}
		);
	}
);
