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
if( !ultimix.double_panel )
{
	ultimix.double_panel = {};
}

/**
*	Function adds element to the second panel.
*/
function	FirstToSecond( FirstPanel , SecondPanel , EntityName )
{
	if( EntityName != '' )
	{
		document.getElementById( FirstPanel ).removeChild( document.getElementById( EntityName + '_hidden_id' ) );
		document.getElementById( FirstPanel ).removeChild( document.getElementById( EntityName + '_div_id_first' ) );
		document.getElementById( SecondPanel ).innerHTML += "<div onclick=\"javascript:SecondToFirst( '" + FirstPanel + 
			"' , '" + SecondPanel + "' , '" + EntityName + "' );\" class='double_panel_row no_selection_text' id='" + 
			EntityName + "_div_id_second'>" + EntityName + "</div>";
		
		jQuery( '.no_selection_text' ).disableTextSelect();
	}
}

/**
*	Function adds element to the second panel.
*/
function	SecondToFirst( FirstPanel , SecondPanel , EntityName )
{
	if( EntityName != '' )
	{
		document.getElementById( FirstPanel ).innerHTML += "<input type='hidden' name='entities[]' id='" + 
			EntityName + "_hidden_id' value='" + EntityName + "'>";
		document.getElementById( SecondPanel ).removeChild( document.getElementById( EntityName + '_div_id_second' ) );
		document.getElementById( FirstPanel ).innerHTML += "<div onclick=\"javascript:FirstToSecond( '" + FirstPanel + 
			"' , '" + SecondPanel + "' , '" + EntityName + "' );\" class='double_panel_row no_selection_text' id='" + 
			EntityName + "_div_id_first'>" + EntityName + "</div>";
		
		jQuery( '.no_selection_text' ).disableTextSelect();
	}
}

/**
*	Function initializes panel.
*/
ultimix.double_panel.init_first_panel = function( FirstPanel , SecondPanel , FirstPanelEntities )
{
	if( FirstPanelEntities != '' )
	{
		FirstPanelEntities = FirstPanelEntities.split( ',' );

		for( i = 0 ; i < FirstPanelEntities.length ; i++ )
		{
			document.getElementById( FirstPanel ).innerHTML += "<div onclick=\"javascript:FirstToSecond( '" + 
				FirstPanel + "' , '" + SecondPanel + "' , '" + FirstPanelEntities[ i ] + 
				"' );\" class='double_panel_row no_selection_text' id='" + FirstPanelEntities[ i ] + 
				"_div_id_first'>" + FirstPanelEntities[ i ] + "</div>";
			document.getElementById( FirstPanel ).innerHTML += "<input type='hidden' name='entities[]' id='" + 
				FirstPanelEntities[ i ] + "_hidden_id' value='" + FirstPanelEntities[ i ] + "'>";
		}
	}
	else
	{
		FirstPanelEntities = new Array;
	}

	return( FirstPanelEntities );
}

/**
*	Function initializes panel.
*/
ultimix.double_panel.init_second_panel = function( FirstPanel , SecondPanel , FirstPanelEntities , SecondPanelEntities )
{
	if( SecondPanelEntities != '' )
	{
		SecondPanelEntities = SecondPanelEntities.split( ',' );

		for( i = 0 ; i < SecondPanelEntities.length ; i++ )
		{
			if( in_array( SecondPanelEntities[ i ] , FirstPanelEntities ) == false )
			{
				document.getElementById( SecondPanel ).innerHTML += "<div onclick=\"javascript:SecondToFirst( '" + 
					FirstPanel + "' , '" + SecondPanel + "' , '" + SecondPanelEntities[ i ] + 
					"' );\" class='double_panel_row no_selection_text' id='" + SecondPanelEntities[ i ] + 
					"_div_id_second'>" + SecondPanelEntities[ i ] + "</div>";
			}
		}
	}
}

/**
*	Function initializes panel.
*/
function			InitPanels( FirstPanel , SecondPanel , FirstPanelEntities , SecondPanelEntities )
{
	FirstPanelEntities = ultimix.double_panel.init_first_panel( FirstPanel , SecondPanel , FirstPanelEntities );

	ultimix.double_panel.init_second_panel( FirstPanel , SecondPanel , FirstPanelEntities , SecondPanelEntities );

	jQuery( function()
		{
			jQuery( '.no_selection_text' ).disableTextSelect();
		}
	);
}
