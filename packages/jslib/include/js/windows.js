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
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.windows )
{
	ultimix.windows = {};
}

/**
*	Function shows popup window.
*
*	@param URL - URL of the opening page.
*
*	@param Width - Width of the opening page.
*
*	@param Height - Height of the opening page.
*
*	@author Dodonov A.A.
*/
ultimix.PopupHref = function( URL , Width , Height )
{
	window.open( URL , "" , "width=" + Width + ", height=" + Height );
}

/**
*	Function reloads page.
*
*	@author Dodonov A.A.
*/
ultimix.ReloadPage = function()
{
	window.location.reload( true );
}

/**
*	Function fits DOM Element to it's parent.
*
*	@param Element - Dom Element.
*
*	@author Dodonov A.A.
*/
ultimix.windows.auto_fit_div = function( Element )
{
	var			OtherElements = jQuery( Element ).prevAll();
	var			TotalHeight = jQuery( Element ).parent().innerHeight();
	var			FreeHeight = TotalHeight;

	for( var i = 0 ; i < OtherElements.length ; i++ )
	{
		if( jQuery( OtherElements[ i ] ).is( ':visible' ) )
		{
			FreeHeight -= jQuery( OtherElements[ i ] ).outerHeight( true );
		}
	}

	jQuery( Element ).height( 0 );
	var			dHeight = jQuery( Element ).outerHeight() + 2;
	if( FreeHeight - dHeight > 0 )
	{
		jQuery( Element ).height( FreeHeight - dHeight );
	}
}

/**
*	Function reloads page with this parameters.
*
*	@param PageParameters - Page generation parameters.
*
*	@author Dodonov A.A.
*/
ultimix.windows.regenerate_page = function( PageParameters )
{
	ultimix.data_form.submit_data( PageParameters , false , 'index.php' );
}

/**
*	Function regenerates view with this parameters.
*
*	@param PageParameters - Page generation parameters.
*
*	@param DOMSelector - Selector of the element to be replaced with the generated view.
*
*	@author Dodonov A.A.
*/
ultimix.windows.regenerate_view = function( PageParameters , DOMSelector )
{
	var			DialogId = ultimix.std_dialogs.SimpleWaitingMessageBox();

	ultimix.ajax_gate.direct_view( 
		PageParameters , 
		{
			'success' : function( Result )
			{
				jQuery( DOMSelector ).replaceWith( Result );
				ultimix.std_dialogs.close_message_box( DialogId );
			}
		}
	);
}

/**
*	Function regenerates tab with this parameters.
*
*	@param DOMSelector - Selector of the element to be replaced with the generated view.
*
*	@author Dodonov A.A.
*/
ultimix.windows.regenerate_tab = function( DOMSelector )
{
	eval( 'var			PageParameters = ' + jQuery( DOMSelector ).find( '.page_parameters' ).html() );

	jQuery( DOMSelector ).html( ultimix.std_dialogs.loading_img_widget() );

	ultimix.ajax_gate.direct_view( 
		PageParameters , 
		{
			'success' : function( Result )
			{
				var			TabId = jQuery( DOMSelector ).attr( 'id' );
				Result = ultimix.string_utilities.str_replace( '[tab_id]' , TabId , Result );
				jQuery( DOMSelector ).html( Result );
			}
		}
	);
}
