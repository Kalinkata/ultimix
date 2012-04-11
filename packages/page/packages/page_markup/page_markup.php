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
	*	\~russian Класс обработки макросов страницы.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes page's macro.
	*
	*	@author Dodonov A.A.
	*/
	class	page_markup_1_0_0
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
		var					$PageMarkupUtilities = false;
		var					$PageParser = false;
		var					$PageParts = false;
		var					$Security = false;
		var					$Settings = false;
		var					$String = false;
		var					$Trace = false;

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
				$this->PageMarkupUtilities = get_package( 
					'page::page_markup::page_markup_utilities' , 'last' , __FILE__
				);
				$this->PageParser = get_package( 'page::page_parser' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Trace = get_package( 'trace' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса direct_controller.
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
		*	\~english Function processes macro direct_controller.
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
		function			process_direct_controller( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'need_run' => TERMINAL_VALUE );

				for( ; $Params = $this->String->get_macro_parameters( $Str , 'direct_controller' , $Limitations ) ; )
				{
					$this->Settings->load_settings( $Params );

					if( $this->Settings->get_setting( 'need_run' , 1 ) == 1 )
					{
						$this->PageMarkupUtilities->direct_controller( $this->Settings );
					}

					$Str = str_replace( "{direct_controller:$Params}" , '' , $Str );
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
		*	\~russian Функция обработки макроса direct_view.
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
		*	\~english Function processes macro direct_view.
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
		function			process_direct_view( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'need_run' => TERMINAL_VALUE );
				
				for( ; $Params = $this->String->get_macro_parameters( $Str , 'direct_view' , $Limitations ) ; )
				{
					$this->Settings->load_settings( $Params );
					
					$ViewCode = '';
					if( $this->Settings->get_setting( 'need_run' , 1 ) == 1 )
					{
						$ViewCode = $this->PageMarkupUtilities->direct_view( $this->Settings );
					}
					
					$Str = str_replace( "{direct_view:$Params}" , $ViewCode , $Str );
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
		*	\~russian Функция обработки макроса 'redirect'.
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
		*	\~english Function processes macro 'redirect'.
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
		function			process_redirect( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'page' => TERMINAL_VALUE , 'need_redirect' => TERMINAL_VALUE );

				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'redirect' , $Limitations ) ; )
				{
					$this->Settings->load_settings( $Parameters );
					$NeedRedirect = intval( $this->Settings->get_setting( 'need_redirect' , 1 ) );

					if( $NeedRedirect )
					{
						header( 'Location: '.$this->Settings->get_setting( 'page' ) );
						exit( 0 );
					}

					$Str = str_replace( "{redirect:$Parameters}" , '' , $Str );
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
		*	\~russian Функция обработки макроса 'safe'.
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
		*	\~english Function processes macro 'safe'.
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
		function			process_safe( $Str , $Changed )
		{
			try
			{
				for( ; $this->String->block_exists( $Str , 'safe' , '~safe' ) !== false ; )
				{
					$BlockData = $this->String->get_block_data( $Str , 'safe' , '~safe' );
					
					$NewBlockData = $this->Security->get( $BlockData , 'string' );
					
					$Str = str_replace( "{safe}$BlockData{~safe}" , $NewBlockData , $Str );
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
		*	\~russian Функция обработки макроса 'unsafe'.
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
		*	\~english Function processes macro 'unsafe'.
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
		function			process_unsafe( $Str , $Changed )
		{
			try
			{
				for( ; $this->String->block_exists( $Str , 'unsafe' , '~unsafe' ) !== false ; )
				{
					$BlockData = $this->String->get_block_data( $Str , 'unsafe' , '~unsafe' );
					
					$NewBlockData = $this->Security->get( $BlockData , 'unsafe_string' );
					
					$Str = str_replace( "{unsafe}$BlockData{~unsafe}" , $NewBlockData , $Str );
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
		*	\~russian Функция обработки макросов.
		*
		*	@param $Names - Литералы.
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
		*	\~english Function processes macro.
		*
		*	@param $Names - Literals.
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
		function			process_common_literals( $Names , $Str , $Changed )
		{
			try
			{
				foreach( $Names as $i => $Name )
				{
					if( strpos( $Str , '{'.$Name.'}' ) !== false )
					{
						$Code = "{settings:package_name=page::page_composer;name=$Name;config_file_name=cf_site}";
						
						$Str = str_replace( '{'.$Name.'}' , $Code , $Str );
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
		*	@param $Names - Литералы.
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
		*	\~english Function processes macro.
		*
		*	@param $Names - Literals.
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
		function			process_front_page_literals( $Names , $Str , $Changed )
		{
			try
			{
				if( $this->Security->get_gp( 'page_name' , 'command' ) != 'index' )
				{
					return( array( $Str , $Changed ) );
				}
				
				foreach( $Names as $i => $Name )
				{
					if( strpos( $Str , '{'.$Name.'}' ) !== false )
					{
						$Code = '<h1>{settings:package_name=page::page_composer;name='.$Name.
								';config_file_name=cf_site}</h1>';
						
						$Str = str_replace( '{'.$Name.'}' , $Code , $Str );
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
		*	\~english Function processes macro.
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
		function			process_literals( $Str , $Changed )
		{
			try
			{
				$Literals = array( 'site_title' , 'welcome_text_title' , 'welcome_text_demo' , 'company_name' );
				list( $Str , $Changed ) = $this->process_common_literals( $Literals , $Str , $Changed );

				$FrontPageLiterals = array( 'front_page_welcome_title' , 'front_page_welcome_text' );
				list( $Str , $Changed ) = $this->process_front_page_literals( $FrontPageLiterals , $Str , $Changed );

				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки блоков 'for_pages/not_for_pages'.
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
		*	\~english Function processes block 'for_pages/not_for_pages'.
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
		private function	process_pages_block( $Name , $Str , $Changed )
		{
			try
			{
				$Rules = array( 'pages' => TERMINAL_VALUE );
				
				for( ; $this->PageParser->find_next_macro( $Str , $Name , $Rules ) ; )
				{
					$this->Settings = $this->PageParser->get_macro_parameters();

					$Pages = explode( ',' ,  $this->Settings->get_setting( 'pages' ) );

					$PageName = $this->Security->get_gp( 'page_name' , 'command' );

					$Flag = $Name == 'for_pages' ? in_array( $PageName , $Pages ) : !in_array( $PageName , $Pages );

					$Str = $this->PageParser->process_macro( $Flag ? 'show' : 'hide' , $Str , $Name );
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
		*	\~russian Функция выполнения мета данных.
		*
		*	@param $MetaSettings - Мета данные.
		*
		*	@return Строка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function runs meta.
		*
		*	@param $MetaSettings - Meta data.
		*
		*	@return String.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	run_meta_settings( &$MetaSettings , $Str )
		{
			try
			{
				$Settings = $MetaSettings->get_all_settings();
				$Code = '';
				if( $MetaSettings->get_setting( 'controller' , '0' ) != '0' )
				{
					$Code = "{direct_controller:$Settings}";
				}
				elseif( $MetaSettings->get_setting( 'view' , '0' ) != '0' )
				{
					$Code = "{direct_view:$Settings}";
				}
				elseif( $MetaSettings->get_setting( 'post_process' , '0' ) != '0' )
				{
					$PageParts = get_package( 'page::page_parts' , 'last' , __FILE__ );
					$Str = $PageParts->execute_processors( $Str , 'post_process' );
				}
				$Str = str_replace( "{meta:$Parameters}" , $Code , $Str );
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция загрузки мета данных.
		*
		*	@param $MacroSettings - Настройки работы модуля.
		*
		*	@param $MetaSettings - Мета данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads meta.
		*
		*	@param $MacroSettings - Settings.
		*
		*	@param $MetaSettings - Meta data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	load_meta_settings( &$MacroSettings , &$MetaSettings )
		{
			try
			{
				$PackageName = $MacroSettings->get_setting( 'package_name' );
				$PackageVersion = $MacroSettings->get_setting( 'package_version' , 'last' );
				
				$MetaFile = _get_package_relative_path_ex( $PackageName , $PackageVersion );
				$MeatFile .= '/meta/'.$MacroSettings->get_setting( 'name' );

				$MetaSettings->load_file( $MetaFile );
				
				$MetaSettings->set_setting( 'package_name' , $PackageName );
				$MetaSettings->set_setting( 'package_version' , $PackageVersion );
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
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
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
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_meta( $Options , $Str , &$Changed )
		{
			try
			{
				if( strpos( $Str , '{page_name}' ) !== false )
				{
					$Str = str_replace( '{page_name}' , $this->Security->get_gp( 'page_name' , 'string' ) , $Str );
				}
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'meta' ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );

					$MetaSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
					$this->load_meta_settings( $this->MacroSettings , $MetaSettings );
					
					$Str = $this->run_meta_settings( $MetaSettings , $Str );
					$Changed = true;
				}
				
				return( $Str );
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
				list( $Str , $Changed ) = $this->process_redirect( $Str , $Changed );

				list( $Str , $Changed ) = $this->process_safe( $Str , $Changed );

				list( $Str , $Changed ) = $this->process_unsafe( $Str , $Changed );

				list( $Str , $Changed ) = $this->process_literals( $Str , $Changed );

				list( $Str , $Changed ) = $this->process_pages_block( 'for_pages' , $Str , $Changed );

				list( $Str , $Changed ) = $this->process_pages_block( 'not_for_pages' , $Str , $Changed );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>