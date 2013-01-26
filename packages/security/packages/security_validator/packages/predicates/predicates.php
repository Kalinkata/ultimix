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
	*	\~russian Предикаты.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Predicates.
	*
	*	@author Dodonov A.A.
	*/
	class	predicates_1_0_0{

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
		var					$Settings = false;
		var					$String = false;
		var					$SupportedDataTypes = false;

		/**
		*	\~russian Ошибка валидации.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Validation error.
		*
		*	@author Dodonov A.A.
		*/
		var					$ErrorMessage = false;

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
		*	@param $Predicates - Массив с предикатами.
		*
		*	@return Название стринга с сообщением об ошибке, если не анйдено то false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates array with data.
		*
		*	@param $Predicates - Array with predicates.
		*
		*	@return Name of the error message string, false if not found.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	dispatch_error_message( $Predicates )
		{
			try
			{
				foreach( $Predicates as $p )
				{
					if( strpos( $p , 'err_msg_' ) === 0 )
					{
						return( str_replace( 'err_msg_' , '' , $p ) );
					}
				}
				return( false );
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
		function			validate_email( $Data , $Name , $Predicates )
		{
			try
			{
				$Value = get_field( $Data , $Name , '' );

				if( $Value == '' && $this->SecurityParser->allow_not_set( $Predicates ) )
				{
					return( true );
				}

				if( $Value == '' || $this->SupportedDataTypes->compile_data( $Value , 'email' ) != $Value )
				{
					$this->ErrorMessage = $this->dispatch_error_message( $Predicates );
					return( false );
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
		function			validate_float( $Data , $Name , $Predicates )
		{
			try
			{
				$Value = get_field( $Data , $Name , '' );

				if( $Value === '' && $this->SecurityParser->allow_not_set( $Predicates ) )
				{
					return( true );
				}

				if( $Value === '' || $this->SupportedDataTypes->compile_data( $Value , 'float' ) != $Value )
				{
					$this->ErrorMessage = $this->dispatch_error_message( $Predicates );
					return( false );
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
		function			validate_integer( $Data , $Name , $Predicates )
		{
			try
			{
				$Value = get_field( $Data , $Name , '' );

				if( $Value === '' && $this->SecurityParser->allow_not_set( $Predicates ) )
				{
					return( true );
				}

				if( $Value === '' || $this->SupportedDataTypes->compile_data( $Value , 'integer' ) != $Value )
				{
					$this->ErrorMessage = $this->dispatch_error_message( $Predicates );
					return( false );
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
		function			validate_string( $Data , $Name , $Predicates )
		{
			try
			{
				$Value = get_field( $Data , $Name , '' );

				if( $Value == '' && $this->SecurityParser->allow_not_set( $Predicates ) === false )
				{
					$this->ErrorMessage = $this->dispatch_error_message( $Predicates );
					return( false );
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
		function			validate_command( $Data , $Name , $Predicates )
		{
			try
			{
				$Value = get_field( $Data , $Name , '' );

				if( $Value == '' && $this->SecurityParser->allow_not_set( $Predicates ) )
				{
					return( true );
				}

				if( $this->SupportedDataTypes->compile_data( $Value , 'command' ) != $Value )
				{
					$this->ErrorMessage = $this->dispatch_error_message( $Predicates );
					return( false );
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
		function			validate_set( $Data , $Name , $Predicates )
		{
			try
			{
				if( isset( $Data[ $Name ] ) === false )
				{
					$this->ErrorMessage = $this->dispatch_error_message( $Predicates );
					return( false );
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
		function			validate_not_set( $Data , $Name , $Predicates )
		{
			try
			{
				if( isset( $Data[ $Name ] ) === true )
				{
					$this->ErrorMessage = $this->dispatch_error_message( $Predicates );
					return( false );
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
		function			validate_not_filled( $Data , $Name , $Predicates )
		{
			try
			{
				$Value = get_field( $Data , $Name , '' );
				if( $Value != '' )
				{
					$this->ErrorMessage = $this->dispatch_error_message( $Predicates );
					return( false );
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
		private function	exec_set( $Data , $Name , $Predicates )
		{
			try
			{
				if( isset( $Data[ $Name ] ) === false )
				{
					$this->ErrorMessage = $this->dispatch_error_message( $Predicates );
					
					return( false );
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
		function			exec_value( &$Data , $Name , $Predicates , $j )
		{
			try
			{
				$Value = str_replace( 'value_' , '' , $Predicates[ $j ] );

				$Raw = @$Data[ $Name ];

				if( $this->SupportedDataTypes->compile_data( $Raw , 'raw' ) != $Value )
				{
					$this->ErrorMessage = $this->dispatch_error_message( $Predicates );

					return( false );
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
		function			exec_min( $Data , $Name , $Predicates , $j )
		{
			try
			{
				$Value = intval( str_replace( 'min_' , '' , $Predicates[ $j ] ) );

				if( $this->SupportedDataTypes->compile_data( $Data[ $Name ] , 'raw' ) < $Value )
				{
					$this->ErrorMessage = $this->dispatch_error_message( $Predicates );
					
					return( false );
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
		function			exec_max( $Data , $Name , $Predicates , $j )
		{
			try
			{
				$Value = intval( str_replace( 'max_' , '' , $Predicates[ $j ] ) );

				if( $this->SupportedDataTypes->compile_data( $Data[ $Name ] , 'raw' ) > $Value )
				{
					$this->ErrorMessage = $this->dispatch_error_message( $Predicates );
					
					return( false );
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
		function			exec_same_as( $Data , $Name , $Predicates , $j )
		{
			try
			{
				$SecondField = str_replace( 'same_as_' , '' , $Predicates[ $j ] );

				$SecondValue = $this->SupportedDataTypes->compile_data( $Data[ $SecondField ] , 'raw' );

				$First = $this->SupportedDataTypes->compile_data( $Data[ $Name ] , 'raw' );
				$Second = $this->SupportedDataTypes->compile_data( $SecondValue , 'raw' );

				if( $First !== $Second )
				{
					$this->ErrorMessage = $this->dispatch_error_message( $Predicates );

					return( false );
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
		function			exec_simple( $Data , $Name , $Predicates , $j )
		{
			try
			{
				if( $Predicates[ $j ] === 'set' )
				{
					return( $this->exec_set( $Data , $Name , $Predicates ) );
				}
				if( strpos( $Predicates[ $j ] , 'err_msg_' ) === 0 )
				{
					return( true );
				}
				if( strpos( $Predicates[ $j ] , 'default_' ) !== false )
				{
					return( true );
				}

				throw( new Exception( "Undefined predicate '".$Predicates[ $j ]."'" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>