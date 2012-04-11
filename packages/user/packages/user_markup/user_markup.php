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
				$this->MacroSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
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

		/**
		*	\~russian Функция обработки макроса 'session_login'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'session_login'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_session_login( $Str , $Changed )
		{
			try
			{
				if( $this->UserAlgorithms->logged_in() )
				{
					if( strpos( $Str , '{session_login}' ) !== false )
					{
						$Str = str_replace( '{session_login}' , $this->UserAlgorithms->get_login() , $Str );
						$Changed = true;
					}
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'user_id'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'user_id'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_user_id( $Str , $Changed )
		{
			try
			{
				if( strpos( $Str , '{user_id}' ) !== false )
				{
					$Str = str_replace( '{user_id}' , $this->UserAlgorithms->get_id() , $Str );
					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'auth'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'auth'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_auth( $Str , $Changed )
		{
			try
			{
				$Mode = $this->UserAlgorithms->logged_in() ? 'logged_in' : 'guest';
				$AddMode = $this->UserAlgorithms->logged_in() ? 'guest' : 'logged_in';

				if( $this->String->block_exists( $Str , 'auth:'.$Mode , 'auth:~'.$Mode ) )
				{
					$Str = $this->String->show_block( $Str , 'auth:'.$Mode , 'auth:~'.$Mode , $Changed );
				}

				if( $this->String->block_exists( $Str , 'auth:'.$AddMode , 'auth:~'.$AddMode ) )
				{
					$Str = $this->String->hide_block( $Str , 'auth:'.$AddMode , 'auth:~'.$AddMode , $Changed );
				}

				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция вставки шаблона заместо макроса.
		*
		*	@param $Name - Название макроса.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads template instead of macro.
		*
		*	@param $Name - Macro name.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	insert_template( $Name , $Str , $Changed )
		{
			try
			{
				// TODO move to page::auto_markup
				if( strpos( $Str , '{'.$Name.'}' ) !== false )
				{
					$Template = $this->CachedMultyFS->get_package_template( 'user::user_view' , 'last' , "$Name.tpl" );

					$Str = str_replace( '{'.$Name.'}' , $Template , $Str );

					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки диалога.
		*
		*	@param $Options - Настройки.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes dialog.
		*
		*	@param $Options - Settings.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	process_dialog( &$Options , $Str , $Changed )
		{
			try
			{
				if( strpos( $Str , '{auto_open_login_dialog}' ) !== false )
				{
					$Template = $this->CachedMultyFS->get_package_template( 
						'user::user_view' , 'last' , 'auto_open_login_dialog.tpl'
					);
					$Str = str_replace( '{auto_open_login_dialog}' , $Template , $Str );
					$Changed = true;
				}

				return( array( $Str , $Changed ) );
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
		function			fetch_users( &$MacroSettings )
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
		*	\~russian Компиляция списка пользователей.
		*
		*	@param $MacroSettings - Параметры выборки.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles list of users.
		**
		*	@param $MacroSettings - Fetch settings.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_user_list( &$MacroSettings )
		{
			try
			{
				$Users = $this->fetch_users( $this->MacroSettings );
				$Name = $MacroSettings->get_setting( 'name' );
				$Field = $MacroSettings->get_setting( 'field' , 'login' );

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
		*	\~russian Функция обработки макроса 'user_list'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'user_list'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_user_list( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'user_list' ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );
					
					$Code = $this->compile_user_list( $this->MacroSettings );
					
					$Str = str_replace( "{user_list:$Parameters}" , $Code , $Str );
					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'months_on_site'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'months_on_site'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_months_on_site( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'months_on_site' ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );
					
					$User = $this->UserAlgorithms->get_by_id( $this->MacroSettings->get_setting( 'user_id' ) );
					
					$Code = time() - strtotime( get_field( $User , 'registered' ) );
					$Code = intval( $Code / ( 30 * 24 * 60 * 60 ) );
					
					$Str = str_replace( "{months_on_site:$Parameters}" , $Code , $Str );
					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'user_login'.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return array( Обрабатываемая строка , Была ли строка обработана ).
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'user_login'.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return array( Processed string , Was the string changed ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_user_login( $Str , $Changed )
		{
			try
			{
				$Limitations = array( 'user_id' => TERMINAL_VALUE );
				
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'user_login' , $Limitations ) ; )
				{
					$this->MacroSettings->load_settings( $Parameters );
					
					$User = $this->UserAlgorithms->get_by_id( $this->MacroSettings->get_setting( 'user_id' ) );
					
					$Str = str_replace( "{user_login:$Parameters}" , get_field( $User , 'login' ) , $Str );
					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки строки.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return Обработанная строка.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes string.
		*
		*	@param $Options - Settings.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return Processed string.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	process_complex_macro( $Options , $Str , &$Changed )
		{
			try
			{
				list( $Str , $Changed ) = $this->process_session_login( $Str , $Changed );
				list( $Str , $Changed ) = $this->process_user_list( $Str , $Changed );
				list( $Str , $Changed ) = $this->process_months_on_site( $Str , $Changed );
				list( $Str , $Changed ) = $this->process_user_id( $Str , $Changed );
				list( $Str , $Changed ) = $this->process_auth( $Str , $Changed );
				list( $Str , $Changed ) = $this->process_user_login( $Str , $Changed );

				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки строки.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return Обработанная строка.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes string.
		*
		*	@param $Options - Settings.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return Processed string.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_string( $Options , $Str , &$Changed )
		{
			try
			{
				$Templates = array( 
					'auto_open_login_dialog' , 'logout_button' , 'edit_profile_button' , 
					'logout_img_button' , 'login_img_button' , 'switch_user_button'
				);

				foreach( $Templates as $i => $Template )
				{
					list( $Str , $Changed ) = $this->insert_template( $Template , $Str , $Changed );
				}

				list( $Str , $Changed ) = $this->process_complex_macro( $Options , $Str , $Changed );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>