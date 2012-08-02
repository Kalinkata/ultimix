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

	$PackageRelativePathCacheChanged = false;
	$PackageRelativePathCache = array();
	
	/**
	*	\~russian Функция предоставляет информацию о пути по которому установлен пакет.
	*
	*	@param $File - Путь к файлу с классом пакета.
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
	*	@param $File - Path to the file with package class.
	*
	*	@return Relative path from installation directory to the file $File.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_get_package_relative_path( $File )
	{
		global	$PackageRelativePathCache;
		if( isset( $PackageRelativePathCache[ $File ] ) )
		{
			return( $PackageRelativePathCache[ $File ] );
		}
		
		$RelativePath = '';		
		$Dir = dirname( $File );
		do
		{
			$RelativePath = '/packages/'.basename( $Dir ).$RelativePath;
			$Dir = dirname( dirname( $Dir ) );
		}
		while( file_exists( $Dir.'/../../packages/core/data/package_list' ) );
		
		global	$PackageRelativePathCacheChanged;
		$PackageRelativePathCacheChanged = true;

		return( $PackageRelativePathCache[ $File ] = '.'.$RelativePath );
	}
	
	$PackagePathCacheChanged = false;
	$PackagePathCache = array();
	
	/**
	*	\~russian Функция получения реального пути к запрашиваемому пакету.
	*
	*	@param $PackageName - имя пакета после применения рерайтов.
	*
	*	@param $PackageVersion - Реальная версия запрашиваемого пакета.
	*
	*	@return array( $PackageName , $PackageVersion ).
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns real path to the requested package directory.
	*
	*	@param $PackageName - package name after rewriting.
	*
	*	@param $PackageVersion - Package's real version.
	*
	*	@return array( $PackageName , $PackageVersion ).
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			get_top_data( $PackageName , $PackageVersion )
	{
		try
		{
			/**	\~russian оставляем только имя самого запрашиваемого пакета
				\~english cutting package's name*/
			$PackageName = explode( '::' , $PackageName );
			$PackageName = array_pop( $PackageName );

			/**	\~russian оставляем только имя самого запрашиваемого пакета
				\~english cutting package's name*/
			$PackageVersion = explode( '::' , $PackageVersion );
			$PackageVersion = array_pop( $PackageVersion );

			return( array( $PackageName , $PackageVersion ) );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

	$FetchPackagePathCacheChanged = false;
	$FetchPackagePathCache = array();

	/**
	*	\~russian Функция получения реального пути к запрашиваемому пакету.
	*
	*	@param $PackageName - Имя пакета после применения рерайтов.
	*
	*	@param $Version - Реальная версия запрашиваемого пакета.
	*
	*	@param $ROOT_DIR - корневая директория для поиска пакетов.
	*
	*	@return Реальный путь к запрашиваемому пакету.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns real path to the requested package directory.
	*
	*	@param $PackageName - Package name after rewriting.
	*
	*	@param $Version - Package's real version.
	*
	*	@param $ROOT_DIR - root directory for package search.
	*
	*	@return Real path to the requested package.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_fetch_package_path( $PackageName , $Version , $ROOT_DIR = INSTALL_DIR )
	{
		try
		{
			global			$PackagePathCache;

			$Info = _load_packages_list( $ROOT_DIR );

			$Version = _get_package_real_version( $PackageName , $Version , $ROOT_DIR );

			$PackageNameAndVersion = $PackageName.'.'.$Version;

			foreach( $Info as $pi )
			{
				if( $pi[ 0 ][ 0 ] === $PackageNameAndVersion[ 0 ] && strpos( $pi[ 0 ] , $PackageNameAndVersion ) === 0 )
				{
					return( $ROOT_DIR.'/packages/'.$pi[ 1 ] );
				}
			}

			throw( new Exception( 'Package '.$PackageName. ' with version '.$Version.' was not found' ) );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	/**
	*	\~russian Функция получения реального пути к запрашиваемому пакету.
	*
	*	@param $PackageName - имя пакета после применения рерайтов.
	*
	*	@param $PackageVersion - Реальная версия запрашиваемого пакета.
	*
	*	@param $ROOT_DIR - корневая директория для поиска пакетов.
	*
	*	@return Реальный путь к запрашиваемому пакету.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns real path to the requested package directory.
	*
	*	@param $PackageName - package name after rewriting.
	*
	*	@param $PackageVersion - Package's real version.
	*
	*	@param $ROOT_DIR - root directory for package search.
	*
	*	@return Real path to the requested package.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_get_package_path( $PackageName , $PackageVersion , $ROOT_DIR = INSTALL_DIR )
	{
		try
		{
			global	$PackagePathCache;
			$Key = "$PackageName $PackageVersion $ROOT_DIR";
			
			if( isset( $PackagePathCache[ $Key ] ) === false )
			{
				list( $PackageName , $PackageVersion ) = get_top_data( $PackageName , $PackageVersion );
				
				global	$PackagePathCacheChanged;
				$PackagePathCacheChanged = true;
				$PackagePathCache[ $Key ] = _fetch_package_path( $PackageName , $PackageVersion , $ROOT_DIR );
			}
			
			return( $PackagePathCache[ $Key ] );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	$RootDirCacheChanged = false;
	$RootDirCache = array();
	
	/**
	*	\~russian Функция получения реального пути к директории мастер-пакета, содержащего запрашиваемый пакет.
	*
	*	@param $thePackageName - имя пакета.
	*
	*	@param $thePackageVersion - Версия запрашиваемого пакета.
	*
	*	@param $ROOT_DIR - корневая директория для поиска пакетов.
	*
	*	@return array( $PackagePath , $PackageName , $PackageVersion )
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns real path to master-package's directory, wich contains requested packages.
	*
	*	@param $thePackageName - package name
	*
	*	@param $thePackageVersion - Package's version.
	*
	*	@param $ROOT_DIR - root directory for package search.
	*
	*	@return array( $PackagePath , $PackageName , $PackageVersion )
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_prepare_data( $thePackageName , $thePackageVersion , $ROOT_DIR = INSTALL_DIR )
	{
		try
		{
			$PackageNames = explode( '::' , $thePackageName );
			$PackageVersions = explode( '::' , $thePackageVersion );
			$PackageName = substr_replace( $thePackageName , '' , 0 , strlen( $PackageNames[ 0 ] ) + 2 );
			$PackageVersion = substr_replace( $thePackageVersion , '', 0 , strlen( $PackageVersions[ 0 ] ) + 2 );
			
			$PackagePath = _get_package_path( 
				$PackageNames[ 0 ] , 
				_get_package_real_version( $PackageNames[ 0 ] , $PackageVersions[ 0 ] , $ROOT_DIR ) , $ROOT_DIR
			);
			return( array( $PackagePath , $PackageName , $PackageVersion ) );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	/**
	*	\~russian Функция получения реального пути к директории мастер-пакета, содержащего запрашиваемый пакет.
	*
	*	@param $thePackageName - имя пакета.
	*
	*	@param $thePackageVersion - Версия запрашиваемого пакета.
	*
	*	@param $ROOT_DIR - корневая директория для поиска пакетов.
	*
	*	@return реальный путь к корневой директории.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns real path to master-package's directory, wich contains requested packages.
	*
	*	@param $thePackageName - package name
	*
	*	@param $thePackageVersion - Package's version.
	*
	*	@param $ROOT_DIR - root directory for package search.
	*
	*	@return Real path to the root directory.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_get_root_dir( $thePackageName , $thePackageVersion , $ROOT_DIR = INSTALL_DIR )
	{
		try
		{
			global $RootDirCacheChanged , $RootDirCache;
			$Key = "$thePackageName $thePackageVersion $ROOT_DIR";

			if( isset( $RootDirCache[ $Key ] ) == false )
			{
				list( $PackagePath , $PackageName , $PackageVersion ) = 
					_prepare_data( $thePackageName , $thePackageVersion , $ROOT_DIR );

				$RootDirCacheChanged = true;

				$RootDirCache[ $Key ] = $PackageName == '' ? $ROOT_DIR : _get_root_dir( 
					$PackageName , $PackageVersion , $PackagePath
				);
			}

			return( $RootDirCache[ $Key ] );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
?>