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
	*	\~russian Класс отображения календаря.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class displays calendar.
	*
	*	@author Dodonov A.A.
	*/
	class	calendar_1_0_0
	{
		
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
		var					$Security = false;
		
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
				$this->CachedMultyFS = get_package_object( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция предгенерационных действий.
		*
		*	@param $Options - Настройки работы модуля.
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
				$PackagePath = _get_package_relative_path_ex( 'gui::calendar' , 'last' );
				$PageCSS = get_package( 'page::page_css' , 'last' , __FILE__ );
				$PageCSS->add_stylesheet( "{http_host}/$PackagePath/res/css/calendar.css" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение шаблонов для вывода календаря.
		*
		*	@return Шаблоны.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Getting templates.
		*
		*	@return Templates.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_templates()
		{
			try
			{
				//TODO: refactor it to get_templates( $TemplateNames )
				return(
					array(
						$this->CachedMultyFS->get_template( __FILE__ , 'calendar_start.tpl' ) , 
						$this->CachedMultyFS->get_template( __FILE__ , 'calendar_end.tpl' ) , 
						$this->CachedMultyFS->get_template( __FILE__ , 'calendar_row_start.tpl' ) , 
						$this->CachedMultyFS->get_template( __FILE__ , 'calendar_row_end.tpl' ) , 
						$this->CachedMultyFS->get_template( __FILE__ , 'calendar_header_cell.tpl' ) , 
						$this->CachedMultyFS->get_template( __FILE__ , 'calendar_cell.tpl' )
					)
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Компиляция заголовка календаря.
		*
		*	@param $DisplayTime - Время, на которое надо отображать календарь.
		*
		*	@param Template - Шаблон ячейки.
		*
		*	@param Text - Текст ячейки.
		*
		*	@param Day - День ячейки.
		*
		*	@return Ячейка.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles calendar header.
		*
		*	@param $DisplayTime - Time of the displaiing month.
		*
		*	@param Template - Cell template.
		*
		*	@param Text - Cell text.
		*
		*	@param Day - Cell day.
		*
		*	@return Cell.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_header_cell( $DisplayTime , $Template , $Text , $Day )
		{
			try
			{
				$Template = str_replace( '{header_cell}' , $Text , $Template );
				
				$FirstDay = mktime( 0 , 0 , 0 , date( 'n',  $DisplayTime ) , 1 , date( 'Y' , $DisplayTime ) );
				$w = date( 'w' , $FirstDay );
				$w = $w == 0 ? 6 : $w - 1;
				
				$Class = $w == $Day && date( 'd' ) < 7 - $w ? ' active_cell_bottom' : '';
				
				$Template = str_replace( '{active_cell_bottom}' , $Class , $Template );
				
				return( $Template );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция заголовка календаря.
		*
		*	@param $DisplayTime - Время, на которое надо отображать календарь.
		*
		*	@param HeaderCell - Шаблон ячейки.
		*
		*	@param HolidayHeaderCell - Шаблон ячейки.
		*
		*	@return Ячейка.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles calendar header.
		*
		*	@param $DisplayTime - Time of the displaiing month.
		*
		*	@param HeaderCell - Template.
		*
		*	@param HolidayHeaderCell - Template.
		*
		*	@return Cell.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_header_cells( $DisplayTime , $HeaderCell , $HolidayHeaderCell )
		{
			try
			{
				return( 
					$this->compile_header_cell( $DisplayTime , $HeaderCell , '{lang:mon}' , 1 ).
					$this->compile_header_cell( $DisplayTime , $HeaderCell , '{lang:tue}' , 2 ).
					$this->compile_header_cell( $DisplayTime , $HeaderCell , '{lang:wed}' , 3 ).
					$this->compile_header_cell( $DisplayTime , $HeaderCell , '{lang:thr}' , 4 ).
					$this->compile_header_cell( $DisplayTime , $HeaderCell , '{lang:fri}' , 5 ).
					$this->compile_header_cell( $DisplayTime , $HolidayHeaderCell , '{lang:sat}' , 6 ).
					$this->compile_header_cell( $DisplayTime , $HolidayHeaderCell , '{lang:sun}' , 0 )
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция заголовка календаря.
		*
		*	@param $DisplayTime - Время, на которое надо отображать календарь.
		*
		*	@return Заголовок календаря.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles calendar header.
		*
		*	@param $DisplayTime - Time of the displaiing month.
		*
		*	@return Calendar's template.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_header( $DisplayTime )
		{
			try
			{
				list( $CalendarStart , $CalendarEnd , $RowStart , $RowEnd , $HeaderCell , $Cell ) = 
																								$this->get_templates();

				$HolidayHeaderCell = str_replace( '{holiday}' , ' holiday' , $HeaderCell );

				return( 
					$RowStart.$this->compile_header_cells( $DisplayTime , $HeaderCell , $HolidayHeaderCell ).$RowEnd
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция тулбара.
		*
		*	@param $DisplayTime - Время, на которое надо отображать календарь.
		*
		*	@return Код тулбара.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Toolbar compilation.
		*
		*	@param $DisplayTime - Time of the displaiing month.
		*
		*	@return HTML code of the toolbar.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_toolbar( $DisplayTime )
		{
			try
			{
				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'calendar_toolbar.tpl' );

				$MonthYear = date( 'm} Y' , $DisplayTime );

				$MonthPrev = strtotime( '-1 month' , $DisplayTime );
				$Code = str_replace( 
					'{toolbar}' , "{href:page=?calendar_time[eq]$MonthPrev;text=month_prev}{toolbar}" , $Code
				);

				$Code = str_replace( 
					'{toolbar}' , " {lang:month_name_$MonthYear {toolbar}" , $Code
				);

				$MonthNext = strtotime( '+1 month' , $DisplayTime );
				$Code = str_replace( '{toolbar}' , "{href:page=?calendar_time[eq]$MonthNext;text=month_next}" , $Code );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция стиля ячейки календаря.
		*
		*	@param $CellDay - Время в ячейке.
		*
		*	@return Класс.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Calendar cell style compilation.
		*
		*	@param $CellDay - Cell day.
		*
		*	@return Class.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_cell_class( $CellDay )
		{
			try
			{
				$ThisDay = date( 'Y-m-d' ) == date( 'Y-m-d' , $CellDay );
				$ThisMonth = date( 'Y-m' ) == date( 'Y-m' , $CellDay );
				
				$Class = $ThisDay ? ' active_cell' : '';

				$NextWeekDay = date( 'j' ) == date( 'j' , $CellDay ) + 7;
				$Class = $ThisMonth && $NextWeekDay ? ' active_cell_bottom' : $Class;
				
				$NextDay = date( 'j' ) == date( 'j' , $CellDay ) + 1;
				$Class = $ThisMonth && $NextDay ? ' active_cell_right' : $Class;
				
				return( $Class );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция календаря.
		*
		*	@param $Day - Номер дня.
		*
		*	@param $CellDay - Время в ячейке.
		*
		*	@return Код календаря.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Calendar compilation.
		*
		*	@param $Day - Day number.
		*
		*	@param $CellDay - Cell day.
		*
		*	@return HTML code of the calendar.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_cell( $Day , $CellDay )
		{
			try
			{
				list( $CalendarStart , $CalendarEnd , $RowStart , $RowEnd , $HeaderCell , $Cell ) = 
																								$this->get_templates();
				
				$Code = '';
				
				$Code .= $Day % 7 === 1 ? $RowStart : '';
				$Code .= str_replace( '{day}' , $CellDay , $Cell );
				
				$DayOfWeek = date( 'w' , $CellDay );
				
				$Code = $DayOfWeek == 0 || $DayOfWeek == 6 ? str_replace( '{holiday}' , ' holiday' , $Code ) : $Code;
				$Class = $this->compile_cell_class( $CellDay );
				$Code = str_replace( '{active_cell}' , $Class , $Code );
				$Code .= $Day % 7 === 0 ? $RowEnd : '';
				
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция строки календаря.
		*
		*	@param $DayOfWeek - День недели.
		*
		*	@param $FirstDay - Первый день в календаре.
		*
		*	@param $DisplayTime - Время, на которое надо отображать календарь.
		*
		*	@return Код календаря.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Calendar row compilation.
		*
		*	@param $DayOfWeek - Day of week.
		*
		*	@param $FirstDay - First day in the calendar.
		*
		*	@param $DisplayTime - Time of the displaiing month.
		*
		*	@return HTML code of the calendar.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_rows( $DisplayTime , $DayOfWeek , $FirstDay , $DisplayTime )
		{
			try
			{
				list( $CalendarStart , $CalendarEnd , $RowStart , $RowEnd , $HeaderCell , $Cell ) = 
																								$this->get_templates();

				$Code = '';
				
				for( $Day = 1 ; $Day <= 42 ; $Day++ )
				{
					$DayAdd = $Day - $DayOfWeek;
					$CellDay = strtotime( $DayAdd < 0 ? $DayAdd.' day' : "+$DayAdd day" , $FirstDay );
					$Code .= $this->compile_cell( $Day , $CellDay );
					
					if( date( 'm' , $CellDay ) !== date( 'm' , $DisplayTime ) && $Day % 7 === 0 )
					{
						break;
					}
				}
				
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Компиляция календаря.
		*
		*	@param $Settings - Парметры.
		*
		*	@return Код календаря.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Calendar compilation.
		*
		*	@param $Settings - Settings.
		*
		*	@return HTML code of the calendar.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_calendar( &$Settings )
		{
			try
			{
				$DisplayTime = $this->Settings->get_setting( 'calendar_time' , time() );
				$DisplayTime = $this->Security->get_gp( 'calendar_time' , 'integer' , $DisplayTime );

				list( $Start , $End , $RowStart , $RowEnd , $HeaderCell , $Cell ) = 
					$this->get_templates();

				$FirstDay = mktime( 0 , 0 , 0 , date( 'n',  $DisplayTime ) , 1 , date( 'Y' , $DisplayTime ) );

				$Code = $Start.$this->get_toolbar( $DisplayTime );
				$Code .= $this->compile_header( $DisplayTime );

				$DayOfWeek = date( 'w' , $FirstDay );
				$Code .= $this->compile_rows( $DisplayTime , $DayOfWeek , $FirstDay , $DisplayTime );

				return( $Code.$End );
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
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code of the компонента.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( &$Options )
		{
			try
			{
				if( $Options->get_setting( 'calendar' , false ) )
				{
					$CalendarTime = $this->Security->get_gp( 'calendar_time' , 'integer' , false );
					$this->Output = $this->compile_calendar( $CalendarTime );
				}
				
				return( $this->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>