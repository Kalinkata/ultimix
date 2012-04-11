<script>
	jQuery(
		function()
		{
			var	ButtonSet = new Object();
			
			if( {cancel} || '{cancel_processor}' != '' )
			{
				var	ButtonCaption = ultimix.get_string( 'Cancel' );
				ButtonSet[ ButtonCaption ] = function()
				{
					if( '{cancel_processor}' != '' )
					{
						// extracting data
						var	DataAcceptor = jQuery( "{selector}" ).attr( 'data_acceptor' );
						var	StatusAcceptor = jQuery( "{selector}" ).attr( 'status_acceptor' );
						var	DataSource = jQuery( "{selector}" ).attr( 'data_source' );
						
						if( {cancel_processor}( DataAcceptor , StatusAcceptor , DataSource ) )
						{
							jQuery( "{selector}" ).dialog( 'close' );
						}
						return;
					}
					if( {cancel} )
					{
						jQuery( "{selector}" ).dialog( 'close' );
					}
				};
			}
			
			if( '{ok_processor}' != '' )
			{
				var	ButtonCaption = ultimix.get_string( 'OK' );
				ButtonSet[ ultimix.get_string( ButtonCaption ) ] = function()
				{
					// extracting data
					var	DataAcceptor = jQuery( "{selector}" ).attr( 'data_acceptor' );
					var	StatusAcceptor = jQuery( "{selector}" ).attr( 'status_acceptor' );
					var	DataSource = jQuery( "{selector}" ).attr( 'data_source' );
					
					if( {ok_processor}( DataAcceptor , StatusAcceptor , DataSource , "{selector}" ) )
					{
						jQuery( "{selector}" ).dialog( 'close' );
					}
				};
			}
			
			// creating the dialog
			jQuery( "{selector}" ).dialog(
				{
					title : "{lang:{title}}" , 
					width : {width} , 
					height : {height} , 
					modal : {modal} , 
					autoOpen : {auto_open} , 
					resizable : {resizable} , 
					buttons : ButtonSet , 
					closeOnEscape : {close_on_escape}
				}
			);
			
			if( "{on_open}" != 'nop()' )
			{
				jQuery( "{selector}" ).unbind( "dialogopen.ultimix" );
				jQuery( "{selector}" ).bind(
					"dialogopen.ultimix" ,
					function( event , ui )
					{
						{on_open};
					}
				);
			}
			
			if( {hide_close_button} )
			{
				jQuery( "{selector}" ).parent().find( '.ui-dialog-titlebar-close' ).remove();
			}
		}
	);
</script>