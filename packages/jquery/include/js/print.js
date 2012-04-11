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
if( !ultimix.print )
{
	ultimix.print = {};
}

/**
*	Function prints page.
*
*	@author Dodonov A.A.
*/
ultimix.print.PrintPage = function()
{
	window.print();
}

jQuery(
	function()
	{
		if( jQuery( '.auto_print' ).length > 0 )
		{
			ultimix.print.PrintPage();
		}
	}
);