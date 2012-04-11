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

	global	$RewritesCacheChanged;
	global	$RewritesCache;
	$RewritesCache = array();
	
	/**
	*	\~russian ����� ������� ��� ������ � �������� �������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Map of aliases for package's versions and names.
	*
	*	@author Dodonov A.A.
	*/
	global 	$RewriteMap;
	$RewriteMap = array();
	
	/**
	*	\~russian ������� ��������� ��������� ���� �������������.
	*
	*	@param $PackageScriptPath - ���� � ����� ������� ������.
	*
	*	@param $FileName - ��� ����� �����.
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Function sets local rewrite maps.
	*
	*	@param $PackageScriptPath - Path to the package's script.
	*
	*	@param $FileName - Map file name.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_set_rewrite_map( $PackageScriptPath = false , $FileName = 'local_rewrite_map' )
	{
		try
		{
			global		$RewriteMap;
			if( $PackageScriptPath !== false )
			{
				$RewriteMap = _file_get_contents( dirname( $PackageScriptPath )."/conf/$FileName" );
				if( $RewriteMap === false )
				{
					return;
				}
				$RewriteMap = str_replace( "\r" , "\n" , $RewriteMap );
				$RewriteMap = str_replace( "\n\n" , "\n" , $RewriteMap );
				if( $RewriteMap != '' )
				{
					$RewriteMap = explode( "\n" , $RewriteMap );
					for( $i = 0 ; $i < count( $RewriteMap ) ; $i++ )
					{
						$RewriteMap[ $i ] = explode( '#' , $RewriteMap[ $i ] );
					}
					return;
				}
				$RewriteMap = false;
			}
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	/**
	*	\~russian ��������� ����� ��������.
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Function resets rewrite map.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_reset_rewrite_map()
	{
		try
		{
			global		$RewriteMap;
			$RewriteMap = false;
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	$MakeFullVersionCacheChanged = false;
	$MakeFullVersionCache = array();
	
	/**
	*	\~russian ������� �������������� ������ ������.
	*
	*	@param $PackageName - ��� ������.
	*
	*	@return ������ ������ ������.
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Function transforms package's version from 'last' to last\:\:last\:\:...\:\:last.
	*
	*	@param $PackageName - Package name.
	*
	*	@return Package's full version.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_complete_package_version( $PackageName )
	{
		$FullPackageVersion = '';
		
		$Packages = explode( '::' , $PackageName );
		if( isset( $Packages[ 1 ] ) )
		{
			$l = count( $Packages ) - 1;
			for( $i = 0 ; $i < $l ; $i++ )
			{
				$FullPackageVersion .= 'last::';
			}
		}
		
		return( $FullPackageVersion );
	}
	
	/**
	*	\~russian ������� �������������� ������ ������.
	*
	*	@param $PackageName - ��� ������.
	*
	*	@param $PackageVersion - ������ �������������� ������.
	*
	*	@return ������ ������ ������.
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Function transforms package's version from 'last' to last\:\:last\:\:...\:\:last.
	*
	*	@param $PackageName - Package name.
	*
	*	@param $PackageVersion - Package's version.
	*
	*	@return Package's full version.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function				_make_full_version( $PackageName , $PackageVersion )
	{
		try
		{
			global	$MakeFullVersionCache;
			if( isset( $MakeFullVersionCache[ "$PackageName.$PackageVersion" ] ) )
			{
				return( $MakeFullVersionCache[ "$PackageName.$PackageVersion" ] );
			}
			
			$FullPackageVersion = $PackageVersion;
			if( $PackageVersion == 'last' || strpos( $PackageVersion , '::' ) === false )
			{
				$FullPackageVersion = _complete_package_version( $PackageName ).$PackageVersion;
			}
			
			global	$MakeFullVersionCacheChanged;
			$MakeFullVersionCacheChanged = true;
			
			return( $MakeFullVersionCache[ "$PackageName.$PackageVersion" ] = $FullPackageVersion );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	/**
	*	\~russian ���������� ��������� ����� ������������� � ������ "full_package_name.full_package_version".
	*
	*	@param $PackageName - ��� ������.
	*
	*	@param $PackageVersion - ������ ������.
	*
	*	@param $Rules - ������� ��������������.
	*
	*	@return ������ ( $PackageName , $PackageVersion ).
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Function applies local rewrite map to the string "full_package_name.full_package_version".
	*
	*	@param $PackageName - Package's name.
	*
	*	@param $PackageVersion - Package's version.
	*
	*	@param $Rules - Rewrites rules.
	*
	*	@return List ( $PackageName , $PackageVersion ).
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function				_apply_to_the_whole_name( $PackageName , $PackageVersion , $Rules )
	{
		try
		{
			global	$RewriteMap;
			
			foreach( $RewriteMap as $i => $r )
			{
				if( preg_match( $r[ 0 ] , $PackageName.'.'.$PackageVersion ) > 0 )
				{
					$PackageName = $r[ 1 ];
					$PackageVersion = $r[ 2 ];
					break;
				}
			}
			
			return( array( $PackageName , $PackageVersion ) );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	/**
	*	\~russian ���������� ��������� ����� ������������� � ������ "package_name.package_version".
	*
	*	@param $PackageNameSegments - �������� �������� ������.
	*
	*	@param $r - ��������������� ��������.
	*
	*	@return true/false
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Function applies local rewrite map.
	*
	*	@param $PackageNameSegments - Package name segments.
	*
	*	@param $r - Rewrited values.
	*
	*	@return true/false
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_set_rewrited( &$PackageNameSegments , $r )
	{
		try
		{
			if( preg_match( $r[ 0 ] , $PackageNameSegments[ $j ].'.'.$PackageVersionSegments[ $j ] ) > 0 )
			{
				$PackageNameSegments[ $j ] = $r[ 1 ];
				$PackageInfoParts = explode( '.' , $r[ 2 ] );

				if( count( $PackageInfoParts ) == 2 )
				{
					$PackageVersionSegments[ $j ] = $PackageInfoParts[ 0 ];
				}
				else
				{
					$PackageVersionSegments[ $j ]  = $PackageInfoParts[ 0 ].'.';
					$PackageVersionSegments[ $j ] .= $PackageInfoParts[ 1 ].'.';
					$PackageVersionSegments[ $j ] .= $PackageInfoParts[ 2 ];
				}

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
	*	\~russian ���������� ��������� ����� ������������� � ������ "package_name.package_version".
	*
	*	@param $PackageName - ��� ������.
	*
	*	@param $PackageVersion - ������ ������.
	*
	*	@param $Rules - ������� ��������������.
	*
	*	@return ������ ( $PackageName , $PackageVersion ).
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Function applies local rewrite map.
	*
	*	@param $PackageName - Package's name.
	*
	*	@param $PackageVersion - Package's version.
	*
	*	@param $Rules - Rewrites rules.
	*
	*	@return List ( $PackageName , $PackageVersion ).
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function				_apply_to_the_parts( $PackageName , $PackageVersion , $Rules )
	{
		try
		{
			global	$RewriteMap;
			
			$PackageNameSegments = explode( '::' , $PackageName );
			$PackageVersionSegments = explode( '::' , $PackageVersion );

			foreach( $RewriteMap as $r )
			{
				for( $j = 0 ; $j < count( $PackageNameSegments ) ; $j++ )
				{
					if( _set_rewrited( $PackageNameSegments[ $j ] , $r ) )
					{
						break;
					}
				}
			}

			$PackageName = implode( '::' , $PackageNameSegments );
			$PackageVersion = implode( '::' , $PackageVersionSegments );

			return( array( $PackageName , $PackageVersion ) );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	/**
	*	\~russian ������� �������������� ���� �������.
	*
	*	@param $PackageName - ��� ������.
	*
	*	@param $PackageVersion - ������ �������������� ������.
	*
	*	@return ������ � �������� ������ ����� ��������������.
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Function transforms packages name and version (global rewrite).
	*
	*	@param $PackageName - package name
	*
	*	@param $PackageVersion - Package's version.
	*
	*	@return Package's name and version after transformation.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_apply_both_transforms( $PackageName , $PackageVersion )
	{
		try
		{
			global	$RewriteMap;
			list( $PackageName , $PackageVersion ) = _apply_to_the_whole_name( 
				$PackageName , 
				$PackageVersion , 
				$RewriteMap 
			);
			$PackageVersion = _make_full_version( $PackageName , $PackageVersion );

			$NameParts = explode( '::' , $PackageName );
			$VersionParts = explode( '::' , $PackageVersion );
			list( $PackageName , $PackageVersion ) = _apply_to_the_parts( 
				$PackageName , 
				$PackageVersion , 
				$RewriteMap 
			);
			return( array( $PackageName , $PackageVersion ) );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	/**
	*	\~russian ���������� ��������� ����� �������������.
	*
	*	@param $PackageName - ��� ������.
	*
	*	@param $PackageVersion - ������ ������.
	*
	*	@param $PackageScriptPath - ���� � ����� ������� ������.
	*
	*	@return ������ ( $PackageName , $PackageVersion ).
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Function applies local rewrite map.
	*
	*	@param $PackageName - package's name.
	*
	*	@param $PackageVersion - package's version.
	*
	*	@param $PackageScriptPath - path to the package's script.
	*
	*	@return Array ( $PackageName , $PackageVersion ).
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_apply_local_rewrite_map( $PackageName , $PackageVersion , $PackageScriptPath )
	{
		try
		{
			_set_rewrite_map( $PackageScriptPath );
			
			global		$RewriteMap;
			
			if( $RewriteMap !== false )
			{
				# \~russian �������� ��������� ����� �������� �� ����� ����� ������
				# \~english trying to apply rewrite map to the hole package name and version
				
				list( $PackageName , $PackageVersion ) = _apply_both_transforms( $PackageName , $PackageVersion );
			}
			
			return( array( $PackageName , $PackageVersion ) );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	global $RewritedPackageCacheChanged;
	$RewritedPackageCacheChanged = false;
	
	global $RewritedPackageCache;
	$RewritedPackageCache = array();
	
	/**
	*	\~russian ������� �������������� ���� ������� (���������� ������).
	*
	*	@param $Name - ��� ������.
	*
	*	@param $Version - ������ �������������� ������.
	*
	*	@param $ROOT_DIR - �������� ���������� ��� ������ �������.
	*
	*	@return ������ � �������� ������ ����� ��������������.
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Function transforms packages name and version (global rewrite).
	*
	*	@param $Name - Package name.
	*
	*	@param $Version - Package's version.
	*
	*	@param $ROOT_DIR - Root directory for package search.
	*
	*	@return Package's name and version after transformation.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_apply_global_rewrite_map( $Name , $Version , $ROOT_DIR )
	{
		try
		{
			global	$RewritedPackageCache;
			$Key = "$Name $Version $ROOT_DIR";
			if( isset( $RewritedPackageCache[ $Key ] ) === false )
			{
				_set_rewrite_map( "$ROOT_DIR/packages/_core_data/unexisting_file" , "cf_global_rewrite_rules" );
				global	$RewriteMap;
				if( $RewriteMap !== false )
				{
					list( $Name , $Version ) = _apply_both_transforms( $Name , $Version );
				}
				_reset_rewrite_map();
				global	$RewritedPackageCacheChanged;
				
				$RewritedPackageCacheChanged = true;
				$RewritedPackageCache[ $Key ] = array( $Name , $Version );
			}
			return( $RewritedPackageCache[ $Key ] );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	/**
	*	\~russian ������� �������������� ���� �������.
	*
	*	@param $PackageName - ��� ������.
	*
	*	@param $PackageVersion - ������ �������������� ������.
	*
	*	@param $PackageScriptPath - ���� � ����� ������� ������.
	*
	*	@return ������ � �������� ������ ����� ��������������.
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Function transforms packages name and version (global rewrite).
	*
	*	@param $PackageName - package name
	*
	*	@param $PackageVersion - Package's version.
	*
	*	@param $PackageScriptPath - path to the package's script.
	*
	*	@return Package's name and version after transformation.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_apply_rewrites( $PackageName , $PackageVersion , $PackageScriptPath )
	{
		try
		{
			list( $PackageName , $PackageVersion ) = _apply_local_rewrite_map( 
				$PackageName , 
				$PackageVersion , 
				$PackageScriptPath
			);
			
			# ���������� �������������
			# global rewriting
			list( $PackageName , $PackageVersion ) = _apply_global_rewrite_map( 
				$PackageName , 
				$PackageVersion , 
				INSTALL_DIR 
			);
			
			return( array( $PackageName , $PackageVersion ) );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	$PackageInfoAfterRewritesCacheChanged = false;
	$PackageInfoAfterRewritesCache = array();
	
	/**
	*	\~russian ������� ���������� ���������� � ������ ����� ���������� ���� �����������.
	*
	*	@param $PackageName - ��� ������.
	*
	*	@param $PackageVersion - ������ ������. ���� last, ������� ������ ����� ��������� ������.
	*
	*	@param $PackageScriptPath - ���� � ����� ������� ������.
	*
	*	@return ���������� � ������.
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Function returns information about package after all erwrites.
	*
	*	@param $PackageName - name of the package.
	*
	*	@param $PackageVersion - package's version. In case string 'last' is passed, then method returns 
	*	the latest version.
	*
	*	@param $PackageScriptPath - path to the package's script.
	*
	*	@return Information about package.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_fill_rewrites_cache( $PackageName , $PackageVersion , $PackageScriptPath )
	{
		try
		{
			global	$ENABLE_REWRITES;
			if( $ENABLE_REWRITES )
			{
				list( $PackageName , $PackageVersion ) = _apply_rewrites( 
					$PackageName , 
					$PackageVersion , 
					$PackageScriptPath 
				);

				global	$RewritesCacheChanged;
				$RewritesCacheChanged = true;
			}
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}
	
	/**
	*	\~russian ������� ���������� ���������� � ������ ����� ���������� ���� �����������.
	*
	*	@param $PackageName - ��� ������.
	*
	*	@param $PackageVersion - ������ ������. ���� last, ������� ������ ����� ��������� ������.
	*
	*	@param $PackageScriptPath - ���� � ����� ������� ������.
	*
	*	@return ���������� � ������.
	*
	*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Function returns information about package after all erwrites.
	*
	*	@param $PackageName - name of the package.
	*
	*	@param $PackageVersion - package's version. In case string 'last' is passed, then method returns 
	*	the latest version.
	*
	*	@param $PackageScriptPath - path to the package's script.
	*
	*	@return Information about package.
	*
	*	@exception Exception An exception of this type is thrown.
	*
	*	@author Dodonov A.A.
	*/
	function			_get_package_info_after_rewrites( $PackageName , $PackageVersion , $PackageScriptPath = false )
	{
		try
		{
			global	$RewritesCache;
			$Key = "$PackageName $PackageVersion $PackageScriptPath";

			if( isset( $RewritesCache[ $Key ] ) )
			{
				return( $RewritesCache[ $Key ] );
			}
			$PackageVersion = _make_full_version( $PackageName , $PackageVersion );

			_fill_rewrites_cache( $PackageName , $PackageVersion , $PackageScriptPath );

			return( $RewritesCache[ $Key ] = array( 0 => $PackageName , 1 => $PackageVersion ) );
		}
		catch( Exception $e )
		{
			$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
		}
	}

?>