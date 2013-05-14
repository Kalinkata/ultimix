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
	*	\~russian Класс поиска по сайту.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides site search routine.
	*
	*	@author Dodonov A.A.
	*/
	class	search_1_0_0{

		/**
		*	\~russian Закешированные пакеты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$CachedMultyFS = false;
		var					$Security = false;
		var					$String = false;

		/**
		*	\~russian Результат работы функций отображения.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Display function's result.
		*
		*	@author Dodonov A.A.
		*/
		var					$Output = false;

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
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение списка пакетов.
		*
		*	@return Список пакетов.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns list of packages.
		*
		*	@return List of packages.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_list_of_packages()
		{
			try
			{
				$Config = $this->CachedMultyFS->get_config( __FILE__ , 'cf_search_access' , 'exploded' );
				$Settigs = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$Packages = array();

				foreach( $Config as $i => $ConfigLine )
				{
					$Settigs->load_settings( $ConfigLine );

					$PackageName = $Settigs->get_setting( 'package_name' );
					$PackageVersion = $Settigs->get_setting( 'package_version' );

					$Packages [] = get_package( $PackageName , $PackageVersion , __FILE__ );
				}

				return( $Packages );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение найденных записей.
		*
		*	@param $Packages - Пакеты, с помощью которых осуществляется поиск.
		*
		*	@param $SearchString - Строка поиска.
		*
		*	@return Массив записей.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns search results.
		*
		*	@param $Packages - Search packages.
		*
		*	@param $SearchString - Search string.
		*
		*	@return Search results.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_records( &$Packages , $SearchString )
		{
			try
			{
				$Results = array();

				$Limitations = $this->Security->get_gp( 'search_output_limitations' , 'string' , '' );
				$Limitations = explode( ',' , $Limitations );

				foreach( $Packages as $i => $Package )
				{
					$Results [] = call_user_func( 
						array( $Package , 'search' ) , get_field( $Limitations , $i , 0 ) , $SearchString
					);
				}

				return( $Results );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Фильтрация результатов с нулевой релевантностью.
		*
		*	@param $Results - Результаты поиска.
		*
		*	@return Результаты поиска.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function filters results with the zero relevation.
		*
		*	@param $Results - Search results.
		*
		*	@return Search results.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			filter_results( $Results )
		{
			try
			{
				foreach( $Results as $i => $Records )
				{
					$Return = array();

					foreach( $Records as $j => $Record )
					{
						$Relevation = intval( get_field( $Record , 'relevation' ) );
						if( $Relevation > 0 )
						{
							$Return [] = $Record;
						}
					}

					$Results[ $i ] = $Return;
				}

				return( $Results );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение максимальной релевантности.
		*
		*	@param $Records - Результаты поиска.
		*
		*	@return Максимальная релевантность.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns maximum relevation for the record set.
		*
		*	@param $Records - Search results.
		*
		*	@return Maximum relevation.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_maximum_relevation( $Records )
		{
			try
			{
				$MaxRelevation = 0;

				if( isset( $Records[ 0 ] ) )
				{
					$MaxRelevation = intval( get_field( $Records[ 0 ] , 'relevation' ) );

					foreach( $Records as $j => $Record )
					{
						$Tmp = intval( get_field( $Record , 'relevation' ) );
						if( $Tmp > $MaxRelevation )
						{
							$MaxRelevation = $Tmp;
						}
					}
				}

				return( $MaxRelevation );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Нормализация значений релевантности.
		*
		*	@param $Results - Результаты поиска.
		*
		*	@return Массив записей.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Normalizing relevation.
		*
		*	@param $Results - Search results.
		*
		*	@return Search results.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			normalize_relevation( &$Results )
		{
			try
			{
				$Return = array();

				foreach( $Results as $i => $Records )
				{
					$MaxRelevation = $this->get_maximum_relevation( $Records );

					foreach( $Records as $j => $Record )
					{
						set_field( 
							$Results[ $i ][ $j ] , 'relevation' , 
							intval( get_field( $Results[ $i ][ $j ] , 'relevation' ) ) / $MaxRelevation
						);
					}
				}

				return( $Results );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Компоновка записей для вывода.
		*
		*	@param $Results - Результаты поиска.
		*
		*	@return Массив записей.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function composes records for the output.
		*
		*	@param $Results - Search results.
		*
		*	@return Search results.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_search_line( &$Results )
		{
			try
			{
				$SearchLine = array();

				foreach( $Results as $i => $Result )
				{
					foreach( $Result as $j => $Record )
					{
						set_field( $Results[ $i ][ $j ] , 'fetch_id' , $i );
					}
				}

				foreach( $Results as $i => $Result )
				{
					$SearchLine = array_merge( $SearchLine , $Result );
				}

				return( array_slice( $SearchLine , 0 , 10 ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Подготовка записей к выводу.
		*
		*	@param $Result - Результаты поиска.
		*
		*	@param $SearchString - Строка поиска.
		*
		*	@return Текст превью.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function prepares records for the output.
		*
		*	@param $SearchLine - Search results.
		*
		*	@param $SearchString - Search string.
		*
		*	@return Preview.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_preview_paraneters( &$Result , $SearchString )
		{
			try
			{
				$Position = strpos( $Text = get_field( $Result , 'record_text' ) , $SearchString );
				$Length = strlen( $Text );
				$PreviewSize = 512;
				$LeftBorder = ( $Position - $PreviewSize > 0 ? $Position - $PreviewSize : 0 );
				$RightBorder = ( $Position + $PreviewSize > $Length ? $Length : $Position + $PreviewSize );

				return( array( $Length , $LeftBorder , $RightBorder ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Подготовка записей к выводу.
		*
		*	@param $Result - Результаты поиска.
		*
		*	@param $SearchString - Строка поиска.
		*
		*	@return Текст превью.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function prepares records for the output.
		*
		*	@param $SearchLine - Search results.
		*
		*	@param $SearchString - Search string.
		*
		*	@return Preview.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_preview( &$Result , $SearchString )
		{
			try
			{
				list( $Length , $LeftBorder , $RightBorder ) = $this->get_preview_paraneters( $Result , $SearchString );

				$Preview = substr( $Text , $LeftBorder , $RightBorder - $LeftBorder );

				$Preview = ( $LeftBorder ? '...' : '' ).$Preview.( $RightBorder != $Length ? '...' : '' );
				$Highlight = $this->CachedMultyFS->get_template( __FILE__ , 'search_highlight.tpl' );
				$Hightlight = str_replace( '{search_string}' , $SearchString , $Hightlight );

				$Preview = str_replace( $SearchString , $Hightlight , $Preview );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Подготовка записей к выводу.
		*
		*	@param $SearchLine - Результаты поиска.
		*
		*	@param $SearchString - Строка поиска.
		*
		*	@return Массив записей.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function prepares records for the output.
		*
		*	@param $SearchLine - Search results.
		*
		*	@param $SearchString - Search string.
		*
		*	@return Search results.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			prepare_for_output( $SearchLine , $SearchString )
		{
			try
			{
				foreach( $SearchLine as $i => $Result )
				{
					$Preview = $this->compile_preview( $Result , $SearchString );

					set_field( $SearchLine[ $i ] , 'record_text' , $Preview );
				}

				return( $SearchLine );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Контрол перелистывания страниц в результатах поиска.
		*
		*	@param $SearchLine - Список записей для отрисовки.
		*
		*	@return Условия отбора следующих записей.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws page switch control.
		*
		*	@param $SearchLine - List of records to draw.
		*
		*	@return Fetching conditions.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_next_page_limitations( &$SearchLine )
		{
			try
			{
				if( isset( $SearchLine[ 9 ] ) === false )
				{
					return( '' );
				}

				$Limitations = $this->Security->get_gp( 'search_output_limitations' , 'string' , '' );
				$Limitations = explode( ',' , $Limitations );

				foreach( $SearchLine as $i => $Record )
				{
					$FetchId = get_field( $Record , 'fetch_id' );
					
					$Limitations[ $FetchId ]++;
				}

				return( implode( ',' , $Limitations ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Контрол перелистывания страниц в результатах поиска.
		*
		*	@return Контролы.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws page switch control.
		*
		*	@return Controls.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_left_arrow()
		{
			try
			{
				$Arrows = array();

				$CurrentLimitations = $this->Security->get_gp( 'search_output_limitations' , 'string' , '' );
				if( $CurrentLimitations != '' )
				{
					$Arrows [] = $this->CachedMultyFS->get_template( __FILE__ , 'search_form_prev_arrow.tpl' );
				}

				return( $Arrows );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Контрол перелистывания страниц в результатах поиска.
		*
		*	@param $NextLimitations - Ограничения на вывод результатов.
		*
		*	@return HTML код контрола.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws page switch control.
		*
		*	@param $NextLimitations - Records listing limitations.
		*
		*	@return Control's HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_right_arrow( $NextLimitations )
		{
			try
			{
				$SearchString = $this->Security->get_gp( 'search_string' , 'string' );
				$Page = $this->Security->get_gp( 'page' , 'integer' , 0 ) + 1;
				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'search_form_next_arrow.tpl' );
				$Code = str_replace( 
					array( '{search_string}' , '{next_limitations}' , '{page}' ) , 
					array( $SearchString , $NextLimitations , $Page ) , $Code 
				);
				
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Контрол перелистывания страниц в результатах поиска.
		*
		*	@param $SearchLine - Список записей для отрисовки.
		*
		*	@return HTML код контрола.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws page switch control.
		*
		*	@param $SearchLine - List of records to draw.
		*
		*	@return Control's HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_switch_page_controler( &$SearchLine )
		{
			try
			{
				$Arrows = $this->get_left_arrow();

				$NextLimitations = $this->get_next_page_limitations( $SearchLine );
				if( $NextLimitations != '' )
				{
					$Arrows [] = $this->get_right_arrow( $NextLimitations );
				}

				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'search_form_controller.tpl' );
				$Code = str_replace( '{arrows}' , implode( '&nbsp;' , $Arrows ) , $Code );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Отрисовка списка результатов поиска.
		*
		*	@param $SearchLine - Список записей для отрисовки.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws search results.
		*
		*	@param $SearchLine - List of records to draw.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			output_search_results( &$SearchLine )
		{
			try
			{
				$this->Output = '';

				foreach( $SearchLine as $i => $Result )
				{
					$TemplatePath = dirname( __FILE__ ).'/res/templates/search_item.tpl';
					$this->Output .= $this->CachedMultyFS->file_get_contents( $TemplatePath );

					$this->Output = $this->String->print_record( $this->Output , $Result );
					$this->Output = str_replace( 
						'{item_number}' , 
						$this->Security->get_gp( 'page' , 'integer' , 0 ) * 10 + $i + 1 , $this->Output
					);
				}

				$this->Output .= $this->get_switch_page_controler( $SearchLine );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			search_results()
		{
			try
			{
				$Packages = $this->get_list_of_packages();

				$SearchString = $this->Security->get_gp( 'search_string' , 'string' , false );

				if( $SearchString !== false )
				{
					$Records = $this->get_records( $Packages , $SearchString );

					$FilteredRecords = $this->filter_results( $Records );

					$NormalizedRecords = $this->normalize_relevation( $FilteredRecords );

					$SearchLine = $this->get_search_line( $NormalizedRecords );

					$SearchLine = $this->prepare_for_output( $SearchLine , $SearchString );

					$this->output_search_results( $SearchLine );
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
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( &$Options )
		{
			try
			{
				$ContextSet = get_package( 'gui::context_set' , 'last' , __FILE__ );

				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_search_form' );
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_search_results' );

				if( $ContextSet->execute( $Options , $this , __FILE__ ) )return( $this->Output );

				return( $this->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция создания поискового запроса.
		*
		*	@param $Field - Поле.
		*
		*	@param $QueryString - Поисковый SQL запрос.
		*
		*	@param $SearchString - Поисковый запрос.
		*
		*	@return Скрипт поиска.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates query string.
		*
		*	@param $Field - Field.
		*
		*	@param $QueryString - Query string.
		*
		*	@param $SearchString - Search string.
		*
		*	@return Search script.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	add_field_to_query_string( $Field , $QueryString , $SearchString )
		{
			try
			{
				$Field = str_replace( '.' , '_dot_' , $Field );

				if( $this->Security->get_p( '_sf_'.$Field , 'integer' , 1 ) == 1 )
				{
					$Strict = strpos( $Field , ':strict' ) !== false;
					$Suffix = $Strict ? "'".$SearchString."'" : "'%".$SearchString."%'";
					$QueryString [] = str_replace( 
						array( '_dot_' , ':strict' ) , array( '.' , '' ) , $Field
					)." LIKE $Suffix";
				}

				return( $QueryString );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция создания поискового запроса.
		*
		*	@param $Fields - Поля.
		*
		*	@return Скрипт поиска.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates query string.
		*
		*	@param $Fields - Fields.
		*
		*	@return Search script.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			build_query_string( $Fields )
		{
			try
			{
				$QueryString = '1 = 1';

				$SearchString = $this->Security->get_gp( 'search_string' , 'string' , '' );

				if( $SearchString !== '' && isset( $Fields[ 0 ] ) )
				{
					$QueryString = array();

					foreach( $Fields as $i => $Field )
					{
						$QueryString = $this->add_field_to_query_string( $Field , $QueryString , $SearchString );
					}

					$QueryString = '( '.implode( ' OR ' , $QueryString ).' )';
				}

				return( $QueryString );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>