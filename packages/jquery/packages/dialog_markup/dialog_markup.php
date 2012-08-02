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
		var					$PageJS = false;
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
				$this->PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Utilities = get_package( 'utilities' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Компиляция контента.
		*
		*	@param $Settings - Параметры выборки.
		*
		*	@return array( $id , $DataSource , $Name ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Content compilation.
		*
		*	@param $Settings - Settings.
		*
		*	@return array( $id , $DataSource , $Name ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_dialog_parameters( &$Settings )
		{
			try
			{
				$id = md5( $Settings->get_setting( 'package_name' ).microtime( true ) );
				$DataSource = $Settings->get_setting( 'data_source' , $id );
				$Name = $Settings->get_setting( 'name' , $DataSource );

				return( array( $id , $DataSource , $Name ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Компиляция контента.
		*
		*	@param $Settings - Параметры выборки.
		*
		*	@return Скомпилированный контент диалога.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Content compilation.
		*
		*	@param $Settings - Settings.
		*
		*	@return Compiled dialog content.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	select_dialog_content( &$Settings )
		{
			try
			{
				list( $id , $DataSource , $Name ) = $this->get_dialog_parameters( $Settings );

				$Checked = 'checked';
				$Code = '';
				$Records = $this->Utilities->get_records( $Settings );
				foreach( $Records as $k => $v )
				{
					$PlaceHolders = array( '{checked}' , '{id}' , '{value}' , '{title}' );
					$id = $DataSource.get_field( $v , 'id' );
					$Data = array( $Checked , $id , get_field( $v , 'id' ) , get_field( $v , 'title' ) );
					$Code = $this->CachedMultyFS->get_template( __FILE__ , 'select_dialog_item.tpl' );
					$Code = str_replace( $PlaceHolders , $Data , $Code );
					$Checked = '';
				}

				return( $Code );
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
				$Path = '{http_host}/'._get_package_relative_path_ex( 'jquery::dialog_markup' , 'last' );

				$this->PageJS->add_javascript( "$Path/include/js/iframe.dialog.js" );
				$this->PageJS->add_javascript( "$Path/include/js/jquery.dialog.js" );
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
		function			compile_select_dialog_content( &$Settings )
		{
			try
			{
				$id = $Settings->get_setting( 'id' , md5( microtime( true ) ) );

				$Type = $Settings->get_setting( 'type' , 'simple' );
				$Script = $Type == 'simple' ? 
					$this->CachedMultyFS->get_template( __FILE__ , 'simple_select_dialog.tpl' ) : '';

				$Script = str_replace( '{id}' , $id , $Script );
				$SimpleRecords = $this->select_dialog_content( $ettings );
				$Script = str_replace( '{records}' , $SimpleRecords , $Script );

				return( $Script );
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
		function			compile_select_dialog( &$Settings )
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
		function			compile_view_dialog( &$Settings )
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
		*	\~russian Функция компиляции макроса 'static_dialog'.
		*
		*	@param $BlockSettings - Параметры.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'static_dialog'.
		*
		*	@param $BlockSettings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_static_dialog( &$BlockSettings )
		{
			try
			{
				$id = $BlockSettings->get_setting( 'id' , md5( microtime( true ) ) );
				$Script = $this->CachedMultyFS->get_template( __FILE__ , 'static_dialog.tpl' );
				$Script = str_replace( '{id}' , $id , $Script );
				$Script = str_replace( '{all_settings}' , $BlockSettings->get_all_settings() , $Script );

				return( $Script );
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
		function			compile_iframe_dialog( &$Settings )
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
		function			compile_opener( &$Settings )
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
		*	@param $BlockSettings - Параметры компиляции.
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
		*	@param $BlockSettings - Compilation parameters.
		*
		*	@return Code of the opener.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	append_add_opener_if_necessary( $Code , &$BlockSettings )
		{
			try
			{
				if( $BlockSettings->get_setting( 'opener' , '' ) != '' )
				{
					$Code .= $this->compile_opener( $BlockSettings );
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
		*	@param $BlockSettings - Параметры компиляции.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function prepares data for dialog.
		*
		*	@param $BlockSettings - Compilation parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	prepare_basic_settings( &$BlockSettings )
		{
			try
			{
				$BlockSettings->set_undefined( 'title' , '' );
				$BlockSettings->set_undefined( 'width' , '480' );
				$BlockSettings->set_undefined( 'height' , '320' );
				$BlockSettings->set_undefined( 'modal' , 'true' );
				$BlockSettings->set_undefined( 'auto_open' , 'false' );
				$BlockSettings->set_undefined( 'close_on_escape' , 'true' );
				$BlockSettings->set_undefined( 'resizable' , 'true' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Подготовка данных для создания диалога.
		*
		*	@param $BlockSettings - Параметры компиляции.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function prepares data for dialog.
		*
		*	@param $BlockSettings - Compilation parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			prepare_data_for_dialog( &$BlockSettings )
		{
			try
			{
				$BlockSettings->get_setting( 'selector' );

				$this->prepare_basic_settings( $BlockSettings );

				$BlockSettings->set_undefined( 'hide_close_button' , 'false' );
				$BlockSettings->set_undefined( 'ok_processor' , '' );
				$BlockSettings->set_undefined( 'cancel' , 'false' );
				$BlockSettings->set_undefined( 'on_open' , 'nop()' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'dialog'.
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
		*	\~english Function compiles macro 'dialog'.
		*
		*	@param $BlockSettings - Compilation parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_dialog( &$BlockSettings )
		{
			try
			{
				$this->prepare_data_for_dialog( $BlockSettings );

				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'dialog_init.tpl' );

				$Data = $BlockSettings->get_raw_settings();

				$Code = $this->String->print_record( $Code , $Data );

				$Code = $this->append_add_opener_if_necessary( $Code , $BlockSettings );

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
		*	@param $BlockSettings - Параметры компиляции.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function prepares data for dialog.
		*
		*	@param $BlockSettings - Compilation parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	prepare_data_for_opener( &$BlockSettings )
		{
			try
			{
				$BlockSettings->get_setting( 'selector' );
				$BlockSettings->get_setting( 'opener' );

				$BlockSettings->set_undefined( 'before_open_validation' , 'nop' );
				$BlockSettings->set_undefined( 'data_source' , '' );
				$BlockSettings->set_undefined( 'data_acceptor' , '' );
				$BlockSettings->set_undefined( 'status_acceptor' , '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'add_opener'.
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
		*	\~english Function compiles macro 'add_opener'.
		*
		*	@param $BlockSettings - Compilation parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_add_opener( &$BlockSettings )
		{
			try
			{
				$this->prepare_data_for_opener( $BlockSettings );

				$AddOpenerScript = $this->CachedMultyFS->get_template( __FILE__ , 'add_opener.tpl' );
				$Data = $BlockSettings->get_raw_settings();
				$AddOpenerScript = $this->String->print_record( $AddOpenerScript , $Data );

				return( $AddOpenerScript );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>