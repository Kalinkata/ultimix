/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

ultimix.SetWaitingMessage = function( Selector )
{
	jQuery( Selector ).html( '<div class="grid_waiting_message">' + ultimix.lang( 'grid_waiting_message' ) + '</div>' );
}

/**
*	Function reloads grid.
*
*	@param Selector - Selector of the grid.
*
*	@param Ajaxed - Should content be reloaded by ajax request.
*
*	@param Url - URL of the data source.
*
*	@author Dodonov A.A.
*/
ultimix.ReloadGrid = function( Selector , Ajaxed , Url )
{
	if( Ajaxed )
	{
		Data = ultimix.ExtractFormData( Selector + ' [name=order] , ' + Selector + 
			' [name=reorder_field] , ' + Selector + ' [name=page]' );
		Options = { 'async' : false , 'replace' : true };

		ultimix.SetWaitingMessage( Selector );
		
		ultimix.DirectViewComposer( Selector , Data , Url , Options );
	}
	else
	{
		/* redo using data_form */
		jQuery( Selector ).submit();
	}
	
	return( false );
}

/**
*	Function changes sorting order in the grid.
*
*	@param Selector - Selector of the grid.
*
*	@param Ajaxed - If 'true' then data will be retrieved using ajax request.
*
*	@param Url - URL of the data source.
*
*	@param FieldName - Field to order.
*
*	@author Dodonov A.A.
*/
ultimix.Reorder = function( Selector , Ajaxed , Url , FieldName )
{
	if( jQuery( Selector + ' [name=order]' ).val() == 'ascending' )
	{
		jQuery( Selector + ' [name=order]' ).val( 'descending' );
	}
	else
	{
		jQuery( Selector + ' [name=order]' ).val( 'ascending' );
	}
	
	jQuery( Selector + ' [name=reorder_field]' ).val( FieldName );
	
	ultimix.ReloadGrid( Selector , Ajaxed , Url );
}

/**
*	Function resets records per page value.
*
*	@param Page - page url.
*
*	@param FormId - Form's id.
*
*	@param FieldName - Field to order.
*
*	@author Dodonov A.A.
*/
ultimix.GetGrid = function( Page , FormId , FieldName )
{
	Data = {};

	if( jQuery( '#' + FormId ).find( '#order' ).val() == 'ascending' )
	{
		Data.order = 'ascending';
	}
	else
	{
		Data.order = 'descending';
	}

	Data.reorder_field = FieldName;
	Data.page = Page;
	Data.paging_require_form = 0;

	ultimix.DirectViewComposer( '#' + FormId , Data , Page , { 'async' : false } );
}

/**
*	Function resets records per page value.
*
*	@param Prefix - Objects prefix.
*
*	@param Page - page url.
*
*	@param FormId - Form's id.
*
*	@param FieldName - Field to order.
*
*	@param Ajaxed - Should content be reloaded by ajax request.
*
*	@author Dodonov A.A.
*/
ultimix.ReSetRecordsPerPage = function( Prefix , Page , FormId , FieldName , Ajaxed )
{
	RecordsPerPage = jQuery( '#' + FormId ).find( '#' + Prefix + "_records_per_page" ).val();
	jQuery.cookie( Prefix + '_records_per_page' , RecordsPerPage );
		
	if( Ajaxed )
	{
		ultimix.GetGrid( Page , FormId , FieldName );
	}
	else
	{
		if( Page )
		{
			ultimix.data_form.submit_data( {} , false , Page );
		}
		else
		{
			ultimix.data_form.submit_data( {} , false , location.href );
		}
	}
}
