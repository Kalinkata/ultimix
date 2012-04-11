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
	*	\~russian Работа с аккаунтами пользователей.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Working with user's accounts.
	*
	*	@author Dodonov A.A.
	*/
	class	report_1_0_0{

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
		var					$Settings = false;
		var					$CachedMultyFS = false;
		var					$Database = false;
		var					$PageJS = false;
		var					$Security = false;
		var					$String = false;
		var					$Utilities = false;

		/**
		*	\~russian Шаблоны.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Templates.
		*
		*	@author Dodonov A.A.
		*/
		var					$Templates = array();

		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
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
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Utilities = get_package( 'utilities' , 'last' , __FILE__ );
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
				$PackagePath = _get_package_relative_path_ex( 'report' , '1.0.0' );
				$this->PageJS->add_javascript( "{http_host}/$PackagePath/include/js/report.js" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция получения списка отчётов.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return Список отчётов.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns array of reports.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return Array of reports.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_reports_list( &$Settings )
		{
			try
			{
				$PackageName = $tSettings->get_setting( 'package_name' );
				$PackageVersion = $Settings->get_setting( 'package_version' , 'last' );
				$Subfolder = $Settings->get_setting( 'subfolder' , '' );
				$ReportsPath = _get_package_path_ex( $PackageName , $PackageVersion )."/res/reports/";
				if( $Subfolder != '' )
				{
					$ReportsPath .= $Subfolder.'/';
				}
				$Settings->set_setting( 
					'name' , $Settings->get_setting( 'name' , 'report_template' )
				);
				
				return( $this->Utilities->get_files_from_directory( $ReportsPath , '/\.rep/' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'report_template_list'.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'report_template_list'.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_report_template_list( &$Settings )
		{
			try
			{
				$Reports = $this->get_reports_list( $Settings );

				$Ids = array();
				$Titles = array();

				foreach( $Reports as $i => $r )
				{
					$Ids [] = $i;
					$Titles [] = basename( $r , '.rep' );
				}

				$Subfolder = $Settings->get_setting( 'subfolder' , '' );
				if( $Subfolder != '' )
				{
					$Subfolder = '<input type="hidden" name="subfolder" value="'.$Subfolder.'">';
				}

				$Code = "$Subfolder{select:class=width_320 flat;".$Settings->get_all_settings().';first='.
						implode( '|' , $Ids ).';second='.implode( '|' , $Titles ).'}';

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'report_template_list'.
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
		*	\~english Function processes macro 'report_template_list'.
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
		function			process_report_template_list( $Str , $Changed )
		{
			try
			{
				for( ; $Params = $this->String->get_macro_parameters( $Str , 'report_template_list' ) ; )
				{
					$this->Settings->load_settings( $Params );

					$Code = $this->compile_report_template_list( $this->Settings );

					$Str = str_replace( "{report_template_list:$Params}" , $Code , $Str );
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
		*	\~russian Функция обработки макроса 'report_template'.
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
		*	\~english Function processes macro 'report_template'.
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
		function			process_report_template( $Str , $Changed )
		{
			try
			{
				for( ; $Params = $this->String->get_macro_parameters( $Str , 'report_template' ) ; )
				{
					$this->Settings->load_settings( $Params );
					$Name = $this->Settings->get_setting( 'name' );
					
					$BlockData = $this->String->get_block_data( $Str , "report_template:$Params" , '~report_template' );
					$this->Templates [ $Name ] = $BlockData;
					
					$Str =  $this->String->hide_block( 
						$Str , "report_template:$Params" , '~report_template' , $Changed
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
		*	\~russian Получение шаблона.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Шаблон.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns template.
		*
		*	@param $Settings - Parameters.
		*
		*	@return Template.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_raw_template( &$Settings )
		{
			try
			{
				$Name = $this->Settings->get_setting( 'name' , false );

				if( $Name === false )
				{
					$TemplateName = $this->Settings->get_setting( 'template_package_name' );
					$TemplateVersion = $this->Settings->get_setting( 'template_package_version' , 'last' );
					$TemplateName = $this->Settings->get_setting( 'template' );

					$Path = _get_package_path_ex( $TemplateName , $TemplateVersion )."/res/templates/$TemplateName";
					$RawTemplate = $this->CachedMultyFS->file_get_contents( $Path );
				}
				else
				{
					$RawTemplate = $this->Templates[ $Name ];
				}

				return( $RawTemplate );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции макроса 'report_query'.
		*
		*	@param $Records - Записи.
		*
		*	@param $RawTemplate - Шаблон.
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
		*	@param $Records - Records.
		*
		*	@param $RawTemplate - Template.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_report_query( &$Records , $RawTemplate )
		{
			try
			{
				$Code = '';

				foreach( $Records as $k => $r )
				{
					$Template = $RawTemplate;
					$Template = $this->String->print_record( $Template , $r );
					$Template = str_replace( '{rowid}' , $k + 1 , $Template );
					$Template = str_replace( '{recid}' , $k , $Template );
					if( $k % 2 )
					{
						$Template = str_replace( '{odd_factor}' , 'odd' , $Template );
					}
					else
					{
						$Template = str_replace( '{odd_factor}' , 'even' , $Template );
					}
					$Code .= $Template;
				}

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'report_query'.
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
		*	\~english Function processes macro 'report_query'.
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
		function			process_report_query( $Str , $Changed )
		{
			try
			{
				$Rules = array( 'query' => TERMINAL_VALUE );

				for( ; $Params = $this->String->get_macro_parameters( $Str , 'report_query' , $Rules ) ; )
				{
					$this->Settings->load_settings( $Params );

					$RawTemplate = $this->get_raw_template( $this->Settings );

					$Records = $this->Utilities->get_records();

					$Code = $this->compile_report_query( $Records , $RawTemplate );

					$Str = str_replace( "{report_query:$Params}" , $Code , $Str );
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
		*	\~russian Функция обработки макроса 'report_query'.
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
		*	\~english Function processes macro 'report_query'.
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
		function			process_report_button( $Str , $Changed )
		{
			try
			{
				for( ; $Params = $this->String->get_macro_parameters( $Str , 'report_button' ) ; )
				{
					$this->Settings->load_settings( $Params );

					$this->Settings->set_undefined( 'id' , md5( microtime( true ) ) );
					$this->Settings->set_undefined( 'package_version' , 'last' );

					$Code = $this->CachedMultyFS->get_template( __FILE__ , 'report_button.tpl' );

					$Code = $this->String->print_record( $Code , $this->Settings->get_raw_settings() );

					$Str = str_replace( "{report_button:$Params}" , $Code , $Str );
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
		*	@param $Options - параметры отображения.
		*
		*	@param $Str - обрабатывемая строка.
		*
		*	@param $Changed - была ли осуществлена обработка.
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
		*	@param $Str - processing string.
		*
		*	@param $Changed - was the processing completed.
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
				list( $Str , $Changed ) = $this->process_report_template_list( $Str , $Changed );

				list( $Str , $Changed ) = $this->process_report_template( $Str , $Changed );

				list( $Str , $Changed ) = $this->process_report_query( $Str , $Changed );

				list( $Str , $Changed ) = $this->process_report_button( $Str , $Changed );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция выборки шаблона отчета по номеру.
		*
		*	@param $PackageName - Название пакета.
		*
		*	@param $PackageVersion - Версия пакета.
		*
		*	@param $ReportTemplate - Идентификатор шаблона отчета.
		*
		*	@param $Subfolder - Папка с шаблонами.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns report template by it's id.
		*
		*	@param $PackageName - Report template.
		*
		*	@param $PackageVersion - Package version.
		*
		*	@param $ReportTemplate - Id of the report's template.
		*
		*	@param $Subfolder - Template subdirectory.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_report_template( $PackageName , $PackageVersion , $ReportTemplate , $Subfolder )
		{
			try
			{
				$ReportsPath = _get_package_path_ex( $PackageName , $PackageVersion )."/res/reports/";
				
				if( $Subfolder != '' )
				{
					$ReportsPath .= $Subfolder.'/';
				}
				
				/* \~english getting list of reports */
				$Reports = $this->Utilities->get_files_from_directory( $ReportsPath , '/\.rep/' );
				$Report = $Reports[ $ReportTemplate ];
				return( $this->CachedMultyFS->file_get_contents( $Report ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция генерации отчета.
		*
		*	@param $Package - Пакет.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function generates report.
		*
		*	@param $Package - Package.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_report_template( &$Package )
		{
			try
			{
				if( $this->Security->get_gp( 'report_template' , 'integer' , false ) !== false )
				{
					/* it means that the function 'report' has returned data, not the generated report */
					$ReportTemplate = $this->get_report_template( 
						$this->Security->get_gp( 'report_package_name' , 'string' ) , 
						$this->Security->get_gp( 'report_package_version' , 'string' , 'last' ) , 
						$this->Security->get_gp( 'report_template' , 'integer' ) , 
						$this->Security->get_gp( 'subfolder' , 'command' , '' )
					);
					$Package->Output = $this->String->print_record( $ReportTemplate , $Package->Output );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция генерации отчета.
		*
		*	@param $Package - Пакет.
		*
		*	@param $FunctionName - Название функции.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function generates report.
		*
		*	@param $Package - Package.
		*
		*	@param $FunctionName - Function name.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_report( &$Package , $FunctionName , &$Options )
		{
			try
			{
				call_user_func( array( $Package , $FunctionName ) , $Options );

				$this->compile_report_template( $Package );

				$Extension = $this->Security->get_gp( 'output' , 'string' , 'txt' );
				$Extension = $Options->get_setting( 'output' , $Extension );

				header( 'HTTP/1.0 200 OK' );
				header( 'Content-type: application/octet-stream' );
				header( 'Content-Length: '.strlen( $Package->Output ) );
				header( 'Content-Disposition: attachment; filename="'.date( 'YmdHid' ).".$Extension".'"' );
				header( 'Connection: close' );

				$this->Output = $Package->Output;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение пакета генерации отчета.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@return Пакет.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns report generation package.
		*
		*	@param $Options - Settings.
		*
		*	@return Package.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_report_generator( &$Options )
		{
			try
			{
				$PackageName = $this->Security->get_gp( 'report_package_name' , 'string' , false );
				$PackageName = $Options->get_setting( 'report_package_name' , $PackageName );

				$PackageVersion = $this->Security->get_gp( 'report_package_version' , 'string' , 'last' );
				$PackageVersion = $Options->get_setting( 'report_package_version' , $PackageVersion );

				$Package = get_package( $PackageName , $PackageVersion , __FILE__ );

				return( $Package );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция генерации отчета.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function generates report.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			generate_report( &$Options )
		{
			try
			{
				$Package = $this->get_report_generator( $Options );

				$FunctionName = $this->Security->get_gp( 'func_name' , 'string' , 'report' );
				$FunctionName = $Options->get_setting( 'func_name' , $FunctionName );

				if( method_exists( $Package , $FunctionName ) )
				{
					$this->compile_report( $Package , $FunctionName , $Options );
					return;
				}

				$Message = "Method \"$FunctionName\" does not exists in the package \"$PackageName.$PackageVersion\"";
				throw( new Exception( $Message ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code of the компонента.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( $Options )
		{
			try
			{
				$this->generate_report( $Options );
				
				return( $this->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>