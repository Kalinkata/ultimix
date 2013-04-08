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
	*	\~russian Класс вида.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english View class.
	*
	*	@author Dodonov A.A.
	*/
	class	report_view_1_0_0{

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
		var					$PageJS = false;
		var					$PermitAlgorithms = false;
		var					$ReportUtilities = false;
		var					$Security = false;
		var					$String = false;
		var					$Trace = false;
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
		*	\~russian Сгенерированный отчет.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Generated reports.
		*
		*	@author Dodonov A.A.
		*/
		var					$Output = '';

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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				$this->PermitAlgorithms = get_package( 'permit::permit_algorithms' , 'last' , __FILE__ );
				$this->ReportUtilities = get_package( 'report::report_utilities' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Trace = get_package( 'trace' , 'last' , __FILE__ );
				$this->Utilities = get_package( 'utilities' , 'last' , __FILE__ );
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
		function			compile_report_template_list( &$Settings )
		{
			try
			{
				$Reports = $this->ReportUtilities->get_reports_list( $Settings );

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
		*	\~russian Функция компиляции макроса 'report_template'.
		*
		*	@param $Settings - Параметры.
		*
		*	@param $Data - Сдержимое блока.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'report_template'.
		*
		*	@param $Settings - Parameters.
		*
		*	@param $Data - Block content.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_report_template( &$Settings , $Data )
		{
			try
			{
				$Name = $Settings->get_setting( 'name' );

				$this->Templates [ $Name ] = $Data;
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
				$Name = $Settings->get_setting( 'name' , false );

				if( $Name === false )
				{
					$TemplateName = $Settings->get_setting( 'template_package_name' );
					$TemplateVersion = $Settings->get_setting( 'template_package_version' , 'last' );
					$TemplateName = $Settings->get_setting( 'template' );

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
		*	@param $Settings - Параметры компиляции.
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
		*	@param $Settings - Compilation parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_report_query( &$Settings )
		{
			try
			{
				$RawTemplate = $this->get_raw_template( $Settings );

				$Records = $this->Utilities->get_records();

				$Code = '';

				foreach( $Records as $k => $r )
				{
					$Template = $RawTemplate;
					$Template = $this->String->print_record( $Template , $r );
					$Template = str_replace( 
						array( '{rowid}' , '{recid}' , '{odd_factor}' ) , 
						array( $k + 1 , $k , $k % 2 ? 'odd' : 'even' ) , $Template
					);

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
		*	\~russian Функция компиляции макроса 'report_query'.
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
		*	\~english Function compiles macro 'report_query'.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_report_button( &$Settings )
		{
			try
			{
				$Settings->set_undefined( 'id' , md5( microtime( true ) ) );
				$Settings->set_undefined( 'package_version' , 'last' );

				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'report_button.tpl' );

				$Code = $this->String->print_record( $Code , $Settings->get_raw_settings() );

				return( $Code );
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

				/* getting list of reports */
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
				$PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				$PackagePath = _get_package_relative_path_ex( 'report::report_view' , 'last::last' );
				$PageJS->add_javascript( "{http_host}/$PackagePath/include/js/report_view.js" );

				$Lang = get_package( 'lang' , 'last' , __FILE__ );
				$Lang->include_strings_js( 'report::report_view' );
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
		private function	prepare_report_template( &$Package )
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

				$this->prepare_report_template( $Package );

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
		*	\~russian Функция генерации отчета.
		*
		*	@param $Package - Пакет.
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
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	run_generate_report_function( &$Package , &$Options )
		{
			try
			{
				$FunctionName = $this->Security->get_gp( 'func_name' , 'string' , 'report' );
				$FunctionName = $Options->get_setting( 'func_name' , $FunctionName );

				if( method_exists( $Package , $FunctionName ) )
				{
					$this->compile_report( $Package , $FunctionName , $Options );
					return;
				}

				$Message = "Method \"$FunctionName\" does not exists in the package \"".get_class( $Package )."\"";
				throw( new Exception( $Message ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение пакета генерации отчета.
		*
		*	@param $Options - Настройки работы модуля.
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

				if( $PackageName === false )
				{
					return( false );
				}

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
		*	@param $Options - Настройки работы модуля.
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
				$this->Trace->add_trace_string( 'report_1_0_0::generate_report', COMMON );

				$Name = $this->Security->get_gp( 'report_name' , 'string' , false );
				$Name = $Options->get_setting( 'report_name' , $Name );
				$Package = $this->get_report_generator( $Options );

				if( $Package === false || $Name === false )
				{
					return;
				}

				if( $this->PermitAlgorithms->validate_permits( false , 'user' , $Name , 'report' ) === false )
				{
					throw( new Exception( 'No permits for this report' ) );
				}

				$this->run_generate_report_function( $Package , $Options );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - Настройки работы модуля.
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
		function			view( &$Options )
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