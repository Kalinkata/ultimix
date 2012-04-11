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
	*	\~russian Класс разметки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Markup.
	*
	*	@author Dodonov A.A.
	*/
	class	context_set_markup_1_0_0{
	
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
		var					$CommonButtons = false;
		var					$FormButtons = false;
		var					$MacroSettings = false;
		var					$String = false;

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
				$this->CommonButtons = get_package( 'gui::context_set::common_buttons' , 'last' , __FILE__ );
				$this->FormButtons = get_package( 'gui::context_set::form_buttons' , 'last' , __FILE__ );
				$this->MacroSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отвечающая за обработку макроса 'options'.
		*
		*	@param $Options - Некоторые настройки.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return Обработанная строка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'options'.
		*
		*	@param $Options - Some settings.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return Processed string.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_options( $Options , $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'options' ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );
					$Name = $this->MacroSettings->get_setting( 'name' );
					$Value = $Options->get_setting( $Name , '' );
					
					$Str = str_replace( "{options:$Parameters}" , $Value , $Str );
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
		*	\~russian Обработка вида.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@param $ContextSetSettings - Параметры выполнения.
		*
		*	@param $Str - Вид.
		*
		*	@return Вид.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes view.
		*
		*	@param $Options - Execution parameters.
		*
		*	@param $ContextSetSettings - Execution parameters.
		*
		*	@param $Str - View.
		*
		*	@return View.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_view( &$Options , &$ContextSetSettings , $Str )
		{
			try
			{
				if( $Options->get_setting( 'view' , 0 ) == 1 )
				{
					$Str = $this->CommonButtons->process_buttons( $ContextSetSettings , $Options , $Str );

					$Str = $this->FormButtons->process_buttons( $ContextSetSettings , $Options , $Str );

					$Changed = false;
					list( $Str , $Changed ) = $this->process_options( $Options , $Str , $Changed );
				}

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>