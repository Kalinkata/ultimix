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
	*	\~russian Класс для организации многие-ко-многим.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class allows to create many-to-many links.
	*
	*	@author Dodonov A.A.
	*/
	class	link_1_0_0{

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
		var					$LinkDictionary = false;
		var					$Security = false;
		
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
				$this->LinkDictionary = get_package( 'link::link_dictionary' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Создание объекта связи.
		*
		*	@param $Object1Id - Идентификатор первого объекта.
		*
		*	@param $Object2Id - Идентификатор второго объекта.
		*
		*	@param $Object1Type - Тип первого объекта.
		*
		*	@param $Object2Type - Тип второго объекта.
		*
		*	@param $SingleLinkOnly - Только единственная связь возможна.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates link object.
		*
		*	@param $Object1Id - Id of the first object.
		*
		*	@param $Object2Id - Id of the second object.
		*
		*	@param $Object1Type - Type of the first object.
		*
		*	@param $Object2Type - Type of the second object.
		*
		*	@param $SingleLinkOnly - Only one link allowed.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			create_link_object( $Object1Id , $Object2Id , $Object1Type , 
										 $Object2Type , $SingleLinkOnly = false )
		{
			try
			{
				if( $SingleLinkOnly && $this->link_exists( $Object1Id , $Object2Id , $Object1Type , $Object2Type ) )
				{
					return;
				}

				$Object1Id = $this->Security->get( $Object1Id , 'integer' );
				$Object2Id = $this->Security->get( $Object2Id , 'integer' );

				$LinkType = $this->LinkDictionary->get_link_type( $Object1Type , $Object2Type );

				$this->Database->insert( 
					'umx_link' , 'object1_id , object2_id , type' , "$Object1Id , $Object2Id , $LinkType"
				);
				$this->Database->commit();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Создание связи.
		*
		*	@param $Object1Id - Идентификатор первого объекта.
		*
		*	@param $Object2Id - Идентификатор второго объекта.
		*
		*	@param $Object1Type - Тип первого объекта.
		*
		*	@param $Object2Type - Тип второго объекта.
		*
		*	@param $SingleLinkOnly - Только единственная связь возможна.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates link.
		*
		*	@param $Object1Id - Id of the first object.
		*
		*	@param $Object2Id - Id of the second object.
		*
		*	@param $Object1Type - Type of the first object.
		*
		*	@param $Object2Type - Type of the second object.
		*
		*	@param $SingleLinkOnly - Only one link allowed.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			create_link( $Object1Id , $Object2Id , $Object1Type , 
										 $Object2Type , $SingleLinkOnly = false )
		{
			try
			{
				if( is_array( $Object1Id ) )
				{
					foreach( $Object1Id as $k => $o1id )
					{
						$this->create_link( $o1id , $Object2Id , $Object1Type , $Object2Type , $SingleLinkOnly );
					}
				}
				elseif( is_array( $Object2Id ) )
				{
					foreach( $Object2Id as $k => $o2id )
					{
						$this->create_link( $Object1Id , $o2id , $Object1Type , $Object2Type , $SingleLinkOnly );
					}
				}
				else
				{
					$this->create_link_object( 
						$Object1Id , $Object2Id , $Object1Type , $Object2Type , $SingleLinkOnly
					);
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция создания условия отбора записей.
		*
		*	@param $ObjectId - Идентификатор объекта.
		*
		*	@param $FieldName - Название поля, по которому происходит отбор.
		*
		*	@param $Conditions - Уже скомпилированные условия.
		*
		*	@return Новые условия отбора.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates conditions for query.
		*
		*	@param $ObjectId - Object's id.
		*
		*	@param $FieldName - Field name.
		*
		*	@param $Conditions - Conditions.
		*
		*	@return New conditions.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_select_condition( $ObjectId , $FieldName , $Conditions )
		{
			try
			{
				if( $ObjectId !== false )
				{
					if( is_array( $ObjectId ) )
					{
						$ObjectId = implode( ',' , $ObjectId );
					}
					$ObjectId = $this->Security->get( $ObjectId , 'integer_list' );
					$Conditions [] = "$FieldName IN ( $ObjectId )";
				}

				return( $Conditions );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Подготовка условий выборки ссылок.
		*
		*	@param $Object1Id - Идентификатор первого объекта.
		*
		*	@param $Object2Id - Идентификатор второго объекта.
		*
		*	@param $Object1Type - Тип первого объекта.
		*
		*	@param $Object2Type - Тип второго объекта.
		*
		*	@return Условие отбора.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function prepares records fetching conditions.
		*
		*	@param $Object1Id - Id of the first object.
		*
		*	@param $Object2Id - Id of the second object.
		*
		*	@param $Object1Type - Type of the first object.
		*
		*	@param $Object2Type - Type of the second object.
		*
		*	@return Fetching condition.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			prepare_conditions( $Object1Id , $Object2Id , $Object1Type , $Object2Type )
		{
			try
			{
				$Conditions = array();
				$Conditions = $this->compile_select_condition( $Object1Id , 'object1_id' , $Conditions );
				$Conditions = $this->compile_select_condition( $Object2Id , 'object2_id' , $Conditions );

				if( $Object1Type !== false || $Object2Type != false )
				{
					$Types = $this->LinkDictionary->get_link_type( $Object1Type , $Object2Type );
					$Conditions [] = "type IN ( $Types )";
				}

				return( implode( ' AND ' , $Conditions ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка ссылок для объекта.
		*
		*	@param $Object1Id - Идентификатор первого объекта.
		*
		*	@param $Object2Id - Идентификатор второго объекта.
		*
		*	@param $Object1Type - Тип первого объекта.
		*
		*	@param $Object2Type - Тип второго объекта.
		*
		*	@return Список ссылок.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns all links for the object.
		*
		*	@param $Object1Id - Id of the first object.
		*
		*	@param $Object2Id - Id of the second object.
		*
		*	@param $Object1Type - Type of the first object.
		*
		*	@param $Object2Type - Type of the second object.
		*
		*	@return Array of links.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_links( $Object1Id , $Object2Id , $Object1Type , $Object2Type )
		{
			try
			{
				$Conditions = $this->prepare_conditions( $Object1Id , $Object2Id , $Object1Type , $Object2Type );
				$Fields = 'umx_link.* , umx_link_dictionary.object1_type , umx_link_dictionary.object2_type';
				$Conditions = "umx_link.type = umx_link_dictionary.id AND $Conditions";

				return( $this->Database->select( $Fields , 'umx_link , umx_link_dictionary' , $Conditions ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Удаление связи.
		*
		*	@param $Object1Id - Идентификатор первого объекта.
		*
		*	@param $Object2Id - Идентификатор второго объекта.
		*
		*	@param $Object1Type - Тип первого объекта.
		*
		*	@param $Object2Type - Тип второго объекта.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function deletes link.
		*
		*	@param $Object1Id - Id of the first object.
		*
		*	@param $Object2Id - Id of the second object.
		*
		*	@param $Object1Type - Type of the first object.
		*
		*	@param $Object2Type - Type of the second object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete_link( $Object1Id , $Object2Id , $Object1Type , $Object2Type )
		{
			try
			{
				if( $Object1Type === false && $Object2Type === false )
				{
					throw( new Exception( "At least one type must be set" ) );
				}

				$Conditions = $this->prepare_conditions( $Object1Id , $Object2Id , $Object1Type , $Object2Type );

				$this->Database->delete( 'umx_link' , $Conditions );
				$this->Database->commit();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка количество ссылок для объекта.
		*
		*	@param $Object1Id - Идентификатор первого объекта.
		*
		*	@param $Object2Id - Идентификатор второго объекта.
		*
		*	@param $Object1Type - Тип первого объекта.
		*
		*	@param $Object2Type - Тип второго объекта.
		*
		*	@return Список ссылок.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns count of links for the object.
		*
		*	@param $Object1Id - Id of the first object.
		*
		*	@param $Object2Id - Id of the second object.
		*
		*	@param $Object1Type - Type of the first object.
		*
		*	@param $Object2Type - Type of the second object.
		*
		*	@return Array of links.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_links_count( $Object1Id , $Object2Id , $Object1Type , $Object2Type )
		{
			try
			{
				$Conditions = $this->prepare_conditions( $Object1Id , $Object2Id , $Object1Type , $Object2Type );
				$Records = $this->Database->select( 'COUNT( * ) AS links_count' , 'umx_link' , $Conditions );

				return( isset( $Records[ 0 ] ) === false ? 0 : get_field( $Records[ 0 ] , 'links_count' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверка существует ли связь.
		*
		*	@param $Object1Id - Идентификатор первого объекта.
		*
		*	@param $Object2Id - Идентификатор второго объекта.
		*
		*	@param $Object1Type - Тип первого объекта.
		*
		*	@param $Object2Type - Тип второго объекта.
		*
		*	@return true - если связь существует.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates if the link exists.
		*
		*	@param $Object1Id - Id of the first object.
		*
		*	@param $Object2Id - Id of the second object.
		*
		*	@param $Object1Type - Type of the first object.
		*
		*	@param $Object2Type - Type of the second object.
		*
		*	@return true if the link exists.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			link_exists( $Object1Id , $Object2Id , $Object1Type , $Object2Type )
		{
			try
			{
				return( $this->get_links_count( $Object1Id , $Object2Id , $Object1Type , $Object2Type ) > 0 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Обновление ссылок объекта.
		*
		*	@param $Object1Id - Идентификатор первого объекта.
		*
		*	@param $OldObject2Id - Идентификатор второго объекта.
		*
		*	@param $NewObject2Id - Новые идентфикаторы второго объекта.
		*
		*	@param $Object1Type - Тип первого объекта.
		*
		*	@param $Object2Type - Тип второго объекта.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function updates object's links.
		*
		*	@param $Object1Id - Id of the first object.
		*
		*	@param $OldObject2Id - Id of the second object.
		*
		*	@param $NewObject2Id - New id of the second object.
		*
		*	@param $Object1Type - Type of the first object.
		*
		*	@param $Object2Type - Type of the second object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			update_link( $Object1Id , $OldObject2Id , $NewObject2Id , $Object1Type , $Object2Type )
		{
			try
			{
				if( strpos( $Object1Id , ',' ) === true )
				{
					$Object1Id = explode( ',' , $Object1Id );
				}
				else
				{
					$Object1Id = array( $Object1Id );
				}

				foreach( $Object1Id as $k => $id )
				{
					$this->delete_link( $id , $OldObject2Id , $Object1Type , $Object2Type );

					$this->create_link( $id , $NewObject2Id , $Object1Type , $Object2Type );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>