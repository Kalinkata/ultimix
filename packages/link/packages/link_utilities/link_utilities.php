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
	*	\~russian Класс утилит ссылок.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Link utilities.
	*
	*	@author Dodonov A.A.
	*/
	class	link_utilities_1_0_0{
		
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
		var					$Link = false;
		var					$Security = false;
		var					$String = false;
		var					$UserAlgorithms = false;
		
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
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->Link = get_package( 'link' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение зависимых объектов.
		*
		*	@param $MasterId - Идентификатор мастер-объекта.
		*
		*	@param $MasterType - Тип мастер-объекта.
		*
		*	@param $ObjectType - Тип зависимого объекта.
		*
		*	@param $Access - Объект доступа к данным.
		*
		*	@return Массив идентификаторов или объектов.
		*
		*	@note Если ничего не найдено то может вернуть array(0).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns dependent objects.
		*
		*	@param $MasterId - Id of the master-object.
		*
		*	@param $MasterType - Type of the master-object.
		*
		*	@param $ObjectType - Type of the dependent object.
		*
		*	@param $Access - Data acces object.
		*
		*	@return Array of identificators or objects.
		*
		*	@note If no objects were found array(0) may be returned.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_dependent_objects( $MasterId , $MasterType , $ObjectType , &$Access = false )
		{
			try
			{
				$MasterId = $this->Security->get( $MasterId , 'integer' );
				$MasterType = $this->Security->get( $MasterType , 'command' );
				$ids = array( 0 );
				$Links = $this->Link->get_links( $MasterId , false , $MasterType , $ObjectType );
				if( isset( $Links[ 0 ] ) )
				{
					$ids = get_field_ex( $Links , 'object2_id' );
				}
				if( $Access === false )
				{
					return( $ids );
				}
				else
				{
					return( $Access->select_list( implode( ',' , $ids ) ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Существуют ли зависимые объекты.
		*
		*	@param $MasterId - Идентификатор мастер-объекта.
		*
		*	@param $MasterType - Тип мастер-объекта.
		*
		*	@param $ObjectType - Тип зависимого объекта.
		*
		*	@return true если существуют, иначе false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Do dependent objects exist.
		*
		*	@param $MasterId - Id of the master-object.
		*
		*	@param $MasterType - Type of the master-object.
		*
		*	@param $ObjectType - Type of the dependent object.
		*
		*	@return true/false.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			dependent_objects_exist( $MasterId , $MasterType , $ObjectType )
		{
			try
			{
				$MasterId = $this->Security->get( $MasterId , 'integer' );
				$MasterType = $this->Security->get( $MasterType , 'command' );
				
				$ids = $this->get_dependent_objects( $MasterId , $MasterType , $ObjectType );
				
				return( isset( $ids[ 0 ] ) && $ids[ 0 ] );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение мастер-объектов объектов.
		*
		*	@param $ObjectId - Идентификатор зависимого-объекта.
		*
		*	@param $MasterType - Тип мастер-объекта.
		*
		*	@param $ObjectType - Тип зависимого объекта.
		*
		*	@param $Access - Объект доступа к данным.
		*
		*	@return Массив идентификаторов или объектов, или сами объекты.
		*
		*	@note Если ничего не найдено то может вернуть array(0).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns parent objects.
		*
		*	@param $ObjectId - Id of the dependent object.
		*
		*	@param $MasterType - Type of the master-object.
		*
		*	@param $ObjectType - Type of the dependent object.
		*
		*	@param $Access - Data acces object.
		*
		*	@return Array of identificators or objects, or objects themselves.
		*
		*	@note If no objects were found array(0) may be returned.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_master_objects( $ObjectId , $MasterType , $ObjectType , $Access = false )
		{
			try
			{
				$ObjectId = $this->Security->get( $ObjectId , 'integer' );
				$MasterType = $this->Security->get( $MasterType , 'command' );
				
				$ids = array( 0 );
				$Links = $this->Link->get_links( false , $ObjectId , $MasterType , $ObjectType );
				
				if( isset( $Links[ 0 ] ) )
				{
					$ids = get_field_ex( $Links , 'object1_id' );
				}
				
				if( $Access === false )
				{
					return( $ids );
				}
				else
				{
					return( $Access->select_list( implode( ',' , $ids ) ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Существуют ли зависимые объекты.
		*
		*	@param $ObjectId - Идентификатор зависимого-объекта.
		*
		*	@param $MasterType - Тип мастер-объекта.
		*
		*	@param $ObjectType - Тип зависимого объекта.
		*
		*	@return true если существуют, иначе false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Do dependent objects exist.
		*
		*	@param $ObjectId - Id of the dependent-object.
		*
		*	@param $MasterType - Type of the master-object.
		*
		*	@param $ObjectType - Type of the dependent object.
		*
		*	@return true/false.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			master_objects_exists( $ObjectId , $MasterType , $ObjectType )
		{
			try
			{
				$ObjectId = $this->Security->get( $ObjectId , 'integer' );
				$MasterType = $this->Security->get( $MasterType , 'command' );
				
				$ids = $this->get_master_objects( $ObjectId , $MasterType , $ObjectType );
				
				return( isset( $ids[ 0 ] ) && $ids[ 0 ] );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Преобразование параметров мастер-объекта.
		*
		*	@param $MasterId - Идентификатор объекта, к которому прикреплена запись.
		*
		*	@param $MasterType - Тип объекта, к которому прикреплена запись.
		*
		*	@return Преобразованные параметры.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function transforms master object's parameters.
		*
		*	@param $MasterId - Master object's id.
		*
		*	@param $MasterType - Master object's type.
		*
		*	@return Transforned parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			trasform_master_parameters( $MasterId , $MasterType )
		{
			try
			{
				$MasterType = $this->Security->get( $MasterType , 'command' );
				
				if( $MasterId === false && $MasterType == 'user' )
				{
					$MasterId = $this->UserAlgorithms->get_id();
				}
				
				$MasterId = $this->Security->get( $MasterId , 'integer' );
				
				return( array( $MasterId , $MasterType ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка присоединяемых данных.
		*
		*	@param $Object1Type - Тип первого объекта.
		*
		*	@param $Object2Type - Тип второго объекта.
		*
		*	@param $Records - Массив записей, к которым присоединяем данные.
		*
		*	@param $FieldName1 - Название поля.
		*
		*	@param $JoiningTableName - Название присоединяемой таблицы.
		*
		*	@param $FieldName2 - Название поля.
		*
		*	@param $Fields - Список присоединяемых полей.
		*
		*	@return Массив объектов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns joind data.
		*
		*	@param $Object1Type - Type of the first object.
		*
		*	@param $Object2Type - Type of the second object.
		*
		*	@param $Records - Array of records.
		*
		*	@param $FieldName1 - Field's name.
		*
		*	@param $JoiningTableName - Joining table name.
		*
		*	@param $FieldName2 - Field's name.
		*
		*	@param $Fields - List of the joining fields.
		*
		*	@return true List of records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_sub_records( $Object1Type , $Object2Type , &$Records , $FieldName1 , 
									   $JoiningTableName , $FieldName2 , $Fields = '*' )
		{
			try
			{
				if( isset( $Records[ 0 ] ) )
				{
					$LinkType = $this->LinkDictionary->get_link_type( $Object1Type , $Object2Type );
					$Ids = implode_ex( ',' , $Records , $FieldName1 );
					$Fields = "$Fields , umx_link.object1_id AS _record_original_id";
					$Tables = "$JoiningTableName , umx_link";
					$JoinConditions = "umx_link.type $LinkType AND umx_link.object1_id IN ( $Ids ) AND 
						umx_link.object2_id = $JoiningTableName".".$FieldName2";
					return( $this->Database->select( $Fields , $Tables , $JoinConditions ) );
				}
				else
				{
					return( array() );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка дополнительных данных.
		*
		*	@param $Records - Массив записей, к которым присоединяем данные.
		*
		*	@param $FieldName1 - Название первого поля.
		*
		*	@param $FieldName2 - Название второго поля.
		*
		*	@param $JoiningTableName - Присоединяемая таблица.
		*
		*	@param $ExtendingFields - Fields to add.
		*
		*	@param $Condition - Дополнительные условия фильтрации.
		*
		*	@return Массив объектов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fetches additional data.
		*
		*	@param $Records - Array of records to be extended.
		*
		*	@param $FieldName1 - First field name.
		*
		*	@param $FieldName2 - Second field name.
		*
		*	@param $JoiningTableName - Joining table.
		*
		*	@param $ExtendingFields - Fields to add.
		*
		*	@param $Condition - Additional conditions.
		*
		*	@return List of records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_joining_records( &$Records , $FieldName1 , $FieldName2 , $JoiningTableName , 
											$ExtendingFields , $Condition = '1 = 1' )
		{
			try
			{
				if( isset( $Records[ 0 ] ) )
				{
					$Values = implode( ' , ' , array_unique( get_field_ex( $Records , $FieldName1 ) ) );
					$SubRecords = $this->Database->select( 
						"$FieldName2 AS _joining_field , $ExtendingFields" , "$JoiningTableName" , 
						"$FieldName2 IN ( $Values ) AND ( $Condition )"
					);
					return( $SubRecords );
				}
				
				return( array() );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Присоединение данных.
		*
		*	@param $Records - Массив записей, к которым присоединяем данные.
		*
		*	@param $Object1Type - Тип первого объекта.
		*
		*	@param $Object2Type - Тип второго объекта.
		*
		*	@param $FieldName1 - Название поля.
		*
		*	@param $FieldName2 - Название поля.
		*
		*	@param $JoiningTableName - Название присоединяемой таблицы.
		*
		*	@param $JoinName - Название соединения.
		*
		*	@param $Fields - Список присоединяемых полей.
		*
		*	@return Массив объектов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function joins data.
		*
		*	@param $Records - Array of records.
		*
		*	@param $Object1Type - Type of the first object.
		*
		*	@param $Object2Type - Type of the second object.
		*
		*	@param $FieldName1 - Field's name.
		*
		*	@param $FieldName2 - Field's name.
		*
		*	@param $JoiningTableName - Joining table name.
		*
		*	@param $JoinName - Name of he join.
		*
		*	@param $Fields - List of the joining fields.
		*
		*	@return List of records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			join_data( &$Records , $Object1Type , $Object2Type , $FieldName1 , 
									   $FieldName2 , $JoiningTableName , $JoinName , $Fields = '*' )
		{
			try
			{
				$SubRecords = $this->get_sub_records( $Object1Type , $Object2Type , $Records , $FieldName1 , 
									   $JoiningTableName , $FieldName2 );

				foreach( $Records as $k1 => $v1 )
				{
					set_field( $Records[ $k1 ] , $JoinName , array() );
					foreach( $SubRecords as $k2 => $v2 )
					{
						if( get_field( $v1 , $FieldName1 ) == get_field( $v2 , $FieldName2 ) )
						{
							append_to_field( $Records[ $k1 ] , $JoinName , $v2 );
						}
					}
				}

				return( $Records );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Присоединение данных.
		*
		*	@param $Records - Массив записей, к которым присоединяем данные.
		*
		*	@param $FieldName1 - Название первого поля.
		*
		*	@param $FieldName2 - Название второго поля.
		*
		*	@param $JoiningTableName - Присоединяемая таблица.
		*
		*	@param $JoinName - Название соединения.
		*
		*	@param $Fields - Список присоединяемых полей.
		*
		*	@param $Condition - Дополнительные условия фильтрации.
		*
		*	@return Массив объектов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function joins data.
		*
		*	@param $Records - Array of records to be extended.
		*
		*	@param $FieldName1 - First field name.
		*
		*	@param $FieldName2 - Second field name.
		*
		*	@param $JoiningTableName - Joining table.
		*
		*	@param $JoinName - Name of he join.
		*
		*	@param $Fields - List of the joining fields.
		*
		*	@param $Condition - Additional conditions.
		*
		*	@return List of records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			join_single_to_single_data( &$Records , $FieldName1 , 
									$FieldName2 , $JoiningTableName , $JoinName , $Fields = '*' , $Condition = '1 = 1' )
		{
			try
			{
				$SubRecords = $this->get_joining_records( 
					$Records , $FieldName1 , $FieldName2 , $JoiningTableName , $Fields , $Condition
				);
				foreach( $Records as $k1 => $v1 )
				{
					foreach( $SubRecords as $k2 => $v2 )
					{
						if( get_field( $v1 , $FieldName1 ) == get_field( $v2 , '_joining_field' ) )
						{
							if( get_field( $Records[ $k1 ] , $JoinName , false ) !== false )
							{
								throw( new Exception( "The field \"$JoinName\" was already set" ) );
							}
							set_field( $Records[ $k1 ] , $JoinName , remove_fields( $v2 , '_joining_field' ) );
						}
					}
				}
				return( $Records );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверка присоединения данных.
		*
		*	@param $Records - Массив записей, к которым присоединяем данные.
		*
		*	@param $FieldName1 - Название первого поля.
		*
		*	@param $FieldName2 - Название второго поля.
		*
		*	@param $JoiningTableName - Присоединяемая таблица.
		*
		*	@param $JoinName - Название соединения.
		*
		*	@param $Fields - Список присоединяемых полей.
		*
		*	@param $Condition - Дополнительные условия фильтрации.
		*
		*	@return Массив объектов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function joins data.
		*
		*	@param $Records - Array of records to be extended.
		*
		*	@param $FieldName1 - First field name.
		*
		*	@param $FieldName2 - Second field name.
		*
		*	@param $JoiningTableName - Joining table.
		*
		*	@param $JoinName - Name of he join.
		*
		*	@param $Fields - List of the joining fields.
		*
		*	@param $Condition - Additional conditions.
		*
		*	@return List of records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			join_single_to_many_data( &$Records , $FieldName1 , 
									$FieldName2 , $JoiningTableName , $JoinName , $Fields = '*' , $Condition = '1 = 1' )
		{
			try
			{
				$SubRecords = $this->get_joining_records( 
					$Records , $FieldName1 , $FieldName2 , $JoiningTableName , $Fields , $Condition
				);

				foreach( $Records as $k1 => $v1 )
				{
					set_field( $Records[ $k1 ] , $JoinName , array() );
					foreach( $SubRecords as $k2 => $v2 )
					{
						if( get_field( $v1 , $FieldName1 ) == get_field( $v2 , '_joining_field' ) )
						{
							append_to_field( $Records[ $k1 ] , $JoinName , remove_fields( $v2 , '_joining_field' ) );
						}
					}
				}

				return( $Records );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Расширение данных из указанного набора.
		*
		*	@param $Records - Массив записей, к которым присоединяем данные.
		*
		*	@param $FieldName1 - Название первого поля.
		*
		*	@param $FieldName2 - Название второго поля.
		*
		*	@param $JoiningTableName - Присоединяемая таблица.
		*
		*	@param $ExtendingFields - Fields to add.
		*
		*	@param $Condition - Дополнительные условия фильтрации.
		*
		*	@return Массив объектов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function joins data.
		*
		*	@param $Records - Array of records to be extended.
		*
		*	@param $FieldName1 - First field name.
		*
		*	@param $FieldName2 - Second field name.
		*
		*	@param $JoiningTableName - Joining table.
		*
		*	@param $ExtendingFields - Fields to add.
		*
		*	@param $Condition - Additional conditions.
		*
		*	@return List of records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			extend_records( &$Records , $FieldName1 , $FieldName2 , $JoiningTableName , 
											$ExtendingFields , $Condition = '1 = 1' )
		{
			try
			{
				$SubRecords = $this->get_joining_records( 
					$Records , $FieldName1 , $FieldName2 , $JoiningTableName , 
					implode( ' , ' , $ExtendingFields ) , $Condition
				);

				foreach( $Records as $k1 => $v1 )
				{
					foreach( $SubRecords as $k2 => $v2 )
					{
						if( get_field( $v1 , $FieldName1 ) == get_field( $v2 , '_joining_field' ) )
						{
							extend( $Records[ $k1 ] , remove_fields( $v2 , '_joining_field' ) );
						}
					}
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