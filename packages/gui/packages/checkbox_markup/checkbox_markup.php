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
	*	\~russian Класс обработки макросов чекбоксов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes checkbox macro.
	*
	*	@author Dodonov A.A.
	*/
	class	checkbox_markup_1_0_0
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
		var					$CachedMultyFS = false;
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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
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
		*	\~russian Функция обработки макроса 'header_checkbox'.
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
		*	\~english Function processes macro 'header_checkbox'.
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
		function			process_header_checkbox( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'header_checkbox' ) ; )
				{
					$this->BlockSettings->load_settings( $Parameters );
					
					$Name = $this->BlockSettings->get_setting( 'name' );

					$Template = '{checkbox_ex:self_class=_'.$Name.'_header_checkbox;children_selector=._'.
						$Name."_item_checkbox;name=$Name}";

					$Str = str_replace( "{header_checkbox:$Parameters}" , $Template , $Str );

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
		*	\~russian Функция обработки макроса 'item_checkbox'.
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
		*	\~english Function processes macro 'item_checkbox'.
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
		function			process_item_checkbox( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'item_checkbox' ) ; )
				{
					$this->BlockSettings->load_settings( $Parameters );
					
					$Name = $this->BlockSettings->get_setting( 'name' );
					$Id = $this->BlockSettings->get_setting( 'id' );

					$Template = '{checkbox_ex:self_class=_'.$Name.'_item_checkbox;parent_selector=._'.$Name.
						"_header_checkbox;id=_id_$Id;name=_id_$Id}";

					$Str = str_replace( "{item_checkbox:$Parameters}" , $Template , $Str );

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
		*	\~russian Компиляция набора чекбоксов.
		*
		*	@param $Cols - Количество столбцов.
		*
		*	@param $Value - Текущее значение.
		*
		*	@param $Records - Записи для вывода.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles a set of checkboxes.
		*
		*	@param $Cols - Columns count.
		*
		*	@param $Value - Current value.
		*
		*	@param $Records - Records to output.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_checkboxes( $Cols , $Value , $Records )
		{
			try
			{
				$Counter = 0;
				$Code = '';
				foreach( $Records as $r )
				{
					if( $Counter == $Cols )
					{
						$Counter = 0;
						$Code .= $this->CachedMultyFS->get_template( __FILE__ , 'checkbox_set_line_end.tpl' );
					}

					$Value = $this->Security->get_gp( '_id_'.$r->id , 'command' , $Value );
					$Code .= $this->CachedMultyFS->get_template( __FILE__ , 'checkbox_set_item.tpl' );
					$PlaceHolders = array( '{id}' , '{value}' , '{title}' );
					$Data = array( $r->id , $Value , $r->title );
					$Code = str_replace( $PlaceHolders , array( $r->id , $Value , $r->title ) , $Code );

					$Counter++;
				}
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция набора чекбоксов.
		*
		*	@param $Cols - Количество столбцов.
		*
		*	@param $Value - Текущее значение.
		*
		*	@param $Records - Записи для вывода.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles a set of checkboxes.
		*
		*	@param $Cols - Columns count.
		*
		*	@param $Value - Current value.
		*
		*	@param $Records - Records to output.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_records( $Cols , $Value , $Records )
		{
			try
			{
				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'checkbox_set_start.tpl' );

				$Code .= $this->compile_checkboxes( $Cols , $Value , $Records );

				return( $Code .= $this->CachedMultyFS->get_template( __FILE__ , 'checkbox_set_end.tpl' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции макроса 'checkboxset'.
		*
		*	@param $BlockSettings - Параметры.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'checkboxset'.
		*
		*	@param $BlockSettings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_checkbox_set( &$BlockSettings )
		{
			try
			{
				$Cols = $BlockSettings->get_setting( 'cols' , 3 );
				$Value = $BlockSettings->get_setting( 'checked_all' , '0' ) == '0' ? 'off' : 'on';
				$Query = $BlockSettings->get_setting( 'query' );
				$this->Database->query_as( DB_OBJECT );
				$Records = $this->Database->query( $Query );
				$Records = $this->Database->fetch_results( $Records );

				$Code = $this->compile_records( $Cols , $Value , $Records );
				
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'checkboxset'.
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
		*	\~english Function processes macro 'checkboxset'.
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
		function			process_checkboxset( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'checkboxset' ) ; )
				{
					$this->BlockSettings->load_settings( $Parameters );

					$Code = $this->compile_checkbox_set( $this->BlockSettings );

					$Str = str_replace( "{checkboxset:$Parameters}" , $Code , $Str );

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
		*	\~russian Функция компиляции макроса 'checkbox'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'checkbox'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_checkbox( &$BlockSettings )
		{
			try
			{
				$BlockSettings->set_undefined( 'default' , 0 );
				$BlockSettings->set_undefined( 'id' , md5( microtime() ) );
				$BlockSettings->set_undefined( 'label' , '' );

				$Type = $BlockSettings->get_setting( 'type' , 'double' );

				$Code = $this->CachedMultyFS->get_template( __FILE__ , $Type.'_state_checkbox.tpl' );

				$Code = $this->String->print_record( $Code , $BlockSettings->get_raw_settings() );
				
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'checkbox'.
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
		*	\~english Function processes macro 'checkbox'.
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
		function			process_checkbox( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'default' => TERMINAL_VALUE , 'current_value' => TERMINAL_VALUE );

				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'checkbox' , $Limitations ) ; )
				{
					$this->BlockSettings->load_settings( $Parameters );

					$Code = $this->compile_checkbox( $this->BlockSettings );

					$Str = str_replace( "{checkbox:$Parameters}" , $Code , $Str );
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
		*	\~russian Функция получения селекторов.
		*
		*	@param $BlockSettings - Настройки.
		*
		*	@return Селектор.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns selectors.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return Selector.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_selectors( &$BlockSettings )
		{
			try
			{
				$SelfClass = $BlockSettings->get_setting( 'self_class' , false );
				$ParentSelector = $BlockSettings->get_setting( 'parent_selector' , false );
				$SiblingsSelector = $BlockSettings->get_setting( 'siblings_selector' , '.'.$SelfClass );
				$ChildrenSelector = $BlockSettings->get_setting( 'children_selector' , false );
				$Sel = $ParentSelector !== false ? " parent_selector='$ParentSelector'" : '';
				$Sel = $SiblingsSelector !== false ? $Sel." siblings_selector='$SiblingsSelector'" : $Sel;
				return( $ChildrenSelector !== false ? $Sel." children_selector='$ChildrenSelector'" : $Sel );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения селекторов.
		*
		*	@param $BlockSettings - Настройки.
		*
		*	@return Селектор.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns selectors.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return Selector.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_checkbox_ex( &$BlockSettings )
		{
			try
			{
				$SelfClass = $BlockSettings->get_setting( 'self_class' , false );
				$Sel = $this->compile_selectors( $BlockSettings );

				$Id = $BlockSettings->get_setting( 'id' , '' );
				$Name = $BlockSettings->get_setting( 'name' );
				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'checkbox_ex.tpl' );
				$PlaceHolders = array( '{id}' , '{name}' , '{self_class}' , '{selector}' );
				$Data = array( $Id , $Name , $SelfClass , $Sel );
				$Code = str_replace( $PlaceHolders , $Data , $Code );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'checkbox_ex'.
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
		*	\~english Function processes macro 'checkbox_ex'.
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
		function			process_checkbox_ex( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'checkbox_ex' ) ; )
				{
					$this->BlockSettings->load_settings( $Parameters );

					$Code = $this->compile_checkbox_ex( $this->BlockSettings );

					$Str = str_replace( "{checkbox_ex:$Parameters}" , $Code , $Str );
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
				list( $Str , $Changed ) = $this->process_header_checkbox( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_item_checkbox( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_checkboxset( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_checkbox( $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_checkbox_ex( $Str , $Changed );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>