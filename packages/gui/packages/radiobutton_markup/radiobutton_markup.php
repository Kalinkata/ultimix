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
	*	\~russian Класс обработки макросов радиобаттонов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes radio buttons macro.
	*
	*	@author Dodonov A.A.
	*/
	class	radiobutton_markup_1_0_0
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
		var					$BlockSettings = false;
		var					$Database = false;
		var					$Security = false;
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
				$this->BlockSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Компиляция radio баттона.
		*
		*	@param $r - Запись.
		*
		*	@param $Name - Название контрола.
		*
		*	@param $CurrentValue - Текущее значение.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles radio button.
		*
		*	@param $r - Record.
		*
		*	@param $Name - Control's name.
		*
		*	@param $CurrentValue - Current value.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_single_radiobutton( $r , $Name , $CurrentValue )
		{
			try
			{
				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'radio_set_item.tpl' );
				
				$PlaceHolders = array( '{name}' , '{value}' , '{current_value}' , '{label}' );
				
				$Data = array( $Name , $r->Value , $CurrentValue , $r->label );
				
				return( str_replace( $PlaceHolders , $Data , $Code ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция набора radio баттонов.
		*
		*	@param $Records - Записи.
		*
		*	@param $Cols - Количество колонок.
		*
		*	@param $Name - Название контрола.
		*
		*	@param $CurrentValue - Текущее значение.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles radio buttons.
		*
		*	@param $Records - Records.
		*
		*	@param $Cols - Number of columns.
		*
		*	@param $Name - Control's name.
		*
		*	@param $CurrentValue - Current value.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_radio_set( $Records , $Cols , $Name , $CurrentValue )
		{
			try
			{
				$Counter = 0;
				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'radio_set_start.tpl' );

				foreach( $Records as $r )
				{
					if( $Counter == $Cols )
					{
						$Counter = 0;
						$Code .= $this->CachedMultyFS->get_template( __FILE__ , 'radio_set_line_end.tpl' );
					}

					$Code .= $this->get_single_radiobutton( $r , $Name , $CurrentValue );

					$Counter++;
				}

				return( $Code .= $this->CachedMultyFS->get_template( __FILE__ , 'radio_set_end.tpl' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения записей.
		*
		*	@param $Settings - Настройки.
		*
		*	@return Записи.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fetches records.
		*
		*	@param $Settings - Settings.
		*
		*	@return Records.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_records( &$Settings )
		{
			try
			{
				$Query = $this->BlockSettings->get_setting( 'query' );
				$this->Database->query_as( DB_OBJECT );
				$Records = $this->Database->query( $Query );
				$Records = $this->Database->fetch_results( $Records );
				
				return( $Records );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'radio_set'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'radio_set'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_radio_set( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'radio_set' ) ; )
				{
					$this->BlockSettings->load_settings( $Parameters );
					
					list( $Cols , $Name )= $this->BlockSettings->get_setting( 'cols,name' );

					$CurrentValue = $this->Security->get_gp( $Name , 'command' , '' );
					
					$Records = $this->get_records( $this->BlockSettings );
					
					$Code = $this->compile_radio_set( $Records , $Cols , $Name , $CurrentValue );
					$Str = str_replace( "{radioset:$Parameters}" , $Code , $Str );

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
		*	\~russian Функция возвращает флаг 'checked'.
		*
		*	@param $Settings - Настройки.
		*
		*	@return Флаг.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns 'checked' flag.
		*
		*	@param $Settings - Settings.
		*
		*	@return Flag.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_checked( &$Settings )
		{
			try
			{
				$Value = $Settings->get_setting( 'value' );
				$Name = $Settings->get_setting( 'name' );
				
				if( $this->Security->get_gp( $Name ) )
				{
					$CurrentValue = $this->Security->get_gp( $Name , 'string' );
				}
				else
				{
					$CurrentValue = $Settings->get_setting( 'default' , $Value );
				}

				$Checked = $Value === $CurrentValue ? $Checked = 'checked' : '';
				
				return( $Checked );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция контрола.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return Контрол.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'radio'.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return Control.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_radio( &$Settings )
		{
			try
			{
				$Name = $Settings->get_setting( 'name' );
				
				$Value = $Settings->get_setting( 'value' );
				
				$Checked = $this->get_checked( $Settings );
				
				$id = $this->BlockSettings->get_setting( 'id' , md5( microtime() ) );

				$Template = "<input id=\"$id\" style=\"cursor: pointer;\" ".
									"type=\"radio\" value=\"$Value\" $Checked name=\"$Name\">";
									
				$Label = $Settings->get_setting( 'label' , '' );
				
				if( $Label != '' )
				{
					$Template = "<label for=\"$id\" style=\"cursor: pointer;\">$Template {lang:$Label}</label>";
				}
				
				return( $Template );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'radio'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'radio'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_radio( $Str , $Changed )
		{
			try
			{
				$Rules = array( 'value' => TERMINAL_VALUE , 'current_value' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'radio' , $Rules ) ; )
				{
					$this->BlockSettings->load_settings( $Parameters );
					
					$Radio = $this->compile_radio( $this->BlockSettings );
					
					$Str = str_replace( "{radio:$Parameters}" , $Radio , $Str );
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
		*	\~russian Функция компиляции макроса 'yes_no'.
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
		*	\~english Function compiles macro 'yes_no'.
		*
		*	@param $BlockSettings - Compilation parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_yes_no( &$BlockSettings )
		{
			try
			{
				$this->BlockSettings->set_undefined( 'current_value' , 1 );

				$Name = $this->BlockSettings->get_setting( 'name' );
				$CurrentValue = $this->BlockSettings->get_setting( 'current_value' );

				$Code = "{radio:value=1;current_value=$CurrentValue;name=$Name;label=yes}&nbsp;".
						 "{radio:value=2;current_value=$CurrentValue;name=$Name;label=no}";

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'yes_no'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'yes_no'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_yes_no( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'current_value' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'yes_no' , $Limitations ) ; )
				{
					$this->BlockSettings->load_settings( $Parameters );
					
					$Code = $this->compile_yes_no( $this->BlockSettings );
					
					$Str = str_replace( "{yes_no:$Parameters}" , $Code , $Str );
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
		*	\~russian Функция обработки строки.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return Обработанная строка.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes string.
		*
		*	@param $Options - Settings.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return Processed string.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_string( $Options , $Str , &$Changed )
		{
			try
			{
				list( $Str , $Changed ) = $this->process_radio_set( $Str , $Changed );

				list( $Str , $Changed ) = $this->process_radio( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_yes_no( $Str , $Changed );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>