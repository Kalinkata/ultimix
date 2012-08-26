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
if( !ultimix.ad_manager )
{
	ultimix.ad_manager = {};
}

/**
*	Function returns list view.
*
*	@param Functions - Functions to process success and error events.
*
*	@param ViewOptions - Extra view generation options.
*
*	@author Dodonov A.A.
*/
ultimix.ad_manager.get_list_form = function( Fuctions , ViewOptions )
{
	//TODO: add normal API
	ultimix.ad_banner.get_list_form( Fuctions , ViewOptions );
}

/**
*	Function returns list view.
*
*	@param Functions - Functions to process success and error events.
*
*	@param Header - List header template file name.
*
*	@param Item - List item template file name.
*
*	@param Footer - List footer template file name.
*
*	@param ViewOptions - Extra view generation options.
*
*	@author Dodonov A.A.
*/
ultimix.ad_manager.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	//TODO: add normal API
	ultimix.ad_banner.get_list_form( Fuctions , ViewOptions );
}

/**
*	Function deletes ad_banner.
*
*	@param BannerId - Banner id.
*
*	@param DataSelector - Data selector.
*
*	@author Dodonov A.A.
*/
ultimix.ad_manager.delete = function( BannerId , DataSelector )
{
	//TODO: add normal API
	ultimix.ad_banner.delete( BannerId , DataSelector );
}
