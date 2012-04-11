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
if( !ultimix.core )
{
	ultimix.core = {};
}


/**
*	Does element exists in the array
*
*	@author Dodonov A.A.
*/
function 	in_array( Element , Arr )
{
    for( var i = 0 ; i < Arr.length ; i++ )
	{
        if( Element == Arr[ i ] )
		{
            return( true );
        }
    }
    return( false );
}

/**
*	Function does nothing.
*
*	@author Dodonov A.A.
*/
function	nop()
{
}

/**
*	Function deletes parent of the element Selector.
*
*	@author Dodonov A.A.
*/
ultimix.DeleteParentItem = function( Selector )
{
	jQuery( Selector ).parent().remove();
}

/**
* 	Function returns random integer number.
*
* 	@param Min - Minimum value.
*
* 	@param Max - Maximum value.
*
* 	@return Random integer number.
*
* 	@author Dodonov A.A.
*/
ultimix.GetRandomInt = function( Min , Max )
{
	if( !Min )Min = 0;
	if( !Max )Max = 1000000000;
	
	return( Math.floor( Math.random() * ( Max - Min + 1 ) ) + Min );
}

/**
* 	Function returns the numeric value of the specified date as the number of 
*	milliseconds since January 1, 1970, 00:00:00 UTC.
*
* 	@return The numeric value of the specified date as the number of milliseconds since 
*	January 1, 1970, 00:00:00 UTC.
*
* 	@author Dodonov A.A.
*/
ultimix.core.GetCurrentMilliseconds = function()
{
	var 		d = new Date();
	return( d.getTime() );
}
