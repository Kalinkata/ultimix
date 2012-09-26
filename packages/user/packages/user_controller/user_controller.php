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
	class	user_controller_1_0_0{

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
		var					$ContextSet = false;
		var					$EventManager = false;
		var					$Messages = false;
		var					$PageComposerUtilities = false;
		var					$Security = false;
		var					$UserAccess = false;
		var					$UserAlgorithms = false;
		var					$UserControllerUtilities = false;

		/**
		*	\~russian Разрешена ли регистрация.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english If the registration exists.
		*
		*	@author Dodonov A.A.
		*/
		var					$EnableRegistration = 1;

		/**
		*	\~russian Необходимо ли подтверждение регистрации.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Registration confirm.
		*
		*	@author Dodonov A.A.
		*/
		var					$RegistrationConfirm = 1;

		/**
		*	\~russian Пройдена ли регистрация.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Was registration passed.
		*
		*	@author Dodonov A.A.
		*/
		var					$RegistrationWasPassed = false;

		/**
		*	\~russian Отправитель в системных увдомлениях.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Sender for all system notifications.
		*
		*	@author Dodonov A.A.
		*/
		var					$EmailSender = 'System';

		/**
		*	\~russian Email отправителя в системных увдомлениях.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Sender's email for all system notifications.
		*
		*	@author Dodonov A.A.
		*/
		var					$SystemEmail = 'ultimix@localhost';

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
				$Settings->load_package_settings( 'page::page_composer' , 'last' , 'cf_site' );
				$this->EnableRegistration = intval( $Settings->get_setting( 'enable_registration' , 1 ) );
				$this->RegistrationConfirm = intval( $Settings->get_setting( 'registration_confirm' , 1 ) );
				$this->EmailSender = $Settings->get_setting( 'email_sender' , $this->EmailSender );
				$this->SystemEmail = $Settings->get_setting( 'system_email' , $this->SystemEmail );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Загрузка стандартных пакетов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads common packages.
		*
		*	@author Dodonov A.A.
		*/
		function			load_common_packages()
		{
			try
			{
				$this->ContextSet = get_package( 'gui::context_set' , 'last' , __FILE__ );
				$this->EventManager = get_package( 'event_manager' , 'last' , __FILE__ );
				$this->Messages = get_package( 'page::messages' , 'last' , __FILE__ );
				$this->PageComposerUtilities = get_package( 'page::page_composer_utilities' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

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
				$this->load_common_packages();

				$this->UserAccess = get_package( 'user::user_access' , 'last' , __FILE__ );
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
				$this->UserControllerUtilities = get_package( 
					'user::user_controller::user_controller_utilities' , 'last' , __FILE__
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Вход в систему.
		*
		*	@param $Login - Логин.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Login.
		*
		*	@param $Login - Login.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			do_login( $Login , &$Options )
		{
			try
			{
				$User = $this->UserAccess->get_user( $Login );

				if( $this->UserAlgorithms->user_banned( $Login ) )
				{
					$this->Messages->add_error_message( 'user_is_banned_to '.$User->banned_to );
					return;
				}

				$id = get_field( $User , 'id' );
				$this->EventManager->trigger_event( 'on_before_login' , array( 'id' => $id ) );
				$this->UserAlgorithms->login( $Login , $id );
				$this->EventManager->trigger_event( 'on_after_login' , array( 'id' => $id ) );

				$this->PageComposerUtilities->redirect_using_map( $Options );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция залогинивания.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function logins user.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			login( &$Options )
		{
			try
			{
				$Login = $this->Security->get_gp( 'login' , 'string' );
				$UserPassword = $this->Security->get_gp( 'password' , 'string' );

				$UserExists = $this->UserAlgorithms->user_exists( $Login );
				$UserActive = $AuthValid = true;

				if( $UserExists )
				{
					if( $UserActive = $this->UserAlgorithms->user_active( $Login ) )
					{
						if( $AuthValid = $this->UserAlgorithms->validate_auth( $Login , $UserPassword ) )
						{
							$this->do_login( $Login , $Options );
						}
					}
				}

				$this->UserControllerUtilities->handle_login_errors( $UserExists , $UserActive , $AuthValid );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отлогинивания.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function logs out user.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			logout( &$Options )
		{
			try
			{
				$this->UserAlgorithms->logout();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция активации пользователя.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function activates user.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			activate_user( &$Options )
		{
			try
			{
				if( $this->EnableRegistration === 1 )
				{
					$Hash = $this->Security->get_gp( 'hash' , 'command' , false );
					if( $Hash !== false )
					{
						$this->UserAccess->activate_user( $Hash );
						$this->Messages->add_success_message( 'user_was_activated' );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция активации пользователя.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function activates user.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			admin_activate_user( &$Options )
		{
			try
			{
				$Ids = $this->Security->get_gp( 'ids' , 'integer' );

				if( is_array( $Ids ) === false )
				{
					$Ids = array( $Ids );
				}

				$this->UserAccess->activate_users( $Ids );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция активации пользователя.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function activates user.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			admin_deactivate_user( &$Options )
		{
			try
			{
				$Ids = $this->Security->get_gp( 'ids' , 'integer' );

				if( is_array( $Ids ) === false )
				{
					$Ids = array( $Ids );
				}

				$this->UserAccess->deactivate_users( $Ids );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция активации пользователя.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function activates user.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			restore_password( &$Options )
		{
			try
			{
				$Login = $this->Security->get_gp( 'rlogin' , 'string' );
				$NewPassword = $this->UserAlgorithms->generate_password();

				$CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$Message = str_replace( 
					'{new_password}' , $NewPassword , 
					$CachedMultyFS->get_template( __FILE__ , 'password_restoration_email.tpl' )
				);

				$this->UserControllerUtilities->send_email( 
					$this->SystemEmail , $this->EmailSender , $Message , 
					'{lang:password_restoration}' , get_field( $this->UserAccess->get_user( $Login ) , 'email' )
				);

				$this->UserAccess->reset_password( $Login , $NewPassword );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Изменение пароля, если необходиимо.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function changes password if necessary.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			try_reset_password()
		{
			try
			{
				$User = $this->UserAlgorithms->get_user();
				$Login = get_field( $User , 'login' );
				$Password = $this->Security->get_gp( 'password' , 'string' );
				$PasswordConfirmation = $this->Security->get_gp( 'password_confirmation' , 'string' );

				if( $Password == $PasswordConfirmation )
				{
					$this->UserAccess->reset_password( $Login , $Password );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение изменённых данных.
		*
		*	@return array( $UserEmail , $Site , $About ) ).
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns data to update.
		*
		*	@return array( $UserEmail , $Site , $About ) ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_update_data()
		{
			try
			{
				$UserEmail = $this->Security->get_gp( 'email' , 'email' );

				$Site = $this->Security->get_gp( 'site' , 'string' , '' );

				$About = $this->Security->get_gp( 'about' , 'string' , '' );

				return( array( $UserEmail , $Site , $About ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Нужно ли менять пароль.
		*
		*	@param $Login - Логин.
		*
		*	@return true/false
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Doest need to change password.
		*
		*	@param $Login - Login.
		*
		*	@return true/false
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	need_reset_password( $Login )
		{
			try
			{
				$PermitAlgorithms = get_package( 'permit::permit_algorithms' , 'last' , __FILE__ );
				$HasPermit = $PermitAlgorithms->object_has_permit( false , 'user' , 'user_manager' );
				$ChangePassword = $HasPermit || ( $this->Security->get_gp( 'current_password' , 'set' ) && 
					strlen( $CurrentPassword = $this->Security->get_gp( 'current_password' , 'string' ) ) && 
					$this->UserAlgorithms->validate_auth( $Login , $CurrentPassword ) );

				return( $ChangePassword );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обновления пользователя.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function updates user.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			update_user( &$Options )
		{
			try
			{
				$User = $this->UserAlgorithms->get_user();

				list( $UserEmail , $Site , $About ) = $this->get_update_data();

				$Record = array( 'email' => $UserEmail , 'site' => $Site , 'about' => $About );
				$this->update( get_field( $User , 'id' ) , $Record );

				$ChangePassword = $this->need_reset_password( $Login );

				if( $ChangePassword )
				{
					$this->try_reset_password();
				}

				$this->Messages->add_success_message( 'user_update_was_completed' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отправки подтверждения регистрации.
		*
		*	@param $ActivationHash - Хэш активации.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function send confirmation.
		*
		*	@param $ActivationHash - Activation hash.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	send_confirmation( $ActivationHash )
		{
			try
			{
				$CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$Message = $CachedMultyFS->get_template( __FILE__ , 'confirm_registration_email.tpl' );
				$Message = str_replace( '{hash}' , $ActivationHash , $Message );

				$this->send_email( $Message , '{lang:registration_confirm}' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Создание пользователя и доступов для него.
		*
		*	@return Хэш активации.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates user and assigns permits for him.
		*
		*	@return Activation hash.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	create_user_object_and_permits()
		{
			try
			{
				$SecurityParser = get_package( 'security::security_parser' , 'last' , __FILE__ );

				$Record = $SecurityParser->parse_http_parameters( 
					'login:string;password:string;email:email;name:string;'.
					'sex:integer;site:string,allow_not_set;about:string,allow_not_set'
				);

				list( $id , $Hash ) = $this->UserAccess->create( $Record );

				$this->UserControllerUtilities->add_default_permits( $id );

				return( $Hash );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отправки подтверждения регистрации, если необходимо.
		*
		*	@param $ActivationHash - Хэш активации.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function send confirmation, if necessary.
		*
		*	@param $ActivationHash - Activation hash.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	send_confirmation_if_necessary( $ActivationHash )
		{
			try
			{
				if( $this->RegistrationConfirm && 
					$this->Security->get_p( 'active_permanently' , 'command' , false ) !== 'on' )
				{
					$this->send_confirmation( $ActivationHash );
				}
				else
				{
					$this->UserAccess->activate_user( $ActivationHash );
					$this->RegistrationConfirm = false;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция регистрации пользователя.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function registers user.

		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	register_do()
		{
			try
			{
				$Hash = $this->create_user_object_and_permits();

				$this->send_confirmation_if_necessary( $Hash );

				$this->RegistrationWasPassed = true;

				$Login = $this->Security->get_gp( 'login' , 'string' );

				$this->EventManager->trigger_event( 'on_after_registration' , array( 'login' => $Login ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция регистрации пользователя.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function registers user.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			registration( &$Options )
		{
			try
			{
				$PermitAlgorithms = get_package( 'permit::permit_algorithms' , 'last' , __FILE__ );
				$HasPermit = $PermitAlgorithms->object_has_permit( false , 'user' , 'user_manager' );

				if( $this->EnableRegistration === 1 || $HasPermit )
				{
					if( $this->UserControllerUtilities->handle_register_errors() )
					{
						return;
					}

					$this->register_do();
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция прикрепления файла к галерее.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function attaches file to the gallery.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_avatar( &$Options )
		{
			try
			{
				$FileInputController = get_package( 'file_input::file_input_controller' , 'last' , __FILE__ );

				if( $FileInputController->UploadedFile )
				{
					$User = $this->UserAlgorithms->get_user();

					$Avatar = get_field( $User , 'avatar' );
					if( $Avatar > 0 )
					{
						$FileInputAccess = get_package( 'file_input::file_input_access' , 'last' , __FILE__ );
						$FileInputAccess->delete( $Avatar );
					}

					$Login = get_field( $User , 'login' );
					$FileId = get_field( $FileInputController->UploadedFile , 'id' );
					$this->UserAccess->set_avatar( $Login , $FileId );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Контроллер компонента.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception -Кидается исключение этого типа с описанием ошибки.
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
		function			controller( &$Options )
		{
			try
			{
				$this->ContextSet->add_contexts( 
					$Options , dirname( __FILE__ ) , $this->UserControllerUtilities->get_configs()
				);

				if( $this->ContextSet->execute( $Options , $this , __FILE__ ) )
				{
					return;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>