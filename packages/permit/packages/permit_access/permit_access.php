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
	class	permit_access_1_0_0{

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
		var					$NativeTable = '`umx_permit`';

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
		var					$CachedMultyFS = false;
		var					$Database = false;
		var					$DatabaseAlgorithms = false;
		var					$Link = false;
		var					$LinkDictionary = false;
		var					$Security = false;
		var					$SecurityParser = false;
		var					$UserAlgorithms = false;

		/**
		*	\~russian Кэш доступов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cache of permits.
		*
		*	@author Dodonov A.A.
		*/
		var					$PermitsCache = array();

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
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->DatabaseAlgorithms = get_package( 'database::database_algorithms' , 'last' , __FILE__ );
				$this->Link = get_package( 'link' , 'last' , __FILE__ );
				$this->LinkDictionary = get_package( 'link::link_dictionary' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->SecurityParser = get_package( 'security::security_parser' , 'last' , __FILE__ );
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
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
		*	\~russian Конструктор.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Constructor.
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
		*	@param $Condition - условие отбора записей.
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
		*	@param $Condition - records selection condition.
		*
		*	@return Array of objects.
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

				$Condition = "( $this->AddLimitations ) AND $Condition";
				$Records = $this->Database->select( '*' , $this->NativeTable , $Condition );

				foreach( $Records as $k => $v )
				{
					$Records[ $k ]->permit = htmlspecialchars_decode( $Records[ $k ]->permit , ENT_QUOTES );
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
		*	@param $Permit - Название доступа.
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
		*	@param $Permit Permit's title.
		*
		*	@return Object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_permit_by_name( $Permit )
		{
			try
			{
				$Permit = $this->Security->get( $Permit , 'command' );

				$Items = $this->unsafe_select( "( $this->AddLimitations ) AND permit LIKE '$Permit'" );

				if( count( $Items ) == 0 )
				{
					throw( new Exception( "Permit $Permit was not found" ) );
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
		function			select( $Start = false , $Limit = false , 
									$Field = false , $Order = false , $Condition = '1 = 1' )
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
		*	@param $Record Example for update.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			create( $Record )
		{
			try
			{
				$Record = $this->SecurityParser->parse_parameters( $Record , 'permit:command;comment:string' );

				list( $Fields , $Values ) = $this->DatabaseAlgorithms->compile_fields_values( $Record );

				$id = $this->DatabaseAlgorithms->create( $this->NativeTable , $Fields , $Values );
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
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Updating record.
		*
		*	@param $id - Comma separated list of record's id.
		*
		*	@param $Record - Example for creation.
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
					$Record , 'permit:command;comment:string' , 'allow_not_set'
				);

				list( $Fields , $Values ) = $this->DatabaseAlgorithms->compile_fields_values( $Record );

				if( isset( $Fields[ 0 ] ) )
				{
					$Condition = "( $this->AddLimitations ) AND id IN ( $id )";

					$this->Database->update( $this->NativeTable , $Fields , $Values , $Condition );

					$this->Database->commit();
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение доступов для объекта.
		*
		*	@param $id - Идентификатор объекта.
		*
		*	@param $Type - Тип объекта.
		*
		*	@param $Default - Дефолтовые доступы.
		*
		*	@note Если по каким-либо причинам не найдено ни одного доступа, 
		*	то считается что объекту установлен доступ $Default.
		*
		*	@return Список доступов, которыми обладает пользователь.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns permits for the object.
		*
		*	@param $id - Object's id.
		*
		*	@param $Type - Object type.
		*
		*	@param $Default - Default permits.
		*
		*	@note If permits were not defined at all, then object has $Default permit.
		*
		*	@return List of permits.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_permits_for_object( $id , $Type , $Default )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer' );
				$Type = $this->Security->get( $Type , 'command' );

				$Links = $this->Link->get_links( $id , false , $Type , 'permit' );

				if( isset( $Links[ 0 ] ) === false )
				{
					return( $Default );
				}
				else
				{
					$ids = get_field_ex( $Links , 'object2_id' );

					$Permits = $this->select_list( implode( ',' , $ids ) );

					return( get_field_ex( $Permits , 'permit' ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение доступов для юзера.
		*
		*	@param $uid - Идентификатор юзера.
		*
		*	@return Список доступов, которыми обладает пользователь.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns permits for the user.
		*
		*	@param $uid - User's id.
		*
		*	@return List of permits.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_permits_for_user_group( $uid )
		{
			try
			{
				$uid = ( $uid === false ) ? $this->UserAlgorithms->get_id() : $this->Security->get( $uid , 'integer' );

				$Type = $this->LinkDictionary->get_link_type( 'user' , 'group' );
				$this->Database->query_as( DB_OBJECT );
				$Items = $this->Database->select( 
					'`umx_group`.id' , '`umx_group` , umx_link' , 
					"umx_group.id = umx_link.object2_id AND umx_link.object1_id = $uid AND type = $Type" 
				);

				$Permits = array();

				foreach( $Items as $i )
				{
					$Permits = array_merge( $Permits , $this->get_permits_for_object( $i->id , 'group' , array() ) );
				}

				return( array_unique( $Permits ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Добавление доступа для объекта.
		*
		*	@param $Permit - Добавляемый доступ.
		*
		*	@param $Object - Объект, к которому добавляется доступ.
		*
		*	@param $ObjectType - Тип объекта, к которому добавляется доступ.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function adds permit for object.
		*
		*	@param $Permit - Permit to add.
		*
		*	@param $Object - Object.
		*
		*	@param $ObjectType - Type of the object (may be menu, user, page).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_permit_for_object( $Permit , $Object , $ObjectType = 'page' )
		{
			try
			{
				$this->PermitsCache = array();

				$Permit = $this->Security->get( $Permit , 'command' );
				$Object = $this->Security->get( $Object , 'string' );
				$ObjectType = $this->Security->get( $ObjectType , 'command' );

				$Permits = array();

				if( $ObjectType == 'user' || $ObjectType == 'group' || $ObjectType == 'page' )
				{
					//TODO: add umx_page table
					$Permit = $this->unsafe_select( "permit LIKE '$Permit'" );
					$Permit = $Permit[ 0 ];
					$this->Link->create_link( $Object , $Permit->id , $ObjectType , 'permit' , true );
					return;
				}

				throw( new Exception( "Undefined \"$ObjectType\"" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Добавление доступа для объекта.
		*
		*	@param $Permit - Добавляемый доступ.
		*
		*	@param $Object - Объект, к которому добавляется доступ.
		*
		*	@param $ObjectType - Тип объекта, к которому добавляется доступ.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function set permit for object.
		*
		*	@param $Permit - Permit to add.
		*
		*	@param $Object - Object.
		*
		*	@param $ObjectType - Type of the object (may be menu, user, page).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_permit_for_object( $Permit , $Object , $ObjectType = 'page' )
		{
			try
			{
				$this->PermitsCache = array();

				$Permit = $this->Security->get( $Permit , 'command' );
				$Permit = $this->unsafe_select( "permit LIKE '$Permit'" );
				if( isset( $Permit[ 0 ] ) === false )
				{
					throw( new Exception( "Permit \"$Permit\" was not found" ) );
				}

				$Permit = $Permit[ 0 ];
				$Object = $this->Security->get( $Object , 'string' );
				$ObjectType = $this->Security->get( $ObjectType , 'command' );

				$this->Link->create_link( $Object , get_field( $Permit , 'id' ) , $ObjectType , 'permit' , true );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Переключение доступа для объекта.
		*
		*	@param $Permit - Переключаемый доступ.
		*
		*	@param $Object - Объект, к которому добавляется доступ.
		*
		*	@param $ObjectType - Тип объекта, к которому добавляется доступ.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function toggles permit for object.
		*
		*	@param $Permit - Permit to toggle.
		*
		*	@param $Object - Object.
		*
		*	@param $ObjectType - Type of the object (may be menu, user, page).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			toggle_permit_for_object( $Permit , $Object , $ObjectType = 'page' )
		{
			try
			{
				$this->PermitsCache = array();

				$Permit = $this->Security->get( $Permit , 'command' );
				$Permit = $this->unsafe_select( "permit LIKE '$Permit'" );
				if( isset( $Permit[ 0 ] ) === false )
				{
					throw( new Exception( "Permit \"$Permit\" was not found" ) );
				}

				$Permit = $Permit[ 0 ];
				$Object = $this->Security->get( $Object , 'string' );
				$ObjectType = $this->Security->get( $ObjectType , 'command' );

				if( is_array( $Object ) === false )
				{
					$Object = array( $Object );
				}

				$this->PermitAccessUtilities->toggle_permits();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Удаление доступа для объекта.
		*
		*	@param $Permit - Добавляемый доступ.
		*
		*	@param $Object - Объект, к которому добавляется доступ.
		*
		*	@param $ObjectType - Тип объекта, к которому добавляется доступ.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function deletes permit for object.
		*
		*	@param $Permit - Permit to delete.
		*
		*	@param $Object - Object.
		*
		*	@param $ObjectType - Type of the object (may be menu, user, page).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete_permit_for_object( $Permit , $Object , $ObjectType = 'page' )
		{
			try
			{
				$this->PermitsCache = array();

				$Permit = $this->Security->get( $Permit , 'command' );
				$Permit = $this->unsafe_select( "permit LIKE '$Permit'" );
				if( isset( $Permit[ 0 ] ) === false )
				{
					throw( new Exception( "Permit \"$Permit\" was not found" ) );
				}

				$Permit = $Permit[ 0 ];
				$Object = $this->Security->get( $Object , 'string' );
				$ObjectType = $this->Security->get( $ObjectType , 'command' );

				$this->Link->delete_link( $Object , get_field( $Permit , 'id' ) , $ObjectType , 'permit' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение доступов для страницы.
		*
		*	@param $Object - Название страницы.
		*
		*	@return Список доступов, которыми должен обладать пользователь для работы со страницей.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns permits for the page.
		*
		*	@param $Object - Page to be accessed.
		*
		*	@return List of permits.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_permits_for_page( $Object )
		{
			try
			{
				$Object = $this->Security->get( $Object , 'string' );

				if(  $this->CachedMultyFS->file_exists( dirname( __FILE__ )."/data/p$Object" ) )
				{
					$Permits = $this->CachedMultyFS->file_get_contents( dirname( __FILE__ )."/data/p$Object" );
					return( explode( ',' , $Permits ) );
				}
				else
				{
					return( array( 'admin' ) );
				}
			}
			catch( Exception $e )
			{
				$Args = func_get_args();_throw_exception_object( __METHOD__ , $Args , $e );
			}
		}
	}

?>