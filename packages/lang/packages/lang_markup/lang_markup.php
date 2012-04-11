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
		var					$BlockSettings = false;
		var					$CachedMultyFS = false;
		var					$Lang = false;
		var					$String = false;
	
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
				$this->Lang = get_package( 'lang' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция обработки блока 'lang'.
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
		*	\~english Function processes 'lang' block.
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
		function			process_lang_block( $Str , &$Changed )
		{
			try
			{
				$Str = $this->String->show_block( 
					$Str , 'lang:'.$this->Lang->Language , 'lang:~'.$this->Lang->Language , $Changed
				);
				
				$ListOfLanguages = $this->Lang->get_list_of_languages();

				foreach( $ListOfLanguages as $v )
				{
					$Str = $this->String->hide_block( $Str , 'lang:'.$v , 'lang:~'.$v , $Changed );
				}
				
				return( array( $Str , $Changed ) );
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
		*	@param $Options - Настройки обработки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'lang_file'.
		*
		*	@param $Options - Options.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_lang_file( &$Options )
		{
			try
			{
				list( $PackageName , $PackageVersion ) = $this->get_package_info( $Options );

				foreach( $PackageName as $i => $Name )
				{
					$Version = isset( $PackageVersion[ $i ] ) ? $PackageVersion[ $i ] : 'last';
					$PackagePath = _get_package_path_ex( $Name , $Version );

					$TopPackageName = _get_top_package_name( $Name );
					$LangFilePath = $PackagePath.'/res/lang/'.$TopPackageName.'.'.$this->Lang->Language;
					$RawData = $this->CachedMultyFS->file_get_contents( $LangFilePath , 'cleaned' );

					$this->Lang->load_data( $RawData );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'lang_file'.
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
		*	\~english Function processes macro 'lang_file'.
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
		function			process_lang_file( $Str , &$Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'lang_file' ) ; )
				{
					$this->BlockSettings->load_settings( $Parameters );
					
					$this->compile_lang_file( $this->BlockSettings );
					
					$Str = str_replace( "{lang_file:$Parameters}" , '' , $Str );
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
		*	\~russian Функция обработки макроса 'lang_file_js'.
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
		*	\~english Function processes macro 'lang_file_js'.
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
		function			process_lang_file_js( $Str , &$Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'lang_file_js' ) ; )
				{
					$this->BlockSettings->load_settings( $Parameters );
					
					$PackageName = $this->BlockSettings->get_setting( 'package_name' );
					$PackageVersion = $this->BlockSettings->get_setting( 'package_version' , 'last' );
					
					$this->Lang->include_strings_js( $PackageName , $PackageVersion );
					
					$Str = str_replace( "{lang_file_js:$Parameters}" , '' , $Str );
					
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
		*	\~russian Функция обработки макроса 'lang'.
		*
		*	@param $BlockSettings - Параметры компиляции.
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
		*	@param $BlockSettings - Параметры компиляции.
		*
		*	@return HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_lang( &$BlockSettings )
		{
			try
			{
				$StringAlias = $BlockSettings->get_setting( 'string' );
				$Value = $BlockSettings->get_setting( 'value' , 'default' );
				$TransformedString = $this->Lang->get_string( $StringAlias , $Value );

				if( $TransformedString == $StringAlias )
				{
					$DefaultTransform = $BlockSettings->get_setting( 'default' , false );
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
		*	\~russian Функция обработки макроса 'lang'.
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
		*	\~english Function processes macro 'lang'.
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
		function			process_lang( $Str , &$Changed )
		{
			try
			{
				$Rules = array( 'value' => TERMINAL_VALUE );

				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'lang' , $Rules ) ; )
				{
					$this->BlockSettings->load_settings( 'string='.$Parameters );

					$TransformedString = $this->compile_lang( $this->BlockSettings );

					$Str = str_replace( "{lang:$Parameters}" , $TransformedString , $Str );
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
		*	\~russian Функция обработки макроса 'iconv'.
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
		*	\~english Function processes macro 'iconv'.
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
		function			process_iconv( $Str , &$Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'iconv' ) ; )
				{
					$this->BlockSettings->load_settings( $Parameters );
					$Data = $this->String->get_block_data( $Str , "iconv:$Parameters" , '~iconv' );
					$ConvertedData = iconv( 
						$this->BlockSettings->get_setting( 'in_charset' ) , 
						$this->BlockSettings->get_setting( 'out_charset' , 'UTF-8' ) , $Data
					);
					
					$Str = str_replace( "{iconv:$Parameters}$Data{~iconv}" , $ConvertedData , $Str );
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
		function			process_locale( $Str , &$Changed )
		{
			try
			{
				if( strpos( $Str , '{locale}' ) !== false )
				{
					$Str = str_replace( '{locale}' , $this->Lang->Language , $Str );
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
		*	\~russian Функция обработки строки с учетом языка.
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
		*	\~english Function processes data according to the active language.
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
		function			process_string( $Options , $Str , &$Changed )
		{
			try
			{
				$this->Lang->get_locale();
				$this->Lang->load_translations();

				list( $Str , $Changed ) = $this->process_lang_block( $Str , $Changed );

				list( $Str , $Changed ) = $this->process_lang_file( $Str , $Changed );

				list( $Str , $Changed ) = $this->process_lang_file_js( $Str , $Changed );

				list( $Str , $Changed ) = $this->process_lang( $Str , $Changed );

				list( $Str , $Changed ) = $this->process_iconv( $Str , $Changed );

				list( $Str , $Changed ) = $this->process_locale( $Str , $Changed );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки объекта с учетом языка.
		*
		*	@param $Object - объект требуюшщий обработки.
		*
		*	@return Обработанный объект.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes data according to the active language.
		*
		*	@param $Object - Object to process.
		*
		*	@return Processed object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_object( $Object )
		{
			try
			{
				$Changed = false;
				if( is_array( $Object ) || is_object( $Object ) )
				{
					foreach( $Object as $k => $s )
					{
						set_field( $Object , $k , $this->process_object( $s ) );
					}
					
					return( $Object );
				}
				else
				{
					return( $this->process_string( false , $Object , $Changed ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>