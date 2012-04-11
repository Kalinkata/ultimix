/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	var 	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.timer )
{
	ultimix.timer = {};
}

jQuery.extend( 
	ultimix , 
	{
		timer_widget : function( Element , Options )
		{						
			this._element = Element;
			this.timeout = Options.timeout;
			this.timeout_callback = Options.timeout_callback;
			
			this.init();
		}
	}
);

ultimix.timer_widget.prototype._prepending_zero = function( Value )
{
	if( Value < 10 )
	{
		return( '0' + Value );
	}
	else
	{
		return( '' + Value );
	}
}

ultimix.timer_widget.prototype.init = function()
{
	obj = this;
	this.set_timer( this.timeout );
	this.timeout_callback_was_launched = false;
	
	this.start_time = Math.floor( ( new Date() ).getTime() / 1000 );
	window.setInterval( function(){ obj.on_tick( obj ) } , 1000 );
}

ultimix.timer_widget.prototype.set_timer = function( Time )
{
	Hours = Math.floor( Time / ( 60 * 60 ) );
	Minutes = Math.floor( Time / 60 - Hours * 60 );
	Seconds = Math.floor( Time - Hours * 60 * 60 - Minutes * 60 );
	jQuery( this._element ).empty();
	jQuery( this._element ).append( 
		'<span class="hours">' + this._prepending_zero( Hours ) + '</span>:<span class="minutes">' + 
		this._prepending_zero( Minutes ) + '</span>:<span class="seconds">' + this._prepending_zero( Seconds ) + 
		'</span>'
	);
}

ultimix.timer_widget.prototype.on_tick = function( obj )
{
	Diff = Math.floor( ( new Date() ).getTime() / 1000 ) - obj.start_time;
	if( obj.timeout - Diff > 0 )
	{
		obj.set_timer( obj.timeout - Diff );
	}
	else
	{
		obj.set_timer( 0 );
		if( obj.timeout_callback_was_launched == false )
		{
			if( obj.timeout_callback )
			{
				obj.timeout_callback();
			}
			obj.timeout_callback_was_launched = true;
		}
	}
}

jQuery.fn.timer_widget = function( Options )
{
	Options = jQuery.extend(
		{
			timeout				: 600 , /*in seconds*/
			timeout_callback 	: false
		} , 
		Options
	);
	
	return jQuery.each(
		function()
		{
			new ultimix.timer_widget( jQuery( this ) , Options );
		}
	);
}
