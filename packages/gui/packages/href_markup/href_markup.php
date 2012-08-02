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
	class	href_markup_1_0_0
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
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'href'.
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
		*	\~english Function compiles macro 'href'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_href( &$Settings )
		{
			try
			{
				$Settings->set_undefined( 'waiting' , 'false' );
				$Settings->set_undefined( 'text' , 'no_text' );
				$Settings->set_undefined( 'raw_text' , '' );
				$Settings->set_undefined( 'confirm_string' , 'no_text' );

				$FileName = $Settings->get_setting( 'tpl' , 'std' );
				$Code = $this->CachedMultyFS->get_template( __FILE__ , $FileName.'.tpl' );

				return( $this->String->print_record( $Code , $Settings->get_raw_settings() ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'submit'.
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
		*	\~english Function compiles macro 'submit'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_submit( &$Settings )
		{
			try
			{
				$Settings->set_undefined( 'text' , 'submit' );
				$Settings->set_undefined( 'waiting' , 'false' );
				$Settings->set_undefined( 'text' , 'no_text' );
				$Settings->set_undefined( 'raw_text' , '' );
				$Settings->set_undefined( 'confirm_string' , 'no_text' );

				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'submit0.tpl' );

				return( $this->String->print_record( $Code , $Settings->get_raw_settings() ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>