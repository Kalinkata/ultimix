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
	*	\~russian Класс для работы с хронологическими данными.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides chronological records manupulation routine.
	*
	*	@author Dodonov A.A.
	*/
	class	chronological_1_0_0{
		
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
		var					$Database = false;
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
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Установка временных интервалов и идентификаторов для записи.
		*
		*	@param $MasterId - Идентификатор редактируемой записи.
		*
		*	@param $DataAccess - Объект доступа к данным.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function updates data bounds and group_id.
		*
		*	@param $MasterId - Updating record's id.
		*
		*	@param $DataAccess - Data access object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			create_record( $MasterId , $DataAccess )
		{
			try
			{
				$MasterId = $this->Security->get( $MasterId , 'integer' );
				
				$Time = time();
				
				$this->Database->update( 
					$DataAccess->NativeTable , 
					array( 'date_from' , 'date_to' , 'group_id' ) , 
					array( $Time , $Time + 100 * 365 * 24 * 60 * 60 , $MasterId ) , 
					"id = $MasterId"
				);
				
				$this->Database->commit();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Закрытие старой версии записи.
		*
		*	@param $MasterId - Идентификатор редактируемой записи.
		*
		*	@param $Changes - Изменения в записи.
		*
		*	@param $DataAccess - Объект доступа к данным.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function closes old version of record.
		*
		*	@param $MasterId - Updating record's id.
		*
		*	@param $Changes - Records changes.
		*
		*	@param $DataAccess - Data access object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function close_old_version( $MasterId , $Changes , $DataAccess )
		{
			try
			{
				$MasterId = $this->Security->get( $MasterId , 'integer' );				
				$Time = time();
				
				$Records = $this->Database->select( 'MIN( id ) AS min_id' , $DataAccess->NativeTable );
				$MinId = get_field( $Records[ 0 ] , 'min_id' , 0 ) - 1;
				$this->Database->update(
					$DataAccess->NativeTable , array( 'id' , 'date_to' ) , 
					array( $MinId , $Time - 1 ) , "id = $MasterId"
				);
				$this->Database->commit();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Создание новой версии записи.
		*
		*	@param $MasterId - Идентификатор редактируемой записи.
		*
		*	@param $Changes - Изменения в записи.
		*
		*	@param $DataAccess - Объект доступа к данным.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function creates new version of record.
		*
		*	@param $MasterId - Updating record's id.
		*
		*	@param $Changes - Records changes.
		*
		*	@param $DataAccess - Data access object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	create_new_version( $MasterId , $Changes , $DataAccess )
		{
			try
			{
				$OriginalRecord = $DataAccess->unsafe_select( "id = $MasterId" );
				$ChangedRecord = extend( $OriginalRecord[ 0 ] , $Changes );
				$NewId = $DataAccess->create( $ChangedRecord );				
				$this->Database->update(
					$DataAccess->NativeTable , array( 'id' , 'date_from' , 'date_to' , 'group_id' ) , 
					array( $MasterId , $Time , $Time + 100 * 365 * 24 * 60 * 60 , $MasterId ) , "id = $NewId"
				);
				$this->Database->commit();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Установка временных интервалов и идентификаторов для записи при обновлении.
		*
		*	@param $MasterId - Идентификатор редактируемой записи.
		*
		*	@param $Changes - Изменения в записи.
		*
		*	@param $DataAccess - Объект доступа к данным.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function updates data bounds and group_id for the updating record.
		*
		*	@param $MasterId - Updating record's id.
		*
		*	@param $Changes - Records changes.
		*
		*	@param $DataAccess - Data access object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			update_record( $MasterId , $Changes , $DataAccess )
		{
			try
			{
				$this->Database->lock( array( $DataAccess->NativeTable ) , array( 'WRITE' ) );
				
				$this->close_old_version( $MasterId , $Changes , $DataAccess );
				
				$this->create_new_version( $MasterId , $Changes , $DataAccess );
				
				$this->Database->unlock();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Закрытие записи, что эквивалентно её удалению.
		*
		*	@param $MasterId - Идентификатор редактируемой записи.
		*
		*	@param $DataAccess - Объект доступа к данным.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Function closes record, wich is equivalent to it's deletion.
		*
		*	@param $MasterId - Updating record's id.
		*
		*	@param $DataAccess - Data access object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			close_record( $MasterId , $DataAccess )
		{
			try
			{
				$MasterId = $this->Security->get( $MasterId , 'integer_list' );
				
				$this->Database->update( 
					$DataAccess->NativeTable , array( 'date_to' ) , array( time() ) , 
					"id IN ( $MasterId ) AND ( ".$DataAccess->AddLimitations." )"
				);
				
				$this->Database->commit();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>