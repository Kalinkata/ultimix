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
	*	\~russian Класс для работы с записями.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides records access routine.
	*
	*	@author Dodonov A.A.
	*/
	class	graph_data_access_1_0_0{
	
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
		var					$NativeTable = '`umx_graph_data`';
		
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
		var					$DatabaseAlgorithms = false;
		var					$Security = false;
		var					$SecurityParser = false;
		var					$UserAlgorithms = false;
		
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
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
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
		function			unsafe_select( $Condition , $Fields = false )
		{
			try
			{
				$this->Database->query_as( DB_OBJECT );
				
				return( 
					$this->Database->select( 
						$Fields === false ? $this->NativeTable.'.*' : $Fields , $this->NativeTable , 
						"( $this->AddLimitations ) AND $Condition"
					)
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка параметров создания.
		*
		*	@param $Record - Объект по чьему образцу будет создаваться запись.
		*
		*	@return Параметры создания.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Getting creation parameters.
		*
		*	@param $Record Example for creation.
		*
		*	@return Creation parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	fetch_create_parameters( $Record )
		{
			try
			{
				if( get_field( $Record , 'author' , false ) === false )
				{
					set_field( $Record , 'author' , $this->UserAlgorithms->get_id() );
				}

				$Record = $this->SecurityParser->parse_parameters( 
					$Record , 'author:integer;graph_type:integer;ordinatus:float;abscissa:integer'
				);

				return( $this->DatabaseAlgorithms->compile_fields_values( $Record ) );
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
				list( $Fields , $Values ) = $this->fetch_create_parameters( $Record );

				$this->Database->delete( 
					$this->NativeTable , "( $this->AddLimitations ) AND abscissa = ".get_field( $Record , 'abscissa' ).
					' AND graph_type = '.get_field( $Record , 'graph_type' )
				);
				$this->Database->commit();

				$id = $this->DatabaseAlgorithms->create( $this->NativeTable , $Fields , $Values );

				$EventManager = get_package( 'event_manager' , 'last' , __FILE__ );
				$EventManager->trigger_event( 'on_after_create_graph_data' , array( 'id' => $id ) );

				return( $id );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>