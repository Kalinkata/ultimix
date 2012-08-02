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
	*	\~russian Класс для подключения библиотеки джаваскриптов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class loads java script libraries.
	*
	*	@author Dodonov A.A.
	*/
	class	jslib_1_0_0{
		
		/**
		*	\~russian Получение пути к пакету.
		*
		*	@return Путь.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Getting path to package.
		*
		*	@return Path.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_path()
		{
			try
			{
				$Path = '{http_host}/'._get_package_relative_path_ex( 'jslib' , '1.0.0' ).'/include/js';
				
				return( $Path );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция предгенерационных действий.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function executes before any page generating actions took place.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			pre_generation( $Options )
		{
			try
			{
				$Path = $this->get_path();
				$PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				$PageJS->add_javascript( "$Path/ajax_gate.js" );
				$PageJS->add_javascript( "$Path/core.js" );
				$PageJS->add_javascript( "$Path/double_panel.js" );
				$PageJS->add_javascript( "$Path/forms.js" );
				$PageJS->add_javascript( "$Path/grids.js" );
				$PageJS->add_javascript( "$Path/inplace.js" );
				$PageJS->add_javascript( "$Path/iterator.js" );
				$PageJS->add_javascript( "$Path/string_utilities.js" );
				$PageJS->add_javascript( "$Path/utilities.js" );
				$PageJS->add_javascript( "$Path/windows.js" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Вид для скриптовой библиотеки (отвечает за подключение библиотеки).
		*
		*	@param $Options - не используется.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english View for the scripting library.
		*
		*	@param $Options - not used.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function	view( $Options )
		{
			try
			{
				return( '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>