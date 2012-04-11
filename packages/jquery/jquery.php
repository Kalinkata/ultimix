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
	*	\~russian Класс для подключения библиотеки jquery.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class loads jquery library.
	*
	*	@author Dodonov A.A.
	*/
	class	jquery_1_7_1{

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
		var					$JQueryMarkup = false;
		var					$PageCSS = false;
		var					$PageJS = false;

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
				$this->JQueryMarkup = get_package( 'jquery::jquery_markup' , 'last' , __FILE__ );
				$this->PageCSS = get_package( 'page::page_css' , 'last' , __FILE__ );
				$this->PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция предгенерационных действий.
		*
		*	@param $Path - Путь к скриптам.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function executes before any page generating actions took place.
		*
		*	@param $Path - Path to the scripts.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	load_jquery_core( $Path )
		{
			try
			{
				$this->PageJS->add_javascript( "$Path/include/js/jquery-1.7.1.min.js" );
				$this->PageJS->add_javascript( "$Path/include/js/jquery-ui-1.8.17.custom.min.js" );
				$this->PageJS->add_javascript( "$Path/include/js/lang/ui.datepicker-ru.js" );
				$this->PageJS->add_javascript( "$Path/include/js/jquery.cookie.js" );
				$this->PageJS->add_javascript( "$Path/include/js/jquery.accordion.autorun.js" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция предгенерационных действий.
		*
		*	@param $Path - Путь к скриптам.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function executes before any page generating actions took place.
		*
		*	@param $Path - Path to the scripts.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	load_framework_scripts( $Path )
		{
			try
			{
				$this->PageJS->add_javascript( "$Path/include/js/jquery.simple.select.extractor.js" );
				$this->PageJS->add_javascript( "$Path/include/js/jquery.wrappers.js" );
				$this->PageJS->add_javascript( "$Path/include/js/request_manager.js" );
				$this->PageJS->add_javascript( "$Path/include/js/tabs_ex.js" );
				$this->PageJS->add_javascript( "$Path/include/js/print.js" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция предгенерационных действий.
		*
		*	@param $Path - Путь к скриптам.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function executes before any page generating actions took place.
		*
		*	@param $Path - Path to the scripts.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	load_widgets_scripts( $Path )
		{
			try
			{
				$this->PageJS->add_javascript( "$Path/include/js/jquery.dropdown.block.js" );
				$this->PageJS->add_javascript( "$Path/include/js/jquery.timer.widget.js" );
				$this->PageJS->add_javascript( "$Path/include/js/jquery.disable.text.select.js" );
				$this->PageJS->add_javascript( "$Path/include/js/jquery.dialog.js" );
				$this->PageJS->add_javascript( "$Path/include/js/wizard.js" );
				$this->PageJS->add_javascript( "$Path/include/js/iframe.dialog.js" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция предгенерационных действий.
		*
		*	@param $Path - Путь к скриптам.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function executes before any page generating actions took place.
		*
		*	@param $Path - Path to the scripts.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	load_styles_and_languages( $Path )
		{
			try
			{
				$this->PageCSS->add_stylesheet( 
					"$Path/res/css/jquery-ui-1.8.{color_scheme:available=red,green,black,default,custom}.css"
				);
				$this->PageCSS->add_stylesheet( "$Path/res/css/jquery-ui-1.8.patch.css" );

				$Lang = get_package( 'lang' , 'last' , __FILE__ );
				$Lang->include_strings_js( 'settings::settings_view' );
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
		function			pre_generation( &$Options )
		{
			try
			{
				$Path = '{http_host}/'._get_package_relative_path_ex( 'jquery' , 'last' );

				$this->load_jquery_core( $Path );

				$this->load_framework_scripts( $Path );

				$this->load_widgets_scripts( $Path );

				$this->load_styles_and_languages( $Path );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Вид добавления вкладки.
		*
		*	@param $Options - Настроки вида.
		*
		*	@return HTML код.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english View for additing tab.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_tab_view( &$Options )
		{
			try
			{
				$id = $Options->get_setting( 'id' );
				$Title = $Options->get_setting( 'title' , 'title' );
				$Index = $Options->get_setting( 'index' , -1 );
				$Closable = $Options->get_setting( 'closable' , 'false' );
				$ContentId = $Options->get_setting( 'content_id' );
				$Changed = false;

				$AddTab = $this->JQueryMarkup->process_string( 
					$Options , "{add_tab:id=$id;content_id=$ContentId;title=$Title;index=$Index;closable=$Closable}" , 
					$Changed
				);

				return( $AddTab );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Вид добавления вкладки.
		*
		*	@param $Options - Настроки вида.
		*
		*	@return HTML код.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english View for additing tab.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_iframe_tab_view( &$Options )
		{
			try
			{
				$id = $Options->get_setting( 'id' );
				$Title = $Options->get_setting( 'title' , 'title' );
				$Index = $Options->get_setting( 'index' , -1 );
				$Closable = $Options->get_setting( 'closable' , 'false' );
				$URL = $Options->get_setting( 'url' );
				$Changed = false;

				$AddIFrameTab = $this->JQueryMarkup->process_string( 
					$Options , "{add_iframe_tab:id=$id;url=$URL;title=$Title;index=$Index;closable=$Closable}" , 
					$Changed
				);

				return( $AddIFrameTab );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Вид для скриптовой библиотеки (отвечает за подключение библиотеки).
		*
		*	@param $Options - Настроки вида.
		*
		*	@return HTML код.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english View for the scripting library.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( &$Options )
		{
			try
			{
				if( $Options->get_setting( 'tab_control' , '0' ) == '1' )
				{
					$id = $Options->get_setting( 'id' , md5( microtime( true ) ) );
					$Changed = false;

					return( $this->JQueryMarkup->process_string( $Options , "{tab_control:id=$id}" , $Changed ) );
				}

				if( $Options->get_setting( 'add_tab' , '0' ) == '1' )
				{
					return( $this->add_tab_view( $Options ) );
				}

				if( $Options->get_setting( 'add_iframe_tab' , '0' ) == '1' )
				{
					return( $this->add_iframe_tab_view( $Options ) );
				}

				return( '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>