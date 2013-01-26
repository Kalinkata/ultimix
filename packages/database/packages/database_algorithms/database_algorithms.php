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
	
	define( 'CREATION_DATE' , 1 );
	define( 'MODIFICATION_DATE' , 2 );
	define( 'PUBLICATION_DATE' , 4 );
	define( 'OWNER' , 8 );
	
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
	class	database_algorithms_1_0_0{
	
		/**
		*	\~russian Объект базы данных.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Database object.
		*
		*	@author Dodonov A.A.
		*/
		var					$Database = false;
		var					$Security = false;
		var					$UserAlgorithms = false;
	
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
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Установка поля.
		*
		*	@param $Field - Имя поля.
		*
		*	@param $Value - Значение поля.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets field.
		*
		*	@param $Field - Field name.
		*
		*	@param $Value - Field value.
		*
		*	@author Dodonov A.A.
		*/
		function			set( $Field , $Value )
		{
			$this->$Field = $Value;
		}

		/**
		*	\~russian Выполнить набор SQL команд профитанных из $SetOfQueries.
		*
		*	@param $SetOfQueries - набор SQL инструкций.
		*
		*	@note SQL инструкции разделены строками ";\r\n".
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Execute SQL queries from $SetOfQueries.
		*
		*	@param $SetOfQueries - set of SQL queries;
		*
		*	@note SQL instructions are separated by ";\r\n".
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			execute_query_set( $SetOfQueries )
		{
			try
			{
				$SetOfQueries = str_replace( ";\r\n" , ";\n" , $SetOfQueries );
				$SetOfQueries = explode( ";\n" , $SetOfQueries );

				foreach( $SetOfQueries as $Query )
				{
					$this->Database->query( $Query );
					$this->Database->commit();
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция проверяет можно ли законнектиться.
		*
		*	@return true если удалось подключиться, иначе false.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates can we connect to the database.
		*
		*	@exception true if the connection was established, false otherwise.
		*
		*	@author Dodonov A.A.
		*/
		function			try_connect()
		{
			try
			{
				$Obj = $this->Database->get_object( true );

				$Obj->get_connection();

				return( true );
			}
			catch( Exception $e )
			{
				handle_script_error( false , $e );

				return( false );
			}
		}

		/**
		*	\~russian Функция возвращает условие для выбора записей.
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
		*	@param $NativeTable - Название таблицы.
		*
		*	@return Условие выбора записей.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns condition of records selection.
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
		*	@param $NativeTable - Table name.
		*
		*	@return Condition of records selection.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select_condition( $Start = false , $Limit = false , $Field = false , 
														$Order = false , $Condition = '1 = 1' , $NativeTable = false )
		{
			try
			{
				if( $Start !== false )
				{
					$Start = $this->Security->get( $Start , 'integer' );
					$Limit = $this->Security->get( $Limit , 'integer' );
					
					if( $Field === false )
					{
						$Field = $NativeTable !== false ? "$NativeTable.id" : 'id';
						$Order = 'DESC';
					}
					else
					{
						$Field = $this->Security->get( $Field , 'command' );
						$Order = $this->Security->get( $Order , 'command' );
						$Order = ( $Order === 'ascending' || $Order === 'ASC' ) ? 'ASC' : 'DESC';
					}
					
					$Condition = "$Condition ORDER BY $Field $Order LIMIT $Start , $Limit";
				}
				
				return( $Condition );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Добавление полей безопасности.
		*
		*	@param $Fields - Поля.
		*
		*	@param $Values - Значения.
		*
		*	@param $AddFields - Дополнительные поля.
		*
		*	@return array( $Fields , $Values ).
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function adds security fields.
		*
		*	@param $Fields - Fields.
		*
		*	@param $Values - Values.
		*
		*	@param $AddFields - Additional fields.
		*
		*	@return array( $Fields , $Values ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_security_fields( $Fields , $Values , $AddFields = 0 )
		{
			try
			{
				if( $AddFields & OWNER )
				{
					$UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
					$Fields [] = 'owner';
					$Values [] = $UserAlgorithms->get_id();
				}

				return( array( $Fields , $Values ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Добавление спец. полей.
		*
		*	@param $Fields - Поля.
		*
		*	@param $Values - Значения.
		*
		*	@param $AddFields - Дополнительные поля.
		*
		*	@return array( $Fields , $Values ).
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function adds special fields.
		*
		*	@param $Fields - Fields.
		*
		*	@param $Values - Values.
		*
		*	@param $AddFields - Additional fields.
		*
		*	@return array( $Fields , $Values ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_special_fields( $Fields , $Values , $AddFields = 0 )
		{
			try
			{
				if( $AddFields & CREATION_DATE )
				{
					$Fields [] = 'creation_date';
					$Values [] = 'NOW()';
				}
				if( $AddFields & MODIFICATION_DATE )
				{
					$Fields [] = 'modification_date';
					$Values [] = 'NOW()';
				}
				if( $AddFields & PUBLICATION_DATE )
				{
					$Fields [] = 'publication_date';
					$Values [] = 'NOW()';
				}

				return( $this->add_security_fields( $Fields , $Values , $AddFields ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка полей для вставки.
		*
		*	@param $Record - Запись для вставки.
		*
		*	@param $AddFields - Дополнительные поля.
		*
		*	@return array( $Fields , $Values ).
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fetches fields and values.
		*
		*	@param $Record - Record to insert.
		*
		*	@param $AddFields - Additional fields.
		*
		*	@return array( $Fields , $Values ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_fields_values( &$Record , $AddFields = 0 )
		{
			try
			{
				$Fields = array();
				$Values = array();

				foreach( $Record as $f => $v )
				{
					if( $v !== '_no_update' && $f !== 'master_id' && $f !== 'master_type' )
					{
						$Fields [] = $f;
						
						if( is_array( $v ) || is_object( $v ) )
						{
							$Values [] = "'".serialize( $v )."'";
						}
						else
						{
							$Values [] = "'".$v."'";
						}
					}
				}

				return( $this->add_special_fields( $Fields , $Values , $AddFields ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция проверяет можно ли законнектиться.
		*
		*	@param $TableName - Название таблицы.
		*
		*	@param $Fields - Поля.
		*
		*	@param $Values - Значения.
		*
		*	@return Идентификатор созданной записи.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates can we connect to the database.
		*
		*	@param $TableName - Name of the table.
		*
		*	@param $Fields - Fields.
		*
		*	@param $Values - Values.
		*
		*	@return Id of the created record.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			create( $TableName , &$Fields , &$Values )
		{
			try
			{
				$this->Database->lock( array( $TableName ) , array( 'WRITE' ) );

				$this->Database->insert( $TableName , implode( ',' , $Fields ) , implode( ',' , $Values ) );
				$this->Database->commit();

				$id = $this->Database->select( '*' , $TableName , '1 = 1 ORDER by id DESC LIMIT 0 , 1' );
				$id = get_field( $id[ 0 ] , 'id' );

				$this->Database->unlock();

				return( $id );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция возвращает количество записей в запросе.
		*
		*	@param $TableName - Название таблицы.
		*
		*	@param $Condition - Условие выборки записей.
		*
		*	@return Колчество записей.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function count of tables in the query.
		*
		*	@param $TableName - Name of the table.
		*
		*	@param $Condition - Records selection condition.
		*
		*	@return Count of records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			count_of_records( $TableName , $Condition = '1 = 1' )
		{
			try
			{
				$CountOfRecords = $this->Database->select( 'COUNT( * ) AS count_of_records' , $TableName , $Condition );
				
				$CountOfRecords = get_field( $CountOfRecords[ 0 ] , 'count_of_records' );
				
				return( $CountOfRecords );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция существуют ли записи.
		*
		*	@param $TableName - Название таблицы.
		*
		*	@param $Condition - Условие выборки записей.
		*
		*	@return true/false.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function checks fo record exists.
		*
		*	@param $TableName - Name of the table.
		*
		*	@param $Condition - Records selection condition.
		*
		*	@return true/false.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			record_exists( $TableName , $Condition = '1 = 1' )
		{
			try
			{
				return( $this->count_of_records( $TableName , $Condition ) > 0 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения списка таблиц.
		*
		*	@return Список таблиц.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a list of tables.
		*
		*	@return A list of tables.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_list_of_tables()
		{
			try
			{
				$this->Database->query_as( DB_ARRAY );
				$Result = $this->Database->query( 'SHOW TABLES' );
				$ListOfTables = $this->Database->fetch_results( $Result );
				
				foreach( $ListOfTables as $i => $TableInfo )
				{
					$ListOfTables[ $i ] = $TableInfo[ 0 ];
				}
				
				return( $ListOfTables );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения списка полей таблицы.
		*
		*	@param $TableName - Таблица для который осуществляется выборка полей.
		*
		*	@return Список полей таблицы.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a list of table's columns.
		*
		*	@param $TableName - Table name.
		*
		*	@return List of table's columns names.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_list_of_fields( $TableName )
		{
			try
			{
				$TableName = $this->Security->get( $TableName , 'command' );
				
				$this->Database->query_as( DB_OBJECT );
				$Result = $this->Database->query( "SHOW FIELDS FROM `$TableName`" );

				return( $this->Database->fetch_results( $Result ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>