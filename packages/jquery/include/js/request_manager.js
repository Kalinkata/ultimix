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
if( !ultimix.request_manager )
{
	ultimix.request_manager = {};
}

/**
*	Function compiles opener options.
*
*	@param Obj - Settings.
*
*	@param Type - Type of the opener.
*
*	@author Dodonov A.A.
*/
ultimix.request_manager.compile_opener_data = function( Obj , Type )
{
	var			OpenerData = {};

	OpenerData.OpenIn = Type;
	OpenerData.TabControl = jQuery( Obj ).attr( 'tab_control' );
	OpenerData.Title = jQuery( Obj ).attr( 'title' );
	OpenerData.URL = jQuery( Obj ).attr( 'url' );

	return( OpenerData );
}

/**
*	Function add iframe tab opener.
*
*	@param Obj - Settings.
*
*	@author Dodonov A.A.
*/
ultimix.request_manager.add_iframe_tab_opener = function( Obj )
{
	var			OpenerData = ultimix.request_manager.compile_opener_data( Obj , 'iframe_tab' );

	jQuery( Obj ).attr( 'href' , 'javascript:void(0);' );

	jQuery( Obj ).click(
		function( EventObject )
		{
			var			Opener = OpenerData;
			ultimix.tab_control.add_iframe_tab( 
				OpenerData.TabControl , OpenerData.Title , -1 , OpenerData.URL , true , 400
			);
		}
	);
}

/**
*	Function add ajax tab opener.
*
*	@param Obj - Settings.
*
*	@author Dodonov A.A.
*/
ultimix.request_manager.add_ajax_tab_opener = function( Obj )
{
	var			OpenerData = ultimix.request_manager.compile_opener_data( Obj , 'ajax_tab' );

	jQuery( Obj ).attr( 'href' , 'javascript:void(0);' );

	jQuery( Obj ).click(
		function()
		{
			var			Opener = OpenerData;
			ultimix.tab_control.add_simple_tab_from_content( Opener.TabControl , Opener.Title , -1 , '' );
			ultimix.tab_control.set_closable( Opener.TabControl );

			var			Selector = '#' + Opener.TabControl;
			var			Tab = jQuery( Selector ).find( 'div.ui-tabs-panel' ).last();
			ultimix.ajax_gate.DirectViewComposer( Tab , {} , Opener.URL , {} );
		}
	);
}

jQuery(
	function()
	{
		jQuery( 'a' ).each(
			function( i , Obj )
			{
				var			OpenIn = jQuery( Obj ).attr( 'open_in' );
				if( OpenIn == '' )
				{
					return; // no special action
				}

				switch( OpenIn )
				{
					case( 'iframe_tab' ):ultimix.request_manager.add_iframe_tab_opener( Obj );
					case( 'ajax_tab' ):ultimix.request_manager.add_ajax_tab_opener( Obj );
				}
			}
		);
	}
);
