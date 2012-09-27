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
	class	user_markup_1_0_0{

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
		var					$MacroSettings = false;
		var					$PermitAlgorithms = false;
		var					$String = false;
		var					$UserAlgorithms = false;
		var					$UserView = false;

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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->PermitAlgorithms = get_package( 'permit::permit_algorithms' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
				$this->UserView = get_package( 'user::user_view' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
//TODO: fix swotch user button
		/**
		*	\~russian Функция компиляции макроса 'session_login'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'session_login'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_session_login( &$Settings )
		{
			try
			{
				if( $this->UserAlgorithms->logged_in() )
				{
					return( $this->UserAlgorithms->get_login() );
				}

				return( 'public' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции блока 'logged_in'.
		*
		*	@param $Settings - Параметры.
		*
		*	@param $Data - Данные.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles блока 'logged_in'.
		*
		*	@param $Settings - Parameters.
		*
		*	@param $Data - Data.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_auth( &$Settings , $Data )
		{
			try
			{
				$RawSettings = $Settings->get_raw_settings();
				$Flag = array_shift( array_keys( $RawSettings ) );

				$ShowData = ( $Flag == 'logged_in' && $this->UserAlgorithms->logged_in() === true ) || 
							( $Flag == 'guest' && $this->UserAlgorithms->logged_in() === false );

				if( $ShowData )
				{
					return( $Data );
				}

				return( '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'user_id'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'user_id'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_user_id( &$Settings )
		{
			try
			{
				if( $this->UserAlgorithms->logged_in() )
				{
					return( $this->UserAlgorithms->get_id() );
				}

				return( $this->UserAccess->GuestUserId );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка пользователей.
		*
		*	@param $MacroSettings - Параметры выборки.
		*
		*	@return Массив пользователей.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fetches users.
		**
		*	@param $MacroSettings - Fetch settings.
		*
		*	@return Array of users.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	fetch_users( &$MacroSettings )
		{
			try
			{
				$PermitFilter = $MacroSettings->get_setting( 'permit_filter' , false );

				if( $PermitFilter !== false )
				{
					$Users = $this->PermitAlgorithms->get_users_for_permit( $PermitFilter );
				}
				else
				{
					/* all users */
					$Users = $this->PermitAlgorithms->get_users_for_permit( 'registered' );
				}

				return( $Users );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'user_list'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'user_list'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_user_list( &$Settings )
		{
			try
			{
				$Users = $this->fetch_users( $Settings );
				$Name = $Settings->get_setting( 'name' );
				$Field = $Settings->get_setting( 'field' , 'login' );

				$Code = '';
				foreach( $Users as $i => $id )
				{
					$User = $this->UserAlgorithms->get_by_id( $id );
					$Code .= "{checkbox:name=_$Name".get_field( $User , 'id' ).";current_value=on}".
							 get_field( $User , $Field ).
							 $this->CahcedMultyFS->get_template( __FILE__ , 'user_end_line.tpl' );
				}

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'months_on_site'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'months_on_site'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_months_on_site( &$Settings )
		{
			try
			{
				$User = $this->UserAlgorithms->get_by_id( $Settings->get_setting( 'user_id' ) );

				$Code = time() - strtotime( get_field( $User , 'registered' ) );
				$Code = intval( $Code / ( 30 * 24 * 60 * 60 ) );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляции макроса 'user_login'.
		*
		*	@param $Settings - Параметры.
		*
		*	@return Код макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'user_login'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_user_login( &$Settings )
		{
			try
			{
				$User = $this->UserAlgorithms->get_by_id( $Settings->get_setting( 'user_id' ) );

				return( get_field( $User , 'login' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>