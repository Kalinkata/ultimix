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
	*	\~russian Класс для управления компонентом.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english View.
	*
	*	@author Dodonov A.A.
	*/
	class	auto_markup_1_0_0{
		
		/**
		*	\~russian Закэшированный объект.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached object.
		*
		*	@author Dodonov A.A.
		*/
		var					$CachedMultyFS = false;
		var					$Config = false;
		var					$MacroSettings = false;
		var					$StaticContentAccess = false;
		var					$String = false;
		var					$Utilities = false;
		
		/**
		*	\~russian Конфиги.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Configs.
		*
		*	@author Dodonov A.A.
		*/
		var					$StaticContentConfigs = false;
		
		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Config = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->MacroSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->TemplateContentAccess = get_package( 
					'page::template_content::template_content_access' , 'last' , __FILE__
				);
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Utilities = get_package( 'utilities' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Загрузка конфигов.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads configs.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	load_static_contents_configs()
		{
			try
			{
				if( $this->StaticContentConfigs === false )
				{
					$this->StaticContentConfigs = $this->CachedMultyFS->get_config( __FILE__ , 'cf_static_contents' );
					$this->StaticContentConfigs = explode( "\n" , $this->StaticContentConfigs );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки параметризованных макросов.
		*
		*	@param $Config - Настройки работы модуля.
		*
		*	@param $MacroSettings - Параметры макроса.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes parametrized macroes.
		*
		*	@param $Config - Settings.
		*
		*	@param $MacroSettings - Macro settings.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_macro( &$Config , &$MacroSettings )
		{
			try
			{
				if( $Config->get_setting( 'content' , false ) )
				{
					$Content = $this->TemplateContentAccess->get_content_ex( $Config );
					// TODO auto_fit_div script and place it in the tab creation method
				}
				else
				{
					$Package = $this->Utilities->get_package( $Config , __FILE__ );
					$Function = $Config->get_setting( 'compilation_func' , false );
					$Content = call_user_func( array( $Package , $Function ) , $MacroSettings );
				}

				if( $MacroSettings !== false )
				{
					$Content = $this->String->print_record( $Content , $MacroSettings->get_raw_settings() );
				}

				return( $Content );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки простых макросов.
		*
		*	@param $Options - Настройки работы модуля.
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
		*	\~english Function processes simple macroes.
		*
		*	@param $Options - Settings.
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
		private function	process_simple_macroes( &$Options , $Str , $Changed )
		{
			try
			{
				foreach( $this->StaticContentConfigs as $k => $v )
				{
					$this->Config->load_settings( $v );
					$Name = $this->Config->get_setting( 'name' );

					if( strpos( $Str , '{'.$Name.'}' ) !== false )
					{
						$MacroSettings = false;
						$Content = $this->compile_macro( $this->Config , $MacroSettings );
						$Str = str_replace( '{'.$Name.'}' , $Content , $Str );
						$Changed = true;
					}
				}

				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки параметризованных макросов.
		*
		*	@param $Options - Настройки работы модуля.
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
		*	\~english Function processes parametrized macroes.
		*
		*	@param $Options - Settings.
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
		private function	process_parametrized_macroes( &$Options , $Str , $Changed )
		{
			try
			{
				foreach( $this->StaticContentConfigs as $k => $v )
				{
					$this->Config->load_settings( $v );
					$Name = $this->Config->get_setting( 'name' );

					for( ; $Parameters = $this->String->get_macro_parameters( $Str , $Name ) ; )
					{
						$this->MacroSettings->load_settings( $Parameters );

						$Content = $this->compile_macro( $this->Config , $this->MacroSettings );

						$Str = str_replace( '{'."$Name:$Parameters".'}' , $Content , $Str );
						$Changed = true;
					}
				}

				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макросов.
		*
		*	@param $Options - Настройки работы модуля.
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
		*	\~english Function processes macroes.
		*
		*	@param $Options - Settings.
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
		function			process_static_contents( &$Options , $Str , $Changed )
		{
			try
			{
				$this->load_static_contents_configs();

				if( $this->StaticContentConfigs != '' )
				{
					list( $Str , $Changed ) = $this->process_simple_macroes( $Options , $Str , $Changed );

					list( $Str , $Changed ) = $this->process_parametrized_macroes( $Options , $Str , $Changed );
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
		function			process_string( &$Options , $Str , &$Changed )
		{
			try
			{
				list( $Str , $Changed ) = $this->process_static_contents( $Options , $Str , $Changed );

				return( $Str );return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>