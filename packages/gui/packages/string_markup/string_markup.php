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
	*	\~russian Класс обработки строковых макросов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes string macro.
	*
	*	@author Dodonov A.A.
	*/
	class	string_markup_1_0_0
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
				$Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция копиляции макроса 'sprintf'.
		*
		*	@param $Settings - Параметры обработки.
		*
		*	@return Виджет.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'sprintf'.
		*
		*	@param $Settings - Processing options.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_sprintf( &$Settings )
		{
			try
			{
				$Format = $Settings->get_setting( 'format' , '%s' );
				$Value = $Settings->get_setting( 'value' , '' );
				
				return( sprintf( $Format , $Value ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция копиляции макроса 'encoding'.
		*
		*	@param $Settings - Параметры обработки.
		*
		*	@return Виджет.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'encoding'.
		*
		*	@param $Settings - Processing options.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_encoding( $Str , $Changed )
		{
			try
			{
				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'encoding.tpl' );

				$Name = $Settings->get_setting( 'name' , 'encoding' );
				$Selected = $Settings->get_setting( 'selected' , 'utf-8' );

				$Code = str_replace( '{name}' , $Name , $Code );
				$Code = str_replace( '{selected'.$Selected.'}' , 'selected' , $Code );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>