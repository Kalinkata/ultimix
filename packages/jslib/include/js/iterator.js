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
if( !ultimix.iterator )
{
	ultimix.iterator = {};
}

/**
*	Function creates iterator.
*
*	@param IteratingElements - Elements to iterate.
*
*	@param BeforeNext - This function will be called before iterator shift.
*
*	@return Iterator.
*
*	@author Dodonov A.A.
*/
ultimix.iterator = function( IteratingElements , BeforeNext , EndIteration )
{
	this.current_position = 0;
	this.elements = IteratingElements;
	this.before_next = BeforeNext;
	this.end_iteration = EndIteration;

	return( this );
}

// TODO persistent cheñkbox
// TODO persistent input
// TODO persistent radiobutton

/**
*	Function moves to next element.
*
*	@author Dodonov A.A.
*/
ultimix.iterator.prototype.next = function()
{
	if( jQuery( this.elements ).eq( this.current_position ).length )
	{
		this.before_next();
		this.current_position++;
	}
	else
	{
		this.end_iteration();
	}
}

/**
*	Function returns current element.
*
*	@return Current element
*
*	@author Dodonov A.A.
*/
ultimix.iterator.prototype.current_element = function()
{
	if( jQuery( this.elements ).eq( this.current_position ).length )
	{
		return( jQuery( this.elements ).eq( this.current_position ) );
	}
	
	return( false );
}

/**
*	Function returns previous element.
*
*	@return Previous element
*
*	@author Dodonov A.A.
*/
ultimix.iterator.prototype.prev_element = function()
{
	if( this.current_position - 1 >= 0 && jQuery( this.elements ).eq( this.current_position - 1 ).length )
	{
		return( jQuery( this.elements ).eq( this.current_position - 1 ) );
	}
	
	return( false );
}