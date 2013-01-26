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
		var					$AutoMarkup = false;
		var					$CachedMultyFS = false;
		var					$ContextSetUtilities = false;
		var					$DefaultViewsUtilities = false;
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
				$this->AutoMarkup = get_package( 'page::auto_markup' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->ContextSetUtilities = get_package( 
					'gui::context_set::context_set_utilities' , 'last' , __FILE__
				);
				$this->DefaultViewsUtilities = get_package( 
					'gui::context_set::default_views::default_views_utilities' , 'last' , __FILE__
				);
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

				$this->Provider->Output = $this->DefaultViewsUtilities->compile_form( 
					$Options , $this->Provider->Output
				);

				$this->Provider->Output = $this->AutoMarkup->compile_string( $this->Provider->Output );
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
						$Options , array() , 'create_'.$this->Prefix.'_form' , $this->Prefix , 'create_record'
					);
				}

				$this->Provider->Output = $this->DefaultViewsUtilities->apply_posted_data_for_create_form( 
					$Options , $this->Provider->Output
				);

				$this->DefaultViewsUtilities->compile_form( $Options , $this->Provider->Output );
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
		*	\~english Function draws record update form.
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
				$this->compile_form_for_posted_record( $Options , 'update' );
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
		private function	compile_form_for_posted_record( &$Options , $Name )
		{
			try
			{
				$IdList = $this->ContextSetUtilities->get_posted_ids( $this->Prefix );

				if( $Options->get_setting( 'default_form' , 1 ) == 0 )
				{
					call_user_func( array( $this->Provider , $Name.'_form' ) , $Options );
				}
				else
				{
					$this->Provider->Output = $this->ContextSetUtilities->get_form(
						$Options , $IdList , $Name.'_'.$this->Prefix.'_form' , $this->Prefix , $Name.'_record'
					);
				}

				$this->Provider->Output = $this->DefaultViewsUtilities->compile_form( 
					$Options , $this->Provider->Output , $IdList
				);
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
				$this->compile_form_for_posted_record( $Options , 'copy' );
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
				$ComponentPath = dirname( $Options->get_setting( 'file_path' ) ).'/unexisting_script';
				$Template = $this->CachedMultyFS->get_template( $ComponentPath , $TemplateName );

				$Provider = $this->ContextSetUtilities->get_data_provider( $Options , $this->Provider );

				$id = $this->Security->get_gp( $this->Prefix.'_record_id' , 'integer' );
				$Records = call_user_func( array( $Provider , 'select_list' ) , $id );

				$Template = $this->String->print_record( $Template , $Records[ 0 ] );
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

				$Form = $this->ContextSet->compile_special_macro( $Options , $Form , $Changed );

				list( $Form , $Changed ) = $this->ContextSet->compile_prefix( $Form , $Changed );

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

				$this->DefaultViewsUtilities->construct_paging( $Options , $Paging );

				$Str = $Paging->draw( false , $Options );

				$Str = $this->ContextSet->compile_special_macro( $Options , $Str , $Changed );

				list( $this->Provider->Output , $Changed ) = $this->ContextSet->compile_prefix( $Str , $Changed );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция получения выгружаемых записей.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return Записи.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method returns records to export.
		*
		*	@param $Options - Execution parameters.
		*
		*	@return Records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_export_records( &$Options )
		{
			try
			{
				$this->DefaultViewsUtilities->build_query_string( $Options );

				$Provider = $this->ContextSetUtilities->get_data_provider( $Options , $this->Provider );

				$Records = call_user_func(
					array( $Provider , 'select' ) , 
					false , false , false , false , $this->DefaultViewsUtilities->QueryString
				);

				return( $Records );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция выгрузки записей.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method exports records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	output_export()
		{
			try
			{
				header( 'HTTP/1.0 200 OK' );
				header( 'Content-type: application/octet-stream' );
				header( 'Content-Length: '.strlen( $this->Output ) );
				header( 'Content-Disposition: attachment; filename="'.date( 'YmdHid' ).".csv".'"' );
				header( 'Connection: close' );
				print( $this->Output );
				exit( 0 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция выгрузки записей.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method exports records.
		*
		*	@param $Options - Execution parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			export( &$Options )
		{
			try
			{
				$Records = $this->get_export_records( $Options );

				$Fields = explode( ',' , $Options->get_setting( 'fields' ) );

				$this->Output = chr( 239 ).chr( 187 ).chr( 191 );/* additing BOM */

				foreach( $Records as $i => $Record )
				{
					$Row = array();
					foreach( $Fields as $j => $Field )
					{
						$Row [] = '"'.get_field( $Record , $Field , '' ).'"';
					}
					$this->Output .= implode( ';' , $Row )."\r\n";
				}

				$this->output_export();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>