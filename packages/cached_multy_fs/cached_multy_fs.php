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
	class	cached_multy_fs_1_0_0{

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
		*	\~russian Алгоритмы работы со строками.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english String processing algorithms.
		*
		*	@author Dodonov A.A.
		*/
		var					$Cache = false;
		var					$CachedFS = false;
		var					$String = false;
		var					$Text = false;

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
		function			__construct()
		{
			try
			{
				$this->Cache = get_package( 'cache' , 'last' , __FILE__ );
				$this->CachedFS = get_package( 'cached_fs' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Text = get_package( 'string::text' , 'last' , __FILE__ );
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
		*	\~russian Функция инициализирует список хранилищ файлов.
		*
		*	@param $FilePath - Путь к файлу.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads the list of mounted storages.
		*
		*	@param $FilePath - Path to file.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_mounted_storages_from_file( $FilePath )
		{
			try
			{
				$this->MountedStorages = @file_get_contents( $FilePath );
				if( $this->MountedStorages !== false )
				{
					$this->Cache->add_data( $FilePath , $this->MountedStorages );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция инициализирует список хранилищ файлов.
		*
		*	@param $FilePath - Путь к файлу.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads the list of mounted storages.
		*
		*	@param $FilePath - Path to file.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_mounted_storages_from_file( $FilePath )
		{
			try
			{
				$Data = $this->Cache->get_data( $FilePath );
				if( $Data !== false )
				{
					$this->MountedStorages = $Data;
				}
				else
				{
					$this->get_mounted_storages_from_file( $FilePath );
				}

				$this->MountedStorages = str_replace( "\r" , "\n" , $this->MountedStorages );
				$this->MountedStorages = str_replace( "\n\n" , "\n" , $this->MountedStorages );
				$this->MountedStorages = explode( "\n" , $this->MountedStorages );
				foreach( $this->MountedStorages as $i => $v )
				{
					$this->MountedStorages[ $i ] = dirname( __FILE__ ).'/../../'.$this->MountedStorages[ $i ];
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция загрузки списак хранилищ файлов, если необходимо.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads the list of mounted storages, if necessary.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_mounted_storages_if_necessary()
		{
			try
			{
				if( $this->MountedStorages === false )
				{
					if( file_exists( dirname( __FILE__ ).'/conf/'.DOMAIN.'.cf_data_storages' ) )
					{
						$StoragesConfig = dirname( __FILE__ ).'/conf/'.DOMAIN.'.cf_data_storages';
						$this->load_mounted_storages_from_file( $StoragesConfig );
					}
					else
					{
						$this->load_mounted_storages_from_file( dirname( __FILE__ ).'/conf/cf_data_storages' );
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки ошибки.
		*
		*	@param $ThrowException - Кидать ли исключение если файл не найден.
		*
		*	@return false
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes error.
		*
		*	@param $ThrowException - Should be exception be thrown if the requested file was not found.
		*
		*	@return false
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	handle_file_was_not_found_error( $ThrowException )
		{
			try
			{
				if( $ThrowException )
				{
					throw( new Exception( "File $FilePath was not found" ) );
				}
				else
				{
					return( false );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция возвращает путь файла из хранилища.
		*
		*	@param $FilePath - Путь к файлу.
		*
		*	@param $ThrowException - Кидать ли исключение если файл не найден.
		*
		*	@return Путь к файлу.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns file path from storage.
		*
		*	@param $FilePath - Path to file.
		*
		*	@param $ThrowException - Should be exception be thrown if the requested file was not found.
		*
		*	@return Path to file.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_file_path( $FilePath , $ThrowException = true )
		{
			try
			{
				$this->load_mounted_storages_if_necessary();

				$FilePath = str_replace( '/./' , '/' , $FilePath );

				$FileName = basename( $FilePath );
				foreach( $this->MountedStorages as $ms )
				{
					if( file_exists( $ms.'/'.$FileName ) )
					{
						return( $ms.'/'.$FileName );
					}
				}

				if( file_exists( $FilePath ) )
				{
					return( $FilePath );
				}

				return( $this->handle_file_was_not_found_error( $ThrowException ) );
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
				$Data = $this->Cache->get_data( $OriginalFilePath );

				if( $Data === false )
				{
					$FilePath = $this->get_file_path( $OriginalFilePath , false );

					return( $this->CachedFS->store_file_exists_info( $OriginalFilePath , $FilePath ) );
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
		*	\~russian Преобразование загружаемого файла.
		*
		*	@param $Data - Загруженный файл.
		*
		*	@param $Mode - Режим обработки загруженного файла.
		*
		*	@return Содержимое файла.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function transforms loaded file.
		*
		*	@param $Data - Loaded file.
		*
		*	@param $Mode - Processing mode of the loaded file.
		*
		*	@return File's content.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			transform_file_contents( $Data , $Mode )
		{
			try
			{
				if( $Mode == 'cleaned' )
				{
					$Data = str_replace( "\r" , "\n" , $Data );
					$Data = str_replace( "\n\n" , "\n" , $Data );
					$Data = $this->Text->remove_bom( $Data );
				}

				if( $Mode == 'exploded' )
				{
					$Data = str_replace( "\r" , "\n" , $Data );
					$Data = str_replace( "\n\n" , "\n" , $Data );
					$Data = explode( "\n" , $Data );
				}

				return( $Data );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Кэшированный ввод из файла.
		*
		*	@param $OriginalFilePath - Путь к запрашиваемому файлу.
		*
		*	@param $Mode - Режим обработки загруженного файла.
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
		*	@param $OriginalFilePath - Path to the requesting file.
		*
		*	@param $Mode - Processing mode of the loaded file.
		*
		*	@return File's content.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			file_get_contents( $OriginalFilePath , $Mode = 'none' )
		{
			try
			{
				$Data = $this->Cache->get_data( $OriginalFilePath );
				if( $Data === false )
				{
					$Data = @file_get_contents( $this->get_file_path( $OriginalFilePath ) );
					if( $Data === false )
					{
						$Data = '';
					}
					$this->Cache->add_data( $OriginalFilePath , $Data );
				}

				if( $Mode !== 'none' )
				{
					$Data = $this->transform_file_contents( $Data , $Mode );
				}

				return( $Data );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Кэшированный ввод из составного файла.
		*
		*	@param $OriginalFilePath - Путь к запрашиваемому файлу.
		*
		*	@param $Mode - Режим обработки загруженного файла.
		*
		*	@return Содержимое файла.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached input from compound file.
		*
		*	@param $OriginalFilePath - path to the requesting file.
		*
		*	@param $Mode - Processing mode of the loaded file.
		*
		*	@return File's content.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compound_file_get_contents( $OriginalFilePath , $Mode = 'none' )
		{
			try
			{
				$Data = $this->Cache->get_data( $OriginalFilePath );
				if( $Data === false )
				{
					$FileName = basename( $OriginalFilePath );
					$FileContent = '';
					if( file_exists( $OriginalFilePath ) )
					{
						$FileContent .= file_get_contents( $OriginalFilePath );
					}
					foreach( $this->MountedStorages as $ms )
					{
						if( file_exists( $ms.'/'.$FileName ) )
						{
							$FileContent .= file_get_contents( $ms.'/'.$FileName );
						}
					}
					$this->Cache->add_data( $OriginalFilePath , $FileContent );
				}
				$Data = $this->transform_file_contents( $Data , $Mode );

				return( $Data );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Кэшированный ввод из файла.
		*
		*	@param $OriginalFilePath - Путь к запрашиваемому файлу.
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
				if( $this->Cache->data_exists( $OriginalFilePath ) )
				{
					$this->Cache->set_data( $OriginalFilePath , $Data );
				}
				else
				{
					$this->Cache->add_data( $OriginalFilePath , $Data );
				}

				$FilePath = $this->get_file_path( $OriginalFilePath , false );

				@file_put_contents( $FilePath === false ? $OriginalFilePath : $FilePath , $Data );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция загрузки шаблона.
		*
		*	@param $PackagePath - Путь к пакету.
		*
		*	@param FileName - Файл шаблона.
		*
		*	@return Содержимое шаблона.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads template.
		*
		*	@param $PackagePath - Path to the package.
		*
		*	@param FileName - Template file name.
		*
		*	@return Template file content.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_template( $PackagePath , $FileName )
		{
			try
			{
				return( $this->file_get_contents( dirname( $PackagePath )."/res/templates/$FileName" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция загрузки конфига.
		*
		*	@param $PackagePath - Путь к пакету.
		*
		*	@param FileName - Файл конфига.
		*
		*	@return Содержимое конфига.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads config.
		*
		*	@param $PackagePath - Path to the package.
		*
		*	@param FileName - Config file name.
		*
		*	@return Config file content.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_config( $PackagePath , $FileName )
		{
			try
			{
				return( $this->file_get_contents( dirname( $PackagePath )."/conf/$FileName" , 'cleaned' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция загрузки данных.
		*
		*	@param $PackagePath - Путь к пакету.
		*
		*	@param FileName - Файл данных.
		*
		*	@param $Mode - Режим обработки загруженного файла.
		*
		*	@return Содержимое файла с данными.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads data file.
		*
		*	@param $PackagePath - Path to the package.
		*
		*	@param FileName - Data file name.
		*
		*	@param $Mode - Processing mode of the loaded file.
		*
		*	@return Data file content.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_data( $PackagePath , $FileName , $Mode = 'none' )
		{
			try
			{
				return( $this->file_get_contents( dirname( $PackagePath )."/data/$FileName" , $Mode ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция загрузки шаблона.
		*
		*	@param $PackageName - Название пакета.
		*
		*	@param $PackageVersion - Версия пакета.
		*
		*	@param FileName - Файл шаблона.
		*
		*	@return Содержимое шаблона.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads template.
		*
		*	@param $PackageName - Package name.
		*
		*	@param $PackageVersion - Package version.
		*
		*	@param FileName - Template file name.
		*
		*	@return Template file content.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_package_template( $PackageName , $PackageVersion , $FileName )
		{
			try
			{
				$PackagePath = _get_package_relative_path_ex( $PackageName , $PackageVersion );

				return( $this->file_get_contents( "$PackagePath/res/templates/$FileName" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция загрузки конфига.
		*
		*	@param $PackageName - Название пакета.
		*
		*	@param $PackageVersion - Версия пакета.
		*
		*	@param FileName - Файл конфига.
		*
		*	@return Содержимое конфига.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads config.
		*
		*	@param $PackageName - Package name.
		*
		*	@param $PackageVersion - Package version.
		*
		*	@param FileName - Config file name.
		*
		*	@return Config file content.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_package_config( $PackageName , $PackageVersion , $FileName )
		{
			try
			{
				$PackagePath = _get_package_relative_path_ex( $PackageName , $PackageVersion );

				return( $this->file_get_contents( "$PackagePath/conf/$FileName" , 'cleaned' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция загрузки данных.
		*
		*	@param $PackageName - Название пакета.
		*
		*	@param $PackageVersion - Версия пакета.
		*
		*	@param FileName - Файл данных.
		*
		*	@param $Mode - Режим обработки загруженного файла.
		*
		*	@return Содержимое файла с данными.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads data file.
		*
		*	@param $PackageName - Package name.
		*
		*	@param $PackageVersion - Package version.
		*
		*	@param FileName - Data file name.
		*
		*	@param $Mode - Processing mode of the loaded file.
		*
		*	@return Data file content.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_package_data( $PackageName , $PackageVersion , $FileName , $Mode = 'none' )
		{
			try
			{
				$PackagePath = _get_package_relative_path_ex( $PackageName , $PackageVersion );

				return( $this->file_get_contents( "$PackagePath/data/$FileName" , $Mode ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение списка подмонтированных директорий.
		*
		*	@return Список подмонтированных директорий.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a list of mounted directories.
		*
		*	@return A list of mounted directories.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	Dodonov A.A.
		*/
		function			get_mounted_storages()
		{
			try
			{
				return( $this->MountedStorages );
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
		*	Dodonov A.A.
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