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
	*	\~russian Класс для быстрого создания кнопок.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class for rapid buttons creation.
	*
	*	@author Dodonov A.A.
	*/
	class	form_buttons_1_0_0{

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
		var					$Settings = false;
		var					$String = false;

		/**
		*	\~russian Версия.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Version.
		*
		*	@author Dodonov A.A.
		*/
		var					$Version = 1;

		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'create'.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@return HTML код для отображения.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'create'.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Str - String to process.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_create( &$Options , $Str )
		{
			try
			{
				if( strpos( $Str , '{create}' ) !== false )
				{
					$Str = str_replace( '{create}' , '{create:text=create}' ,$Str );
				}

				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'create' ) ; )
				{
					$this->Settings->load_settings( $Parameters );
					$Text = $this->Settings->get_setting( 'text' , 'create' );
					
					$Code = "{href:tpl=submit0;form_id=create_{prefix}_form;text=$Text}";
					$Str = str_replace( "{create:$Parameters}" , $Code , $Str );
				}
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'save'.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@return HTML код для отображения.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'save'.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Str - String to process.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_save( &$Options , $Str )
		{
			try
			{
				if( strpos( $Str , '{save}' ) !== false )
				{
					$Str = str_replace( '{save}' , '{href:tpl=submit0;form_id=update_{prefix}_form;text=save}' ,$Str );
				}
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'copy'.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@return HTML код для отображения.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'copy'.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Str - String to process.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_copy( &$Options , $Str )
		{
			try
			{
				if( strpos( $Str , '{copy}' ) !== false )
				{
					$Str = str_replace( '{copy}' , '{href:tpl=submit0;form_id=copy_{prefix}_form;text=save}' ,$Str );
				}
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'cancel'.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Settings - Параметры макроса.
		*
		*	@return Название страницы.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'cancel'.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Settings - Macro settings.
		*
		*	@return Page name.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_cancel_page( &$Options , &$Settings )
		{
			try
			{
				$Page = $Settings->get_setting( 'page' , $_SERVER[ 'REQUEST_URI' ] );
				
				$Page = $Options->get_setting( 'cancel_page' , $Page );
				
				$Page = str_replace( array( '=' , ';' ) , array( '[eq]' , '[dot_comma]' ) , $Page );
				
				return( $Page );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'cancel'.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@return HTML код для отображения.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'cancel'.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Str - String to process.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_cancel( &$Options , $Str )
		{
			try
			{
				if( strpos( $Str , '{cancel}' ) !== false )
				{
					$Str = str_replace( '{cancel}' , '{cancel:p=1}' , $Str );
				}

				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'cancel' ) ; )
				{
					$this->Settings->load_settings( $Parameters );

					$Page = $this->get_cancel_page( $Options , $this->Settings );

					$Str = str_replace( "{cancel:$Parameters}" , "{href:tpl=std;page=$Page;text=cancel}" , $Str );
				}
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция создания кнопок формы.
		*
		*	@param $Settings - Опции набора контекстов.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Str - обрабатывемая строка.
		*
		*	@return HTML код для отображения.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates form buttons.
		*
		*	@param $Settings - Options of context_set.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Str - processing string.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_buttons( &$Settings , &$Options , $Str  )
		{
			try
			{
				$Str = $this->compile_create( $Options , $Str );
				
				$Str = $this->compile_save( $Options , $Str );
				
				$Str = $this->compile_copy( $Options , $Str );

				$Str = $this->compile_cancel( $Options , $Str );
				
				$Str = str_replace( '{prefix}' , $Settings->get_setting( 'prefix' , '' ) , $Str );
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>