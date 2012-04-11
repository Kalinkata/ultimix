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
	*	\~russian Работа с найтроками.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Working with settings.
	*
	*	@author Dodonov A.A.
	*/
	class	db_settings_1_0_0{
	
		/**
		*	\~russian Название таблицы.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Table name.
		*
		*	@author Dodonov A.A.
		*/
		var					$NativeTable = '`umx_setting`';
	
		/**
		*	\~russian Кэш.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cache.
		*
		*	@author Dodonov A.A.
		*/
		var					$Database = false;
		var					$DatabaseAlgorithms = false;
		var					$Security = false;
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
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->DatabaseAlgorithms = get_package( 'database::database_algorithms' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->SecurityParser = get_package( 'security::security_parser' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Выборка записей.
		*
		*	@param $Condition - Условие отбора записей.
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
		*	@param $Condition - Records selection condition.
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
				$this->Database->query_as( DB_OBJECT );
				
				$Settings = $this->Database->select( '*' , $this->NativeTable , "$Condition" );
				
				return( $Settings );
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
				$Record = $this->SecurityParser->parse_parameters( $Record , 'name:string;value:string' );
				
				list( $Fields , $Values ) = $this->DatabaseAlgorithms->compile_fields_values( $Record );

				$this->Database->lock( array( $this->NativeTable ) , array( 'WRITE' ) );
				
				$this->Database->insert( $this->NativeTable , implode( ',' , $Fields ) , implode( ',' , $Values ) );
				$this->Database->commit();
				
				$id = $this->Database->select( '*' , $this->NativeTable , '1 = 1 ORDER by id DESC LIMIT 0 , 1' );
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
		*	\~russian Функция получения настроек.
		*
		*	@param $SettingName - Название настройки.
		*
		*	@param $DefaultValue - Дефолтовое значение настроки если она неустановлена.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function provides access to the loaded settings.
		*
		*	@param $SettingName - Setting title.
		*
		*	@param $DefaultValue - Default value for undefined setting.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_setting( $SettingName , $DefaultValue = '_throw_exception' )
		{
			try
			{
				$SettingName = $this->Security->get( $SettingName , 'command' );
				$Time = time();
				
				$Settings = $this->unsafe_select( 
					"name LIKE '$SettingName' AND date_from <= $Time AND $Time <= date_to"
				);
				
				if( isset( $Settings[ 0 ] ) )
				{
					return( get_field( $Settings[ 0 ] , 'value' ) );
				}
				elseif( $DefaultValue === '_throw_exception' )
				{
					throw( new Exception( "Setting \"$SettingName\" was not found" ) );
				}
				else
				{
					return( $DefaultValue );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция установки настроек.
		*
		*	@param $SettingName - Название настройки.
		*
		*	@param $Value - Значение настроки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function provides setting values for settings.
		*
		*	@param $SettingName - Setting title.
		*
		*	@param $Value - Default value for setting.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_setting( $SettingName , $Value )
		{
			try
			{
				$SettingName = $this->Security->get( $SettingName , 'command' );
				$Time = time();
				
				$Settings = $this->unsafe_select( 
					"name LIKE '$SettingName' AND date_from <= $Time AND $Time <= date_to"
				);
				
				if( isset( $Settings[ 0 ] ) )
				{
					$id = get_field( $Settings[ 0 ] , 'id' );
					$Chronological = get_package( 'database::chronological' , 'last' , __FILE__ );
					$Chronological->update_record( 
						$id , array( 'name' => get_field( $Settings[ 0 ] , 'name' ) , 'value' => $Value ) , $this 
					);
				}
				else
				{
					throw( new Exception( "Setting \"$SettingName\" was not found" ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция конвертации объекта в строку.
		*
		*	@return Строка с описанием объекта.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function converts object to string.
		*
		*	@return string with the object's description.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__toString()
		{
			try
			{
				return( serialize( $this->SettingsList ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>