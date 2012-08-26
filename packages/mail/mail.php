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
	*	\~russian Класс для отправки писем.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class sending emails.
	*
	*	@author Dodonov A.A.
	*/
	class	mail_1_0_0{
	
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
		var					$AutoMarkup = false;
		var					$Security = false;
		var					$Tags = false;
	
		/**
		*	\~russian Таймаут на вызов функции.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function call timeout.
		*
		*	@author Dodonov A.A.
		*/
		var					$Timeout = 0;
		
		/**
		*	\~russian Время последнего вызова функции.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Time of the last call of the method 'send_mail'.
		*
		*	@author Dodonov A.A.
		*/
		var					$LastCallTime = 0;
	
		/**
		*	\~russian Загрузка настроек.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_settings()
		{
			try
			{
				$Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$Settings->load_settings( $CachedMultyFS->get_config( __FILE__ , 'cf_mail' ) );
				$this->Timeout = $Settings->get_setting( 'timeout' , 0 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
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
				$this->LastCallTime = microtime( true ) - $this->Timeout / 1000000;

				$this->AutoMarkup = get_package( 'page::auto_markup' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Tags = get_package( 'string::tags' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Получение заголовков письма.
		*
		*	@param $From - Email отправителя письма.
		*
		*	@param $Sender - Имя отправителя.
		*
		*	@return Заголовки.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns email headers.
		*
		*	@param $From - Email of the sender.
		*
		*	@param $Sender - Sender's name.
		*
		*	@return Headers.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_headers( $From , $Sender )
		{
			try
			{
				$Headers = array();

				$Headers [] = "MIME-Version: 1.0\r\n";
				$Headers [] = "Content-type: text/plain; charset=utf-8\r\n"; 

				if( $From !== false )
				{
					if( $Sender !== false )
					{
						$Headers [] = 'From: =?utf-8?B?'.base64_encode( $Sender )."?= <$From>\r\n";
					}
					else
					{
						$Headers [] = "From: $From\r\n"; 
					}
				}
				$Headers [] = 'X-Mailer: PHP/'.phpversion(); 

				return( $Headers );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция строковых частей письма.
		*
		*	@param $Str - Строка для компиляции.
		*
		*	@return Скомпилированная строка.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method compiles string parts of the email.
		*
		*	@param $Str - String ti compile.
		*
		*	@return Compiled string.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_string( $Str )
		{
			try
			{
				$Str = $this->Tags->compile_ultimix_tags( $Str );

				$this->AutoMarkup->compile_string( $Str );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отправки email'а.
		*
		*	@param $From - Email отправителя письма.
		*
		*	@param $To - Адрес получателя письма.
		*
		*	@param $Subject - Тема письма.
		*
		*	@param $Message - Текст сообщения.
		*
		*	@param $Sender - Имя отправителя.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sends email.
		*
		*	@param $From - Email of the sender.
		*
		*	@param $To - Address of the recipient.
		*
		*	@param $Subject - Mail's subject.
		*
		*	@param $Message - Mail's message.
		*
		*	@param $Sender - Sender's name.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			send_email( $From , $To , $Subject , $Message , $Sender = false )
		{
			try
			{
				if( microtime( true ) < $this->LastCallTime + $this->Timeout / 1000000 )
				{
					usleep( $this->LastCallTime + $this->Timeout / 1000000 - microtime( true ) );
				}

				$Subject = $this->compile_string( $Subject );
				$Message = $this->compile_string( $Message );

				$Headers = $this->get_headers( $From , $Sender );

				if( mail( $To , $Subject , $Message , implode( '' , $Headers ) ) === false )
				{
					throw( new Exception( 'An error occured while sending email' ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>