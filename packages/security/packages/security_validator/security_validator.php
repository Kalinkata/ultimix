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
	*	\~russian Класс дополнительных алгоритмов выборки данных.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class with additional algorithms.
	*
	*	@author Dodonov A.A.
	*/
	class	security_validator_1_0_0{

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
		var					$Pred = false;
		var					$Settings = false;
		var					$String = false;
		var					$SupportedDataTypes = false;
		
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
				$this->Pred = get_package( 'security::security_validator::predicates' , 'last' , __FILE__ );
				$this->SecurityParser = get_package( 'security::security_parser' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->SupportedDataTypes = get_package( 'security::supported_data_types' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверка значений ассоциативного массива с данными.
		*
		*	@param $Data - Массив с проверяемыми данными.
		*
		*	@param $Name - Название поля.
		*
		*	@param $Predicates - Предикаты.
		*
		*	@param $j - Курсор.
		*
		*	@return true если проверка прошла, иначе false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates array with data.
		*
		*	@param $Data - Array with validating data.
		*
		*	@param $Name - Field name.
		*
		*	@param $Predicates - Predicates.
		*
		*	@param $j - Cursor.
		*
		*	@return true if the validation was passed, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	validate_default( $Data , $Name , $Predicates , $j )
		{
			try
			{
				$o = $this->Pred;
				if( strpos( $Predicates[ $j ] , 'value_' ) === 0 )
				{
					return( $o->process_value( $Data , $Name , $Predicates , $j ) );
				}
				if( strpos( $Predicates[ $j ] , 'min_' ) === 0 )
				{
					return( $o->process_min( $Data , $Name , $Predicates , $j ) );
				}
				if( strpos( $Predicates[ $j ] , 'max_' ) === 0 )
				{
					return( $o->process_max( $Data , $Name , $Predicates , $j ) );
				}
				if( strpos( $Predicates[ $j ] , 'same_as_' ) === 0 )
				{
					return( $o->process_same_as( $Data , $Name , $Predicates , $j ) );
				}
				return( $o->process_simple( $Data , $Name , $Predicates , $j ) );				
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверка значений ассоциативного массива с данными.
		*
		*	@param $Data - Массив с проверяемыми данными.
		*
		*	@param $Name - Название поля.
		*
		*	@param $Predicates - Предикаты.
		*
		*	@param $j - Курсор.
		*
		*	@return true если проверка прошла, иначе false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates array with data.
		*
		*	@param $Data - Array with validating data.
		*
		*	@param $Name - Field name.
		*
		*	@param $Predicates - Predicates.
		*
		*	@param $j - Cursor.
		*
		*	@return true if the validation was passed, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	process_data_predicates( $Data , $Name , $Predicates , $j )
		{
			try
			{
				switch( $Predicates[ $j ] )
				{
					case( 'email' ): return( $this->Pred->validate_email( $Data , $Name , $Predicates ) );
					case( 'float' ): return( $this->Pred->validate_float( $Data , $Name , $Predicates ) );
					case( 'integer' ): return( $this->Pred->validate_integer( $Data , $Name , $Predicates ) );
					case( 'raw' ): return( $this->Pred->validate_string( $Data , $Name , $Predicates ) );
					case( 'string' ): return( $this->Pred->validate_string( $Data , $Name , $Predicates ) );
					case( 'command' ): return( $this->Pred->validate_command( $Data , $Name , $Predicates ) );
				}
				return( 0 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверка значений ассоциативного массива с данными.
		*
		*	@param $Data - Массив с проверяемыми данными.
		*
		*	@param $Name - Название поля.
		*
		*	@param $Predicates - Предикаты.
		*
		*	@param $j - Курсор.
		*
		*	@return true если проверка прошла, иначе false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates array with data.
		*
		*	@param $Data - Array with validating data.
		*
		*	@param $Name - Field name.
		*
		*	@param $Predicates - Predicates.
		*
		*	@param $j - Cursor.
		*
		*	@return true if the validation was passed, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	process_extra_predicates( $Data , $Name , $Predicates , $j )
		{
			try
			{
				$p = $Predicates[ $j ];

				if( $p == 'set' )
				{
					return( $this->Pred->validate_set( $Data , $Name , $Predicates ) );
				}
				elseif( $p == 'not_set' )
				{
					return( $this->Pred->validate_not_set( $Data , $Name , $Predicates ) );
				}
				elseif( $p == 'not_filled' )
				{
					return( $this->Pred->validate_not_filled( $Data , $Name , $Predicates ) );
				}
				elseif( $p == 'allow_not_set')
				{
					return( true );
				}

				return( 0 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверка значений ассоциативного массива с данными.
		*
		*	@param $Data - Массив с проверяемыми данными.
		*
		*	@param $Name - Название поля.
		*
		*	@param $Predicates - Предикаты.
		*
		*	@return true если проверка прошла, иначе false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates array with data.
		*
		*	@param $Data - Array with validating data.
		*
		*	@param $Name - Field name.
		*
		*	@param $Predicates - Predicates.
		*
		*	@return true if the validation was passed, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	process_predicates( $Data , $Name , $Predicates )
		{
			try
			{
				$c = count( $Predicates );

				for( $j = 0 ; $j < $c ; $j++ )
				{
					if( ( $Result = $this->process_data_predicates( $Data , $Name , $Predicates , $j ) ) !== 0 )
					{
					}
					elseif( ( $Result = $this->process_extra_predicates( $Data , $Name , $Predicates , $j ) ) !== 0 )
					{
					}
					elseif( $this->validate_default( $Data , $Name , $Predicates , $j ) === false )
					{
						return( false );
					}
					if( $Result === false )
					{
						return( false );
					}
				}

				return( true );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверка значений ассоциативного массива с данными.
		*
		*	@param $Data - Массив с проверяемыми данными.
		*
		*	@param $ParsingScript - Скрипт проверки полей.
		*
		*	@return true если проверка прошла, иначе false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates array with data.
		*
		*	@param $Data - Array with validating data.
		*
		*	@param $ParsingScript - Validation script.
		*
		*	@return true if the validation was passed, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			validate_custom_fields( $Data , $ParsingScript )
		{
			try
			{
				$this->Pred->ErrorMessage = false;
				$ParsingScript = str_replace( '#' , ';' , $ParsingScript );
				$Script = explode( ';' , $ParsingScript );

				foreach( $Script as $s )
				{
					$s = explode( ':' , $s );
					$Name = $s[ 0 ];
					$Predicates = explode( ',' , $s[ 1 ] );
					if( $this->process_predicates( $Data , $Name , $Predicates ) === false )
					{
						return( false );
					}
				}

				return( true );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверка значений формы.
		*
		*	@param $ParsingScript - Скрипт проверки полей.
		*
		*	@return true если проверка прошла, иначе false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates form fields.
		*
		*	@param $ParsingScript - Validation script.
		*
		*	@return true if the validation was passed, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			validate_fields( $ParsingScript )
		{
			try
			{
				return( $this->validate_custom_fields( array_merge( $_GET , $_POST ) , $ParsingScript ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение сообщения об ошибке.
		*
		*	@return Сообщение об ошибке.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns error message.
		*
		*	@return Error message.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_error_message()
		{
			try
			{
				return( $this->Pred->ErrorMessage );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>