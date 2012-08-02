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
	define( 'DB_ARRAY' , 3 );
	
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
	class	database_1_0_0{
	
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
		var					$DatabaseLogger = false;
		var					$PageComposer = false;
		var					$Security = false;
		var					$Settings = false;
		var					$String = false;
		var					$Text = false;
		var					$Tags = false;
	
		/**
		*	\~russian Объект для работы с БД.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english DB access object.
		*
		*	@author Dodonov A.A.
		*/
		var					$DatabaseAccessObject = false;
		
		/**
		*	\~russian Кодировка строк в БД.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Database default encoding.
		*
		*	@author Dodonov A.A.
		*/
		var					$DatabaseEncoding = 'UTF-8';
		
		/**
		*	\~russian Счетчик количества запросов к БД.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Counting database query.
		*
		*	@author Dodonov A.A.
		*/
		var					$QueryCounter = 0;
		
		/**
		*	\~russian Логирование запросов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Query logging.
		*
		*	@author Dodonov A.A.
		*/
		var					$DBLogging;
		
		/**
		*	\~russian Префикс таблиц.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Table name's prefix.
		*
		*	@author Dodonov A.A.
		*/
		var					$TablenamePrefix;
		
		/**
		*	\~russian Сессия.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Session.
		*
		*	@author Dodonov A.A.
		*/
		static				$Session = false;
		
		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->DatabaseLogger = get_package( 'database::database_logger' , 'last' , __FILE__ );
				$this->PageComposer = get_package( 'page::page_composer' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Text = get_package( 'string::text' , 'last' , __FILE__ );
				$this->Tags = get_package( 'string::tags' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция process config line.
		*
		*	@param ConfigLine - Строка конфига.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function applies data limitations.
		*
		*	@param ConfigLine - Config line.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Додонов А.А.
		*/
		private function	compile_config_line( $ConfigLine )
		{
			try
			{
				$this->Settings->load_settings( $ConfigLine );
				$PackageName = $this->Settings->get_setting( 'package_name' );
				$PackageVersion = $this->Settings->get_setting( 'package_version' , 'last' );
				$AddLimitations = $this->Settings->get_setting( 'data_limitation' );
				$Package = get_package( $PackageName , $PackageVersion , __FILE__ );
				$Package->set_add_limitations( $AddLimitations );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция инициализации ограничений на данные.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function applies data limitations.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Додонов А.А.
		*/
		private function	apply_add_limitations()
		{
			try
			{
				$Config = $this->CachedMultyFS->get_config( __FILE__ , 'cf_add_limitations' , 'cleaned' );

				if( $Config != '' )
				{
					$Config = explode( "\n" , $Config );

					foreach( $Config as $k => $ConfigLine )
					{
						$this->compile_config_line( $ConfigLine );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция настройки соединения.
		*
		*	@param $Config - Конфиг соединения с БД.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function setups connection.
		*
		*	@param $Config - Database connection config.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Додонов А.А.
		*/
		private function	setup( &$Config )
		{
			try
			{
				$this->DatabaseEncoding = $Config[ 2 ];
				$this->DBLogging = intval( @$Config[ 3 ] ) === 1 ? true : false;
				$this->TablenamePrefix = $this->DatabaseAccessObject->TablenamePrefix;
				self::$Session = microtime( true );
				$this->DatabaseAccessObject->query( 'SET AUTOCOMMIT = 0' );
				$this->DatabaseAccessObject->query( 'SET NAMES utf8' );
				$this->apply_add_limitations();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция выполнения запроса.
		*
		*	@return Объект доступа к базе данных.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function executes query.
		*
		*	@return Data access object.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Додонов А.А.
		*/
		function			get_object()
		{
			try
			{
				if( $this->DatabaseAccessObject === false )
				{
					$Config = $this->CachedMultyFS->get_config( __FILE__ , 'cf_database_settings' );
					$Config = explode( '#' , $Config );
					$this->DatabaseAccessObject = get_package( $Config[ 0 ] , $Config[ 1 ] , __FILE__ );

					$this->DatabaseAccessObject->get_connection();

					$this->setup( $Config );
				}

				return( $this->DatabaseAccessObject );
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
		*	@return Результат запроса.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
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
				$Start = microtime( true );
				$this->QueryCounter++;
				$DBO = $this->get_object();
				$Query = str_replace( array( '[eq]' ) , array( '=' ) , $Query );

				if( $this->DatabaseEncoding != 'UTF-8' )
				{
					$Result = $this->Text->iconv( 
						$this->DatabaseEncoding , 'UTF-8' , $DBO->query( $this->Tags->compile_ultimix_tags( $Query ) )
					);
				}
				else
				{
					$Result = $DBO->query( $this->Tags->compile_ultimix_tags( $Query ) );
				}

				$this->DatabaseLogger->log_query( $Query , $Start , $this->DBLogging );

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
				$DBO = $this->get_object();
				$DBO->query_as( $theQueryMode );
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
		*	@return массив результатов.
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
				$this->QueryCounter++;
				$DBO = $this->get_object();

				$Result = $DBO->select( $What , $Tables , $Condition );

				if( $this->DatabaseEncoding != 'UTF-8' )
				{
					$Result = $this->Text->iconv( $this->DatabaseEncoding , 'UTF-8' , $Result );
				}

				return( $Result );
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
				$DBO = $this->get_object();

				$Result = $DBO->fetch_results( $Result );

				if( $this->DatabaseEncoding != 'UTF-8' )
				{
					$Result = $this->Text->iconv( $this->DatabaseEncoding , 'UTF-8' , $Result );
				}

				return( $Result );
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
				$this->QueryCounter++;
				$DBO = $this->get_object();
				$DBO->insert( $Table , $Fields , $Values );
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
				$this->QueryCounter++;
				$DBO = $this->get_object();
				$DBO->delete( $Table , $Condition );
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
				$this->QueryCounter++;
				$DBO = $this->get_object();
				$DBO->update( $Table , $Fields , $Values , $Condition );
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
		*	@param $Table - Created table.
		*
		*	@param $FirstIndexField - Name of index field. Field will be created automatically.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			create( $Table , $FirstIndexField = 'id' )
		{
			try
			{
				$this->QueryCounter++;
				$DBO = $this->get_object();
				$DBO->create( $Table , $FirstIndexField );
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
				$this->QueryCounter++;
				$DBO = $this->get_object();
				$DBO->drop( $Table );
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
		*	@param $Tables - Blocking tables.
		*
		*	@param $Modes - Blocking modes.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Додонов А.А.
		*/
		function			lock( $Tables , $Modes )
		{
			try
			{
				$this->QueryCounter++;
				$DBO = $this->get_object();
				$DBO->lock( $Tables , $Modes );
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
				$this->QueryCounter++;
				$DBO = $this->get_object();
				$DBO->unlock();
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
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
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
				$this->QueryCounter++;
				$DBO = $this->get_object();
				$DBO->savepoint( $Savepoint );
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
				$this->QueryCounter++;
				$DBO = $this->get_object();
				$DBO->rollback( $Savepoint );
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
				$this->QueryCounter++;
				$DBO = $this->get_object();
				$DBO->transaction();
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
				$this->QueryCounter++;
				$DBO = $this->get_object();
				$DBO->commit();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>