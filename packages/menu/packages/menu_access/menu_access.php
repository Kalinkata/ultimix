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
	*	\~russian Класс для менюшки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Menu class.
	*
	*	@author Dodonov A.A.
	*/
	class	menu_access_1_0_0{

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
		var					$NativeTable = '`umx_menu`';
		
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
		var					$DatabaseAlgorithms = false;
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
				$this->DatabaseAlgorithms = get_package( 'database::database_algorithms' , 'last' , __FILE__ );
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
		function			unsafe_select( $Condition )
		{
			try
			{
				$Database = get_package( 'database' , 'last' , __FILE__ );
				$Database->query_as( DB_OBJECT );
				
				$Records = $Database->select( '*' , $this->NativeTable , "( $this->AddLimitations ) AND $Condition" );
				
				return( $Records );
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
		function			select( $Start , $Limit , $Field = false , $Order = false , $Condition = '1 = 1' )
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
		*	\~russian Функция возвращает запись по идентификатору.
		*
		*	@param $id - Идентификатор записи.
		*
		*	@return Запись.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
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
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_by_id( $id )
		{
			try
			{
				$Security = get_package( 'security' , 'last' , __FILE__ );
				$id = $Security->get( $id , 'integer' );
				
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
				$Record = $this->SecurityParser->parse_parameters( $Record , 'name:string' );
				
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
		*	\~russian Функция возвращает список меню, зарегистрированых в системе.
		*
		*	@param $Start - Первый номер выбираемой записи.
		*
		*	@param $Limit - Количество выбираемых записей.
		*
		*	@return Список меню, зарегистрированых в системе. 
		*	Данные возвращаются в формате array( 0 => 'номер меню' , 1 => 'имя меню' , 
		*	'menu_file_path' => 'путь к файлу меню' )
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.

		*/
		/**
		*	\~english Function returns list of available menues.
		*
		*	@param $Start - Cursor of the first selected record.
		*
		*	@param $Limit - Count of the selected records.
		*
		*	@return List of registred menues.
		*	Data is returned in next format array( 0 => 'menu number' , 1 => 'menu title' , 
		*	'menu_file_path' => 'path to menu file' )
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_menu_list( $Start , $Limit )
		{
			try
			{
				$Security = get_package( 'security' , 'last' , __FILE__ );
				$Start = $Security->get( $Start , 'integer' );
				$Limit = $Security->get( $Limit , 'integer' );
				
				$Databse = get_package( 'database' , 'last' , __FILE__ );
				$Result = $Databse->select( '*' , 'umx_menu' , "$this->AddLimitations LIMIT $Start , $Limit" );
				foreach( $Result as $i => $r )
				{
					$Result[ $i ] = array_merge( array( 'n' => $i + 1 ) , $Result );
				}
				
				return( $Result );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение элементов меню для $Menu.
		*
		*	@param $Menu - меню, для которого будем показывать список элементов.
		*
		*	@return Список элементов меню.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Getting items for menu.
		*
		*	@param $Menu - Menu locator.
		*
		*	@return List of menu items
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_menu_items( $Menu )
		{
			try
			{
				$Security = get_package( 'security' , 'last' , __FILE__ );
				$Menu = $Security->get( $Menu , 'command' );
				
				$Counter = 0;

				$MenuItemAccess = get_package( 'menu::menu_item_access' , 'last' , __FILE__ );
				$Result = $MenuItemAccess->select( 
					false , false , false , false , "( $this->AddLimitations ) AND menu LIKE '$Menu'"
				);

				return( $Result );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция возвращает меню.
		*
		*	@param $Menu - локатор меню.
		*
		*	@return Описание меню.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns menu description.
		*
		*	@param $Menu - menu's locator.
		*
		*	@return Menu description
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_menu( $Menu )
		{
			try
			{
				$Security = & get_package( 'security' , 'last' , __FILE__ );
				$Menu = $Security->get( $Menu , 'command' );
				
				$Databse = get_package( 'database' , 'last' , __FILE__ );
				$Result = $Databse->select( '*' , 'umx_menu' , "( $this->AddLimitations ) AND name LIKE '$Menu'" );
				if( count( $Result ) !== 1 )
				{
					throw( new Exception( "An error occured while selecting menu" ) );
				}
				else
				{
					return( $Result[ 0 ] );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция изменения меню.
		*
		*	@param $OldMenuLocator - Старый локатор меню.
		*
		*	@param $NewMenuLocator - Новый локатор меню.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function updates menu.
		*
		*	@param $OldMenuLocator - Old menu locator.
		*
		*	@param $NewMenuLocator - New menu locator.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Додонов А.А.
		*/
		function			update_menu( $OldMenuLocator , $NewMenuLocator )
		{
			try
			{
				$Security = get_package( 'security' , 'last' , __FILE__ );
				$OldMenuLocator = $Security->get( $OldMenuLocator , 'command' );
				$NewMenuLocator = $Security->get( $NewMenuLocator , 'command' );
				
				$Databse = get_package( 'database' , 'last' , __FILE__ );
				$Databse->update( 
					'umx_menu' , array( 'name' ) , array( $NewMenuLocator ) , 
					"( $this->AddLimitations ) AND name LIKE '$OldMenuLocator'"
				);
				$Databse->commit();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция удаления меню.
		*
		*	@param $Menu - название удаляемого меню.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function deletes menu.
		*
		*	@param $Menu - Deleting menu locator.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete_menu( $Menu )
		{
			try
			{
				$Security = get_package( 'security' , 'last' , __FILE__ );
				$Menu = $Security->get( $Menu , 'command' );
				
				$Database = get_package( 'database' , 'last' , __FILE__ );
				$Database->delete( 'umx_menu' , "( $this->AddLimitations ) AND name LIKE '$Menu'" );
				$Database->commit();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>