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
	*	\~russian Те которые теперь будут действовать.
	*/
	/**
	*	\~english Actual constants.
	*/
	define( 'SECURE_OBJECT' , 0 );
	define( 'SECURE_ARRAY' , 1 );

	define( 'POST' , 1 );
	define( 'GET' , 2 );
	define( 'COOKIE' , 4 );
	define( 'SESSION' , 8 );
	define( 'SERVER' , 16 );
	define( 'PREFIX_NAME' , 32 );
	define( 'KEYS' , 64 );
	define( 'CHECKBOX_IDS' , POST | PREFIX_NAME | KEYS );

	/**
	*	\~russian Класс с описанием, поддерживаемых данных.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class with all supported data description.
	*
	*	@author Dodonov A.A.
	*/
	class	supported_data_types_1_0_0{

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
		var					$String = false;

		/**
		*	\~russian Список поддерживаемых типов данных.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english A list of the supported data types.
		*
		*	@author Dodonov A.A.
		*/
		var					$SupportedData = array();

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
				$this->String = get_package( 'string' , 'last' , __FILE__ );

				$this->init_supported_data_types();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Загружаем список поддерживаемых типов данных.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Loading a list of the supported data types.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	init_supported_data_types()
		{
			try
			{
				$this->SupportedData[ 'integer' ] = $this;
				$this->SupportedData[ 'digits' ] = $this;
				$this->SupportedData[ 'integer_list' ] = $this;
				$this->SupportedData[ 'float' ] = $this;
				$this->SupportedData[ 'command' ] = $this;
				$this->SupportedData[ 'string' ] = $this;
				$this->SupportedData[ 'script' ] = $this;
				$this->SupportedData[ 'unsafe_string' ] = $this;
				$this->SupportedData[ 'email' ] = $this;
				$this->SupportedData[ 'raw' ] = $this;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция показывает некоторые безопасные макросы, чтобы пользователь из редактора мог их вводить.
		*
		*	@param $Str - Строка для обработки.
		*
		*	@return Перекодированные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function shows some safe macro, in a way that simple user can input them using common editor 
		*	on the site.
		*
		*	@param $Str - String to process.
		*
		*	@return - Decoded data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			show_safe_macro( $Str )
		{
			try
			{
				$Str = preg_replace( "/\[lang\:([\{\}\[\]]{0}.*)\]/U" , "{lang:\\1}" , $Str );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция прячет некоторые безопасные макросы, чтобы пользователь из редактора мог их вводить.
		*
		*	@param $Str - Строка для обработки.
		*
		*	@return Перекодированные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function hides some safe macro, in a way that simple user can input them using common editor 
		*	on the site.
		*
		*	@param $Str - String to process.
		*
		*	@return - Decoded data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			hide_safe_macro( $Str )
		{
			try
			{
				$Str = preg_replace( "/\{lang\:([\{\}\[\]]{0}.*)\}/U" , "[lang:\\1]" , $Str );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка типа распарсенного поля.
		*
		*	@param $Predicates - Список элементов скрипта.
		*
		*	@return - Строковое название типа поля.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function retrives type.
		*
		*	@param $Predicates - Type of the parsing element.
		*
		*	@return - Name of the type.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_type( $Predicates )
		{
			try
			{
				$Types = array( 'integer' , 'float' , 'command' , 'string' , 'email' , 'email' , 'set' , 'raw' );

				foreach( $Predicates as $p )
				{
					$Key = array_search( $p , $Types );
					if( $Key !== false )
					{
						return( $Types[ $Key ] );
					}
				}

				throw( new Exception( "Type was not found" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка данных типа 'integer'.
		*
		*	@param $Data - Данные для обработки.
		*
		*	@return - Обработанные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes data of type 'integer'.
		*
		*	@param $Data - Data to process.
		*
		*	@return - Processed data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_integer( $Data )
		{
			try
			{
				return( intval( $Data ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка данных типа 'digits'.
		*
		*	@param $Data - Данные для обработки.
		*
		*	@return - Обработанные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@note 'digits' специальный вид строк, которые содержат только цифры.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes data of type 'digits'.
		*
		*	@param $Data - Data to process.
		*
		*	@return - Processed data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@note 'digits' is a special string subtype wich contains digits only.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_digits( $Data )
		{
			try
			{
				$RetData = '';
				$s = strlen( $Data = "$Data" );

				for( $i = 0 ; $i < $s ; $i++ )
				{
					if( ( $Data[ $i ] >= '0' && $Data[ $i ] <= '9' ) || $Data[ 0 ] == '-' )
					{
						$RetData .= $Data[ $i ];
					}
				}

				return( $RetData );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка данных типа 'integer_list'.
		*
		*	@param $Data - Данные для обработки.
		*
		*	@return - Обработанные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes data of type 'integer_list'.
		*
		*	@param $Data - Data to process.
		*
		*	@return - Processed data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_integer_list( $Data )
		{
			try
			{
				if( is_array( $Data ) )
				{
					$Data = implode( ',' , $Data );
				}

				$Matches = array();
				preg_match( '/^[0-9\,]+$/' , $Data , $Matches );

				if( count( $Matches ) > 0 )
				{
					return( $Data );
				}
				else
				{
					throw( new Exception( "Illegal symbols were found '$Data'" ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка данных типа 'float'.
		*
		*	@param $Data - Данные для обработки.
		*
		*	@return - Обработанные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes data of type 'float'.
		*
		*	@param $Data - Data to process.
		*
		*	@return - Processed data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_float( $Data )
		{
			try
			{
				return( floatval( $Data ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка данных типа 'command'.
		*
		*	@param $Data - Данные для обработки.
		*
		*	@return - Обработанные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes data of type 'command'.
		*
		*	@param $Data - Data to process.
		*
		*	@return - Processed data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_command( $Data )
		{
			try
			{
				$RetData = '';
				$s = strlen( $Data );
				for( $i = 0 ; $i < $s ; $i++ )
				{
					if( ( $Data[ $i ] >= 'a' && $Data[ $i ] <= 'z' ) ||
						( $Data[ $i ] >= 'A' && $Data[ $i ] <= 'Z' ) || 
						( $Data[ $i ] >= '0' && $Data[ $i ] <= '9' ) || 
						$Data[ $i ] == '_' || $Data[ $i ] == ':' || $Data[ $i ] == '-' || $Data[ $i ] == '.' )
					{
						$RetData .= $Data[ $i ];
					}
				}

				return( $RetData );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка данных типа 'string'.
		*
		*	@param $Data - Данные для обработки.
		*
		*	@return - Обработанные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes data of type 'string'.
		*
		*	@param $Data - Data to process.
		*
		*	@return - Processed data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_string( $Data )
		{
			try
			{
				if( $this->String === false )
				{
					$this->String = get_package( 'string' , 'last' , __FILE__ );
				}

				$Data = $this->hide_safe_macro( $Data );
				$Data = htmlspecialchars( $Data , ENT_QUOTES , 'UTF-8' );

				$PlaceHolders = array( '{' , ';' , '=' , '#' , '}' , "\r" , "\n" );
				$Replacements = array( '[lfb]' , '[dot_comma]' , '[eq]' , '[sharp]' , '[rfb]' , '[r]' , '[n]' );
				$Data = str_replace( $PlaceHolders, $Replacements , $Data );

				$Data = $this->show_safe_macro( $Data );
				$Data = str_replace( '&' , '[amp]' , $Data );

				return( $Data );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка данных типа 'string'.
		*
		*	@param $Data - Данные для обработки.
		*
		*	@return - Обработанные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes data of type 'string'.
		*
		*	@param $Data - Data to process.
		*
		*	@return - Processed data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_script( $Data )
		{
			try
			{
				if( $this->String === false )
				{
					$this->String = get_package( 'string' , 'last' , __FILE__ );
				}

				$Data = htmlspecialchars( $Data , ENT_QUOTES , 'UTF-8' );
				$Data = str_replace( '{' , '[lfb]' , $Data );
				$Data = str_replace( ';' , '[dot_comma]' , $Data );
				$Data = str_replace( '=' , '[eq]' , $Data );
				$Data = str_replace( '#' , '[sharp]' , $Data );
				$Data = str_replace( '}' , '[rfb]' , $Data );
				$Data = str_replace( "\r" , '[r]' , $Data );
				$Data = str_replace( "\n" , '[n]' , $Data );

				$Data = str_replace( '&' , '[amp]' , $Data );

				return( $Data );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка данных типа 'unsafe_string'.
		*
		*	@param $Data - Данные для обработки.
		*
		*	@return - Обработанные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes data of type 'unsafe_string'.
		*
		*	@param $Data - Data to process.
		*
		*	@return - Processed data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_unsafe_string( $Data )
		{
			try
			{
				if( $this->String === false )
				{
					$this->String = get_package( 'string' , 'last' , __FILE__ );
				}

				$Data = str_replace( '[lfb]' , '{' , $Data );
				$Data = str_replace( '[dot_comma]' , ';' , $Data );
				$Data = str_replace( '[eq]' , '=' , $Data );
				$Data = str_replace( '[sharp]' , '#' , $Data );
				$Data = str_replace( '[rfb]' , '}' , $Data );
				$Data = str_replace( '[amp]' , '&' , $Data );

				$Data = htmlspecialchars_decode( $Data , ENT_QUOTES );

				return( $Data );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка данных типа 'email'.
		*
		*	@param $Data - Данные для обработки.
		*
		*	@return - Обработанные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes data of type 'email'.
		*
		*	@param $Data - Data to process.
		*
		*	@return - Processed data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_email( $Data )
		{
			try
			{
				$RetData = '';
				$c = strlen( $Data );
				for( $i = 0 ; $i < $c ; $i++ )
				{
					if( ( $Data[ $i ] >= 'a' && $Data[ $i ] <= 'z' ) ||
						( $Data[ $i ] >= 'A' && $Data[ $i ] <= 'Z' ) || 
						( $Data[ $i ] >= '0' && $Data[ $i ] <= '9' ) || 
						$Data[ $i ] == '_' || $Data[ $i ] == ':' || 
						$Data[ $i ] == '-' || $Data[ $i ] == '.' || 
						$Data[ $i ] == '@' || $Data[ $i ] == '=' || 
						$Data[ $i ] == '+' )
					{
						$RetData .= $Data[ $i ];
					}
				}

				return( $RetData );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка данных.
		*
		*	@param $Data - Данные для обработки.
		*
		*	@param $Type - Тип данных.
		*
		*	@return - Обработанные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes data.
		*
		*	@param $Data - Data to process.
		*
		*	@param $Type - Data type.
		*
		*	@return - Processed data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_data( &$Data , $Type )
		{
			try
			{
				if( isset( $this->SupportedData[ $Type ] ) === false )
				{
					throw( new Exception( "Undefined data type \"$Type\"" ) );
				}
				if( $Type == 'raw' )
				{
					return( $Data );
				}
				return( call_user_func( array( $this->SupportedData[ $Type ] , "compile_$Type" ) , $Data ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка объектов и массивов.
		*
		*	@param $Data - Данные для обработки.
		*
		*	@param $Type - Тип данных.
		*
		*	@return - Обработанные данные.
		*
		*	@note Пустая строка не являтся корректным значением для данных типа
		*	'integer' , 'float' , 'email' and 'integer_list'
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes arrays and objects.
		*
		*	@param $Data - Data to process.
		*
		*	@param $Type - Data type.
		*
		*	@return - Processed data.
		*
		*	@note Empty string is not a valid value for the data of type 
		*	'integer' , 'float' , 'email' and 'integer_list'
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			dispatch_complex_data( &$Data , $Type )
		{
			try
			{
				$Ret = array();
				foreach( $Data as $key => $d )
				{
					if( is_array( $d ) || is_object( $d ) )
					{
						$d = $this->compile_data( $d , $Type );
						if( is_object( $d ) || count( $d ) )
						{
							$Ret[ $key ] = $d;
						}
					}
					else
					{
						if( $Type == 'string' || $Type == 'command' || $Type == 'raw' || strlen( $d ) != 0 )
						{
							$Ret[ $key ] = $this->compile_data( $d , $Type );
						}
					}
				}
				return( $Ret );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>