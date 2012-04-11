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
	*	\~russian Класс для работы с рекламной системой Sape.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides integration with the Sape system.
	*
	*	@author Dodonov A.A.
	*/
	class	sape_1_0_0{

		/**
		*	\~russian Закэшированные пакеты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$BlockSettings = false;
		var					$CachedMultyFS = false;
		var					$Settings = false;
		var					$String = false;
		
		/**
		*	\~russian Пользователь Sape.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Sape user.
		*
		*	@author Dodonov A.A.
		*/
		var					$SapeUser = false;
		
		/**
		*	\~russian Объект Sape для простых ссылок.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Sape object for common links.
		*
		*	@author Dodonov A.A.
		*/
		var					$SapeClient = false;
		
		/**
		*	\~russian Объект Sape для контекстных ссылок.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Sape object for context links.
		*
		*	@author Dodonov A.A.
		*/
		var					$SapeContext = false;

		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->BlockSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::package_settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );

				$this->SapeUser = $this->Settings->get_package_setting( 
					'sape' , 'last' , 'cf_sape' , 'sape_user' , false
				);
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
				require_once( "./$this->SapeUser/sape.php" );

				$Options['multi_site'] = true;
				$this->SapeClient = new SAPE_client( $Options );
				$this->SapeContext = new SAPE_context( $Options );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Вид для скриптовой библиотеки (отвечает за подключение библиотеки).
		*
		*	@param $Options - не используется.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english View for the scripting library.
		*
		*	@param $Options - not used.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( $Options )
		{
			try
			{
				return( '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отвечающая за обработку строки.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes string.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_sape_common_links( $Str , $Changed )
		{
			try
			{
				if( strpos( $Str , '{sape_common_links}' ) !== false )
				{
					$Str = str_replace( '{sape_common_links}' , '{sape_common_links:p=0}' , $Str );
				}

				for( ; $MacroParameters = $this->String->get_macro_parameters( $Str , 'sape_common_links' ) ; )
				{
					$this->BlockSettings->load_settings( $MacroParameters );

					$Count = $this->BlockSettings->get_setting( 'count' , null );
					$Links = $this->SapeClient->return_links( $Count );
					$Str = str_replace( "{sape_common_links:$MacroParameters}" , $Links , $Str );
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
		*	\~russian Функция компиляции макроса 'report_query'.
		*
		*	@param $MacroParameters - Параметры компиляции.
		*
		*	@param $Str - Строка для обработки.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'report_query'.
		*
		*	@param $MacroParameters - Compilation parameters.
		*
		*	@param $Str - String to process.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_sape_context_links( &$MacroParameters , $Str )
		{
			try
			{
				$Text = $this->String->get_block_data( 
					$Str , "sape_context_links:$MacroParameters" , '~sape_context_links'
				);

				return( $this->SapeContext->replace_in_text_segment( $Text ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отвечающая за обработку строки.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes string.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_sape_context_links( $Str , $Changed )
		{
			try
			{
				if( strpos( $Str , '{sape_context_links}' ) !== false )
				{
					$Str = str_replace( '{sape_context_links}' , '{sape_context_links:p=0}' , $Str );
				}

				for( ; $MacroParameters = $this->String->get_macro_parameters( $Str , 'sape_context_links' ) ; )
				{
					$Text = $this->compile_sape_context_links( $MacroParameters , $Str );

					$Str = $this->String->replace_block( 
						$Str , "sape_context_links:$MacroParameters" , '~sape_context_links' , $Text
					);
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
		*	\~russian Функция отвечающая за обработку строки.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return HTML код для отображения.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes string.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_string( $Options , $Str , &$Changed )
		{
			try
			{
				list( $Str , $Changed ) = $this->process_sape_common_links( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_sape_context_links( $Str , $Changed );
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>