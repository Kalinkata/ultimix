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
	*	\~russian Класс обработки контролов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes controls macro.
	*
	*	@author Dodonov A.A.
	*/
	class	controls_markup_1_0_0
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
		var					$Database = false;
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
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'textarea'.
		*
		*	@param $Setings - Параметры.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'textarea'.
		*
		*	@param $Setings - Parameters.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	prepare_textarea_settings( &$Setings )
		{
			try
			{
				$this->Settings->set_undefined( 'toolbar' , 'ultimix_full' );
				$this->Settings->set_undefined( 'name' , 'editor');
				$this->Settings->set_undefined( 'class' , 'width_640 height_480' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции макроса 'textarea'.
		*
		*	@param $Str - Строка.
		*
		*	@param $Parameters - Параметры.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'textarea'.
		*
		*	@param $Str - String.
		*
		*	@param $Parameters - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_textarea( $Str , $Parameters )
		{
			try
			{
				$this->Settings->load_settings( $Parameters );
				$Text = $this->String->get_block_data( $Str , "textarea:$Parameters" , '~textarea' );
				$this->Settings->set_setting( 'text' , $Text );

				$this->prepare_textarea_settings( $this->Settings );

				$SimpleEditor = $this->Settings->get_setting( 'simple_editor' , 0 );
				$File = $SimpleEditor == 1 ? 'simple_editor.tpl' : 'editor.tpl';
				$EditorTemplate = $this->CachedMultyFS->get_template( __FILE__ , $File );
				$RawSettings = $this->Settings->get_raw_settings();

				return( $this->String->print_record( $EditorTemplate , $RawSettings ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'textarea'.
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
		*	\~english Function processes macro 'textarea'.
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
		function			process_textarea( $Str , $Changed )
		{
			try
			{
				$Rules = array( 'simple_editor' => TERMINAL_VALUE );

				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'textarea' , $Rules ) ; )
				{
					$Code = $this->compile_textarea( $Str , $Parameters );
					
					$Str = str_replace( "{textarea:$Parameters}" , $Code."{textarea:$Parameters}" , $Str );
					
					$Str = $this->String->hide_block( $Str , "textarea:$Parameters" , '~textarea' , $Changed );
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
		*	\~russian Выборка данных для селекта.
		*
		*	@param $Settings - Настройки селекта.
		*
		*	@return array( ids , values ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fetches data for select.
		*
		*	@param $Settings - Select settings.
		*
		*	@return array( ids , values ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_select_data( &$Settings )
		{
			try
			{
				if( $Settings->get_setting( 'query' , false ) !== false )
				{
					$Query = $Settings->get_setting( 'query' );
					$this->Database->query_as( DB_OBJECT );
					$Records = $this->Database->query( $Query );
					$Records = $this->Database->fetch_results( $Records );
					$First = get_field_ex( $Records , 'id' );
					$Second = get_field_ex( $Records , 'value' );
				}
				else
				{
					$First = explode( '|' , $Settings->get_setting( 'first' , false ) );
					$Second = explode( '|' , $Settings->get_setting( 'second' , false ) );
				}
				
				return( array( $First , $Second ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'select'.
		*
		*	@param $First - Идентификаторы.
		*
		*	@param $Second - Тексты.
		*
		*	@param $SelectedId - Выбранный элемент.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'select'.
		*
		*	@param $First - Ids.
		*
		*	@param $Second - Texts.
		*
		*	@param $SelectedId - Selected element.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_select_options( $First , $Second , $SelectedId )
		{
			try
			{
				$Code = '';
				
				foreach( $First as $k => $v )
				{
					$Selected = '';
					
					if( $SelectedId !== false && $SelectedId == $v )
					{
						$Selected = 'selected ';
					}
					
					$PlaceHolders = array( '{selected}' , '{value}' , '{title}' );
					$Data = array( $Selected , $v , $Second[ $k ] );
					$Code .= $this->CachedMultyFS->get_template( __FILE__ , 'select_option.tpl' );
					$Code = str_replace( $PlaceHolders , $Data , $Code );
				}
				
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'select'.
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
		*	\~english Function compiles macro 'select'.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return HTML код.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_select( &$Settings )
		{
			try
			{
				$Name = $Settings->get_setting( 'name' );
				$Class = $Settings->get_setting( 'class' , 'width_320 flat' );

				list( $First , $Second ) = $this->get_select_data( $Settings );

				$SelectedId = $this->Security->get_gp( 
					$Name , 'string' , $Settings->get_setting( 'value' , false )
				);

				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'select_start.tpl' );
				$Code = str_replace( array( '{name}' , '{class}' ) , array( $Name , $Class ) , $Code );

				$Code .= $this->compile_select_options( $First , $Second , $SelectedId );

				return( $Code.$this->CachedMultyFS->get_template( __FILE__ , 'select_end.tpl' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'select'.
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
		*	\~english Function processes macro 'select'.
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
		function			process_select( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'name' => TERMINAL_VALUE , 'value' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'select' , $Limitations ) ; )
				{
					$this->Settings->load_settings( $Parameters );
					
					$Code = $this->compile_select( $this->Settings );

					$Str = str_replace( "{select:$Parameters}" , $Code , $Str );
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
		*	\~russian Функция компиляции макроса 'year_list'.
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
		*	\~english Function compiles macro 'year_list'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_year_list( &$Settings )
		{
			try
			{
				$From = $Settings->get_setting( 'from' , intval( date( 'Y' ) ) - 10 );
				$To = $Settings->get_setting( 'to' , intval( date( 'Y' ) ) + 10 );
				$First = array();
				for( $i = $From ; $i <= $To ; $i++ )
				{
					$First [] = $i;
				}
				$First = implode( '|' , $First );

				return( "{select:first=$First;second=$First;".$Settings->get_raw_settings()."}" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'year_list'.
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
		*	\~english Function processes macro 'year_list'.
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
		function			process_year_list( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'year_list' ) ; )
				{
					$this->Settings->load_settings( $Parameters );

					$Code = $this->compile_year_list( $this->Settings );

					$Str = str_replace( "{year_list:$Parameters}" , $Code , $Str );
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
				// TODO: exclude textarea
				list( $Str , $Changed ) = $this->process_textarea( $Str , $Changed );

				// TODO: exclude select
				list( $Str , $Changed ) = $this->process_select( $Str , $Changed );

				list( $Str , $Changed ) = $this->process_year_list( $Str , $Changed );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>