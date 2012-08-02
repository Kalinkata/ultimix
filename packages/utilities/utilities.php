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
	*	\~russian Утилиты.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Utilities.
	*
	*	@author Dodonov A.A.
	*/
	class	utilities_1_0_0{

		/**
		*	\~russian Обработка найденного файла.
		*
		*	@param $Files - Found files.
		*
		*	@param $Path - Путь к сканируемой директории.
		*
		*	@param $File - Найденный файл.
		*
		*	@param $Mask - Маска для отбора файлов.
		*
		*	@param $Recursive - Рекурсивный обход директорий.
		*
		*	@return Массив с путями к файлам.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes found file.
		*
		*	@param $Files - Found files.
		*
		*	@param $Path - Path to the directory.
		*
		*	@param $File - Found file.
		*
		*	@param $Mask - File filtering mask.
		*
		*	@param $Recursive - Recursive directory parsing.
		*
		*	@return Array with file paths.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			read_file( $Files , $Path , $File , $Mask = '/.+/' , $Recursive = true )
		{
			try
			{
				if( $File != "." && $File != ".." && $File != 'index.html' )
				{
					$FullPath = $Path.$File;
					
					if( $Recursive && is_dir( $FullPath ) )
					{
						$Files = array_merge( 
							$Files , 
							$this->get_files_from_directory( $FullPath , $Mask , $Recursive ) 
						);
					}
					elseif( preg_match( $Mask , $FullPath ) )
					{
						$Files [] = $FullPath;
					}
				}
				
				return( $Files );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Выборка всех файлов из директории.
		*
		*	@param $Path - Путь к сканируемой директории.
		*
		*	@param $Mask - Маска для отбора файлов.
		*
		*	@param $Recursive - Рекурсивный обход директорий.
		*
		*	@return Массив с путями к файлам.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns all files from the defined directory.
		*
		*	@param $Path - Path to the directory.
		*
		*	@param $Mask - File filtering mask.
		*
		*	@param $Recursive - Recursive directory parsing.
		*
		*	@return Array with file paths.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_files_from_directory( $Path , $Mask = '/.+/' , $Recursive = true )
		{
			try
			{
				$Path = rtrim( $Path , '/' ).'/';
				
				$Handle = @opendir( $Path );
				$Files = array();
				
				if( $Handle !== false )
				{
					for( ; false !== ( $File = readdir( $Handle ) ) ; )
					{
						$Files = $this->read_file( $Files , $Path , $File , $Mask , $Recursive );
					}
					
					closedir( $Handle );
				}
				
				return( $Files );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция архивации директории.
		*
		*	@param $Directory - Архивируемая директория.
		*
		*	@param ArchivePath - Путь к архиву.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function archives directory.
		*
		*	@param $Directory - Directory to be archived.
		*
		*	@param ArchivePath - Path to the archive.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			zip_directory( $Directory , $ArchivePath )
		{
			try
			{
				$Files = $this->get_files_from_directory( $Directory );
				
				$Text = get_package( 'string::text' , 'last' , __FILE__ );
				$Files = $Text->trim_common_prefix( $Files );
				
				$Zip = new ZipArchive;
				$Zip->open( "$ArchivePath" , ZIPARCHIVE::CREATE );
				foreach( $Files as $i => $File )
				{
					$Zip->addFile( "$Directory/$File" , $File );
				}
				$Zip->close();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция запаковки параметров в URL.
		*
		*	@param $Params - Параметры для запаковки.
		*
		*	@param $Exceptions - Список параметров, которые упаковывать не надо
		*
		*	@return URL с параметрами.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function packs parameters into URL.
		*
		*	@param $Params - Paramateres for packing.
		*
		*	@param $Exceptions - List of the excluding parameters.
		*
		*	@return URL with parameters.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			pack_into_url( $Params , $Exceptions )
		{
			try
			{
				$Tmp = array();
				
				foreach( $Params as $k => $v )
				{
					if( in_array( $k , $Exceptions ) === false )
					{
						$Tmp [] = "$k=$v";
					}
				}
				
				return( implode( '&' , $Tmp ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка пакета.
		*
		*	@param $Settings - Параметры выборки.
		*
		*	@param $File - Путь к файлу.
		*
		*	@param $Prefix - Префикс полей.
		*
		*	@return Пакет.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method returns package.
		*
		*	@param $Settings - Fetch parameters.
		*
		*	@param $File - File path.
		*
		*	@param $Prefix - Settings names prefix.
		*
		*	@return Package.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_package( &$Settings , $File , $Prefix = '' )
		{
			try
			{
				$PackageName = $Settings->get_setting( $Prefix.'package_name' );
				
				$PackageVersion = $Settings->get_setting( $Prefix.'package_version' , 'last' );
				
				return( get_package( $PackageName , $PackageVersion , $File ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка записей.
		*
		*	@param $Settings - Параметры выборки.
		*
		*	@return Записи.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function selects records.
		*
		*	@param $Settings - Settings.
		*
		*	@return Records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_records( &$Settings )
		{
			try
			{
				$Query = $this->Settings->get_setting( 'query' , false );
				if( $Query )
				{
					$this->Database->query_as( DB_OBJECT );
					$Records = $this->Database->query( $Query );
					return( $this->Database->fetch_results( $Records ) );
				}
				else
				{
					$Package = $this->get_package( $Settings , __FILE__ );
					$FunctionName = $Settings->get_setting( 'access_function_name' , 'simple_select' );
					if( method_exists( $Package , $FunctionName ) )
					{
						return( call_user_func( array( $Package , $FunctionName ) ) );
					}
				}
				throw( new Exception( "Can't get records" ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Определение браузера.
		*
		*	@return Название браузера.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@note Возвращает 'ie' если не удалось определить браузер.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function detects browser.
		*
		*	@return Browser name.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@note The function will return 'ie' if the browser was not detected.
		*
		*	@author Dodonov A.A.
		*/
		function			detect_browser()
		{
			try
			{
				$UserAgent = $_SERVER['HTTP_USER_AGENT'];

				if( stristr( $UserAgent , 'Firefox' ) !== false )
				{
					return( 'firefox' );
				}
				elseif( stristr( $UserAgent , 'Chrome' ) !== false )
				{
					return( 'chrome' );
				}
				elseif( stristr( $UserAgent , 'Safari' ) !== false )
				{
					return( 'safari' );
				}
				elseif( stristr( $UserAgent , 'Opera' ) !== false )
				{
					return( 'opera' );
				}

				return( 'ie' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>