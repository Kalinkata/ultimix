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
	*	\~russian Класс для отрисовки контролов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class draws controls.
	*
	*	@author Dodonov A.A.
	*/
	class	gui_1_0_0{

		/**
		*	\~russian Набор переменных.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Set of variables.
		*
		*	@author Dodonov A.A.
		*/
		var					$Vars = array();

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
		var					$PageParser = false;
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
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->PageParser = get_package( 'page::page_parser' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция установки переменной.
		*
		*	@param $VarName - Название переменной.
		*
		*	@param $VarValue - Значение переменной.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets variable.
		*
		*	@param $VarName - Variable name.
		*
		*	@param $VarValue - Variable value.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_var( $VarName , $VarValue )
		{
			try
			{
				$this->Vars[ $VarName ] = $VarValue;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция предгенерационных действий.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function executes before any page generating actions took place.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			pre_generation( $Options )
		{
			try
			{
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'set_var'.
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
		*	\~english Function processes macro 'set_var'.
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
		function			process_set_var( $Str , $Changed )
		{
			try
			{
				$Rules = array( 'name' => TERMINAL_VALUE , 'value' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'set_var' , $Rules ) ; )
				{
					$this->Settings->load_settings( $Parameters );
					
					$Name = $this->Settings->get_setting( 'name' );
					$Value = $this->Settings->get_setting( 'value' );
					
					$Str = str_replace( "{set_var:$Parameters}" , '' , $Str );
					
					$this->Vars[ $Name ] = $Value;

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
		*	\~russian Функция обработки макроса 'get_var'.
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
		*	\~english Function processes macro 'get_var'.
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
		function			process_get_var( $Str , $Changed )
		{
			try
			{
				$Rules = array( 'name' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'get_var' , $Rules ) ; )
				{
					$this->Settings->load_settings( $Parameters );
					
					$Name = $this->Settings->get_setting( 'name' );
					$Value = isset( $this->Vars[ $Name ] ) ? 
						$this->Vars[ $Name ] : 
						$this->Settings->get_setting( 'default' , '' );

					$Str = str_replace( "{get_var:$Parameters}" , $Value , $Str );

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
		*	\~russian Функция обработки макроса 'date'.
		*
		*	@param $Settings - Параметры обработки.
		*
		*	@return Значение.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'date'.
		*
		*	@param $Settings - Processing parameters.
		*
		*	@return Value.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_date_value( &$Settings )
		{
			try
			{
				$Format = $Settings->get_setting( 'format' , 'Y-m-d' );

				if( $Settings->get_setting( 'value' , false ) !== false )
				{
					$Now = $Settings->get_setting( 'now' , time() );
					$Value = date( $Format , strtotime( $Settings->get_setting( 'value' , 'now' ) , $Now ) );
				}
				else
				{
					$Value = date( $Format , intval( $Settings->get_setting( 'timestamp' , time() ) ) );
				}

				return( $Value );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'date'.
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
		*	\~english Function processes macro 'date'.
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
		function			process_date( $Str , $Changed )
		{
			try
			{
				$Rules = array( 'value' => TERMINAL_VALUE , 'timestamp' => TERMINAL_VALUE , 'now' => TERMINAL_VALUE );

				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'date' , $Rules ) ; )
				{
					$this->Settings->load_settings( $Parameters );

					$Value = $this->get_date_value( $this->Settings );

					$Str = str_replace( "{date:$Parameters}" , $Value , $Str );
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
		*	\~russian Функция обработки макроса 'composer'.
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
		*	\~english Function processes macro 'composer'.
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
		function			process_composer( $Str , $Changed )
		{
			try
			{
				$Rules = array( 'condition' => TERMINAL_VALUE );
				
				for( ; $this->PageParser->find_next_macro( $Str , 'composer' , $Rules ) ; )
				{
					$Settings = &$this->PageParser->get_macro_parameters();
					$Condition = intval( $Settings->get_setting( 'condition' ) );

					if( $Condition )
					{
						$Str = $this->PageParser->show_macro( $Str , 'composer' );
					}
					else
					{
						$Str = $this->PageParser->hide_macro( $Str , 'composer' );
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
				list( $Str , $Changed ) = $this->process_set_var( $Str , $Changed );
				list( $Str , $Changed ) = $this->process_get_var( $Str , $Changed );
				list( $Str , $Changed ) = $this->process_date( $Str , $Changed );
				list( $Str , $Changed ) = $this->process_composer( $Str , $Changed );
				$Str = str_replace( '{locked}' , 'onkeypress="return( false );"' , $Str );
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция конвертации объекта в строку.
		*
		*	@return Строка с описанием объекта.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function converts object to string.
		*
		*	@return String with the object's description.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__toString()
		{
			try
			{
				return( "" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>