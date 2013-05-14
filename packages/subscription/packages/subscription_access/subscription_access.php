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
	*	\~russian Класс для работы с записями.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides records access routine.
	*
	*	@author Dodonov A.A.
	*/
	class	subscription_access_1_0_0{
	
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
		var					$NativeTable = '`umx_subscription`';
		
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
		var					$Link = false;
		var					$Security = false;
		var					$SecurityParser = false;
		
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
				$this->Link = get_package( 'link' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->SecurityParser = get_package( 'security::security_parser' , 'last' , __FILE__ );
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
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
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
		*	\~russian Выборка записей.
		*
		*	@param $Condition - Условие отбора записей.
		*
		*	@return Массив объектов.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting records.
		*
		*	@param $Condition - Records selection condition.
		*
		*	@return Array of objects.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			unsafe_select( $Condition )
		{
			try
			{
				$this->Database->query_as( DB_OBJECT );
				
				return( 
					$this->Database->select( 
						$this->NativeTable.'.*' , $this->NativeTable , 
						"( $this->AddLimitations ) AND $Condition"
					)
				);
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
					$Start , $Limit , $Field , $Order , $Condition , $this->NativeTable
				);
				
				return( $this->unsafe_select( $Condition ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Удаление записей.
		*
		*	@param $id - Идентификатор записи.
		*
		*	@param $Options - Дополнительные настройки.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Deleting records.
		*
		*	@param $id - Record's identificator.
		*
		*	@param $Options - Additional options.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete( $id , $Options = ' 1 = 1' )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer_list' );

				$this->Database->delete( $this->NativeTable , "( $this->AddLimitations ) AND id IN ( $id )" );

				$this->Database->commit();
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
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Creating record.
		*
		*	@param $Record Example for creation.
		*
		*	@return id of the created record.
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
					$Record , 'title:string;description:string,allow_not_set;email_template:string,allow_not_set'
				);

				list( $Fields , $Values ) = $this->DatabaseAlgorithms->compile_fields_values( $Record );

				$id = $this->DatabaseAlgorithms->create( $this->NativeTable , $Fields , $Values );

				$EventManager = get_package( 'event_manager' , 'last' , __FILE__ );
				$EventManager->trigger_event( 'on_after_create_subscription' , array( 'id' => $id ) );

				return( $id );
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
		*	@param $Record - Объект по чьему образцу будет редактироваться запись.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
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
		function			update( $id , $Record )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer_list' );
				$Record = $this->SecurityParser->parse_parameters( 
					$Record , 'title:string;description:string;email_template:string' , 'allow_not_set'
				);

				list( $Fields , $Values ) = $this->DatabaseAlgorithms->compile_fields_values( $Record );
				
				if( isset( $Fields[ 0 ] ) )
				{
					$this->Database->update( 
						$this->NativeTable , $Fields , $Values , "( $this->AddLimitations ) AND id IN ( $id )"
					);
					$this->Database->commit();
				}
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

				return( $this->unsafe_select( $this->NativeTable.".id IN ( $id ) ORDER BY id ASC" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Подписать пользователя на рассылку.
		*
		*	@param $UserId - Список идентификаторов пользователей, разделённых запятыми.
		*
		*	@param $SubscriptionId - Список идентификаторов подписок, разделённых запятыми.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function subscribes user.
		*
		*	@param $UserId - Comma separated list of users's id.
		*
		*	@param $SubscriptionId - Comma separated list of record's id.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			subscribe_user( $UserId , $SubscriptionId )
		{
			try
			{
				$UserId = explode( ',' , $this->Security->get( $UserId , 'integer_list' ) );
				$SubscriptionId = explode( ',' , $this->Security->get( $SubscriptionId , 'integer_list' ) );

				foreach( $UserId as $i => $User )
				{
					foreach( $SubscriptionId as $j => $Subscription )
					{
						$this->Link->create_link( $User , $Subscription , 'user' , 'subscription' , true );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Отписать пользователя от рассылки.
		*
		*	@param $UserId - Список идентификаторов пользователей, разделённых запятыми.
		*
		*	@param $SubscriptionId - Список идентификаторов подписок, разделённых запятыми.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function unsubscribes user.
		*
		*	@param $UserId - Comma separated list of users's id.
		*
		*	@param $SubscriptionId - Comma separated list of record's id.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			unsubscribe_user( $UserId , $SubscriptionId )
		{
			try
			{
				$UserId = explode( ',' , $this->Security->get( $UserId , 'integer_list' ) );
				$SubscriptionId = explode( ',' , $this->Security->get( $SubscriptionId , 'integer_list' ) );

				foreach( $UserId as $i => $User )
				{
					foreach( $SubscriptionId as $j => $Subscription )
					{
						$this->Link->delete_link( $User , $Subscription , 'user' , 'subscription' );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение рассылок для пользователя.
		*
		*	@param $UserId - Идентификатор пользователя.
		*
		*	@return Список рассылок.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function unsubscribes user.
		*
		*	@param $UserId - User's id.
		*
		*	@return List of subscriptions.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_subscriptions_for_user( $UserId )
		{
			try
			{
				$UserId = $this->Security->get( $UserId , 'integer' );

				$SubscriptionLinks = $this->Link->get_links( $UserId , false , 'user' , 'subscription' );

				if( isset( $SubscriptionLinks[ 0 ] ) )
				{
					$Subscriptions = implode( ',' , get_field_ex( $SubscriptionLinks , 'object2_id' ) );

					return( $this->unsafe_select( "id IN ( $Subscriptions )" ) );
				}

				return( array() );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>