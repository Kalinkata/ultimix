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
	*	\~russian Класс для работы с контентом.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides content manipulation routine.
	*
	*	@author Dodonov A.A.
	*/
	class	content_algorithms_1_0_0{
	
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
		var					$ContentAccess = false;
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
				$this->ContentAccess = get_package( 'content::content_access' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$Args = func_get_args();_throw_exception_object( __METHOD__ , $Args , $e );
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
				
				$Records = $this->ContentAccess->unsafe_select( $this->ContentAccess->NativeTable.".id = $id" );
				
				return( count( $Records ) === 1 );
			}
			catch( Exception $e )
			{
				$Args = func_get_args();_throw_exception_object( __METHOD__ , $Args , $e );
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
				$id = $this->Security->get( $id , 'integer' );
				
				$Records = $this->ContentAccess->unsafe_select( $this->ContentAccess->NativeTable.".id = $id" );
				
				if( count( $Records ) == 0 )
				{
					throw( new Exception( 'Record was not found' ) );
				}
				
				return( $Records[ 0 ] );
			}
			catch( Exception $e )
			{
				$Args = func_get_args();_throw_exception_object( __METHOD__ , $Args , $e );
			}
		}
	}

?>