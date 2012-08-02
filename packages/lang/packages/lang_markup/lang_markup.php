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
	*	\~russian Класс для обработки строк с учетом языка.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides language dependent substitutions for strings.
	*
	*	@author Dodonov A.A.
	*/
	class	lang_markup_1_0_0{

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
		var					$CachedMultyFS = false;
		var					$Lang = false;

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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Lang = get_package( 'lang' , 'last' , __FILE__ );
				$this->Lang->get_locale();
				$this->Lang->load_translations();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки блока 'lang_block'.
		*
		*	@param $Settings - Параметры.
		*
		*	@param $Data - Данные.
		*
		*	@return Обработанная строка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes 'lang_block'.
		*
		*	@param $Settings - Settings.
		*
		*	@param $Data - Data.
		*
		*	@return Processed string.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_lang_block( &$Settings , $Data )
		{
			try
			{
				if( $Settings->setting_exists( $this->Lang->get_locale() ) )
				{
					return( $Data );
				}
				else
				{
					return( '' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение информации о пакетах.
		*
		*	@param $Options - Настройки обработки.
		*
		*	@return array( $PackageName , $PackageVersion ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns info about packages.
		*
		*	@param $Options - Options.
		*
		*	@return array( $PackageName , $PackageVersion ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_package_info( &$Options )
		{
			try
			{
				$PackageName = $Options->get_setting( 'package_name' );
				$PackageName = explode( ',' , $PackageName );
				$PackageVersion = $Options->get_setting( 'package_version' , 'last' );
				$PackageVersion = explode( ',' , $PackageVersion );

				return( array( $PackageName , $PackageVersion ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'lang_file'.
		*
		*	@param $Settings - Настройки обработки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'lang_file'.
		*
		*	@param $Settings - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_lang_file( &$Settings )
		{
			try
			{
				list( $PackageName , $PackageVersion ) = $this->get_package_info( $Settings );

				foreach( $PackageName as $i => $Name )
				{
					$Version = isset( $PackageVersion[ $i ] ) ? $PackageVersion[ $i ] : 'last';
					$PackagePath = _get_package_path_ex( $Name , $Version );

					$TopPackageName = _get_top_package_name( $Name );
					$LangFilePath = $PackagePath.'/res/lang/'.$TopPackageName.'.'.$this->Lang->Language;
					$RawData = $this->CachedMultyFS->file_get_contents( $LangFilePath , 'cleaned' );

					$this->Lang->load_data( $RawData );
				}

				return( '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'lang_file_js'.
		*
		*	@param $Settings - Настройки.
		*
		*	@return Обработанная строка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'lang_file_js'.
		*
		*	@param $Settings - Настройки.
		*
		*	@return Processed string.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_lang_file_js( &$Settings )
		{
			try
			{
				$PackageName = $Settings->get_setting( 'package_name' );
				$PackageVersion = $Settings->get_setting( 'package_version' , 'last' );

				$this->Lang->include_strings_js( $PackageName , $PackageVersion );

				return( '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'lang'.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return HTML код.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'lang'.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_lang( &$Settings )
		{
			try
			{
				$RawSettings = $Settings->get_raw_settings();
				$StringAlias = array_shift( array_keys( $RawSettings ) );
				$Value = $Settings->get_setting( 'value' , 'default' );
				$TransformedString = $this->Lang->get_string( $StringAlias , $Value );

				if( $TransformedString == $StringAlias )
				{
					$DefaultTransform = $Settings->get_setting( 'default' , false );
					$TransformedString = 
						$DefaultTransform === false ? $TransformedString : "{lang:$DefaultTransform}";
				}

				return( $TransformedString );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'iconv'.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@param $Data - Данные.
		*
		*	@return HTML код.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'iconv'.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@param $Data - Data.
		*
		*	@return HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_iconv( &$Settings , $Data )
		{
			try
			{
				$Code = iconv( 
					$this->Settings->get_setting( 'in_charset' ) , 
					$this->Settings->get_setting( 'out_charset' , 'UTF-8' ) , $Data
				);

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'locale'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'locale'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_locale( &$Settings )
		{
			try
			{
				//TODO: add auto_macro wich outputs object field
				return( $this->Lang->Language );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>