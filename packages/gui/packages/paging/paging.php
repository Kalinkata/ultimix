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
	
	class	paging_1_0_0{

		/**
		*	\~russian Заголовок.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Header.
		*
		*	@author Dodonov A.A.
		*/
		var					$Header = '';
		
		/**
		*	\~russian Подвал.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Footer.
		*
		*	@author Dodonov A.A.
		*/
		var					$Footer = '';
		
		/**
		*	\~russian Функция обработки каждой выводимой строки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes each outputting row.
		*
		*	@author Dodonov A.A.
		*/
		var					$CallbackFunc = false;
		
		/**
		*	\~russian Идентификатор формы, в которой находится грид.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Id of the root form.
		*
		*	@author Dodonov A.A.
		*/
		var					$FormId = false;
		
		/**
		*	\~russian Шаблон элемента.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Element's template.
		*
		*	@author Dodonov A.A.
		*/
		var					$ItemTemplate = '';
		
		/**
		*	\~russian Объект, доступа к данным.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Object provides data access.
		*
		*	@author Dodonov A.A.
		*/
		var					$DataAccessor = false;
		
		/**
		*	\~russian Номер страницы с отображаемыми данными.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Number of page.
		*
		*	@author Dodonov A.A.
		*/
		var					$Page = 0;
		
		/**
		*	\~russian Номер страницы с отображаемыми данными.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Number of page.
		*
		*	@author Dodonov A.A.
		*/
		var					$PageField = 'page';
		
		/**
		*	\~russian Количество записей на страницу.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Count of records per page.
		*
		*	@author Dodonov A.A.
		*/
		var					$RecordsPerPage = 20;
		
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
		var					$Prefix = 'default';
		
		/**
		*	\~russian Кнопки расширения.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Custom buttons.
		*
		*	@author Dodonov A.A.
		*/
		var					$CustomButtons = '';
		
		/**
		*	\~russian Аяксовый контрол или нет.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Ajaxed control or not.
		*
		*	@author Dodonov A.A.
		*/
		var					$Ajaxed = false;
		
		/**
		*	\~russian Нужна ли форма.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Should be the generated HTML bounded by 'form' tag.
		*
		*	@author Dodonov A.A.
		*/
		var					$FormRequired = true;
		
		/**
		*	\~russian Выводимое сообщение если данных не найдено.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Message to output if data was not found.
		*
		*	@author Dodonov A.A.
		*/
		var					$NoDataFoundMessage;
		
		/**
		*	\~russian Идентификатор грида.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Grid's id.
		*
		*	@author Dodonov A.A.
		*/
		var					$GridId = false;
		
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
		var					$PagingMarkup = false;
		var					$Security = false;
		var					$Settings = false;
		var					$String = false;
		var					$Utilities = false;
		
		/**
		*	\~russian Функция загружает скрипты.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function loads scripts.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	load_scripts()
		{
			try
			{
				$Path = _get_package_relative_path_ex( 'gui::paging' , '1.0.0' );
				$PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				$PageJS->add_javascript( "{http_host}/$Path/include/js/paging.js" );

				$this->NoDataFoundMessage = $this->CachedMultyFS->get_template( 
					__FILE__ , 'data_for_grid_was_not_found.tpl'
				);

				$this->CallbackFunc = create_function( 
					'$Template , $Record', 
					'$String = get_package( "string" , "last" , __FILE__ );'.
						'return( $String->print_record( $Template , $Record ) );'
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		// TODO fix permit manager
		
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
				$this->PagingMarkup = get_package( 'gui::paging::paging_markup' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Utilities = get_package( 'utilities' , 'last' , __FILE__ );

				$this->load_scripts();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Установка поля.
		*
		*	@param $FieldName - Имя поля.
		*
		*	@param $FieldValue - Значение поля.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets field.
		*
		*	@param $FieldName - Field name.
		*
		*	@param $FieldValue - Field value.
		*
		*	@author Dodonov A.A.
		*/
		function			set( $FieldName , $FieldValue )
		{
			$this->$FieldName = $FieldValue;
		}

		/**
		*	\~russian Получения скрытых полей.
		*
		*	@return Поля.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns hidden fields.
		*
		*	@return Field.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_hidden_fields()
		{
			try
			{
				if( $this->Security->get_gp( 'add_hidden_fields' , 'integer' , 1 ) )
				{
					$Code = '<input type="hidden" name="ajaxed" value="'.( $this->Ajaxed ? 1 : 0 ).'">
					<!--input type="hidden" name="page" value="'.$this->Page.'"-->
					<input type="hidden" id="reorder_field" class="reorder_field" name="reorder_field" value="{field}">
					<input type="hidden" id="order" class="order" name="order" value="{order}">'.$this->CustomButtons;

					return( $Code );
				}
				return( '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получения заголовка контрола.
		*
		*	@return Заголовок контрола.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns code of the control's header.
		*
		*	@return Control's header.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_header()
		{
			try
			{
				$this->FormRequired = $this->Security->get_gp( 'paging_require_form' , 'integer' , true );

				$HiddenFields = $this->compile_hidden_fields();

				$HiddenFields = $this->PagingMarkup->compile_sort_link( $this , $HiddenFields );

				if( $this->FormRequired )
				{
					return( '<form id="'.$this->FormId.'" action="" method="post">'.$HiddenFields.$this->Header );
				}
				else
				{
					return( $HiddenFields.$this->Header );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение количества записей.
		*
		*	@param $Settings - Настройки компиляции.
		*
		*	@return Количество записей.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns count of records.
		*
		*	@param $Settings - Compilation settings.
		*
		*	@return Count of records.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_record_count( &$Settings )
		{
			try
			{
				$Query = $this->Settings->get_setting( 'count_query' );
				$Database = get_package( 'database' , 'last' , __FILE__ );
				$Result = $Database->query( $Query );
				$Records = $Database->fetch_results( $Result );
				return( get_field( $Records[ 0 ] , 'record_count' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции макроса 'paginator'.
		*
		*	@param $RecordCount - Количество записей на страницу.
		*
		*	@param $Parameters - Параметры пагинатора.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'paginator'.
		*
		*	@param $RecordCount - Count of records per page.
		*
		*	@param $Parameters - Paremeters.
		*
		*	@param $Settings - Compilation settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_default_paginator( $RecordCount , $Parameters , $Settings )
		{
			try
			{
				if( $RecordCount > $this->RecordsPerPage )
				{
					$Code = '';
					$Pages = ceil( $RecordCount / $this->RecordsPerPage );

					for( $i = 1 ; $i <= $Pages ; $i++ )
					{
						$Code .= $this->CachedMultyFS->get_template( __FILE__ , 'paginator_item.tpl' ).
							( $i != $Pages ? '&nbsp;' : '' );

						$Code = str_replace( array( '{i}' , '{field}' ) , array( $i , $this->PageField ) , $Code );
					}

					$this->Footer = str_replace( "{paginator:$Parameters}" , "$Code" , $this->Footer );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции макроса 'paginator'.
		*
		*	@param $RecordCount - Количество записей на страницу.
		*
		*	@param $Parameters - Параметры пагинатора.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'paginator'.
		*
		*	@param $RecordCount - Count of records per page.
		*
		*	@param $Parameters - Paremeters.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_paginator3000( $RecordCount , $Parameters )
		{
			try
			{
				if( $RecordCount > $this->RecordsPerPage )
				{
					$this->Footer = str_replace( 
						"{paginator:$Parameters}" , "{paginator3000:current_page={http_param:get=1;name=".
						$this->PageField.";default=1};page_url=./index.html?".$this->PageField.
						"[eq];page_count=".ceil( $RecordCount / $this->RecordsPerPage )."}" , $this->Footer
					);
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции макроса 'paginator'.
		*
		*	@param $Parameters - Параметры компиляции.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'paginator'.
		*
		*	@param $Parameters - Compilation settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_paginator( $Parameters )
		{
			try
			{
				$this->Settings->load_settings( $Parameters );
				
				$RecordCount = $this->get_record_count( $this->Settings );
				$Type = $this->Settings->get_setting( 'type' , 'default' );

				if( $Type == 'default' )
				{
					$this->compile_default_paginator( $RecordCount , $Parameters , $this->Settings );
				}
				elseif( $Type == 'paginator3000' )
				{
					$this->compile_paginator3000( $RecordCount , $Parameters );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции макроса 'paginator'.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'paginator'.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	process_paginator()
		{
			try
			{
				$Rules = array( 'count_query' => TERMINAL_VALUE );

				for( ; $Parameters = $this->String->get_macro_parameters( $this->Footer , 'paginator' , $Rules ) ; )
				{
					$this->compile_paginator( $Parameters );

					$this->Footer = str_replace( "{paginator:$Parameters}" , '' , $this->Footer );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получения подвала контрола.
		*
		*	@return Подвал контрола.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns code of the control's footer.
		*
		*	@return Control's footer.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_footer()
		{
			try
			{
				$Changed = false;
				$CategoryMarkup = get_package( 'category::category_markup' , 'last' , __FILE__ );
				$this->Footer = $CategoryMarkup->process_string( $Changed , $this->Footer , $Changed );
				
				$this->process_paginator();
				
				if( $this->FormId !== false && $this->FormRequired )
				{
					return( $this->Footer.'</form>' );
				}
				else
				{
					return( $this->Footer );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки списка записей.
		*
		*	@param $DataToDisplay - Данные для отрисовки.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws list of records.
		*
		*	@param $DataToDisplay - Data to display.
		*
		*	@return Component's HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_items( &$DataToDisplay )
		{
			try
			{
				$RetView = '';
				$c = count( $DataToDisplay );

				for( $i = 0 ; $i < $c && $i < $this->RecordsPerPage ; $i++ )
				{
					$Tmp = $this->ItemTemplate;

					$Tmp = call_user_func( $this->CallbackFunc , $Tmp , $DataToDisplay[ $i ] );
					$Tmp = str_replace( '{odd_factor}' , ( $i % 2 === 0 ? 'even' : 'odd' ) , $Tmp );

					$RetView .= $Tmp;
				}

				return( $RetView );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки списка записей.
		*
		*	@param $DataToDisplay - Данные для отрисовки.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws list of records.
		*
		*	@param $DataToDisplay - Data to display.
		*
		*	@return Component's HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_macros( &$DataToDisplay )
		{
			try
			{
				$RetView = $this->compile_items( $DataToDisplay );

				$RetView = $this->compile_header().'{set_var:name='.$this->FormId.'_records_count;value='.
							count( $DataToDisplay ).'}'.$RetView.$this->compile_footer();

				$RetView = $this->PagingMarkup->compile_left_slider( $this , $RetView );
				$RetView = $this->PagingMarkup->compile_records_per_page_control( $this , $RetView );
				$RetView = $this->PagingMarkup->compile_right_slider( $this , count( $DataToDisplay ) , $RetView );

				return( str_replace( '{prefix}' , $this->Prefix , $RetView ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@return Component's HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	process_no_data_to_display()
		{
			try
			{
				$this->FormRequired = $this->FormId === false ? false : true;
				$this->NoDataFoundMessage = str_replace( '{prefix}' , $this->Prefix , $this->NoDataFoundMessage );

				if( $this->FormRequired )
				{
					return( 
						'{set_var:name='.$this->FormId.'_records_count;value=0}<form id="'.$this->FormId.
						'" action="" method="post">'.$this->CustomButtons.$this->NoDataFoundMessage.'</form>'
					);
				}
				else
				{
					return( '{set_var:name='.$this->FormId.'_records_count;value=0}'.$this->NoDataFoundMessage );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения списка записей.
		*
		*	@param $Options - Дополнительные настройки отображения.
		*
		*	@return Записи.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns list of records.
		*
		*	@param $Options - Additional display options.
		*
		*	@return Records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_data_to_display( &$Options )
		{
			try
			{
				$ReorderField = $this->Security->get_gp( 'reorder_field' , 'command' , false );
					$Order = $this->Security->get_gp( 'order' , 'command' , false );

					if( strlen( $ReorderField ) == 0 )
					{
						$ReorderField = false;
					}
					if( strlen( $Order ) == 0 )
					{
						$Order = false;
					}

					$DataToDisplay = call_user_func( 
						$this->DataAccessor , ( $this->Page - 1 ) * $this->RecordsPerPage , 
						$this->RecordsPerPage + 1 , $ReorderField , $Order , $Options
					);
					
					return( $DataToDisplay );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Первичная инициализация.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Primary init.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	primary_init()
		{
			try
			{
				$this->GridId = md5( microtime( true ) );

				$this->Page = $this->Security->get_gp( $this->PageField , 'integer' , 1 );

				$this->RecordsPerPage = $this->Security->get_c( 
					$this->Prefix.'_records_per_page' , 'integer' , $this->RecordsPerPage
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки списка записей.
		*
		*	@param $DataToDisplay - Данные для отрисовки.
		*
		*	@param $Options - Дополнительные настройки отображения.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws list of records.
		*
		*	@param $DataToDisplay - Data to display.
		*
		*	@param $Options - Additional display options.
		*
		*	@return Component's HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw( $DataToDisplay = false , $Options = false )
		{
			try
			{
				$this->primary_init();

				if( $DataToDisplay === false && $this->DataAccessor === false )
				{
					throw( new Exception( 'No data was specified' ) );
				}
				if( $this->DataAccessor )
				{
					$DataToDisplay = $this->get_data_to_display( $Options );
				}

				if( count( $DataToDisplay ) === 0 )
				{
					return( $this->process_no_data_to_display() );
				}

				return( $this->compile_macros( $DataToDisplay ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>