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
	*	\~russian Класс обработки клавиатурных макросов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes keyboard macro.
	*
	*	@author Dodonov A.A.
	*/
	class	keyboard_markup_1_0_0
	{
		/**
		*	\~russian Функция компиляции макроса 'enter_processor'.
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
		*	\~english Function compiles macro 'enter_processor'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_enter_processor( &$Settings )
		{
			try
			{
				$EnterProcessor = $Settings->get_setting( 'function' , false );

				if( $EnterProcessor === false )
				{
					$FormId = $Settings->get_setting( 'form_id' );

					return(	"onkeyup=\"javascript:ultimix.forms.enter_processor( event , '".$FormId."' );\"" );
				}
				else
				{
					return(	
						"onkeyup=\"javascript:ultimix.forms.enter_was_pressed( event ) ? ".
						"$EnterProcessor : void( 0 );\""
					);
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>