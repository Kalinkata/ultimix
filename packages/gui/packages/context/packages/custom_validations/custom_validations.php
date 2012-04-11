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
	*	\~russian Класс с кастомными проверками.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class with custom validations.
	*
	*	@author Dodonov A.A.
	*/
	class	custom_validations_1_0_0{
	
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
		var					$Messages = false;
		var					$Security = false;
		var					$UserAlgorithms = false;
	
		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
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
				$this->Messages = get_package( 'page::messages' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Кастомная валидация.
		*
		*	@param $Pair - Скрипт валидации.
		*
		*	@return True проверка пройдена, иначе false.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Custom validation.
		*
		*	@param $Pair - Validation script.
		*
		*	@return True if the validation was passed, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			custom_validation_login_exists( $Pair )
		{
			try
			{
				$Result = $this->UserAlgorithms->user_exists( $this->Security->get_gp( $Pair[ 1 ] , 'string' ) );
				
				if( $Result === false )
				{
					$this->Messages->add_error_message( 'user_does_not_exist' );
				}
				
				return( $Result );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Кастомная валидация.
		*
		*	@param $Pair - Скрипт валидации.
		*
		*	@return True проверка пройдена, иначе false.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Custom validation.
		*
		*	@param $Pair - Validation script.
		*
		*	@return True if the validation was passed, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			custom_validation_login_does_not_exist( $Pair )
		{
			try
			{
				$Result = $this->UserAlgorithms->user_exists( $this->Security->get_gp( $Pair[ 1 ] , 'string' ) );
				
				if( $Result !== false )
				{
					$this->Messages->add_error_message( 'user_already_exists' );
				}
				
				return( $Result );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Кастомная валидация.
		*
		*	@param $Pair - Скрипт валидации.
		*
		*	@return True проверка пройдена, иначе false.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Custom validation.
		*
		*	@param $Pair - Validation script.
		*
		*	@return True if the validation was passed, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			custom_validation_page_exists( $Pair )
		{
			try
			{
				$PageAccess = get_package( 'page::page_access' , 'last' , __FILE__ );
				
				if( $PageAccess->get_page_description( $this->Security->get_gp( $Pair[ 1 ] , 'string' ) ) !== false )
				{
					return( true );
				}
				
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Кастомная валидация.
		*
		*	@param $Pair - Скрипт валидации.
		*
		*	@return True проверка пройдена, иначе false.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Custom validation.
		*
		*	@param $Pair - Validation script.
		*
		*	@return True if the validation was passed, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			custom_validation_page_does_not_exist( $Pair )
		{
			try
			{
				$PageAccess = get_package( 'page::page_access' , 'last' , __FILE__ );
				
				if( $PageAccess->get_page_description( $this->Security->get_gp( $Pair[ 1 ] , 'string' ) ) === false )
				{
					return( false );
				}
				
				return( true );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Кастомная валидация.
		*
		*	@param $Pair - Скрипт валидации.
		*
		*	@return True проверка пройдена, иначе false.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Custom validation.
		*
		*	@param $Pair - Validation script.
		*
		*	@return True if the validation was passed, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			custom_validation_captcha( $Pair )
		{
			try
			{
				$Security = get_package( 'security' , 'last' , __FILE__ );
				$Captcha = get_package( 'captcha' , 'last' , __FILE__ );
				
				$Result = $Captcha->validate_captcha( $Security->get_p( 'captcha' , 'command' , rand() ) , $Options );
				
				if( $Result === false )
				{
					$this->Messages->add_error_message( 'captcha_error' );
				}
				
				return( $Result );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Запуск всех проверок.
		*
		*	@param $Pair - Скрипт валидации.
		*
		*	@return True проверка пройдена, иначе false.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Running all validations.
		*
		*	@param $Pair - Validation script.
		*
		*	@return True if the validation was passed, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	validations( $Pair )
		{
			try
			{
				switch( $Pair[ 0 ] )
				{
					case( 'login_exists' ):return( $this->custom_validation_login_exists( $Pair ) );
					case( 'login_does_not_exist' ):return( $this->custom_validation_login_does_not_exist( $Pair ) );
					case( 'page_exists' ):return( $this->custom_validation_page_exists( $Pair ) );
					case( 'page_does_not_exist' ):return( $this->custom_validation_page_does_not_exist( $Pair ) );
					case( 'captcha' ):return( $this->custom_validation_captcha( $Pair ) );
					
					default:throw( new Exception( 'Undefined predicate '.$Pair[ 0 ] ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Общие проверки.
		*
		*	@param $ValidationScript - Скрипт валидации.
		*
		*	@param $Options - Параметры выполнения.
		*
		*	@return True проверка пройдена, иначе false.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Custom validations.
		*
		*	@param $ValidationScript - Validation script.
		*
		*	@param $Options - Execution options.
		*
		*	@return True if the validation was passed, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			custom_validation( $ValidationScript , $Options )
		{
			try
			{
				$ValidationScript = explode( ";" , $ValidationScript );
				
				foreach( $ValidationScript as $vs )
				{
					$Pair = explode( ':' , $vs );

					if( $this->validations( $Pair ) === false )
					{
						return( false );
					}
				}
				
				return( true );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>