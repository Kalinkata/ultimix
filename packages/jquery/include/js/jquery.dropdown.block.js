var		dropdown_block_class = function( element , options )
{
	this._element = jQuery( element );
	this._block_name = 'block-' + ( ++dropdown_block_class.blockId );
	this.init( options );
}

dropdown_block_class.blockId = 0;

dropdown_block_class.prototype.init = function( options )
{
	var	obj = this;
	
	var	ExtClass = '';
	if( options.ext_class )
	{
		ExtClass = ' ' + options.ext_class;
	}
	
	jQuery( this._element ).after( '<div class="popup_block_panel' + ExtClass + '" style="position:absolute; display:none;" id="' + this._block_name + '">' + options.content + '</div>' );
	
	jQuery( this._element ).mouseover(
		function( evt )
		{
			var	position = jQuery( obj._element ).position();
			var	height = jQuery( obj._element ).outerHeight( true );
			
			jQuery( '#' + obj._block_name ).css( 'left' , position.left );
			jQuery( '#' + obj._block_name ).css( 'top' , position.top + height - 1 );
			jQuery( '#' + obj._block_name ).css( 'display' , 'block' );
		}
	);
	
	jQuery( document ).mousemove(
		function( evt )
		{
			var	offset = jQuery( obj._element ).offset();
			var	height = jQuery( obj._element ).outerHeight( true );
			var	width = jQuery( obj._element ).outerWidth( true );
			
			if( offset.left <= evt.pageX && evt.pageX <= offset.left + width && offset.top <= evt.pageY && evt.pageY <= offset.top + height )
			{
				return;
			}
			
			offset = jQuery( obj._element ).next().offset();
			height = jQuery( obj._element ).next().outerHeight( true );
			width = jQuery( obj._element ).next().outerWidth( true );
			
			if( offset.left <= evt.pageX && evt.pageX <= offset.left + width && offset.top <= evt.pageY && evt.pageY <= offset.top + height )
			{
				return;
			}
			
			jQuery( obj._element ).next().css( 'display' , 'none' );
		}
	);
}

jQuery.fn.dropdown_block = function( options )
{
	options = jQuery.extend(
		{
			content : 'empty'
		} , 
		options
	);

	if( this.length == 0 )
	{
		result = false;
	}
	else if( this.length == 1 )
	{
		result = new dropdown_block_class( jQuery( this ) , options );
	}
	else
	{
		result = [];
						
		for( i = 0 ; i < this.length ; i++ )
		{
			result.push( new dropdown_block_class( jQuery( this[ i ] ) , options ) );
		}
	}

	return( result );
}