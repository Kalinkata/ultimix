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
	class	security_parser_1_0_0{
	
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
		var					$Security = false;
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
				$this->SupportedDataTypes = get_package( 'security::supported_data_types' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Выборка алиаса распарсенного поля.
		*
		*	@param $Name - Оригинальное имя поля.
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
		*	\~english Function retrives field alias.
		*
		*	@param $Name - Original name of the field.
		*
		*	@param $Predicates - Type of the parsing element.
		*
		*	@return - Name of the type.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_alias( $Name , $Predicates )
		{
			try
			{
				foreach( $Predicates as $p )
				{
					if( strpos( $p , 'alias_' ) === 0 )
					{
						$Alias = str_replace( 'alias_' , '' , $p );
						return( $Alias );
					}
				}
				
				return( $Name );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка значения по-умолчанию распарсенного поля.
		*
		*	@param $Name - Оригинальное имя поля.
		*
		*	@param $Predicates - Список элементов скрипта.
		*
		*	@return - Значени поля по-умолчанию.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function retrives field's default value.
		*
		*	@param $Name - Original name of the field.
		*
		*	@param $Predicates - Type of the parsing element.
		*
		*	@return - Field's default value.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_default( $Name , $Predicates )
		{
			try
			{
				$Default = false;
				
				foreach( $Predicates as $p )
				{
					if( strpos( $p , 'default_' ) === 0 )
					{
						return( str_replace( 'default_' , '' , $p ) );
					}
				}
				
				return( $Default );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверка может ли поле быть незаполненым.
		*
		*	@param $Predicates - Список элементов скрипта.
		*
		*	@return - true если поле может быть неустановлено.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates can field be unset.
		*
		*	@param $Predicates - Type of the parsing element.
		*
		*	@return - True if the field can be not set.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			allow_not_set( $Predicates )
		{
			try
			{
				foreach( $Predicates as $p )
				{
					if( $p === 'allow_not_set' )
					{
						return( true );
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
		*	\~russian Обработка предиката 'allow_not_set'.
		*
		*	@param $ScriptLine - Строка скрипта.
		*
		*	@param $GlobalPredicates - Глобальные предикаты.
		*
		*	@param $Result - Результат работы скрипта.
		*
		*	@return Объект или массив.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function process 'allow_not_set' predicate.
		*
		*	@param $ScriptLine - Script line.
		*
		*	@param $GlobalPredicates - Global predicates.
		*
		*	@param $Result - Script result.
		*
		*	@return Object or array.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	process_allow_not_set( $ScriptLine , $GlobalPredicates , $Result )
		{
			try
			{
				$Name = $ScriptLine[ 0 ];
				$Predicates = array_unique( array_merge( explode( ',' , $ScriptLine[ 1 ] ) , $GlobalPredicates ) );

				if( $this->allow_not_set( $Predicates ) )
				{
					$Default = $this->get_default( $Name , $Predicates );

					if( $Default !== false )
					{
						set_field( $Result , $Name , $Default );
					}
					return( $Result );
				}
				else
				{
					$ScriptLine = serialize( $ScriptLine );
					throw( new Exception( "Field \"$Name\" must be set, but it has not been set in $ScriptLine" ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция парсинга параметров запроса.
		*
		*	@param $Params - Параметры.
		*
		*	@param $ScriptLine - Строка скрипта.
		*
		*	@param $Result - Результат работы скрипта.
		*
		*	@param $GlobalPredicates - Глобальные предикаты.
		*
		*	@return Объект или массив.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function parses input parameters.
		*
		*	@param $Params - Parameters.
		*
		*	@param $ScriptLine - Script line.
		*
		*	@param $Result - Script result.
		*
		*	@param $GlobalPredicates - Global predicates.
		*
		*	@return Object or array.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	parse_value( $Params , $ScriptLine , $Result , $GlobalPredicates )
		{
			try
			{
				$Name = $ScriptLine[ 0 ];
				$Predicates = array_unique( array_merge( explode( ',' , $ScriptLine[ 1 ] ) , $GlobalPredicates ) );

				$Value = get_field( $Params , $Name );
				$Type = $this->SupportedDataTypes->get_type( $Predicates );
				$Alias = $this->get_alias( $Name , $Predicates );

				set_field( $Result , $Name , $this->Security->get( $Value , $Type ) );
				set_field( $Result , $Alias , get_field( $Result , $Name ) );
				
				return( $Result );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция парсинга параметров запроса.
		*
		*	@param $Params - Параметры.
		*
		*	@param $ScriptLine - Строка скрипта.
		*
		*	@param $Result - Результат работы скрипта.
		*
		*	@param $GlobalPredicates - Глобальные предикаты.
		*
		*	@return Объект или массив.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function parses input parameters.
		*
		*	@param $Params - Parameters.
		*
		*	@param $ScriptLine - Script line.
		*
		*	@param $Result - Script result.
		*
		*	@param $GlobalPredicates - Global predicates.
		*
		*	@return Object or array.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	parse_script_line( $Params , $ScriptLine , $Result , $GlobalPredicates )
		{
			try
			{
				$ScriptLine = explode( ':' , $ScriptLine );
				$Name = $ScriptLine[ 0 ];

				$ValueWasSet = is_field_set( $Params , $Name );
				if( $ValueWasSet === false )
				{
					$Result = $this->process_allow_not_set( $ScriptLine , $GlobalPredicates , $Result );
				}
				else
				{
					$Result = $this->parse_value( $Params , $ScriptLine , $Result , $GlobalPredicates );
				}

				return( $Result );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция парсинга параметров запроса.
		*
		*	@param $Params - Массив значений для парсинга.
		*
		*	@param $ParsingScript - Скрипт парсинга.
		*
		*	@param $GlobalPredicates - Глобальные предикаты.
		*
		*	@return Объект или массив.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function parses input parameters.
		*
		*	@param $Params - Array of values to parse.
		*
		*	@param $ParsingScript - Parsing script.
		*
		*	@param $GlobalPredicates - Global predicates.
		*
		*	@return Object or array.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			parse_parameters( $Params , $ParsingScript , $GlobalPredicates = '' )
		{
			try
			{
				if( $this->Security === false )
				{
					$this->Security = get_package( 'security' , 'last' , __FILE__ );
				}
				
				$GlobalPredicates = explode( ',' , $GlobalPredicates );
				
				$Result = new stdClass();
				
				$ParsingScript = str_replace( '#' , ';' , $ParsingScript );
				$Script = explode( ';' , $ParsingScript );
				
				foreach( $Script as $ScriptLine )
				{
					$Result = $this->parse_script_line( $Params , $ScriptLine , $Result , $GlobalPredicates );
				}
				
				return( $Result );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция парсинга параметров запроса.
		*
		*	@param $ParsingScript - Скрипт парсинга.
		*
		*	@param $mode - Тип результата, объект или функция
		*
		*	@return Объект или массив.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function parses input parameters.
		*
		*	@param $ParsingScript - Parsing script.
		*
		*	@return Object or array.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			parse_http_parameters( $ParsingScript )
		{
			try
			{				
				return( $this->parse_parameters( array_merge( $_GET , $_POST ) , $ParsingScript ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>