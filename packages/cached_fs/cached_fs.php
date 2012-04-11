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
	*	\~russian Класс для работы с виртуальной файловой системой.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides virtual FS manipulation routine.
	*
	*	@author Dodonov A.A.
	*/
	class	cached_fs_1_0_0{
		
		/**
		*	\~russian Список подмонтированных хранилищ.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english List of the mounted storages.
		*
		*	@author Dodonov A.A.
		*/
		var					$MountedStorages = false;
		
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
		var					$Cache;
		
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
		function			cached_fs_1_0_0()
		{
			try
			{
				$this->Cache = get_package( 'cache' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Переустановка настроек.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function resets settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			reset()
		{
			try
			{
				$this->Cache->reset();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Сохранение информации о том чуществует ли файл.
		*
		*	@param $OriginalFilePath - Путь к запрашиваемому файлу.
		*
		*	@param $ExistsFlag - Информация о существовании.
		*
		*	@return - true если файл существует, false если не существует.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function stores info if the file exists.
		*
		*	@param $OriginalFilePath - Path to the requesting file.
		*
		*	@param $ExistsFlag - Информация о существовании.
		*
		*	@return true if the file exists, otherwise false.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			store_file_exists_info( $OriginalFilePath , $ExistsFlag )
		{
			try
			{
				if( $ExistsFlag !== false )
				{
					return( true );
				}
				else
				{
					$this->Cache->add_data( $OriginalFilePath , '_file_was_not_found' );
					return( false );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция проверки существует ли файл.
		*
		*	@param $OriginalFilePath - Путь к запрашиваемому файлу.
		*
		*	@return - true если файл существует, false если не существует.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates if the file exists.
		*
		*	@param $OriginalFilePath - Path to the requesting file.
		*
		*	@return true if the file exists, otherwise false.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			file_exists( $OriginalFilePath )
		{
			try
			{
				$OriginalFilePath = str_replace( '/./' , '/' , $OriginalFilePath );
				$Data = $this->Cache->get_data( $OriginalFilePath );
				
				if( $Data === false )
				{
					return( $this->store_file_exists_info( $OriginalFilePath , file_exists( $OriginalFilePath ) ) );
				}
				else
				{
					return( $Data == '_file_was_not_found' ? false : true );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Кэшированный ввод из файла.
		*
		*	@param $OriginalFilePath - путь к запрашиваемому файлу.
		*
		*	@return Содержимое файла.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached input from file.
		*
		*	@param $OriginalFilePath path to the requesting file.
		*
		*	@return File's content.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			file_get_contents( $OriginalFilePath )
		{
			try
			{
				$OriginalFilePath = str_replace( '/./' , '/' , $OriginalFilePath );
				$Data = $this->Cache->get_data( $OriginalFilePath );
				if( $Data !== false )
				{
					return( $Data );
				}
				else
				{
					$Data = @file_get_contents( $OriginalFilePath );
					if( $Data !== false )
					{
						$this->Cache->add_data( $OriginalFilePath , $Data );
						return( $Data );
					}
					else
					{
						throw( new Exception( "File $OriginalFilePath was not found" ) );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Кэшированный ввод из файла.
		*
		*	@param $OriginalFilePath - путь к запрашиваемому файлу.
		*
		*	@param Data - Содержимое файла для сохранения.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached input from file.
		*
		*	@param $OriginalFilePath path to the requesting file.
		*
		*	@param Data - File's content to store.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			file_put_contents( $OriginalFilePath , $Data )
		{
			try
			{
				$OriginalFilePath = str_replace( '/./' , '/' , $OriginalFilePath );
				if( $this->Cache->data_exists( $OriginalFilePath ) )
				{
					$this->Cache->set_data( $OriginalFilePath , $Data );
				}
				else
				{
					$this->Cache->add_data( $OriginalFilePath , $Data );
				}
				
				@file_put_contents( $OriginalFilePath , $Data );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция сохраняет все данные на диск.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function flushes all data on disk.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			flush()
		{
			try
			{
				$this->Cache->flush();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>