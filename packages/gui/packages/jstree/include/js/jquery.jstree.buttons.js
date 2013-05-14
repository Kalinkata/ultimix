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
if( !ultimix.jstree )
{
	ultimix.jstree = {};
}

/**
*	Getting selected nodex.
*
*	@param Selector - Tree selector.
*
*	@author Dodonov A.A.
*/
ultimix.jstree.get_selected_node = function( Selector )
{
	var 		Nodes = jQuery( Selector ).jstree( 'get_selected' );

	if( Nodes.length )
	{
		return( Nodes[ 0 ] );
	}

	return( [] );
}

/**
*	Create node event handler.
*
*	@param e - Event object.
*
*	@param Data - Data object.
*
*	@author Dodonov A.A.
*/
ultimix.jstree.create_node_event_handler = function( e , Data )
{
	var			RootId = jQuery( Data.rslt.parent ).attr( 'id' ).replace( 'phtml_' , '' );
	var			ProgressDialogId = ultimix.std_dialogs.SimpleWaitingMessageBox();

	ultimix.ajax_gate.direct_controller(
		{
			'package_name' : 'category::category_controller' , 'meta' : 'meta_create_category' , 
			'category_action' : 'create_record' , 'root_id' : RootId , 'title' : Data.rslt.name , 
			'category_name' : 'category_name'
		} , 
		{
			'success' : function( Result )
			{
				/* parsing result */
				eval( "Result = " + Result + ";" );
				jQuery( Data.rslt.obj ).attr( 'id' , 'phtml_' + Result.id );
				ultimix.std_dialogs.close_message_box( ProgressDialogId );
			}
		}
	);
}

/**
*	Rename node event handler.
*
*	@param e - Event object.
*
*	@param Data - Data object.
*
*	@author Dodonov A.A.
*/
ultimix.jstree.rename_node_event_handler = function( e , Data )
{
	var			NodeId = jQuery( Data.rslt.obj ).attr( 'id' ).replace( 'phtml_' , '' );

	ultimix.ajax_gate.direct_controller(
		{
			'package_name' : 'category::category_controller' , 
			'meta' : 'meta_update_category' , 
			'category_action' : 'update_category_title' , 
			'category_id' : NodeId , 
			'title' : Data.rslt.new_name
		} , {}
	);
}

/**
*	Remove node event handler.
*
*	@param e - Event object.
*
*	@param Data - Data object.
*
*	@author Dodonov A.A.
*/
ultimix.jstree.remove_node_event_handler = function( e , Data )
{
	for( var i = 0 ; i < Data.rslt.obj.length ; i++ )
	{
		var			NodeId = jQuery( Data.rslt.obj[ i ] ).attr( 'id' ).replace( 'phtml_' , '' );

		ultimix.category.delete( NodeId );
	}
}

/**
*	Function processes item creation.
*
*	@author Dodonov A.A.
*/
ultimix.jstree.create_item = function()
{
	var 		Tree = jQuery.jstree._focused();
	var			Node = Tree.get_selected();

	if( Node.length )
	{
		Tree.create( Node , 'last' , ultimix.get_string( 'tree_new_item' ) );
	}
	else
	{
		ultimix.std_dialogs.MessageBox( 
			ultimix.get_string( 'select_tree_node_first' ) , ultimix.get_string( 'Error' ) , 
			ultimix.std_dialogs.MB_OK | ultimix.std_dialogs.MB_ICONERROR | ultimix.std_dialogs.MB_MODAL 
		);
	}
}

/**
*	Function processes item editing.
*
*	@author Dodonov A.A.
*/
ultimix.jstree.rename_item = function()
{
	var 		Tree = jQuery.jstree._focused();
	var			Node = Tree.get_selected();

	if( Node.length )
	{
		Tree.rename();
	}
	else
	{
		ultimix.std_dialogs.MessageBox( 
			ultimix.get_string( 'select_tree_node_first' ) , ultimix.get_string( 'Error' ) , 
			ultimix.std_dialogs.MB_OK | ultimix.std_dialogs.MB_ICONERROR | ultimix.std_dialogs.MB_MODAL 
		);
	}
}

/**
*	Function moves up all children nodes fo the selected nodes.
*
*	@param Tree - Tree object.
*
*	@author Dodonov A.A.
*/
ultimix.jstree.move_up_for_selected = function( Tree )
{
	var			SelectedNodes = Tree.get_selected();

	for( var i = 0 ; i < SelectedNodes.length ; i++ )
	{
		var			Children = Tree._get_children( SelectedNodes[ i ] );

		if( Children.length )
		{
			Tree.move_node( Children , SelectedNodes[ i ] , 'after' );
		}
	}
}

/**
*	Function shows removal confirmation dialog.
*
*	@param ConfirmString - Confirmation string.
*
*	@author Dodonov A.A.
*/
ultimix.jstree.show_remove_item_dialog = function( ConfirmString )
{
	if( ConfirmString == '' )
	{
		ConfirmString = 'shure_to_delete_tree_item';
	}

	ultimix.std_dialogs.MessageBox( 
		ultimix.get_string( ConfirmString ) , 
		ultimix.get_string( 'Question' ) , 
		ultimix.std_dialogs.MB_YESNO | ultimix.std_dialogs.MB_ICONQUESTION | ultimix.std_dialogs.MB_MODAL , 
		function( Result )
		{
			if( Result == ultimix.std_dialogs.MB_YES )
			{
				var 		Tree = jQuery.jstree._focused();

				ultimix.jstree.move_up_for_selected( Tree );

				Tree.remove();
			}
		}
	);
}

/**
*	Function processes item removal.
*
*	@param ConfirmString - Confirmation string.
*
*	@author Dodonov A.A.
*/
ultimix.jstree.remove_item = function( ConfirmString )
{
	var 		Tree = jQuery.jstree._focused();
	var			Node = Tree.get_selected();
	var			ErrMsg = '';
	if( jQuery( Node ).attr( 'rel' ) == 'root' )
	{
		ErrMsg = ultimix.get_string( 'cant_delete_root_node' );
	}
	if( Node.length == 0 )
	{
		ErrMsg = ultimix.get_string( 'select_tree_node_first' );
	}
	if( ErrMsg != '' )
	{
		ultimix.std_dialogs.MessageBox( 
			ErrMsg , ultimix.get_string( 'Error' ) , 
			ultimix.std_dialogs.MB_OK | ultimix.std_dialogs.MB_ICONERROR | ultimix.std_dialogs.MB_MODAL 
		);
		return;
	}

	ultimix.jstree.show_remove_item_dialog( ConfirmString );
}
