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
	*	\~russian Работа с алгоритмами.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Working with algorithms.
	*
	*	@author Dodonov A.A.
	*/
	class	category_algorithms_1_0_0{
	
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
		var					$CategoryAccess = false;
		var					$Link = false;
		var					$Security = false;
	
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
				$this->CategoryAccess = get_package( 'category::category_access' , 'last' , __FILE__ );
				
				$this->Link = get_package( 'link' , 'last' , __FILE__ );
				
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция выборки детей.
		*
		*	@param $RootId - Идентифкатор корня поддерева.
		*
		*	@param $AllItems - Все элементы дерева.
		*
		*	@return Список детей.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns children.
		*
		*	@param $RootId - id of the tree's root.
		*
		*	@param $AllItems - All elements of the tree.
		*
		*	@return List of children.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_children( $RootId , &$AllItems )
		{
			try
			{
				$ReturnItems = array();
				
				foreach( $AllItems as $k => $v )
				{
					if( get_field( $v , 'root_id' ) == $RootId )
					{
						$ReturnItems [] = $v;
					}
				}
				
				return( $ReturnItems );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция выборки элементов предыдущих даному.
		*
		*	@param $AllItems - Все элементы дерева.
		*
		*	@param $LeafId - Идентифкатор элемента.
		*
		*	@return Список предков.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns subtree.
		*
		*	@param $AllItems - all elements of the tree.
		*
		*	@param $LeafId - id of the leaf.
		*
		*	@return List of parents.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_previous_items( $AllItems , $LeafId )
		{
			try
			{
				$ReturnItems = array();
				$CurrentId = $LeafId;				
				$ItemFound = false;
				
				do
				{
					$ItemFound = false;
					foreach( $AllItems as $k => $v )
					{
						if( $v->id == $CurrentId )
						{
							$ReturnItems [] = $v;
							$CurrentId = $v->root_id;
							$ItemFound = true;
							break;
						}
					}
				}
				while( $ItemFound );
				
				return( array_reverse( isset( $ReturnItems[ 1 ] ) ? $ReturnItems : array() ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция выборки категорий объекта.
		*
		*	@param $MasterId - Идентификатор объекта, к которому прикреплена запись.
		*
		*	@param $MasterType - Тип объекта, к которому прикреплена запись.
		*
		*	@return Список категорий.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns object's categories.
		*
		*	@param $MasterId - Master object's id.
		*
		*	@param $MasterType - Master object's type.
		*
		*	@return Records.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_object_categories( $MasterId , $MasterType )
		{
			try
			{
				$Links = $this->Link->get_links( $MasterId , false , $MasterType , 'category' );
				
				$CategoryIds = get_field_ex( $Links , 'object2_id' );
				
				if( isset( $CategoryIds[ 0 ] ) )
				{
					$CategoryIds = implode( ',' , $CategoryIds );
					
					return( $this->CategoryAccess->unsafe_select( "id IN ( $CategoryIds )" ) );
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
		*	\~russian Функция возвращает категорию по идентификатору.
		*
		*	@param $id - Идентфиикатор искомой категории.
		*
		*	@return Категория.
		*
		*	@exception Exception - Rидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns category by it's id.
		*
		*	@param $id - Id of the searching category.
		*
		*	@return Category object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_by_id( $id )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer' );
				
				$Users = $this->CategoryAccess->unsafe_select( $this->CategoryAccess->NativeTable.".id = $id" );

				if( count( $Users ) === 0 || count( $Users ) > 1 )
				{
					throw( new Exception( 'Category with id '.$id.' was not found' ) );
				}
				else
				{
					return( $Users[ 0 ] );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверка объекта на существование.
		*
		*	@param $id - Идентификатор записи.
		*
		*	@return true если объект существует.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates object's existense.
		*
		*	@param $id - Record's id.
		*
		*	@return true if the object exists.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			object_exists( $id )
		{
			try
			{
				$id = $this->Security->get( $id , 'integer' );
				
				$Records = $this->CategoryAccess->unsafe_select( $this->CategoryAccess->NativeTable.".id = $id" );
				
				return( count( $Records ) === 1 );
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
				$id = $this->CategoryAccess->create( $Record );
				
				if( get_field( $Record , 'direct_category' , false ) === false )
				{
					$RootId = get_field( $Record , 'root_id' );
					
					if( $this->object_exists( $RootId ) )
					{
						$RootCategory = $this->get_by_id( $RootId );
						$DirectCategory = get_field( $RootCategory , 'direct_category' );
						$this->CategoryAccess->update( $id , array( 'direct_category' => $DirectCategory ) );
					}
				}
				
				return( $id );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Обновление записей.
		*
		*	@param $cid - Идентификаткор записи.
		*
		*	@param $Title - Название категории.
		*
		*	@return Запись.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Updating records.
		*
		*	@param $cid - Record's id.
		*
		*	@param $Title - Category's title.
		*
		*	@return Record.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			update_category_title( $cid , $Title )
		{
			try
			{
				$cid = $this->Security->get( $cid , 'integer' );
				$Title = $this->Security->get( $Title , 'string' );
				
				$this->CategoryAccess->update( $cid , array( 'title' => $Title ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка идентификаторов категорий по их именам.
		*
		*	@param $Names - Имена категорий.
		*
		*	@return Идентификаторы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns ids of the categories by their names.
		*
		*	@param $Names - Names.
		*
		*	@return Ids.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_category_ids( $Names )
		{
			try
			{
				if( $Names == '' )
				{
					return( array() );
				}
				
				if( is_string( $Names ) )
				{
					$Names = explode( ',' , $Names );
				}
				
				$Ids = array();
				
				foreach( $Names as $k => $v )
				{
					$Ids [] = $this->CategoryAccess->get_category_id( $v );
				}
				
				return( $Ids );
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
		function			get_children_by_name( $Name )
		{
			try
			{
				$id = $this->CategoryAccess->get_category_id( $Name );

				return( $this->CategoryAccess->get_children( $id ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка всех дочерних категорий.
		*
		*	@param $Name - Название категории.
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
		*	@param $Name - Name of the category.
		*
		*	@return Subcategories.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select_categories_list_by_name( $Name )
		{
			try
			{
				$id = $this->CategoryAccess->get_category_id( $Name );
				
				return( $this->CategoryAccess->select_categories_list( $id ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>