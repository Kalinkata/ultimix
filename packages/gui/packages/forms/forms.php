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
	*	\~russian Класс обработки форм.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes forms.
	*
	*	@author Dodonov A.A.
	*/
	class	forms_1_0_0
	{
		/**
		*	\~russian Результат работы функций отображения.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Display method's result.
		*
		*	@author Dodonov A.A.
		*/
		var					$Output = false;
		
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
		var					$CachedMultyFS = false;
		var					$Mail = false;
		var					$PackageSettings = false;
		var					$String = false;
		var					$SecurityUtilities = false;
		
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
				$this->BlockSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Mail = get_package( 'mail' , 'last' , __FILE__ );
				$this->PackageSettings = get_package_object( 'settings::package_settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->SecurityUtilities = get_package( 'security::security_utilities' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отправки формы.
		*
		*	@param $Email - Текст сообщения.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sends form.
		*
		*	@param $Email - Message.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	send_email( $Email )
		{
			try
			{
				$From = $this->PackageSettings->get_package_setting( 
					'gui::forms' , 'last' , 'cf_forms' , 'from_email' , 'no_answer@localhost'
				);
				
				$To = $this->PackageSettings->get_package_setting( 
					'gui::forms' , 'last' , 'cf_forms' , 'to_email' , 'admin@localhost'
				);
				
				$Subject = $this->PackageSettings->get_package_setting( 
					'gui::forms' , 'last' , 'cf_forms' , 'subject' , 'New message'
				);
				
				$this->Mail->send_email( $From , $To , $Subject , $Email );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки формы.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes form.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			send_form( &$Options )
		{
			try
			{
				$EmailFile = $Options->get_setting( 'email_template' );

				$Email = $this->CachedMultyFS->get_template( __FILE__ , "$EmailFile.tpl" );

				$Data = $this->SecurityUtilities->get_all_posted_data();

				$Email = $this->String->print_record( $Email , $Data );

				$this->send_email( $Email );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw_form( &$Options )
		{
			try
			{
				$FormFile = $Options->get_setting( 'form_template' );
					
				$this->Output = $this->CachedMultyFS->get_template( __FILE__ , "$FormFile.tpl" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'form'.
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
		*	\~english Function processes macro 'form'.
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
		function			process_form( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'form' ) ; )
				{
					$this->BlockSettings->load_settings( $Parameters );
					
					$this->draw_form( $this->BlockSettings );
					
					$Str = str_replace( "{form:$Parameters}" , $this->Output , $Str );

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
		function			process_string( &$Options , $Str , &$Changed )
		{
			try
			{
				list( $Str , $Changed ) = $this->process_form( $Str , $Changed );
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция управления компонентом.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function controls component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			controller( $Options )
		{
			try
			{
				$ContextSet = get_package( 'gui::context_set' , 'last' , __FILE__ );
				
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_send_form' );
				
				$ContextSet->execute( $Options , $this , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code of the компонента.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( &$Options )
		{
			try
			{
				$ContextSet = get_package( 'gui::context_set' , 'last' , __FILE__ );
				
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_draw_form' );

				$ContextSet->execute( $Options , $this , __FILE__ );
				
				return( $this->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>