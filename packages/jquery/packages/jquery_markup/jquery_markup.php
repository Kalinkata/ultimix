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
	*	\~russian Класс для подключения макросов jquery.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class loads jquery macroes.
	*
	*	@author Dodonov A.A.
	*/
	class	jquery_markup_1_0_0{

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
		var					$Settings = false;
		var					$CachedMultyFS = false;
		var					$PageComposer = false;
		var					$String = false;

		/**
		*	\~russian Закэшированная информация о созданных диалогах.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached info about created packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$Dialogs = array();
		
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
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->PageComposer = get_package( 'page::page_composer' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'accordion_section'.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'accordion_section'.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_accordion_section( $Str , $Changed )
		{
			try
			{
				$Rules = array( 'master_id' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'accordion_section' , $Rules ) ; )
				{
					$this->Settings->load_settings( $Parameters );

					$Code = $this->CachedMultyFS->get_template( __FILE__ , 'accordeon_section.tpl' );
					$Code = str_replace( '{title}' , $this->Settings->get_setting( 'title' ) , $Code );
					
					$Str = str_replace( "{accordion_section:$Parameters}" , $Code , $Str );
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
		*	\~russian Функция обработки макроса 'tab_control'.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'tab_control'.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_tab_control( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'tab_control' ) ; )
				{
					$this->Settings->load_settings( $Parameters );
					$TabControl = $this->CachedMultyFS->get_template( __FILE__ , 'tab_control.tpl' );

					$Selector = $this->Settings->get_setting( 'selector' , md5( microtime( true ) ) );
					$id = $this->Settings->get_setting( 'id' , $Selector );
					
					$TabControl = str_replace( '{id}' , $id , $TabControl );
					
					$Str = str_replace( "{tab_control:$Parameters}" , $TabControl , $Str );
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
		*	\~russian Подготовка данных для создания диалога.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function prepares data for dialog.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	prepare_data_for_tab()
		{
			try
			{
				$this->Settings->get_setting( 'id' );
				$this->Settings->get_setting( 'content_id' );
				
				$this->Settings->set_undefined( 'title' , 'title' );
				$this->Settings->set_undefined( 'index' , -1 );
				$this->Settings->set_undefined( 'closable' , 'true' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'add_tab'.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'add_tab'.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_add_tab( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'add_tab' ) ; )
				{
					$this->Settings->load_settings( $Parameters );

					$this->prepare_data_for_tab();
					
					$Tab = $this->CachedMultyFS->get_template( __FILE__ , 'add_tab.tpl' );
					$Data = $this->Settings->get_raw_settings();
					$Tab = $this->String->print_record( $Tab , $Data );
					
					$Str = str_replace( "{add_tab:$Parameters}" , $Tab , $Str );
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
		*	\~russian Функция компиляции макроса 'add_iframe_tab'.
		*
		*	@param $Settings - Настройки.
		*
		*	@param $Tab - Код таба.
		*
		*	@return Виджет.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'add_iframe_tab'.
		*
		*	@param $Settings - Settings.
		*
		*	@param $Tab - Tab code.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_add_iframe_tab( &$Settings , $Tab )
		{
			try
			{
				$Selector = $Settings->get_setting( 'selector' , '' );
				$Tab = str_replace( '{id}' , $Settings->get_setting( 'id' , $Selector ) , $Tab );
				$Tab = str_replace( '{url}' , $Settings->get_setting( 'url' ) , $Tab );
				$Tab = str_replace( '{title}' , $Settings->get_setting( 'title' , 'title' ) , $Tab );
				$Tab = str_replace( '{index}' , $Settings->get_setting( 'index' , -1 ) , $Tab );
				$Tab = str_replace( '{height}' , $Settings->get_setting( 'height' , 'auto' ) , $Tab );
					return( str_replace( 
						'{closable}' , 
						$Settings->get_setting( 'closable' , false ) !== false ? 'true' : 'false' , $Tab
					) 
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'add_iframe_tab'.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'add_iframe_tab'.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_add_iframe_tab( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'add_iframe_tab' ) ; )
				{
					$this->Settings->load_settings( $Parameters );
					$Tab = $this->CachedMultyFS->get_template( __FILE__ , 'add_iframe_tab.tpl' );

					$Tab = $this->compile_add_iframe_tab( $this->Settings , $Tab );

					$Str = str_replace( "{add_iframe_tab:$Parameters}" , $Tab , $Str );
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
				/* TODO: move to auto_markup */
				list( $Str , $Changed ) = $this->process_accordion_section( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_tab_control( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_add_tab( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_add_iframe_tab( $Str , $Changed );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>