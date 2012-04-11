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
if( !ultimix.button_markup )
{
	ultimix.button_markup = {};
}

/**
*	Function toggle button.
*
*	@param Obj - Button.
*
*	@param Icon - First icon.
*
*	@param IconToggle - Second icon.
*
*	@param ToggleFunction - Toggle value function.
*
*	@author Dodonov A.A.
*/
ultimix.button_markup.ToggleButton = function( Obj , Icon , IconToggle , ToggleFunction )
{
	var			Src = jQuery( Obj ).children( 'img' ).attr( 'src' );
	var			Value = 0;

	if( Src.indexOf( Icon ) != -1 )
	{
		Src = Src.replace( Icon , IconToggle );
		Value = 0;
	}
	else
	{
		Src = Src.replace( IconToggle , Icon );
		Value = 1;
	}

	jQuery( Obj ).children( 'img' ).attr( 'src' , Src );
	ToggleFunction( Value );
}
