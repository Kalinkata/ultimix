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
*	This function initializes iframe dialog.
*
*	@param DivSelector - id of the iframe's bounding div.
*
*	@param Url - URL of the loading resource.
*
*	@author Dodonov A.A.
*/
ultimix.IframeDialogInit = function( DivSelector , Url )
{
	jQuery( '#' + DivSelector ).html( 
		'<iframe style="border:0px; width: 100%; height: 100%;" src="' + Url + '"></iframe>'
	);
	
	return( true );
}

/**
*	This function will be called after the dialog opening.
*
*	@param DivSelector - id of the iframe's bounding div.
*
*	@author Dodonov A.A.
*/
ultimix.IframeDialogOnOpen = function( DivSelector )
{
	jQuery( '#' + DivSelector ).attr( 'style' , 'padding: 0px; ' + jQuery( '#' + DivSelector ).attr( 'style' ) );
}
