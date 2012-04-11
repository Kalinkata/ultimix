/**
* 	Auto creation of the controls.
*
* 	@author Dodonov A.A.
*/

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
if( !ultimix.jqgrid )
{
	ultimix.jqgrid = {};
}

/**
*	Function corrects styles of the grid.
*
*	@param GridId - Id of the grid.
*
*	@author Dodonov A.A.
*/
ultimix.jqgrid.CorrectStyles = function( GridId )
{
	jQuery( '#gbox_' + GridId + '_list' ).attr( 'style' , 'width: auto;' );
	jQuery( '#gbox_' + GridId + '_list' ).find( '.ui-jqgrid-view' ).attr( 'style' , 'width: auto;' );
	jQuery( '#gbox_' + GridId + '_list' ).find( '.ui-jqgrid-hdiv' ).attr( 'style' , 'width: auto;' );
	jQuery( '#gbox_' + GridId + '_list' ).find( '.ui-jqgrid-bdiv' ).attr( 
		'style' , 'height: auto; min-height: 200px; width: auto;'
	);
	jQuery( '#gbox_' + GridId + '_list' ).find( '.ui-jqgrid-pager' ).attr( 'style' , 'width: auto;' );
}

jQuery( 
	function()
	{
		/* processing parameters */
		jQuery( '.jqgrid' ).each(
			function( Index , Object )
			{
				var			GridId = jQuery( Object ).attr( 'id' );
				eval( 'var Options = ' + jQuery( Object ).html() );
				
				jQuery( Object ).replaceWith( 
					'<table id="' + GridId + '_list"></table><div id="' + GridId + '_pager"></div>'
				);
				
				jQuery( '#' + GridId + '_list' ).jqGrid( Options ); 
				
				ultimix.jqgrid.CorrectStyles( GridId );
			}
		);
	}
);