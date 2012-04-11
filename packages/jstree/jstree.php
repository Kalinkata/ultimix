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
	class	jstree_1_0_0{
		
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
		var					$PageJS = false;
		var					$String = false;
		var					$Settings = false;

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
				$this->PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
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
				$Path = '{http_host}/'._get_package_relative_path_ex( 'jstree' , get_package_version_s( __CLASS__ ) );

				$this->PageJS->add_javascript( "$Path/include/js/jquery.jstree.js" );
				$this->PageJS->add_javascript( "$Path/include/js/jquery.jstree.buttons.js" );
				$this->PageJS->add_javascript( "$Path/include/js/jquery.jstree.autorun.default.js" );
				$this->PageJS->add_javascript( "$Path/include/js/jquery.jstree.extractor.js" );

				$Lang = get_package( 'lang' , 'last' , __FILE__ );
				$Lang->include_strings_js( 'jstree' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Вид для скриптовой библиотеки (отвечает за подключение библиотеки).
		*
		*	@param $Options - не используется.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english View for the scripting library.
		*
		*	@param $Options - not used.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function	view( $Options )
		{
			try
			{
				if( $Options->get_setting( 'tree_control' , false ) )
				{
					$ComponentHTML = '{tree_control:'.$Options->get_all_settings().'}';
					$Changed = false;
					$ComponentHTML = $this->process_string( $Options , $ComponentHTML , $Changed );
					return( $ComponentHTML );
				}
				
				if( $Options->get_setting( 'tree_control_buttons' , false ) )
				{
					$ComponentHTML = '{tree_control_buttons:'.$Options->get_all_settings().'}';
					$Changed = false;
					$ComponentHTML = $this->process_string( $Options , $ComponentHTML , $Changed );
					return( $ComponentHTML );
				}
				
				return( '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции макроса 'tree_control'.
		*
		*	@param $Settings - Настройки.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'tree_control'.
		*
		*	@param $Settings - Options.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_tree_control( &$Settings )
		{
			try
			{
				$Selector = $Settings->get_setting( 'selector' , false );
				if( $Selector === false )
				{
					$Path = _get_package_relative_path_ex( 'jstree' , get_package_version_s( __CLASS__ ) );
					$Path = "{http_host}/$Path/include/js";
					$this->PageJS->add_javascript( "$Path/jquery.jstree.autorun.default.js" );
					$Control = '';
				}
				else
				{
					$Control = $this->CachedMultyFS->get_template( __FILE__ , 'tree_control.tpl' );
					$Control = str_replace( '{selector}' , $Selector );
				}
				return( $Control );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'tree_control'.
		*
		*	@param $Options - Настройки.
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
		*	\~english Function processes macro 'tree_control'.
		*
		*	@param $Options - Options.
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
		function			process_tree_control( &$Options , $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'tree_control' ) ; )
				{
					$this->Settings->load_settings( $Parameters );

					$Control = $this->compile_tree_control( $this->Settings );

					$Str = str_replace( "{tree_control:$Parameters}" , $Control , $Str );
					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		//TODO move this package to the GUI package
		
		/**
		*	\~russian Функция компиляции макроса 'tree_control_buttons'.
		*
		*	@param $Options - Настройки.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'tree_control_buttons'.
		*
		*	@param $Options - Options.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_tree_control_buttons( &$Options )
		{
			try
			{
				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'tree_control_buttons.tpl' );

				$Selector = $Options->get_setting( 'tree_control_selector' , '.tree_control' );
				$Code = str_replace( '{tree_control_selector}' , $Selector , $Code );

				$DirectCategory = $Options->get_setting( 'direct_category' , '14' );
				$Code = str_replace( '{direct_category}' , $DirectCategory , $Code );

				$Code = $this->String->print_record( $Code , $Options );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'tree_control_buttons'.
		*
		*	@param $Options - Настройки.
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
		*	\~english Function processes macro 'tree_control_buttons'.
		*
		*	@param $Options - Options.
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
		function			process_tree_control_buttons( &$Options , $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'tree_control_buttons' ) ; )
				{
					$Control = $this->compile_tree_control_buttons( $Options );
					
					$Str = str_replace( "{tree_control_buttons:$Parameters}" , $Control , $Str );
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
		*	\~russian Функция отвечающая за обработку.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Str - Обрабатывемая строка.
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
		*	\~english Function processes forms and controls.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Str - Processing string.
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
				$Str = str_replace( '{tree_control}' , '{tree_control:p=1}' , $Str );
				
				list( $Str , $Changed ) = $this->process_tree_control( $Options , $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_tree_control_buttons( $Options , $Str , $Changed );
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>