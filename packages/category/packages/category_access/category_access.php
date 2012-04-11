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
	*	\~russian Работа с категориями.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Working with categories.
	*
	*	@author Dodonov A.A.
	*/
	class	category_access_1_0_0{
	
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
		var					$NativeTable = '`umx_category`';
	
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
		*	\~russian Словарь категорий.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Categories dictionary.
		*
		*	@author Dodonov A.A.
		*/
		var					$Dictionary = false;
	
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
				$Script = 'title:string;root_id:integer;direct_category:integer,default_0,allow_not_set;'.
						'mask:integer,default_0,allow_not_set';
				$Record = $this->SecurityParser->parse_parameters( $Record , $Script );
				
				list( $Fields , $Values ) = $this->DatabaseAlgorithms->compile_fields_values( $Record );

				$id = $this->DatabaseAlgorithms->create( $this->NativeTable , $Fields , $Values );
				
				$EventManager = get_package( 'event_manager' , 'last' , __FILE__ );
				$EventManager->trigger_event( 'on_after_create_category' , array( 'id' => $id ) );
				
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
				
				$Script = 'title:string;root_id:integer;direct_category:integer;mask:integer';
				
				$Record = $this->SecurityParser->parse_parameters( $Record , $Script , 'allow_not_set' );

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
		*	\~russian Выборка массива объектов.
		*
		*	@param $id - Список идентификаторов удаляемых данных, разделённых запятыми.
		*
		*	@return Массив записей.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
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
		*	\~russian Удаление записи.
		*
		*	@param $cid - Идентфиикатор записи.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Delete records.
		*
		*	@param $cid - Record's id.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete( $cid )
		{
			try
			{
				$cid = $this->Security->get( $cid , 'integer_list' );
				
				$EventManager = get_package( 'event_manager' , 'last' , __FILE__ );
				$EventManager->trigger_event( 'on_before_delete_category' , array( 'id' => $cid ) );
				
				$this->Database->delete( 'umx_category' , "( $this->AddLimitations ) AND id IN ( $cid )" );
				$this->Database->commit();
				
				$EventManager = get_package( 'event_manager' , 'last' , __FILE__ );
				$EventManager->trigger_event( 'on_after_delete_category' , array( 'id' => $cid ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Перемещение дочерних категорий.
		*
		*	@param $cid - Идентфиикатор записи.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Moving children categories.
		*
		*	@param $cid - Record's id.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			move_up_children_categories( $cid , $NewRootId )
		{
			try
			{
				$cid = $this->Security->get( $cid , 'integer_list' );
				
				$NewRootId = $this->Security->get( $NewRootId , 'integer' );
				
				$Condition = "( $this->AddLimitations ) AND root_id IN ( $cid )";
				
				$this->Database->update( $this->NativeTable , array( 'root_id' ) , array( $NewRootId ) , $Condition );
				
				$this->Database->commit();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Выборка записей.
		*
		*	@param $Condition - Условие отбора.
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
		*	@param $Condition - Selection condition.
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
				
				return( $this->Database->select( '*' , 'umx_category' , "( $this->AddLimitations ) AND $Condition" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Параметры выборки.
		*
		*	@param $Condition - Дополнительные условия отбора записей.
		*
		*	@return Параметры выборки.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Fetch parameters.
		*
		*	@param $Condition - Additional conditions.
		*
		*	@return Fetch parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_fetch_parameters( $Condition )
		{
			try
			{
				$Fields = 'umx_category.id AS cid , umx_category.title AS ctitle , c2.title AS croot_title , '.
							'c3.title AS cdirect_title , umx_category.mask AS cmask , umx_category.category_name '.
							'AS category_name';
							
				$Tables = 'umx_category , umx_category AS c2 , umx_category AS c3';
				
				$Condition = '( ( umx_category.root_id = c2.id AND umx_category.direct_category = c3.id ) OR '.
						"( umx_category.id = c2.id AND c2.id = c3.id AND umx_category.root_id = 0 ) ) AND $Condition";
						
				return( array( $Fields , $Tables , $Condition ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка записей.
		*
		*	@param $Start - Номер первой записи.
		*
		*	@param $Limit - Количество выбираемых записей.
		*
		*	@param $Field - Поле, по которому будет осуществляться сортировка.
		*
		*	@param $Order - Порядок сортировки.
		*
		*	@param $Condition - Дополнительные условия отбора записей.
		*
		*	@return Вектор с массивами.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting all records.
		*
		*	@param $Start - Cursor of the first record.
		*
		*	@param $Limit - Count of the selecting records.
		*
		*	@param $Field - Field to sort by.
		*
		*	@param $Order - Sorting order.
		*
		*	@param $Condition - Additional conditions.
		*
		*	@return Vector of arrays.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select( $Start , $Limit , $Field = false , $Order = false , $Condition = '1 = 1' )
		{
			try
			{
				$Condition = $this->DatabaseAlgorithms->select_condition( 
					$Start , $Limit , $Field , $Order , $Condition , $this->NativeTable
				);
				
				$this->Database->query_as( DB_OBJECT );

				list( $Fields , $Tables , $Condition ) = $this->get_fetch_parameters( $Condition );
				
				return( $this->Database->select( $Fields , $Tables , $Condition ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка идентификатора категории по имени.
		*
		*	@param $Name - Имя категории.
		*
		*	@return Идентификатор.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~russian Function returns nid of the category by it's name.
		*
		*	@param $Name - Name of the category.
		*
		*	@return Id.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_category_id( $Name )
		{
			try
			{
				if( $this->Dictionary === false )
				{
					$this->Dictionary = $this->unsafe_select( 'category_name IS NOT NULL' );
				}
				
				foreach( $this->Dictionary as $k => $v )
				{
					if( get_field( $v , 'category_name' ) == $Name )
					{
						return( get_field( $v , 'id' ) );
					}
				}
				
				throw( new Exception( "Category with name '$Name' was not found" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка дочерних категорий.
		*
		*	@param $Name - Имя категории.
		*
		*	@return Дочерние категории.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns subcategories.
		*
		*	@param $Name - Name of the category.
		*
		*	@return Subcategories.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_children( $id )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer' );
				
				return( $this->unsafe_select( "root_id = $id ORDER BY title" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка дочерних категорий.
		*
		*	@param $Name - Имя категории.
		*
		*	@return Дочерние категории.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns subcategories.
		*
		*	@param $Name - Name of the category.
		*
		*	@return Subcategories.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_children_count( $id )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer' );
				
				return( count( $this->unsafe_select( "root_id = $id ORDER BY title" ) ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка всех потомков.
		*
		*	@param $id - Идентификатор категории.
		*
		*	@return Потомки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns siblings of the element.
		*
		*	@param $id - Id of the category.
		*
		*	@return Siblings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_siblings( $id )
		{
			try
			{
				$ids = $this->Security->get( $id , 'integer' );
				
				$Siblings = array();
				
				while( true )
				{
					$Children = $this->unsafe_select( "root_id IN ( $ids ) ORDER BY title" );
					
					if( isset( $Children[ 0 ] ) )
					{
						$Siblings = array_merge( $Siblings , $Children );
						
						$ids = get_field_ex( $Children , 'id' );
						
						$ids = implode( ',' , $ids );
					}
					else
					{
						return( $Siblings );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка идентификаторов всех потомков.
		*
		*	@param $id - Идентификатор категории.
		*
		*	@return Идентификаторы потомков.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns ids of all siblings.
		*
		*	@param $id - Id of the category.
		*
		*	@return Ids of all siblings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_siblings_ids( $id )
		{
			try
			{
				$ids = $this->Security->get( $id , 'integer' );
				
				$SiblingsIds = array();
				
				while( true )
				{
					$Children = $this->unsafe_select( "root_id IN ( $ids ) ORDER BY title" );
					
					if( isset( $Children[ 0 ] ) )
					{
						$ids = get_field_ex( $Children , 'id' );
						
						$SiblingsIds = array_merge( $SiblingsIds , $ids );
						
						$ids = implode( ',' , $ids );
					}
					else
					{
						return( $SiblingsIds );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка всех дочерних категорий.
		*
		*	@param $id - Идентификатор категории.
		*
		*	@return Дочерние категории.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns all subcategories.
		*
		*	@param $id - id of the category.
		*
		*	@return Subcategories.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select_categories_list( $id )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer' );
				
				return( $this->unsafe_select( "direct_category = $id ORDER BY title" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>