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
	*	\~russian Класс для управления метариалами.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english This manager helps creating content.
	*
	*	@author Dodonov A.A.
	*/
	class	content_view_1_0_0{
		
		/**
		*	\~russian Результат работы функций отображения.
		*
		*	@author одонов А.А.
		*/
		/**
		*	\~english Display function's result.
		*
		*	@author Dodonov A.A.
		*/
		var					$Output;
		
		/**
		*	\~russian Закешированные объекты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached objects.
		*
		*	@author Dodonov A.A.
		*/
		var					$CachedMultyFS = false;
		var					$ContentAccess = false;
		var					$ContentAlgorithms = false;
		var					$PageComposer = false;
		var					$Security = false;
		var					$Settings = false;
		var					$String = false;
		
		/**
		*	\~russian Конструктор.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->ContentAccess = get_package( 'content::content_access' , 'last' , __FILE__ );
				$this->ContentAlgorithms = get_package( 'content::content_algorithms' , 'last' , __FILE__ );
				$this->PageComposer = get_package( 'page::page_composer' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Settings = get_package( 'settings::package_settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция получения названий категорий.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@return Названия категорий.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns category names.
		*
		*	@param $Options - Settings.
		*
		*	@return Category names.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_category_names( &$Options )
		{
			try
			{
				if( $Options->get_setting( 'category_name' , false ) )
				{
					$CategoryNames = $Options->get_setting( 'category_name' );
				}
				else
				{
					$CategoryNames = $this->Settings->get_package_setting( 'content::content_view' , 'last' , 
												'cf_content_view_conf' , 'content_line_categories' , 'news,article' );
				}
				
				return( $CategoryNames );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция возвращает список записей.
		*
		*	@param $Start - Номер первой записи.
		*
		*	@param $Limit - Ограничение на количество записей
		*
		*	@param $Field - Поле, по которому будет осуществляться сортировка.
		*
		*	@param $Order - Порядок сортировки.
		*
		*	@param $Condition - Дополнительные условия отбора.
		*
		*	@param $Options - Дополнительные опции.
		*
		*	@return Список записей.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns list of records.
		*
		*	@param $Start - Number of the first record.
		*
		*	@param $Limit - Count of records limitation.
		*
		*	@param $Field - Field to sort by.
		*
		*	@param $Order - Sorting order.
		*
		*	@param $Condition - Additional condtions.
		*
		*	@param $Options - Additional options.
		*
		*	@return List of records.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select_content_line_items( $Start , $Limit , $Field , $Order , $Condition , &$Options )
		{
			try
			{
				$Category = get_package( 'category::category_algorithms' , 'last' , __FILE__ );

				$CategoryNames = $this->get_category_names( $Options );

				$CategoryIds = $Category->get_category_ids( $CategoryNames );

				return(
					$this->ContentAccess->select( 
						$Start , $Options->get_setting( 'display_limit' , $Limit ) , $Field , $Order , 
						"( $Condition ) AND category IN ( ".implode( ' , ' , $CategoryIds ).' )'
					)
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция выборки месяцев.
		*
		*	@param $PublicationStructure - Структура публикаций.
		*
		*	@return Месяцы.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns months.
		*
		*	@param $PublicationStructure - Publication structure.
		*
		*	@return Months.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_months( &$PublicationStructure )
		{
			try
			{
				return(
					array_unique( 
						get_field_ex( 
							array_filter( 
								$PublicationStructure , 
								create_function( "\$d" , "return( \$d->publication_year == $y );" )
							) , 
							'publication_month'
						)
					)
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция выборки месяцев.
		*
		*	@param $PublicationStructure - Структура публикаций.
		*
		*	@return Шаблон.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns months.
		*
		*	@param $PublicationStructure - Publication structure.
		*
		*	@return Template.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_month_tempate( &$PublicationStructure )
		{
			try
			{
				$MonthTemplate = $this->CachedMultyFS->get_template( __FILE__ , 'archive_month.tpl' );
							
				$MonthTemplate = $this->String->print_record( 
					$MonthTemplate , 
					array_filter( 
						$PublicationStructure , 
						create_function( 
							"\$d" , "return( \$d->publication_year == $y && \$d->publication_month == $m );"
						)
					)
				);
				
				return( $MonthTemplate );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции месяца.
		*
		*	@param $Year - Год.
		*
		*	@param $Month - Месяц.
		*
		*	@param $MonthTemplate - Шаблон.
		*
		*	@param $CategoryIds - Категории.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles month.
		*
		*	@param $Year - Year.
		*
		*	@param $Month - Month.
		*
		*	@param $MonthTemplate - Template.
		*
		*	@param $CategoryIds - Categories.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_month_content( $Year , $Month , $MonthTemplate , $CategoryIds )
		{
			try
			{
				if( $this->Security->get_gp( 'month' , 'integer' , date( 'm' ) ) == $Month )
				{
					$Content = $this->ContentAccess->get_content_for_date( $Year , $Month , $CategoryIds );
					
					foreach( $Content as $c )
					{
						$ContentTemplate = $this->CachedMultyFS->get_template( 
							__FILE__ , 'archive_content.tpl'
						);
						$ContentTemplate = $this->String->print_record( $ContentTemplate , $c );
						$MonthTemplate = str_replace( 
							'{content_data}' , $ContentTemplate.'{content_data}' , $MonthTemplate
						);
					}
				}
				
				return( $MonthTemplate );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции года.
		*
		*	@param $Year - Год.
		*
		*	@param $YearTemplate - Шаблон.
		*
		*	@param $CategoryIds - Категории.
		*
		*	@param $PublicationStructure - Публикации.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles year.
		*
		*	@param $Year - Year.
		*
		*	@param $YearTemplate - Template.
		*
		*	@param $CategoryIds - Categories.
		*
		*	@param $PublicationStructure - Publication structure.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_year_content( $Year , $YearTemplate , $CategoryIds , $PublicationStructure )
		{
			try
			{
				if( $this->Security->get_gp( 'year' , 'integer' , date( 'Y' ) ) == $Year )
				{
					$Months = $this->get_months( $PublicationStructure );

					foreach( $Months as $Month )
					{
						$MonthTemplate = $this->get_month_tempate( $PublicationStructure );

						$MonthTemplate = $this->compile_month_content( $Year , $Month , $MonthTemplate , $CategoryIds );
						
						$MonthTemplate = str_replace( '{content_data}' , '' , $MonthTemplate );
						$YearTemplate = str_replace( 
							'{month_data}' , $MonthTemplate.'{month_data}' , $YearTemplate
						);
					}
				}
				
				return( $YearTemplate );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции годов.
		*
		*	@param $PublicationStructure - Публикации.
		*
		*	@param $Years - Годы.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles years.
		*
		*	@param $PublicationStructure - Publication structure.
		*
		*	@param $Years - Years.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_years( $PublicationStructure , $Years )
		{
			try
			{
				foreach( $Years as $Year )
				{
					$YearTemplate = $this->CachedMultyFS->get_template( __FILE__ , 'archive_year.tpl' );
					$YearTemplate = str_replace( '{publication_year}' , $Year , $YearTemplate );

					$YearTemplate = $this->compile_year_content( 
						$Year , $YearTemplate , $CategoryIds , $PublicationStructure
					);

					$YearTemplate = str_replace( '{month_data}' , '' , $YearTemplate );

					$this->Output .= $YearTemplate;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			content_archive( &$Options )
		{
			try
			{
				$CategoryAccess = get_package( 'category::category_algorithms' , 'last' , __FILE__ );
				$CategoryIds = $CategoryAccess->get_category_ids( 
					$Options->get_setting( 'category' , 'news,article,faq,blog_entry' )
				);

				$PublicationStructure = $this->ContentAccess->get_publication_structure( $CategoryIds );

				$Years = array_unique( get_field_ex( $PublicationStructure , 'publication_year' ) );

				$this->compile_years( $PublicationStructure , $Years );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $ContentId - Идентфиикатор контента.
		*
		*	@return Контент.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $ContentId - Content id.
		*
		*	@return Content.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_view_content( $ContentId )
		{
			try
			{
				$Content = $this->ContentAlgorithms->get_by_id( $ContentId );
				$Template = $this->CachedMultyFS->get_template( __FILE__ , 'content_view_template.tpl' );
				$Output = $this->String->print_record( $Template , $Content );

				$this->PageComposer->set_page_title( get_field( $Content , 'title' ) );
				$this->PageComposer->add_page_keywords( get_field( $Content , 'keywords' ) );
				$this->PageComposer->add_page_description( get_field( $Content , 'description' ) );

				return( $Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view_content( $Options )
		{
			try
			{
				if( ( $ContentId = $this->Security->get_gp( 'content_id' , 'integer' , false ) ) === false )
				{
					$this->Output = '{lang:exact_content_was_not_found}';
					return;
				}

				$this->Output = $this->compile_view_content( $ContentId );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code of the component.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( $Options )
		{
			try
			{
				$ContextSet = get_package_object( 'gui::context_set' , 'last' , __FILE__ );

				$Path = dirname( __FILE__ );

				$ContextSet->add_context( "$Path/conf/cfcxs_content_line" );

				$ContextSet->add_context( "$Path/conf/cfcxs_content_view" );

				$ContextSet->add_context( "$Path/conf/cfcxs_content_archive" );

				$ContextSet->execute( $Options , $this , __FILE__ );

				return( $this->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>