/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.select_extractor )
{
	ultimix.select_extractor = {};
}

/**
*	Function saves the data to the exact element.
*
* 	@param Items - Elements wich accept data.
*
* 	@param Value - Data to be saved.
*
* 	@return true if the data was saved, false otherwise.
*
* 	@author Dodonov A.A.
*/
ultimix.select_extractor.SetData = function( Items , Value )
{
	for( var i = 0 ; i < Items.length ; i++ )
	{
		if( jQuery( Items[ i ] ).prop( 'tagName' ) == 'INPUT' || 
			jQuery( Items[ i ] ).prop( 'tagName' ) == 'TEXTAREA' )
		{
			jQuery( Items[ i ] ).val( Value );
			continue;
		}
		if( jQuery( Items[ i ] ).prop( 'tagName' ) == 'SPAN' || 
			jQuery( Items[ i ] ).prop( 'tagName' ) == 'DIV' || 
			jQuery( Items[ i ] ).prop( 'tagName' ) == 'A' )
		{
			jQuery( Items[ i ] ).html( Value );
			continue;
		}
	}
}

/**
*	Function saves the selected value.
*
* 	@param AcceptorSelector - Selector of the field for the selected data.
*
* 	@param StatusSelector - Selector of the field woch will display the selected data.
*
* 	@return true if the data was saved, false otherwise.
*
* 	@author Dodonov A.A.
*/
ultimix.select_extractor.ExtractSimpleSelectResult = function( AcceptorSelector , StatusSelector , DataSource )
{
	var	Radios = jQuery( 'input[name=' + DataSource + ']:radio' );

	for( var i = 0 ; i < Radios.length ; i++ )
	{
		if( jQuery( Radios[ i ] ).attr( 'checked' ) )
		{
			var	Items = jQuery( AcceptorSelector );
			ultimix.SetData( Items , jQuery( Radios[ i ] ).attr( 'value' ) );

			Status = jQuery( '[for=' + jQuery( Radios[ i ] ).attr( 'id' ) + ']' ).html();
			Items = jQuery( StatusSelector );
			ultimix.SetData( Items , Status );
			
			return( true );
		}
	}
	
	return( false );
}
