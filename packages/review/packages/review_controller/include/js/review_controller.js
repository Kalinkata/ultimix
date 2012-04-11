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
if( !ultimix.review )
{
	ultimix.review = {};
}

/**
*	Function creates record.
*
*	@param Data - Creation data.
*
*	@param Success - After request callback function.
*
*	@param Options - Request options.
*
*	@author Dodonov A.A.
*/
ultimix.review.Create = function( Data , Success , Options )
{
	jQuery.extend( { 'async' : true } , Options ? Options : {}; );
	jQuery.extend( { 'meta' : 'meta_create_review' } , Data );
	
	if( Success )
	{
		OnAfterRequestHandler = function( Result )
		{
			var		ResultJSON;
			eval( "ResultJSON=" + Result );
			Success( ResultJSON );
		}
		ultimix.DirectController( Data , OnAfterRequestHandler , Options );
	}
	else
	{
		ultimix.DirectController( Data , false , Options );
	}
}

/**
*	Function updates record.
*
*	@param Data - Update data.
*
*	@param Success - After request callback function.
*
*	@param Options - Request options.
*
*	@author Dodonov A.A.
*/
ultimix.review.Update = function( Data , Success , Options )
{
	jQuery.extend( { 'async' : true } , Options ? Options : {}; );
	jQuery.extend( { 'meta' : 'meta_update_review' } , Data );
	
	if( Success )
	{
		OnAfterRequestHandler = function( Result )
		{
			var		ResultJSON;
			eval( "ResultJSON=" + Result );
			Success( ResultJSON );
		}
		ultimix.DirectController( Data , OnAfterRequestHandler , Options );
	}
	else
	{
		ultimix.DirectController( Data , false , Options );
	}
}

/**
*	Function deletes record.
*
*	@param Data - Delete data.
*
*	@param Success - After request callback function.
*
*	@param Options - Request options.
*
*	@author Dodonov A.A.
*/
ultimix.review.Delete = function( Data , Success , Options )
{
	jQuery.extend( { 'async' : true } , Options ? Options : {}; );
	jQuery.extend( { 'meta' : 'meta_delete_review' } , Data );
	
	if( Success )
	{
		OnAfterRequestHandler = function( Result )
		{
			var		ResultJSON;
			eval( "ResultJSON=" + Result );
			Success( ResultJSON );
		}
		ultimix.DirectController( Data , OnAfterRequestHandler , Options );
	}
	else
	{
		ultimix.DirectController( Data , false , Options );
	}
}
