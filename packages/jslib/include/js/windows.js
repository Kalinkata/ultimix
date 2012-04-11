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
