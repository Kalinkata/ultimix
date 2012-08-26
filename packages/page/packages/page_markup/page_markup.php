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
		var					$PageMarkupUtilities = false;
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
				$this->PageMarkupUtilities = get_package( 
					'page::page_markup::page_markup_utilities' , 'last' , __FILE__
				);
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'direct_controller'.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return Widget.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'direct_controller'.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_direct_controller( &$Settings )
		{
			try
			{
				if( $Settings->get_setting( 'need_run' , 1 ) == 1 )
				{
					$this->PageMarkupUtilities->direct_controller( $Settings );
				}

				return( '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'error_messages'.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return Widget.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'error_messages'.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_direct_view( &$Settings )
		{
			try
			{
				$this->Security->reset_s( 'direct_view' , true );

				$Settings->set_undefined( 'view' , 1 );

				$Code = '';
				if( $Settings->get_setting( 'need_run' , 1 ) == 1 )
				{
					$Code = $this->PageMarkupUtilities->direct_view( $Settings );
				}

				$this->Security->reset_s( 'direct_view' , false );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'redirect'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'redirect'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_redirect( &$Settings )
		{
			try
			{
				$NeedRedirect = intval( $Settings->get_setting( 'need_redirect' , 1 ) );

				if( $NeedRedirect )
				{
					header( 'Location: '.$Settings->get_setting( 'page' ) );
					exit( 0 );
				}

				return( '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'safe'.
		*
		*	@param $Settings - Параметры.
		*
		*	@param $Data - Данные.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'safe'.
		*
		*	@param $Settings - Parameters.
		*
		*	@param $Data - Данные.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_safe( &$Settings , $Data )
		{
			try
			{
				return( $this->Security->get( $Data , 'string' ) );
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
		function			compile_common_literals( $Names , $Str , $Changed )
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
		function			compile_front_page_literals( $Names , $Str , $Changed )
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
		*	\~russian Функция компиляции макроса 'for_pages'.
		*
		*	@param $Settings - Параметры.
		*
		*	@param $Data - Данные.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'for_pages'.
		*
		*	@param $Settings - Parameters.
		*
		*	@param $Data - Данные.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_for_pages( $Settings , $Data )
		{
			try
			{
				$Pages = explode( ',' ,  $Settings->get_setting( 'pages' ) );

				$PageName = $this->Security->get_gp( 'page_name' , 'command' );

				if( in_array( $PageName , $Pages ) )
				{
					return( $Data );
				}

				return( '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'for_pages'.
		*
		*	@param $Settings - Параметры.
		*
		*	@param $Data - Данные.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'for_pages'.
		*
		*	@param $Settings - Parameters.
		*
		*	@param $Data - Данные.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_not_for_pages( $Settings , $Data )
		{
			try
			{
				$Pages = explode( ',' ,  $Settings->get_setting( 'pages' ) );

				$PageName = $this->Security->get_gp( 'page_name' , 'command' );

				if( !in_array( $PageName , $Pages ) )
				{
					return( $Data );
				}

				return( '' );
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
					$AutoMarkup = get_package( 'page::auto_markup' , 'last' , __FILE__ );
					$Str = $AutoMarkup->compile_string( $Str );
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
		*	\~russian Функция компиляции макроса 'meta'.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return Widget.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'meta'.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_meta( &$Settings )
		{
			try
			{
				$MetaSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->load_meta_settings( $Settings , $MetaSettings );

				$Str = $this->run_meta_settings( $MetaSettings , $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>