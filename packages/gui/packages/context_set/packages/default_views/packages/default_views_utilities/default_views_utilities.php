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
	*	\~russian Класс дефолтовых видов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class of the default views.
	*
	*	@author Dodonov A.A.
	*/
	class	default_views_utilities_1_0_0{
	
		/**
		*	\~russian Закешированные пакеты.
		*
		*	@author Dodonov A.A.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$CachedMultyFS = false;
		var					$ContextSetUtilities = false;
		var					$Search = false;
		var					$Security = false;
		var					$Settings = false;
		var					$String = false;
	
		/**
		*	\~russian Префикс.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Prefix.
		*
		*	@author Dodonov A.A.
		*/
		var					$Prefix = false;
		
		/**
		*	\~russian Объект класса представляющего функции-обработчики.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Object of the class wich provides all handlers.
		*
		*	@author Dodonov A.A.
		*/
		var					$Provider = false;
		
		/**
		*	\~russian Набор контекстов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Set of contexts.
		*
		*	@author Dodonov A.A.
		*/
		var					$ContextSet = false;
	
		/**
		*	\~russian Условие отбора записей для грида.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Record selection condition.
		*
		*	@author Dodonov A.A.
		*/
		var					$QueryString = '1 = 1';
	
		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
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
				$this->ContextSetUtilities = get_package( 
					'gui::context_set::context_set_utilities' , 'last' , __FILE__
				);
				$this->Search = get_package( 'search' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package_object( 'settings::settings' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Установка параметров работы.
		*
		*	@param $ContextSet - Набор контекстов.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets all necessary parameters.
		*
		*	@param $ContextSet - Set of contexts.
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_constants( &$ContextSet , &$Options )
		{
			try
			{
				$this->Prefix = $ContextSet->Prefix;
				$this->Provider = $ContextSet->Provider;
				$this->ContextSet = &$ContextSet;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция вывода данных из поста.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Form - Код формы.
		*
		*	@return Код формы.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws posted data.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Form - Form code.
		*
		*	@return Form code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function 			apply_posted_data_for_create_form( &$Options , $Form )
		{
			try
			{
				if( $Options->get_setting( 'get_post_extraction_script' , false ) )
				{
					$ExtractionScript = $Options->get_setting( 'get_post_extraction_script' );
					$SecurityParser = get_package( 'security::security_utilities' , 'last' , __FILE__ );
					$Record = $SecurityParser->parse_http_parameters( $ExtractionScript );
					$Form = $this->String->print_record( $Form , $Record );
				}
				
				return( $Form );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компилирует запрос поиска.
		*
		*	@param $CommonStateConfigPath - Путь к конфигу.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function builds sql query.
		*
		*	@param $CommonStateConfigPath - Path to the config file.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_query_string( $CommonStateConfigPath )
		{
			try
			{
				$Conf = $this->CachedMultyFS->file_get_contents( $CommonStateConfigPath );
				$Conf = str_replace( '{prefix}' , $this->Prefix , $Conf );
				$this->Settings->load_settings( $Conf );
				$Fields = $this->Settings->get_setting( 'search_fields' , false );
				
				if( $Fields !== false )
				{
					$Fields = explode( ',' , $Fields );
					
					$this->QueryString = $this->Search->build_query_string( $Fields );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компилирует строку поиска.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function builds query string.
		*
		*	@param $Options - Options of drawing.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	build_query_string( $Options )
		{
			try
			{
				$this->QueryString = '1 = 1';
				$SearchString = $this->Security->get_gp( 'search_string' , 'string' , '' );
				
				if( strlen( $SearchString ) )
				{
					$CommonStateConfigFileName = $Options->get_setting( 
						'common_state_config_search_form' , 'cfcxs_search_form'
					);
					
					$ComponentPath = dirname( $Options->get_setting( 'file_path' ) );
					
					$CommonStateConfigPath = "$ComponentPath/conf/$CommonStateConfigFileName";
					
					if( $this->CachedMultyFS->file_exists( $CommonStateConfigPath ) )
					{
						$this->compile_query_string( $CommonStateConfigPath );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макросов формы.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Form - Обрабатываемая форма.
		*
		*	@param $IdList - Идентифиакторы записей.
		*
		*	@return Обработанная форма.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes form macroes.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Form - Form to process.
		*
		*	@param $IdList - Record ids.
		*
		*	@return Processed form.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_form( &$Options , $Form , $IdList = false )
		{
			try
			{
				if( $IdList !== false )
				{
					$Record = $this->ContextSetUtilities->get_data_record( $Options , $IdList );
					
					$Record = $this->ContextSetUtilities->extract_data_from_request(
						$Options , $Record , 'get_post_extraction_script' , $this->Prefix
					);
					
					$Form = $this->ContextSetUtilities->set_form_data( $Form , $Record );
				}

				if( strpos( $Form , '{prefix}' ) !== false )
				{
					$Form = str_replace( '{prefix}' , $this->Prefix , $Form );
				}

				$Changed = false;
				$Form = $this->ContextSet->process_string( $Options , $Form , $Changed );

				return( $Form );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Конструирование грида.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Paging - Грид.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function constructs list of records.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Paging - Grid.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	set_paging_templates( &$Options , &$Paging )
		{
			try
			{
				$this->ContextSetUtilities->set_header_template( $Options , $Paging );
				$this->ContextSetUtilities->set_item_template( $Options , $Paging );
				$this->ContextSetUtilities->set_no_data_found_message( $Options , $Paging );
				$this->ContextSetUtilities->set_footer_template( $Options , $Paging );
				$this->ContextSetUtilities->set_main_settings( $Options , $Paging );
				$this->ContextSetUtilities->set_grid_data( $Options , $Paging , $this->QueryString );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Конструирование грида.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Paging - Грид.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function constructs list of records.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Paging - Grid.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			construct_paging( &$Options , &$Paging )
		{
			try
			{
				/* Paging primary initialization */
				$Paging->set( 'FormId' , $this->Prefix.'_form' );
				$Paging->set( 'Prefix' , $this->Prefix );

				/* Header buttons creation */
				$HeaderFields = 
					'<input type="hidden" name="{prefix}_context_action" id="{prefix}_context_action" value="">
					<input type="hidden" name="{prefix}_action" id="{prefix}_action" value="">
					<input type="hidden" name="{prefix}_record_id" id="{prefix}_record_id" value="">';
					
				$Paging->set( 'CustomButtons' , $HeaderFields );
				
				$this->build_query_string( $Options );
				
				$this->set_paging_templates( $Options , $Paging );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения шаблона.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $TemplateName - Название шаблона.
		*
		*	@return Шаблон.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns template.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $TemplateName - Template name.
		*
		*	@return Template.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_template( &$Options , $TemplateName )
		{
			try
			{
				$Template = $Options->get_setting( $TemplateName , '' );

				if( $Template !== '' )
				{
					$Template = dirname( $Options->get_setting( 'file_path' ) )."/res/templates/$TemplateName.tpl";

					$Template = $this->CachedMultyFS->file_get_contents( $Template );
				}
				
				return( $Template );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>