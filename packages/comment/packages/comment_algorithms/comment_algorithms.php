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
	*	\~russian Класс для работы с алгоритмами.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides algorithms.
	*
	*	@author Dodonov A.A.
	*/
	class	comment_algorithms_1_0_0{
	
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
		var					$CommentAccess = false;
		var					$Link = false;
		var					$LinkUtilities = false;
		var					$Security = false;
		
		var					$Cache = array();
		
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
				$this->CommentAccess = get_package( 'comment::comment_access' , 'last' , __FILE__ );
				$this->Link = get_package( 'link' , 'last' , __FILE__ );
				$this->LinkUtilities = get_package( 'link::link_utilities' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
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

				$Records = $this->CommentAccess->unsafe_select( $this->CommentAccess->NativeTable.".id = $id" );

				return( count( $Records ) === 1 );
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
				$id = $this->Security->get( $id , 'integer' );

				$Records = $this->CommentAccess->unsafe_select( $this->CommentAccess->NativeTable.".id = $id" );

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
		*	\~russian Выборка комментариев.
		*
		*	@param $MasterId - Идентификатор объекта, к которому прикреплена запись.
		*
		*	@param $MasterType - Тип объекта, к которому прикреплена запись.
		*
		*	@return Записи.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fetches comments.
		*
		*	@param $MasterId - Master object's id.
		*
		*	@param $MasterType - Master object's type.
		*
		*	@return Records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_records_for_object( $MasterId , $MasterType )
		{
			try
			{
				if( isset( $this->Cache[ "$MasterId.$MasterType" ] ) )
				{
					return( $this->Cache[ "$MasterId.$MasterType" ] );
				}

				$this->Cache[ "$MasterId.$MasterType" ] = $this->LinkUtilities->get_dependent_objects( 
					$MasterId , $MasterType , 'comment' , $this->CommentAccess
				);

				return( $this->Cache[ "$MasterId.$MasterType" ] );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка комментариев.
		*
		*	@param $Author - Автор.
		*
		*	@param $Time - Период (в секундах).
		*
		*	@return Записи.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fetches comments.
		*
		*	@param $Author - Author.
		*
		*	@param $Time - Period limit (in seconds).
		*
		*	@return Records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_comments_newer_than( $Author , $Time )
		{
			try
			{
				$Author = $this->Security->get( $Author , 'integer' );
				$Time = $this->Security->get( $Time , 'integer' );

				$Records = $this->CommentAccess->unsafe_select( 
					$this->CommentAccess->NativeTable.".author = $Author AND ".
					"DATE_ADD( creation_date , INTERVAL $Time SECOND ) > NOW()"
				);

				return( $Records );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>