var		ultimix = {};

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.lang )
{
	ultimix.lang = {};
}

/**
*	Current locale.
*
*	@author Dodonov A.A.
*/
ultimix.lang.Locale = 'ru';

/**
*	List of the translations.
*
*	@author Dodonov A.A.
*/
ultimix.lang.Strings = new Object();

/**
*	List of the translated strings.
*
*	@author Dodonov A.A.
*/
ultimix.lang.Strings[ ultimix.lang.Locale ] = new Object();

/**
*	Function returns the translated literal for the StringAlias.
*
*	@param StringAlias - Literal to translate.
*
*	@param Default - Default literal.
*
*	@param Value - Literal selection value.
*
*	@return The translated literal.
*
*	@author Dodonov A.A.
*/
ultimix.get_string = function( StringAlias , Default , Value )
{
	if( !Value )
	{
		Value = 'default';
	}
	
	if( ultimix.lang.Strings[ ultimix.lang.Locale ] )
	{
		if( ultimix.lang.Strings[ ultimix.lang.Locale ][ StringAlias ] )
		{
			if( Value == 'default' )
			{
				return( ultimix.lang.Strings[ ultimix.lang.Locale ][ StringAlias ][ 'default' ] );
			}
			else
			{
				for( Condition in ultimix.lang.Strings[ ultimix.lang.Locale ][ StringAlias ] )
				{
					if( ( new RegExp( Condition ) ).test( String( Value ) ) )
					{
						return( ultimix.lang.Strings[ ultimix.lang.Locale ][ StringAlias ][ Condition ] );
					}
				}
			}
		}
	}
	if( Default )
	{
		return( Default );
	}
	return( StringAlias );
}