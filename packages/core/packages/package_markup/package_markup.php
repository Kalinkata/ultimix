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
	*	\~russian Класс обработки макросов пакетов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes package macro.
	*
	*	@author Dodonov A.A.
	*/
	class	package_markup_1_0_0
	{
		/**
		*	\~russian Функция компиляции макроса 'package_dialog'.
		*
		*	@param $Settings - Настройки.
		*
		*	@return Виджет.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'package_dialog'.
		*
		*	@param $Settings - Settings.
		*
		*	@return Widget.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_package_dialog( &$Settings )
		{
			try
			{
				$Settings->set_setting( 'id' , 'package_dialog' );
				$Settings->set_setting( 'title' , 'package_dialog' );
				$PackageName = 'core::package_manager';
				$Settings->set_setting( 'package_name' , $PackageName );
				$Settings->set_setting( 'show_package_tree' , '1' );
				
				return( '{view_dialog:'.$Settings->get_all_settings().'}' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>