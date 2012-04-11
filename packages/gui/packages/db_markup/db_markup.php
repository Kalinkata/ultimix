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
	*	\~russian Класс обработки макросов доступа к данным.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes data access macro.
	*
	*	@author Dodonov A.A.
	*/
	class	db_markup_1_0_0
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
		var					$Database = false;
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
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->MacroSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения значения поля из записи.
		*
		*	@param $MacroSettings - Параметры извлечения.
		*
		*	@return Значение поля.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns field value.
		*
		*	@param $MacroSettings - Extraction parameters.
		*
		*	@return Field value.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_query_field( &$MacroSettings )
		{
			try
			{
				$Result = $this->Database->query( $MacroSettings->get_setting( 'query' ) );
				$Result = $this->Database->fetch_results( $Result );
				if( isset( $Result[ 0 ] ) )
				{
					$Result = $Result[ 0 ];
				}
				else
				{
					throw( new Exception( "No data found for the query \"$Query\"" ) );
				}
				
				return( get_field( $Result , $MacroSettings->get_setting( 'field' ) ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'query_field'.
		*
		*	@param $Str - Строка требующая обработки.
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
		*	\~english Function processes macro 'query_field'.
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
		function			process_query_field( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'field' => TERMINAL_VALUE , 'query' => TERMINAL_VALUE );
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'query_field' , $Limitations ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );
					
					$Value = $this->get_query_field( $this->MacroSettings );
					
					$Str = str_replace( "{query_field:$Parameters}" , $Value , $Str );
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
		*	\~russian Функция получения значения поля из записи.
		*
		*	@param $MacroSettings - Параметры извлечения.
		*
		*	@return Значение поля.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns field value.
		*
		*	@param $MacroSettings - Extraction parameters.
		*
		*	@return Field value.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_record_field( &$MacroSettings )
		{
			try
			{
				$Value = '';
				$id = $MacroSettings->get_setting( 'id' );
				if( $id != '0' )
				{
					$PackageName = $MacroSettings->get_setting( 'access_package_name' );
					$PackageVersion = $MacroSettings->get_setting( 'access_package_version' , 'last' );
					$PackageObject = get_package( $PackageName , $PackageVersion , __FILE__ );
				
					$Record = call_user_func( array( $PackageObject , 'get_by_id' ) , $id );
					
					$Field = $MacroSettings->get_setting( 'field' );
					$Value = get_field( $Record , $Field );
				}
				
				return( $Value );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'record_field'.
		*
		*	@param $Str - Строка требующая обработки.
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
		*	\~english Function processes macro 'record_field'.
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
		function			process_record_field( $Str , $Changed )
		{
			try
			{
				for( ; ( $Parameters = $this->String->get_macro_parameters( $Str , 'record_field' , 
							array( 'access_package_name' => TERMINAL_VALUE , 'field' => TERMINAL_VALUE , 
							'access_package_version' => TERMINAL_VALUE , 'id' => TERMINAL_VALUE ) ) ) !== false ; )
				{
					$this->MacroSettings->load_settings( $Parameters );
					
					$Value = $this->get_record_field( $this->MacroSettings );
					
					$Str = str_replace( "{record_field:$Parameters}" , $Value , $Str );
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
		*	@param $Str - Строка требующая обработки.
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
				list( $Str , $Changed ) = $this->process_record_field( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_query_field( $Str , $Changed );
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>