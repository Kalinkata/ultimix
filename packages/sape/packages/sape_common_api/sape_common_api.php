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
	*	\~russian Класс для работы с рекламной системой Sape.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides integration with the Sape system.
	*
	*	@author Dodonov A.A.
	*/
	class	sape_common_api_1_0_0{

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
		var					$Client = false;
		var					$SapeUtilities = false;
		var					$Security = false;

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
				$this->SapeUtilities = get_package( 'sape::sape_utilities' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Подключение к серверу.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Connection to the server.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			connect()
		{
			try
			{
				$this->Client = get_package_object( 'xml::xml_rpc' , 'last' , __FILE__ );

				$this->Client = $this->Client->get_xml_rpc_client( 'api.sape.ru' , '/xmlrpc/' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Аутентификация в Сапе.
		*
		*	@param $Login - Логин в Сапе.
		*
		*	@param $PasswordHash - md5 хэш пароля.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Authentication.
		*
		*	@param $Login - Sape login.
		*
		*	@param $PasswordHash - md5 hash of the password.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			login( $Login , $PasswordHash )
		{
			try
			{
				$Login = $this->Security->get( $Login , 'string' );
				$PasswordHash = $this->Security->get( $PasswordHash , 'string' );
				
				$Parameters = array(
					new xmlrpcval( $Login , 'string' ) , new xmlrpcval( $PasswordHash , 'string' ) , 
					new xmlrpcval( true , 'boolean' )
				);

				$Response = $this->SapeUtilities->call_method( 
					$this->Client , 'sape.login' , $Parameters , 'Can\'t login to Sape'
				);

				$Cookies = $Response->cookies();

				$this->Client->setcookie( 'SAPE' , $Cookies[ 'SAPE' ][ 'value' ] , $Cookies[ 'SAPE' ][ 'path' ] );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>