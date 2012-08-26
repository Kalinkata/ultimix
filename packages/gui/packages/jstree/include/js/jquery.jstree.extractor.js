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
if( !ultimix.jstree )
{
	ultimix.jstree = {};
}

/**
*	Function saves the selected value.
*
*	@param AcceptorSelector - Selector of the destination data field.
*
*	@param StatusSelector - Selector of the destination status field.
*
*	@return true if the data was saved, otherwise false.
*
*	@author Dodonov A.A.
*/
ultimix.jstree.ExtractJSTreeNode = function( AcceptorSelector , StatusSelector )
{
	var 	Tree = jQuery.jstree._focused();
	var		Node = Tree.get_selected();

	if( Node.length )
	{
		var	id = jQuery( Node ).attr( 'id' );
		id = id.replace( 'phtml_' , '' );
		
		jQuery( AcceptorSelector ).attr( 'value' , id );
		jQuery( StatusSelector ).attr( 'value' , Tree.get_text( Node ) );

		return( true );
	}
	else
	{
		ultimix.std_dialogs.MessageBox( 
			ultimix.get_string( 'nothing_was_selected' ) , ultimix.get_string( 'Error' ) , 
			ultimix.std_dialogs.MB_OK | ultimix.std_dialogs.MB_ICONERROR
		);
	}
	return( false );
}
