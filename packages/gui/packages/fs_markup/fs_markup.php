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
				$this->TemplateManager = get_package( 'template_manager' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция получения значения поля из записи.
		*
		*	@param $Settings - Параметры извлечения.
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
		*	@param $Settings - Extraction parameters.
		*
		*	@return Field value.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_basename( &$Settings )
		{
			try
			{
				return( basename( $Settings->get_setting( 'value' ) ) );
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
				$TemplatePath = $this->TemplateManager->get_template_path( 
					$this->TemplateName , $this->TemplateVersion
				);
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
		function			compile_image_path( &$Settings )
		{
			try
			{
				$FileName = $Settings->get_setting( 'file_name' );

				if( $Settings->get_setting( 'package_name' , false ) === false )
				{
					$RealFilePath = $this->get_path_from_template();
				}
				else
				{
					$PackageFilePath = _get_package_relative_path_ex( 
						$Settings->get_setting( 'package_name' ) , $Settings->get_setting( 'package_version' , 'last' )
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
		function			compile_package_path( $Str , $Changed )
		{
			try
			{
				$RealPackagePath = _get_package_relative_path_ex( 
					$Settings->get_setting( 'package_name' ) , 
					$Settings->get_setting( 'package_version' , 'last' )
				);

				return( $RealPackagePath );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>