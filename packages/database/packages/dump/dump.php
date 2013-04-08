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
	*	\~russian Класс для создания дампов БД.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides DB dumps creation routine.
	*
	*	@author Dodonov A.A.
	*/
	class	dump_1_0_0{
		
		/**
		*	\~russian Закэшированные пакеты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$CachedMultyFS = false;
		var					$Database = false;
		var					$DatabaseAlgorithms = false;
		var					$Security = false;

		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->DatabaseAlgorithms = get_package( 'database::database_algorithms' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения списка таблиц.
		*
		*	@param $DumpCreationConfig - Настройки создания дампа.
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
		*	@param $DumpCreationConfig - Config for dump creation.
		*
		*	@return A list of tables.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_list_of_tables( $DumpCreationConfig )
		{
			try
			{
				$ListOfTables = $DumpCreationConfig->get_setting( 'tables' );
				
				if( $ListOfTables === 'all' )
				{
					return( $this->DatabaseAlgorithms->get_list_of_tables() );
				}
				else
				{
					return( explode( ',' , $ListOfTables ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения дампа структуры таблицы.
		*
		*	@param $TableDumpCreationConfig - Настройки создания дампа.
		*
		*	@param $TableName - Название таблицы.
		*
		*	@return Дамп для таблицы.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a dump for the specified table.
		*
		*	@param $TableDumpCreationConfig - Config for dump creation.
		*
		*	@param $TableName - Table's name.
		*
		*	@return Dump of the table.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_drop_dump( $TableDumpCreationConfig , $TableName )
		{
			try
			{
				if( $TableDumpCreationConfig->get_setting( 'delete_existing' , false ) )
				{
					$TableName = $this->Security->get( $TableName , 'command' );
					
					/* removing prefix */
					$ClearTableName = str_replace( 
						array( $this->Database->TablenamePrefix , 'umx_' ) , array( '' , '' ) , $TableName
					);
					
					return( "DROP TABLE IF EXISTS `[lfb]prefix[rfb]$ClearTableName`;\n" );
				}
				else
				{
					return( '' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения скрипта полей таблицы.
		*
		*	@param $FieldInfo - Настройки создания дампа.
		*
		*	@param $Fields - Поля.
		*
		*	@return Скрипт.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a script of fields for the specified table.
		*
		*	@param $FieldInfo - Config for dump creation.
		*
		*	@param $Fields - Fields.
		*
		*	@return Script.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_field_script( $FieldInfo , &$Fields )
		{
			try
			{
				$FieldName = '`'.get_field( $FieldInfo , 'Field' ).'` ';
				$FieldType = get_field( $FieldInfo , 'Type' ).' ';
				$Null = get_field( $FieldInfo , 'Null' ) == 'NO' ? 'NOT NULL ' : '';
				$Default = get_field( $FieldInfo , 'Default' );
				$Default = strlen( $Default ) ? "default '$Default' " : '';
				$Extra = get_field( $FieldInfo , 'Extra' );
				if( $Extra == 'auto_increment' )
				{
					$Fields[] = "	PRIMARY KEY  ( $FieldName)";
				}
				$Extra = strlen( $Extra ) ? "$Extra " : '';
				return( "	$FieldName$FieldType$Null$Default$Extra" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения дампа полей таблицы.
		*
		*	@param $TableDumpCreationConfig - Настройки создания дампа.
		*
		*	@param $TableName - Название таблицы.
		*
		*	@return Дамп для таблицы.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a dump of fields for the specified table.
		*
		*	@param $TableDumpCreationConfig - Config for dump creation.
		*
		*	@param $TableName - Table's name.
		*
		*	@return Dump of the table.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_fields_dump( $TableDumpCreationConfig , $TableName )
		{
			try
			{
				$TableName = $this->Security->get( $TableName , 'command' );
				$Fields = $this->DatabaseAlgorithms->get_list_of_fields( $TableName );

				foreach( $Fields as $i => $FieldInfo )
				{
					$Fields[ $i ] = $this->get_field_script( $FieldInfo , $Fields );
				}

				return( implode( ",\n" , $Fields ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения дампа автоинкрементного поля.
		*
		*	@param $TableDumpCreationConfig - Настройки создания дампа.
		*
		*	@param $TableName - Название таблицы.
		*
		*	@return Дамп для таблицы.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a dump of the auto_increment.
		*
		*	@param $TableDumpCreationConfig - Config for dump creation.
		*
		*	@param $TableName - Table's name.
		*
		*	@return Autoincrement info.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_auto_increment( $TableDumpCreationConfig , $TableName )
		{
			try
			{
				$TableName = $this->Security->get( $TableName , 'command' );
				
				$Fields = $this->DatabaseAlgorithms->get_list_of_fields( $TableName );
				
				foreach( $Fields as $i => $FieldInfo )
				{
					$Extra = get_field( $FieldInfo , 'Extra' );
					
					if( $Extra == 'auto_increment' )
					{
						$FieldName = get_field( $FieldInfo , 'Field' );
						$MaxValue = $this->Database->select( "MAX( $FieldName ) AS max_field_value" , "`$TableName`" );
						$MaxValue = intval( get_field( $MaxValue[ 0 ] , 'max_field_value' ) ) + 1;
						
						return( "AUTO_INCREMENT=$MaxValue" );
					}
				}
				
				return( '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения дампа структуры таблицы.
		*
		*	@param $TableDumpCreationConfig - Настройки создания дампа.
		*
		*	@param $TableName - Название таблицы.
		*
		*	@return Дамп для таблицы.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a dump for the specified table.
		*
		*	@param $TableDumpCreationConfig - Config for dump creation.
		*
		*	@param $TableName - Table's name.
		*
		*	@return Dump of the table.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_create_dump( $TableDumpCreationConfig , $TableName )
		{
			try
			{
				$TableName = $this->Security->get( $TableName , 'command' );
				
				/* removing prefix */
				$ClearTableName = str_replace( 
					array( $this->Database->TablenamePrefix , 'umx_' ) , array( '' , '' ) , $TableName
				);
				$Dump  = "CREATE TABLE `[lfb]prefix[rfb]$ClearTableName` (\n";
				
				$Dump .= $this->get_fields_dump( $TableDumpCreationConfig , $TableName );
				
				$Encoding = $TableDumpCreationConfig->get_setting( 'encoding' , 'utf8' );
				$Autoincrement = $this->get_auto_increment( $TableDumpCreationConfig , $TableName );
				$Dump .= "\n) $Autoincrement DEFAULT CHARSET=$Encoding;\n\n";

				return( $Dump );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения дампа структуры таблицы.
		*
		*	@param $TableDumpCreationConfig - Настройки создания дампа.
		*
		*	@param $TableName - Название таблицы.
		*
		*	@return Дамп для таблицы.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a dump for the specified table.
		*
		*	@param $TableDumpCreationConfig - Config for dump creation.
		*
		*	@param $TableName - Table's name.
		*
		*	@return Dump of the table.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_structure_dump( $TableDumpCreationConfig , $TableName )
		{
			try
			{
				if( $TableDumpCreationConfig->get_setting( 'delete_existing' , false ) )
				{
					$Dump  = $this->get_drop_dump( $TableDumpCreationConfig , $TableName );
					
					$Dump .= $this->get_create_dump( $TableDumpCreationConfig , $TableName );
					
					return( $Dump );
				}
				else
				{
					return( '' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Подготовка записи к выводу в дамп.
		*
		*	@param $Record - Запись.
		*
		*	@return Подготовленная запись.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function prepares record for the dump.
		*
		*	@param $Record - Record.
		*
		*	@return Prepared record.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	prepare_record( $Record )
		{
			try
			{
				$PlaceHolders = array( "\r" , "\n" , '[r]' , '[n]' , "'" );
				
				$Data = array( '\r' , '\n' , '\r' , '\n' , '&#039;' );
				
				$Record = str_replace( $PlaceHolders , $Data , $Record );
				
				return( "( '".implode( "' , '" , $Record )."' )" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения дампа вставки данных.
		*
		*	@param $TableName - Название таблицы.
		*
		*	@param $Fields - Поля.
		*
		*	@param $Records - Записи попадающие в дамп.
		*
		*	@return Дамп для таблицы.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a dump of data insertion command.
		*
		*	@param $TableName - Table's name.
		*
		*	@param $Fields - Fields.
		*
		*	@param $Records - Records to be put in the dump.
		*
		*	@return Dump of the table.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_insert_dump( $TableName , &$Fields , &$Records )
		{
			try
			{
				$Dump = '';

				if( isset( $Records[ 0 ] ) )
				{
					if( strpos( $TableName , $this->Database->TablenamePrefix ) === 0 )
					{
						$ClearTableName = substr( $TableName , strlen( $this->Database->TablenamePrefix ) );
					}
					$ClearTableName = str_replace( 'umx_' , '', $ClearTableName );
					$Dump = "INSERT INTO `[lfb]prefix[rfb]$ClearTableName` ( $Fields ) VALUES \n";

					foreach( $Records as $i => $Record )
					{
						$Records[ $i ] = $this->prepare_record( $Record );
					}

					$Dump .= implode( ",\n" , $Records ).";\n\n";
				}

				return( $Dump );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения дампа данных.
		*
		*	@param $TableDumpCreationConfig - Настройки создания дампа.
		*
		*	@param $TableName - Название таблицы.
		*
		*	@return Дамп для таблицы.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a dump of data.
		*
		*	@param $TableDumpCreationConfig - Config for dump creation.
		*
		*	@param $TableName - Table's name.
		*
		*	@return Dump of the table.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_data_dump( $TableDumpCreationConfig , $TableName )
		{
			try
			{
				$Dump = '';
				
				if( $TableDumpCreationConfig->get_setting( 'records' , false ) )
				{
					$Fields = get_field_ex( $this->DatabaseAlgorithms->get_list_of_fields( $TableName ) , 'Field' );
					$Fields = '`'.implode( '` , `' , $Fields ).'`';
					$this->Database->query_as( DB_ARRAY );
					$Records = $this->Database->select( '*' , "`$TableName`" );
					
					$Dump = $this->get_insert_dump( $TableName , $Fields , $Records );
				}
				
				return( $Dump );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция дампа таблицы.
		*
		*	@param $TableName - Название таблицы.
		*
		*	@param $DumpCreationConfig - Конфиг создания дампа.
		*
		*	@return Дамп для таблицы.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a dump for the specified table.
		*
		*	@param $TableName - Table's name.
		*
		*	@param $DumpCreationConfig - Dump creation config.
		*
		*	@return Dump of the table.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_dump_of_table( $TableName , &$DumpCreationConfig )
		{
			try
			{
				$DefaultConfig = 'records;structure;enecoding=utf8;delete_existing';
				$TableDumpCreationConfig = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$TableDumpCreationConfig->load_settings( 
					$DumpCreationConfig->get_setting( $TableName , $DefaultConfig )
				);
					
				$Dump  = $this->get_structure_dump( $TableDumpCreationConfig , $TableName );
				
				$Dump .= $this->get_data_dump( $TableDumpCreationConfig , $TableName );
				
				return( $Dump );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция получения дампа базы данных.
		*
		*	@param $DumpName - Название конфига с настройками создания дампа.
		*
		*	@return Дамп БД.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates dump of the database.
		*
		*	@param $DumpName - Name of the config.
		*
		*	@return Dump of the database.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_dump( $DumpName )
		{
			try
			{
				$DumpCreationConfig = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$DumpName = $this->Security->get( $DumpName , 'command' );
				$DumpCreationConfig->load_file( dirname( __FILE__ )."/conf/$DumpName" , '#' );
				
				$Dump = '';				
				$Tables = $this->get_list_of_tables( $DumpCreationConfig );
				foreach( $Tables as $i => $TableName )
				{
					$Dump .= $this->get_dump_of_table( $TableName , $DumpCreationConfig );
				}
				
				return( rtrim( $Dump , "\n" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code of the компонента.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( &$Options )
		{
			try
			{
				if( $Options->get_setting( 'dump_settings_form' , 0 ) == 1 )
				{
				}
				elseif( $Options->get_setting( 'dump' , 0 ) == 1 )
				{
					$Dump = $this->get_dump( 'full_dump' );
					
					header( 'HTTP/1.0 200 OK' );
					header( 'Content-type: application/octet-stream' );
					header( "Content-Length: ".strlen( $Dump ) );
					header( "Content-Disposition: attachment; filename=\"data.sql\"" );
					header( 'Connection: close' );
	
					return( $Dump );
				}
				else
				{
					return( '' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>