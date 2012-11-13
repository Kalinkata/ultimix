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
	*	\~russian Класс для работы с доступами (пока только доступами).
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides routine for permits.
	*
	*	@author Dodonov A.A.
	*/
	class	group_access_1_0_0{
		
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
		var					$NativeTable = '`umx_group`';

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
		var					$LinkDictionary = false;
		var					$Security = false;
		var					$SecurityParser = false;
		var					$UserAccess = false;

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
				$this->LinkDictionary = get_package( 'link::link_dictionary' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->SecurityParser = get_package( 'security::security_parser' , 'last' , __FILE__ );
				$this->UserAccess = get_package( 'user::user_access' , 'last' , __FILE__ );
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

				$Records = $this->Database->select( 
					'*' , $this->NativeTable , "( $this->AddLimitations ) AND $Condition"
				);

				foreach( $Records as $k => $v )
				{
					$Records[ $k ]->title = htmlspecialchars_decode( $Records[ $k ]->title , ENT_QUOTES );
					$Records[ $k ]->comment = htmlspecialchars_decode( $Records[ $k ]->comment , ENT_QUOTES );
				}
				
				return( $Records );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка записи.
		*
		*	@param $Group - Название группы.
		*
		*	@return Объект.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting record.
		*
		*	@param $Group Group's title.
		*
		*	@return Object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_group_by_name( $Group )
		{
			try
			{
				$Group = $this->Security->get( $Group , 'command' );

				$Items = $this->unsafe_select( "( $this->AddLimitations ) AND title LIKE '$Group'" );

				if( isset( $Items[ 0 ] ) === false )
				{
					throw( new Exception( "Group \"$Group\" was not found" ) );
				}

				return( $Items[ 0 ] );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка записи.
		*
		*	@param $id - Идентификатор группы.
		*
		*	@return Объект.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting record.
		*
		*	@param $id - Group's identificator.
		*
		*	@return Object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_group_by_id( $id )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer' );

				$Items = $this->unsafe_select( "id = $id" );

				if( count( $Items ) == 0 )
				{
					throw( new Exception( "Group $id was not found" ) );
				}

				return( $Items[ 0 ] );
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
		*	@param $Order - порядок сортировки.
		*
		*	@param $Condition - Условие отбора записей.
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
		*	@param $Condition - Records selection condition.
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
		*	\~russian Создание записи.
		*
		*	@param $Record - Объект по чьему образцу будет создаваться запись.
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
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			create( $Record )
		{
			try
			{
				$Record = $this->SecurityParser->parse_parameters( $Record , 'title:command;comment:string' );

				list( $Fields , $Values ) = $this->DatabaseAlgorithms->compile_fields_values( $Record );

				$id = $this->DatabaseAlgorithms->create( $this->NativeTable , $Fields , $Values );

				return( $id );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Удаление записи из базы.
		*
		*	@param $id - Список идентификаторов удаляемых данных, разделённых запятыми.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Deleting record from database.
		*
		*	@param $id - Comma separated list of record's id.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete( $id )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer_list' );

				/**	\~russian удаление записи
					\~english deleting record*/
				$Database = get_package( 'database' , 'last' , __FILE__ );
				$this->Database->delete( $this->NativeTable , "( $this->AddLimitations ) AND id IN ( $id )" );
				$this->Database->commit();
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
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
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
		*	\~russian Редактирование записи.
		*
		*	@param $id - Список идентификаторов удаляемых данных, разделённых запятыми.
		*
		*	@param $Record - Объект по чьему образцу будет создаваться запись.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
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
					$Record , 'title:command;comment:string' , 'allow_not_set'
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
		*	\~russian Получение групп для объекта.
		*
		*	@param $Object - Объект, к которому получаются группы.
		*
		*	@param $ObjectType - Тип объекта, к которому получается доступ.
		*
		*	@note Массив групп.
		*
		*	@return Список доступов, которыми должен обладать пользователь для работы с объектом.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns groups for object.
		*
		*	@param $Object - Object to be accessed.
		*
		*	@param $ObjectType - Type of the accessed object (may be menu, user, page).
		*
		*	@note Array of groups.
		*
		*	@return List of permits.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_groups_for_object( $Object , $ObjectType = 'user' )
		{
			try
			{
				$Object = $this->Security->get( $Object , 'integer' );
				$LinkType = $this->LinkDictionary->get_link_type( $ObjectType , 'group' );

				$Items = $this->Database->select( 
					'title' , $this->NativeTable.' , umx_link' , 
					"( $this->AddLimitations ) AND ".$this->NativeTable.
						".id = umx_link.object2_id AND umx_link.object1_id = $Object AND type = $LinkType"
				);

				$Content = array();
				if( count( $Items ) > 0 )
				{
					foreach( $Items as $i )
					{
						$Content [] = $i->title;
					}

					$Content = array_unique( $Content );
				}

				return( $Content );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Добавление групы доступов для объекта.
		*
		*	@param $Group - Название группы.
		*
		*	@param $Object - объект, к которому добавляется доступ.
		*
		*	@param $ObjectType - тип объекта, к которому добавляется группа.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function adds group of permits for object.
		*
		*	@param $Group - Group's title.
		*
		*	@param $Object - Object.
		*
		*	@param $ObjectType - Type of the object (user).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_group_for_object( $Group , $Object , $ObjectType = 'user' )
		{
			try
			{
				$Group = $this->Security->get( $Group , 'command' );
				$Object = $this->Security->get( $Object , 'string' );
				$ObjectType = $this->Security->get( $ObjectType , 'command' );

				$Group = $this->unsafe_select( "( $this->AddLimitations ) AND title LIKE '$Group'" );
				if( isset( $Group[ 0 ] ) )
				{
					$Group = $Group[ 0 ];
					$this->Link->create_link( $Object , get_field( $Group , 'id' ) , $ObjectType , 'group' , true );
				}
				else
				{
					throw( new Exception( "Group \"$Group\" was not found" ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Удаление групы доступов для объекта.
		*
		*	@param $Group - Название группы.
		*
		*	@param $Object - объект, у которого удаляется группа.
		*
		*	@param $ObjectType - тип объекта, к которому добавляется доступ.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function adds group of permits for object.
		*
		*	@param $Group - Group's title.
		*
		*	@param $Object - object.
		*
		*	@param $ObjectType - type of the object (user).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete_group_for_object( $Group , $Object , $ObjectType = 'user' )
		{
			try
			{
				$Object = $this->Security->get( $Object , 'string' );
				$ObjectType = $this->Security->get( $ObjectType , 'command' );

				if( $Group === false )
				{
					$this->Link->delete_link( $Object , false , $ObjectType , 'group' , true );
				}
				else
				{
					$Group = $this->Security->get( $Group , 'command' );
					$Group = $this->unsafe_select( "( $this->AddLimitations ) AND title LIKE '$Group'" );
					if( isset( $Group[ 0 ] ) )
					{
						$this->Link->delete_link( 
							$Object , get_field( $Group[ 0 ] , 'id' ) , $ObjectType , 'group' , true
						);
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Переключение групы доступов для объекта.
		*
		*	@param $Group - Название группы.
		*
		*	@param $Object - объект, к которому добавляется доступ.
		*
		*	@param $ObjectType - тип объекта, к которому добавляется группа.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function toggles group of permits for object.
		*
		*	@param $Group - Group's title.
		*
		*	@param $Object - Object.
		*
		*	@param $ObjectType - Type of the object (user).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			toggle_group_for_object( $Group , $Object , $ObjectType = 'page' )
		{
			try
			{
				$this->PermitsCache = array();

				$Group = $this->get_group_by_name( $Group );

				$Object = $this->Security->get( $Object , 'string' );
				$ObjectType = $this->Security->get( $ObjectType , 'command' );

				if( $this->Link->link_exists( $Object , get_field( $Group , 'id' ) , $ObjectType , 'group' ) )
				{
					$this->Link->delete_link( $Object , get_field( $Group , 'id' ) , $ObjectType , 'group' );
				}
				else
				{
					$this->Link->create_link( $Object , get_field( $Group , 'id' ) , $ObjectType , 'group' , true );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Добавление группы для объекта.
		*
		*	@param $Group - Добавляемая группа.
		*
		*	@param $Object - Объект, к которому добавляется группа.
		*
		*	@param $ObjectType - Тип объекта, к которому добавляется группа.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function set group for object.
		*
		*	@param $Group - Group to add.
		*
		*	@param $Object - Object.
		*
		*	@param $ObjectType - Type of the object (may be menu, user, page).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_group_for_object( $Group , $Object , $ObjectType = 'page' )
		{
			try
			{
				/* dropping local cache */
				$this->PermitsCache = array();

				$Group = $this->Security->get( $Group , 'command' );
				$Group = $this->GroupAccess->unsafe_select( "title LIKE '$Group'" );
				if( isset( $Group[ 0 ] ) === false )
				{
					throw( new Exception( "Group \"$Group\" was not found" ) );
				}

				$Group = $Group[ 0 ];
				$Object = $this->Security->get( $Object , 'string' );
				$ObjectType = $this->Security->get( $ObjectType , 'command' );

				$this->Link->create_link( $Object , get_field( $Group , 'id' ) , $ObjectType , 'group' , true );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>