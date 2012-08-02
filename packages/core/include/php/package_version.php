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

	$FullClassNameCacheChanged = false;
	$FullClassNameCache = array();

	$PackageRealVersionCacheChanged = false;
	$PackageRealVersionCache = array();
	
	/**
	*	\~russian ��������� ������.
	*
	*	@param $TmpVersion - ������.
	*
	*	@param $Sel - ������.
	*
	*	@return true/false.
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Version comparison.
	*
	*	@param $TmpVersion - Version.
	*
	*	@param $Sel - Version.
	*
	*	@return true/false.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_compare_versions( $TmpVersion , $Sel )
	{
		try
		{
			return(
				$TmpVersion[ 0 ] > $Sel[ 0 ] || 
				( $TmpVersion[ 0 ] == $Sel[ 0 ] && $TmpVersion[ 1 ] > $Sel[ 1 ] ) || 
				( $TmpVersion[ 0 ] == $Sel[ 0 ] && $TmpVersion[ 1 ] == $Sel[ 1 ] && 
					$TmpVersion[ 2 ] > $Sel[ 2 ] )
			);
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	/**
	*	\~russian ������� ���������� ������ ������.
	*
	*	@param $Tmp - ������.
	*
	*	@param $Sel - ������.
	*
	*	@param $PackageDirectory - �����.
	*
	*	@param $pi - ���������� � �������.
	*
	*	@return true/false.
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Function returns real version of the package.
	*
	*	@param $Tmp - Version.
	*
	*	@param $Sel - Version.
	*
	*	@param $PackageDirectory - Package directory.
	*
	*	@param $pi - Package info.
	*
	*	@return true/false.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_check_tmp_version( $Tmp , &$Sel , &$PackageDirectory , &$pi )
	{
		try
		{
			$TmpVersion = explode( '.' , str_replace( $Tmp , '' , $pi[ 0 ] ) );

			if( _compare_versions( $TmpVersion , $Sel ) )
			{
				$Sel = $TmpVersion;
				$PackageDirectory = $pi[ 1 ];
				return( true );
			}

			return( false );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

	/**
	*	\~russian ������� ���������� ������ ������.
	*
	*	@param $PackageName - ��� ������.
	*
	*	@param $PackageVersion - ������ ������. ���� last, ������� ������ ����� ��������� ������.
	*
	*	@param $ROOT_DIR - ��� �������� ����������, ������ ������� ����� ������������ ������ � ��������.
	*
	*	@return ������ �� ������ ������ ������. ���� false ���� ������.
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Function returns real version of the package.
	*
	*	@param $PackageName - Name of the package.
	*
	*	@param $PackageVersion - Package's version. In case string 'last' is passed, then method returns the 
	*	latest version.
	*
	*	@param $ROOT_DIR - Name of the root directory. In this directory all package processing will be run.
	*
	*	@return Reference on package's object. If an error occured then method returns false.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_get_package_version( $PackageName , $PackageVersion , $ROOT_DIR = INSTALL_DIR )
	{
		try
		{
			if( $PackageVersion === 'last' )
			{
				$PackagesInfo = _load_packages_list( $ROOT_DIR );
				$Dir = '';
				$Sel = array( '0' , '0' , '0' );
				$Tmp = $PackageName.'.';
				foreach( $PackagesInfo as $pi )
				{
					$FastCheck = $pi[ 0 ][ 0 ] === $Tmp[ 0 ] && strpos( $pi[ 0 ] , $Tmp ) === 0;
					if( $FastCheck && _check_tmp_version( $Tmp , $Sel , $Dir , $pi ) )
					{
						break;
					}
				}
				$PackageVersion = implode( '.' , $Sel );
				if( $Dir === '' )
				{
					throw( new Exception( 'Package '.$Tmp.$PackageVersion.' was not found' ) );
				}
			}
			return( $PackageVersion );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

	/**
	*	\~russian ������� ���������� ������� ��������� ������ ������.
	*
	*	@param $PackageName - ��� ������.
	*
	*	@param $PackageVersion - ������ ������. ���� last, ������� ������ ����� ��������� ������.
	*
	*	@param $ROOT_DIR - ��� �������� ����������, ������ ������� ����� ������������ ������ � ��������.
	*
	*	@return ������ �� ������ ������ ������. ���� false ���� ������.
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Function returns real version of the package.
	*
	*	@param $PackageName - Name of the package.
	*
	*	@param $PackageVersion - Package's version. In case string 'last' is passed, then method returns the 
	*	latest version.
	*
	*	@param $ROOT_DIR - Name of the root directory. In this directory all package processing will be run.
	*
	*	@return Reference on package's object. If an error occured then method returns false.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_get_package_real_version( $PackageName , $PackageVersion , $ROOT_DIR = INSTALL_DIR )
	{
		try
		{
			global	$PackageRealVersionCache;
			$Key = "$PackageName $PackageVersion $ROOT_DIR";

			if( isset( $PackageRealVersionCache[ $Key ] ) === false )
			{
				global	$PackageRealVersionCacheChanged;

				$PackageRealVersionCacheChanged = true;
			
				$PackageRealVersionCache[ $Key ] = _get_package_version( $PackageName , $PackageVersion , $ROOT_DIR );
			}
			
			return( $PackageRealVersionCache[ $Key ] );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
?>