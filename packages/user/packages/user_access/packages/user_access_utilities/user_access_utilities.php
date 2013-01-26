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
	*	\~russian Класс для аутентификации.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class for authentification.
	*
	*	@author Dodonov A.A.
	*/
	class	user_access_utilities_1_0_0{
	
		/**
		*	\~russian Таблица в которой хранятся объекты этой сущности.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Table name in wich objects of this entity are stored.
		*
		*	@author Dodonov A.A.
		*/
		var					$NativeTable = '`umx_user`';
	
		/**
		*	\~russian Идентификатор гостя.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Guest's id.
		*
		*	@author Dodonov A.A.
		*/
		var					$GuestUserId = 2;
	
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
		var					$Database = false;
		var					$DatabaseAlgorithms = false;
		var					$Security = false;
		var					$SecurityParser = false;
		
		/**
		*	\~russian Кэш пользователей.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cache of users.
		*
		*	@author Dodonov A.A.
		*/
		var					$UsersCache = array();
		
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
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->DatabaseAlgorithms = get_package( 'database::database_algorithms' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->SecurityParser = get_package( 'security::security_parser' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Событие.
		*
		*	@param $Login - Логин удаляемого пользователя.
		*
		*	@param $id - id пользователя.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function rises event.
		*
		*	@param $Login - Login of the deleting user.
		*
		*	@param $id - id of the created user.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			rise_create_event( $Login , $id )
		{
			try
			{
				$EventManager = get_package( 'event_manager' , 'last' , __FILE__ );
				$Parameters = array( 'login' => $Login , 'id' => $id );
				$EventManager->trigger_event( 'on_after_create_user' , $Parameters );
				$Parameters = array( 'master_id' => $id , 'master_type' => 'user' );
				$EventManager->trigger_event( 'anonimous' , $Parameters );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Событие.
		*
		*	@param $Login - Логин удаляемого пользователя.
		*
		*	@param $id - id пользователя.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function rises event.
		*
		*	@param $Login - Login of the deleting user.
		*
		*	@param $id - id of the created user.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			rise_activate_event( $Login , $id )
		{
			try
			{
				$EventManager = get_package( 'event_manager' , 'last' , __FILE__ );
				$EventManager->trigger_event( 'on_after_activate_user' , array( 'login' => $Login , 'id' => $id ) );
				$EventManager->trigger_event( 'anonimous' , array( 'master_id' => $id , 'master_type' => 'user' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Событие.
		*
		*	@param $id - id пользователя.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function rises event.
		*
		*	@param $id - id of the created user.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			rise_deactivate_event( $id )
		{
			try
			{
				$EventManager = get_package( 'event_manager' , 'last' , __FILE__ );
				$EventManager->trigger_event( 'on_after_deactivate_user' , array( 'id' => $id ) );
				$EventManager->trigger_event( 'anonimous' , array( 'master_id' => $id , 'master_type' => 'user' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Событие.
		*
		*	@param $id - id пользователя.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function rises event.
		*
		*	@param $id - id of the created user.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			rise_update_event( $id )
		{
			try
			{
				$EventManager = get_package( 'event_manager' , 'last' , __FILE__ );
				$EventManager->trigger_event( 'on_after_update_user' , array( 'id' => $id ) );
				$EventManager->trigger_event( 'anonimous' , array( 'master_id' => $id , 'master_type' => 'user' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение параметров обновления.
		*
		*	@param $Fields - Поля.
		*
		*	@param $Values - Значения.
		*
		*	@param $v - Значение.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns update data.
		*
		*	@param $Fields - Fields.
		*
		*	@param $Values - Values.
		*
		*	@param $v - Value.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	handle_sex_field( &$Fields , &$Values , $v )
		{
			try
			{
				if( $v != 1 && $v != 2 )
				{
					$v = 0;
				}

				$Fields [] = 'sex';
				$Values [] = $v;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение параметров обновления.
		*
		*	@param $Fields - Поля.
		*
		*	@param $Values - Значения.
		*
		*	@param $v - Значение.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns update data.
		*
		*	@param $Fields - Fields.
		*
		*	@param $Values - Values.
		*
		*	@param $v - Value.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	handle_active_field( &$Fields , &$Values , $v )
		{
			try
			{
				if( $v == '1' )
				{
					$Fields [] = 'active';
					$Values [] = "'active'";
				}
				else
				{
					$Fields [] = 'active';
					$Values [] = "'".md5( microtime() )."'";
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение параметров обновления.
		*
		*	@param $Fields - Поля.
		*
		*	@param $Values - Значения.
		*
		*	@param $v - Значение.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns update data.
		*
		*	@param $Fields - Fields.
		*
		*	@param $Values - Values.
		*
		*	@param $v - Value.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	handle_password_field( &$Fields , &$Values , $v )
		{
			try
			{
				if( $v !== '' )
				{
					$Fields [] = 'password';
					$Values [] = "'".md5( $v )."'";
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение параметров обновления.
		*
		*	@param $Record - Объект по чьему образцу будет создаваться запись.
		*
		*	@return array( $Fields , $Values ).
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns update data.
		*
		*	@param $Record - Example for update.
		*
		*	@return array( $Fields , $Values ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			handle_update_record( &$Record )
		{
			try
			{
				$Fields = $Values = array();
				foreach( $Record as $f => $v )
				{
					switch( $f )
					{
						case( 'sex' ):
							$this->UserAccessUtilieis->handle_sex_field( $Fields , $Values , $v );
						break;
						case( 'active' ):
							$this->handle_active_field( $Fields , $Values , $v );
						break;
						case( 'password' ):
							$this->handle_password_field( $Fields , $Values , $v );
						break;
						default:
							$Fields [] = $f;
							$Values [] = "'$v'";
						break;
					}
				}
				return( array( $Fields , $Values ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>