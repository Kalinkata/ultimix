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
	*	\~russian Класс для подключения макросов jquery.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class loads jquery macroes.
	*
	*	@author Dodonov A.A.
	*/
	class	jquery_markup_1_0_0{

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
		var					$CachedMultyFS = false;

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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'accordion_section'.
		*
		*	@param $Settings - Настройки.
		*
		*	@return Виджет.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'accordion_section'.
		*
		*	@param $Settings - Settings.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_accordion_section( &$Settings )
		{
			try
			{
				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'accordeon_section.tpl' );
				$Code = str_replace( '{title}' , $Settings->get_setting( 'title' ) , $Code );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции макроса 'tab_control'.
		*
		*	@param $Settings - Настройки.
		*
		*	@return Виджет.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'tab_control'.
		*
		*	@param $Settings - Settings.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_tab_control( &$Settings )
		{
			try
			{
				$TabControl = $this->CachedMultyFS->get_template( __FILE__ , 'tab_control.tpl' );

				$Selector = $Settings->get_setting( 'selector' , md5( microtime( true ) ) );
				$id = $Settings->get_setting( 'id' , $Selector );

				return( str_replace( '{id}' , $id , $TabControl ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'add_tab'.
		*
		*	@param $Settings - Настройки.
		*
		*	@return Виджет.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'add_tab'.
		*
		*	@param $Settings - Settings.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_add_tab( &$Settings )
		{
			try
			{
				$Settings->get_setting( 'id' );
				$Settings->get_setting( 'content_id' );
				
				$Settings->set_undefined( 'title' , 'title' );
				$Settings->set_undefined( 'index' , -1 );
				$Settings->set_undefined( 'closable' , 'true' );

				$Tab = $this->CachedMultyFS->get_template( __FILE__ , 'add_tab.tpl' );
				$Data = $Settings->get_raw_settings();

				return( $Tab );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции макроса 'add_iframe_tab'.
		*
		*	@param $Settings - Настройки.
		*
		*	@return Виджет.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'add_iframe_tab'.
		*
		*	@param $Settings - Settings.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_add_iframe_tab( &$Settings )
		{
			try
			{
				$Tab = $this->CachedMultyFS->get_template( __FILE__ , 'add_iframe_tab.tpl' );
				$Selector = $Settings->get_setting( 'selector' , '' );
				$Tab = str_replace( 
					array( '{id}' , '{url}' , '{title}' , '{index}' , '{height}' , '{closable}' ) , 
					array( 
						$Settings->get_setting( 'id' , $Selector ) , $Settings->get_setting( 'url' ) , 
						$Settings->get_setting( 'title' , 'title' ) , $Settings->get_setting( 'index' , -1 ) , 
						$Settings->get_setting( 'height' , 'auto' ) , 
						$Settings->get_setting( 'closable' , false ) !== false ? 'true' : 'false' 
					) , $Tab
				);
				return( $Tab );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>