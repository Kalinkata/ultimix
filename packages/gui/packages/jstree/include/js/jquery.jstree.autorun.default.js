jQuery(
	function()
	{
		jQuery( ".tree_control" ).jstree(
			{
				"plugins" : [ "themes" , "html_data" , "types" , "ui" , "crrm" , "cookies" , "types" ] , 
				"themes" : {
					"theme" : "classic" , 
					"url" : './packages/gui/packages/jstree/res/themes/classic/style.css' //TODO: calculate this path
				} , 
				"types" : 
				{
					"default" : 
					{
						draggable  : false , 
					}
				} , 
				"lang" : {
					new_node : "New item"
				} , 
				"core" : { 
					"initially_open" : [ "thtml_1" ] , 
					"strings" : { new_node : "New item" }
				} , 
				"types" : 
				{
					"valid_children" : [ "not_selectable" ],
					"types" :
					{
						"not_selectable" :
						{
							"valid_children" : [ "default" ] , 
							"hover_node" : false , 
							"select_node" : function(){ return( false ); }
						} , 
						"default" :
						{
							"valid_children" : [ "default" ]
						}
					}
				}
			}
		);
		
		jQuery( '.tree_control' ).bind( "create.jstree" , ultimix.jstree.create_node_event_handler );
		jQuery( '.tree_control' ).bind( "rename.jstree" , ultimix.jstree.rename_node_event_handler );
		jQuery( '.tree_control' ).bind( "remove.jstree" , ultimix.jstree.remove_node_event_handler );
	}
);