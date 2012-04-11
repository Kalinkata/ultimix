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
if( !ultimix.inplace )
{
	ultimix.inplace = {};
}

/**
*	Function replaces DOM element with textarea.
*
*	@param Event - Event object.
*
*	@author Dodonov A.A.
*/
ultimix.inplace.ReplaceWithTextarea = function( Event )
{
	var			Width = jQuery( Event.target ).outerWidth();
	var			Height = jQuery( Event.target ).outerHeight();
	var			Name = jQuery( Event.target ).attr( 'field_name' );
	var			Class = jQuery( Event.target ).attr( 'field_class' );
	var			Value = jQuery( Event.target ).html();

	jQuery( Event.target ).hide();
	jQuery( Event.target ).after( 
		'<textarea style="margin: 0px; width: ' + ( Width - 5 ) + 'px; height: ' + ( Height - 3 ) + 
		'px" class="' + Class + '" name="' + Name + '">' + Value + '</textarea>'
	);
	jQuery( Event.target ).next().focus();
}

/**
*	Function replaces DOM element with input.
*
*	@param Event - Event object.
*
*	@author Dodonov A.A.
*/
ultimix.inplace.ReplaceWithInput = function( Event )
{
	var			Width = jQuery( Event.target ).outerWidth();
	var			Name = jQuery( Event.target ).attr( 'field_name' );
	var			Class = jQuery( Event.target ).attr( 'field_class' );
	var			Value = jQuery( Event.target ).html();

	jQuery( Event.target ).hide();
	jQuery( Event.target ).after( 
		'<input style="margin: 0px; width: ' + ( Width - 5 ) + 'px;' + 
		'" class="' + Class + '" name="' + Name + '" value="' + Value + '">'
	);
	jQuery( Event.target ).next().focus();
}

/**
*	Automatic setting event handlers.
*
*	@author Dodonov A.A.
*/
jQuery(
	function()
	{
		jQuery( '.inplace_textarea' ).each(
			function( i , Element )
			{
				jQuery( Element ).dblclick( ultimix.inplace.ReplaceWithTextarea );
			}
		);
		jQuery( '.inplace_input' ).each(
			function( i , Element )
			{
				jQuery( Element ).dblclick( ultimix.inplace.ReplaceWithInput );
			}
		);
	}
);