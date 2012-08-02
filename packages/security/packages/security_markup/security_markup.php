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
	*	\~russian Обработка страницы.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes generating page.
	*
	*	@author Dodonov A.A.
	*/
	class	security_markup_1_0_0{

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
		var					$Security = false;
		
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
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Загрузка пакетов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads packages.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	load_packages()
		{
			try
			{
				if( $this->String === false )
				{
					$this->String = get_package( 'string' , 'last' , __FILE__ );
				}
				if( $this->Settings === false )
				{
					$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				}
				if( $this->Security === false )
				{
					$this->Security = get_package( 'security' , 'last' , __FILE__ );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения значения.
		*
		*	@param $Name - Имя.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns value.
		*
		*	@param $Name - Name.
		*
		*	@param $Settings - Parameters.
		*
		*	@return Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_data_by_settings( $Name , &$Settings )
		{
			try
			{
				if( $Settings->get_setting( 'get' , false ) != false && $this->Security->get_g( $Name , 'set' ) )
				{
					return( $_GET );
				}
				elseif( $Settings->get_setting( 'post' , false ) != false && $this->Security->get_p( $Name , 'set' ) )
				{
					return( $_POST );
				}
				elseif( $Settings->get_setting( 'session' , false ) != false && 
							$this->Security->get_s( $Name , 'set' ) )
				{
					return( $_SESSION );
				}
				elseif( $Settings->get_setting( 'cookie' , false ) != false && $this->Security->get_c( $Name , 'set' ) )
				{
					return( $_COOKIE );
				}
				
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция получения значения.
		*
		*	@param $Name - Имя.
		*
		*	@param $Type - Тип.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Значение.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns value.
		*
		*	@param $Name - Name.
		*
		*	@param $Type - Type.
		*
		*	@param $Settings - Parameters.
		*
		*	@return Value.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_value( $Name , $Type , &$Settings )
		{
			try
			{
				$Data = $this->get_data_by_settings( $Name , $Settings );

				if( $Data === false )
				{
					return( $Settings->get_setting( 'default' , '' ) );
				}
				else
				{
					return( $this->Security->get( $Data[ $Name ] , $Type ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отвечающая за обработку строки.
		*
		*	@param $Settings - Параметры обработки.
		*
		*	@return Параметры.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes strings.
		*
		*	@param $Settings - Processing options.
		*
		*	@return Parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_page_parameters( &$Settings )
		{
			try
			{
				$JSON = get_package( 'json' , 'last' , __FILE__ );

				$Code = $JSON->encode( array_merge( $_GET , $_POST ) );
				$Code =	str_replace( "'" , '&#039;' , $Code );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отвечающая за обработку строки.
		*
		*	@param $Options - Параметры обработки.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return Обработанная строка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes strings.
		*
		*	@param $Options - Processing options.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return Processed string.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_string( $Options , $Str , &$Changed )
		{
			try
			{
				$this->load_packages();

				//TODO: move it to auto_markup
				
				$Limitations = array( 'default' => TERMINAL_VALUE );

				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'http_param' , $Limitations ) ; )
				{
					$this->Settings->load_settings( $Parameters );
					$Name = $this->Settings->get_setting( 'name' );
					$Type = $this->Settings->get_setting( 'type' , 'string' );

					$Value = $this->get_value( $Name , $Type , $this->Settings );

					$Str = str_replace( "{http_param:$Parameters}" , $Value , $Str );
					$Changed = true;
				}

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>