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

	require_once( dirname( __FILE__ ).'/include/php/settings.php' );
	
	require_once( dirname( __FILE__ ).'/include/php/core_utilities.php' );
	
	require_once( dirname( __FILE__ ).'/include/php/package_manipulation.php' );
	
	$PackageCache = array();
	
	$RequestedClassName = '';
	
	require_once( dirname( __FILE__ ).'/include/php/package_paths.php' );
	
	require_once( dirname( __FILE__ ).'/include/php/package_version.php' );
	
	/**
	*	\~russian Функция возвращает имя класса для указанного пакета.
	*
	*	@param $Name - Короткое имя класса.
	*
	*	@param $Version - Версия пакета.
	*
	*	@param $ROOT_DIR - Имя корневой директории, внутри которой будем осуществлять работу с пакетами.
	*
	*	@return Имя класса в указанном пакете.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns class name for the specified package.
	*
	*	@param $Name - Short name of the class.
	*
	*	@param $Version - Version of the package.
	*
	*	@param $ROOT_DIR - Name of the root directory. In this directory all package processing will be run.
	*
	*	@return Name of the class for the specified packkage.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_get_full_class_name( $Name , $Version , $ROOT_DIR )
	{
		try
		{	
			global	$FullClassNameCache;
			if( isset( $FullClassNameCache[ "$Name.$Version.$ROOT_DIR" ] ) )
			{
				return( $FullClassNameCache[ "$Name.$Version.$ROOT_DIR" ] );
			}

			$TopVersion = explode( '::' , $Version );
			$TopVersion = array_pop( $TopVersion );

			$RealPackageVersion = _get_package_real_version( $Name , $TopVersion , $ROOT_DIR );

			$PackageClassName = str_replace( '.' , '_' , $Name.'_'.$RealPackageVersion );

			global	$FullClassNameCacheChanged;
			$FullClassNameCacheChanged = true;

			return( $FullClassNameCache[ "$Name.$Version.$ROOT_DIR" ] = $PackageClassName );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

	$TopPackageNameCacheChanged = false;
	$TopPackageNameCache = array();

	/**
	*	\~russian Функция возвращает имя пакета по полному имени пакета.
	*
	*	@param $PackageName - Полное имя пакета.
	*
	*	@return Имя пакета по полному имени пакета.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns full package name by it's full package name.
	*
	*	@param $PackageName - Full package path.
	*
	*	@return Full package name by it's full package name.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_get_top_package_name( $PackageName )
	{
		try
		{
			global	$TopPackageNameCache;
			if( isset( $TopPackageNameCache[ $PackageName ] ) )
			{
				return( $TopPackageNameCache[ $PackageName ] );
			}

			$TopPackageName = explode( '::' , $PackageName );

			global	$TopPackageNameCacheChanged;
			$TopPackageNameCacheChanged = true;

			return( $TopPackageNameCache[ $PackageName ] = array_pop( $TopPackageName ) );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

	/**
	*	\~russian Функция возвращает имя запрошенного класса.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns real name of the requested class.
	*
	*	@author Dodonov A.A.
	*/
	function			_get_requested_class_name()
	{
		global	$RequestedClassName;

		return( $RequestedClassName );
	}

	/**
	*	\~russian Метка кэшированного объекта.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Label of the cached object.
	*
	*	@author Dodonov A.A.
	*/
	$ObjectLabel = 'default';
	
	/**
	*	\~russian Функция установки метки object объекта.
	*
	*	@param $theObjectLabel - Метка объекта.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function sets the label of the .
	*
	*	@param $theObjectLabel - Label of the object.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_set_object_label( $theObjectLabel )
	{
		try
		{
			global		$ObjectLabel;
			$ObjectLabel = $theObjectLabel;
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

	require_once( dirname( __FILE__ ).'/include/php/rewrites.php' );

	/**
	*	\~russian Функция получения реального пути к запрашиваемому пакету.
	*
	*	@param $PackageName - Имя пакета до применения рерайтов.
	*
	*	@param $PackageRealVersion - Реальная версия запрашиваемого пакета.
	*
	*	@return Реальный путь к запрашиваемому пакету.
	*
	*	@note Реальный путь к запрашиваемому пакету уже после всех рерайтов.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns real path to the requested package directory.
	*
	*	@param $PackageName - Package name before rewriting.
	*
	*	@param $PackageRealVersion - Package's real version.
	*
	*	@return Real path to the requested package.
	*
	*	@note Real path to the requested package after all rewrites were applied.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_get_package_path_ex( $PackageName , $PackageRealVersion )
	{
		try
		{
			list( $PackageName , $PackageRealVersion ) = _get_package_info_after_rewrites( 
				$PackageName , $PackageRealVersion , __FILE__
			);

			$ROOT_DIR = _get_root_dir( $PackageName , $PackageRealVersion , INSTALL_DIR );

			return( _get_package_path( $PackageName , $PackageRealVersion , $ROOT_DIR ) );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

	$PackagePathsCacheChanged = false;
	$PackagePathsCache = array();

	/**
	*	\~russian Получение информации о загружаемом скрипте.
	*
	*	@param $PackageName - Имя пакета.
	*
	*	@param $PackageVersion - Версия пакета.
	*
	*	@param $PackageScriptPath - Путь к файлу скрипта пакета.
	*
	*	@return Информация о скрипте.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Getting data about loading script.
	*
	*	@param $PackageName - Name of the package.
	*
	*	@param $PackageVersion - Package's version.
	*
	*	@param $PackageScriptPath - Path to the package's script.
	*
	*	@return Information about script.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_get_load_script_data( $PackageName , $PackageVersion , $PackageScriptPath )
	{
		try
		{
			$RootDirectory = _get_root_dir( $PackageName , $PackageVersion , INSTALL_DIR );
			$PackageDirectory = _get_package_path( $PackageName , $PackageVersion , $RootDirectory );
			$TopPackageName = _get_top_package_name( $PackageName );
			
			$PackageClassName = 'unexisting_class';
			$Exists = false;
			
			if( file_exists( $PackageDirectory.'/'.$TopPackageName.'.php' ) )
			{
				$PackageClassName = _get_full_class_name( $TopPackageName , $PackageVersion , $RootDirectory );
				$Exists = true;
			}
			
			return( 
				array( $PackageDirectory.'/'.$TopPackageName.'.php' , $Exists , $PackageClassName , $TopPackageName )
			);
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

	/**
	*	\~russian Добавление информации о пакете в кэш.
	*
	*	@param $PackageName - Имя пакета.
	*
	*	@param $PackageVersion - Версия пакета.
	*
	*	@param $PackageScriptPath - Путь к файлу скрипта пакета.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Additing information about package in the cache.
	*
	*	@param $PackageName - Name of the package.
	*
	*	@param $PackageVersion - Package's version.
	*
	*	@param $PackageScriptPath - Path to the package's script.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_fill_package_paths_data( $PackageName , $PackageVersion , $PackageScriptPath )
	{
		try
		{
			global		$ObjectLabel;
			$Key = "$PackageName $PackageVersion $ObjectLabel";

			global		$PackagePathsCache;

			list( $RPackageName , $RPackageVersion ) = _get_package_info_after_rewrites( 
				$PackageName , $PackageVersion , $PackageScriptPath
			);

			list( $ScriptPath , $Exists , $PackageClassName , $TopPackageName ) = _get_load_script_data( 
				$RPackageName , $RPackageVersion , $PackageScriptPath 
			);

			$PackagePathsCache[ $Key ] = array( 
				'path' => $ScriptPath , 'exists' => $Exists , 
				'class_name' => $PackageClassName , 'top_package_name' => $TopPackageName
			);
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

	/**
	*	\~russian Добавление информации о пакете в кэш.
	*
	*	@param $PackageName - Имя пакета.
	*
	*	@param $PackageVersion - Версия пакета.
	*
	*	@param $PackageScriptPath - Путь к файлу скрипта пакета.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Additing information about package in the cache.
	*
	*	@param $PackageName - Name of the package.
	*
	*	@param $PackageVersion - Package's version.
	*
	*	@param $PackageScriptPath - Path to the package's script.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_fill_package_paths_cache( $PackageName , $PackageVersion , $PackageScriptPath )
	{
		try
		{
			global		$ObjectLabel;
			$Key = "$PackageName $PackageVersion $ObjectLabel";

			global		$PackagePathsCache;
			if( isset( $PackagePathsCache[ $Key ] ) )return;

			_fill_package_paths_data( $PackageName , $PackageVersion , $PackageScriptPath );

			global		$PackagePathsCacheChanged;
			$PackagePathsCacheChanged = true;
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

	/**
	*	\~russian Выбираем пакет из кэша.
	*
	*	@param $PackageName - Имя пакета.
	*
	*	@param $PackageVersion - Версия пакета.
	*
	*	@param $PackageScriptPath - Путь к файлу скрипта пакета.
	*
	*	@return Информация о пакете.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Fetching package from cache.
	*
	*	@param $PackageName - Name of the package.
	*
	*	@param $PackageVersion - Package's version.
	*
	*	@param $PackageScriptPath - Path to the package's script.
	*
	*	@return Information about package.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_try_fetch_from_cache( $PackageName , $PackageVersion )
	{
		try
		{
			global		$ObjectLabel;
			$Key = "$PackageName $PackageVersion $ObjectLabel";
			
			global		$PackagePathsCache;
			if( isset( $PackagePathsCache[ $Key ] ) )
			{
				global		$PackageCache;
				if( isset( $PackageCache[ $PackagePathsCache[ $Key ][ 'path' ] ] ) )
				{
					global		$RequestedClassName;
					$RequestedClassName = $PackagePathsCache[ $Key ][ 'class_name' ];
					
					return( array( true , $PackageCache[ $PackagePathsCache[ $Key ][ 'path' ] ] ) );
				}
			}
			
			return( array( false , false ) );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

	/**
	*	\~russian Загрузка скрипта.
	*
	*	@param $PackageName - Имя пакета.
	*
	*	@param $PackageVersion - Версия пакета.
	*
	*	@return Название класса пакета.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Loading script.
	*
	*	@param $PackageName - Name of the package.
	*
	*	@param $PackageVersion - Package's version.
	*
	*	@return Package class name.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_package_script_fast_load( $PackageName , $PackageVersion )
	{
		try
		{
			/* на этом этапе мы уже знаем где лежит пакет $PackageName.$PackageVersion */
			global		$ObjectLabel;
			$Key = "$PackageName $PackageVersion $ObjectLabel";
		
			global		$PackagePathsCache;
			$PackageInfo = $PackagePathsCache[ $Key ];
			
			if( $PackageInfo[ 'exists' ] )
			{
				require_once( $PackageInfo[ 'path' ] );

				$RootDirectory = _get_root_dir( $PackageName , $PackageVersion , INSTALL_DIR );
				
				return( _get_full_class_name( $PackageInfo[ 'top_package_name' ] , $PackageVersion , $RootDirectory ) );
			}
			else
			{
				return( 'unexisting_class' );
			}
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

	/**
	*	\~russian Получение путей загрузки пакета.
	*
	*	@param $PackageName - Имя пакета.
	*
	*	@param $PackageVersion - Версия пакета.
	*
	*	@return Путь к пакету.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Getting package loading paths.
	*
	*	@param $PackageName - Name of the package.
	*
	*	@param $PackageVersion - Package's version.
	*
	*	@return Package path.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_get_package_directory( $PackageName , $PackageVersion )
	{
		try
		{
			$RootDirectory = _get_root_dir( $PackageName , $PackageVersion , INSTALL_DIR );
			$PackageDirectory = _get_package_path( $PackageName , $PackageVersion , $RootDirectory );
			$TopPackageName = _get_top_package_name( $PackageName );

			return( $PackageDirectory );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

	/**
	*	\~russian Заполнение кэша объектов.
	*
	*	@param $PackageClassName - Название класса.
	*
	*	@param $Key - Ключ кэша.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Filling package cache.
	*
	*	@param $PackageClassName - Class name.
	*
	*	@param $Key - Cache key.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_fill_package_cache( $PackageClassName , $Key )
	{
		try
		{
			global		$PackageCache;
			if( isset( $PackageCache[ $Key ] ) === false )
			{
				global		$RequestedClassName;
				$RequestedClassName = false;
				$PackageCache[ $Key ] = false;
				if( class_exists( $PackageClassName ) )
				{
					$PackageCache[ $Key ] = new $PackageClassName();
					$RequestedClassName = $PackageClassName;
				}
			}
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

	/**
	*	\~russian Сохранение объекта пакета в кэше.
	*
	*	@param $PackageClassName - Название класса.
	*
	*	@param $Key - Ключ кэша.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Getting package loading paths.
	*
	*	@param $PackageClassName - Class name.
	*
	*	@param $Key - Cache key.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_store_package_object( $PackageClassName , $Key )
	{
		try
		{
			_fill_package_cache( $PackageClassName , $Key );

			global		$PackageCache;
			global		$PackagePathsCache;
			if( isset( $PackagePathsCache[ $Key ] ) )
			{
				$PackageInfo = $PackagePathsCache[ $Key ];
				if( isset( $PackageCache[ $PackageInfo[ 'path' ] ] ) === false )
				{
					$PackageCache[ $PackageInfo[ 'path' ] ] = $PackageCache[ $Key ];
				}
			}
			else
			{
				throw( new Exception( "The path for key $Key does not exist" ) );
			}
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

	/**
	*	\~russian Сохранение путь пакета.
	*
	*	@param $PackageName - Имя пакета.
	*
	*	@param $PackageVersion - Версия пакета.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Saving package path.
	*
	*	@param $PackageName - Name of the package.
	*
	*	@param $PackageVersion - Package's version.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_store_package_path( $PackageName , $PackageVersion )
	{
		try
		{
			$PackageDirectory = _get_package_directory( $PackageName , $PackageVersion );
			
			global		$LoadedPackagesPaths;
			$LoadedPackagesPaths [ "$PackageName.$PackageVersion" ] = array( 
				'directory' => $PackageDirectory , 'package_name' => $PackageName , 'package_version' => $PackageVersion
			);
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

	/**
	*	\~russian Функция предоставляет информацию о пути по которому установлен пакет.
	*
	*	@param $PackageName - Название пакета.
	*
	*	@param $PackageVersion - Версия пакета.
	*
	*	@return относительный путь от корня директории установки для файла $File.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function provides information about package's installation path.
	*
	*	@param $PackageName - Package name.
	*
	*	@param $PackageVersion - Package version.
	*
	*	@return Relative path from installation directory to the file $File.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_get_package_relative_path_ex( $PackageName , $PackageVersion )
	{
		try
		{
			return( 
				_get_package_relative_path( _get_package_path_ex( $PackageName , $PackageVersion ).'/unexisting_file' )
			);
		}
		catch( Exception $e )
		{
			$Args = func_get_args();
			_throw_exception_object( __FUNCTION__ , $Args , $e );
		}
	}

	require_once( dirname( __FILE__ ).'/include/php/core_cache.php' );	
	require_once( dirname( __FILE__ ).'/include/php/functional_programming.php' );
	require_once( dirname( __FILE__ ).'/include/php/array_functions.php' );
	require_once( dirname( __FILE__ ).'/include/php/core_public_api.php' );

?>