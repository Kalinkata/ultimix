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
*	Function shows/hides any element on the page.
*
*	@param ElementId - Element's id.
*
*	@param Speed - Animation speed.
*
*	@author Dodonov A.A.
*/
ultimix.ToggleElement = function( ElementId , Speed )
{
	jQuery( '#' + ElementId ).toggle( Speed );
}