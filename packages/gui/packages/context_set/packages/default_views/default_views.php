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
	class	default_views_1_0_0{

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
		var					$DefaultViewsUtilities = false;
		var					$PageComposer = false;
		var					$Security = false;
		var					$String = false;
		var					$UserAlgorithms = false;
	
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
				$this->DefaultViewsUtilities = get_package( 
					'gui::context_set::default_views::default_views_utilities' , 'last' , __FILE__
				);
				$this->PageComposer = get_package( 'page::page_composer' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
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
				
				$this->DefaultViewsUtilities->set_constants( $ContextSet , $Options );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отображения списка записей.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws list of records.
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			list_form( &$Options )
		{
			try
			{
				$Paging = get_package( 'gui::paging' , 'last' , __FILE__ );

				$this->DefaultViewsUtilities->construct_paging( $Options , $Paging );

				$this->Provider->Output = $Paging->draw( false , $Options );

				$this->Provider->Output = $this->DefaultViewsUtilities->process_form( 
					$Options , $this->Provider->Output
				);

				$this->Provider->Output = $this->PageComposer->execute_processors( 
					$this->Provider->Output , 'process_string'
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки формы создания записи.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws record creation form.
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			create_form( &$Options )
		{
			try
			{
				if( $Options->get_setting( 'default_form' , 1 ) == 0 )
				{
					call_user_func( array( $this->Provider , 'create_form' ) , $Options );
				}
				else
				{
					$this->Provider->Output = $this->ContextSetUtilities->get_form( 
						$Options , array() , 'create_form' , $this->Prefix , 'create_record'
					);
				}
				
				$this->Provider->Output = $this->DefaultViewsUtilities->apply_posted_data_for_create_form( 
					$Options , $this->Provider->Output
				);
				
				$this->DefaultViewsUtilities->process_form( $Options , $this->Provider->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки формы создания записи.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws record creation form.
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			public_create_form( &$Options )
		{
			try
			{
				$this->create_form( $Options );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция отрисоки формы редактирования записей.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws record editing form.
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			update_form( &$Options )
		{
			try
			{
				$IdList = $this->ContextSetUtilities->get_posted_ids( $this->Prefix );

				if( $Options->get_setting( 'default_form' , 1 ) == 0 )
				{
					call_user_func( array( $this->Provider , 'update_form' ) , $Options );
				}
				else
				{
					$this->Provider->Output = $this->ContextSetUtilities->get_form(
						$Options , $IdList , 'update_form' , $this->Prefix , 'update_record'
					);
				}

				$this->Provider->Output = $this->DefaultViewsUtilities->process_form( 
					$Options , $this->Provider->Output , $IdList
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисоки публичной формы редактирования записей.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws record editing form (public).
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			public_update_form( &$Options )
		{
			try
			{
				$this->update_form( $Options );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция комплияции формы редактирования записей.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return HTML код формы.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles record copy form.
		*
		*	@param $Options - Execution parameters.
		*
		*	@return Form's HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_copy_form( &$Options )
		{
			try
			{
				if( $this->Security->get_gp( $this->Prefix.'_action' , 'command' , '' ) !== '' )
				{
					$Record = $IdList = array();
				}
				else
				{
					$IdList = $this->ContextSetUtilities->get_posted_ids( $this->Prefix );

					$Record = $this->ContextSetUtilities->get_data_record( $Options , $IdList );
				}

				$Record = $this->ContextSetUtilities->extract_data_from_request( 
					$Options , $Record , 'get_post_extraction_script' , $this->Prefix
				);

				$Form = $this->ContextSetUtilities->get_form( 
					$Options , $IdList , 'copy_form' , $this->Prefix , 'create_record'
				);

				return( $Form );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисоки формы редактирования записей.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws record copy form.
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			copy_form( &$Options )
		{
			try
			{
				$Form = $this->get_copy_form( $Options );

				$this->Provider->Output = $this->ContextSetUtilities->set_form_data( $Form , $Record );

				$this->DefaultViewsUtilities->process_form( $Options , $this->Provider->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения шаблонов.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return array( $Header , $Item , $Footer )
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns templates.
		*
		*	@param $Options - Execution parameters.
		*
		*	@return array( $Header , $Item , $Footer )
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_grid_templates( &$Options )
		{
			try
			{
				$Header = $this->DefaultViewsUtilities->get_template( $Options , 'header' );
				
				$Item = $Options->get_setting( 'item' );
				$Item = dirname( $Options->get_setting( 'file_path' ) )."/res/templates/$Item.tpl";
				$Item = $this->CachedMultyFS->file_get_contents( $Item );
				
				$Footer = $this->DefaultViewsUtilities->get_template( $Options , 'footer' );
				
				return( array( $Header , $Item , $Footer ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки формы последних записей.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws last records form.
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			last_records_form( &$Options )
		{
			try
			{
				$DataProvider = $this->ContextSetUtilities->get_data_provider( $Options , $this->Provider );
				
				$FunctionName = $Options->get_setting( 'select_func' , 'select' );
				
				$Limit = $Options->get_setting( 'records_count' , 3 );
				
				$Records = call_user_func( array( $DataProvider , $FunctionName ) , 0 , $Limit , 'id' , 'DESC' );
				
				list( $Header , $Item , $Footer ) = $this->get_grid_templates( $Options );
				
				$Items = '';
				
				foreach( $Records as $i => $Record )
				{
					$Items .= $this->String->print_record( $Item , $Record );
				}
				
				$this->Provider->Output = $Header.$Items.$Footer;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения условия выборки зависимых записей.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return Условие выборки завсисимых записей.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles record selection condition.
		*
		*	@param $Options - Execution parameters.
		*
		*	@return Record selection condition.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_select_condition( &$Options )
		{
			try
			{
				$MasterType = $Options->get_setting( 'master_type' , 'user' );

				if( $MasterType == 'user' && $MasterId == false )
				{
					if( $this->UserAlgorithms === false )
					{
						$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
					}

					return( "owner = ".$this->UserAlgorithms->get_id() );
				}
				else
				{
					throw( new Exception( "Illegal parameters of dependent records detection" ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки формы зависимых записей.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws dependent records form.
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			dependent_records_form( &$Options )
		{
			try
			{
				$DataProvider = $this->ContextSetUtilities->get_data_provider( $Options , $this->Provider );

				$FunctionName = $Options->get_setting( 'select_func' , 'select' );

				$Condition = $this->get_select_condition( $Options );

				$Records = call_user_func( 
					array( $DataProvider , $FunctionName ) , false , false , false , false , $Condition
				);

				list( $Header , $Item , $Footer ) = $this->get_grid_templates( $Options );

				$Items = '';

				foreach( $Records as $i => $Record )
				{
					$Items .= $this->String->print_record( $Item , $Record );
				}

				$this->Provider->Output = $Header.$Items.$Footer;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отрисовки конкретной записи.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method draws record.
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			record_view_form( &$Options )
		{
			try
			{
				$TemplateName = $Options->get_setting( 'form_template' , $this->ContextSet->Prefix.'_view_form.tpl' );
				$ComponentPath = dirname( $Options->get_setting( 'file_path' ) );
				$Template = $this->CachedMultyFS->get_template( $ComponentPath , $TemplateName );

				$Provider = $this->ContextSetUtilities->get_data_provider( $Options , $this->Provider );

				$id = $this->Security->get_gp( $this->Prefix.'_id' , 'integer' );
				$Records = call_user_func( array( $Provider , 'select_list' ) , $id );

				$r = $Records[ 0 ];

				$Template = $this->String->print_record( $Template , $r );
				$this->Provider->Output = $Template;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отрисоки формы редактирования записей.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method draws record editing form.
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			simple_form( &$Options )
		{
			try
			{
				$FormTemplateFileName = $Options->get_setting( 'form_template' );
				$FilePath = $Options->get_setting( 'file_path' );

				$Form = $this->CachedMultyFS->get_template( $FilePath , "$FormTemplateFileName.tpl" );

				$Changed = false;

				$Form = $this->ContextSet->process_string( $Options , $Form , $Changed );

				list( $Form , $Changed ) = $this->ContextSet->process_prefix( $Form , $Changed );

				$this->Provider->Output = $Form;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки произвольного списка записей.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Paging - Контрол.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method draws custom record list.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Paging - Control.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	set_list_view_custom_buttons( &$Options , $Paging )
		{
			try
			{
				$HeaderFields = 
					'<input type="hidden" name="{prefix}_context_action" id="{prefix}_context_action" value="">
					<input type="hidden" name="{prefix}_action" id="{prefix}_action" value="">
					<input type="hidden" name="{prefix}_record_id" id="{prefix}_record_id" value="">';
				$Paging->set( 'CustomButtons' , $HeaderFields );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки произвольного списка записей.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $Paging - Контрол.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method draws custom record list.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $Paging - Control.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	set_list_view_parts( &$Options , $Paging )
		{
			try
			{
				$this->set_list_view_custom_buttons( $Options , $Paging );
				$this->ContextSetUtilities->set_header_template( $Options , $Paging );
				$this->ContextSetUtilities->set_item_template( $Options , $Paging );
				$this->ContextSetUtilities->set_no_data_found_message( $Options , $Paging );
				$this->ContextSetUtilities->set_footer_template( $Options , $Paging );
				$this->ContextSetUtilities->set_main_settings( $Options , $Paging );
				$this->ContextSetUtilities->set_grid_data( $Options , $Paging );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки произвольного списка записей.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method draws custom record list.
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			list_view( &$Options )
		{
			try
			{
				$Paging = get_package( 'gui::paging' , 'last' , __FILE__ );
				$Paging->set( 'FormId' , $this->Prefix.'_form' );
				$Paging->set( 'Prefix' , $this->Prefix );

				$this->set_list_view_parts( $Options , $Paging );

				$Str = $Paging->draw( false , $Options );

				$Str = $this->ContextSet->process_string( $Options , $Str , $Changed );
				list( $this->Provider->Output , $Changed ) = $this->ContextSet->process_prefix( $Str , $Changed );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>