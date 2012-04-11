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
	*	\~russian Алгоритмы для работы с файлами.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides file algorithms.
	*
	*	@author Dodonov A.A.
	*/
	class	file_input_algorithms_1_0_0{
	
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
		var					$FileInputAccess = false;
		var					$Security = false;

		var					$Extensions = array();
		
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
				$this->FileInputAccess = get_package( 'file_input::file_input_access' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				
				$this->Extensions[ 'default' ] = array( 'jpg' , 'jpeg' , 'gif' , 'bmp' , 'png' , 'tif' , 
					'tiff' , 'doc' , 'docx' , 'ppt' , 'pptx' , 'rtf' , 'xls' , 'xslx' , 'pdf'
				);
												
				$this->Extensions[ 'images' ] = array( 
					'jpg' , 'jpeg' , 'gif' , 'bmp' , 'png' , 'tiff' , 'tif'
				);
				
				$this->Extensions[ 'archives' ] = array( 
					'zip' , '7zip' , 'gz' , 'gz2' , 'tar' , 'rar' , 'arc'
				);
				
				$this->Extensions[ 'all' ] = array( '*' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция получения списка расширений.
		*
		*	@param $Type - Тип загружаемых файлов.
		*
		*	@param $AsString - Тип возвращаемого значения.
		*
		*	@return Список расширений.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a list of the uploading files.
		*
		*	@param $Type - Type of uploading files.
		*
		*	@param $AsString - Type of the return value.
		*
		*	@return List of extensions.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_extensions( $Type , $AsString = false )
		{
			try
			{
				$Extensions = array();
				
				if( isset( $this->Extensions[ $Type ] ) === false )
				{
					throw( new Exception( "File type \"$Type\" is undefined" ) );
				}
				
				return( 
					$AsString ? '*.'.implode( ';*.' , $this->Extensions[ $Type ] ) : $this->Extensions[ $Type ] 
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения фильтра.
		*
		*	@param $Type - Тип загружаемых файлов.
		*
		*	@return Фильтр.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns filter.
		*
		*	@param $Type - Type of uploading files.
		*
		*	@return Filter.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_file_filters( $Type )
		{
			try
			{
				$FileExtensions = $this->get_extensions( $Type , true );
					
				if( $Type == 'default' )
				{
					$FileDescription = 'Supported types';
				}
				elseif( $Type == 'images' )
				{
					$FileDescription = 'Images';
				}
				elseif( $Type == 'archives' )
				{
					$FileDescription = 'Zip archives';
				}
				elseif( $Type == 'all' )
				{
					$FileDescription = 'All files';
				}
				
				return( array( $FileExtensions , $FileDescription ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция возвращает запись по идентификатору.
		*
		*	@param $id - Идентфиикатор искомой записи.
		*
		*	@return Запись.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns record by it's id.
		*
		*	@param $id - Id of the searching record.
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
				
				$Records = $this->FileInputAccess->unsafe_select( "id = $id" );

				if( count( $Records ) !== 1 )
				{
					throw( new Exception( 'An error occured while record fetching' ) );
				}
				else
				{
					return( $Records[ 0 ] );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>