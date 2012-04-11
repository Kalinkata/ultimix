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
	class	user_algorithms_1_0_0{
	
		/**
		*	\~russian Объект авторизованного пользователя.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Object od the authorized user.
		*
		*	@author Dodonov A.A.
		*/
		var					$User = false;
		
		/**
		*	\~russian Закэшированные объекты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached objects.
		*
		*	@author Dodonov A.A.
		*/
		var					$Security = false;
		var					$UserAccess = false;
	
		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
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
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->UserAccess = get_package( 'user::user_access' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция возвращает пользователя по идентификатору.
		*
		*	@param $id - Идентфиикатор искомого пользователя.
		*
		*	@return Пользователь.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns user by it's id.
		*
		*	@param $id - Id of the searching user.
		*
		*	@return User object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_by_id( $id )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer' );
				
				$Users = $this->UserAccess->unsafe_select( $this->UserAccess->NativeTable.".id = $id" );

				if( count( $Users ) === 0 || count( $Users ) > 1 )
				{
					throw( new Exception( 'User with id '.$id.' was not found' ) );
				}
				else
				{
					return( $Users[ 0 ] );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция, запускающая сессии.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function starts sessions.
		*
		*	@author Dodonov A.A.
		*/
		function			session_start()
		{
			if( session_id() == '' )
			{
				session_start();
			}
		}
		
		/**
		*	\~russian Функция проверяет залогинен ли пользователь с логином $Login.
		*
		*	@return true если залогинен, false иначе.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates if user with the login $Login is logged in.
		*
		*	@return true if logged in, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			logged_in()
		{
			try
			{
				$this->session_start();
				
				if( isset( $_SESSION[ 'login' ] ) )
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
		*	\~russian Функция получения логина залогинившегося пользователя.
		*
		*	@return логин залогинившегося пользователя, либо false в случае ошибки. guest возвращается, 
		*	если пользователь не залогинен.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns login of the logged in user.
		*
		*	@return Login of the logged in user, if no user is logged in, then "guest" is returned.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.	
		*/
		function			get_login()
		{
			try
			{
				$this->session_start();
				
				if( $this->logged_in() )
				{
					/* залогинен, значит опознаем его */
					return( $_SESSION[ 'login' ] );
				}
				else
				{
					/* не залогинен значит гость */
					return( 'guest' );
				}
				
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения идентификатора залогинившегося пользователя.
		*
		*	@return идентифкатор залогинившегося пользователя.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns id of the logged in user.
		*
		*	@return Id of the logged in user.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.	
		*/
		function			get_id()
		{
			try
			{
				$this->session_start();
				
				if( $this->logged_in() )
				{
					return( $_SESSION[ 'user_id' ] );
				}
				else
				{
					/* guest id will be returned */
					return( $this->UserAccess->GuestUserId );
				}
				
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения объекта залогинившегося пользователя.
		*
		*	@return идентифкатор залогинившегося пользователя.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns object of the logged in user.
		*
		*	@return Id of the logged in user.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.	
		*/
		function			get_user()
		{
			try
			{
				if( $this->User === false )
				{
					$this->User = $this->get_by_id( $this->get_id() );
				}
				
				return( $this->User );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция осуществляет залогиниввание для указанного пользователя.
		*
		*	@param $Login - Логин пользователя, которого логиним.
		*
		*	@param $id - Идентификатор пользователя, которого логиним.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function logins user.
		*
		*	@param $Login - Login of the user to be logged in.
		*
		*	@param $id - id of the user to be logged in.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			login( $Login , $id )
		{
			try
			{
				if( $this->user_active( $Login ) )
				{					
					$this->session_start();
					
					$_SESSION[ 'login' ] = $Login;
					$_SESSION[ 'user_id' ] = $id;
					
					$this->User = false;
				}
				else
				{
					return( false );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция осуществляет отлогиниввание для указанного пользователя.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function logouts user.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			logout()
		{
			try
			{
				$this->session_start();
				
				unset( $_SESSION[ 'login' ] );
				unset( $_SESSION[ 'id' ] );
				
				$this->User = false;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция проверки, активен ли пользователь.
		*
		*	@param $Login - логин удаляемого пользователя.
		*
		*	@return true если пользователь активен, иначе false.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates if user is active.
		*
		*	@param $Login - login of the deleting user.
		*
		*	@return true if the user is active, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			user_active( $Login )
		{
			try
			{				
				$User = $this->UserAccess->get_user( $Login );

				return( $User->active == 'active' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция проверки, забанен ли пользователь.
		*
		*	@param $Login - логин удаляемого пользователя.
		*
		*	@return true если пользователь активен, иначе false.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates if user is banned.
		*
		*	@param $Login - login of the deleting user.
		*
		*	@return true if the user is active, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			user_banned( $Login )
		{
			try
			{				
				$User = $this->UserAccess->get_user( $Login );
				
				return( $User->banned );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция возвращает хэш пароля.
		*
		*	@param $Login - логин удаляемого пользователя.
		*
		*	@return md5 хэш пароля.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns md5 hash of the password.
		*
		*	@param $Login - login of the deleting user.
		*
		*	@return md5 hash of the password.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_password_hash( $Login = false )
		{
			try
			{
				if( $Login === false )
				{
					$Login = $this->get_login();
				}
				
				$User = $this->UserAccess->get_user( $Login );
				
				return( $User->password );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверка а существует ли пользователь.
		*
		*	@param $Login - логин проверяемого пользователя.
		*
		*	@return true если пользователь существует, иначе false.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates user's existance.
		*
		*	@param $Login - login of the validated user.
		*
		*	@return true if user exists, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			user_exists( $Login )
		{
			try
			{
				$Login = $this->Security->get( $Login , 'string' );
				
				$this->UserAccess->get_user( $Login );
				
				return( true );
			}
			catch( Exception $e )
			{
				return( false );
			}
		}
		
		/**
		*	\~russian Функция удаления пользователя.
		*
		*	@param $ids - id удаляемого пользователя.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function deletes user.
		*
		*	@param $ids - id of the deleting user.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete( $ids )
		{
			try
			{
				$ids = $this->Security->get( $ids , 'integer_list' );
				
				$Users = $this->UserAccess->unsafe_select( $this->UserAccess->NativeTable.
					".id IN( $ids ) and `system` = 0" );
				
				$this->UserAccess->delete( implode( ',' , get_field_ex( $Users , 'id' ) ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверка а существует ли email.
		*
		*	@param $Email - email проверяемого пользователя.
		*
		*	@return true если пользователь существует, иначе false.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates email's existance.
		*
		*	@param $Email - Email of the validated user.
		*
		*	@return true if user exists, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			email_exists( $Email )
		{
			try
			{
				$Email = $this->Security->get( $Email , 'email' );
				
				$Records = $this->UserAccess->unsafe_select( "email LIKE '$Email'" );
				
				return( count( $Records ) == 1 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция проверки введенных логина и пароля.
		*
		*	@param $Login - введенный логин.
		*
		*	@param $Password - введенный пароль для пользователя $Login.
		*
		*	@param $HashPassed - true если был передан md5 хэш пароля.
		*
		*	@return false если валидация логина и пароля не прошла. в случае успеха true.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates login and password.
		*
		*	@param $Login - Inputed login.
		*
		*	@param $Password - Inputed password.
		*
		*	@param $HashPassed - true if md5 hash of the password was put in $Password.
		*
		*	@return false if login and password validation was passed.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			validate_auth( $Login , $Password , $HashPassed = false )
		{
			try
			{
				$Login = $this->Security->get( $Login , 'string' );
				$Password = $this->Security->get( $Password , 'string' );
				
				$User = $this->UserAccess->get_user( $Login );
				
				if( $HashPassed )
				{
					return( $Password == get_field( $User , 'password' ) );
				}
				else
				{
					return( md5( $Password ) == get_field( $User , 'password' ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция генерации пароля.
		*
		*	@param $Length - Длина пароля.
		*
		*	@return Пароль.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function generates password.
		*
		*	@param $Length - Password length.
		*
		*	@return Password.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			generate_password( $Length = 10 )
		{
			try
			{
				$Letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
				$c = strlen( $Letters );
				
				$Password = '';
				
				for( $i = 0 ; $i < $Length ; $i++ )
				{
					$Password .= $Letters[ rand( 0 , $c - 1 ) ];
				}
				
				return( $Password );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>