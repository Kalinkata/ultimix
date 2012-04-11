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
	*	\~russian Класс для работы с приватными сообщениями.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides private messages manipulation routine.
	*
	*	@author Dodonov A.A.
	*/
	class	pmsg_algorithms_1_0_0{
	
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
		var					$PmsgAccess = false;
		var					$Security = false;
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
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->PmsgAccess = get_package( 'pmsg::pmsg_access' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Выборка входящих сообщений.
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
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting incoming messages.
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
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select_incoming_messages( $Start = false , $Limit = false , $Field = false , 
													  $Order = false , $Condition = false )
		{
			try
			{
				$Login = $this->UserAlgorithms->get_login();
				
				return( 
					$this->PmsgAccess->select( 
						$Start , $Limit , $Field , $Order , "( $Condition ) AND recipient LIKE '$Login' AND deleted = 0"
					)
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка исходящих сообщений.
		*
		*	@param $Start - Номер первой записи.
		*
		*	@param $Limit - Ограничение на количество записей
		*
		*	@param $Field - Поле, по которому будет осуществляться сортировка.
		*
		*	@param $Order - Порядок сортировки.
		*
		*	@param $Options - Дополнительные настройки.
		*
		*	@return Список записей.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting outgoing messages.
		*
		*	@param $Start - Number of the first record.
		*
		*	@param $Limit - Count of records limitation.
		*
		*	@param $Field - Field to sort by.
		*
		*	@param $Order - Sorting order.
		*
		*	@param $Options - Additional settings.
		*
		*	@return List of records.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select_outgoing_messages( $Start = false , $Limit = false , $Field = false , 
													  $Order = false , $Options = false )
		{
			try
			{
				$Login = $this->UserAlgorithms->get_login();
				
				return( 
					$this->PmsgAccess->select( 
						$Start , $Limit , $Field , $Order , 
						"author LIKE '$Login' AND NOT ( author LIKE recipient AND deleted IN ( 1 , 2 ) )"
					)
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка исходящих сообщений.
		*
		*	@param $Start - Номер первой записи.
		*
		*	@param $Limit - Ограничение на количество записей
		*
		*	@param $Field - Поле, по которому будет осуществляться сортировка.
		*
		*	@param $Order - Порядок сортировки.
		*
		*	@param $Options - Дополнительные настройки.
		*
		*	@return Список записей.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting outgoing messages.
		*
		*	@param $Start - Number of the first record.
		*
		*	@param $Limit - Count of records limitation.
		*
		*	@param $Field - Field to sort by.
		*
		*	@param $Order - Sorting order.
		*
		*	@param $Options - Additional settings.
		*
		*	@return List of records.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select_deleted_messages( $Start = false , $Limit = false , $Field = false , 
													  $Order = false , $Options = false )
		{
			try
			{
				$Login = $this->UserAlgorithms->get_login();
				
				return( 
					$this->PmsgAccess->select( 
						$Start , $Limit , $Field , $Order , "recipient LIKE '$Login' AND deleted = 1"
					)
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Удаление сообщений.
		*
		*	@param $id - Идентификатор сообщения.
		*
		*	@param $Options - Дополнительные настройки.
		*
		*	@return Массив объектов.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Deleting messages.
		*
		*	@param $id - Message's identificator.
		*
		*	@param $Options - Additional settings.
		*
		*	@return Array of objects.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete_message_for_user( $id , $Options )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer_list' );

				$Login = $this->UserAlgorithms->get_login();
				
				$Messages = $this->PmsgAccess->unsafe_select( "recipient LIKE '$Login' AND id IN ( $id )" );
				
				$id = implode( ',' , get_field_ex( $Messages , 'id' ) );

				$this->PmsgAccess->update( $id , array( 'deleted' => 1 ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Окончательное удаление сообщений.
		*
		*	@param $id - Идентификатор сообщения.
		*
		*	@return Массив объектов.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Final deleting messages.
		*
		*	@param $id - Message's identificator.
		*
		*	@return Array of objects.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			cleanup_message_for_user( $id )
		{
			try
			{
				if( is_array( $id ) )
				{
					$id = $this->Security->get( $id , 'integer' );
					$id = implode( ' , ' , $id );
				}
				else
				{
					$id = $this->Security->get( $id , 'integer_list' );
				}

				$Login = $this->UserAlgorithms->get_login();
				
				$Messages = $this->PmsgAccess->unsafe_select( "recipient LIKE '$Login' AND id IN ( $id )" );
				
				$id = implode( ',' , get_field_ex( $Messages , 'id' ) );

				$this->PmsgAccess->update( $id , array( 'deleted' => 2 ) );
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
		*	@return Идентификатор созданной записи.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Creating record.
		*
		*	@param $Record - Example for creation.
		*
		*	@return id of the created record.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			create( $Record )
		{
			try
			{
				$Login = $this->UserAlgorithms->get_login();
				set_field( $Record , 'author' , $Login );
				
				$AllRecipients = $this->Security->get( get_field( $Record , 'recipient' ) , 'string' );
				$AllRecipients = explode( ',' , $AllRecipients );
				
				foreach( $AllRecipients as $k => $Recipient )
				{
					$Recipient = trim( $Recipient , " \t\r\n," );
					if( $Recipient != '' )
					{
						set_field( $Record , 'recipient' , $Recipient );
						$this->PmsgAccess->create( $Record );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение количества непрочитанных писем.
		*
		*	@return Количество непрочитанных писем.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns count of the not read messages.
		*
		*	@return Count of the not read messages.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_not_read_messages_count()
		{
			try
			{
				$Login = $this->UserAlgorithms->get_login();
				$Count = count( $this->PmsgAccess->unsafe_select( "recipient LIKE '$Login' AND `read` = 0" ) );
				return( $Count );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция возвращает запись по идентификатору.
		*
		*	@param $id - Идентификатор записи.
		*
		*	@return Запись.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns record by it's id.
		*
		*	@param $id - Record's id.
		*
		*	@return Record.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_by_id( $id )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer' );
				
				$Records = $this->unsafe_select( $this->NativeTable.".id = $id" );
				
				if( count( $Records ) == 0 )
				{
					throw( new Exception( 'Record was not found' ) );
				}
				
				return( $Records[ 0 ] );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Отметка о прочтении.
		*
		*	@param $id - Идентификатор записи.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Setting 'read' mark.
		*
		*	@param $id - Record's id.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_read( $id )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer' );
				$Login = $this->UserAlgorithms->get_login();
				
				$Record = $this->PmsgAccess->unsafe_select( "id = $id AND recipient LIKE '$Login'" );
				if( count( $Record ) > 0 )
				{
					$this->PmsgAccess->update( $id , array( '`read`' => 1 ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>