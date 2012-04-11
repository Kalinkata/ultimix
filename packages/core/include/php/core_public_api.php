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
	*	\~russian ������� ������� ��������.
	*
	*	@param $Message - ��������� �� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Function throws exception.
	*
	*	@param $Message - Exception's message.
	*
	*	@author Dodonov A.A.
	*/
	function			throw_exception( $Message )
	{
		throw( new Exception( $Message ) );
	}
	
	/**
	*	\~russian ������� �������� ���������� (����� ��������� ������ index.html).
	*
	*	@param $Path - ���� � ����������� ����������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english This function creates directory (empty index.html is also created).
	*
	*	@param $Path - Path to the creating directory.
	*
	*	@author Dodonov A.A.
	*/
	function				mkdir_ex( $Path )
	{
		@mkdir( $Path );
		file_put_contents( rtrim( $Path , "/\\" ).'/index.html' , '<html><head></head><body></body></html>' );
	}
	
	/**
	*	\~russian ������� ������� ����� ��������/��������.
	*
	*	@param $ClassName - ��� ������.
	*
	*	@return - ������ ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Function joins object's/array's fields.
	*
	*	@param $ClassName - Class name.
	*
	*	@return - Package version.
	*
	*	@author Dodonov A.A.
	*/
	function				get_package_version_s( $ClassName )
	{
		$ClassVersion = explode( '_' , $ClassName );
		$ClassVersionRet = '';
		$ClassVersionRet = array_pop( $ClassVersion ).$ClassVersionRet;
		$ClassVersionRet = array_pop( $ClassVersion ).'.'.$ClassVersionRet;
		$ClassVersionRet = array_pop( $ClassVersion ).'.'.$ClassVersionRet;
		return( $ClassVersionRet );
	}
	
	/**
	*	\~russian ����� �������� ������.
	*
	*	@param $Key - ���� � ����.
	*
	*	@return ������ �� ������ ������ ������.
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Selecting instance of package.
	*
	*	@param $Key - Cache key.
	*
	*	@return Reference on package's object.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_get_package_from_cache( $Key )
	{
		try
		{
			global		$ObjectLabel;
			global		$PackageCache;
			global		$PackagePathsCache;
			$ObjectLabel = 'default';
			return( $PackageCache[ $PackagePathsCache[ $Key ][ 'path' ] ] );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	/**
	*	\~russian ����� �������� ������.
	*
	*	@param $PackageName - ��� ������.
	*
	*	@param $PackageVersion - ������ ������.
	*
	*	@param $PackageScriptPath - ���� � ����� ������� ������.
	*
	*	@return ������ �� ������ ������ ������.
	*
	*	@note ������� ���������� �������� $ObjectLabel �� 'default'. ���� ���� ������ �� ��� ������, �� ����� 
	*	���������� false.
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Selecting instance of package.
	*
	*	@param $PackageName - Name of the package.
	*
	*	@param $PackageVersion - Package's version.
	*
	*	@param $PackageScriptPath - Path to the package's script.
	*
	*	@return Reference on package's object.
	*
	*	@note Function sets value of the $ObjectLabel to 'default'. If the script file was not found then false will 
	*	be returned.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			get_package( $PackageName , $PackageVersion = 'last' , $PackageScriptPath = false )
	{
		try
		{
			list( $Fetched , $Object ) = _try_fetch_from_cache( $PackageName , $PackageVersion );
		
			global		$ObjectLabel;
			if( $Fetched )
			{
				$ObjectLabel = 'default';
				return( $Object );
			}
			
			_fill_package_paths_cache( $PackageName , $PackageVersion , $PackageScriptPath );
			_store_package_path( $PackageName , $PackageVersion );
			$PackageClassName = _package_script_fast_load( $PackageName , $PackageVersion );
			
			$Key = "$PackageName $PackageVersion $ObjectLabel";
			_store_package_object( $PackageClassName , $Key );

			return( _get_package_from_cache( $Key ) );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	$GetPackageObjectCache = array();
	
	/**
	*	\~russian ����� ����� ������� ������.
	*
	*	@param $PackageName - ��� ������.
	*
	*	@param $PackageVersion - ������ ������. ���� last, ������� ������ ����� ��������� ������.
	*
	*	@param $PackageScriptPath - ���� � ����� ������� ������.
	*
	*	@return ������ �� ������ ������ ������.
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Selecting copy of package object.
	*
	*	@param $PackageName - name of the package.
	*
	*	@param $PackageVersion - package's version. In case string 'last' is passed, then function returns 
	*	the latest version.
	*
	*	@param $PackageScriptPath - path to the package's script.
	*
	*	@return Reference on package's object.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			get_package_object( $PackageName , $PackageVersion = 'last' , $PackageScriptPath = false )
	{
		try
		{
			list( $PackageName , $PackageVersion ) = _get_package_info_after_rewrites( 
				$PackageName , $PackageVersion , $PackageScriptPath
			);

			global		$GetPackageObjectCache;
			$Key = "$PackageName $PackageVersion";

			if( isset( $GetPackageObjectCache[ $Key ] ) === false )
			{
				get_package( $PackageName , $PackageVersion , $PackageScriptPath );

				$GetPackageObjectCache[ $Key ] = _get_requested_class_name();
			}

			$ClassName = $GetPackageObjectCache[ $Key ];

			return( new $ClassName() );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
?>