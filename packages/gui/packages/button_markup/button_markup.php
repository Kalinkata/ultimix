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
	*	\~russian Класс обработки макросов кнопок.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes buttons macro.
	*
	*	@author Dodonov A.A.
	*/
	class	button_markup_1_0_0
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
		var					$Settings = false;
		var					$CachedMultyFS = false;
		var					$PageJS = false;
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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
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
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function executes before any page generating actions took place.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			pre_generation( $Options )
		{
			try
			{
				$Path = "{http_host}/"._get_package_relative_path_ex( 'gui::button_markup' , 'last' );
				$this->PageJS->add_javascript( "$Path/include/js/button_markup.js" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'component_button'.
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
		*	\~english Function processes macro 'component_button'.
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
		private function	compile_component_button( &$Settings )
		{
			try
			{
				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'component_button.tpl' );
				$Code = $this->String->print_record( $Code , $Settings->get_raw_settings() );

				$PackageName = $Settings->get_setting( 'package_name' );
				$PackageVersion = $Settings->get_setting( 'package_version' , 'last' );
				$PathToPackage = _get_package_relative_path_ex( $PackageName , $PackageVersion );
				$Icon = $Settings->get_setting( 'icon' );
				$Code = str_replace( '{path_to_image}' , $PathToPackage."/res/images/$Icon" , $Code );
				
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'component_button'.
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
		*	\~english Function processes macro 'component_button'.
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
		function			process_component_button( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'icon' => TERMINAL_VALUE );

				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'component_button' , $Limitations ) ; )
				{
					$this->Settings->load_settings( $Parameters );
					$this->Settings->set_undefined( 'label' , 'label' );
					$this->Settings->set_undefined( 'size' , '42' );
					$this->Settings->set_undefined( 'package_version' , 'last' );

					$Code = $this->compile_component_button( $this->Settings );

					$Str = str_replace( "{component_button:$Parameters}" , $Code , $Str );
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
		*	\~russian Функция компиляции макроса 'menu_button'.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'menu_button'.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_menu_button( &$Settings )
		{
			try
			{
				$Icon = $Settings->get_setting( 'icon' );

				$PackageName = $Settings->get_setting( 'package_name' );
				$PackageVersion = $Settings->get_setting( 'package_version' , 'last' );

				$PathToPackage = _get_package_relative_path_ex( $PackageName , $PackageVersion );

				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'menu_button.tpl' );

				$Code = $this->String->print_record( $Code , $Settings->get_raw_settings() );

				return( str_replace( '{path_to_image}' , $PathToPackage."/res/images/$Icon" , $Code ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'menu_button'.
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
		*	\~english Function processes macro 'menu_button'.
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
		function			process_menu_button( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'icon' => TERMINAL_VALUE );
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'menu_button' , $Limitations ) ; )
				{
					$this->Settings->load_settings( $Parameters );
					$this->Settings->set_undefined( 'size' , 24 );
					$this->Settings->set_undefined( 'package_version' , 'last' );
					$this->Settings->set_undefined( 'permit' , 'admin' );

					$Code = $this->compile_menu_button( $this->Settings );

					$Str = str_replace( "{menu_button:$Parameters}" , $Code , $Str );
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
		*	\~russian Функция компиляции кнопки.
		*
		*	@param $Settings - Параметры.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles button.
		*
		*	@param $Settings - Parameters.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	set_default_data_for_toolbar_button( &$Settings )
		{
			try
			{
				$Settings->set_undefined( 'title' , '' );
				$Settings->set_undefined( 'size' , 24 );
				$Settings->set_undefined( 'permit' , 'admin' );
				$Settings->set_undefined( 'package_version' , 'last' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции кнопки.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Скомпилированная кнопка.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles button.
		*
		*	@param $Settings - Parameters.
		*
		*	@return Compiled button.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_toolbar_button( &$Settings )
		{
			try
			{
				$Icon = $Settings->get_setting( 'icon' );
				$PackageName = $Settings->get_setting( 'package_name' );
				$PackageVersion = $Settings->get_setting( 'package_version' , 'last' );
				$PathToPackage = _get_package_relative_path_ex( $PackageName , $PackageVersion );

				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'toolbar_button.tpl' );
				$Code = $this->String->print_record( $Code , $Settings->get_raw_settings() );
				$Code = str_replace( '{path_to_image}' , $PathToPackage."/res/images/$Icon" , $Code );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'toolbar_button'.
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
		*	\~english Function processes macro 'toolbar_button'.
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
		function			process_toolbar_button( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'icon' => TERMINAL_VALUE );

				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'toolbar_button' , $Limitations ) ; )
				{
					$this->Settings->load_settings( $Parameters );

					$this->set_default_data_for_toolbar_button( $this->Settings );

					$Code = $this->compile_toolbar_button( $this->Settings );

					$Str = str_replace( "{toolbar_button:$Parameters}" , $Code , $Str );
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
		*	\~russian Функция компиляции кнопки.
		*
		*	@param $Code - Код кнопки.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Скомпилированная кнопка.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles button.
		*
		*	@param $Code - Button code.
		*
		*	@param $Settings - Parameters.
		*
		*	@return Compiled button.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	set_toggle_button_icons( $Code , &$Settings )
		{
			try
			{
				$PathToPackage = _get_package_relative_path_ex( 
					$Settings->get_setting( 'package_name' ) , $Settings->get_setting( 'package_version' , 'last' )
				);

				$Value = $Settings->get_setting( 'value' , 0 );
				$Icon = $Settings->get_setting( $Value ? 'icon' : 'icon_toggle' );
				$IconToggle = $Settings->get_setting( $Value ? 'icon_toggle' : 'icon' );
				$ToggleFunc = $Settings->get_setting( 'toggle_func' );

				$Func = "ultimix.button_markup.ToggleButton( this , '$Icon' , '$IconToggle' , $ToggleFunc );";
				$Code = str_replace( 
					array( '{path_to_image}' , '{func}' , '{icon}' , '{icon_toggle}' ) , 
					array( $PathToPackage."/res/images/$Icon" , $Func , $Icon , $IconToggle ) , $Code
				);

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции кнопки.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Скомпилированная кнопка.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles button.
		*
		*	@param $Settings - Parameters.
		*
		*	@return Compiled button.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_toggle_button( &$Settings )
		{
			try
			{
				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'toggle_button.tpl' );
				$Code = $this->String->print_record( $Code , $Settings->get_raw_settings() );
				
				$Code = $this->set_toggle_button_icons( $Code , $Settings );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'toggle_button'.
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
		*	\~english Function processes macro 'toggle_button'.
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
		function			process_toggle_button( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'icon' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'toggle_button' , $Limitations ) ; )
				{
					$this->Settings->load_settings( $Parameters );

					$this->set_default_data_for_toolbar_button( $this->Settings );

					$Code = $this->compile_toggle_button( $this->Settings );

					$Str = str_replace( "{toggle_button:$Parameters}" , $Code , $Str );
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
				list( $Str , $Changed ) = $this->process_component_button( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_menu_button( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_toolbar_button( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_toggle_button( $Str , $Changed );
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>