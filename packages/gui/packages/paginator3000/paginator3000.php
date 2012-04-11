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
	*	\~russian Класс для подключения компонента paginator3000.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class loads paginator3000 component.
	*
	*	@author Dodonov A.A.
	*/
	class	paginator3000_1_0_0{

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
		var					$MacroParameters = false;
		var					$CachedMultyFS = false;
		var					$PageCSS = false;
		var					$PageJS = false;
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
				$this->MacroParameters = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->PageCSS = get_package( 'page::page_css' , 'last' , __FILE__ );
				$this->PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
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
				$Page = _get_package_relative_path_ex( 'gui::paginator3000' , '1.0.0' );
				$this->PageJS->add_javascript( "{http_host}/$Page/include/js/paginator3000.js" );
				$this->PageCSS->add_stylesheet( "{http_host}/$Page/res/css/paginator3000.css" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция копиляции макроса 'paginator3000'.
		*
		*	@param $MacroParameters - Параметры обработки.
		*
		*	@return Виджет.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'paginator3000'.
		*
		*	@param $MacroParameters - Processing options.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_paginator3000( &$MacroParameters )
		{
			try
			{
				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'paginator3000.tpl' );
				$PlaceHolders = array( 
					'{id}' , '{page_count}' , '{visible_page_count}' , '{current_page}' , '{page_url}'
				);
				$Values = array(
					$MacroParameters->get_setting( 'id' , md5( microtime( true ) ) ) , 
					$MacroParameters->get_setting( 'page_count' ) , 
					$MacroParameters->get_setting( 'visible_page_count' , 10 ) , 
					$MacroParameters->get_setting( 'current_page' , 1 ) , 
					$MacroParameters->get_setting( 'page_url' )
				);

				return( str_replace( $PlaceHolders , $Values , $Code ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отвечающая за обработку строки.
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
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'paginator3000' ) ; )
				{
					$this->MacroParameters->load_settings( $Parameters );

					$Code = $this->compile_paginator3000( $MacroParameters );

					$Str = str_replace( "{paginator3000:$Parameters}" , $Code , $Str );
					$Changed = true;
				}
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>