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
		var					$CachedMultyFS = false;
		var					$PageJS = false;
		var					$String = false;
		var					$Utilities = false;
		
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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Utilities = get_package( 'utilities' , 'last' , __FILE__ );
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
		function			compile_component_button( &$Settings )
		{
			try
			{
				$Settings->set_undefined( 'label' , 'label' );
				$Settings->set_undefined( 'size' , '42' );
				$Settings->set_undefined( 'package_version' , 'last' );

				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'component_button.tpl' );
				$Code = $this->String->print_record( $Code , $Settings->get_raw_settings() );

				$Path = $this->Utilities->get_package_path( $Settings );

				$Icon = $Settings->get_setting( 'icon' );
				$Code = str_replace( '{path_to_image}' , "$Path/res/images/$Icon" , $Code );

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
				$Settings->set_undefined( 'page' , 'javascript:void(0);' );

				$OnClick = $Settings->get_setting( 'onclick' , false );
				if( $OnClick === false )
				{
					$Settings->set_setting( 'onclick' , '' );
				}
				else
				{
					$Settings->set_setting( 'onclick' , 'onclick="'.$OnClick.'" ' );
				}
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
		function			compile_menu_button( &$Settings )
		{
			try
			{
				$this->set_default_data_for_toolbar_button( $Settings );

				$Icon = $Settings->get_setting( 'icon' );

				$Path = $this->Utilities->get_package_path( $Settings );

				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'menu_button.tpl' );

				$Code = $this->String->print_record( $Code , $Settings->get_raw_settings() );

				return( str_replace( '{path_to_image}' , "$Path/res/images/$Icon" , $Code ) );
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
		function			compile_toolbar_button( &$Settings )
		{
			try
			{
				$this->set_default_data_for_toolbar_button( $Settings );

				$Icon = $Settings->get_setting( 'icon' );

				$Path = $this->Utilities->get_package_path( $Settings );

				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'toolbar_button.tpl' );
				$Code = $this->String->print_record( $Code , $Settings->get_raw_settings() );
				$Code = str_replace( '{path_to_image}' , "$Path/res/images/$Icon" , $Code );

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
				$Path = $this->Utilities->get_package_path( $Settings );

				$Value = $Settings->get_setting( 'value' , 0 );
				$Icon = $Settings->get_setting( $Value ? 'icon' : 'icon_toggle' );
				$IconToggle = $Settings->get_setting( $Value ? 'icon_toggle' : 'icon' );

				$ToggleFunc = $Settings->get_setting( 'toggle_func' );

				$Func = "ultimix.button_markup.ToggleButton( this , '$Icon' , '$IconToggle' , $ToggleFunc );";
				$Code = str_replace( 
					array( '{path_to_image}' , '{func}' , '{icon}' , '{icon_toggle}' ) , 
					array( "$Path/res/images/$Icon" , $Func , $Icon , $IconToggle ) , $Code
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
		function			compile_toggle_button( &$Settings )
		{
			try
			{
				$this->set_default_data_for_toolbar_button( $Settings );

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
		*	\~russian Функция компиляции кнопки 'run_controller_and_remove_dom_button'.
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
		*	\~english Function compiles buttonv.
		*
		*	@param $Settings - Parameters.
		*
		*	@return Compiled button.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_run_controller_and_remove_dom_button( &$Settings )
		{
			try
			{
				$this->set_default_data_for_toolbar_button( $Settings );

				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'run_controller_and_remove_dom_button.tpl' );

				$Code = $this->String->print_record( $Code , $Settings->get_raw_settings() );

				$Path = $this->Utilities->get_package_path( $Settings );

				$Icon = $Settings->get_setting( 'icon' );

				$Code = str_replace( '{path_to_image}' , $Path."/res/images/$Icon" , $Code );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>