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
	*	\~russian Компоновщик страниц.
	*
	*	@note На страницу может быть только один шаблон, но на каждую страницу может быть свой шаблон.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Page composer.
	*
	*	@note There must be only one template per page, but each page may has each own template.
	*
	*	@author Dodonov A.A.
	*/
	class	page_composer_1_0_0{

		/**
		*	\~russian Пакет шаблона.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Template's package.
		*
		*	@author Dodonov A.A.
		*/
		var					$TemplateName = '';

		/**
		*	\~russian Версия шаблона.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Template's Version.
		*
		*	@author Dodonov A.A.
		*/
		var					$TemplateVersion = '';

		/**
		*	\~russian Структура страницы.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Page's layout.
		*
		*	@author Dodonov A.A.
		*/
		var					$Layout = 'default';

		/**
		*	\~russian Шаблон для страницы.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Template for the page.
		*
		*	@author Dodonov A.A.
		*/
		var					$Template = false;

		/**
		*	\~russian Пакеты для генерируемой страницы.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Packages of the generating page.
		*
		*	@author Dodonov A.A.
		*/
		var					$Packages = false;

		/**
		*	\~russian Закэшированный объект.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached object.
		*
		*	@author Dodonov A.A.
		*/
		var					$Messages = false;
		var					$PageAccess = false;
		var					$PageComposerUtilities = false;
		var					$PageCSS = false;
		var					$PageJS = false;
		var					$PageMarkup = false;
		var					$PageMeta = false;
		var					$PageParts = false;
		var					$Security = false;
		var					$String = false;
		var					$Trace = false;

		/**
		*	\~russian Загрузка пакетов.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads packages.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	load_page_packages()
		{
			try
			{
				$this->PageAccess = get_package( 'page::page_access' , 'last' , __FILE__ );
				$this->PageComposerUtilities = get_package( 'page::page_composer_utilities' , 'last' , __FILE__ );
				$this->PageCSS = get_package( 'page::page_css' , 'last' , __FILE__ );
				$this->PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				$this->PageMarkup = get_package( 'page::page_markup' , 'last' , __FILE__ );
				$this->PageMeta = get_package( 'page::page_meta' , 'last' , __FILE__ );
				$this->PageParts = get_package( 'page::page_parts' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->Messages = get_package( 'page::messages' , 'last' , __FILE__ );
				$this->load_page_packages();
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
		*	\~russian Функция предгенерационных действий.
		*
		*	@param $Options - Настройки работы модуля.
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
		function			pre_generation( &$Options )
		{
			try
			{
				$PackagePath = _get_package_relative_path_ex( 'page::page_composer' , '1.0.0' );
				$this->PageCSS->add_stylesheet( "{http_host}/$PackagePath/res/css/core.css" );

				$Lang = get_package( 'lang' , 'last' , __FILE__ );
				$Lang->include_strings_js( 'page::page_composer' );

				$this->PageComposerUtilities->page_permit_validation( $Options );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция постгенерационных действий.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function executes after any page generating actions took place.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			post_generation( $Options )
		{
			try
			{
				$Str = $this->Template->get_template();
				$Str = $this->PageCSS->output_stylesheets( $Str );
				$Str = $this->PageJS->output_scripts( $Str );
				$this->Template->set_template( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Действия, предшествующие генерации страницы.
		*
		*	@param $PageName - Имя компонуемой страницы.
		*
		*	@return Описание страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function prepares page generation.
		*
		*	@param $PageName - Name of the composing page.
		*
		*	@return Page description.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			prepare_page_generation( $PageName )
		{
			try
			{
				if( GZIP_TRAFFIC )
				{
					@ob_start( 'ob_gzhandler' , 9 );
				}
				$this->Messages->get_success_message_from_session();
				$PageDescription = $this->PageAccess->get_page_description( $PageName );

				$this->PageComposerUtilities->translate_template_name( $this , $PageDescription );

				return( $PageDescription );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Установка метаданных для страницы.
		*
		*	@param $PageDescription - Описание страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets page's metadata.
		*
		*	@param $PageDescription - Page's description.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	set_page_meta_info( &$PageDescription )
		{
			try
			{
				$this->PageMeta->set_page_title( $PageDescription[ 'title' ] );
				$this->PageMeta->add_page_keywords( $PageDescription[ 'keywords' ] );
				$this->PageMeta->add_page_description( $PageDescription[ 'description' ] );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Выборка раскладки шаблона.
		*
		*	@param $PageDescription - Описание страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns template's layout.
		*
		*	@param $PageDescription - Page description.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	load_layout( $PageDescription )
		{
			try
			{
				$Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$Settings->load_settings( $PageDescription[ 'options' ] );
				$this->Layout = $Settings->get_setting( 'layout' , 'default' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Выборка данных для генерации страницы.
		*
		*	@param $Page - Объект страницы.
		*
		*	@param $PageName - Имя компонуемой страницы.
		*
		*	@param $PageDescription - Описание страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fetches page generation data.
		*
		*	@param $Page - Page object.
		*
		*	@param $PageName - Name of the composing page.
		*
		*	@param $PageDescription - Page description.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			fetch_page_data( &$Page , $PageName , $PageDescription )
		{
			try
			{
				$this->Trace->add_trace_string( "{lang:fetching_data} : $PageName" , COMMON );
				$this->Template = $this->PageComposerUtilities->get_template_for_package( $PageDescription );

				$this->set_page_meta_info( $PageDescription );

				$Options = $PageDescription[ 'options' ];
				$this->Packages = $this->PageParts->get_package_appliance( $Page , $PageName , $Options );

				$this->load_layout( $PageDescription );

				$this->PageParts->fetch_packages( $this->Packages , $this->Template );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Генерация страницы.
		*
		*	@param $String - Страница.
		*
		*	@param $Options - Опции генерации.
		*
		*	@return Страница.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function generates page.
		*
		*	@param $String - Page content.
		*
		*	@param $Options - Generation options.
		*
		*	@return Page content.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	apply_options( $String , $Options )
		{
			try
			{
				$Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );

				$Settings->load_settings( $Options );

				return( $this->String->print_record( $String , $Settings->get_raw_settings() ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Генерация страницы.
		*
		*	@param $Template - Шаблон.
		*
		*	@param $PageDescription - Описание страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function generates page.
		*
		*	@param $Template - Template.
		*
		*	@param $PageDescription - Page description.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	before_generation( &$Template , $PageDescription )
		{
			try
			{
				$this->PageParts->execute_generators( $this->Packages , 'pre_generation' , $Template );

				$String = $Template->get_template();
				if( $this->String->block_exists( $String , 'layout' ) )
				{
					$String = str_replace( '{layout}' , '{include:'.$this->Layout.'}' , $String );
				}

				$String = $this->PageParts->execute_processors( $this->Packages , $String , 'pre_process' );
				$String = $this->apply_options( $String , $PageDescription[ 'options' ] );
				$Template->set_template( $String );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Обработка постпроцессинга.
		*
		*	@param $String - Строка для обработки.
		*
		*	@param $Type - Тип процессора для запуска.
		*
		*	@return Обработанная строка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function runs postprocessing.
		*
		*	@param $String - String to process.
		*
		*	@param $Type - Processor type.
		*
		*	@return Processed string.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			execute_processors( $String , $Type )
		{
			try
			{
				return( $this->PageParts->execute_processors( $this->Packages , $String , $Type ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Генерация страницы.
		*
		*	@param $Template - Шаблон.
		*
		*	@param $PageDescription - Описание страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function generates page.
		*
		*	@param $Template - Template.
		*
		*	@param $PageDescription - Page description.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	after_generation( &$Template , $PageDescription )
		{
			try
			{
				$String = $Template->get_template();
				$String = $this->execute_processors( $String , 'post_process' );
				$Template->set_template( $String );

				$this->PageParts->execute_generators( $this->Packages , 'post_generation' , $Template );

				$this->PageComposerUtilities->output_trace_if_necessary( $this );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Генерация страницы.
		*
		*	@param $Page - Объект страницы.
		*
		*	@param $PageName - имя компонуемой страницы.
		*
		*	@param $PageDescription - Описание страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function generates page.
		*
		*	@param $Page - Page object.
		*
		*	@param $PageName - Name of the composing page.
		*
		*	@param $PageDescription - Page description.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			generation_loop( &$Page , $PageName , $PageDescription )
		{
			try
			{
				$this->Trace->add_trace_string( "{lang:run_generation_loop} : $PageName" , COMMON );
				$this->before_generation( $this->Template , $PageDescription );

				$this->Template->process( $PageName );
				$this->process_direct_controllers();
				$this->PageParts->process_controllers( $this->Packages );
				$this->PageParts->process_views( $this->Packages , $this->Template );

				$this->process_direct_views();

				$this->after_generation( $this->Template , $PageDescription );

				$this->Template->cleanup( $PageName , $PageDescription[ 'options' ] );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция, запускающая компоновку страницы.
		*
		*	@param $PageName - имя компонуемой страницы.
		*
		*	@return HTML код скомпонованной страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function starts page composition.
		*
		*	@param $PageName - Name of the composing page.
		*
		*	@return HTML code of the composed page.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_page( $PageName )
		{
			try
			{
				$PageDescription = $this->prepare_page_generation( $PageName );

				if( $PageDescription !== false )
				{
					$this->Trace->add_trace_string( "{lang:page_generation_start} : $PageName" , COMMON );
					$this->fetch_page_data( $this->PageAccess , $PageName , $PageDescription );

					$this->generation_loop( $this->PageAccess , $PageName , $PageDescription );

					return( $this->Template->get_template() );
				}
				$this->Trace->add_trace_string( "{lang:requested_page_was_not_found} : $PageName" , ERROR );
				return( $this->get_page( '404' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки контроллеров.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function process controllers.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_direct_controllers()
		{
			try
			{
				$this->Trace->start_group( "direct_controllers" );

				$String = $this->Template->get_template();

				$Changed = false;
				list( $String , $Changed ) = $this->PageMarkup->process_direct_controller( $String , $Changed );

				$this->Template->set_template( $String );

				$this->Trace->end_group();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки видов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function process views.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_direct_views()
		{
			try
			{
				$this->Trace->start_group( "direct_views" );

				$this->Security->reset_s( 'direct_view' , true );

				$String = $this->Template->get_template();

				$Changed = false;
				list( $String , $Changed ) = $this->PageMarkup->process_direct_view( $String , $Changed );

				$this->Template->set_template( $String );

				$this->Security->reset_s( 'direct_view' , false );

				$this->Trace->end_group();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отвечающая за постобработку.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Str - Постобрабатывемая строка.
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
		*	\~english Function postprocesses forms and controls.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Str - Postprocessing string.
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
				list( $Str , $Changed ) = $this->PageMeta->set_page_info( $Str , $Changed );

				$this->process_direct_views();

				$Str = $this->PageMarkup->process_meta( $Options , $Str , $Changed );

				list( $Str , $Changed ) = $this->PageMarkup->process_direct_view( $Str , $Changed );

				list( $Str , $Changed ) = $this->PageMarkup->process_direct_controller( $Str , $Changed );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>