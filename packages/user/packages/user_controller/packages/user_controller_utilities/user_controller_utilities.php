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
	*	\~russian Работа с аккаунтами пользователей.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Working with user's accounts.
	*
	*	@author Dodonov A.A.
	*/
	class	user_controller_utilities_1_0_0{

		/**
		*	\~russian Закешированные пакеты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$Messages = false;
		var					$Security = false;
		var					$UserAccess = false;
		var					$UserAlgorithms = false;

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
				$this->Messages = get_package( 'page::messages' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->UserAccess = get_package( 'user::user_access' , 'last' , __FILE__ );
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка ошибок входа в систему.
		*
		*	@param $UserExists - Существует ли пользователь.
		*
		*	@param $UserActive - Активен ли пользователь.
		*
		*	@param $AuthValid - Правильный логин/пароль.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Errors processing.
		*
		*	@param $UserExists - Does user exist.
		*
		*	@param $UserActive - Is user active.
		*
		*	@param $AuthValid - Correct login/password.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_login_errors( $UserExists , $UserActive , $AuthValid )
		{
			try
			{
				if( $UserExists == false )
				{
					$this->Messages->add_error_message( 'user_does_not_exists' );
				}
				elseif( $UserActive == false )
				{
					$this->Messages->add_error_message( 'registration_was_not_confirmed' );
				}
				elseif( $AuthValid == false )
				{
					$this->Messages->add_error_message( 'authentification_error' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Обработка ошибок регистрации.
		*
		*	@return true/false.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function process registration erroros.
		*
		*	@return true/false.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_register_errors()
		{
			try
			{
				if( $this->UserAlgorithms->user_exists( $this->Security->get_gp( 'login' , 'string' ) ) )
				{
					$this->Messages->add_error_message( 'user_already_exists' );
					return( true );
				}

				if( $this->UserAlgorithms->email_exists( $this->Security->get_gp( 'email' , 'string' ) ) )
				{
					$this->Messages->add_error_message( 'email_already_exists' );
					return( true );
				}
				
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>