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
	
	define( 'DB_ASSOC_ARRAY' , 1 );
	define( 'DB_OBJECT' , 2 );
	
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
	class	oracle_database_1_0_0{
		
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
		*	\~russian Конфиг.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Config.
		*
		*	@author Dodonov A.A.
		*/
		var					$Config = false;
		
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
		var					$Username;
		var					$Password;
		var					$TablenamePrefix;
		var					$DBLogging;
		
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
				
				$this->Connection = @oci_pconnect( $this->Username , $this->Password );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения соединения с базой данных.
		*
		*	@param $ForceReconnect - принудительное пересоздание коннекта.
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
		*	@author Dodonov A.A.
		*/
		function			get_connection( $ForceReconnect = false )
		{
			try
			{
				if( $this->Connection === false || $ForceReconnect ===true )
				{
					if( $this->Connection !== false )
					{
						oci_close( $this->Connection );
					}
					$DBConfigSet = get_package( 'database::db_config_set' , 'last' , __FILE__ );
					$DBConfigSet->load_config( dirname( __FILE__ ).'/conf/cf_mysql_database' );
					$this->Connection = $DBConfigSet->connect( $this );
					if( oci_error() !== false )
					{
						throw( 
							new Exception( 
								'An error occured while setting connection to the database '.$Error[ 'message' ]
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
		*	@param $Query - строка запроса.
		*
		*	@return Результат запроса
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function executes query.
		*
		*	@param $Query - query string.
		*
		*	@return Query result.
		*
		*	@author Dodonov A.A.
		*/
		function			query( $Query )
		{
			try
			{
				$Connection = $this->get_connection();

				$Query = str_replace( 'umx_' , $this->TablenamePrefix , $Query );

				$Stmt = oci_parse( $Connection , $Query );
				oci_execute( $Stmt );

				if( ( $Error = oci_error() ) !== false )
				{
					throw( new Exception( 'An error occured while query execution '.$Error[ 'message' ] ) );
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
		*	@param $theQueryMode - либо DB_ASSOC_ARRAY либо DB_OBJECT.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Mode of extracting data from table.
		*
		*	@param $theQueryMode - either DB_ASSOC_ARRAY or DB_OBJECT.
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
		*	@param $What - список выбираемых полей.
		*
		*	@param $Tables - список таблиц из которых подтягиваются данные.
		*
		*	@param $Condition - условие отбора записей.
		*
		*	@return массив результатов.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
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
		*	@param $Result - объект резултата.
		*
		*	@return массив результатов.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fetches results of the query.
		*
		*	@param $Result - query result object.
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
		*	@param $Table - таблица, в которую вставляется запись.
		*
		*	@param $Fields - список полей, которые будут заполнены при вставке записи.
		*
		*	@param $Values - значения полей.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Executes insert query.
		*
		*	@param $Table - New record will be inserted in this table.
		*
		*	@param $Fields - list of fields wich will be filled while record insertion.
		*
		*	@param $Values - field values.
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
		*	@param $Table - таблица, из которой удаляется запись.
		*
		*	@param $Condition - условие отбора записей.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
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
		*	@param $Table - таблица, в которой обновляется запись.
		*
		*	@param $Fields - список полей, которые будут заполнены при обновлении записи.
		*
		*	@param $Values - значения полей.
		*
		*	@param $Condition - условие отбора записей.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Executes update query.
		*
		*	@param $Table - Record (or records) will be updated in this table.
		*
		*	@param $Fields - list of fields wich will be filled while record update.
		*
		*	@param $Values - field values.
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
		*	@param $Table - создаваемая таблица.
		*
		*	@param $FirstIndexField - имя поля которое будет индексом. Поле создастся автоматически.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Executes delete query.
		*
		*	@param $Table - Created table.
		*
		*	@param $FirstIndexField - name of index field. Field will be created automatically.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			create( $Table , $FirstIndexField = 'id' )
		{
			try
			{
				$this->query( 
					"CREATE TABLE `$Table` ( `$FirstIndexField` INTEGER UNSIGNED NOT NULL DEFAULT ".
						"NULL AUTO_INCREMENT , PRIMARY KEY ( `$FirstIndexField` ) )"
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
		*	@param $Table - удаляемая таблица.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
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
		*	@param $Table - таблица, в которую добавляется столбец.
		*
		*	@param $ColumnName - имя столбца.
		*
		*	@param $Type - Тип столбца.
		*
		*	@param $Mode - Режим добавления столбца.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
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
		*	@param $Table - таблица, из которой удаляется столбец.
		*
		*	@param $ColumnName - имя удаляемого столбца.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
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
		*	\~russian Блокирование таблиц.
		*
		*	@param $Tables - Блокируемые таблицы.
		*
		*	@param $Modes - режимы блокирования.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
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
				throw( new Exception( "Table locking unavailable" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция снятия блокировок с таблиц.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
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
				throw( new Exception( "Table locking unavailable" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Установка точки сохранения.
		*
		*	@param $Savepoint - точка сохранения.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets savepoint.
		*
		*	@param $Savepoint - savepoint.
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
		*	@param $Savepoint - точка сохранения.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function rollbacks transaction to savepoint.
		*
		*	@param $Savepoint - savepoint.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			rollback( $Savepoint )
		{
			try
			{
				oci_rollback( $this->get_connection() );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция начала транзакции.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
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
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
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
				oci_commit( $this->get_connection() );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>