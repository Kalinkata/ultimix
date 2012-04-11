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
	*	\~russian Класс обработки математических макросов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes math macro.
	*
	*	@author Dodonov A.A.
	*/
	class	math_markup_1_0_0
	{
		
		/**
		*	\~russian Закешированные объекты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached objects.
		*
		*	@author Dodonov A.A.
		*/
		var					$MacroSettings = false;
		var					$String = false;
		
		/**
		*	\~russian Конструктор.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->MacroSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'eq'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'eq'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_eq( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'value1' => TERMINAL_VALUE , 'value2' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'eq' , $Limitations ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );
					
					list( $Val1 , $Val2 ) = $this->MacroSettings->get_settings( 'value1,value2' );
					
					$Str = str_replace( "{eq:$Parameters}" , $Val1 == $Val2 ? 1 : 0 , $Str );
					
					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'neq'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'neq'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_neq( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'value1' => TERMINAL_VALUE , 'value2' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'neq' , $Limitations ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );
					
					list( $Val1 , $Val2 ) = $this->MacroSettings->get_settings( 'value1,value2' );
					
					$Str = str_replace( "{neq:$Parameters}" , $Val1 == $Val2 ? 0 : 1 , $Str );

					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'not'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'not'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_not( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'value' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'not' , $Limitations ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );

					$Value = $this->MacroSettings->get_setting( 'value' );

					$Str = str_replace( "{not:$Parameters}" , !$Value ? 1 : 0 , $Str );

					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'gt'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'gt'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_gt( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'value1' => TERMINAL_VALUE , 'value2' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'gt' , $Limitations ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );
					
					list( $Val1 , $Val2 ) = $this->MacroSettings->get_settings( 'value1,value2' );
					
					$Str = str_replace( "{gt:$Parameters}" , $Val1 > $Val2 ? 1 : 0 , $Str );

					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'lt'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'lt'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_lt( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'value1' => TERMINAL_VALUE , 'value2' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'lt' , $Limitations ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );
					
					list( $Val1 , $Val2 ) = $this->MacroSettings->get_settings( 'value1,value2' );
					
					$Str = str_replace( "{lt:$Parameters}" , $Val1 < $Val2 ? 1 : 0 , $Str );

					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'gte'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'gte'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_gte( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'value1' => TERMINAL_VALUE , 'value2' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'gte' , $Limitations ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );
					
					list( $Val1 , $Val2 ) = $this->MacroSettings->get_settings( 'value1,value2' );
					
					$Str = str_replace( "{gte:$Parameters}" , $Val1 >= $Val2 ? 1 : 0 , $Str );

					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'lte'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'lte'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_lte( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'value1' => TERMINAL_VALUE , 'value2' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'lte' , $Limitations ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );
					
					list( $Val1 , $Val2 ) = $this->MacroSettings->get_settings( 'value1,value2' );
					
					$Str = str_replace( "{lte:$Parameters}" , $Val1 <= $Val2 ? 1 : 0 , $Str );

					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'odd'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'odd'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_odd( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'odd' ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );
					
					if( intval( $this->MacroSettings->get_setting( 'value' ) ) % 2 == 1 )
					{
						$Str = str_replace( 
							"{odd:$Parameters}" , $this->MacroSettings->get_setting( 'content' ) , $Str 
						);
					}
					else
					{
						$Str = str_replace( "{odd:$Parameters}" , '' , $Str );
					}
					
					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'even'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'even'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_even( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'even' ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );
					
					if( intval( $this->MacroSettings->get_setting( 'value' ) ) % 2 == 0 )
					{
						$Str = str_replace( 
							"{even:$Parameters}" , $this->MacroSettings->get_setting( 'content' ) , $Str 
						);
					}
					else
					{
						$Str = str_replace( "{even:$Parameters}" , '' , $Str );
					}
					
					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'if'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'if'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_if( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'cond' => TERMINAL_VALUE , 'condition' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'if' , $Limitations ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );
					
					$Cond = $this->MacroSettings->get_setting( 'condition' , false );
					$Then = $this->MacroSettings->get_setting( 'then' , '' );
					$Else = $this->MacroSettings->get_setting( 'else' , '' );

					$Str = str_replace( "{if:$Parameters}" , $Cond == 0 ? $Else : $Then , $Str );

					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции макроса 'map'.
		*
		*	@param $MacroSettings - Параметры.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'map'.
		*
		*	@param $MacroSettings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_map( &$MacroSettings )
		{
			try
			{
				$Value = $MacroSettings->get_setting( 'value' , false );

				$First = explode( '|' , $MacroSettings->get_setting( 'first' , '' ) );
				$Second = explode( '|' , $MacroSettings->get_setting( 'second' , '' ) );

				$Code = '';

				foreach( $First as $k => $v )
				{
					if( $v == $Value )
					{
						$Code = $Second[ $k ];
						break;
					}
				}
				
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'map'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'map'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_map( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 
					'first' => TERMINAL_VALUE , 'second' => TERMINAL_VALUE , 'value' => TERMINAL_VALUE
				);

				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'map' , $Limitations ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );

					$Code = $this->compile_map( $this->MacroSettings );

					$Str = str_replace( "{map:$Parameters}" , $Code , $Str );
					$Changed = true;
				}

				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки строки.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return Обработанная строка.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes string.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return Processed string.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	process_compare( $Str , &$Changed )
		{
			try
			{
				list( $Str , $Changed ) = $this->process_lte( $Str , $Changed );
				list( $Str , $Changed ) = $this->process_gte( $Str , $Changed );
				list( $Str , $Changed ) = $this->process_gt( $Str , $Changed );
				list( $Str , $Changed ) = $this->process_lt( $Str , $Changed );
				list( $Str , $Changed ) = $this->process_eq( $Str , $Changed );
				list( $Str , $Changed ) = $this->process_neq( $Str , $Changed );
				list( $Str , $Changed ) = $this->process_not( $Str , $Changed );
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки строки.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return Обработанная строка.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes string.
		*
		*	@param $Options - Settings.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return Processed string.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_string( $Options , $Str , &$Changed )
		{
			try
			{
				list( $Str , $Changed ) = $this->process_odd( $Str , $Changed );
				list( $Str , $Changed ) = $this->process_even( $Str , $Changed );
				list( $Str , $Changed ) = $this->process_compare( $Str , $Changed );
				list( $Str , $Changed ) = $this->process_if( $Str , $Changed );
				list( $Str , $Changed ) = $this->process_map( $Str , $Changed );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>