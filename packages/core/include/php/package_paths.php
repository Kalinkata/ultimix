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
	*	\~russian ������� ������������� ���������� � ���� �� �������� ���������� �����.
	*
	*	@param $File - ���� � ����� � ������� ������.
	*
	*	@return ������������� ���� �� ����� ���������� ��������� ��� ����� $File.
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
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
	*	\~russian ������� ��������� ��������� ���� � �������������� ������.
	*
	*	@param $PackageName - ��� ������ ����� ���������� ��������.
	*
	*	@param $PackageVersion - �������� ������ �������������� ������.
	*
	*	@return array( $PackageName , $PackageVersion ).
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
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
			/**	\~russian ��������� ������ ��� ������ �������������� ������
				\~english cutting package's name*/
			$PackageName = explode( '::' , $PackageName );
			$PackageName = array_pop( $PackageName );

			/**	\~russian ��������� ������ ��� ������ �������������� ������
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
	*	\~russian ������� ��������� ��������� ���� � �������������� ������.
	*
	*	@param $PackageName - ��� ������ ����� ���������� ��������.
	*
	*	@param $Version - �������� ������ �������������� ������.
	*
	*	@param $ROOT_DIR - �������� ���������� ��� ������ �������.
	*
	*	@return �������� ���� � �������������� ������.
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
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
	*	\~russian ������� ��������� ��������� ���� � �������������� ������.
	*
	*	@param $PackageName - ��� ������ ����� ���������� ��������.
	*
	*	@param $PackageVersion - �������� ������ �������������� ������.
	*
	*	@param $ROOT_DIR - �������� ���������� ��� ������ �������.
	*
	*	@return �������� ���� � �������������� ������.
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
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
	*	\~russian ������� ��������� ��������� ���� � ���������� ������-������, ����������� ������������� �����.
	*
	*	@param $thePackageName - ��� ������.
	*
	*	@param $thePackageVersion - ������ �������������� ������.
	*
	*	@param $ROOT_DIR - �������� ���������� ��� ������ �������.
	*
	*	@return array( $PackagePath , $PackageName , $PackageVersion )
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
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
	*	\~russian ������� ��������� ��������� ���� � ���������� ������-������, ����������� ������������� �����.
	*
	*	@param $thePackageName - ��� ������.
	*
	*	@param $thePackageVersion - ������ �������������� ������.
	*
	*	@param $ROOT_DIR - �������� ���������� ��� ������ �������.
	*
	*	@return �������� ���� � �������� ����������.
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
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