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
if( !ultimix.tab_control )
{
	ultimix.tab_control = {};
	ultimix.tab_control.TabCounter = 1;
	ultimix.tab_control.AddTabFlag = 0;
	ultimix.tab_control.AddContentId = '_unexisting_id';
	ultimix.tab_control.InitialTabWasDeleted = new Array();
	ultimix.tab_control.SelectCreated = false;
	ultimix.tab_control.InsertIndex = -1;
	ultimix.tab_control.AutoSelect = false;
}

/**
*	Function sets up control after it was created.
*
*	@param ControlId - id of the tab control.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.tab_control_create_setup = function( ControlId )
{
	jQuery( '#' + ControlId ).tabs(
		{
			select : function( event , ui )
			{
				if( ultimix.tab_control.AddTabFlag == 0 )
				{
					jQuery.cookie( ControlId + '-active-tab-id' , ui.tab.hash.replace( '#' , '' ) );
					return;
				}
				ultimix.tab_control.AddTabFlag = 0;
			} , 
			show : function( event , ui )
			{
				ultimix.windows.auto_fit_div( ui.panel );
			}
		}
	);

	ultimix.tab_control.set_add_tab_handler( ControlId );
}

/**
*	Function creates tab control.
*
*	@param ControlId - id of the tab control.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.create_tab = function( ControlId )
{
	var			TabId = 'tabs' + ultimix.tab_control.TabCounter++;
	jQuery( '#' + ControlId ).html( '<ul><li><a href="#' + TabId + '"></a></li></ul><div id="' + TabId + '"></div>' );
	
	jQuery( '#' + ControlId ).tabs();
	
	ultimix.tab_control.tab_control_create_setup( ControlId );
	
	ultimix.tab_control.InitialTabWasDeleted[ ControlId ] = false;
}

/**
*	Function processes close tab event.
*
*	@param ControlId - id of the tab control.
*
*	@param Tab - Taf.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.on_close_tab = function( ControlId , Tab )
{
	var 		index = jQuery( '#' + ControlId ).children( 'ul' ).children( 'li' ).index( jQuery( Tab ).parent() );
	jQuery( '#' + ControlId ).tabs( 'remove' , index );
}

/**
*	Function adds close button to the tab.
*
*	@param ControlId - id of the tab control.
*
*	@param TabCursor - Cursor of the processing tab. If not set then last tab will be modified.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.set_closable = function( ControlId , TabCursor )
{
	if( TabCursor )
	{
		var 		Item = jQuery( '#' + ControlId + '>.ui-tabs-nav>li>a' ).eq( TabCursor );
	}
	else
	{
		var 		Item = jQuery( '#' + ControlId + '>.ui-tabs-nav>li>a' ).last();
	}

	if( jQuery( Item ).next().length )
	{
		jQuery( Item ).next().remove();
	}

	jQuery( Item ).after( 
		'<span class="ui-icon ui-icon-close" onclick="ultimix.tab_control.on_close_tab( \'' + ControlId + 
		'\' , this );" title="' + ultimix.get_string( 'close_tab' ) + '">&nbsp;</span>'
	);
}

/**
*	Function tries to activate added tab.
*
*	@param ControlId - id of the tab control.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.try_auto_select_tab = function( ControlId )
{
	if( ultimix.tab_control.AutoSelect == false )
	{
		return;
	}
	var			ActiveTabId = jQuery.cookie( ControlId + '-active-tab-id' );
	ActiveTabId = ActiveTabId ? ActiveTabId : 'tabs1';

	if( jQuery( '#' + ControlId ).find( '#' + ActiveTabId ).length )
	{
		var			Items = jQuery( '#' + ControlId + '>.ui-tabs-nav>li>a' );
		for( var i = 0 ; i < Items.length ; i++ )
		{
			if( jQuery( Items[ i ] ).attr( 'href' ) == '#' + ActiveTabId )
			{
				jQuery( '#' + ControlId ).tabs( "select" , i );
				ultimix.tab_control.AddTabFlag = 0;
			}
		}
	}
}

/**
*	Function adds handler for the 'add tab' event.
*
*	@param ControlId - id of the tab control.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.set_add_tab_handler = function( ControlId )
{
	jQuery( '#' + ControlId ).tabs( 
		'option' , 'add' , 
		function( event , ui )
		{
			jQuery( ui.panel ).append( jQuery( '#' + ultimix.tab_control.AddContentId ) );

			if( ultimix.tab_control.SelectCreated )
			{
				var			TabIndex = ultimix.tab_control.count_of_tabs( ControlId ) - 1;
				TabIndex = ultimix.tab_control.InsertIndex == -1 ? TabIndex : ultimix.tab_control.InsertIndex;
				jQuery( '#' + ControlId ).tabs( "select" , TabIndex );
			}
			else
			{
				ultimix.tab_control.try_auto_select_tab( ControlId );
			}
		}
	);
}

/**
*	Function post process reated tab.
*
*	@param TabSelector - Selector of the tab.
*
*	@param TabId - Id of the tab.
*
*	@param Selected - Should this tab be selected.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.post_process_tab = function( TabSelector , TabId , Selected )
{
	jQuery( TabSelector ).html(
		ultimix.string_utilities.str_replace( '[tab_id]' , TabId , jQuery( TabSelector ).html() )
	);

	if( Selected )
	{
		ultimix.windows.auto_fit_div( jQuery( '#' + ultimix.tab_control.AddContentId ).parent() );
	}
}

/**
*	Function adds simple tab to the control.
*
*	@param ControlId - id of the tab control.
*
*	@param Title - Title of the additing tab.
*
*	@param Index - Index of the additing tab.
*
*	@param ContentId - id of the tab's content.
*
*	@param Selected - Should this tab be selected.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.add_simple_tab = function( ControlId , Title , Index , ContentId , Selected )
{
	ultimix.tab_control.AddTabFlag = 1;
	ultimix.tab_control.AddContentId = ContentId;
	ultimix.tab_control.SelectCreated = Selected;
	ultimix.tab_control.InsertIndex = Index;

	var			TabId = 'tabs' + ( ultimix.tab_control.TabCounter );
	var			TabSelector = '#tabs' + ( ultimix.tab_control.TabCounter++ );

	if( Index >= 0 )
	{
		jQuery( '#' + ControlId ).tabs( 'add' , TabSelector , ultimix.get_string( Title ) , Index );
	}
	else
	{
		jQuery( '#' + ControlId ).tabs( 'add' , TabSelector , ultimix.get_string( Title ) );
	}

	ultimix.tab_control.post_process_tab( TabSelector , TabId , Selected );
}

/**
*	Function adds simple tab to the control.
*
*	@param ControlId - id of the tab control.
*
*	@param Title - Title of the additing tab.
*
*	@param Index - Index of the additing tab.
*
*	@param Content - Tab content.
*
*	@param Selected - Should this tab be selected.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.add_simple_tab_from_content = function( ControlId , Title , Index , Content , Selected )
{
	var			ContentId = "content_" + ultimix.core.GetCurrentMilliseconds();

	jQuery( 'body' ).append( '<div id="' + ContentId + '" style=\"height: 100%;\">' + Content + '</div>' );

	ultimix.tab_control.add_simple_tab( ControlId , Title , Index , ContentId , Selected );
}

/**
*	Function adds tab to the control.
*
*	@param ControlId - id of the tab control.
*
*	@param Title - Title of the additing tab.
*
*	@param Index - Index of the additing tab.
*
*	@param ContentId - id of the tab's content.
*
*	@param Closable - Should be the creating tab closable.
*
*	@param Selected - Should this tab be selected.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.add_tab = function( ControlId , Title , Index , ContentId , Closable , Selected )
{
	ultimix.tab_control.add_simple_tab( ControlId , Title , Index , ContentId , Selected );

	if( ultimix.tab_control.InitialTabWasDeleted[ ControlId ] == false )
	{
		var			TabIndex = ultimix.tab_control.InsertIndex == -1 ? 0 : 1;
		jQuery( '#' + ControlId ).tabs( 'remove' , TabIndex );
		ultimix.tab_control.InitialTabWasDeleted[ ControlId ] = true;
	}

	if( Closable )
	{
		ultimix.tab_control.set_closable( ControlId );
	}
}

/**
*	Function adds tab to the control.
*
*	@param ControlId - id of the tab control.
*
*	@param Title - Title of the additing tab.
*
*	@param Index - Index of the additing tab.
*
*	@param ContentId - id of the tab's content.
*
*	@param Closable - Should be the creating tab closable.
*
*	@param Selected - Should this tab be selected.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.add_tab_from_content = function( ControlId , Title , Index , Content , Closable , Selected )
{
	var			ContentId = "content_" + ultimix.core.GetCurrentMilliseconds();

	jQuery( 'body' ).append( '<div id="' + ContentId + '" style=\"height: 100%;\">' + Content + '</div>' );

	ultimix.tab_control.add_tab( ControlId , Title , Index , ContentId , Closable , Selected );
}

/**
*	Function adds tab to the control.
*
*	@param ControlId - id of the tab control.
*
*	@param Title - Title of the additing tab.
*
*	@param Index - Index of the additing tab.
*
*	@param URL - URL of the iframe source.
*
*	@param Closable - Should be the creating tab closable.
*
*	@param Height - Height of the iframe.
*
*	@param Selected - Should this tab be selected.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.add_iframe_tab = function( ControlId , Title , Index , URL , Closable , Height , Selected )
{
	var			TabFrameId = ultimix.tab_control.TabCounter++;

	jQuery( 'body' ).append( '<iframe style="width: 100%; border: 0px; height: ' + Height + ';" id="tab_frame_' + 
		TabFrameId + '" src="' + URL + '"></iframe>' );

	ultimix.tab_control.add_tab( ControlId , Title , Index , "tab_frame_" + TabFrameId , Closable , Selected )
}

/**
*	Function creates the control from the murkup.
*
*	@param ControlId - id of the tab control.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.create_tab_control_from_markup = function( ControlId )
{
	jQuery( '#' + ControlId ).tabs();

	ultimix.tab_control.tab_control_create_setup( ControlId );
}

/**
*	Function creates the control from the murkup.
*
*	@param ParentSelector - Selector of the tab parent.
*
*	@param ControlId - id of the tab control.
*
*	@param Title - Title of the tab.
*
*	@param Content - Content of the tab.
*
*	@param Closable - Should be the creating tab closable.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.create_tab_control_with_tab = function( ParentSelector , ControlId , Title , Content , Closable )
{
	/* preparing markup */
	jQuery( ParentSelector ).append( 
		'<div id="' + ControlId + 
		'"><ul><li><a href="#tabs-1">' + ultimix.get_string( Title ) + '</a></li></ul><div id="tabs-1">' + 
		Content + '</div></div>'
	);

	/* creating tab */
	ultimix.tab_control.create_tab_control_from_markup( ControlId );

	if( Closable )
	{
		ultimix.tab_control.set_closable( ControlId );
	}
}

/**
*	Function adds tab to the control. If the control does not exist then it will be created.
*
*	@param ParentSelector - Selector of the tab parent.
*
*	@param ControlId - id of the tab control.
*
*	@param Title - Title of the additing tab.
*
*	@param Index - Index of the additing tab.
*
*	@param Content - Content of the tab.
*
*	@param Closable - Should be the creating tab closable.
*
*	@param Selected - Should this tab be selected.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.add_tab_for_existing_control = function( ParentSelector , ControlId , Title , Index , Content , 
																								Closable , Selected )
{
	if( jQuery( '#' + ControlId ).length )
	{
		/* control exists */
		ultimix.tab_control.add_tab_from_content( ControlId , Title , Index , Content , Closable , Selected );
	}
	else
	{
		/* control does not exist */
		ultimix.tab_control.create_tab_control_with_tab( ParentSelector , ControlId , Title , Content , Closable );
	}
}

/**
*	Function adds tab to the control. If the control does not exist then it will be created.
*
*	@param ParentSelector - Selector of the tab parent.
*
*	@param ControlId - id of the tab control.
*
*	@param Title - Title of the additing tab.
*
*	@param Index - Index of the additing tab.
*
*	@param URL - URL of the iframe source.
*
*	@param Closable - Should be the creating tab closable.
*
*	@param Height - Height of the iframe.
*
*	@param Selected - Should this tab be selected.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.add_iframe_tab_for_existing_control = function( ParentSelector , ControlId , Title , Index , URL , 
																						Closable , Height , Selected )
{
	if( jQuery( '#' + ControlId ).length )
	{
		/* control exists */
		ultimix.tab_control.add_iframe_tab( ControlId , Title , Index , URL , Closable , Height );
	}
	else
	{
		var			ContentId = "content_" + ultimix.core.GetCurrentMilliseconds();

		/* control does not exist */
		var			Content = '<iframe style="width: 100%; border: 0px; height: ' + Height + ';" id="tab_frame_' + 
							  TabFrameId + '" src="' + URL + '"></iframe>';

		ultimix.tab_control.create_tab_control_with_tab( 
			ParentSelector , ControlId , Title , Content , Closable , Selected
		);
	}
}


/**
*	Function returns count of tabs.
*
*	@param ControlId - id of the tab control.
*
*	@return Count of tabs.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.count_of_tabs = function( ControlId )
{
	return( jQuery( '#' + ControlId + '>.ui-tabs-nav>li>a' ).length );
}

/**
*	Function creates add tab from content delegate.
*
*	@param TabId - Id of the tab.
*
*	@param Data - Tab creating data.
*
*	@return Function.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.get_tab_content_acceptor_success = function( TabId , Data )
{
	return(
		function( Content )
		{
			Content = ultimix.string_utilities.str_replace( '[tab_id]' , TabId , Content );
			jQuery( Data.CreatedTab ).html( Content );
		}
	);
}

/**
*	Function creates add tab from content delegate.
*
*	@param ParentSelector - Selector of the tab parent.
*
*	@param ControlId - id of the tab control.
*
*	@param Title - Title of the additing tab.
*
*	@param Index - Index of the additing tab.
*
*	@param Closable - Should be the creating tab closable.
*
*	@param Selected - Should this tab be selected.
*
*	@return Function.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.get_tab_content_acceptor = function( ControlId , Title , Index , Closable , Selected )
{
	var			Data = { 'CreatedTab' : false };
	var			TabId = 'tabs' + ultimix.tab_control.TabCounter;

	return(
		{
			before_request : function()
				{
					ultimix.tab_control.add_tab_from_content( 
						ControlId , Title , Index , ultimix.std_dialogs.loading_img_widget() , Closable , Selected
					);
					Index = Index == -1 ? ultimix.tab_control.count_of_tabs( ControlId ) - 1 : Index;
					Data.CreatedTab = jQuery( '#' + ControlId ).children( 'div' ).eq( Index );
				} , 
			success : ultimix.tab_control.get_tab_content_acceptor_success( TabId , Data )
		}
	);
}
