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
if( !ultimix.string_utilities )
{
	ultimix.string_utilities = {};
}

/**
* 	Function replaces all occuances of the Search with Search.
*
* 	@param Search - Search substring.
*
* 	@param Replace - Replacing substring.
*
* 	@param Subject - Transforming string.
*
* 	@return String with the replaces.
*
* 	@author Dodonov A.A.
*/
ultimix.string_utilities.str_replace = function( Search , Replace , Subject )
{
	return( Subject.split( Search ).join( Replace ) );
}

// TODO add API wich creates grids from div - was used in seo_tools

/**
* 	Function formats Record according to the Format.
*
* 	@param Format - Format.
*
* 	@param Record - Record to format.
*
* 	@return Formatted record.
*
* 	@author Dodonov A.A.
*/
ultimix.string_utilities.PrintRecord = function( Format , Record )
{
	for( i in Record )
	{
		Format = ultimix.string_utilities.str_replace( '[' + i + ']' , Record[ i ] , Format );
	}
	
	return( Format );
}

/**
* 	Function trails data.
*
* 	@param Data - Data.
*
* 	@param EncodedData - Encoded data.
*
* 	@author Dodonov A.A.
*/
ultimix.string_utilities.trail_data = function( Data , EncodedData )
{
	switch( Data.length % 3 )
	{
        case( 1 ):
            EncodedData = EncodedData.slice( 0 , -2 ) + '==';
        break;
        case( 2 ):
            EncodedData = EncodedData.slice( 0 , -1 ) + '=';
        break;
    }
 
    return( EncodedData );
}

/**
* 	Function encodes string into base64.
*
* 	@param Data - Data to convert.
*
* 	@return Encoded string.
*
* 	@author Dodonov A.A.
*/
ultimix.string_utilities.base64_encode = function( Data )
{   
    var 		b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    var 		o1 , o2 , o3 , h1 , h2 , h3 , h4 , bits , i = 0 , EncodedData = '';
    do
	{ 
        o1 = Data.charCodeAt( i++ );
        o2 = Data.charCodeAt( i++ );
        o3 = Data.charCodeAt( i++ );
        bits = o1 << 16 | o2 << 8 | o3;
        h1 = bits >> 18 & 0x3f;
        h2 = bits >> 12 & 0x3f;
        h3 = bits >> 6 & 0x3f;
        h4 = bits & 0x3f;
        EncodedData += b64.charAt( h1 ) + b64.charAt( h2 ) + b64.charAt( h3 ) + b64.charAt( h4 );
    }
	while ( i < Data.length );
 
    return( ultimix.string_utilities.trail_data( Data , EncodedData ) );
}

/**
* 	Function decodes string from base64.
*
* 	@param o1 - Decode parameters.
*
* 	@param o2 - Decode parameters.
*
* 	@param o3 - Decode parameters.
*
* 	@param h3 - Decode parameters.
*
* 	@param h4 - Decode parameters.
*
* 	@return Decoded char.
*
* 	@author Dodonov A.A.
*/
ultimix.string_utilities.decoded_char = function( o1 , o2 , o3 , h3 , h4 )
{
	if( h3 == 64 )
	{
		return( String.fromCharCode( o1 ) );
	}
	else if ( h4 == 64 )
	{
		return( String.fromCharCode( o1 , o2 ) );
	}
	else
	{
		return( String.fromCharCode( o1 , o2 , o3 ) );
	}
}

/**
* 	Function decodes string from base64.
*
* 	@param Data - Data to convert.
*
* 	@return Decoded string.
*
* 	@author Dodonov A.A.
*/
ultimix.string_utilities.base64_decode = function( Data )
{
	var 	b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
	var 	o1 , o2 , o3 , h1 , h2 , h3 , h4 , bits , i = 0 , DecodedData = '';
	do
	{
		h1 = b64.indexOf( Data.charAt( i++ ) );
		h2 = b64.indexOf( Data.charAt( i++ ) );
		h3 = b64.indexOf( Data.charAt( i++ ) );
		h4 = b64.indexOf( Data.charAt( i++ ) );
		bits = h1<<18 | h2<<12 | h3<<6 | h4;
		o1 = bits>>16 & 0xff;
		o2 = bits>>8 & 0xff;
		o3 = bits & 0xff;

		DecodedData += ultimix.string_utilities.decoded_char( o1 , o2 , o3 , h3 , h4 );
	}
	while( i < Data.length );

	return( DecodedData );
}

/**
* 	Function creates vertical aligned block.
*
* 	@param Content - Content for block.
*
* 	@return Block.
*
* 	@author Dodonov A.A.
*/
ultimix.string_utilities.valign_block = function( Content )
{
	return( "<div class=\"valign_child\">" + Content + "</div><div class=\"valign_helper\"></div>" );
}

/**
* 	Function creates horisontal aligned block.
*
* 	@param Content - Content for block.
*
* 	@param Width - Width for the block.
*
* 	@return Block.
*
* 	@author Dodonov A.A.
*/
ultimix.string_utilities.halign_block = function( Content , Width )
{
	return( 
		"<div class=\"margin_0_auto\" style=\"display: block; width: " + Width + "px; height: 100%;\">" + 
		Content + "</div>"
	);
}
