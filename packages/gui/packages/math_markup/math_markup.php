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
		*	\~russian Функция обработки макроса 'eq'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Результат.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'eq'.
		*
		*	@param $Settings - Settings.
		*
		*	@return Result.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_eq( &$Settings )
		{
			try
			{
				list( $Val1 , $Val2 ) = $Settings->get_settings( 'value1,value2' );

				return( $Val1 == $Val2 ? 1 : 0 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'neq'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Результат.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'neq'.
		*
		*	@param $Settings - Settings.
		*
		*	@return Result.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_neq( &$Settings )
		{
			try
			{
				list( $Val1 , $Val2 ) = $Settings->get_settings( 'value1,value2' );

				return( $Val1 != $Val2 ? 1 : 0 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'not'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Результат.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'not'.
		*
		*	@param $Settings - Settings.
		*
		*	@return Result.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_not( &$Settings )
		{
			try
			{
				$Value = $Settings->get_setting( 'value' );

				return( !$Value ? 1 : 0 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'gt'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Результат.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'gt'.
		*
		*	@param $Settings - Settings.
		*
		*	@return Result.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_gt( &$Settings )
		{
			try
			{
				list( $Val1 , $Val2 ) = $Settings->get_settings( 'value1,value2' );

				return( $Val1 > $Val2 ? 1 : 0 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'lt'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Результат.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'lt'.
		*
		*	@param $Settings - Settings.
		*
		*	@return Result.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_lt( &$Settings )
		{
			try
			{
				list( $Val1 , $Val2 ) = $Settings->get_settings( 'value1,value2' );

				return( $Val1 < $Val2 ? 1 : 0 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'gte'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Результат.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'gte'.
		*
		*	@param $Settings - Settings.
		*
		*	@return Result.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_gte( &$Settings )
		{
			try
			{
				list( $Val1 , $Val2 ) = $Settings->get_settings( 'value1,value2' );

				return( $Val1 >= $Val2 ? 1 : 0 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'lte'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Результат.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'lte'.
		*
		*	@param $Settings - Settings.
		*
		*	@return Result.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_lte( &$Settings )
		{
			try
			{
				list( $Val1 , $Val2 ) = $Settings->get_settings( 'value1,value2' );

				return( $Val1 <= $Val2 ? 1 : 0 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'odd'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Результат.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'odd'.
		*
		*	@param $Settings - Settings.
		*
		*	@return Result.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_odd( &$Settings )
		{
			try
			{
				$Settings->load_settings( $Parameters );

				return( intval( $Settings->get_setting( 'value' ) ) % 2 == 1 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'even'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Результат.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'even'.
		*
		*	@param $Settings - Settings.
		*
		*	@return Result.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_even( &$Settings )
		{
			try
			{
				$Settings->load_settings( $Parameters );

				return( intval( $Settings->get_setting( 'value' ) ) % 2 == 0 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'if'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Результат.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'if'.
		*
		*	@param $Settings - Settings.
		*
		*	@return Result.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_if( &$Settings )
		{
			try
			{
				$Cond = $Settings->get_setting( 'condition' , false );
				$Then = $Settings->get_setting( 'then' , '' );
				$Else = $Settings->get_setting( 'else' , '' );

				return( $Cond == 0 ? $Else : $Then );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'map'.
		*
		*	@param $Settings - Параметры.
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
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_map( &$Settings )
		{
			try
			{
				$Value = $Settings->get_setting( 'value' , false );

				$First = explode( '|' , $Settings->get_setting( 'first' , '' ) );
				$Second = explode( '|' , $Settings->get_setting( 'second' , '' ) );

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
	}
	
?>