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

	// TODO remove unnecessary strings from lang files
	// TODO async login form using AJAX
	// TODO cache all simple_form states
	// TODO add to cache name $_GET $POST parameters

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
	class	user_view_1_0_0{

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
		var					$CachedMultyFS = false;
		var					$ContextSet = false;
		var					$Security = false;
		var					$String = false;
		var					$UserAccess = false;
		var					$UserAlgorithms = false;
		var					$UserController = false;

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
		*	\~russian Использование email'а как логина.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Use email as login.
		*
		*	@author Dodonov A.A.
		*/
		var					$EmailAsLogin = 0;
	
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
				$Settings->load_package_settings( 'user::user_controller' , 'last' , 'cf_user' );
				$this->EnableRegistration = intval( $Settings->get_setting( 'enable_registration' , 1 ) );
				$this->RegistrationConfirm = intval( $Settings->get_setting( 'registration_confirm' , 1 ) );
				$this->EmailAsLogin = intval( $Settings->get_setting( 'email_as_login' , 0 ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->ContextSet = get_package( 'gui::context_set' , 'last' , __FILE__ );;
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->UserAccess = get_package( 'user::user_access' , 'last' , __FILE__ );
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
				$this->UserController = get_package( 'user::user_controller' , 'last' , __FILE__ );

				$this->load_settings();
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
		function			pre_generation( $Options )
		{
			try
			{
				$PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );

				$PackagePath = _get_package_relative_path_ex( 'user::user_view' , '1.0.0::1.0.0' );

				$PageJS->add_javascript( "{http_host}/$PackagePath/include/js/user_view.js" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки формы залогинивания.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method draws login form.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			login_form( $Options )
		{
			try
			{
				$this->Output = $this->CachedMultyFS->get_template( 
					__FILE__ , $this->EmailAsLogin ? 'email_as_login_form.tpl' : 'login_form.tpl'
				);

				if( $this->EnableRegistration === 1 )
				{
					$Code = '&nbsp;{href:page=registration.html;text=registration}';
					$this->Output = str_replace( '{registration_link}' , $Code , $this->Output );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method draws component.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	show_registration_confirm_form()
		{
			try
			{
				if( $this->RegistrationConfirm )
				{
					$this->Output = $this->CachedMultyFS->get_template( __FILE__ , 'confirm_registration.tpl' );
				}
				else
				{
					$this->Output = '{lang:registration_complete}';
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method draws component.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_registration_form()
		{
			try
			{
				$Template = $this->CachedMultyFS->get_template( 
					__FILE__ , $this->EmailAsLogin ? 'email_as_login_registration_form.tpl' : 'registration_form.tpl'
				);

				$Template = $this->String->print_record( $Template , $_POST );

				$this->Output = $Template;
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
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method draws component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			show_registration_form( $Options )
		{
			try
			{
				$PermitAlgorithms = get_package( 'permit::permit_algorithms' , 'last' , __FILE__ );
				$HasUserManagerPermit = $PermitAlgorithms->object_has_permit( false , 'user' , 'user_manager' );
				if( $this->EnableRegistration != 1 && $HasUserManagerPermit == false )
				{
					$this->Output = '{lang:registration_is_disabled}';
					return;
				}

				if( $this->Security->get_gp( 'user_action' ) && $this->UserController->RegistrationWasPassed )
				{
					$this->show_registration_confirm_form();
				}
				else
				{
					$this->compile_registration_form();
				}
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
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method draws component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			short_profile( $Options )
		{
			try
			{
				$UserId = $Options->get_setting( 'user_id' , false );

				$User = $this->UserAlgorithms->get_by_id( $UserId );

				$this->Output = $this->CachedMultyFS->get_template( __FILE__ , 'short_profile.tpl' );

				$this->Output = $this->String->print_record( $this->Output , $User );
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
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method draws component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			full_profile( $Options )
		{
			try
			{
				if( $this->Security->get_gp( 'login' , 'set' ) )
				{
					$UserLogin = $this->Security->get_gp( 'login' , 'string' );
					$User = $this->UserAccess->get_user( $UserLogin );
				}
				else
				{
					$UserId = $this->Security->get_gp( 'user_id' , 'integer' , 0 );
					if( $UserId == 0 )
					{
						$UserId = $this->UserAlgorithms->get_id();
					}

					$User = $this->UserAlgorithms->get_by_id( $UserId );
				}

				$this->Output = $this->CachedMultyFS->get_template( __FILE__ , 'full_profile.tpl' );
				$this->Output = $this->String->print_record( $this->Output , $User );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method draws component.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_update_user_form()
		{
			try
			{
				$Changed = false;
				$this->Output = $this->String->hide_block( 
					$this->Output , 'permit:user_manager' , 'permit:~user_manager' , $Changed
				);

				$User = $this->UserAlgorithms->get_user();
				$ContextSetUtilities = get_package( 'gui::context_set::context_set_utilities' , 'last' , __FILE__ );
				$this->Output = $ContextSetUtilities->set_form_data( $this->Output , $User );
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
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method draws component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			update_user_form( $Options )
		{
			try
			{
				$Path = _get_package_relative_path_ex( 'user::user_manager::user_manager_view' , 'last' );
				$Template = $this->CachedMultyFS->get_template( "$Path/unexisting.php" , 'update_user_form.tpl' );
				
				$User = $this->UserAlgorithms->get_user();
				$this->Output = $this->String->print_record( $Template , $User );
				$this->Output = str_replace( '{prefix}' , 'user' , $this->Output );
				
				$this->compile_update_user_form();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция возвращает список записей.
		*
		*	@param $Start - Номер первой записи.
		*
		*	@param $Limit - Ограничение на количество записей
		*
		*	@param $Field - Поле, по которому будет осуществляться сортировка.
		*
		*	@param $Order - Порядок сортировки.
		*
		*	@param $Condition - Дополнительные условия отбора записей.
		*
		*	@return Список записей.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns list of records.
		*
		*	@param $Start - Number of the first record.
		*
		*	@param $Limit - Count of records limitation.
		*
		*	@param $Field - Field to sort by.
		*
		*	@param $Order - Sorting order.
		*
		*	@param $Condition - Additional conditions.
		*
		*	@return List of records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			selec_users_for_list_view( $Start = false , $Limit = false , $Field = false , 
																				$Order = false , $Condition = '1 = 1' )
		{
			try
			{
				$Condition = '( NOT ( '.$this->UserAccess->NativeTable.".id IN ( 1 , 2 , 3 ) ) ) AND $Condition";
				return( $this->UserAccess->select( $Start , $Limit , $Field , $Order , $Condition ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Список конфигов.
		*
		*	@return Список конфигов.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method retusn a list of configs.
		*
		*	@return A list of configs.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_contexts()
		{
			try
			{
				return(
					array( 
						'cfcxs_user_line' , 'cfcx_login_form' , 'cfcx_logout_form' , 'cfcx_auto_open_login_dialog' , 
						'cfcx_switch_user_form' , 'cfcx_registration_form' , 'cfcx_update_user_form' , 
						'cfcx_short_profile' , 'cfcx_full_profile' , 'cfcx_activate_user_form' , 
						'cfcx_restore_password_form' , 'cfcx_login_button' , 'cfcx_logout_button' , 
						'cfcx_logout_img_button' , 'cfcx_switch_user_button' , 'cfcx_edit_profile_button'
					)
				);
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
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method draws component.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code of the component.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( &$Options )
		{
			try
			{
				$this->ContextSet->add_contexts( $Options , dirname( __FILE__ ) , $this->get_contexts() );

				// TODO login dialog shows 'email' instead of 'login' field

				$this->ContextSet->execute( $Options , $this , __FILE__ );

				return( $this->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>