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
