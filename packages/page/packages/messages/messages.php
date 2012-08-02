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
	*	\~russian Класс обработки сообщений страницы.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes page's messages.
	*
	*	@author Dodonov A.A.
	*/
	class	messages_1_0_0
	{
		/**
		*	\~russian Массив с сообщениями об ошибках.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Array keeps all error messages.
		*
		*	@author Dodonov A.A.
		*/
		var					$ErrorMessages = array();

		/**
		*	\~russian Массив с сообщениями об успешном завершении какого-либо действия.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Array keeps all notification messages.
		*
		*	@author Dodonov A.A.
		*/
		var					$SuccessMessages = array();

		/**
		*	\~russian Закэшированный объект.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached object.
		*
		*	@author Dodonov A.A.
		*/
		var					$CachedMultyFS = false;
		var					$Security = false;

		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция добавляет на отрисовку сообщение об ошибке.
		*
		*	@param $Message - Сообщение об ошибке.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function adds error message to render queue.
		*
		*	@param $Message - Error message.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_error_message( $Message )
		{
			try
			{
				if( array_search( $Message , $this->ErrorMessages ) === false )
				{
					$this->ErrorMessages [] = $Message;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция возвращает последнее сообщение.
		*
		*	@return Сообщение.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns last error message.
		*
		*	@return Error message.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_last_error_message()
		{
			try
			{
				if( isset( $this->ErrorMessages[ 0 ] ) )
				{
					return( $this->ErrorMessages[ count( $this->ErrorMessages ) - 1 ] );
				}
				else
				{
					return( 'message_was_not_found' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция добавляет на отрисовку сообщение.
		*
		*	@param $Message - Сообщение.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function adds notification message to render queue.
		*
		*	@param $Message - Success message.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_success_message( $Message )
		{
			try
			{
				if( array_search( $Message , $this->SuccessMessages ) === false )
				{
					$this->SuccessMessages [] = $Message;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция возвращает последнее сообщение.
		*
		*	@return Сообщение.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns last success message.
		*
		*	@return Success message.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_last_success_message()
		{
			try
			{
				if( isset( $this->SuccessMessages[ 0 ] ) )
				{
					return( $this->SuccessMessages[ count( $this->SuccessMessages ) - 1 ] );
				}
				else
				{
					return( 'message_was_not_found' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка сообщений.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes success messages.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_success_message_from_session()
		{
			try
			{
				if( $this->Security->get_s( 'success_message' , 'set' ) )
				{
					$this->add_success_message( $this->Security->get_s( 'success_message' , 'command' ) );
					$this->Security->unset_s( 'success_message' );
				}

				$PageName = $this->Security->get_gp( 'page_name' , 'command' );

				if( $this->Security->get_s( "$PageName:success_message" , 'set' ) )
				{
					$FieldName = "$PageName:success_message";
					$this->add_success_message( $this->Security->get_s( $FieldName , 'command' ) );
					$this->Security->unset_s( "$PageName:success_message" );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Очистка всех сообщений.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function clears all messages.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			clear_messages()
		{
			try
			{
				$this->SuccessMessages = array();
				$this->ErrorMessages = array();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'success_messages'.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return Widget.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'success_messages'.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_success_messages( &$Settings )
		{
			try
			{
				$Code = '';

				if( isset( $this->SuccessMessages[ 0 ] ) )
				{
					$StartingDiv = $this->CachedMultyFS->get_template( __FILE__ , 'success_start.tpl' );

					$ClosingDiv = $this->CachedMultyFS->get_template( __FILE__ , 'success_end.tpl' );

					$Messages = implode( '}'.$ClosingDiv.$StartingDiv.'{lang:' , $this->SuccessMessages );

					$Code = $StartingDiv."{lang:$Messages}".$ClosingDiv;

					$this->SuccessMessages = array();
				}

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция компиляции макроса 'error_messages'.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return Widget.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'error_messages'.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_error_messages( &$Settings )
		{
			try
			{
				$Code = '';

				if( isset( $this->ErrorMessages[ 0 ] ) )
				{
					$StartingDiv = $this->CachedMultyFS->get_template( __FILE__ , 'error_start.tpl' );
					$ClosingDiv = $this->CachedMultyFS->get_template( __FILE__ , 'error_end.tpl' );

					$Code = implode( '}'.$ClosingDiv.$StartingDiv.'{lang:' , $this->ErrorMessages );

					$Code = $StartingDiv."{lang:$Messages}".$ClosingDiv;

					$this->ErrorMessages = array();
				}

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>