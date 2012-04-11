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
	*	\~russian Класс для работы с базой данных.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class providees routine for database manipulation.
	*
	*	@author Dodonov A.A.
	*/
	class	mysql_database_1_0_0{
		
		/**
		*	\~russian Объект соединения.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Connection object.
		*
		*	@author Dodonov A.A.
		*/
		var					$Connection = false;
		
		/**
		*	\~russian Список заблокированных таблиц.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english List pf blocked tables.
		*
		*	@author Dodonov A.A.
		*/
		static				$LockedTables = false;
		
		/**
		*	\~russian Режимы блокировок таблиц.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Lock modes.
		*
		*	@author Dodonov A.A.
		*/
		static 				$LockModes = false;
		
		/**
		*	\~russian Режим выборки данных. Либо DB_ASSOC_ARRAY (запись представлена в виде 
		*	ассоциативного массива) либо DB_OBJECT (запись представлена в виде объекта).
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Data querying mode. Either DB_ASSOC_ARRAY (record is reprecented as 
		*	associative array) or DB_OBJECT (record is represented as an object).
		*
		*	@author Dodonov A.A.
		*/
		static 				$QueryMode = DB_ASSOC_ARRAY;
		
		/**
		*	\~russian Параметры подключения к базе.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english DB connection parameters.
		*
		*	@author Dodonov A.A.
		*/
		var					$Host;
		var					$Username;
		var					$Password;
		var					$Database;
		var					$TablenamePrefix;
		
		/**
		*	\~russian Функция коннекта к базе.
		*
		*	@param $ConfigRow - Строка из конфига.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function connects to database.
		*
		*	@param $ConfigRow - String from the config.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			connect( $ConfigRow )
		{
			try
			{
				$Config = explode( "#" , $ConfigRow );
				$this->Host = $Config[ 0 ];
				$this->Username = $Config[ 1 ];
				$this->Password = $Config[ 2 ];
				$this->Database = $Config[ 3 ];
				$this->TablenamePrefix = $Config[ 4 ];
				
				$this->Connection = @new mysqli( $this->Host , $this->Username , $this->Password , $this->Database );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения соединения с базой данных.
		*
		*	@param $ForceReconnect - Принудительное пересоздание коннекта.
		*
		*	@return Объект mysqli.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns database connection.
		*
		*	@param $ForceReconnect - Force reconnect to database.
		*
		*	@return mysqli object.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_connection( $ForceReconnect = false )
		{
			try
			{
				if( $this->Connection === false || $ForceReconnect === true )
				{
					if( $this->Connection !== false )
					{
						$this->Connection->close();
					}
					$DBConfigSet = get_package( 'database::db_config_set' , 'last' , __FILE__ );
					$DBConfigSet->load_config( dirname( __FILE__ ).'/conf/cf_mysql_database' );
					$this->Connection = $DBConfigSet->connect( $this );

					if( mysqli_connect_error() )
					{
						throw( 
							new Exception( 
								'An error occured while setting connection to the database '.mysqli_connect_error()
							)
						);
					}
				}
				return( $this->Connection );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция выполнения запроса.
		*
		*	@param $Query - Строка запроса.
		*
		*	@return Результат запроса
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function executes query.
		*
		*	@param $Query - Query string.
		*
		*	@return Query result.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			query( $Query )
		{
			try
			{
				$this->get_connection();

				$Query = str_replace( 'umx_' , $this->TablenamePrefix , $Query );

				$Result = $this->Connection->query( $Query );

				if( $this->Connection->errno !== 0 )
				{
					throw( new Exception( 'An error occured while query execution '.$this->Connection->error ) );
				}

				return( $Result );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Режим выборки данных из таблицы.
		*
		*	@param $theQueryMode - Либо DB_ASSOC_ARRAY либо DB_OBJECT.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Mode of extracting data from table.
		*
		*	@param $theQueryMode - Either DB_ASSOC_ARRAY or DB_OBJECT.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			query_as( $theQueryMode )
		{
			try
			{
				self::$QueryMode = $theQueryMode;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выполнение запроса к БД.
		*
		*	@param $What - Список выбираемых полей.
		*
		*	@param $Tables - Список таблиц из которых подтягиваются данные.
		*
		*	@param $Condition - Условие отбора записей.
		*
		*	@return Массив результатов.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function executes select query.
		*
		*	@param $What - List of selecting fields.
		*
		*	@param $Tables - List of tables to select data.
		*
		*	@param $Condition - Condition for records filtering.
		*
		*	@return Array of selected records.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select( $What , $Tables , $Condition = '1 = 1' )
		{
			try
			{
				$Result = $this->query( "SELECT $What FROM $Tables WHERE $Condition" );

				return( $this->fetch_results( $Result ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выполнение выборки результатов запроса.
		*
		*	@param $Result - Объект резултата.
		*
		*	@return Массив результатов.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fetches results of the query.
		*
		*	@param $Result - Query result object.
		*
		*	@return Array of selected records.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			fetch_results( $Result )
		{
			try
			{				
				$RetValues = array();
					
				for( $i = 0; $i < $Result->num_rows ; $i++ )
				{
					if( self::$QueryMode == DB_ASSOC_ARRAY )
					{
						$RetValues [] = $Result->fetch_array( MYSQLI_ASSOC );
					}
					elseif( self::$QueryMode == DB_ARRAY )
					{
						$RetValues [] = $Result->fetch_array( MYSQLI_NUM );
					}
					elseif( self::$QueryMode == DB_OBJECT )
					{
						$RetValues [] = $Result->fetch_object();
					}
				}
					
				$Result->close();

				return( $RetValues );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выполнение запроса вставки записи к БД.
		*
		*	@param $Table - Таблица, в которую вставляется запись.
		*
		*	@param $Fields - Список полей, которые будут заполнены при вставке записи.
		*
		*	@param $Values - Значения полей.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Executes insert query.
		*
		*	@param $Table - New record will be inserted in this table.
		*
		*	@param $Fields - List of fields wich will be filled while record insertion.
		*
		*	@param $Values - Field values.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			insert( $Table , $Fields , $Values )
		{
			try
			{
				$this->query( "INSERT INTO $Table ( $Fields ) VALUES ( $Values )" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выполнение запроса удаления записи из БД.
		*
		*	@param $Table - Таблица, из которой удаляется запись.
		*
		*	@param $Condition - Условие отбора записей.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Executes delete query.
		*
		*	@param $Table - Record (or records) will be deleted from this table.
		*
		*	@param $Condition - Record selection condition.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete( $Table , $Condition = '1 = 1' )
		{
			try
			{
				$this->query( "DELETE FROM $Table WHERE $Condition" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выполнение запроса редактирования записи в БД.
		*
		*	@param $Table - Таблица, в которой обновляется запись.
		*
		*	@param $Fields - Список полей, которые будут заполнены при обновлении записи.
		*
		*	@param $Values - Значения полей.
		*
		*	@param $Condition - Условие отбора записей.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Executes update query.
		*
		*	@param $Table - Record (or records) will be updated in this table.
		*
		*	@param $Fields - List of fields wich will be filled while record update.
		*
		*	@param $Values - Field values.
		*
		*	@param $Condition - Record selection condition.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			update( $Table , $Fields , $Values , $Condition = '1 = 1' )
		{
			try
			{
				$SubQuery = '';
				
				for( $i = 0 ; $i < count( $Fields ) - 1 ; $i++ )
				{
					$SubQuery .= $Fields[ $i ].' = '.$Values[ $i ].' , ';
				}
				$SubQuery .= $Fields[ count( $Fields ) - 1 ].' = '.$Values[ count( $Fields ) - 1 ];
				
				$this->query( "UPDATE $Table SET $SubQuery WHERE $Condition" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выполнение запроса создания таблицы в БД.
		*
		*	@param $Table - Создаваемая таблица.
		*
		*	@param $FirstIndexField - Имя поля которое будет индексом. Поле создастся автоматически.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Executes delete query.
		*
		*	@param $Table - Table to create.
		*
		*	@param $FirstIndexField - Index field name.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Додонов А.А.
		*/
		function			create( $Table , $FirstIndexField = 'id' )
		{
			try
			{
				$this->query( 
					"CREATE TABLE `$Table` ( `$FirstIndexField` INTEGER UNSIGNED NOT NULL DEFAULT NULL ".
						"AUTO_INCREMENT , PRIMARY KEY ( `$FirstIndexField` ) )"
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выполнение запроса удаления таблицы в БД.
		*
		*	@param $Table - Удаляемая таблица.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Executes delete table query.
		*
		*	@param $Table - Deleted table.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			drop( $Table )
		{
			try
			{
				$this->query( "DROP TABLE $Table" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выполнение запроса добавления столбца в таблицу.
		*
		*	@param $Table - Таблица, в которую добавляется столбец.
		*
		*	@param $ColumnName - Имя столбца.
		*
		*	@param $Type - Тип столбца.
		*
		*	@param $Mode - Режим добавления столбца.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function inserts column in table.
		*
		*	@param $Table - Name of the editig table (new column will be inserted).
		*
		*	@param $ColumnName - Name of the inserting column.
		*
		*	@param $Type - Type of the column.
		*
		*	@param $Mode - Column insertion mode.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_column( $Table , $ColumnName , $Type , $Mode = 'NOT NULL AFTER `id`' )
		{
			try
			{
				$this->query( "ALTER TABLE `$Table` ADD COLUMN `$ColumnName` $Type $Mode" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выполнение запроса удаления столбца из таблицы.
		*
		*	@param $Table - Таблица, из которой удаляется столбец.
		*
		*	@param $ColumnName - Имя удаляемого столбца.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function deletes column from table.
		*
		*	@param $Table - Name of the editig table (column will be deleted).
		*
		*	@param $ColumnName - Name of the deleting column.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function 			drop_column( $Table , $ColumnName )
		{
			try
			{
				$this->query( "ALTER TABLE `$Table` DROP COLUMN `$ColumnName`" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Первичная блокирование таблиц.
		*
		*	@param $Tables - Блокируемые таблицы.
		*
		*	@param $Modes - Режимы блокирования.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Initial lock.
		*
		*	@param $Tables - Tables to block.
		*
		*	@param $Modes - Blocking modes.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			initial_lock( $Tables , $Modes )
		{
			try
			{
				$QueryPart = '';
				
				/** \~russian первая блокировка
					\~english first lock */
				for( $i = 0 ; $i < count( $Tables ) - 1 ; $i++ )
				{
					$QueryPart .= $Tables[ $i ].' '.$Modes[ $i ].', ';
				}
				$QueryPart .= $Tables[ count( $Tables ) - 1 ].' '.$Modes[ count( $Tables ) - 1 ];
				
				$this->query( 'LOCK TABLES '.$QueryPart );
				
				self::$LockedTables = $Tables;
				self::$LockModes = $Modes;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Попытка заблокировать таблицу.
		*
		*	@param $Tables - Блокируемые таблицы.
		*
		*	@param $Modes - Режимы блокирования.
		*
		*	@param $i - Курсор.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function tries to lock table.
		*
		*	@param $Tables - Tables to block.
		*
		*	@param $Modes - Blocking modes.
		*
		*	@param $i - Cursor.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			try_lock_table( $Tables , $Modes , $i )
		{
			try
			{
				$Key = array_search( $Tables[ $i ] , self::$LockedTables );

				if( $Key === false )
				{
					throw( new Exception( "Lock tables error. Invalid lock logic." ) );
				}
				if( self::$LockedTables[ $Key ] == 'WRITE' )
				{
					/* nop */
				}
				else
				{
					/*if we are trying to change lock from READ to WRITE then we get an error */
					if( $Modes[ $i ] === 'WRITE' && self::$LockModes[ $Key ] === 'READ' )
					{
						throw( new Exception( "Lock tables error. Invalid lock mode logic." ) );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Блокирование таблиц.
		*
		*	@param $Tables - Блокируемые таблицы.
		*
		*	@param $Modes - Режимы блокирования.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function blocks tables.
		*
		*	@param $Tables - Tables to block.
		*
		*	@param $Modes - Blocking modes.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			lock( $Tables , $Modes )
		{
			try
			{
				if( self::$LockedTables === false )
				{
					$this->initial_lock( $Tables , $Modes );
				}
				else
				{
					/** \~russian уже есть заблокированные таблицы
						\~english we already have locked tables */
					for( $i = 0 ; $i < count( $Tables ) ; $i++ )
					{
						$this->try_lock_table( $Tables , $Modes , $i );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция снятия блокировок с таблиц.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function releases all locks for all tables.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			unlock()
		{
			try
			{
				self::$LockedTables = false;
				self::$LockModes = false;
				$this->query( 'UNLOCK TABLES' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Установка точки сохранения.
		*
		*	@param $Savepoint - Точка сохранения.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		/**
		*	\~english Function sets savepoint.
		*
		*	@param $Savepoint - Savepoint.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			savepoint( $Savepoint )
		{
			try
			{
				$this->query( 'SAVEPOINT '.$Savepoint );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Откат до точки сохранения.
		*
		*	@param $Savepoint - Точка сохранения.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function rollbacks transaction to savepoint.
		*
		*	@param $Savepoint - Savepoint.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			rollback( $Savepoint )
		{
			try
			{
				$this->query( 'ROLLBACK TO SAVEPOINT '.$Savepoint );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция начала транзакции.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function starts new transaction.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			transaction()
		{
			try
			{
				$this->query( 'START TRANSACTION' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Закоммитить транзакцию.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function commits transaction.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			commit()
		{
			try
			{
				$this->query( 'COMMIT' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>