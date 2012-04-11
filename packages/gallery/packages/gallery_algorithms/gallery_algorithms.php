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
	*	\~russian Класс для работы с галереями.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides galeries manipulation routine.
	*
	*	@author Dodonov A.A.
	*/
	class	gallery_algorithms_1_0_0{
	
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
		var					$FileInputAccess = false;
		var					$GalleryAccess = false;
		var					$Link = false;
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
				$this->FileInputAccess = get_package( 'file_input::file_input_access' , 'last' , __FILE__ );
				$this->GalleryAccess = get_package( 'gallery::gallery_access' , 'last' , __FILE__ );
				$this->Link = get_package( 'link' , 'last' , __FILE__ );
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
				
				$Records = $this->GalleryAccess->unsafe_select( $this->GalleryAccess->NativeTable.".id = $id" );
				
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
				
				$Records = $this->GalleryAccess->unsafe_select( $this->GalleryAccess->NativeTable.".id = $id" );
				
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
		*	\~russian Получение списка файлов галереи.
		*
		*	@param $gid - Идентификатор галереи.
		*
		*	@return Список файлов галереи.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns gallery's files.
		*
		*	@param $gid - Gallery's id.
		*
		*	@return List of gallery files.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_gallery_files( $gid )
		{
			try
			{
				$gid = $this->Security->get( $gid , 'integer' );
				
				$Links = $this->Link->get_links( $gid , false , 'gallery' , 'file' );
				
				$Ids = get_field_ex( $Links , 'object2_id' );
				
				if( isset( $Ids[ 0 ] ) )
				{
					return( $this->FileInputAccess->unsafe_select( 'id IN ( '.implode( ',' , $Ids ).' )' ) );
				}
				else
				{
					return( array() );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Добавление файла в галлерею.
		*
		*	@param $gid - Идентификатор галереи.
		*
		*	@param $fid - Идентификатор файла.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function adds file to the gallery.
		*
		*	@param $gid - Gallery's id.
		*
		*	@param $fid - File's id.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			attach_file( $gid , $fid )
		{
			try
			{
				$gid = $this->Security->get( $gid , 'integer' );
				$fid = $this->Security->get( $fid , 'integer' );

				$this->Link->create_link( $gid, $fid , 'gallery' , 'file' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Удаление файла из галлереи.
		*
		*	@param $gid - Идентификатор галереи.
		*
		*	@param $fid - Идентификатор файла.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function deletes file from the gallery.
		*
		*	@param $gid - Gallery's id.
		*
		*	@param $fid - File's id.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			detach_file( $gid , $fid )
		{
			try
			{
				$gid = $this->Security->get( $gid , 'integer' );
				$fid = $this->Security->get( $fid , 'integer' );

				$this->Link->delete_link( $gid, $fid , 'gallery' , 'file' );
				
				$FileInputAccess = get_package( 'file_input::file_input_access' , 'last' , __FILE__ );
				$FileInputAccess->delete( $fid );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>