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

	// TODO session_cache

	/**
	*	\~russian Класс для быстрого создания контроллеров и видов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class for rapid controllers and viewes development.
	*
	*	@author Dodonov A.A.
	*/
	class	context_set_1_0_0{

		/**
		*	\~russian Закешированные пакеты.
		*
		*	@author Dodonov A.A.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$CachedMultyFS = false;
		var					$CommonStateStartup = false;
		var					$ContextSetConfigs = false;
		var					$CustomStateStartup = false;
		var					$Context = false;
		var					$ContextSetSettings = false;
		var					$CustomSettings = false;
		var					$Messages = false;
		var					$PageJS = false;
		var					$Security = false;
		var					$String = false;
		var					$Trace = false;

		/**
		*	\~russian Префикс.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Prefix.
		*
		*	@author Dodonov A.A.
		*/
		var					$Prefix;

		/**
		*	\~russian Объект класс предоставляющие вызовы.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Class'es object wich provides methods.
		*
		*	@author Dodonov A.A.
		*/
		var					$Provider;

		/**
		*	\~russian Пути к нестандартным контекстам.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Paths to the non-standart contexts.
		*
		*	@author Dodonov A.A.
		*/
		var					$Contexts = array();

		/**
		*	\~russian Выборка пакетов.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fetches packages.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_main_packages()
		{
			try
			{
				$this->Messages = get_package( 'page::messages' , 'last' , __FILE__ );
				$this->PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				$this->Context = get_package( 'gui::context' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Trace = get_package( 'trace' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка пакетов.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fetches packages.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_additional_packages()
		{
			try
			{
				$this->CustomSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->ContextSetSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$PackageName = 'gui::context_set::context_set_markup';
				$this->ContextSetMarkup = get_package( $PackageName , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
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
				$this->CommonStateStartup = get_package( 'gui::context_set::common_state_startup' , 'last' , __FILE__ );
				$this->ContextSetConfigs = get_package( 'gui::context_set::context_set_configs' , 'last' , __FILE__ );
				$this->CustomStateStartup = get_package( 'gui::context_set::custom_state_startup' , 'last' , __FILE__ );
				$this->get_main_packages();
				$this->get_additional_packages();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция предгенерационных действий.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method executes before any page generating actions took place.
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
				$Path = _get_package_relative_path_ex( 'gui::context_set' , '1.0.0' );
				$this->PageJS->add_javascript( "{http_host}/$Path/include/js/context_set.js" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Очистка структур.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method clears system structures.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			clear()
		{
			try
			{
				$this->Contexts = array();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Добавление нестандартного контекста.
		*
		*	@param $ContextPath - Путь к конфигу контекста.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method adds non-standart context.
		*
		*	@param $ContextPath - Path to the context's config.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_context( $ContextPath )
		{
			try
			{
				$this->Contexts [] = $ContextPath;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Добавление контекстов.
		*
		*	@param $Options - Параметры.
		*
		*	@param $ContextFolder - Путь к директории.
		*
		*	@param $Contexts - Контексты.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method adds non-standart contexts.
		*
		*	@param $Options - Options.
		*
		*	@param $ContextFolder - Path to the directory.
		*
		*	@param $Contexts - Contexts.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_contexts( &$Options , $ContextFolder , $Contexts )
		{
			try
			{
				$HintedContext = $Options->get_setting( 'context' , false );

				if( $HintedContext !== false && in_array( $HintedContext , $Contexts ) )
				{
					$this->Trace->add_trace_string( "Hinted context : $ContextFolder/conf/$HintedContext" , COMMON );
					$this->Contexts [] = "$ContextFolder/conf/$HintedContext";
				}
				else
				{
					$this->Trace->add_trace_string( "Hinted context : all contexts" , COMMON );
					foreach( $Contexts as $i => $Context )
					{
						$this->Contexts [] = "$ContextFolder/conf/$Context";
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция возвращает запись для обновления.
		*
		*	@param $New - Запись.
		*
		*	@param $Original - Запись.
		*
		*	@return - Запись.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method returns update record.
		*
		*	@param $New - Record.
		*
		*	@param $Original - Record.
		*
		*	@return - Record.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_update_record( $New , $Original )
		{
			try
			{
				$Update = array();
				
				foreach( $New as $Field => $NewValue )
				{
					$Field = str_replace( $this->Prefix.'_' , '' , $Field );
					
					if( @$Original->$Field == $NewValue )
					{
						continue;
					}
					if( @$Original->$Field != $this->Security->get( $NewValue , 'unsafe_string' ) )
					{
						@$Update[ $Field ] = $NewValue;
						continue;
					}
				}
				
				return( $Update );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'prefix'.
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
		*	\~english Method processes macro 'prefix'.
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
		function			compile_prefix( $Str , $Changed )
		{
			try
			{
				if( strpos( $Str , '{prefix}' ) !== false )
				{
					$Str = str_replace( '{prefix}' , $this->Prefix ,$Str );
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
		*	\~russian Попытка обработать редирект.
		*
		*	@param $Options - Настройки редиректа.
		*
		*	@param $AutoRedirect - Нужен ли редирект.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function tries to redirect on another page.
		*
		*	@param $Options - Redirect settings.
		*
		*	@param $AutoRedirect - Should be redirected.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_locations( &$Options , $AutoRedirect )
		{
			try
			{
				$AutoRedirect = intval( $Options->get_setting( 'auto_redirect' , $AutoRedirect ) );
				$AutoRedirect = $this->Security->get_gp( 'auto_redirect' , 'integer' , $AutoRedirect );
				if( $AutoRedirect && $this->Security->get_srv( 'HTTP_REFERER' , 'set' ) )
				{
					header( $_SERVER[ 'SERVER_PROTOCOL' ].' 303 See Other' );
					if( $Options->get_setting( 'redirect_page' , false ) )
					{
						header( "Location: ".$Options->get_setting( 'redirect_page' ) );
					}
					else
					{
						header( "Location: ".$this->Security->get_srv( 'HTTP_REFERER' , 'raw' ) );
					}
					exit( 0 );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция запуска контроллера/вида.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Provider - Объект класса представляющего функции-обработчики.
		*
		*	@param $AutoRedirect - Нужен ли редирект.
		*
		*	@return true если запуск был успешным.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method starts controller/view.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Provider - Object of the class wich provides all handlers.
		*
		*	@param $AutoRedirect - Redirect page.
		*
		*	@return true if the execution was successfull.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			run_execution( $Options , $Provider , $AutoRedirect = 0 )
		{
			try
			{
				$GUI = get_package( 'gui' , 'last' , __FILE__ );

				if( $this->Context->execute( $Options , $Provider ) )
				{
					$this->set_locations( $Options , $AutoRedirect );

					$GUI->set_var( 'last_context_set_execution_code' , 0 );
					$GUI->set_var( 
						'last_context_set_execution_message' , $this->Messages->get_last_success_message()
					);

					return( true );
				}

				$GUI->set_var( 'last_context_set_execution_code' , 1 );
				$GUI->set_var( 
					'last_context_set_execution_message' , $this->Messages->get_last_error_message()
				);

				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Обработка нестандартных конфигов.
		*
		*	@param $ContextPath - Путь к конфигу.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return Конфиг.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method starts controller/view.
		*
		*	@param $ContextPath - Path to the config.
		*
		*	@param $Options - Options.
		*
		*	@return Config.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	load_custom_settings( $ContextPath , &$Options )
		{
			try
			{
				$Config = $this->CachedMultyFS->file_get_contents( $ContextPath );
				$Config = str_replace( '{prefix}' , $this->Prefix , $Config );
				$this->CustomSettings->load_settings( $Config );
				$this->CustomSettings->add_settings_from_object( $Options );
				return( $Config );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка нестандартных конфигов.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method starts controller/view.
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			run_custom_states( &$Options )
		{
			try
			{
				$this->Trace->start_group( "custom_configs_processing" , COMMON );

				foreach( $this->Contexts as $i => $ContextPath )
				{
					$this->Trace->add_trace_string( "Processing context $ContextPath" , COMMON );

					$Config = $this->load_custom_settings( $ContextPath , $Options );

					$Result = $this->CustomStateStartup->run_config_processors( 
						$this , $Config , $this->CustomSettings , $Options
					);
					if( $Result )
					{
						break;
					}
				}

				$this->Trace->end_group();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция загрузки данных.
		*
		*	@param $ContextSetSettings - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method loads data.
		*
		*	@param $ContextSetSettings - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	load_context_set_data( &$ContextSetSettings )
		{
			try
			{
				$this->Prefix = $ContextSetSettings->get_setting( 'prefix' );
				$this->Prefix = str_replace( 
					'{functionality}' , $ContextSetSettings->get_setting( 'functionality' , '' ) , 
					$this->Prefix
				);
				$this->Prefix = str_replace( 
					'{entity}' , $ContextSetSettings->get_setting( 'entity' , '' ) , $this->Prefix
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция запуска контроллера/вида.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Provider - Объект класса представляющего функции-обработчики.
		*
		*	@param $FilePath - Путь к компоненту. Должен быть __FILE__
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method starts controller/view.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Provider - Object of the class wich provides all handlers.
		*
		*	@param $FilePath - Path tp the component. Must be equal to __FILE__
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	execute_do( &$Options , $Provider , $FilePath )
		{
			try
			{
				$this->ContextSetConfigs->load_context_set_config( $this->ContextSetSettings , $Options , $FilePath );
				$this->load_context_set_data( $this->ContextSetSettings );

				if( $this->CommonStateStartup->run_common_states( $this , $Options ) === false )
				{
					$this->run_custom_states( $Options );
				}

				if( $this->Provider->Output !== false && $this->Provider->Output !== '' )
				{
					$this->Provider->Output = $this->ContextSetMarkup->compile_view( 
						$Options , $this->ContextSetSettings , $this->Provider->Output
					);
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция запуска контроллера/вида.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Provider - Объект класса представляющего функции-обработчики.
		*
		*	@param $FilePath - Путь к компоненту. Должен быть __FILE__
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method starts controller/view.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Provider - Object of the class wich provides all handlers.
		*
		*	@param $FilePath - Path tp the component. Must be equal to __FILE__
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			execute( &$Options , $Provider , $FilePath )
		{
			try
			{
				$this->Trace->start_group( "ContextSet::execute for class \"".get_class( $Provider )."\"" );
				$this->Trace->add_trace_string( serialize( $Options->get_raw_settings() ) , COMMON );

				$Options->set_setting( 'file_path' , $FilePath );
				$this->Provider = $Provider;
				$this->Provider->Output = false;

				$this->execute_do( $Options , $Provider , $FilePath );

				$this->Trace->end_group();
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
		*	\~english Method processes string.
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
		function			compile_special_macro( &$Options , $Str , &$Changed )
		{
			try
			{
				list( $Str , $Changed ) = $this->ContextSetMarkup->compile_options( $Options , $Str , $Changed );

				$Str = str_replace( '{prefix}' , $this->Prefix , $Str );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция конвертации объекта в строку.
		*
		*	@return строка с описанием объекта.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method converts object to string.
		*
		*	@return string with the object's description.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__toString()
		{
			try
			{
				return( serialize( $this->Config ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>