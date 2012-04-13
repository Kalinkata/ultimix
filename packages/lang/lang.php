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
	class	lang_1_0_0{
	
		/**
		*	\~russian Список языков.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english List of languages.
		*
		*	@author Dodonov A.A.
		*/
		var					$LangList = false;
	
		/**
		*	\~russian Набор локализованных строк.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english List of the localized strings.
		*
		*	@author Dodonov A.A.
		*/
		var					$StringSet = array();
		
		/**
		*	\~russian Сигнатура языка.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Language's signature.
		*
		*	@author Dodonov A.A.
		*/
		var					$Language = false;
	
		/**
		*	\~russian Были ли загружены переводы уже загруженных пакетов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Were fetched package's translation loaded.
		*
		*	@author Dodonov A.A.
		*/
		var					$AutoTranslationsWereLoaded = false;
	
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
		var					$Cache = false;
		var					$CachedMultyFS = false;
		var					$PageJS = false;
		var					$Security = false;
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
				$this->Cache = get_package( 'cache' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				
				$this->get_locale();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция возвращает язык клиента из HTTP запроса.
		*
		*	@return Сигнатура языка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function retrieves client's language from the HTTP request.
		*
		*	@return Signature of the language.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_client_language()
		{
			$Splits = array();
			
			foreach( explode( ',' , @$_SERVER[ 'HTTP_ACCEPT_LANGUAGE' ] ) as $Lang )
			{
				$Pattern = '/^(?P<primarytag>[a-zA-Z]{2,8})'.
				'(?:-(?P<subtag>[a-zA-Z]{2,8}))?(?:(?:;q=)'.
				'(?P<quantifier>\d\.\d))?$/';

				if( preg_match( $Pattern , $Lang , $Splits ) )
				{
					return( $Splits[ 'primarytag' ] );
				}
			}

			return( false );
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
				$Path = _get_package_relative_path_ex( 'lang' , '1.0.0' );
				$Path = $Path.'/include/js/lang.core.'.$this->Language.'.js';

				if( $this->CachedMultyFS->file_exists( $Path ) === false )
				{
					$this->PageJS->add_javascript( '{http_host}/'.$Path );
					$Content = $this->CachedMultyFS->get_template( __FILE__ , 'lang.core.js.tpl' );
					$Content = str_replace( '{locale}' , $this->Language , $Content );
					$this->CachedMultyFS->file_put_contents( $Path , $Content );
				}

				$this->PageJS->add_javascript( '{http_host}/'.$Path );

				$this->include_strings_js( 'lang' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция обработки строки локализации.
		*
		*	@param $RawData - Содержимое файла со строками.
		*
		*	@return list( $StringAlias , $Condition , $Translation )
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes localisation string.
		*
		*	@param $RawData - Content of the string file.
		*
		*	@return list( $StringAlias , $Condition , \$Translation )
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			dispatch_string_data( $RawData )
		{
			try
			{
				$tmp1 = explode( '=' , $RawData );
				
				if( strpos( $tmp1[ 0 ] , '|' ) === false )
				{
					return( array( $tmp1[ 0 ] , 'default' , str_replace( '[eq]' , '=' , $tmp1[ 1 ] ) ) );
				}
				else
				{
					$tmp2 = explode( '|' , $tmp1[ 0 ] );
					return( array_merge( $tmp2 , array( str_replace( '[eq]' , '=' , $tmp1[ 1 ] ) ) ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция подключает список строковых констант для указанного пакета.
		*
		*	@param $PackageName - Название пакета.
		*
		*	@param $PackageVersion - Версия пакета.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function includes list of string constants.
		*
		*	@param $PackageName - Package name.
		*
		*	@param $PackageVersion - Package version.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			include_strings( $PackageName , $PackageVersion = 'last' )
		{
			try
			{
				$Path = _get_package_relative_path_ex( $PackageName , $PackageVersion );
				$TopPackageName = _get_top_package_name( $PackageName );
				$LanguageFilePath = $Path.'/res/lang/'.$TopPackageName.'.'.$this->Language;
				
				if( file_exists( $LanguageFilePath ) )
				{
					$RawData = $this->CachedMultyFS->file_get_contents( $LanguageFilePath , 'cleaned' );
					$this->load_data( $RawData );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компилирует строку скрипта.
		*
		*	@param $StringAlias - Алиас строки.
		*
		*	@param $Condition - Условие.
		*
		*	@param $Translation - Перевод строки.
		*
		*	@return Строка скрипта.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles script line.
		*
		*	@param $StringAlias - String alias.
		*
		*	@param $Condition - Condition.
		*
		*	@param $Translation - Translation.
		*
		*	@return Script line.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_script_line( $StringAlias , $Condition , $Translation )
		{
			try
			{
				return(
					"if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ '$StringAlias' ] ) ".
						"ultimix.lang.Strings[ ultimix.lang.Locale ][ '$StringAlias' ] = {};\r\n".
					"ultimix.lang.Strings[ ultimix.lang.Locale ]".
						"[ '$StringAlias' ][ '$Condition' ] = '".trim( $Translation , '/' )."';\r\n"
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция подключает список строковых констант для указанного пакета.
		*
		*	@param $LangFilePath - Путь к файлу со строками.
		*
		*	@param $ScriptPath - Путь к файлу скрипта.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function includes list of string constants.
		*
		*	@param $LangFilePath - Path to the lang file.
		*
		*	@param $ScriptPath - Path to the script file.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_lang_javascript( $LangFilePath , $ScriptPath )
		{
			try
			{
				if( $this->CachedMultyFS->file_exists( $ScriptPath ) === false || 
						$this->Cache->get_data( $ScriptPath ) === false )
				{
					$Strings = $this->CachedMultyFS->file_get_contents( $LangFilePath , 'exploded' );

					$Script = '';
					foreach( $Strings as $k => $v )
					{
						list( $StringAlias , $Condition , $Translation ) = $this->dispatch_string_data( $v );
						$Translation = str_replace( "'" , "\\'" , $Translation );
						$Script .= $this->compile_script_line( $StringAlias , $Condition , $Translation );
					}

					$this->CachedMultyFS->file_put_contents( $ScriptPath , $Script );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция подключает список строковых констант для указанного пакета.
		*
		*	@param $PackageName - Название пакета.
		*
		*	@param $PackageVersion - Версия пакета.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function includes list of string constants.
		*
		*	@param $PackageName - Package name.
		*
		*	@param $PackageVersion - Package version.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			include_strings_js( $PackageName , $PackageVersion = 'last' )
		{
			try
			{
				$Path = _get_package_relative_path_ex( $PackageName , $PackageVersion );
				$TopPackageName = _get_top_package_name( $PackageName );
				$LangFilePath = $Path.'/res/lang/'.$TopPackageName.'.'.$this->Language;

				if( $this->CachedMultyFS->file_exists( $LangFilePath ) )
				{
					$ScriptPath = $Path.'/include/js/'.$TopPackageName.'.'.$this->Language.'.js';

					mkdir_ex( $Path.'/include/' );
					mkdir_ex( $Path.'/include/js/' );

					$this->compile_lang_javascript( $LangFilePath , $ScriptPath );

					$this->PageJS->add_javascript( '{http_host}/'.$ScriptPath );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция возвращет список языков.
		*
		*	@return Массив языков.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns list of supported languages.
		*
		*	@return Array of languages.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_list_of_languages()
		{
			try
			{
				$Languages = file_get_contents( dirname( __FILE__ ).'/conf/cf_lang_list' );
				$Languages = str_replace( "\r" , "\n" , $Languages );
				$Languages = str_replace( "\n\n" , "\n" , $Languages );
				$Languages = explode( "\n" , $Languages );
				
				return( $Languages );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция возвращает текущий язык.
		*
		*	@return Сигнатура языка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns current language.
		*
		*	@return Signature of the language.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_locale()
		{
			try
			{
				if( $this->Language === false )
				{
					if( $this->LangList === false )
					{
						$this->LangList = $this->get_list_of_languages();
					}
					if( $this->Security->get_c( 'client_lang' ) )
					{
						$this->Language = $this->Security->get_c( 'client_lang' , 'command' );
					}
					elseif( ( $Key = array_search( $this->get_client_language() , $this->LangList ) ) !== false )
					{
						$this->Language = $this->LangList[ $Key ];
					}
					else
					{
						$this->Language = $this->CachedMultyFS->get_config( __FILE__ , 'cf_locale_conf' );
					}
				}
				
				return( $this->Language );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция загрузки языковых данных.
		*
		*	@param $RawData - Содержимое файла со строками.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads language data.
		*
		*	@param $RawData - Content of the string file.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_data( $RawData )
		{
			try
			{
				if( strlen( $RawData ) )
				{
					$RawData = explode( "\n" , $RawData );
					
					foreach( $RawData as $rd )
					{
						list( $StringAlias , $Condition , $Translation ) = $this->dispatch_string_data( $rd );
						
						if( isset( $this->StringSet[ $StringAlias ] ) === false )
						{
							$this->StringSet[ $StringAlias ] = array();
						}
						
						$this->StringSet[ $StringAlias ][ $Condition ] = $Translation;
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция загрузки языковых данных из файла.
		*
		*	@param $LanguageFilePath - Путь к файлу.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads language data from file.
		*
		*	@param $LanguageFilePath - Path to file.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_translations_from_file( $LanguageFilePath )
		{
			try
			{
				if( file_exists( $LanguageFilePath ) )
				{
					$RawData = $this->CachedMultyFS->file_get_contents( $LanguageFilePath , 'cleaned' );
					$this->load_data( $RawData );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция загрузки языковых данных из файла.
		*
		*	@param $PackageName - Название пакета.
		*
		*	@param $PackageVersion - Версия пакета.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads language data from file.
		*
		*	@param $PackageName - Package name.
		*
		*	@param $PackageVersion - Package version.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_translations_from_package( $PackageName , $PackageVersion )
		{
			try
			{
				$PackagePath = _get_package_relative_path_ex( $PackageName , $PackageVersion );
				$TopPackageName = _get_top_package_name( $PackageName );

				$this->load_translations_from_file( "$PackageName/res/lang/$TopPackageName.$this->Language" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция загрузки всех языковых данных страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads all language data of the page.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_translations()
		{
			try
			{
				if( $this->AutoTranslationsWereLoaded === false )
				{
					$this->get_locale();

					$Paths = _get_loaded_packages_paths();
					foreach( $Paths as $p )
					{
						$PackagePath = _get_top_package_name( $p[ 'package_name' ] );
						$LanguageFilePath = $p[ 'directory' ]."/res/lang/$PackagePath.$this->Language";

						$this->load_translations_from_file( $LanguageFilePath );
					}

					$this->AutoTranslationsWereLoaded = true;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция возвращающая строку для установленного языка.
		*
		*	@param $StringAlias - Алиас запрашиваемой строки.
		*
		*	@param $Value - Дефолтовое значение.
		*
		*	@return Реальная строка в зависимости от установленного языка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns real string according to alias.
		*
		*	@param $StringAlias - Alias of the requested string.
		*
		*	@param $Value - Default value.
		*
		*	@return Language dependent real string.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_string( $StringAlias , $Value = 'default' )
		{
			try
			{
				if( isset( $this->StringSet[ $StringAlias ] ) === false || 
					( $Value == 'default' && isset( $this->StringSet[ $StringAlias ][ $Value ] ) === false ) )
				{
					return( $StringAlias );
				}
				
				if( $Value == 'default' && isset( $this->StringSet[ $StringAlias ][ 'default' ] ) !== false )
				{
					return( $this->StringSet[ $StringAlias ][ 'default' ] );
				}
				
				foreach( $this->StringSet[ $StringAlias ] as $Pattern => $LocalizedString )
				{
					if( preg_match( $Pattern , "$Value" ) )
					{
						return( str_replace( '{value}' , $Value , $LocalizedString ) );
					}
				}
				
				return( $StringAlias );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>