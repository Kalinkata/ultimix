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
		var					$Database = false;
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
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
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
		function			compile_radio_set_records( $Records , $Cols , $Name , $CurrentValue )
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
				$Query = $Settings->get_setting( 'query' );
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
		function			compile_radio_set( &$Settings )
		{
			try
			{
				list( $Cols , $Name )= $Settings->get_setting( 'cols,name' );

				$CurrentValue = $this->Security->get_gp( $Name , 'command' , '' );

				$Records = $this->get_records( $Settings );

				$Code = $this->compile_radio_set_records( $Records , $Cols , $Name , $CurrentValue );

				return( $Code );
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

				$id = $Settings->get_setting( 'id' , md5( microtime() ) );

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
		*	\~russian Функция компиляции макроса 'yes_no'.
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
		*	\~english Function compiles macro 'yes_no'.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_yes_no( &$Settings )
		{
			try
			{
				$Settings->set_undefined( 'current_value' , 1 );

				$Name = $Settings->get_setting( 'name' );
				$CurrentValue = $Settings->get_setting( 'current_value' );

				$Code = "{radio:value=1;current_value=$CurrentValue;name=$Name;label=yes}&nbsp;".
						 "{radio:value=2;current_value=$CurrentValue;name=$Name;label=no}";

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>