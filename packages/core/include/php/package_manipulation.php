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
	*	\~russian Функция возвращает список пакетов.
	*
	*	@param $ROOT_DIR - Имя корневой директории, внутри которой будем осуществлять работу с пакетами.
	*
	*	@return Список пакетов.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns a list of installed packages.
	*
	*	@param $ROOT_DIR - Name of the root directory. In this directory all package processing will be run.
	*
	*	@return List of packages.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_load_packages_list( $ROOT_DIR = INSTALL_DIR )
	{
		try
		{
			$File = _file_get_contents( $ROOT_DIR.'/packages/core/data/package_list' );
			if( $File === false )
			{
				throw( 
					new Exception( 'An error occured while loading file '.$ROOT_DIR.'/packages/core/data/package_list' )
				);
			}

			$File = str_replace( "\r" , "\n" , $File );
			$File = str_replace( "\n\n" , "\n" , $File );
			$PackagesInfo = explode( "\n" , $File );

			$PackageList = array();

			foreach( $PackagesInfo as $pi )
			{
				$PackageList [] = explode( '#' , $pi );
				$tmp = explode( '#' , $pi );
			}

			return( $PackageList );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	/**
	*	\~russian Получение версии пакета и названия.
	*
	*	@param $RootPackage - Внешний пакет.
	*
	*	@param $RootVersion - Версия внешнего пакета.
	*
	*	@return Версия пакета и название.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns package name and version.
	*
	*	@param $ROOT_DIR - Name of the root directory. In this directory all package processing will be run.
	*
	*	@param $RootPackage - Root package.
	*
	*	@param $RootVersion - Version of the root package
	*
	*	@return Package name and version.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_get_name_and_version( $RootPackage = '' , $RootVersion = '' )
	{
		try
		{
			if( $RootPackage == '' )
			{
				$PackageNamePrefix = '';
			}
			else
			{
				$PackageNamePrefix = $RootPackage.'::';
			}
			
			if( $RootVersion == '' )
			{
				$PackageVersionPrefix = '';
			}
			else
			{
				$PackageVersionPrefix = $RootVersion.'::';
			}
			
			return( array( $PackageNamePrefix , $PackageVersionPrefix ) );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

	/**
	*	\~russian Функция возвращает список пакетов.
	*
	*	@param $RetArray - Уже выбранные пакеты.
	*
	*	@param $ROOT_DIR - Имя корневой директории, внутри которой будем осуществлять работу с пакетами.
	*
	*	@param $p - Информация об обрабатываемом пакете.
	*
	*	@param $PackageNamePrefix - Префикс названия пакета.
	*
	*	@param $PackageVersionPrefix - Префикс версии пакета.
	*
	*	@return Список пакетов.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns a list of installed packages.
	*
	*	@param $RetArray - Already fetched packages.
	*
	*	@param $ROOT_DIR - Root directory path.
	*
	*	@param $p - Processing package's info.
	*
	*	@param $PackageNamePrefix - Package name prefix.
	*
	*	@param $PackageVersionPrefix - Package version prefix.
	*
	*	@return List of packages.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_fetch_subpackages_list( $RetArray , $ROOT_DIR , $p , 
																			$PackageNamePrefix , $PackageVersionPrefix )
	{
		try
		{
			$InfoParts = explode( '.' , $p[ 0 ] );
			$RetArray [] = array( 
				'package_name' => $PackageNamePrefix.$InfoParts[ 0 ] , 
				'package_version' => $PackageVersionPrefix.$InfoParts[ 1 ].'.'.$InfoParts[ 2 ].'.'.$InfoParts[ 3 ]
			);

			if( file_exists( $ROOT_DIR.'/packages/'.$p[ 1 ].'/packages/core/data/package_list' ) )
			{
				$Name = $PackageNamePrefix.$InfoParts[ 0 ];
				$Version = $PackageVersionPrefix.$InfoParts[ 1 ].'.'.$InfoParts[ 2 ].'.'.$InfoParts[ 3 ];
				$RetArray = array_merge( 
					$RetArray , _get_packages_list( $ROOT_DIR.'/packages/'.$p[ 1 ] , $Name , $Version )
				);
			}

			return( $RetArray );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

	/**
	*	\~russian Функция возвращает список пакетов.
	*
	*	@param $ROOT_DIR - Имя корневой директории, внутри которой будем осуществлять работу с пакетами.
	*
	*	@param $RootPackage - Внешний пакет.
	*
	*	@param $RootVersion - Версия внешнего пакета.
	*
	*	@return Список пакетов в формате array( 0 => 'id' , 1 => 'package_name' , 2 => 'package_version' ).
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function returns a list of installed packages.
	*
	*	@param $ROOT_DIR - Name of the root directory. In this directory all package processing will be run.
	*
	*	@param $RootPackage - Root package.
	*
	*	@param $RootVersion - Version of the root package
	*
	*	@return List of packages.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_get_packages_list( $ROOT_DIR = INSTALL_DIR , $RootPackage = '' , $RootVersion = '' )
	{
		try
		{
			$PackageList = _load_packages_list( $ROOT_DIR );

			list( $PackageNamePrefix , $PackageVersionPrefix ) = _get_name_and_version( $RootPackage , $RootVersion );

			$RetArray = array();

			foreach( $PackageList as $p )
			{
				$RetArray = _fetch_subpackages_list( 
					$RetArray , $ROOT_DIR , $p ,  $PackageNamePrefix , $PackageVersionPrefix
				);
			}

			return( $RetArray );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

	/**
	*	\~russian Удаление пакета по имени и версии.
	*
	*	@param $Path - Путь к пакету.
	*
	*	@exception Exception Кидается иключение этого типа с описанием ошибки.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Delete package by given name and version.
	*
	*	@param $Path - Path to the package.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_open_package_list( $Path )
	{
		try
		{
			$Handle = fopen( $Path , 'w' );
			
			if( $Handle === false )
			{
				throw( new Exception( 'Unable to open package list' ) );
			}
			
			return( $Handle );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

?>