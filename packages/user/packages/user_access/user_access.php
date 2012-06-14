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
	class	user_access_1_0_0{

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
		var					$UserAccessUtilities = false;

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
				$this->UserAccessUtilities = get_package( 
					'user::user_access::user_access_utilities' , 'last' , __FILE__
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Дополнительные ограничения на рабочее множество данных.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~russian Additional limitations of the processing data.
		*
		*	@author Dodonov A.A.
		*/
		var					$AddLimitations = '1 = 1';

		/**
		*	\~russian Установка дополнительных ограничений.
		*
		*	@param $theAddLimitation - Дополнительные ограничения.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets additional limitations.
		*
		*	@param $theAddLimitation - Additional limitations.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_add_limitations( $theAddLimitation )
		{
			try
			{
				if( $this->AddLimitations === '1 = 1' )
				{
					$this->AddLimitations = $theAddLimitation;
				}
				else
				{
					throw( new Exception( '"AddLimitations" was already set' ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка пользователей.
		*
		*	@param $Condition - не используется.
		*
		*	@return Массив объектов.
		*
		*	@note Не безопасное.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting users.
		*
		*	@param $Condition not used.
		*
		*	@return Array of objects.
		*
		*	@note Not safe.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			unsafe_select( $Condition = '1 = 1' )
		{
			try
			{
				$this->Database->query_as( DB_OBJECT );

				return( 
					$this->Database->select( 
						$this->NativeTable.'.* , file_path AS avatar_path , '.
							'IF( banned_to >= NOW() , 1 , 0 ) AS banned' , 
						$this->NativeTable.' , umx_uploaded_file' , 
						"( $this->AddLimitations ) AND umx_uploaded_file.id = ".
							$this->NativeTable.".avatar AND $Condition" 
					)
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция возвращает пользователя по логину.
		*
		*	@param $Login - логин искомого пользователя.
		*
		*	@return Пользователь.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns user by it's login.
		*
		*	@param $Login -Login of the searching user.
		*
		*	@return User object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_user( $Login )
		{
			try
			{
				if( isset( $this->UsersCache[ $Login ] ) )
				{
					return( $this->UsersCache[ $Login ] );
				}

				$Login = $this->Security->get( $Login , 'string' );

				$Users = $this->unsafe_select( "login LIKE '$Login'" );

				if( count( $Users ) === 0 || count( $Users ) > 1 )
				{
					throw( new Exception( 'User with login '.$Login.' was not found' ) );
				}
				else
				{
					$this->UsersCache[ $Login ] = $Users[ 0 ];
					return( $Users[ 0 ] );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция переустанавливает пароль.
		*
		*	@param $Login - Логин.
		*
		*	@param $Password - Новый пароль.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function resets password.
		*
		*	@param $Login - Login.
		*
		*	@param $Password - New password.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			reset_password( $Login , $Password )
		{
			try
			{
				$Login = $this->Security->get( $Login , 'string' );
				$Password = $this->Security->get( $Password , 'string' );

				$Users = $this->unsafe_select( "login LIKE '$Login'" );
				
				$User = $this->get_user( $Login );
				$id = get_field( $User , 'id' );
				$Record = array( 'password' => "md5( '$Password' )" );
				$this->update( $id , $Record );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция установки аватара.
		*
		*	@param $Login - Логин.
		*
		*	@param $ImageId - Идентификатор изображения.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets avatar.
		*
		*	@param $Login - Login.
		*
		*	@param $ImageId - Image id.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_avatar( $Login , $ImageId )
		{
			try
			{
				$Login = $this->Security->get( $Login , 'string' );
				$ImageId = $this->Security->get( $ImageId , 'integer' );

				$User = $this->get_user( $Login );
				$id = get_field( $User , 'id' );
				$Record = array( 'avatar' => "$ImageId" );
				$this->update( $id , $Record );
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
		private function	process_sex_field( &$Fields , &$Values , $v )
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
		private function	process_active_field( &$Fields , &$Values , $v )
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
		private function	process_password_field( &$Fields , &$Values , $v )
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
		private function	process_update_record( &$Record )
		{
			try
			{
				$Fields = array();
				$Values = array();

				foreach( $Record as $f => $v )
				{
					switch( $f )
					{
						case( 'sex' ):$this->process_sex_field( $Fields , $Values , $v );break;
						case( 'active' ):$this->process_active_field( $Fields , $Values , $v );break;
						case( 'password' ):$this->process_password_field( $Fields , $Values , $v );break;
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
		private	function	fetch_update_data( &$Record )
		{
			try
			{
				$Record = $this->SecurityParser->parse_parameters( 
					$Record , 
					'password:string;email:email;active:command;active_to:string;'.
						'banned_to:string;name:string;sex:integer;site:string;about:string' , 
					'allow_not_set'
				);

				list( $Fields , $Values ) = $this->process_update_record( $Record );

				return( array( $Fields , $Values ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Редактирование записи.
		*
		*	@param $id - Список идентификаторов удаляемых данных, разделённых запятыми.
		*
		*	@param $Record - Объект по чьему образцу будет создаваться запись.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Updating record.
		*
		*	@param $id - Comma separated list of record's id.
		*
		*	@param $Record - Example for update.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			update( $id , &$Record )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer_list' );

				list( $Fields , $Values ) = $this->fetch_update_data( $Record );

				if( count( $Fields ) == 0 )
				{
					return;
				}
				$this->EventManager = get_package( 'event_manager' , 'last' , __FILE__ );
				$this->EventManager->trigger_event( 
					'on_before_update_user' , array( 'id' => $id , 'data' => $Record )
				);

				$this->Database->update( 
					$this->NativeTable , $Fields , $Values , "( $this->AddLimitations ) AND id IN ( $id )"
				);
				$this->Database->commit();

				$this->UserAccessUtilities->rise_update_event( $id );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
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
		*	\~english Function deletes user
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

				$this->Database->delete( $this->NativeTable , "( $this->AddLimitations ) AND id IN ( $ids )" );
				$this->Database->commit();

				$Link = get_package( 'link' , 'last' , __FILE__ );
				$Link->delete_link( "$ids" , false , 'user' , 'permit' );
				$Link->delete_link( "$ids" , false , 'user' , 'group' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция активации пользователя.
		*
		*	@param $Hash - Хэш уктивации.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function activates user.
		*
		*	@param $Hash - Activation hash.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			activate_user( $Hash )
		{
			try
			{
				$Hash = $this->Security->get( $Hash , 'command' );

				$Users = $this->unsafe_select( "active LIKE '$Hash'" );

				if( isset( $Users[ 0 ] ) )
				{
					$id = get_field_ex( $Users , 'id' );

					$Record = array( 'active' => '1' );
					$this->update( implode( ',' , $id ) , $Record );

					foreach( $Users as $i => $User )
					{
						$Login = get_field( $User , 'login' );
						$id = get_field( $User , 'id' );
						$this->UserAccessUtilities->rise_activate_event( $Login , $id );
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
		*	@param $id - id пользователя.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function activates user.
		*
		*	@param $id - User's id.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			deactivate_user( $id )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer' );

				$Record = array( 'active' => '0' );
				$this->update( $id , $Record );

				$this->UserAccessUtilities->rise_deactivate_event( $id );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Установка дополнительных полей.
		*
		*	@param $Record - Объект по чьему образцу будет создаваться запись.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Setting extra fields.
		*
		*	@return array( $id , hash ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	set_fields( &$Record )
		{
			try
			{
				$Record = set_field( $Record , 'active' , md5( microtime() ) );
				$Record = set_field( $Record , 'password' , md5( get_field( $Record , 'password' ) ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Создание записи.
		*
		*	@param $Record - Объект по чьему образцу будет создаваться запись.
		*
		*	@return array( $id , hash ).
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Creating record.
		*
		*	@param $Record - Example for creation.
		*
		*	@return array( $id , hash ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			create( $Record )
		{
			try
			{
				$Record = $this->SecurityParser->parse_parameters( 
					$Record , 
					'login:string;password:string;email:email;name:string;sex:integer;site:string;about:string'
				);

				$this->set_fields( $Record );

				list( $Fields , $Values ) = $this->DatabaseAlgorithms->compile_fields_values( $Record );

				$Fields [] = 'registered';
				$Values [] = 'NOW()';

				$id = $this->DatabaseAlgorithms->create( $this->NativeTable , $Fields , $Values );

				$this->UserAccessUtilities->rise_create_event( get_field( $Record , 'login' ) , $id );

				return( array( $id , get_field( $Record , 'active' ) ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка массива объектов.
		*
		*	@param $id - Список идентификаторов удаляемых данных, разделённых запятыми.
		*
		*	@return Массив записей.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function selects list of objects.
		*
		*	@param $id - Comma separated list of record's id.
		*
		*	@return Array of records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select_list( $id )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer_list' );

				return( $this->unsafe_select( $this->NativeTable.".id IN ( $id )" ) );
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
		function			select( $Start = false , $Limit = false , $Field = false , 
																				$Order = false , $Condition = '1 = 1' )
		{
			try
			{
				$Condition = $this->DatabaseAlgorithms->select_condition( 
					$Start , $Limit , $Field , $Order , $Condition
				);

				return( $this->unsafe_select( $Condition ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция изменения пользователя.
		*
		*	@param $Login - логин (не изменяется ни при каких обстоятельствах).
		*
		*	@param $Email - новый email.
		*
		*	@param $Site - Сайт.
		*
		*	@param $About - Информация о себе.
		*
		*	@note Пароль с помощью этой функции изменить нельзя. Для этого нужно использовать reset_password.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function updates user info.
		*
		*	@param $Login - login (login cann not be changed).
		*
		*	@param $Email - new email.
		*
		*	@param $Site - User site.
		*
		*	@param $About - Information about user.
		*
		*	@note Password can not be reset by this method. To do this use reset_password method.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			update_user( $Login , $Email , $Site , $About )
		{
			try
			{
				$User = $this->get_user( $Login );
				$id = get_field( $User , 'id' );
				$Record = array( 'login' => $Login , 'email' => $Email , 'site' => $Site , 'about' => $About );
				
				$this->update( $id , $Record );// TODO remove this function
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка массива объектов.
		*
		*	@return Массив записей.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function selects list of objects.
		*
		*	@return Array of records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			simple_select()
		{
			try
			{
				$Records = $this->unsafe_select( '1 = 1' );
				
				foreach( $Records as $k => $v )
				{
					$Records[ $k ]->title = $v->id ? $v->login : '{lang:not_defined}';
				}
				
				return( $Records );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>