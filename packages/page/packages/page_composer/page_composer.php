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
		var					$AutoMarkup = false;
		var					$CachedFS = false;
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
				$this->AutoMarkup = get_package( 'page::auto_markup' , 'last' , __FILE__ );
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
				$this->CachedFS = get_package( 'cached_fs' , 'last' , __FILE__ );
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
		function			pre_generation( $Options )
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
		*	@param $Str - Страница.
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
		*	@param $Str - Page content.
		*
		*	@param $Options - Generation options.
		*
		*	@return Page content.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	apply_options( $Str , $Options )
		{
			try
			{
				$Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );

				$Settings->load_settings( $Options );

				$Raw = $Settings->get_raw_settings();

				return( $this->String->print_record( $Str , $Raw ) );
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

				$Str = $Template->get_template();
				if( $this->String->block_exists( $Str , 'layout' ) )
				{
					$Str = str_replace( '{layout}' , '{include:'.$this->Layout.'}' , $Str );
				}

				$Str = $this->apply_options( $Str , $PageDescription[ 'options' ] );

				$Template->set_template( $Str );
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
				$Str = $Template->get_template();

				if( strpos( $PageDescription[ 'options' ] , 'process_macro=0' ) === false )
				{
					$Str = $this->AutoMarkup->compile_string( $Str );
				}

				$Template->set_template( $Str );

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
		*	@param $PageName - Name of the composing page.
		*
		*	@param $PageDescription - Page description.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			generation_loop( $PageName , $PageDescription )
		{
			try
			{
				$this->Trace->add_trace_string( "{lang:run_generation_loop} : $PageName" , COMMON );

				$this->before_generation( $this->Template , $PageDescription );

				$this->Template->process( $PageName );

				$this->PageParts->compile_controllers( $this->Packages );
				$this->PageParts->compile_views( $this->Packages , $this->Template );

				$this->after_generation( $this->Template , $PageDescription );

				$this->Template->cleanup( $PageName , $PageDescription[ 'options' ] );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Проверка существования скрипта.
		*
		*	@param $PageName - Имя компонуемой страницы.
		*
		*	return true/false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Does html script exists.
		*
		*	@param $PageName - Name of the composing page.
		*
		*	return true/false.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	html_script_exists( $PageName )
		{
			try
			{
				$PageName = $this->Security->get( $PageName , 'string' );

				return( $this->CachedFS->file_exists( "./$PageName.html" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение скомпилированного скрипта.
		*
		*	@param $PageName - Имя компонуемой страницы.
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
		private function	get_html_script( $PageName )
		{
			try
			{
				$PageName = $this->Security->get( $PageName , 'string' );

				$Page = $this->CachedFS->file_get_contents( "./$PageName.html" );

				$Page = str_replace( array( '<?php' , '?>' ) , array( '{<?php}' , '{?>}' ) , $Page );

				for( ; $this->String->block_exists( $Page , '<?php' , '?>' ) ; )
				{
					$PHPScript = $this->String->get_block_data( $Page , '<?php' , '?>' );
					ob_start();
					eval( $PHPScript );
					$Page = str_replace( "{<?php}$PHPScript{?>}" , ob_get_contents() , $Page );
					ob_end_clean();
				}

				return( $this->AutoMarkup->compile_string( $Page ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение скомпилированного скрипта.
		*
		*	@param $PageName - Имя компонуемой страницы.
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
		private function	get_data_script( $PageName )
		{
			try
			{
				$PageDescription = $this->prepare_page_generation( $PageName );
				
				if( $PageDescription !== false )
				{
					$this->Trace->add_trace_string( "{lang:page_generation_start} : $PageName" , COMMON );
					$this->fetch_page_data( $this->PageAccess , $PageName , $PageDescription );
					$this->generation_loop( $PageName , $PageDescription );

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
		*	\~russian Функция, запускающая компоновку страницы.
		*
		*	@param $PageName - Имя компонуемой страницы.
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
				if( $this->html_script_exists( $PageName ) )
				{
					return( $this->get_html_script( $PageName ) );
				}
				else
				{
					return( $this->get_data_script( $PageName ) );
				}
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
				$PageMarkupUtilities = get_package( 
					'page::page_markup::page_markup_utilities' , 'last' , __FILE__ 
				);

				if( $Options->get_setting( 'direct_view' , false ) )
				{
					$Options->load_from_http();

					return( $PageMarkupUtilities->direct_view( $Options ) );
				}
				if( $Options->get_setting( 'direct_controller' , false ) )
				{
					$Options->load_from_http();

					$PageMarkupUtilities->direct_controller( $Options );

					return;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>