jQuery(
	function()
	{
		jQuery( ".tree_control" ).jstree(
			{
				"plugins" : [ "themes" , "html_data" , "types" , "ui" , "crrm" , "cookies" , "types" ] , 
				"themes" : {
					"theme" : "classic" , 
					"url" : './packages/jstree/res/themes/classic/style.css'
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
		
		jQuery( '.tree_control' ).bind( "create.jstree" , ultimix.jstree.CreateNodeEventHandler );
		jQuery( '.tree_control' ).bind( "rename.jstree" , ultimix.jstree.RenameNodeEventHandler );
		jQuery( '.tree_control' ).bind( "remove.jstree" , ultimix.jstree.RemoveNodeEventHandler );
	}
);