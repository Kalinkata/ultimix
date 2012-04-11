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
	*	\~russian Класс обработки макросов файловой системы.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes file system macro.
	*
	*	@author Dodonov A.A.
	*/
	class	fs_markup_1_0_0
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
		var					$MacroSettings = false;
		var					$String = false;
		var					$TemplateManager = false;

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
				$this->MacroSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->TemplateManager = get_package( 'template_manager' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'basename'.
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
		*	\~english Function processes macro 'basename'.
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
		function			process_basename( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'basename' ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );
					
					$Str = str_replace( 
						"{basename:$Parameters}" , 
						basename( $this->MacroSettings->get_setting( 'value' ) ) , 
						$Str
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
		*	\~russian Функция возвращает путь к шаблону страницы.
		*
		*	@return Путь к шаблону страницы.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns path to the template package.
		*
		*	@return Path to the page's template.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_template_path()
		{
			try
			{
				return( $this->TemplateManager->get_template_path( $this->TemplateName , $this->TemplateVersion ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции макроса 'image_path'.
		*
		*	@return Путь.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'image_path'.
		*
		*	@return Path.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_path_from_template()
		{
			try
			{
				$TemplatePath = $this->get_template_path();
				$RealFilePath = $this->CachedMultyFS->get_file_path( 
					$TemplatePath."/res/images/$FileName" , false
				);
				if( $RealFilePath === false )
				{
					$PageComposerFilePath = _get_package_relative_path_ex( 'page::page_composer' , 'last' );
					$RealFilePath = $PageComposerFilePath."/res/images/$FileName";
					if( file_exists( $RealFilePath ) === false )
					{
						throw( new Exception( "File '$FileName' was not found" ) );
					}
				}
				return( $RealFilePath );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции макроса 'image_path'.
		*
		*	@param $MacroSettings - Параметры компиляции.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'image_path'.
		*
		*	@param $MacroSettings - Compilation parameters.
		*
		*	@return HTML код.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_image_path( &$MacroSettings )
		{
			try
			{
				$FileName = $MacroSettings->get_setting( 'file_name' );

				if( $MacroSettings->get_setting( 'package_name' , false ) === false )
				{
					$RealFilePath = $this->get_path_from_template();
				}
				else
				{
					$PackageFilePath = _get_package_relative_path_ex( 
						$MacroSettings->get_setting( 'package_name' ) , 
						$MacroSettings->get_setting( 'package_version' , 'last' )
					);
					$RealFilePath = $PackageFilePath."/res/images/$FileName";
					if( file_exists( $RealFilePath ) === false )
					{
						throw( new Exception( "File '$FileName' was not found" ) );
					}
				}
				return( $RealFilePath );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'image_path'.
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
		*	\~english Function processes macro 'image_path'.
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
		function			process_image_path( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'file_name' => TERMINAL_VALUE );

				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'image_path' , $Limitations ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );

					$RealFilePath = $this->compile_image_path( $this->MacroSettings );

					$Str = str_replace( "{image_path:$Parameters}" , $RealFilePath , $Str );
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
		*	\~russian Функция обработки макроса 'package_path'.
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
		*	\~english Function processes macro 'package_path'.
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
		function			process_package_path( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'package_path' ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );
					
					$RealPackagePath = _get_package_relative_path_ex( 
						$this->MacroSettings->get_setting( 'package_name' ) , 
						$this->MacroSettings->get_setting( 'package_version' , 'last' )
					);
					
					$Str = str_replace( 
						"{package_path:$Parameters}" , $RealPackagePath , $Str
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
				list( $Str , $Changed ) = $this->process_basename( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_image_path( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_package_path( $Str , $Changed );
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>