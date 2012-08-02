<?php

	/*
	*	This source code is a part of the Ultimix Project. 
	*	It is distributed under BSD license. All other third side source code (like tinyMCE) is distributed under 
	*	it's own license wich could be found from the corresponding files or sources. 
	*	This source code is provided "as is" without any warranties or garanties.
	*
	*	Have a nice day!
	*
	*	@url http://ultimix.sorceforge.net
	*
	*	@author Alexey "gdever" Dodonov
	*/

	/**
	*	\~russian Строковые утилиты.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english String utilities.
	*
	*	@author Dodonov A.A.
	*/
	class	macro_parser_1_0_0{
	
		/**
		*	\~russian Функция проверки параметров макроса.
		*
		*	@param $Params - Параметры макроса.
		*
		*	@param $RegExValidators - Регулярные выражения для проверки выбираемых параметров.
		*
		*	@return true/false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates macro's parameters.
		*
		*	@param $Params - Macro's parameters.
		*
		*	@param $RegExValidators - Regular expressions for parameters validation.
		*
		*	@return true/false.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			is_params_valid( &$Params , &$RegExValidators )
		{
			try
			{
				$Valid = true;
				$Matches = array();
				/* проверяем валидность параметров если надо */
				if( count( $RegExValidators ) )
				{
					$ParamsList = explode( ';' , $Params );
					foreach( $ParamsList as $key1 => $p )
					{
						$p = explode( '=' , $p );
						foreach( $RegExValidators as $key2 => $rev )
						{
							if( $key2 == $p[ 0 ] )
							{
								$Result = preg_match( $rev , $p[ 1 ] , $Matches );
								$Valid = count( $Matches ) == 0 ? false : $Valid;
								break;
							}
						}
					}
				}
				return( $Valid );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>