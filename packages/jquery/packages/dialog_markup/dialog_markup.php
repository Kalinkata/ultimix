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
	*	\~russian Класс для обработкид иалоговых макросов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes dialog macroes.
	*
	*	@author Dodonov A.A.
	*/
	class	dialog_markup_1_0_0{

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
		var					$PageComposer = false;
		var					$Settings = false;
		var					$String = false;
		var					$Utilities = false;

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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->DialogMarkupUtilities = get_package( 
					'jquery::dialog_markup::dialog_markup_utilities' , 'last' , __FILE__
				);
				$this->PageComposer = get_package( 'page::page_composer' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Utilities = get_package( 'utilities' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Подготовка скрипта диалога.
		*
		*	@param $Settings - Настройки.
		*
		*	@return Скрипт.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Preparing dialog script.
		*
		*	@param $Settings - Settings.
		*
		*	@return Dialog script.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_select_dialog_script( &$Settings )
		{
			try
			{
				$id = $Settings->get_setting( 'id' , md5( microtime( true ) ) );

				$Type = $Settings->get_setting( 'type' , 'simple' );
				$Script = $Type == 'simple' ? 
					$this->CachedMultyFS->get_template( __FILE__ , 'simple_select_dialog.tpl' ) : '';

				$Script = str_replace( '{id}' , $id , $Script );
				$SimpleRecords = $this->DialogMarkupUtilities->select_dialog_content( $ettings );
				$Script = str_replace( '{records}' , $SimpleRecords , $Script );
				
				return( $Script );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'select_dialog_content'.
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
		*	\~english Function processes macro 'select_dialog_content'.
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
		private function	process_select_dialog_content( $Str , $Changed )
		{
			try
			{
				// TODO: run macro compilation funtions in 'auto_markup'
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'select_dialog_content' ) ; )
				{
					$this->Settings->load_settings( $Parameters );

					$Script = $this->compile_select_dialog_script( $this->Settings );

					$Str = str_replace( "{select_dialog_content:$Parameters}" , $Script , $Str );
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
		*	\~russian Функция компиляции макроса 'select_dialog'.
		*
		*	@param $BlockSettings - Параметры компиляции.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'select_dialog'.
		*
		*	@param $BlockSettings - Compilation parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_select_dialog( &$Settings )
		{
			try
			{
				$DataSource = $Settings->get_setting( 'data_source' , md5( rand().microtime( true ) ) );
				$Settings->set_setting( 'data_source' , $DataSource );
				
				$id = $Settings->get_setting( 'id' , md5( microtime( true ) ) );
				$Settings->set_setting( 'id' , $id );
				
				$Code = '{select_dialog_content:'.$Settings->get_all_settings().
									'}{dialog:selector=#'.$id.';'.$Settings->get_all_settings().
									';cancel=true;ok_processor=ultimix.ExtractSimpleSelectResult}';
				
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'select_dialog'.
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
		*	\~english Function processes macro 'select_dialog'.
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
		function			process_select_dialog( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'select_dialog' ) ; )
				{
					$this->Settings->load_settings( $Parameters );

					$Code = $this->compile_select_dialog( $this->Settings );

					$Str = str_replace( "{select_dialog:$Parameters}" , $Code , $Str );
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
		*	\~russian Функция компиляции макроса 'view_dialog'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'view_dialog'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_view_dialog( &$Settings )
		{
			try
			{
				$id = $Settings->get_setting( 'id' , md5( microtime( true ) ) );

				$Code = '';
				if( isset( $this->Dialogs[ $id ] ) === false )
				{
					$Code = $this->CachedMultyFS->get_template( __FILE__ , 'view_dialog.tpl' );
					$Code = str_replace( '{id}' , $id , $Code );
					$Code = str_replace( '{all_settings}' , $Settings->get_all_settings() , $Code );
					$this->Dialogs[ $id ] = true;
				}
				
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'view_dialog'.
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
		*	\~english Function processes macro 'view_dialog'.
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
		function			process_view_dialog( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'view_dialog' ) ; )
				{
					$this->Settings->load_settings( $Parameters );
					
					$Code = $this->compile_view_dialog( $this->Settings );

					$Str = str_replace_once( "{view_dialog:$Parameters}" , $Code , $Str );
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
		*	\~russian Функция обработки макроса 'static_dialog'.
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
		*	\~english Function processes macro 'static_dialog'.
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
		function			process_static_dialog( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'static_dialog' ) ; )
				{
					$this->Settings->load_settings( $Parameters );
					
					$id = $this->Settings->get_setting( 'id' , md5( microtime( true ) ) );
					$Script = $this->CachedMultyFS->get_template( __FILE__ , 'static_dialog.tpl' );
					$Script = str_replace( '{id}' , $id , $Script );
					$Script = str_replace( '{all_settings}' , $this->Settings->get_all_settings() , $Script );
					
					$Str = str_replace( "{static_dialog:$Parameters}" , $Script , $Str );
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
		*	\~russian Функция компиляции макроса 'iframe_dialog'.
		*
		*	@param $BlockSettings - Параметры компиляции.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'iframe_dialog'.
		*
		*	@param $BlockSettings - Compilation parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_iframe_dialog( &$Settings )
		{
			try
			{
				$id = $Settings->get_setting( 'id' , md5( microtime( true ) ) );
				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'iframe_dialog.tpl' );

				$PlaceHolders = array( '{id}' , '{href}' , '{all_settings}' );
				$Data = array( $id , $Settings->get_setting( 'href' ) , $Settings->get_all_settings() );
				$Code = str_replace( $PlaceHolders , $Data , $Code );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'iframe_dialog'.
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
		*	\~english Function processes macro 'iframe_dialog'.
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
		function			process_iframe_dialog( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'iframe_dialog' ) ; )
				{
					$this->Settings->load_settings( $Parameters );

					$Code = $this->compile_iframe_dialog( $this->Settings );

					$Str = str_replace( "{iframe_dialog:$Parameters}" , $Code , $Str );
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
		*	\~russian Компиляция опенера.
		*
		*	@param $Settings - Настройки.
		*
		*	@return Код опенера.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles opener.
		*
		*	@param $Settings - Settings.
		*
		*	@return Code of the opener.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_opener( &$Settings )
		{
			try
			{
				list( $Selector , $Opener )= $Settings->get_settings( 'selector,opener' );
				$DataSource = $Settings->get_setting( 'data_source' , $Selector );
				$DataAcceptor = $Settings->get_setting( 'data_acceptor' , '' );
				$StatusAcceptor = $Settings->get_setting( 'status_acceptor' , '' );
				$Validation = $Settings->get_setting( 'before_open_validation' , 'nop' );
				
				return( 
					"{add_opener:data_source=$DataSource;data_acceptor=$DataAcceptor;status_acceptor=$StatusAcceptor;".
					"before_open_validation=$Validation;opener=$Opener;selector=$Selector}"
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Добавление опенера если необходимо.
		*
		*	@param $Code - Скрипт создания диалога.
		*
		*	@return Код опенера.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function adds opener.
		*
		*	@param $Code - Dialog init script.
		*
		*	@return Code of the opener.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			append_add_opener_if_necessary( $Code )
		{
			try
			{
				if( $this->Settings->get_setting( 'opener' , '' ) != '' )
				{
					$Code .= $this->compile_opener( $this->Settings );
				}
				
				return( $Code );
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
		private function	prepare_basic_settings()
		{
			try
			{
				$this->Settings->set_undefined( 'title' , '' );
				$this->Settings->set_undefined( 'width' , '480' );
				$this->Settings->set_undefined( 'height' , '320' );
				$this->Settings->set_undefined( 'modal' , 'true' );
				$this->Settings->set_undefined( 'auto_open' , 'false' );
				$this->Settings->set_undefined( 'close_on_escape' , 'true' );
				$this->Settings->set_undefined( 'resizable' , 'true' );
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
		private function	prepare_data_for_dialog()
		{
			try
			{
				$this->Settings->get_setting( 'selector' );
				
				$this->prepare_basic_settings();
				
				$this->Settings->set_undefined( 'hide_close_button' , 'false' );
				$this->Settings->set_undefined( 'ok_processor' , '' );
				$this->Settings->set_undefined( 'cancel' , 'false' );
				$this->Settings->set_undefined( 'on_open' , 'nop()' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'dialog'.
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
		*	\~english Function processes macro 'dialog'.
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
		function			process_dialog( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'dialog' ) ; )
				{
					$this->Settings->load_settings( $Parameters );

					$this->prepare_data_for_dialog();

					$Code = $this->CachedMultyFS->get_template( __FILE__ , 'dialog_init.tpl' );

					$Data = $this->Settings->get_raw_settings();

					$Code = $this->String->print_record( $Code , $Data );

					$Code = $this->append_add_opener_if_necessary( $Code );

					$Str = str_replace( "{dialog:$Parameters}" , $Code , $Str );
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
		private function	prepare_data_for_opener()
		{
			try
			{
				$this->Settings->get_setting( 'selector' );
				$this->Settings->get_setting( 'opener' );
				
				$this->Settings->set_undefined( 'before_open_validation' , 'nop' );
				$this->Settings->set_undefined( 'data_source' , '' );
				$this->Settings->set_undefined( 'data_acceptor' , '' );
				$this->Settings->set_undefined( 'status_acceptor' , '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'add_opener'.
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
		*	\~english Function processes macro 'add_opener'.
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
		function			process_add_opener( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'add_opener' ) ; )
				{
					$this->Settings->load_settings( $Parameters );
					
					$this->prepare_data_for_opener();
					
					$AddOpenerScript = $this->CachedMultyFS->get_template( __FILE__ , 'add_opener.tpl' );
					$Data = $this->Settings->get_raw_settings();
					$AddOpenerScript = $this->String->print_record( $AddOpenerScript , $Data );
					
					$Str = str_replace( "{add_opener:$Parameters}" , $AddOpenerScript , $Str );
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
				list( $Str , $Changed ) = $this->process_select_dialog_content( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_select_dialog( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_view_dialog( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_static_dialog( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_iframe_dialog( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_dialog( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_add_opener( $Str , $Changed );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>