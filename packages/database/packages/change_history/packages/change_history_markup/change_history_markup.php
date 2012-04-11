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
	*	\~russian Класс для сохранения изменений записей.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides records change history manupulation routine.
	*
	*	@author Dodonov A.A.
	*/
	class	change_history_markup_1_0_0{

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
		var					$MacroParameters = false;
		var					$CachedMultyFS = false;
		var					$ChangeHistoryView = false;
		var					$PageComposer = false;
		var					$String = false;
		
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
				$this->MacroParameters = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->ChangeHistoryView = get_package( 
					'database::change_history::change_history_view' , 'last' , __FILE__
				);
				$this->PageComposer = get_package( 'page::page_composer' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение шаблона кнопки.
		*
		*	@param $MacroParameters - Параметры макроса.
		*
		*	@return Шаблон кнопки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'history_button'.
		*
		*	@param $MacroParameters - Macro parameters.
		*
		*	@return Button template.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_button_template( $MacroParameters )
		{
			try
			{
				switch( $MacroParameters->get_setting( 'type' , '' ) )
				{
					case( 'href' ):$FileName = 'href_history_button.tpl';break;
					
					default:$FileName = 'image_history_button_48.tpl';break;
				}
				
				return( $this->CachedMultyFS->get_template( __FILE__ , $FileName ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции истории.
		*
		*	@return Скомпилированная история.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles history.
		*
		*	@return Compiled history.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_button_code()
		{
			try
			{
				$id = $this->MacroParameters->get_setting( 'id' );
				$ObjectType = $this->MacroParameters->get_setting( 'object_type' );
				
				$Code = $this->ChangeHistoryView->get_changes_grid( $id , $ObjectType );
				$Code = $this->get_button_template( $this->MacroParameters ).$Code;
				
				$Code = str_replace( '{id}' , $id , $Code );
				
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'history_button'.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'history_button'.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_history_button( $Str , $Changed )
		{
			try
			{
				$Rules = array( 'object_type' => TERMINAL_VALUE , 'id' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'history_button' , $Rules ) ; )
				{
					$this->MacroParameters->load_settings( $Parameters );

					$Str = str_replace( "{history_button:$Parameters}" , $this->get_button_code() , $Str );
					
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
		*	\~russian Функция отвечающая за обработку строки.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return HTML код для отображения.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes string.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_string( $Options , $Str , &$Changed )
		{
			try
			{	
				list( $Str , $Changed ) = $this->process_history_button( $Str , $Changed );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>