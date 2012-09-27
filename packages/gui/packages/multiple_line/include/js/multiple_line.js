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
*	Another local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.multiple_line )
{
	ultimix.multiple_line = {};
}

/**
* 	Function creates multyple line control.
*
* 	@param Object - DOM element of the template.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.CreateMultypleLineControl = function( Object )
{
	jQuery( Object ).wrap( '<div></div>' );
	jQuery( Object ).css( 'display' , 'none' );
}

/**
* 	Function creates control's line.
*
* 	@param Control - DOM element of the control.
*
* 	@param Object - DOM element of the line.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.GetElementCode = function( Control , Object )
{
	var		Template = Control.html();
	
	if( Object )
	{
		eval( 'var Data = ' + jQuery( Object ).html() );
		Template = ultimix.string_utilities.print_record( Template , Data );
	}
	
	return( Template );
}

/**
* 	Function revises delete buttons for some special cases.
*
* 	@param Selector - Selector of the control.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.ReviseDeleteButtons = function( Selector )
{
	var		Container = jQuery( Selector ).parent();

	var		Lines = jQuery( Container ).find( 'table.multiple_line_single_line' );
	
	if( Lines.length == 1 )
	{
		Lines.find( 'span.multiple_line_delete_button' ).html( '&nbsp;' );
	}
	else
	{
		Lines.find( 'span.multiple_line_delete_button' ).html( ultimix.multiple_line.CreateDelButton( Selector ) );
	}
}

/**
* 	Function adds a new line to the grid.
*
*	@param Button - Add button wich was clicked.
*
* 	@param Selector - Selector of the control.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.OnAddElement = function( Button , Selector )
{
	ultimix.multiple_line.AddLineForSelector( 
		Selector , false , jQuery( Button ).parents( 'table.multiple_line_single_line' )
	);
	
	ultimix.multiple_line.ReviseDeleteButtons( Selector );
}

/**
* 	Function adds a new line to the grid.
*
*	@param Button - Add button wich was clicked.
*
* 	@param Selector - Selector of the control.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.OnDelElement = function( Button , Selector )
{
	jQuery( Button ).parents( 'table.multiple_line_single_line' ).remove();
	
	var		Control = jQuery( Selector );
	
	/* calling event handler */
	if( jQuery( Control ).attr( 'ondeleteline' ) )
	{
		eval( jQuery( Control ).attr( 'ondeleteline' ) );
	}
	
	ultimix.multiple_line.ReviseDeleteButtons( Selector );
}

/**
* 	Function creates add button template.
*
* 	@param Selector - Selector of the control.
*
*	@return Add button template.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.GetAddButtonTemplate = function( Selector )
{
	var			CustomTemplate = jQuery( Selector ).find( '.add_button_template' ).first();
	
	if( CustomTemplate.length == 0 )
	{
		/* custom template was not found */
		return(
			"<span class=\"multiple_line_add_button\"><a class=\"pointer\" style=\"text-decoration: none; " + 
			"font-weight: bold;\" onclick=\"ultimix.multiple_line.OnAddElement( this , '" + Selector + 
			"' );\">+</a></span>"
		);
	}
	else
	{
		CustomTemplate = CustomTemplate.html();
		
		CustomTemplate = ultimix.string_utilities.StrReplace( '[selector]' , Selector , CustomTemplate );
		
		return( CustomTemplate );
	}
}

/**
* 	Function creates add button for the line.
*
* 	@param Selector - Selector of the control.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.CreateAddButton = function( Selector )
{
	return( 
		ultimix.multiple_line.GetAddButtonTemplate( Selector )
	);
}

/**
* 	Function creates delete button template.
*
* 	@param Selector - Selector of the control.
*
*	@return Delete button template.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.GetDeleteButtonTemplate = function( Selector )
{
	var			CustomTemplate = jQuery( Selector ).find( '.delete_button_template' ).first();
	
	if( CustomTemplate.length == 0 )
	{
		/* custom template was not found */
		return(
			"<span class=\"multiple_line_delete_button\"><a class=\"pointer\" style=\"text-decoration: none; " + 
			"font-weight: bold;\" onclick=\"ultimix.multiple_line.OnDelElement( this , '" + 
			Selector + "' );\">-</a></span>"
		);
	}
	else
	{
		CustomTemplate = CustomTemplate.html();
		
		CustomTemplate = ultimix.string_utilities.StrReplace( '[selector]' , Selector , CustomTemplate );
		
		return( CustomTemplate );
	}
}

/**
* 	Function creates add button for the line.
*
* 	@param Selector - Selector of the control.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.CreateDelButton = function( Selector )
{
	return( 
		ultimix.multiple_line.GetDeleteButtonTemplate( Selector )
	);
}

/**
* 	Function creates control's line.
*
* 	@param Selector - Selector of the control.
*
* 	@param Line - HTML code of the new line.
*
* 	@param AfterLine - New line will be added after this element.
*
*	@return Function returns the added line.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.AppendLine = function( Selector , Line , AfterLine )
{
	var			Container = jQuery( Selector ).parent();
	var			Code = '<table class="multiple_line_single_line"><tr><td style="width: 10px; font-family:' + 
		'Courier New;">' + ultimix.multiple_line.CreateAddButton( Selector ) + '</td><td style="width: 10px; ' + 
		'font-family: Courier New;">' + ultimix.multiple_line.CreateDelButton( Selector ) + '</td><td style="width: ' +
		'100%;">' + Line + '</td></tr></table>';
	var			AddedLine = false;
	if( AfterLine )
	{
		jQuery( AfterLine ).after( Code );
		AddedLine = jQuery( AfterLine ).next();
	}
	else
	{
		jQuery( Container ).append( Code );
		AddedLine = jQuery( Container ).find( 'table.multiple_line_single_line' ).last();
	}
	jQuery( AddedLine ).find( '.add_button_template,.delete_button_template' ).remove();
	ultimix.multiple_line.ReviseDeleteButtons( Selector );
	return( AddedLine );
}

/**
* 	Function changes DOM.
*
* 	@param Selector - Selector of the control.
*
* 	@param Object - Line's object.
*
* 	@param AfterLine - New line will be added after this element.
*
*	@return Function returns the added line.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.AddLineInDOM = function( Selector , Object , AfterLine )
{
	var			Control = jQuery( Selector );
	if( Control.length )
	{
		var			Line = ultimix.multiple_line.GetElementCode( Control , Object );
		var			AddedLine = ultimix.multiple_line.AppendLine( Selector , Line , AfterLine );
		if( Object )
		{
			jQuery( Object ).remove();
		}
		return( AddedLine );
	}
	else
	{
		if( !Object )return;
		
		jQuery( Object ).replaceWith( 
			ultimix.get_string( 'dom_element' ) + ' "' + jQuery( Object ).attr( 'control' ) + '" ' + 
			ultimix.get_string( 'was_not_found' )
		);
	}
}

/**
*	OnAddLine event handler.
*
*	@param AddedLine - Added line.
*
*	@param Data - Data.
*
*	@author Dodonov A.A.
*/
ultimix.multiple_line.OnAddLine = function( AddedLine , Data )
{
	for( FieldName in Data )
	{
		var			Element = jQuery( AddedLine ).find( '[name^=' + FieldName + ']' );
		if( Element.prop( 'tagName' ) == 'TEXTAREA' )
		{
			Element.html( Data[ FieldName ] );
		}
		else
		{
			Element.val( Data[ FieldName ] );
		}
	}
}

/**
* 	Function triggers event.
*
* 	@param Selector - Selector of the control.
*
* 	@param AddedLine - Added line.
*
* 	@param Data - Data to add.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.TriggerOnAddEvent = function( Selector , AddedLine , Data )
{
	var			Control = jQuery( Selector );
	
	/* calling event handler */
	if( jQuery( Control ).attr( 'onaddline' ) )
	{
		eval( jQuery( Control ).attr( 'onaddline' ) + '( AddedLine , Data );' );
	}
	else
	{
		eval( 'ultimix.multiple_line.OnAddLine( AddedLine , Data );' );
	}
}

/**
* 	Function adds line to the control.
*
* 	@param Selector - Selector of the control.
*
* 	@param Object - Line's object.
*
* 	@param AfterLine - New line will be added after this element.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.AddLineForSelector = function( Selector , Object , AfterLine )
{
	if( Object && jQuery( Object ).html() )
	{
		eval( 'var Data = ' + jQuery( Object ).html() );
	}
	else
	{
		eval( 'var Data = {}' );
	}
	
	var			AddedLine = ultimix.multiple_line.AddLineInDOM( Selector , Object , AfterLine );
	
	ultimix.multiple_line.TriggerOnAddEvent( Selector , AddedLine , Data );
}

/**
* 	Function adds line to the control.
*
* 	@param Object - DOM element of the line.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.AddLine = function( Object )
{
	ultimix.multiple_line.AddLineForSelector( jQuery( Object ).attr( 'control' ) , Object );
}

/**
* 	Function adds empty line to the control.
*
* 	@param Control - Multy line control.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.AddLineInEmptyControl = function( Control )
{
	if( jQuery( Control ).find( 'table.multiple_line_single_line' ).length == 0 )
	{
		ultimix.multiple_line.AddLineForSelector( jQuery( Control ).children().first().attr( 'control' ) );
	}
}

/**
* 	Auto creation of the controls.
*
* 	@author Dodonov A.A.
*/
jQuery( 
	function()
	{
		jQuery( '.multiple_line_template' ).each(
			function( Index , Object )
			{
				ultimix.multiple_line.CreateMultypleLineControl( Object );
			}
		);
		jQuery( '.multiple_line_element' ).each(
			function( Index , Object )
			{
				ultimix.multiple_line.AddLine( Object );
			}
		);
		jQuery( '.multiple_line_template' ).each(
			function( Index , Object )
			{
				ultimix.multiple_line.AddLineInEmptyControl( jQuery( Object ).parent() );
			}
		);
	}
);