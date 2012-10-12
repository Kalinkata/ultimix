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
		private	function	validate_all( &$Params , &$RegExValidators )
		{
			try
			{
				$Valid = true;
				$Matches = array();

				if( isset( $RegExValidators[ '_all' ] ) )
				{
					$Result = preg_match( $RegExValidators[ '_all' ] , $Params , $Matches );
					$Valid = count( $Matches ) == 0 ? false : $Valid;
				}

				return( $Valid );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
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
				if( count( $RegExValidators ) )
				{
					$Valid = $this->validate_all( $Params , $RegExValidators );
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
		
		/**
		*	\~russian Начало макроса.
		*
		*	@param $TmpStartPos - Начало макроса.
		*
		*	@param $TmpEndPos - Конец макроса.
		*
		*	@param $StartPos - Начало макроса.
		*
		*	@param $Counter - Счетчик.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Macro start.
		*
		*	@param $TmpStartPos - Macro start.
		*
		*	@param $TmpEndPos - Macro end.
		*
		*	@param $StartPos - Macro start.
		*
		*	@param $Counter - Counter.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			handle_macro_start( $TmpStartPos , $TmpEndPos , &$StartPos , &$Counter )
		{
			try
			{
				if( $TmpStartPos !== false && $TmpEndPos !== false )
				{
					if( $TmpStartPos < $TmpEndPos )
					{
						$StartPos = $TmpEndPos;
					}
					if( $TmpEndPos < $TmpStartPos )
					{
						$Counter--;
						if( $Counter )
						{
							$Counter++;
						}
						$StartPos = $TmpStartPos;
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Конец макроса.
		*
		*	@param $TmpStartPos - Начало макроса.
		*
		*	@param $TmpEndPos - Конец макроса.
		*
		*	@param $StartPos - Начало макроса.
		*
		*	@param $Counter - Счетчик.
		*
		*	@param $MacroStartPos - Начало макроса.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Macro end.
		*
		*	@param $TmpStartPos - Macro start.
		*
		*	@param $TmpEndPos - Macro end.
		*
		*	@param $StartPos - Macro start.
		*
		*	@param $Counter - Counter.
		*
		*	@param $MacroStartPos - Macro start.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			handle_macro_end( $TmpStartPos , $TmpEndPos , &$StartPos , &$Counter , $MacroStartPos )
		{
			try
			{
				if( $TmpStartPos !== false && $TmpEndPos === false )
				{
					$Counter++;
					$StartPos = $TmpStartPos;
				}

				if( $TmpStartPos === false && $TmpEndPos !== false )
				{
					$Counter--;
					$StartPos = $TmpEndPos;
				}

				if( $TmpStartPos === false && $TmpEndPos === false )
				{
					/* ничего не найдено, поэтому внешний цикл закончен, да и внутренний тоже
					   $StartPos = strlen( $StringData ); */
					$StartPos = $MacroStartPos;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Конец макроса.
		*
		*	@param $StringData - Строка.
		*
		*	@param $TmpStartPos - Начало макроса.
		*
		*	@param $TmpEndPos - Конец макроса.
		*
		*	@param $StartPos - Начало макроса.
		*
		*	@param $Counter - Счетчик.
		*
		*	@param $MacroStartPos - Начало макроса.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Macro end.
		*
		*	@param $StringData - String data.
		*
		*	@param $TmpStartPos - Macro start.
		*
		*	@param $TmpEndPos - Macro end.
		*
		*	@param $StartPos - Macro start.
		*
		*	@param $Counter - Counter.
		*
		*	@param $MacroStartPos - Macro start.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			handle_macro_start_end( &$StringData , &$TmpStartPos , &$TmpEndPos , 
																		&$StartPos , &$Counter , $MacroStartPos )
		{
			try
			{
				$TmpStartPos = strpos( $StringData , chr( 123 ) , $StartPos + 1 );
				$TmpEndPos = strpos( $StringData , chr( 125 ) , $StartPos + 1 );

				$this->handle_macro_start( $TmpStartPos , $TmpEndPos , $StartPos , $Counter );

				$this->handle_macro_end( 
					$TmpStartPos , $TmpEndPos , $StartPos , $Counter , $MacroStartPos
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Конец макроса.
		*
		*	@param $StringData - Строка.
		*
		*	@param $TmpStartPos - Начало макроса.
		*
		*	@param $TmpEndPos - Конец макроса.
		*
		*	@param $StartPos - Начало макроса.
		*
		*	@param $Counter - Счетчик.
		*
		*	@param $MacroStartPos - Начало макроса.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Macro end.
		*
		*	@param $StringData - String data.
		*
		*	@param $TmpStartPos - Macro start.
		*
		*	@param $TmpEndPos - Macro end.
		*
		*	@param $StartPos - Macro start.
		*
		*	@param $Counter - Counter.
		*
		*	@param $MacroStartPos - Macro start.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			find_macro( &$StringData , &$TmpStartPos , &$TmpEndPos , 
										&$StartPos , &$Counter , $MacroStartPos , $ParamStartPos , $RegExValidators )
		{
			try
			{
				do
				{
					$this->handle_macro_start_end( 
						$StringData , $TmpStartPos , $TmpEndPos , $StartPos , $Counter , $MacroStartPos
					);

					if( $Counter == 0 )
					{
						$Params = substr( $StringData , $ParamStartPos , $TmpEndPos - $ParamStartPos );
						if( $this->is_params_valid( $Params , $RegExValidators ) )
						{
							return( $Params );
						}
						$TmpStartPos = false;
						$StartPos = $MacroStartPos;
					}
				}
				while( $TmpStartPos );

				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>