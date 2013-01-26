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
ultimix.button_markup.toggle_button = function( Obj , Icon , IconToggle , ToggleFunction )
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

/**
*	Function runs controller and removes dom.
*
*	@param id - id of the processing record.
*
*	@param APIMethod - API method wich will process record.
*
*	@param DomSelector - Selector of the DOM element.
*
*	@author Dodonov A.A.
*/
ultimix.button_markup.run_controller_and_remove_dom = function( id , APIMethod , DomSelector )
{
	ultimix.std_dialogs.QuestionMessageBox( 
		'are_you_shure' , 
		function()
		{
			APIMethod( Id , DomSelector );
		}
	);
}
