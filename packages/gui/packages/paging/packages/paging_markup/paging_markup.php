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
	
	class	paging_markup_1_0_0{

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
		var					$Settings = false;
		var					$Security = false;
	
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

				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Получения кода контрола.
		*
		*	@param $Paging - Грид.
		*
		*	@param $CountOfRecords - Количество выбранных записей.
		*
		*	@param $Control - Код грида.
		*
		*	@return Контрол, который будет вставлен для перемотки вправо.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns code of the control.
		*
		*	@param $Paging - Grid.
		*
		*	@param $CountOfRecords - Count of the selected records.
		*
		*	@param $Control - Grid's code.
		*
		*	@return Right side switching control.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_non_ajaxed_left_slider( &$Paging , $Control )
		{
			try
			{
				$Fields = $_GET;
				$Fields[ $Paging->PageField ] = $Paging->Page - 1;
				$Fields = $Paging->Utilities->pack_into_url( $Fields , array( 'page_name' ) );
				$Fields = str_replace( '=' , '[eq]' , $Fields );

				$Code = '{href:form_id='.$Paging->FormId.
						";tpl=submit0;text=left_side_switcher;action=./[page_name].html?$Fields}";
				
				return( str_replace( '{left_slide}' , $Code , $Control ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получения кода контрола.
		*
		*	@param $Paging - Грид.
		*
		*	@return Контрол, который будет вставлен для перемотки вправо.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns code of the control.
		*
		*	@param $Paging - Grid.
		*
		*	@return Right side switching control.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_reorder_field( &$Paging )
		{
			try
			{
				$ReorderField = '';

				if( $this->Security->get_gp( 'reorder_field' ) )
				{
					$Field = $this->Security->get_gp( 'reorder_field' , 'command' );
					$Order = 
						$this->Security->get_gp( 'order' , 'command' ) === 'ascending' ? 'ascending' : 'descending';
					$ReorderField = " , 'reorder_field' : '$Field' , 'order' : '$Order'";
				}
				
				return( $ReorderField );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получения кода контрола.
		*
		*	@param $Paging - Грид.
		*
		*	@return Контрол, который будет вставлен для перемотки влево.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns code of the control.
		*
		*	@param $Paging - Grid.
		*
		*	@return Left side switching control.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_left_slider( &$Paging , $Control )
		{
			try
			{
				if( $Paging->Page > 1 )
				{
					return( $this->compile_non_ajaxed_left_slider( $Paging , $Control ) );
				}
				else
				{
					return( str_replace( '{left_slide}' , '{lang:left_side_switcher}' , $Control ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Создание набора настроек.
		*
		*	@param $Paging - Грид.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Creating settings set.
		*
		*	@param $Paging - Grid.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return HTML код.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_controller_options( &$Paging , &$Settings )
		{
			try
			{
				$Limit = $Settings->get_setting( 'limit' , 1000 );
				$Values = array( 
					1 , 2 , 3 , 4 , 5 , 6 , 7 , 8 , 9 , 10 , 
					20 , 30 , 40 , 50 , 100 , 200 , 300 , 400 , 500 , 1000
				);
				$Options = '';
				foreach( $Values as $k => $v )
				{
					if( $v <= $Limit )
					{
						$Options .= $this->CachedMultyFS->get_template( 
							__FILE__ , 'records_per_page_options.tpl'
						);
						$Options = str_replace( 
							array( '{value}'  , '{title}' , '{selected}' ) , 
							array( $v , $v , ( $Paging->RecordsPerPage == $v ? ' selected' : '' ) ) , 
							$Options
						);
					}
				}
				return( $Options );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Создание набора настроек.
		*
		*	@param $Paging - Грид.
		*
		*	@return Параметры.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Creating settings set.
		*
		*	@param $Paging - Grid.
		*
		*	@return Parameters.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_fields( &$Paging )
		{
			try
			{
				$Fields = $_GET;
				$Fields[ $Paging->PageField ] = 1;
				$Fields = $Paging->Utilities->pack_into_url( $Fields , array( 'page_name' ) );

				return( str_replace( '=' , '[eq]' , $Fields ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Создание набора настроек.
		*
		*	@param $Paging - Грид.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Creating settings set.
		*
		*	@param $Paging - Grid.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return HTML код.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_records_per_page_control( &$Paging , &$Settings )
		{
			try
			{
				$Fields = $this->get_fields( $Paging );

				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'records_per_page_control.tpl' );

				$Macro = array( '{reorder_field}' , '{prefix}' , '{fields}' , '{form_id}' , '{options}' );
				$Data = array( 
					$this->Security->get_gp( 'reorder_field' , 'command' , '' ) , $Paging->Prefix , $Fields , 
					$Paging->FormId , $this->compile_controller_options( $Paging , $Settings )
				);
				$Code = str_replace( $Macro , $Data , $Code );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Создание набора настроек.
		*
		*	@param $Paging - Грид.
		*
		*	@return HTML код.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Creating settings set.
		*
		*	@param $Paging - Grid.
		*
		*	@return HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_records_per_page_control( &$Paging , $Control )
		{
			try
			{
				$Control = str_replace( 
					'{records_per_page_control}' , '{records_per_page_control:type=default}' , $Control
				);

				for( ; $Parameters = $Paging->String->get_macro_parameters( $Control , 'records_per_page_control' ) ; )
				{
					$this->Settings->load_settings( $Parameters );

					$Code = $this->get_records_per_page_control( $Paging , $this->Settings );

					//TODO: move it to auto_markup
					$Control = str_replace( "{records_per_page_control:$Parameters}" , $Code , $Control );
				}

				return( $Control );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получения кода контрола.
		*
		*	@param $Paging - Грид.
		*
		*	@param $CountOfRecords - Количество выбранных записей.
		*
		*	@param $Control - Код грида.
		*
		*	@return Контрол, который будет вставлен для перемотки вправо.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns code of the control.
		*
		*	@param $Paging - Grid.
		*
		*	@param $CountOfRecords - Count of the selected records.
		*
		*	@param $Control - Grid's code.
		*
		*	@return Right side switching control.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_non_ajaxed_right_slider( &$Paging , $Control )
		{
			try
			{
				$Fields = $_GET;
				$Fields[ $Paging->PageField ] = $Paging->Page + 1;
				$Fields = $Paging->Utilities->pack_into_url( $Fields , array( 'page_name' ) );
				$Fields = str_replace( '=' , '[eq]' , $Fields );

				return( 
					str_replace( 
						'{right_slide}' , 
						'{href:form_id='.$Paging->FormId.";tpl=submit0;text=right_side_switcher;action=./".
						"[page_name].html?$Fields}" , $Control
					)
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получения кода контрола.
		*
		*	@param $Paging - Грид.
		*
		*	@param $CountOfRecords - Количество выбранных записей.
		*
		*	@param $Control - Код грида.
		*
		*	@return Контрол, который будет вставлен для перемотки вправо.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns code of the control.
		*
		*	@param $Paging - Grid.
		*
		*	@param $CountOfRecords - Count of the selected records.
		*
		*	@param $Control - Grid's code.
		*
		*	@return Right side switching control.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_right_slider( &$Paging , $CountOfRecords , $Control )
		{
			try
			{
				if( $CountOfRecords === $Paging->RecordsPerPage + 1 )
				{
					return( $this->compile_non_ajaxed_right_slider( $Paging , $Control ) );
				}
				else
				{
					return( str_replace( '{right_slide}' , '{lang:right_side_switcher}' , $Control ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'sort_link'.
		*
		*	@param $Paging - Грид.
		*
		*	@param $HiddenFields - Поля.
		*
		*	@return Поля.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'sort_link'.
		*
		*	@param $Paging - Grid.
		*
		*	@param $HiddenFields - Fields.
		*
		*	@return Fields.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_order_data( &$Paging , $HiddenFields )
		{
			try
			{
				$ReorderField = $this->Security->get_gp( 'reorder_field' , 'command' , false );

				if( $ReorderField && $this->Settings->get_setting( 'dbfield' ) === $ReorderField )
				{
					$Order = ( $this->Security->get_gp( 'order' , 'command' ) === 'ascending' ? 
						'ascending' : 'descending' );
					$HiddenFields = str_replace( '{order}' , $Order , $HiddenFields );
					$HiddenFields = str_replace( 
						'{field}' , $this->Settings->get_setting( 'dbfield' ) , $HiddenFields
					);
				}

				return( $HiddenFields );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции макроса 'sort_link'.
		*
		*	@param $Paging - Грид.
		*
		*	@param $HiddenFields - Поля.
		*
		*	@return Поля.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'sort_link'.
		*
		*	@param $Paging - Grid.
		*
		*	@param $HiddenFields - Fields.
		*
		*	@return Fields.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_sort_link( &$Paging , $HiddenFields )
		{
			try
			{
				for( ; $Parameters = $Paging->String->get_macro_parameters( $Paging->Header , 'sort_link' ) ; )
				{
					$this->Settings->load_settings( $Parameters );

					$HiddenFields = $this->set_order_data( $Paging , $HiddenFields );

					$Paging->Header = str_replace( "{sort_link:$Parameters}" , "{href:style=display:block;text=".
						$this->Settings->get_setting( 'text' ).";page=javascript:ultimix.Reorder( '#".$Paging->FormId.
						"' , ".( $Paging->Ajaxed ? 'true' : 'false' )." , './[page_name].html' , '".
						$this->Settings->get_setting( 'dbfield' )."' )}" , $Paging->Header
					);
				}

				return( $HiddenFields );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>