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
if( !ultimix.utilities )
{
	ultimix.utilities = {};
}

//TODO: create vertical aligned 'no_data_found' message

/**
*	Method remmoves duplicate elements from array.
*
*	@param Arr - array of elements.
*
*	@return Array of elements.
*
*	@author Dodonov A.A.
*/
ultimix.utilities.array_unique = function( Arr )
{
	var			tmp_arr = new Array();

	for( var i = 0 ; i < Arr.length ; i++ )
	{
		if( tmp_arr.indexOf( Arr[ i ] ) == "-1" )
		{
			tmp_arr.push( Arr[ i ] );
		}
	}

	return( tmp_arr );
}
