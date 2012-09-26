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
	class	user_manager_1_0_0{

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
		var					$PageComposer = false;
		var					$PermitAlgorithms = false;
		var					$Security = false;
		var					$SecurityUtilities = false;
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
				$this->PageComposer = get_package( 'page::page_composer' , 'last' , __FILE__ );
				$this->PermitAlgorithms = get_package( 'permit::permit_algorithms' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->SecurityUtilities = get_package( 'security::security_utilities' , 'last' , __FILE__ );
				$this->UserAccess = get_package( 'user::user_access' , 'last' , __FILE__ );
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция предгенерационных действий.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method executes before any page generating actions took place.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			pre_generation( &$Options )
		{
			try
			{
				$Lang = get_package( 'lang' , 'last' , __FILE__ );
				$Lang->include_strings_js( 'user::user_manager' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Результат работы функций отображения
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Display function's result.
		*
		*	@author Dodonov A.A.
		*/
		var					$Output = false;

		/**
		*	\~russian Функция проверки введённого пароля.
		*
		*	@param $User - Пользователь.
		*
		*	@return true если проверка пройдена, иначе false.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates account's fields.
		*
		*	@param $User - User.
		*
		*	@return true if the validation was passed, otherwise false.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			validate_account_password( $User )
		{
			try
			{
				if( $this->PermitAlgorithms->object_has_permit( false , 'user' , 'user_manager' ) === false )
				{
					$Password = $this->Security->get_p( 'current_password' , 'string' );
					if( $this->UserAlgorithms->validate_auth( $User->login , $Password ) === false )
					{
						$this->PageComposer->add_error_message( 'illegal_current_password' );
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

		/**
		*	\~russian Функция проверки полей аккаунта.
		*
		*	@param $Options - Настройки.
		*
		*	@return true если проверка пройдена.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates account's fields.
		*
		*	@param $Options - Settings.
		*
		*	@return true if the validation was passed.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			validate_account_fields( $Options )
		{
			try
			{
				$User = $this->UserAccess->select_list( $this->Security->get_p( 'user_record_id' , 'integer_list' ) );
				$User = $User[ 0 ];

				$Email = $this->Security->get_p( 'email' , 'email' );
				if( $User->email != $Email && $this->UserAlgorithms->email_exists( $Email ) )
				{
					$this->PageComposer->add_error_message( 'email_exists' );
					return( false );
				}

				if( $this->validate_account_password( $User ) === false )
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
		*	\~russian Функция проверки удаляемых аккаунтов.
		*
		*	@param $Options - Настройки.
		*
		*	@return true если проверка пройдена.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates deleting accounts.
		*
		*	@param $Options - Settings.
		*
		*	@return true if the validation was passed.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			vaidate_non_system( $Options )
		{
			try
			{
				$ids = $this->SecurityUtilities->get_global( '_id_' , 'integer' , CHECKBOX_IDS );

				if( isset( $ids[ 0 ] ) )
				{
					$ids = implode( ',' , $ids );

					$Users = $this->UserAccess->unsafe_select( $this->UserAccess->NativeTable.
						".id IN( $ids ) AND `system` = 1" );

					if( isset( $Users[ 0 ] ) )
					{
						$PageComposer = get_package( 'page::page_composer' , 'last' , __FILE__ );
						$PageComposer->add_error_message( 'cant_delete_system_users' );

						return( false );
					}

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
		*	\~russian Контроллер компонента.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Controller of the component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			controller( $Options )
		{
			try
			{
				$ContextSet = get_package( 'gui::context_set' , 'last' , __FILE__ );

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
		*	@param $Options - настройки работы модуля.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
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
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( $Options )
		{
			try
			{
				$ContextSet = get_package( 'gui::context_set' , 'last' , __FILE__ );

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