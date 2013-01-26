/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.dialog )
{
	ultimix.dialog = {};
}

/**
*	This method inits opener for the dialog.
*
*	@param Item - Opener.
*
*	@param OpenDialogFunction - Opening method.
*
*	@author Dodonov A.A.
*/
ultimix.dialog.init_click_handlers = function( Item , OpenDialogFunction )
{
	jQuery( Item ).unbind( 'click' );
	jQuery( Item ).click( OpenDialogFunction );

	if( jQuery( Item ).attr( 'tagName' ) == 'A' )
	{
		jQuery( Item ).attr( 'href' , '#' );
	}

	if( jQuery( Item ).attr( 'tagName' ) == 'INPUT' || jQuery( Item ).attr( 'tagName' ) == 'TEXTAREA' )
	{
		jQuery( Item ).unbind( 'focus' );
		jQuery( Item ).focus( OpenDialogFunction );
	}
}

/**
*	This method inits opener for the dialog.
*
*	@param Opener - Opener's selector.
*
*	@param Selector - Selector of the dialog.
*
*	@param DataAcceptor - Data acceptor field's selector.
*
*	@param StatusAcceptor - Status acceptor field's selector.
*
*	@param DataSource - Data source selector.
*
*	@param Validation - Before open validation method.
*
*	@author Dodonov A.A.
*/
ultimix.dialog.add_opener = function( Opener , Selector , DataAcceptor , StatusAcceptor , DataSource , Validation )
{
	if( Opener )
	{
		if( jQuery( Opener ).length )
		{
			var			Items = jQuery( Opener );

			for( var i = 0 ; i < Items.length ; i++ )
			{
				var			OpenDialogFunction = function()
				{
					ultimix.dialog.open_dialog( 
						Selector , DataAcceptor , StatusAcceptor , DataSource , Validation
					);
				}
				ultimix.dialog.init_click_handlers( Items[ i ] , OpenDialogFunction );
			}
		}
	}
}

/**
*	This method opens dialog.
*
*	@param Selector - Selector of the dialog.
*
*	@param DataAcceptor - Data acceptor field's selector.
*
*	@param StatusAcceptor - Status acceptor field's selector.
*
*	@param DataSource - Data source selector.
*
*	@param BeforeOpenValidation - Before open validation method.
*
*	@author Dodonov A.A.
*/
ultimix.dialog.open_dialog = function( Selector , DataAcceptor , StatusAcceptor , DataSource , BeforeOpenValidation )
{
	jQuery( Selector ).attr( 'data_acceptor' , DataAcceptor );
	jQuery( Selector ).attr( 'status_acceptor' , StatusAcceptor );
	jQuery( Selector ).attr( 'data_source' , DataSource );
	jQuery( Selector ).children( 'form' ).removeClass( 'form_330' );

	if( BeforeOpenValidation && BeforeOpenValidation() == false )
	{
		return;
	}

	scroll( 0 , 0 );
	jQuery( Selector ).dialog( 'open' );
	jQuery( Selector ).dialog( { position: [ 'center' , 'center' ] } );
}

/**
*	This shows DOM element in the dialog.
*
*	@param Selector - Selector of the dialog.
*
*	@param Title - Dialog's title.
*
*	@author Dodonov A.A.
*/
ultimix.dialog.show_dom_in_dialog = function( Selector , Title )
{
	jQuery( Selector ).dialog(
		{
			'title' : Title , 
			'width' : 'auto' , 
			'maxWidth' : '960' , 
			'height' : '500' , 
			'modal' : true , 
			'buttons' : [
				{
					text: "OK",
					click: function()
					{
						jQuery( this ).dialog( 'close' );
					}
				}
			]
		}
	);
}

/**
*	Function processes create form.
*
*	@param DataAcceptor - Data acceptor field's selector.
*
*	@param StatusAcceptor - Status acceptor field's selector.
*
*	@param DataSource - Data source selector.
*
*	@param Selector - Selector of the dialog.
*
*	@return true/false
*
*	@author Dodonov A.A.
*/
ultimix.dialog.create_form = function( DataAcceptor , StatusAcceptor , DataSource , Selector )
{
	return( true );
}

/**
*	Function creates record creation handlers.
*
*	@param Selector - Dialog selector.
*
*	@param TabId - Id of the tab.
*
*	@param ProgressDialogId - Process dialog id.
*
*	@author Dodonov A.A.
*/
ultimix.dialog.create_dialog_function = function( Selector , TabId , ProgressDialogId )
{
	return(
		{
			'success' : function()
			{
				ultimix.std_dialogs.close_message_box( ProgressDialogId );
				jQuery( Selector ).remove();
				ultimix.windows.regenerate_tab( '#' + TabId );
			} , 
			'controller_error' : function()
			{
				ultimix.std_dialogs.close_message_box( ProgressDialogId );
			} , 
			'controller_error_restore' : function()
			{
				jQuery( Selector ).dialog( 'open' );
			}
		}
	);
}

/**
*	Function creates record creation controller handler.
*
*	@param RecordCreator - Record creating function.
*
*	@param TabId - Id of the tab.
*
*	@author Dodonov A.A.
*/
ultimix.dialog.create = function( RecordCreator , TabId )
{
	return(
		function( DataAcceptor , StatusAcceptor , DataSource , Selector )
		{
			jQuery( Selector ).dialog( 'close' );

			var			Data = ultimix.forms.extract_form_data( DataSource );
			var			ProgressDialogId = ultimix.std_dialogs.SimpleWaitingMessageBox();

			RecordCreator( 
				Data , ultimix.dialog.create_dialog_function( Selector , TabId , ProgressDialogId )
			);

			return( false );
		}
	);
}
