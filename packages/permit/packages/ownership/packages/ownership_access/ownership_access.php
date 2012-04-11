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
	*	\~russian Класс для работы с отношениями владениями.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides routine for ownership relations.
	*
	*	@author Dodonov A.A.
	*/
	class	ownership_access_1_0_0{

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
		var					$Link = false;
		
		/**
		*	\~russian Список владельцев.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english List of owners.
		*
		*	@author Dodonov A.A.
		*/
		var					$Owners = false;
		
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
				$this->Link = get_package( 'link' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Создание отношения владения.
		*
		*	@param $Object1Id - Идентификатор первого объекта.
		*
		*	@param $Object2Id - Идентификатор второго объекта.
		*
		*	@param $Object1Type - Тип первого объекта.
		*
		*	@param $Object2Type - Тип второго объекта.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Creation of the relationship.
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
		function			add_owner( $Object1Id , $Object2Id , $Object1Type , $Object2Type )
		{
			try
			{
				$this->Link->create_link( $Object1Id , $Object2Id , $Object1Type , $Object2Type , true );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Удаление отношения.
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
		*	\~english Function deletes relationship.
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
		function			delete_owner( $Object1Id , $Object2Id , $Object1Type , $Object2Type )
		{
			try
			{
				$this->Link->delete_link( $Object1Id , $Object2Id , $Object1Type , $Object2Type , true );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Регистрация владельца.
		*
		*	@param $OwnerId - Идентификатор владельца.
		*
		*	@param $OwnerType - Тип владельца.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function registers owner.
		*
		*	@param $OwnerId - Id of the owner.
		*
		*	@param $OwnerType - Type of the owner.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			register_owner( $OwnerId , $OwnerType )
		{
			try
			{
				if( $this->Owners === false )
				{
					$this->Owners = array();
				}
				
				foreach( $this->Owners as $i => $Owner )
				{
					if( $Owner[ 'id' ] == $OwnerId && $Owner[ 'type' ] == $OwnerType )
					{
						return;
					}
				}
				
				$this->Owners [] = array( 'id' => $OwnerId , 'type' => $OwnerType );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверка отношения.
		*
		*	@param $ObjectId - Идентификатор объекта.
		*
		*	@param $ObjectType - Тип объекта.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates relationship.
		*
		*	@param $ObjectId - Id of the object.
		*
		*	@param $ObjectType - Type of the object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			object_has_owner( $ObjectId , $ObjectType )
		{
			try
			{
				if( $this->Owners === false )
				{
					throw( new Exception( "No owners were registered" ) );
				}
				
				foreach( $this->Owners as $i => $Owner )
				{
					if( $this->Link->link_exists( $Owner[ 'id' ] , $ObjectId , $Owner[ 'type' ] , $ObjectType ) )
					{
						return( true );
					}
				}
				
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверка налиция владельца.
		*
		*	@param $ObjectId - Идентификатор объекта.
		*
		*	@param $ObjectType - Тип объекта.
		*
		*	@return true если владелец был зарегистрирован.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates owner existence.
		*
		*	@param $ObjectId - Id of the object.
		*
		*	@param $ObjectType - Type of the object.
		*
		*	@return true if the owner was registered.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			owner_was_registered( $ObjectId , $ObjectType )
		{
			try
			{
				if( $this->Owners === false )
				{
					return( false );
				}
				
				foreach( $this->Owners as $i => $Owner )
				{
					if( $Owner[ 'id' ] == $ObjectId && $Owner[ 'type' ] == $ObjectType )
					{
						return( true );
					}
				}
				
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>